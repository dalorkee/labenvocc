<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\{Auth,Log};

class HomeController extends Controller
{
	public function index(): mixed {
		try {
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
						return $this->logoutWithError(message: 'ไม่พบข้อมูลผู้ใช้ โปรดตรวจสอบ');
				}
			} else {
				return $this->logout();
			}
		} catch (\Exception $e) {
			Log::error(message: $e->getMessage());
			return redirect()->back()->with(key: 'error', value: $e->getMessage());
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
	public function logoutWithError($message=null) {
		Auth::logout();
		return redirect(to: 'login')->with(key: 'error', value: $message);
	}

	public function logout() {
		Auth::logout();
		return redirect(to: 'login');
	}

	protected function privacy(): object {
		return view(view: 'apps.privacy');
	}
}
