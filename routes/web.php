<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\
{
	HomeController,
	RegisterController,
	RegisterStaffController,
	CustomerLstController,
	BiolabCustomerController
};

Route::impersonate();
Route::any('/', [HomeController::class, 'index']);
Route::any('/login', [HomeController::class, 'index'])->name('login');
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function() {return view('dashboard');})->name('dashboard');
Route::resources([
	'home' => HomeController::class,
	'register' => RegisterController::class,
	'register/staff' => RegisterStaffController::class
]);

// Aung SendSampleReq Routh
Route::resources([
	'customerList' => CustomerLstController::class,
  'biolabFrm' => BiolabCustomerController::class
]);
