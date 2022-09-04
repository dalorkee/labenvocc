<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
	public function index(): object {
		if (Auth::check() == 'true' && Auth::user()->user_status == 'อนุญาต' && Auth::user()->approved == 'y') {
			switch ($this->userRole()) {
				case 'root':
				case 'admin':
					return redirect()->route(route: 'admin.index');
					break;
				case 'customer':
					return redirect()->route(route: 'customer.index');
					break;
				case 'staff':
					return redirect()->route(route: 'staff.index');
					break;
				default:
					return redirect()->route(route: 'logout')->with(key: 'error', value: 'ไม่พบข้อมูลผู้ใช้');
			}
		} else {
			return redirect()->route(route: 'logout')->with(key: 'error', value: 'โปรดตรวจสอบสิทธิ์ผู้ใช้');
		}
	}

	public static function userRole(): string {
		$user_roles= Auth::user()->roles->pluck('name')->all();
		if (count($user_roles) > 0) {
			return $user_roles[0];
		} else {
			return redirect(to: 'logout');
		}
	}

	public function logout() {
		Auth::logout();
		return redirect(to: 'login');
	}
}
