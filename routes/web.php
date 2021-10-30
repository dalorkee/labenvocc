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
		Route::get('/customer/info/create/order/{order_id}', [CustomerController::class, 'createInfo'])->name('info.create');
		Route::post('customer/info/store/order', [CustomerController::class, 'storeInfo'])->name('info.store');

		Route::get('/customer/parameter/create/order/{order_id}', [CustomerController::class, 'createParameter'])->name('parameter.create');
		Route::post('customer/parameter/personal/store', [CustomerController::class, 'storeParameterPersonal'])->name('parameter.personal.store');
		Route::get('/customer/parameter/personal/edit', [CustomerController::class, 'editParameterPersonal'])->name('parameter.personal.edit');
		Route::post('/customer/parameter/personal/update', [CustomerController::class, 'updateParameterPersonal'])->name('parameter.personal.update');
		Route::get('/customer/parameter/personal/delete/id/{id}', [CustomerController::class, 'DestroyParameterPersonal'])->name('parameter.personal.destroy');

		Route::get('/customer/parameter/data/list/detail/{order_detail_id}/type/{threat_type_id}', [CustomerController::class, 'listParameterData'])->name('parameter.data.list');
		Route::get('/customer/parameter/data/store/detail/{order_detail_id}/id/{id}', [CustomerController::class, 'storeParameterData'])->name('parameter.data.store');
		Route::get('/customer/parameter/data/delete/id/{id}', [CustomerController::class, 'DestroyParameterData'])->name('parameter.data.destroy');

		Route::get('/customer/specemen/create/order/{order_id}', [CustomerController::class, 'createSpecemen'])->name('specemen.create');
	});
});
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
	Route::resources([
		'office'=>OfficeController::class,
		'paramet'=>ParametController::class
	]);
});
