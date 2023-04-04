<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\{Hash,Log};
//use App\Models\{User,UserCustomer};
use App\Traits\{CommonTrait,JsonBoundaryTrait,DbBoundaryTrait,DbHospitalTrait,GovernmentTrait};
//use Kineticamobile\Lumki\Controllers\UserController;

class RegisterController extends Controller
{
	use CommonTrait, JsonBoundaryTrait, DbBoundaryTrait, DbHospitalTrait, GovernmentTrait;

	public function index(Request $request): object {
		if ($request->session()->has('userLoginData'))  $request->session()->forget('userLoginData');
		if ($request->session()->has('userData')) $request->session()->forget('userData');
		return view('auth.register.index');
	}

	public function refreshCaptcha() {
		return response()->json(['captcha'=> captcha_img('flat')]);
	}
}
