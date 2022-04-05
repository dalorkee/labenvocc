<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,Log,Storage,File};
use App\Models\{Order,OrderDetail,Fileupload,OrderDetailParameter,Parameter,User,UserCustomer};
use App\DataTables\{CustomersDataTable,CustParameterDataTable,CustSampleDataTable,CustVerifyDataTable};
use App\Traits\{CustomerTrait,FileTrait,CommonTrait,JsonBoundaryTrait};
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
	private object $user;
	private string $user_role;

	use CustomerTrait, FileTrait, CommonTrait, JsonBoundaryTrait;

	public function __construct() {
		$this->middleware('auth');
		$this->middleware(['role:root|admin|customer']);
		$this->middleware(function($request, $next) {
			$this->user = Auth::user();
			$user_role_arr = $this->user->roles->pluck('name')->all();
			$this->user_role = $user_role_arr[0];
			return $next($request);
		});
	}

	#[Route('customer.index', methods: ['RESOURCE'])]
	protected function index(CustomersDataTable $dataTable, $user_id=0): object {
		return $dataTable->with('user_id', $this->user->id)->render('apps.customers.index');
	}

	#[Route('customer.info.create', methods: ['GET'])]
	protected function createInfo(Request $request): object {
		try {
			$type_of_work = $this->typeOfWork();
			$titleName = $this->titleName();
			if ($request->order_id == 'new') {
				$order = null;
			} else {
				$order = Order::whereId($request->order_id)->with('uploads')->get();
			}
			return view('apps.customers.info', ['type_of_work' => $type_of_work, 'order' => $order, 'titleName' => $titleName]);
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->route('logout');
		}
	}

	#[Route('customer.info.store', methods: ['POST'])]
	protected function storeInfo(Request $request) {
		try {
			$order = Order::updateOrCreate(
				['id' => $request->order_id],
				[
					'customer_type' => $this->user->userCustomer->customer_type,
					'user_id' => $this->user->userCustomer->user->id,
					'order_status' => 'pending',
					'payment_status' => 'pending',
					'type_of_work' => $request->type_of_work,
					'type_of_work_other' => $request->type_of_work_other,
					'book_no' => $request->book_no ?? null,
					'book_date' => $this->convertJsDateToMySQL($request->book_date) ?? null,
					'book_upload' => ($request->hasFile('book_file')) ? 'y' : 'n'
				]
			);
			$last_insert_order_id = $order->id;
			if ($request->hasFile('book_file')) {
				/* Delete older files */
				FileUpload::select('id', 'file_name')->whereOrder_id($request->order_id)->whereRef_user_id($this->user->id)->each(function($item, $key) {
					if (Storage::disk('uploads')->exists($item->file_name)) {
						FileUpload::find($item->id)->delete();
						Log::warning($this->user->userCustomer->first_name.' ลบไฟล์หนังสือนำส่ง [id:'.$item->id.']');
					}
				});
				/* Create new file */
				$file = $request->file('book_file');
				$file_mime = $file->getMimeType();
				$file_size_byte = $file->getSize();
				$file_size = ($file_size_byte/1024);
				$file_name = $file->getClientOriginalName();
				$file_extension = $file->extension();
				$new_name = $this->renameFile('cust_book', $this->user->userCustomer->user->id, $file_extension);
				$uploaded = Storage::disk('uploads')->put($new_name, File::get($file));
				if ($uploaded) {
					$file_upload = new FileUpload;
					$file_upload->ref_user_id = $this->user->id;
					$file_upload->order_id = $last_insert_order_id;
					$file_upload->old_file_name = $file_name;
					$file_upload->file_name = $new_name;
					$file_upload->file_mime = $file_mime;
					$file_upload->file_path = '/uploads';
					$file_upload->file_size = $file_size;
					$file_upload->note = 'หนังสือนำส่ง';
					$file_upload->save();
					Log::notice($this->user->userCustomer->first_name.' อับโหลดไฟล์หนังสือนำส่ง '.$new_name);
				} else {
					Log::warning($this->user->userCustomer->first_name.' อับโหลดไฟล์หนังสือนำส่งไม่สำเร็จ');
				}
			}
			if ($order == true) {
				return redirect()->route('customer.info.create', ['order_id' => $last_insert_order_id])->with(['success' => 'บันทึกร่าง "ข้อมูลทั่วไป" สำเร็จ']);
			} else {
				return redirect()->back()->with('error', 'บันทึกร่าง "ข้อมูลทั่วไป" ผิดพลาด โปรดตรวจสอบ');
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->route('customer.index')->with('error', $e->getMessage());
		}
	}

	#[Route('customer.parameter.create', methods: ['GET'])]
	protected function createParameter(Request $request, CustParameterDataTable $dataTable): object {
		try {
			$order_id = $request->order_id;
			$count_status_rows = OrderDetail::whereOrder_id($order_id)->whereSample_status('y')->whereParameter_status('y')->count();
			return $dataTable->render('apps.customers.parameter', compact('order_id', 'count_status_rows'));
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->route('customer.index')->with('error', $e->getMessage());
		}
	}

	#[Route('customer.parameter.personal.store', methods: ['POST'])]
	protected function storeParameterPersonal(Request $request) {
		$request->validate([
			'order_id'=>'bail|required',
			'id_card'=>'required',
			'title_name'=>'required',
			'firstname'=>'required',
			'lastname'=>'required',
			'sample_date'=>'required',
		],[
			'order_id.required'=>'ไม่พบรหัสคำสั่งซื้ัอ โปรดตรวจสอบ',
			'id_card.required'=>'โปรดกรอกเลขบัตรประชาชน',
			'title_name.required'=>'โปรดกรอกคำนำหน้าชื่อ',
			'firstname.required'=>'โปรดกรอกชื่อ',
			'lastname.required'=>'โปรดกรอกนามสกุล',
			'sample_date.required'=>'โปรดกรอกวันที่เก็บตัวอย่าง',
		]);
		try {
			$orderDetail = new OrderDetail;
			$orderDetail->order_id = $request->order_id;
			$orderDetail->id_card = $request->id_card;
			$orderDetail->passport = $request->passport;
			$orderDetail->title_name = $request->title_name;
			$orderDetail->firstname = $request->firstname;
			$orderDetail->lastname = $request->lastname;
			$orderDetail->age_year = $request->age_year;
			$orderDetail->division = $request->division;
			$orderDetail->work_life_year = $request->work_life_year;
			$orderDetail->sample_date = $this->convertJsDateToMySQL($request->sample_date);
			$orderDetail->note = $request->note;
			$saved = $orderDetail->save();
			$last_insert_id = $orderDetail->id;
			if ($saved == true) {
				return redirect()->back()->with('success', 'บันทึกข้อมูลแล้ว');
			} else {
				return redirect()->back()->with('error', 'ไม่สามารถบันทึกข้อมูลได้');
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	#[Route('customer.parameter.personal.edit', methods: ['GET'])]
	protected function editParameterPersonal(Request $request) {
		$order_detail = OrderDetail::find($request->id);
		switch ($order_detail->title_name) {
			case "mr":
				$mr_chk = "checked";
				$mrs_chk = null;
				$miss_chk = null;
				break;
			case "mrs":
				$mr_chk = null;
				$mrs_chk = "checked";
				$miss_chk = null;
				break;
			case "miss":
				$mr_chk = null;
				$mrs_chk = null;
				$miss_chk = "checked";
				break;
			default:
				$mr_chk = null;
				$mrs_chk = null;
				$miss_chk = null;
		}
		$edit_sample_date = $this->convertMySQLDateToJs($order_detail->sample_date);
		$htm = "
		<form name=\"modal_new_data\" action=\"".route('customer.parameter.personal.update')."\" method=\"POST\">
		<div class=\"modal-header bg-red-500 text-white\">
			<h5 class=\"modal-title\"><i class=\"fal fa-pencil\"></i> แก้ไขข้อมูล รหัส ".$request->id."</h5>
			<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
				<span aria-hidden=\"true\"><i class=\"fal fa-times\"></i></span>
			</button>
		</div>
		<div class=\"modal-body\">
			<div class=\"form-row\">
				<div class=\"form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3\">
					<label class=\"form-label\" for=\"title_name\">คำนำหน้าชื่อ <span class=\"text-red-600\">*</span></label>
					<input type=\"hidden\" name=\"_token\" value=\"".csrf_token()."\">
					<input type=\"hidden\" name=\"edit_id\" value=\"".$order_detail->id."\">
					<input type=\"hidden\" name=\"edit_order_id\" value=\"".$order_detail->order_id."\">
					<div class=\"frame-wrap\">
						<div class=\"custom-control custom-checkbox custom-control-inline\">
							<input type=\"checkbox\" name=\"edit_title_name\" value=\"mr\" class=\"custom-control-input\" id=\"edit_chk_mr\"".$mr_chk.">
							<label class=\"custom-control-label\" for=\"edit_chk_mr\">นาย</label>
						</div>
						<div class=\"custom-control custom-checkbox custom-control-inline\">
							<input type=\"checkbox\" name=\"edit_title_name\" value=\"mrs\" class=\"custom-control-input\" id=\"edit_chk_mrs\"".$mrs_chk.">
							<label class=\"custom-control-label\" for=\"edit_chk_mrs\">นาง</label>
						</div>
						<div class=\"custom-control custom-checkbox custom-control-inline\">
							<input type=\"checkbox\" name=\"edit_title_name\" value=\"miss\" class=\"custom-control-input\" id=\"edit_chk_miss\"".$miss_chk.">
							<label class=\"custom-control-label\" for=\"edit_chk_miss\">นางสาว</label>
						</div>
					</div>
				</div>
			</div>
			<div class=\"form-row\">
				<div class=\"form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3\">
					<label class=\"form-label\" for=\"id_card\">เลขบัตรประชาชน <span class=\"text-red-600\">*</span></label>
					<input type=\"text\" name=\"edit_id_card\" value=\"".$order_detail->id_card."\" placeholder=\"\" data-inputmask=\"'mask': '9-9999-99999-99-9'\" maxlength=\"18\" class=\"form-control\">
				</div>
				<div class=\"form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3\">
					<label class=\"form-label\" for=\"passport\">พาสปอร์ต</label>
					<input type=\"text\" name=\"edit_passport\" value=\"".$order_detail->passport."\" maxlength=\"30\" class=\"form-control\">
				</div>
				<div class=\"form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3\">
					<label class=\"form-label\" for=\"firstname\">ชื่อ <span class=\"text-red-600\">*</span></label>
					<input type=\"text\" name=\"edit_firstname\" value=\"".$order_detail->firstname."\" class=\"form-control\">
				</div>
				<div class=\"form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3\">
					<label class=\"form-label\" for=\"lastname\">นามสกุล <span class=\"text-red-600\">*</span></label>
					<input type=\"text\" name=\"edit_lastname\" value=\"".$order_detail->lastname."\" class=\"form-control\">
				</div>
				<div class=\"form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3\">
					<label class=\"form-label\" for=\"age_year\">อายุ/ปี</label>
					<input type=\"number\" name=\"edit_age_year\" value=\"".$order_detail->age_year."\" min=\"1\" max=\"100\" class=\"form-control\">
				</div>";
				if (Auth::user()->userCustomer->customer_type == 'private') {
					$htm .= "
					<div class=\"form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3\">
						<label class=\"form-label\" for=\"division\">แผนก <span class=\"text-red-600\">*</span></label>
						<input type=\"text\" name=\"edit_division\" value=\"".$order_detail->division."\" class=\"form-control\">
					</div>
					<div class=\"form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3\">
						<label class=\"form-label\" for=\"work_life_year\">อายุงาน/ปี <span class=\"text-red-600\">*</span></label>
						<input type=\"number\" name=\"edit_work_life_year\" value=\"".$order_detail->work_life_year."\" min=\"1\" max=\"100\" class=\"form-control\">
					</div>";
				}
				$htm .= "
				<div class=\"form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3\">
					<label class=\"form-label\" for=\"edit_sample_date\">วันที่เก็บตัวอย่าง <span class=\"text-red-600\">*</span></label>
					<div class=\"input-group\">
						<input type=\"text\" name=\"edit_sample_date\" value=\"".$edit_sample_date."\" class=\"form-control\" placeholder=\"เลือกวันที่\" id=\"datepicker_edit_specimen_date\" readonly>
						<div class=\"input-group-append\">
							<span class=\"input-group-text fs-xl\">
								<i class=\"fal fa-calendar-alt\"></i>
							</span>
						</div>
					</div>
				</div>
				<div class=\"form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3\">
					<label class=\"form-label\" for=\"note\">หมายเหตุ</label>
					<input type=\"text\" name=\"edit_note\" value=\"".$order_detail->note."\" class=\"form-control\">
				</div>
			</div>
		</div>
		<div class=\"modal-footer\">
				<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">ยกเลิก</button>
				<button type=\"submit\" class=\"btn btn-danger\">แก้ไขข้อมูล</button>
			</div>
		</form>";
		return $htm;
	}

	#[Route('customer.parameter.personal.update', methods: ['POST'])]
	protected function updateParameterPersonal(Request $request) {
		$request->validate([
			'edit_order_id'=>'bail|required',
			'edit_id_card'=>'required',
			'edit_title_name'=>'required',
			'edit_firstname'=>'required',
			'edit_lastname'=>'required',
			'edit_sample_date'=>'required',
		],[
			'edit_order_id.required'=>'ไม่พบรหัสคำสั่งซื้ัอ โปรดตรวจสอบ',
			'edit_id_card.required'=>'โปรดกรอกเลขบัตรประชาชน',
			'edit_title_name.required'=>'โปรดกรอกคำนำหน้าชื่อ',
			'edit_firstname.required'=>'โปรดกรอกชื่อ',
			'edit_lastname.required'=>'โปรดกรอกนามสกุล',
			'edit_sample_date.required'=>'โปรดกรอกวันที่เก็บตัวอย่าง',
		]);
		try {
			$orderDetail = OrderDetail::find($request->edit_id);
			$orderDetail->order_id = $request->edit_order_id;
			$orderDetail->id_card = $request->edit_id_card;
			$orderDetail->passport = $request->edit_passport;
			$orderDetail->title_name = $request->edit_title_name;
			$orderDetail->firstname = $request->edit_firstname;
			$orderDetail->lastname = $request->edit_lastname;
			$orderDetail->age_year = $request->edit_age_year;
			$orderDetail->division = $request->edit_division;
			$orderDetail->work_life_year = $request->edit_work_life_year;
			$orderDetail->sample_date = $this->convertJsDateToMySQL($request->edit_sample_date);
			$orderDetail->note = $request->edit_note;
			$saved = $orderDetail->save();
			if ($saved == true) {
				return redirect()->back()->with('success', 'แก้ไขข้อมูลแล้ว');
			} else {
				return redirect()->back()->with('error', 'ไม่สามารถแก้ไขข้อมูลได้');
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	#[Route('customer.parameter.personal.destroy', methods: ['GET'])]
	protected function DestroyParameterPersonal(OrderDetail $orderDetail, Request $request): object {
		try {
			$deleted = $orderDetail->find($request->id)->delete();
			if ($deleted == true) {
				return redirect()->back()->with('destroy', 'ลบข้อมูลตัวอย่างแล้ว');
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	#[Route('customer.parameter.data.list', methods: ['GET'])]
	protected function listParameterData(Request $request): object {
		try {
			if ($request->ajax()) {
				$data = Parameter::query()
					->when($request->threat_type_id <= 0, function($q) {
						return $q->orderBy('id', 'ASC')->get();
					})
					->when($request->threat_type_id > 0, function($q) use ($request) {
						return $q->whereThreat_type_id($request->threat_type_id)->orderBy('id', 'ASC')->get();
					});
				return DataTables::of($data)
					// ->addIndexColumn()
					// ->addColumn('select_paramet', static function ($row) {
					// 	return '<input type="checkbox" name="paramets[]" value="'.$row->id.'"/>';
					// })
					// ->addColumn('action', function($row) use ($request) {
					// 	$actionBtn = "<a href=\"".route('customer.parameter.data.store', ['order_detail_id'=>$request->order_detail_id, 'id'=>$row->id])."\" class=\"btn btn-danger btn-sm\"><i class=\"fal fa-plus\"></i></a>";
					// 	return $actionBtn;
					// })
					// ->rawColumns(['select_paramet', 'action'])
					->make(true);
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	#[Route('customer.parameter.data.store', method: ['POST'])]
	protected function storeParameterData(Request $request): object {
		try {
			$paramet_arr = $request->paramet_id_arr;
			$i = 0;
			foreach ($paramet_arr as $key => $val) {
				$paramet = Parameter::findOrfail($val);
				$upserted = OrderDetailParameter::updateOrcreate([
						'order_detail_id' => $request->aj_order_detail_id,
						'parameter_id' => $paramet->id],[
						'parameter_id' => $paramet->id,
						'parameter_name' => $paramet->parameter_name,
						'sample_charecter_id'=> $paramet->sample_charecter_id,
						'sample_charecter_name' => $paramet->sample_charecter_name,
						'sample_type_id' => $paramet->sample_type_id,
						'sample_type_name' => $paramet->sample_type_name,
						'unit_id' => $paramet->unit_id,
						'unit_name' => $paramet->unit_name,
						'unit_customer_name' => $paramet->unit_customer_name,
						'price_id' => $paramet->price_id,
						'price_name' => $paramet->price_name,
						'main_analys_user_id' => $paramet->main_analys_user_id,
						'main_analys_name' => $paramet->main_analys_name,
						'sub_analys_user_id' => $paramet->sub_analys_user_id,
						'sub_analys_name' => $paramet->sub_analys_name,
						'control_analys_user_id' => $paramet->control_analys_user_id,
						'control_analys_name' => $paramet->control_analys_name,
						'technical_id' => $paramet->technical_id,
						'technical_name' => $paramet->technical_name,
						'method_analys_id' => $paramet->method_analys_id,
						'method_analys_name' => $paramet->method_analys_name,
						'machine_id' => $paramet->machine_id,
						'machine_name' => $paramet->machine_name,
						'office_id' => $paramet->office_id,
						'office_name' => $paramet->office_name
					]);
				$i++;
			}
			if ($i > 0) {
				return redirect()->back()->with('success', 'บันทึกข้อมูลพารามิเตอร์แล้ว');
			} else {
				return redirect()->back()->with('error', 'ไม่มีข้อมูลใหม่สำหรับรายการนี้');
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with('error', 'บันทึกพารามิเตอร์ไม่ได้ โปรดตรวจสอบ');
		}
	}

	#[Route('customer.parameter.data.destroy', methods: ['GET'])]
	protected function destroyParameterData(OrderDetailParameter $orderDetailParamet, Request $request): object {
		try {
			$deleted = $orderDetailParamet->find($request->id)->delete();
			if ($deleted == true) {
				return redirect()->back()->with('destroy', 'ลบข้อมูลพารามิเตอร์แล้ว');
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	#[Route('customer.sample.create', methods: ['GET'])]
	protected function createSample(CustSampleDataTable $dataTable, Request $request) {
		//$order_detail = OrderDetail::select('id')->whereOrder_id($request->order_id)->whereCompleted('y')->get();

		$order_detail = OrderDetail::select('id')->whereOrder_id($request->order_id)->whereSample_status('y')->whereParameter_status('y')->get();
		$sample_list = [];
		$order_detail->each(function($value, $key) use (&$sample_list) {
			$sample_list[$key] = $value->id;
		});
		$sample_charecter = $this->getSampleCharecter();
		$provinces = $this->getMinProvince();
		$data = [
			'order_id' => $request->order_id,
			'sample_list' => $sample_list,
			'sample_charecter' => $sample_charecter,
			'provinces' => $provinces
		];
		return $dataTable->render('apps.customers.sample', ['data'=> $data]);
	}

	#[Route('customer.sample.store', methods: ['POST'])]
	protected function storeSample(Request $request): object {
		$request->validate([
			'sample_charecter'=>'bail|required',
		],[
			'sample_charecter.required'=>'โปรดเลือกประเด็นมลพิษ',
		]);
		try {
			if ($request->sample_select_begin > $request->sample_select_end) {
				return redirect()->back()->with('warning', 'เลือกข้อมูลตัวอย่างไม่ถูกต้อง โปรดตรวจสอบ');
			} else {
				$saved = false;
				switch ($this->user->userCustomer->customer_type) {
					case 'personal':
						switch ($request->sample_place_type) {
							case 1:
								$userDetail = User::find($request->user_id)->userCustomer;
								for ($i=$request->sample_select_begin; $i<=$request->sample_select_end; $i++) {
									$orderDetail = OrderDetail::find($i);
									if (!is_null($orderDetail)) {
										$orderDetail->sample_charecter = $request->sample_charecter;
										$orderDetail->sample_location_define = $request->sample_location_define;
										$orderDetail->sample_location_place_id = $userDetail->sample_location_place_id;
										$orderDetail->sample_location_place_name = $userDetail->sample_location_place_name;
										$orderDetail->sample_location_place_address = $userDetail->sample_location_place_address;
										$orderDetail->sample_location_place_sub_district = $userDetail->sample_location_place_sub_district;
										$orderDetail->sample_location_place_district = $userDetail->sample_location_place_district;
										$orderDetail->sample_location_place_province = $userDetail->sample_location_place_province;
										$orderDetail->sample_location_place_postal = $userDetail->sample_location_place_postal;
										$saved = $orderDetail->save();
									}
								}
								break;
							case 2:
								for ($i=$request->sample_select_begin; $i<=$request->sample_select_end; $i++) {
									$orderDetail = OrderDetail::find($i);
									if (!is_null($orderDetail)) {
										$orderDetail->sample_charecter = $request->sample_charecter;
										$orderDetail->sample_location_define = $request->sample_location_define;
										$orderDetail->sample_location_place_id = $request->sample_location_place_id;
										$orderDetail->sample_location_place_name = $request->sample_location_place_name;
										$orderDetail->sample_location_place_address = $request->sample_location_place_address;
										$orderDetail->sample_location_place_sub_district = $request->sample_location_place_sub_district;
										$orderDetail->sample_location_place_district = $request->sample_location_place_district;
										$orderDetail->sample_location_place_province = $request->sample_location_place_province;
										$orderDetail->sample_location_place_postal = $request->sample_location_place_postal;
										$saved = $orderDetail->save();
									}
								}
								break;
							default:
								return redirect()->route('logout');
								break;
						}
						break;
					}
				// switch ($request->sample_place_type) {
				// 	case 1:
				// 		$userDetail = User::find($request->user_id)->userCustomer;
				// 		for ($i=$request->sample_select_begin; $i<=$request->sample_select_end; $i++) {
				// 			$orderDetail = OrderDetail::find($i);
				// 			if (!is_null($orderDetail)) {
				// 				$orderDetail->sample_charecter = $request->sample_charecter;
				// 				$orderDetail->sample_place_type = $request->sample_place_type;
				// 				$orderDetail->sample_office_category = $request->sample_office_category;
				// 				$orderDetail->sample_office_id = $userDetail->office_code;
				// 				$orderDetail->sample_office_name = $userDetail->office_name;
				// 				$orderDetail->sample_office_addr = $userDetail->office_address;
				// 				$orderDetail->sample_office_sub_district = $userDetail->office_sub_district;
				// 				$orderDetail->sample_office_district = $userDetail->office_district;
				// 				$orderDetail->sample_office_province = $userDetail->office_province;
				// 				$orderDetail->sample_office_postal = $userDetail->office_postal;
				// 				$saved = $orderDetail->save();
				// 			}
				// 		}
				// 		break;
				// 	case 2:
				// 		for ($i=$request->sample_select_begin; $i<=$request->sample_select_end; $i++) {
				// 			$orderDetail = OrderDetail::find($i);
				// 			if (!is_null($orderDetail)) {
				// 				$orderDetail->sample_charecter = $request->sample_charecter;
				// 				$orderDetail->sample_place_type = $request->sample_place_type;
				// 				$orderDetail->sample_office_category = $request->sample_office_category;
				// 				$orderDetail->sample_office_id = $request->sample_office_id;
				// 				$orderDetail->sample_office_name = $request->sample_office_name;
				// 				$orderDetail->sample_office_addr = $request->sample_office_addr;
				// 				$orderDetail->sample_office_sub_district = $request->sample_office_sub_district;
				// 				$orderDetail->sample_office_district = $request->sample_office_district;
				// 				$orderDetail->sample_office_province = $request->sample_office_province;
				// 				$orderDetail->sample_office_postal = $request->sample_office_postal;
				// 				$saved = $orderDetail->save();
				// 			}
				// 		}
				// 		break;
				// 	default:
				// 		return redirect()->route('logout');
				// 		break;
				// }
				if ($saved == true) {
					return redirect()->back()->with('success', 'บันทึกข้อมูล "ประเด็นมลพิษ" แล้ว');
				} else {
					return redirect()->back()->with('error', 'บันทึกข้อมูลไม่สมบูรณ์ โปรดตรวจสอบ');
				}
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	#[Route('customer.verify.create', methods: ['GET'])]
	protected function createVerify(Request $request, CustVerifyDataTable $dataTable) {
		try {
			$sample_list = array();
			OrderDetail::select('id')->whereOrder_id($request->order_id)->whereCompleted('y')->get()->each(function($value, $key) use (&$sample_list) {
				$sample_list[$key] = $value->id;
			});

			$sample_charecter = $this->getSampleCharecter();
			$type_of_work = $this->typeOfWork();
			$provinces = $this->getMinProvince();
			$order = Order::whereId($request->order_id)->with('uploads')->get();
			$data = [
				'order_id' => $request->order_id,
				'order' => $order,
				'sample_list' => $sample_list,
				'sample_charecter' => $sample_charecter,
				'type_of_work' => $type_of_work,
				'provinces' => $provinces
			];
			return $dataTable->render('apps.customers.verify', ['data'=> $data]);
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	#[Route('customer.verify.store', methods: ['GET'])]
	protected function storeVerify(Request $request) {
		try {
			dd($request->order_id);
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	// protected function storeParamet(Request $request) {
	// 	dd($request->paramets);
	// 	$x = "";
	// 	foreach ($request->paramets as $key => $val) {
	// 		$x .= $val.' ';
	// 	}
	// 	return redirect()->back()->with("success", 'isad');
	// }
}
