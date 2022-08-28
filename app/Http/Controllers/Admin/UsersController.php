<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Hash};
use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable) {
        return $dataTable->render('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $users
     * @return \Illuminate\Http\Response
     */
    public function show(User $users){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request){
        $userCus = User::join('users_customer_detail','users.id','=','users_customer_detail.user_id')
            ->where('users.user_type','customer')
            ->where('users_customer_detail.user_id',$request->id)
            ->get();

        return view('admin.users.edit',compact('userCus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $users){
        $this->validate($request,[
            'user_id'=>'required',
            'user_status'=>'required',
        ]);
        $user_find = $users->find($request->user_id);
        if($request->change_password == 'pw_chk' && $request->password != ''){
            $request->password = Hash::make($request->password);
            $user_find->password = $request->password;
            $user_find->password_confirmation = $request->password;
        }
        elseif($request->change_password == 'pw_chk' && $request->password == ''){
            return redirect()->route('users.edit',$request->user_id)->with('error', 'password require');
        }
        elseif($request->change_password == '' && $request->password != ''){
            return redirect()->route('users.edit',$request->user_id)->with('error', 'check password condition');
        }
        $u_pw = $user_find->save();
        if($u_pw == true){
            $user_cus_find = $user_find->userCustomer;
            $user_cus_find->first_name = $request->first_name;
            $user_cus_find->last_name = $request->last_name;
            $user_cus_find->ref_office_lab_code = $request->ref_office_lab_code;
            $user_cus_find->ref_office_env_code = $request->ref_office_env_code;
            $user_cus_find->agency_code = $request->agency_code;
            $user_cus_find->agency_name = $request->agency_name;
            $uc_up = $user_cus_find->save();
            if($uc_up==true){
                if($request->user_status === 'อนุญาต' AND $user_find->user_status !== 'อนุญาต'){
                    $user_find->user_status = $request->user_status;
                    $user_find->approved = 'y';
                    DB::table('model_has_roles')->insert([
                        'role_id'=>'4',
                        'model_type'=>'App\Models\User',
                        'model_id'=>$request->user_id,
                    ]);
                }
                elseif($request->user_status !== 'อนุญาต' AND $user_find->user_status === 'อนุญาต'){
                    $user_find->approved = 'n';
                    $user_find->user_status = $request->user_status;
                    DB::table('model_has_roles')->where('model_id',$request->user_id)->delete();
                }
                elseif($request->user_status === 'อนุญาต' AND $user_find->user_status === 'อนุญาต'){
                    return redirect()->route('users.index')->with('success', 'updated successfully');
                }
                elseif($request->user_status !== 'อนุญาต' AND $user_find->user_status !== 'อนุญาต'){
                    $user_find->user_status = $request->user_status;
                }
                else{
                    return redirect()->route('users.edit',$request->user_id)->with('error', 'permissions unsuccessful');
                }
                $u_up = $user_find->save();
                if($u_up==true){
                    return redirect()->route('users.index')->with('success', 'updated successfully');
                }
                else{
                    return redirect()->route('users.edit',$request->user_id)->with('error', 'permission update unsuccessfully');
                }
            }
            else{
                return redirect()->route('users.edit',$request->user_id)->with('error', 'update profile unsuccessfully');
            }
        }
        else{
            return redirect()->route('users.edit',$request->user_id)->with('error', 'unsuccessfully');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,User $users){
        $d_now = date('Y-m-d H:i:s');
        $user_find = $users->find($request->id);
        $user_find->approved = 'n';
        $user_find->user_status = 'ไม่อนุญาต';
        $user_find->deleted_at = $d_now;
        $u_del = $user_find->save();
        if($u_del==true){
            $user_cus_find = $user_find->userCustomer;
            $user_cus_find->deleted_at = $d_now;
            $ucus_del = $user_cus_find->save();
            if($ucus_del==true){
                $del = DB::table('model_has_roles')->where('model_id', '=', $request->id)->delete();
                if($del==true){
                    return redirect()->route('users.index')->with('success', 'delete successfully');
                }
                else{
                    return redirect()->route('users.index')->with('error', 'unsuccessfully');
                }
            }
            else{
                return redirect()->route('users.index')->with('error', 'unsuccessfully');
            }
        }
        else{
            return redirect()->route('users.index')->with('error', 'unsuccessfully');
        }
    }
    public function allow(Request $request,User $users){
        $user_find = $users->find($request->id);
        $user_find->approved = 'y';
        $user_find->user_status = 'อนุญาต';
        $u_allow = $user_find->save();
        if($u_allow==true){
            DB::table('model_has_roles')->insert([
                'role_id'=>'4',
                'model_type'=>'App\Models\User',
                'model_id'=>$request->id,
            ]);
            return redirect()->route('users.index')->with('success', 'allow successfully');
        }
        else{
            return redirect()->route('users.edit',$request->id)->with('error', 'unsuccessfully');
        }
    }
    public function deny(Request $request,User $users){
        $user_find = $users->find($request->id);
        $user_find->approved = 'n';
        $user_find->user_status = 'ไม่อนุญาต';
        $u_deny = $user_find->save();
        if($u_deny==true){
            DB::table('model_has_roles')->where('model_id', '=', $request->id)->delete();
            return redirect()->route('users.index')->with('success', 'deny successfully');
        }
        else{
            return redirect()->route('users.index')->with('error', 'unsuccessfully');
        }
    }
}
