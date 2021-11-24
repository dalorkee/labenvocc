<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Spatie\Permission\Models\{Role,Permission};
//use Spatie\Permission\Traits\HasRoles;

class HomeController extends Controller
{
	public function index(): object {
		if (Auth::check() == 'true') {
			switch ($this->userRole()) {
				case 'root':
				case 'admin':
					return view('dashboard');
					break;
				case 'customer':
					return redirect()->route('customer.index');
					break;
				default:
					return view('apps.home');
					break;
			}
		} else {
			return view('auth.login');
		}
	}

	public static function userRole(): string {
		$user_roles= Auth::user()->roles->pluck('name')->all();
		return $user_roles[0];
	}

	public function logout() {
		Auth::logout();
		return redirect('/login');
	}
}
