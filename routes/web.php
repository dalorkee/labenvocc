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
Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [HomeController::class, 'index'])->name('login')->middleware('throttle:60,1');
Route::resources([
	'home' => HomeController::class,
	'register' => RegisterController::class,
	'register/staff' => RegisterStaffController::class
]);
Route::middleware(['auth:sanctum', 'verified'])->group(function() {
	Route::get('/dashboard', function() {
		return view('dashboard');
	})->name('dashboard');
});

// Aung SendSampleReq Routh
Route::resources([
	'customerList' => CustomerLstController::class,
  'biolabFrm' => BiolabCustomerController::class
]);
