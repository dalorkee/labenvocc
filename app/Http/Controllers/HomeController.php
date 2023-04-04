<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
	public function index(): mixed {
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
					return $this->logoutWithError(error: 'ไม่พบข้อมูล Role ผู้ใช้');
			}
		} else {
			return $this->logout();
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
	public function logoutWithError($error=null) {
		Auth::logout();
		return redirect(to: 'login')->with(key: 'error', value: $error);
	}

    public function logout() {
		Auth::logout();
		return redirect(to: 'login');
	}

	protected function privacy(): object {
		return view(view: 'apps.privacy');
	}
}
