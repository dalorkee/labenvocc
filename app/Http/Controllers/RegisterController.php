<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
		dd($request->data);
		$htm = "
		<div>test ja</div>";
		return $htm;
	}

	public function store(Request $request) {
		dd($request);
	}

}
