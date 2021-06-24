<?php

namespace App\Http\Controllers;

use App\Models\Register;
use Illuminate\Http\Request;
use App\Traits\RefTrait;

class RegisterController extends Controller
{
	use RefTrait;

	public function index() {

		return view('auth.pre-register');
	}

	public function create() {
		$agency_type = self::agencyType();
		return view('auth.register', [
			'agency_type' => $agency_type
		]);
	}

	public function store(Request $request) {
		//
	}

	public function show(Register $register) {
		//
	}

	public function edit(Register $register) {
		//
	}

	public function update(Request $request, Register $register) {
		//
	}

	public function destroy(Register $register) {
		//
	}
}
