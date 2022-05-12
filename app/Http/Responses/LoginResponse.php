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

		/* by pj */
		dd('pj');
		// if (Auth::user()->user_status == 'อนุญาต' && Auth::user()->approved == 'y') {
		// 	return redirect()->route('home.index');
		// } else {
		// 	return redirect()->route('logout');
		// }
	}
}
