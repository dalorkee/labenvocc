<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
//use App\Models\User;
use App\Traits\{RefTrait,JsonBoundaryTrait,DbBoundaryTrait,DbHospitalTrait};

class RegisterController extends Controller
{
	use RefTrait, JsonBoundaryTrait, DbBoundaryTrait, DbHospitalTrait;

	public function index(): object {
		return view('auth.pre-register');
	}
	protected function create(): object {
		$agency_type = $this->agencyType();
		$provinces = $this->getMinProvince();
		return view('auth.register', [
			'agency_type' => $agency_type,
			'provinces' => $provinces
		]);
	}

	public function registerVerifyData(Request $request) {
		$validator = Validator::make($request->all(),[
			'captcha' => 'required'
		]);
		if ($validator->fails()) {
			return response()->json(['error'=>$validator->errors()->all()]);
		}


	}

	public function store(Request $request) {
		dd($request);
	}

	public function refreshCaptcha()
	{
		return response()->json(['captcha'=> captcha_img('flat')]);
	}

}
