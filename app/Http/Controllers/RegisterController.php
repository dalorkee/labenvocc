<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\{RefTrait,JsonBoundaryTrait,DbBoundaryTrait};

class RegisterController extends Controller
{
	use RefTrait, JsonBoundaryTrait, DbBoundaryTrait;

	public function index(): object {
		return view('auth.pre-register');
	}

	protected function create(): object {
		$agency_type = self::agencyType();
		$provinces = self::getMinProvince();
		return view('auth.register', [
			'agency_type' => $agency_type,
			'provinces' => $provinces
		]);
	}

	public function store(Request $request) {}
	public function show(Register $register) {}
	public function edit(Register $register) {}
	public function update(Request $request, Register $register) {}
	public function destroy(Register $register) {}
}
