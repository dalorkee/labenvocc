<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\
{
	HomeController,
	RegisterController,
	RegisterStaffController,
	CustomerLstController,
	CustomerBiolabController,
    CustomerEnvLabController,
	BackendAdminController
};

Route::impersonate();
Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [HomeController::class, 'index'])->name('login')->middleware('throttle:60,1');
Route::resources([
	'home' => HomeController::class,
	'register' => RegisterController::class,
	'register/staff' => RegisterStaffController::class
]);
Route::name('register.')->group(function() {
	Route::post('province/district', [RegisterController::class, 'renderDistrictToHtmlSelect'])->name('district');
	Route::post('province/district/subdistrict', [RegisterController::class, 'renderSubDistrictToHtmlSelect'])->name('subDistrict');
	Route::post('province/subdistrict/postcode', [RegisterController::class, 'getPostCodeBySubDistrict'])->name('postcode');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function() {
	Route::get('/dashboard', function() {
		return view('dashboard');
	})->name('dashboard');
});


// Aung SendSampleReq Routh
Route::resources([
	'customerList' => CustomerLstController::class,
    'biolabFrm' => CustomerBiolabController::class,
    'envlabFrm' => CustomerEnvLabController::class,
]);

Route::resource('backadm', BackendAdminController::class);