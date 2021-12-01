<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $users
     * @return \Illuminate\Http\Response
     */
    public function show(User $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
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
    public function update(Request $request, User $users)
    {
        // $this->validate($request,[
        //     'user_id'=>'required',
        //     'user_status'=>'required',
        // ]);
        $user_find = $users->find($request->user_id);
        $user_cus_find = $user_find->userCustomer;
        $user_cus_find->first_name = $request->first_name;
        $user_cus_find->last_name = $request->last_name;
        $user_cus_find->ref_office_lab_code = $request->ref_office_lab_code;
        $user_cus_find->ref_office_env_code = $request->ref_office_env_code;
        $user_cus_find->office_code = $request->office_code;
        $user_cus_find->office_name = $request->office_name;
        $uc_up = $user_cus_find->save();
        if($uc_up==true){
            if($request->user_status === 'อนุญาต'){
                $user_find->user_status = $request->user_status;
                $user_find->approved = 'y';
                DB::table('model_has_roles')->insert([
                    'role_id'=>'4',
                    'model_type'=>'App\Models\User',
                    'model_id'=>$request->user_id,
                ]);
    
            }else{
                $user_find->approved = 'n';
                $user_find->user_status = $request->user_status;
                DB::table('model_has_roles')->where('model_id',$request->user_id)->delete();
            }
            $u_up = $user_find->save();
            if($u_up==true){
                return redirect()->route('users.index')->with('success', 'updated successfully');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $Users)
    {
        //
    }

}
