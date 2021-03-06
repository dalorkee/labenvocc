<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\OfficeDataTable;
use Illuminate\Support\Facades\DB;
use App\Traits\CommonTrait;

class OfficeController extends Controller
{
    use CommonTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OfficeDataTable $dataTable){

        return $dataTable->render('admin.office.index');
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
     * @param  \App\Models\Admin\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function show(User $user){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request){
        $positions = $this->getPosition();
        $position_levels = $this->getPositionLevel();
        $duties = $this->getStaffDuty();
        $userStuff = User::join('users_staff_detail','users.id','=','users_staff_detail.user_id')
        ->where('users.user_type','staff')
        ->where('users_staff_detail.user_id',$request->id)
        ->get();
        return view('admin.office.edit',['userStuff'=>$userStuff,'positions'=>$positions,'position_levels'=>$position_levels,'duties'=>$duties]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $users){
        $this->validate($request,[
            'user_id'=>'required',
            'user_status'=>'required',
        ]);
        $user_find = $users->find($request->user_id);
        $user_staff_find = $user_find->userStaff;
        $user_staff_find->first_name = $request->first_name;
        $user_staff_find->last_name = $request->last_name;
        $user_staff_find->position = $request->position;
        $user_staff_find->position_level = $request->position_level;
        $user_staff_find->duty = $request->duty;
        $user_staff_find->mobile = $request->mobile;
        $us_up = $user_staff_find->save();
        if($us_up == true){
            if($request->user_status === '??????????????????' AND $user_find->user_status !== '??????????????????'){
                $user_find->user_status = $request->user_status;
                $user_find->approved = 'y';
                DB::table('model_has_roles')->insert([
                    'role_id'=>'3',
                    'model_type'=>'App\Models\User',
                    'model_id'=>$request->user_id,
                ]);    
            }elseif($request->user_status !== '??????????????????' AND $user_find->user_status === '??????????????????'){
                $user_find->approved = 'n';
                $user_find->user_status = $request->user_status;
                DB::table('model_has_roles')->where('model_id',$request->user_id)->delete();
            }elseif($request->user_status === '??????????????????' AND $user_find->user_status === '??????????????????'){
                return redirect()->route('office.index')->with('success', 'updated successfully');
            }elseif($request->user_status !== '??????????????????' AND $user_find->user_status !== '??????????????????'){
                $user_find->user_status = $request->user_status;                
            }else{
                return redirect()->route('office.index')->with('error', 'unsuccessfully');
            }
            $u_up = $user_find->save();
            if($u_up==true){
                return redirect()->route('office.index')->with('success', 'updated successfully');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,User $users){
        $d_now = date('Y-m-d H:i:s');        
        $user_find = $users->find($request->id);
        $user_find->approved = 'n';
        $user_find->user_status = '???????????????????????????';
        $user_find->deleted_at = $d_now;
        $u_del = $user_find->save();
        if($u_del==true){
            $user_staff_find = $user_find->userStaff;
            $user_staff_find->deleted_at = $d_now;
            $ustuf_del = $user_staff_find->save();
            if($ustuf_del==true){
                $del = DB::table('model_has_roles')->where('model_id', '=', $request->id)->delete();  
                if($del==true){
                    return redirect()->route('office.index')->with('success', 'delete successfully');         
                }
                else{
                    return redirect()->route('office.index')->with('error', 'unsuccessfully');
                }
            }
            else{
                return redirect()->route('office.index')->with('error', 'unsuccessfully');
            }             
        } 
        else{
            return redirect()->route('office.index')->with('error', 'unsuccessfully');
        }
    }
    public function allow(Request $request,User $users){       
        $user_find = $users->find($request->id);
        $user_find->approved = 'y';
        $user_find->user_status = '??????????????????';
        $u_allow = $user_find->save();
        if($u_allow==true){
            DB::table('model_has_roles')->insert([
                'role_id'=>'3',
                'model_type'=>'App\Models\User',
                'model_id'=>$request->id,
            ]);
            return redirect()->route('office.index')->with('success', 'allow successfully');
        } 
        else{
            return redirect()->route('office.index')->with('error', 'unsuccessfully');
        }       
    }
    public function deny(Request $request,User $users){        
        $user_find = $users->find($request->id);
        $user_find->approved = 'n';
        $user_find->user_status = '???????????????????????????';
        $u_deny = $user_find->save();
        if($u_deny==true){
            DB::table('model_has_roles')->where('model_id', '=', $request->id)->delete(); 
            return redirect()->route('office.index')->with('success', 'deny successfully');          
        } 
        else{
            return redirect()->route('office.index')->with('error', 'unsuccessfully');
        }       
    }
}
