<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\
{
	HomeController,
	RegisterController,
	RegisterStaffController,
	CustomerLstController,
	CustomerBiolabController,
	CustomerEnvLabController
};
use App\Http\Controllers\Admin\
{
	OfficeController,
	ParametController
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
	Route::post('search/hospital', [RegisterController::class, 'searchHospitalByName'])->name('hospital');
	Route::post('register/verify', [RegisterController::class, 'registerVerifyData'])->name('verify');
    Route::post('refresh-captcha', [RegisterController::class, 'refreshCaptcha'])->name('refresh-captcha');
});
Route::any('captcha-test', function() {
	if (request()->getMethod() == 'POST') {
		$rules = ['captcha' => 'required|captcha'];
		$validator = validator()->make(request()->all(), $rules);
		if ($validator->fails()) {
			echo '<p style="color: #ff0000;">Incorrect!</p>';
		} else {
			echo '<p style="color: #00ff30;">Matched :)</p>';
		}
	}

	$form = '<form method="post" action="captcha-test">';
	$form .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
	$form .= '<p>' . captcha_img() . '</p>';
	$form .= '<p><input type="text" name="captcha"></p>';
	$form .= '<p><button type="submit" name="check">Check</button></p>';
	$form .= '</form>';
	return $form;
});

Route::middleware(['auth:sanctum', 'verified'])->group(function() {
	Route::get('/dashboard', function() {
		return view('dashboard');
	})->name('dashboard');
});
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');


// Aung SendSampleReq Routh
Route::resources([
	'customerList' => CustomerLstController::class,
	'biolabFrm' => CustomerBiolabController::class,
	'envlabFrm' => CustomerEnvLabController::class,
]);

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
	Route::resources([
		'office'=>OfficeController::class,
		'paramet'=>ParametController::class
	]);
});
