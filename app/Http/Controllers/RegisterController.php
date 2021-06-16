<?php

namespace App\Http\Controllers;

use App\Models\Register;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index() {
        return view('auth.pre-register');
    }

    public function create() {
        return view('auth.register');
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
