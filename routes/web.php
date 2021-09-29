<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
	HomeController,
	RegisterController,
	RegisterStaffController,
	CustomerController
};
use App\Http\Controllers\Admin\{
	OfficeController,
	ParametController
};

Route::impersonate();
Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [HomeController::class, 'index'])->name('login')->middleware('throttle:60,1');
Route::resources([
	'home' => HomeController::class,
	'register' => RegisterController::class,
	'registerStaff' => RegisterStaffController::class,
	'customer' => CustomerController::class
]);
Route::name('register.')->group(function() {
	Route::post('province/district', [RegisterController::class, 'renderDistrictToHtmlSelect'])->name('district');
	Route::post('province/district/subdistrict', [RegisterController::class, 'renderSubDistrictToHtmlSelect'])->name('subDistrict');
	Route::post('province/subdistrict/postcode', [RegisterController::class, 'getPostCodeBySubDistrict'])->name('postcode');
	Route::post('search/hospital', [RegisterController::class, 'searchHospitalByName'])->name('hospital');
	Route::post('refresh-captcha', [RegisterController::class, 'refreshCaptcha'])->name('refresh-captcha');
});
Route::middleware(['auth:sanctum', 'verified'])->group(function() {
	Route::get('/dashboard', function() {
		return view('dashboard');
	})->name('dashboard');
	Route::name('customer.')->group(function() {
		Route::get('/customer/info/create/{order_id}', [CustomerController::class, 'createInfo'])->name('info.create');
		Route::post('customer/info/store', [CustomerController::class, 'storeInfo'])->name('info.store');
		Route::get('/customer/create/parameter/{order_id}', [CustomerController::class, 'createParameter'])->name('parameter');
		Route::post('customer/store/parameter/personal', [CustomerController::class, 'storeParameterPersonalInfo'])->name('personal');
	});
});
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
	Route::resources([
		'office'=>OfficeController::class,
		'paramet'=>ParametController::class
	]);
});
