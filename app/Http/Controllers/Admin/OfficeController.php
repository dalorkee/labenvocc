<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Hash,DB,Auth,Log};
use App\DataTables\OfficeDataTable;
use App\Traits\CommonTrait;

class OfficeController extends Controller
{
    private object $user;

	public function __construct() {
		$this->middleware('auth');
		$this->middleware(['role:root|admin']);
		$this->middleware('is_order_confirmed');
		$this->middleware(function($request, $next) {
			$this->user = Auth::user();
			$user_role_arr = $this->user->roles->pluck('name')->all();
			$this->user_role = $user_role_arr[0];
			return $next($request);
		});
	}
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
        if($request->change_password == 'pw_chk' && $request->password != ''){
            $request->password = Hash::make($request->password);
            $user_find->password = $request->password;
            $user_find->password_confirmation = $request->password;
        }
        elseif($request->change_password == 'pw_chk' && $request->password == ''){
            return redirect()->route('office.edit',$request->user_id)->with('error', 'password require');
        }
        elseif($request->change_password == '' && $request->password != ''){
            return redirect()->route('office.edit',$request->user_id)->with('error', 'check password condition');
        }
        $us_pw = $user_find->save();
        if($us_pw == true){
            $user_staff_find = $user_find->userStaff;
            $user_staff_find->first_name = $request->first_name;
            $user_staff_find->last_name = $request->last_name;
            $user_staff_find->position = $request->position;
            $user_staff_find->position_level = $request->position_level;
            $user_staff_find->duty = $request->duty;
            $user_staff_find->mobile = $request->mobile;
            $us_pf = $user_staff_find->save();
            if($us_pf == true){
                if($request->user_status === 'อนุญาต' AND $user_find->user_status !== 'อนุญาต'){
                    $user_find->user_status = $request->user_status;
                    $user_find->approved = 'y';
                    DB::table('model_has_roles')->insert([
                        'role_id'=>'3',
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
                    return redirect()->route('office.index')->with('success', 'updated successfully');
                }
                elseif($request->user_status !== 'อนุญาต' AND $user_find->user_status !== 'อนุญาต'){
                    $user_find->user_status = $request->user_status;
                }
                else{
                    return redirect()->route('office.edit',$request->user_id)->with('error', 'permissions unsuccessfully');
                }
                $us_ps = $user_find->save();
                if($us_ps==true){
                    return redirect()->route('office.index')->with('success', 'updated successfully');
                }
                else{
                    return redirect()->route('office.edit',$request->user_id)->with('error', 'permission update unsuccessfully');
                }
            }
            else{
                return redirect()->route('office.edit',$request->user_id)->with('error', 'update profile unsuccessfully');
            }
        }
        else{
            return redirect()->route('office.edit',$request->user_id)->with('error', 'unsuccessfully');
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
        $user_find->user_status = 'ไม่อนุญาต';
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
        $user_find->user_status = 'อนุญาต';
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
        $user_find->user_status = 'ไม่อนุญาต';
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
