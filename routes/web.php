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
	CustomerHistoryController,
	StaffController,
	SampleReceiveController,
	SampleAnalyzeController,
	SampleQcController,
	SampleDestroyController,
	UserAdvertiseController,
	SampleUploadController,
	HospitalController,
	PrintBundleController,
	FetchDataController,
	CalendarController
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
		Route::post('province/subdistrict/postcode', 'postCodeBySubDistrict')->name('postcode');
		Route::post('gov/dept', 'renderGovernmentDeptToHtmlSelect')->name('department');
		Route::post('gov/deps/v2', 'renderGovernmentDeptToHtmlSelectV2')->name('department.v2');
		Route::post('search/hospital', 'searchHospitalByName')->name('hospital');
		Route::post('refresh-captcha', 'refreshCaptcha')->name('refresh-captcha');
	});
});
Route::middleware(['auth:sanctum', 'verified'])->group(function() {
	Route::resources([
		'customer' => CustomerController::class,
		'customerHistory' => CustomerHistoryController::class,
		'sampleupload' => SampleUploadController::class,
		'fetchdata' => FetchDataController::class,
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
			Route::get('/create/order/{order_id}/type/{order_type}', 'createInfo')->name('info.create');
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
		Route::get('/inbox', 'inbox')->name('inbox');
		Route::get('/inbox/list', 'getInbox')->name('get.inbox');
		Route::get('/calendar', 'calendar')->name('calendar');
	});
	Route::resource('calendar', CalendarController::class)->except(['update', 'destroy']);
	Route::name('calendar.')->prefix('calendar')->controller(CalendarController::class)->group(function() {
		Route::post('/update/id/{id}', 'update')->name('update');
		Route::post('/delete/id/{id}', 'destroy')->name('destroy');
	});
	Route::name('sample.')->prefix('sample')->group(function() {
		Route::resource('received', SampleReceiveController::class);
		Route::controller(SampleReceiveController::class)->prefix('received/order')->group(function() {
			Route::get('/{order_id}/step01', 'step01')->name('received.step01');
			Route::post('step01', 'step01Post')->name('received.step01.post');
			Route::get('/{order_id}/step02', 'step02')->name('received.step02');
			Route::post('step02', 'step02Post')->name('received.step02.post');
			Route::get('/{order_id}/step03', 'step03')->name('received.step03');
			Route::post('step04', 'step03Post')->name('received.step03.post');
			Route::get('/{order_id}/print', 'print')->name('received.print');
			Route::get('/lab/number/search', 'searchOrderSampleByLabNo')->name('search.by.lab.no');
			Route::get('/test/number/create', 'createTestNo')->name('received.test.no.create');
			Route::post('test/number/set', 'setTestNo')->name('received.test.no.set');
			Route::post('test/number/barcode', 'printTestNoBarcode')->name('received.test.no.barcode');
			Route::get('/lab/number/search/print/barcode', 'searchOrderSampleForPrintBarcode')->name('search.for.print.barcode');
			Route::get('/requisition/create', 'createRequisition')->name('received.requisition.create');
			Route::post('requisition/create/ajax', 'createRequisitionAjax')->name('received.requisition.create.ajax');
			Route::post('requisition/update', 'updateRequisition')->name('received.requisition.update');
			Route::post('requisition/print', 'printRequisition')->name('received.requisition.print');
			Route::get('/report/create', 'createReport')->name('received.report.create');
			Route::post('report/create/ajax', 'createReportAjax')->name('received.report.create.ajax');
			Route::get('/report/lab/{lab_no}/analys_user/{analys_user}/print', 'printReport')->name('received.report.print');
			Route::get('/return/create', 'createReturn')->name('received.return.create');
			Route::post('return/parcel/post/modal/create', 'createParcelPostModal')->name('received.return.parcel.post.modal.create');
			Route::post('return//parcel/post/modal/store', 'storeParcelPostModal')->name('received.return.parcel.post.modal.store');
			Route::post('return/create/ajax', 'createReturnAjax')->name('received.return.create.ajax');
		});
		Route::resource('analyze', SampleAnalyzeController::class);
		Route::controller(SampleAnalyzeController::class)->prefix('analyze')->group(function() {
			Route::get('/select/lab/no/{lab_no}/order/{id}/user/{user_id}', 'sampleSelect')->name('analyze.select');
			Route::get('/select/order/{id}/user{user_id}', 'sampleSelectDt')->name('analyze.select.dt');
			Route::get('/reserve/paramet/reserve', 'sampleReserve')->name('analyze.reserve');
			Route::prefix('result/lab')->group(function() {
				Route::get('/no/{lab_no}/order/{id}/user/{user_id}/create', 'labResultCreate')->name('analyze.lab.result.create');
				Route::post('result/save', 'labResultSave')->name('analyze.lab.result.save');
				Route::post('result/upload/create', 'labResultUploadFileModal')->name('analyze.lab.result.upload.create');
				Route::post('result/upload/file', 'labResultUploadFile')->name('analyze.lab.result.upload.file');
				Route::post('result/comment/create', 'labResultCommentModal')->name('analyze.lab.result.comment.create');
				Route::post('result/comment', 'labResultComment')->name('analyze.lab.result.comment');
				Route::post('result/upload/chart/create', 'analyzeResultUploadFileModal')->name('analyze.result.upload.file.create');
				Route::post('result/upload/chart', 'analyzeResultUploadFile')->name('analyze.result.upload.file');
				Route::post('result/view/crete', 'analyzeResultViewModal')->name('analyze.result.view.create');
				Route::post('result/view', 'analyzeResultView')->name('analyze.result.view');
			});
		});
		Route::resource('qc', SampleQcController::class);
		Route::controller(SampleQcController::class)->prefix('qc')->group(function() {
			Route::get('/list/data/order_id/{order_id}/lab_no/{lab_no}/order_status/{order_status}/tm_verify/{tm_verify}', 'listDataByLabNo')->name('qc.list.data');
			Route::get('/list/data/lab_no/{lab_no}/datatable', 'listDataByLabNoToDataTable')->name('qc.list.data.dt');
			Route::post('modal/show/result', 'showResultModal')->name('qc.result.modal');
			Route::post('modal/show/result/curve/file', 'showCurveAndQcResultModal')->name('qc.result.modal.curve');
			Route::post('modal/show/result/all', 'showAllResultModal')->name('qc.result.modal.all');
			Route::post('approved', 'approved')->name('qc.approved');
			Route::post('reject', 'reject')->name('qc.reject');
		});
		Route::controller(SampleDestroyController::class)->prefix('destroy')->group(function() {
			Route::get('/order/approve/show', 'showApproveOrder')->name('destroy.order.approve.show');
			Route::post('order/approve/store', 'storeApproveOrder')->name('destroy.order.approve.store');
			Route::get('/order/show', 'showDestroyOrder')->name('destroy.order.show');
			Route::post('order/show/store', 'storeDestroyOrder')->name('destroy.order.store');
		});
	});

	Route::prefix('admin')->group(function() {
		Route::resources([
			'users' => UsersController::class,
			'office' => OfficeController::class,
			'advertise' => AdvertiseController::class,
			'paramet' => ParametController::class,
		]);
		Route::get('home', [AdminController::class, 'index'])->name('admin.index');
		Route::controller(UsersController::class)->group(function() {
			Route::get('/users/id/{id}/edit', 'edit')->name('users.edit');
			Route::get('/users/id/{id}/allow', 'allow')->name('users.allow');
		});
	});
	Route::get('/users/id/{id}/destroy',[UsersController::class,'destroy'])->name('users.destroy');
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
	Route::post('sample/env/import', [SampleUploadController::class, 'envimport'])->name('sampleupload.envimport');
	// Route::post('sample/bio/create', [SampleUploadController::class, 'biocreate'])->name('sampleupload.biocreate');
	Route::post('sample/bio/import', [SampleUploadController::class, 'bioimport'])->name('sampleupload.bioimport');
	Route::post('fetchdata/sampletype', [FetchDataController::class, 'sampleType'])->name('fetchdata.sampletype');
	Route::post('fetchdata/parameter', [FetchDataController::class, 'parameter'])->name('fetchdata.parameter');
	Route::post('fetchdata/district', [FetchDataController::class, 'district'])->name('fetchdata.district');
	Route::post('fetchdata/subdistrict', [FetchDataController::class, 'subDistrict'])->name('fetchdata.subdistrict');
	Route::post('fetchdata/datafetch', [FetchDataController::class, 'dataFetch'])->name('fetchdata.datafetch');
});

Route::get('/user/advertise/id/{id}/detail',[UserAdvertiseController::class,'detail'])->name('user.advertise.detail');
Route::get('/user/advertise/listall/{listall}',[UserAdvertiseController::class,'listall'])->name('user.advertise.listall');
Route::controller(PrintBundleController::class)->group(function() {
	Route::get('/print/sample_receipt', 'receipt');
	Route::get('/print/bank_payment', 'payment');
	Route::get('/print/sample_env_report', 'envreport');
});

