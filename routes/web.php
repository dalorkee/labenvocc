<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
	HomeController,
	RegisterController,
	RegisterPersonalController,
	RegisterPrivateAgencyController,
	RegisterGovernmentController,
	RegisterStaffController,
	CustomerController,
	UserAdvertiseController,
    SampleUploadController,
};
use App\Http\Controllers\Admin\{
	AdminController,
	OfficeController,
	ParametController,
	UsersController,
	AdvertiseController,
	RoleController,
	PermissionController
};
Route::impersonate();
Route::get('/', [HomeController::class, 'index']);
//Route::get('/login', [HomeController::class, 'index'])->name('login')->middleware('throttle:60,1');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
Route::resources([
	'home' => HomeController::class,
	'register' => RegisterController::class,
	'registerPersonal' => RegisterPersonalController::class,
	'registerStaff' => RegisterStaffController::class,
	'roles' => RoleController::class,
	'permissions' => PermissionController::class
]);
Route::name('register.')->group(function() {
	Route::get('/register/personal/step/2', [RegisterPersonalController::class, 'createPersonalStep2Get'])->name('personal.step2.get');
	Route::post('register/personal/step/2', [RegisterPersonalController::class, 'createPersonalStep2Post'])->name('personal.step2.post');
	Route::get('/register/personal/step/3', [RegisterPersonalController::class, 'createPersonalStep3Get'])->name('personal.step3.get');
	Route::post('register/personal/step/3', [RegisterPersonalController::class, 'createPersonalStep3Post'])->name('personal.step3.post');
	Route::get('/register/personal/step/4', [RegisterPersonalController::class, 'createPersonalStep4Get'])->name('personal.step4.get');
	Route::post('register/personal/step/4', [RegisterPersonalController::class, 'createPersonalStep4Post'])->name('personal.step4.post');
	Route::get('/register/personal/step/5', [RegisterPersonalController::class, 'createPersonalStep5Get'])->name('personal.step5.get');
	Route::post('register/personal/step/5', [RegisterPersonalController::class, 'createPersonalStep5Post'])->name('personal.step5.post');

	Route::get('/register/private/step/2', [RegisterPrivateAgencyController::class, 'createPrivateAgencyStep2Get'])->name('private.step2.get');
	Route::post('register/private/step/2', [RegisterPrivateAgencyController::class, 'createPrivateAgencyStep2Post'])->name('private.step2.post');
	Route::get('/register/private/step/3', [RegisterPrivateAgencyController::class, 'createPrivateAgencyStep3Get'])->name('private.step3.get');
	Route::post('register/private/step/3', [RegisterPrivateAgencyController::class, 'createPrivateAgencyStep3Post'])->name('private.step3.post');
	Route::get('/register/private/step/4', [RegisterPrivateAgencyController::class, 'createPrivateAgencyStep4Get'])->name('private.step4.get');
	Route::post('register/private/step/4', [RegisterPrivateAgencyController::class, 'createPrivateAgencyStep4Post'])->name('private.step4.post');
	Route::get('/register/private/step/5', [RegisterPrivateAgencyController::class, 'createPrivateAgencyStep5Get'])->name('private.step5.get');
	Route::post('register/private/step/5', [RegisterPrivateAgencyController::class, 'createPrivateAgencyStep5Post'])->name('private.step5.post');

	Route::get('/register/gov/step/2', [RegisterGovernmentController::class, 'createGovernmentStep2Get'])->name('gov.step2.get');
	Route::post('register/gov/step/2', [RegisterGovernmentController::class, 'createGovernmentStep2Post'])->name('gov.step2.post');
	Route::get('/register/gov/step/3', [RegisterGovernmentController::class, 'createGovernmentStep3Get'])->name('gov.step3.get');
	Route::post('register/gov/step/3', [RegisterGovernmentController::class, 'createGovernmentStep3Post'])->name('gov.step3.post');
	Route::get('/register/gov/step/4', [RegisterGovernmentController::class, 'createGovernmentStep4Get'])->name('gov.step4.get');
	Route::post('register/gov/step/4', [RegisterGovernmentController::class, 'createGovernmentStep4Post'])->name('gov.step4.post');
	Route::get('/register/gov/step/5', [RegisterGovernmentController::class, 'createGovernmentStep5Get'])->name('gov.step5.get');
	Route::post('register/gov/step/5', [RegisterGovernmentController::class, 'createGovernmentStep5Post'])->name('gov.step5.post');

	Route::post('province/district', [RegisterController::class, 'renderDistrictToHtmlSelect'])->name('district');
	Route::post('province/district/subdistrict', [RegisterController::class, 'renderSubDistrictToHtmlSelect'])->name('subDistrict');
	Route::post('province/subdistrict/postcode', [RegisterController::class, 'getPostCodeBySubDistrict'])->name('postcode');
	Route::post('gov/dept', [RegisterController::class, 'renderGovernmentDeptToHtmlSelect'])->name('department');
	Route::post('search/hospital', [RegisterController::class, 'searchHospitalByName'])->name('hospital');
	Route::post('refresh-captcha', [RegisterController::class, 'refreshCaptcha'])->name('refresh-captcha');
});
Route::middleware(['auth:sanctum', 'verified'])->group(function() {
	Route::resources([
		'customer'=> CustomerController::class,
		'office'=>OfficeController::class,
		'paramet'=>ParametController::class,
		'users'=>UsersController::class,
		'advertise'=>AdvertiseController::class,
        'sampleupload'=>SampleUploadController::class,
	]);
	Route::get('/dashboard', function() {
		return view('dashboard');
	})->name('dashboard');
	Route::name('customer.')->group(function() {
		Route::get('/customer/info/create/order/{order_id}', [CustomerController::class, 'createInfo'])->name('info.create');
		Route::post('customer/info/store/order', [CustomerController::class, 'storeInfo'])->name('info.store');

		Route::get('/customer/parameter/create/order/{order_id}', [CustomerController::class, 'createParameter'])->name('parameter.create');
		Route::post('customer/parameter/personal/store', [CustomerController::class, 'storeParameterPersonal'])->name('parameter.personal.store');
		Route::get('/customer/parameter/personal/edit', [CustomerController::class, 'editParameterPersonal'])->name('parameter.personal.edit');
		Route::post('customer/parameter/personal/update', [CustomerController::class, 'updateParameterPersonal'])->name('parameter.personal.update');
		Route::get('/customer/parameter/personal/delete/id/{id}', [CustomerController::class, 'DestroyParameterPersonal'])->name('parameter.personal.destroy');

		Route::get('/customer/parameter/data/list/detail/{order_detail_id}/type/{threat_type_id}', [CustomerController::class, 'listParameterData'])->name('parameter.data.list');
		Route::get('/customer/parameter/data/store/detail/{order_detail_id}/id/{id}', [CustomerController::class, 'storeParameterData'])->name('parameter.data.store');
		Route::get('/customer/parameter/data/delete/id/{id}', [CustomerController::class, 'DestroyParameterData'])->name('parameter.data.destroy');

		// Route::post('/customer/paramet/store', [CustomerController::class, 'storeParamet'])->name('paramet.store');

		Route::get('/customer/sample/create/order/{order_id}', [CustomerController::class, 'createSample'])->name('sample.create');
		Route::post('customer/sample/store/order/{order_id}', [CustomerController::class, 'storeSample'])->name('sample.store');

		Route::get('/customer/verify/create/order/{order_id}', [CustomerController::class, 'createVerify'])->name('verify.create');
		Route::get('/customer/verify/store/order/{order_id}', [CustomerController::class, 'storeVerify'])->name('verify.store');
	});
	Route::get('/admin/home', [AdminController::class, 'index'])->name('admin.index');
	Route::get('/users/id/{id}/edit',[UsersController::class,'edit'])->name('users.edit');
	Route::get('/users/id/{id}/destroy',[UsersController::class,'destroy'])->name('users.destroy');
	Route::get('/users/id/{id}/allow',[UsersController::class,'allow'])->name('users.allow');
	Route::get('/users/id/{id}/deny',[UsersController::class,'deny'])->name('users.deny');
	Route::get('/office/id/{id}/edit',[OfficeController::class,'edit'])->name('office.edit');
	Route::get('/office/id/{id}/destroy',[OfficeController::class,'destroy'])->name('office.destroy');
	Route::get('/office/id/{id}/allow',[OfficeController::class,'allow'])->name('office.allow');
	Route::get('/office/id/{id}/deny',[OfficeController::class,'deny'])->name('office.deny');
	Route::get('/advertise/id/{id}/edit',[AdvertiseController::class,'edit'])->name('advertise.edit');
	Route::get('/advertise/id/{id}/destroy',[AdvertiseController::class,'destroy'])->name('advertise.destroy');

    Route::get('sample/bio', [SampleUploadController::class, 'bio'])->name('sampleupload.bio');
    Route::get('sample/env', [SampleUploadController::class, 'env'])->name('sampleupload.env');
    Route::post('sample/import', [SampleUploadController::class, 'import']);
});
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
Route::get('/advertise/id/{id}/detail',[AdvertiseController::class,'detail'])->name('advertise.detail');
Route::get('/user/advertise/listall/{listall}',[UserAdvertiseController::class,'listall'])->name('user.advertise.listall');
