<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Hash,DB,Auth,Log};
use App\Models\{User,UserCustomer};
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;

class UsersController extends Controller
{
	private object $user;
	private string $user_role;

	public function __construct() {
		$this->middleware('auth');
		$this->middleware(['role:root|admin']);
		$this->middleware(function($request, $next) {
			$this->user = Auth::user();
			$user_role_arr = $this->user->roles->pluck('name')->all();
			$this->user_role = $user_role_arr[0];
			return $next($request);
		});
	}

	protected function index(UsersDataTable $dataTable): object {
		return $dataTable->render(view: 'admin.users.index');
	}

	protected function edit(Request $request): object {
		$userCus = User::join('users_customer_detail','users.id','=','users_customer_detail.user_id')
			->where('users.user_type','customer')
			->where('users_customer_detail.user_id', $request->id)
			->get();
		return view(view: 'admin.users.edit', data: compact('userCus'));
	}

	protected function update(Request $request) {
		$this->validate($request, [
			'user_id' => 'required',
			'user_status' => 'required',
			'password' => 'required_if:change_password,pw_chk'
		]);
		try {
			$user_find = User::findOr($request->user_id, fn () => throw new \Exception(message: 'ไม่พบข้อมูลผู้ใช้นี้'));
			if (!empty($request->password) && !empty($request->change_password)) {
				$new_password = Hash::make($request->password);
				$user_find->password = $new_password;
				$user_find->password_confirmation = $new_password;
			}
			$user_find->user_status = $request->user_status;
			$user_find->approved = ($request->user_status == 'อนุญาต') ? 'y' : 'n';
			$user_find->deleted_at = ($request->user_status == 'อนุญาต') ? null : date('Y-m-d H:i:s');
			$user_find->save();
			$user_cus_find = UserCustomer::whereUser_id($request->user_id)?->firstOrFail();
			$user_cus_find->first_name = $request->first_name;
			$user_cus_find->last_name = $request->last_name;
			$user_cus_find->ref_office_lab_code = $request->ref_office_lab_code;
			$user_cus_find->ref_office_env_code = $request->ref_office_env_code;
			$user_cus_find->agency_code = $request->agency_code;
			$user_cus_find->agency_name = $request->agency_name;
			$user_cus_find->deleted_at = ($request->user_status == 'อนุญาต') ? null : date('Y-m-d H:i:s');
			$user_cus_find->save();
			if ($user_find->user_status == 'อนุญาต' && $user_find->approved == 'y') {
				DB::table('model_has_roles')->updateOrInsert(
					['role_id' => '4', 'model_type' => 'App\Models\User', 'model_id' => $request->user_id],
					['model_id' => $request->user_id]
				);
			} else {
				DB::table('model_has_roles')->where('model_id', '=', $request->user_id)->delete();
			}
			return redirect()->back()->with(key: 'success', value: 'บันทึกข้อมูลสำเร็จแล้ว');
		} catch (\Exception $e) {
			Log::error(message: $e->getMessage());
			return redirect()->back()->with(key: 'error', value: $e->getMessage());
		}
	}

	protected function allow(Request $request) {
		try {
			$user_find = User::findOr($request->id, fn () => throw new \Exception('ไม่พบผู้ใช้รหัสนี้ โปรดตรวจสอบ'));
			if ($user_find->approved == 'y' && $user_find->user_status = 'อนุญาต') {
				return redirect()->back()->with(key: 'warning', value: 'ผู้ใช้รหัสนี้ มีสิทธิ์ใช้งานระบบอยู่แล้ว');
			}
			$user_find->approved = 'y';
			$user_find->user_status = 'อนุญาต';
			$user_find->deleted_at = null;
			$user_find->save();
			UserCustomer::where('user_id', $request->id)->update(['deleted_at' => null]);
			DB::table('model_has_roles')->updateOrInsert(
				['role_id' => '4', 'model_type' => 'App\Models\User', 'model_id' => $request->id],
				['model_id' => $request->id]
			);
			return redirect()->back()->with(key: 'success', value: 'อนุญาตผู้ใช้แล้ว');
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with(key: 'error', value: $e->getMessage());
		}
	}

	public function destroy(Request $request) {
		try {
			$now = date('Y-m-d H:i:s');
			$user_find = User::findOr($request->id, fn () => throw new \Exception('ไม่พบผู้ใช้รหัสนี้ โปรดตรวจสอบ'));
			$user_find->approved = 'n';
			$user_find->user_status = 'ไม่อนุญาต';
			$user_find->deleted_at = $now;
			$user_find->save();
			UserCustomer::where('user_id', $request->id)->update(['deleted_at' => $now]);
			DB::table('model_has_roles')->where('model_id', '=', $request->id)->delete();
			return redirect()->back()->with(key: 'success', value: 'ลบข้อมูลผู้ใช้แล้ว');
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with(key: 'error', value: $e->getMessage());
		}
	}

	public function deny(Request $request) {
		try {
			$now = date('Y-m-d H:i:s');
			$user_find = User::findOr($request->id, fn () => throw new \Exception('ไม่พบผู้ใช้รหัสนี้ โปรดตรวจสอบ'));
			$user_find->approved = 'n';
			$user_find->user_status = 'ไม่อนุญาต';
			$user_find->deleted_at = $now;
			$user_find->save();
			UserCustomer::where('user_id', $request->id)->update(['deleted_at' => $now]);
			DB::table('model_has_roles')->where('model_id', '=', $request->id)->delete();
			return redirect()->back()->with(key: 'success', value: 'ยกเลิกผู้ใช้แล้ว');
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with(key: 'error', value: $e->getMessage());
		}
	}
}
