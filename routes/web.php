<?php
use Illuminate\Support\Facades\{Route,Artisan};
use App\Http\Controllers\{
	HomeController,
	BoundaryController,
	RegisterController,
	RegisterPersonalController,
	RegisterPrivateAgencyController,
	RegisterGovernmentController,
	RegisterStaffController,
	CustomerController,
	StaffController,
	SampleReceiveController,
	UserAdvertiseController,
	SampleUploadController,
	HospitalController,
	PrintBundleController,
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
Route::get('/catcat', function() {
	Artisan::call('cache:clear');
	return redirect()->back()->with(key: 'success', value: 'ลบ Cache ทั้งหมดแล้ว');
});
Route::controller(HomeController::class)->group(function() {
	Route::get('/', 'index');
	Route::get('/logout', 'logout')->name('logout');
	Route::get('/privacy/policy', 'privacy');
});
Route::resources([
	'home' => HomeController::class,
	'register' => RegisterController::class,
	'registerPersonal' => RegisterPersonalController::class,
	'registerStaff' => RegisterStaffController::class,
	'roles' => RoleController::class,
	'permissions' => PermissionController::class,
]);
Route::name('register.')->group(function() {
	Route::prefix('register/personal')->controller(RegisterPersonalController::class)->group(function() {
		Route::get('/step/2', 'createPersonalStep2Get')->name('personal.step2.get');
		Route::post('step/2', 'createPersonalStep2Post')->name('personal.step2.post');
		Route::get('/step/3', 'createPersonalStep3Get')->name('personal.step3.get');
		Route::post('step/3', 'createPersonalStep3Post')->name('personal.step3.post');
		Route::get('/step/4', 'createPersonalStep4Get')->name('personal.step4.get');
		Route::post('step/4', 'createPersonalStep4Post')->name('personal.step4.post');
		Route::get('/step/5', 'createPersonalStep5Get')->name('personal.step5.get');
		Route::post('step/5', 'createPersonalStep5Post')->name('personal.step5.post');
	});
	Route::prefix('register/private')->controller(RegisterPrivateAgencyController::class)->group(function() {
		Route::get('/step/2', 'createPrivateAgencyStep2Get')->name('private.step2.get');
		Route::post('step/2', 'createPrivateAgencyStep2Post')->name('private.step2.post');
		Route::get('/step/3', 'createPrivateAgencyStep3Get')->name('private.step3.get');
		Route::post('step/3', 'createPrivateAgencyStep3Post')->name('private.step3.post');
		Route::get('/step/4', 'createPrivateAgencyStep4Get')->name('private.step4.get');
		Route::post('step/4', 'createPrivateAgencyStep4Post')->name('private.step4.post');
		Route::get('/step/5', 'createPrivateAgencyStep5Get')->name('private.step5.get');
		Route::post('step/5', 'createPrivateAgencyStep5Post')->name('private.step5.post');
	});
	Route::prefix('register/gov')->controller(RegisterGovernmentController::class)->group(function() {
		Route::get('/step/2', 'createGovernmentStep2Get')->name('gov.step2.get');
		Route::post('step/2', 'createGovernmentStep2Post')->name('gov.step2.post');
		Route::get('/step/3', 'createGovernmentStep3Get')->name('gov.step3.get');
		Route::post('step/3', 'createGovernmentStep3Post')->name('gov.step3.post');
		Route::get('/step/4', 'createGovernmentStep4Get')->name('gov.step4.get');
		Route::post('step/4', 'createGovernmentStep4Post')->name('gov.step4.post');
		Route::get('/step/5', 'createGovernmentStep5Get')->name('gov.step5.get');
		Route::post('step/5', 'createGovernmentStep5Post')->name('gov.step5.post');
	});
	Route::controller(RegisterController::class)->group(function() {
		Route::post('province/district', 'renderDistrictToHtmlSelect')->name('district');
		Route::post('province/district/subdistrict', 'renderSubDistrictToHtmlSelect')->name('subDistrict');
		Route::post('province/subdistrict/postcode', 'getPostCodeBySubDistrict')->name('postcode');
		Route::post('gov/dept', 'renderGovernmentDeptToHtmlSelect')->name('department');
		Route::post('gov/deps/v2', 'renderGovernmentDeptToHtmlSelectV2')->name('department.v2');
		Route::post('search/hospital', 'searchHospitalByName')->name('hospital');
		Route::post('refresh-captcha', 'refreshCaptcha')->name('refresh-captcha');
	});
});
Route::middleware(['auth:sanctum', 'verified'])->group(function() {
	Route::resources([
		'customer' => CustomerController::class,
		'office' => OfficeController::class,
		'paramet' => ParametController::class,
		'users' => UsersController::class,
		'advertise' => AdvertiseController::class,
		'sampleupload' => SampleUploadController::class,
	]);
	Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
	Route::name('boundary.')->controller(BoundaryController::class)->group(function() {
		Route::get('province/district', 'districtToHtmlSelect')->name('fetch.district');
		Route::get('province/district/sub/district', 'subDistrictToHtmlSelect')->name('fetch.sub.district');
		Route::get('province/district/sub/district/postcode', 'postCodeBySubDistrict')->name('fetch.postcode');
	});
	Route::name('hospital.')->group(function() {
		Route::get('hospital/type', [HospitalController::class, 'hospTypeToHtmlSelect'])->name('fetch.type');
	});
	Route::name('customer.')->group(function() {
		Route::prefix('customer/info')->controller(CustomerController::class)->group(function() {
			Route::get('/create/order/{order_id}', 'createInfo')->name('info.create');
			Route::post('store/order', 'storeInfo')->name('info.store');
		});
		Route::prefix('customer/parameter')->controller(CustomerController::class)->group(function() {
			Route::get('/create/order/{order_id}', 'createParameter')->name('parameter.create');
			Route::post('personal/store', 'storeParameterPersonal')->name('parameter.personal.store');
			Route::get('/personal/edit/{order_sample_id}', 'editParameterPersonal')->name('parameter.personal.edit');
			Route::post('personal/update', 'updateParameterPersonal')->name('parameter.personal.update');
			Route::get('/personal/id/{id}/order/{order_id}/delete', 'DestroyParameterPersonal')->name('parameter.personal.destroy');
			Route::get('/sample/{order_sample_id}/type/{threat_type_id}/list', 'listParameterData')->name('parameter.data.list');
			Route::post('store', 'storeParameterData')->name('parameter.data.store');
			Route::get('/{id}/sample/{order_sample_id}/order/{order_id}/delete', 'DestroyParameterData')->name('parameter.data.destroy');
		});
		Route::prefix('customer/sample')->controller(CustomerController::class)->group(function() {
			Route::get('/create/order/{order_id}', 'createSample')->name('sample.create');
			Route::post('store/order/{order_id}', 'storeSample')->name('sample.store');
		});
		Route::prefix('customer/verify')->controller(CustomerController::class)->group(function() {
			Route::get('/create/order/{order_id}', 'createVerify')->name('verify.create');
			Route::post('store/order', 'storeVerify')->name('verify.store');
		});
	});
	Route::name('staff.')->prefix('staff')->controller(StaffController::class)->group(function() {
		Route::get('/home', 'index')->name('index');
		Route::get('/profile', 'profile')->name('profile');
		Route::get('/inbox', 'inbox')->name('inbox');
		Route::get('/inbox/list', 'getInbox')->name('get.inbox');
		Route::get('/calendar', 'calendar')->name('calendar');
	});
	Route::name('sample.')->prefix('sample')->group(function() {
		Route::resource('received', SampleReceiveController::class);
		Route::controller(SampleReceiveController::class)->group(function() {
			Route::get('/received/order/{order_id}/step01', 'step01')->name('received.step01');
			Route::get('/received/order/{order_id}/step02', 'step02')->name('received.step02');
			Route::get('/received/order/{order_id}/step03', 'step03')->name('received.step03');
		});
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
	Route::get('/parameter/id/{id}/edit',[ParametController::class,'edit'])->name('paramet.edit');
	Route::get('/parameter/id/{id}/allow',[ParametController::class,'allow'])->name('paramet.allow');
	Route::get('/parameter/id/{id}/deny',[ParametController::class,'deny'])->name('paramet.deny');

	Route::get('sample/env', [SampleUploadController::class, 'env'])->name('sampleupload.env');
	Route::post('sample/bio/create', [SampleUploadController::class, 'biocreate'])->name('sampleupload.biocreate');
	Route::post('sample/bio/import', [SampleUploadController::class, 'bioimport'])->name('sampleupload.bioimport');
});
Route::get('/user/advertise/id/{id}/detail',[UserAdvertiseController::class,'detail'])->name('user.advertise.detail');
Route::get('/user/advertise/listall/{listall}',[UserAdvertiseController::class,'listall'])->name('user.advertise.listall');
Route::controller(PrintBundleController::class)->group(function() {
	Route::get('/print/sample_receipt', 'index');
});