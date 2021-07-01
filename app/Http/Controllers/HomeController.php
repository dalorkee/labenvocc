<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\{Role,Permission};
use Spatie\Permission\Traits\HasRoles;

class HomeController extends Controller
{
	#[Route("/login", methods: ["GET"])]
	public function index(): mixed {
		if (Auth::check()) {
			switch ($this->userRole()) {
				case 'Superadmin':
					return view('dashboard');
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
}
