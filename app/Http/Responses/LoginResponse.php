<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as ContractsLoginResponse;
use Illuminate\Support\Facades\Auth;

class LoginResponse implements ContractsLoginResponse
{
	public function toResponse($request) {
		// here i am checking if the currently logout in users has a role_id of 2 which make him a regular user and then redirect to the users dashboard else the admin dashboard
		// if (auth()->user()->id == 1) {
		// 	return redirect()->route('dashboard');
		// } else {
		// 	return redirect()->route('home.index');
		// }
		//return redirect()->intended(config('fortify.admin.home'));

		/* by tonn */
		if (Auth::user()->user_status == 'อนุญาต' && Auth::user()->approved == 'y') {
			return redirect()->route('home.index');
		} else {
			return redirect()->route('logout');
		}
/* 		$role= Auth::user()->roles->pluck('name')->all();
		if (count($role) > 0) {
			switch ($role[0]) {
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
		} */
	}
}
