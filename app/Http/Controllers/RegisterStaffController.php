<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Traits\RefTrait;

class RegisterStaffController extends Controller
{
	//use RefTrait;

	public function index() {}

	public function create() {
		return view('auth.register-staff');
	}

	public function store() {}
	public function show() {}
	public function edit() {}
	public function update() {}
	public function destroy() {}
}
