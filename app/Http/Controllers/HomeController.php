<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
	public function index(): object {
		if (Auth::check() == 'true') {
			switch ($this->userRole()) {
				case 'root':
				case 'admin':
					return redirect()->route('admin.index');
					break;
				case 'customer':
					return redirect()->route('customer.index');
					break;
				default:
					return redirect()->route('logout');
					break;
			}
		} else {
			return redirect()->route('logout');
		}
	}

	public static function userRole(): string {
		$user_roles= Auth::user()->roles->pluck('name')->all();
		if (count($user_roles) > 0) {
			return $user_roles[0];
		} else {
			return redirect('logout');
		}
	}

	public function logout() {
		Auth::logout();
		return redirect('login');
	}
}
