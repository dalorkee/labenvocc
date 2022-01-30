<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,Log,Storage,File};
//use Spatie\Permission\Models\{Role,Permission};
//use Illuminate\Routing\Redirector;
//use Livewire\Controllers\FileUploadHandler;
//use App\Traits\CommonTrait as TraitsCommonTrait;
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
	protected function index(CustomersDataTable $dataTable, $user_id=0): object {
		$user_id = $this->user->id;
		return $dataTable->with('id', $user_id)->render('apps.customers.index');
	}
	protected function createInfo(Request $request): object {
		$type_of_work = $this->typeOfWork();
		$titleName = $this->titleName();
		if ($request->order_id == 'new') {
			$order = null;
		 } else {
			 $order = Order::whereId($request->order_id)->with('uploads')->get();
		 }
		return view('apps.customers.info', ['type_of_work' => $type_of_work, 'order' => $order, 'titleName' => $titleName]);
	}
	protected function storeInfo(Request $request) {
		try {
			switch ($this->user->userCustomer->customer_type) {
				case 'personal':
					$order = Order::updateOrCreate(['id' => $request->order_id], [
						'customer_type' => $this->user->userCustomer->customer_type,
						'ref_user_id' => $this->user->userCustomer->user->id,
						'order_status' => 'pending',
						'payment_status' => 'pending',
						'type_of_work' => $request->type_of_work,
						'type_of_work_other' => $request->type_of_work_other,
						'book_no' => $request->book_no ?? null,
						'book_date' => $this->convertJsDateToMySQL($request->book_date) ?? null,
						'book_upload' => ($request->hasFile('book_file')) ? 'y' : 'n'
					]);
					break;
				// case 'private':
				// 	$order = Order::updateOrCreate(
				// 		['id' => $request->order_id],
				// 		[
				// 			'order_type' => $this->user->userCustomer->customer_type,
				// 			'ref_user_id' => $this->user->userCustomer->user->id,
				// 			'order_status' => 'pending',
				// 			'payment_status' => 'pending',
				// 			'ref_agency_code' => $this->user->userCustomer->agency_code,
				// 			'ref_agency_name' => $this->user->userCustomer->agency_name,
				// 			'type_of_work' => $request->type_of_work,
				// 			'type_of_work_other' => $request->type_of_work_other,
				// 			'book_no' => $request->book_no,
				// 			'book_date' => $this->convertJsDateToMySQL($request->book_date),
				// 			'book_upload' => ($request->hasFile('book_file')) ? 'y' : 'n'
				// 		]
				// 	);
				// 	break;
				// case 'government':
				// 	$order = Order::updateOrCreate(
				// 		['id' => $request->order_id],
				// 		[
				// 			'order_type' => $this->user->userCustomer->customer_type,
				// 			'ref_user_id' => $this->user->userCustomer->user->id,
				// 			'order_status' => 'pending',
				// 			'payment_status' => 'pending',
				// 			'ref_agency_code' => $this->user->userCustomer->agency_code,
				// 			'ref_agency_name' => $this->user->userCustomer->agency_name,
				// 			'type_of_work' => $request->type_of_work,
				// 			'type_of_work_other' => $request->type_of_work_other,
				// 			'book_no' => $request->book_no,
				// 			'book_date' => $this->convertJsDateToMySQL($request->book_date),
				// 			'book_upload' => ($request->hasFile('book_file')) ? 'y' : 'n'
				// 		]
				// 	);
				// 	break;
			}
			$last_insert_order_id = $order->id;
			if ($request->hasFile('book_file')) {
				/* Delete older files */
				FileUpload::select('id', 'file_name')->whereOrder_id($request->order_id)->whereRef_user_id($this->user->id)->each(function($item, $key) {
					if (Storage::disk('uploads')->exists($item->file_name)) {
						/* uncomment this where need delete the file */
						/*
						Storage::disk('uploads')->delete($item->file_name);
						FileUpload::whereFile_name($item->file_name)->forceDelete();
						*/
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
			//DB::rollback();
			return redirect()->route('customer.index')->with('error', $e->getMessage());
		}
		//DB::commit();
	}
	protected function storeParameterPersonal(Request $request) {
		$request->validate([
			'order_id'=>'bail|required',
			'id_card'=>'required',
			'title_name'=>'required',
		],[
			'order_id.required'=>'ไม่พบรหัสคำสั่งซื้ัอ โปรดตรวจสอบ',
			'id_card.required'=>'โปรดกรอกเลขบัตรประชาชน',
			'title_name.required'=>'โปรดกรอกคำนำหน้าชื่อ',
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
					<label class=\"form-label\" for=\"age_year\">อายุ/ปี <span class=\"text-red-600\">*</span></label>
					<input type=\"number\" name=\"edit_age_year\" value=\"".$order_detail->age_year."\" min=\"1\" max=\"100\" class=\"form-control\">
				</div>
				<div class=\"form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3\">
					<label class=\"form-label\" for=\"division\">แผนก <span class=\"text-red-600\">*</span></label>
					<input type=\"text\" name=\"edit_division\" value=\"".$order_detail->division."\" class=\"form-control\">
				</div>
				<div class=\"form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3\">
					<label class=\"form-label\" for=\"work_life_year\">อายุงาน/ปี <span class=\"text-red-600\">*</span></label>
					<input type=\"number\" name=\"edit_work_life_year\" value=\"".$order_detail->work_life_year."\" min=\"1\" max=\"100\" class=\"form-control\">
				</div>
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
	protected function updateParameterPersonal(Request $request) {
		$request->validate([
			'edit_order_id'=>'bail|required',
			'edit_id_card'=>'required',
			'edit_title_name'=>'required',
		],[
			'edit_order_id.required'=>'ไม่พบรหัสคำสั่งซื้ัอ โปรดตรวจสอบ',
			'edit_id_card.required'=>'โปรดกรอกเลขบัตรประชาชน',
			'edit_title_name.required'=>'โปรดกรอกคำนำหน้าชื่อ',
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

	protected function createParameter(Request $request, CustParameterDataTable $dataTable): object {
		$order_id = $request->order_id;
		$row_completed = OrderDetail::whereOrder_id($request->order_id)->whereCompleted('y')->count();
		return $dataTable->render('apps.customers.parameter', compact('order_id', 'row_completed'));
	}

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
					//dd($data->toArray());
				return DataTables::of($data)
					->addIndexColumn()
					// ->addColumn('select_paramet', static function ($row) {
					// 	return '<input type="checkbox" name="paramets[]" value="'.$row->id.'"/>';
					// })->rawColumns(['select_paramet'])
					// ->addColumn('action', function($row) use ($request) {
					// 	$actionBtn = "<a href=\"".route('customer.parameter.data.store', ['order_detail_id'=>$request->order_detail_id, 'id'=>$row->id])."\" class=\"btn btn-danger btn-sm\"><i class=\"fal fa-plus\"></i></a>";
					// 	return $actionBtn;
					// })
					// ->rawColumns(['action', 'select_paramet'])
					->make(true);
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function storeParameterData(Parameter $parameter, Request $request): object {
		try {
			$paramet = $parameter->findOrfail($request->id);
			$upserted = OrderDetailParameter::updateOrcreate(
				['order_detail_id' => $request->order_detail_id, 'parameter_id' => $request->id],
				[
					'parameter_id' => $paramet->id,
					'parameter_name' => $paramet->parameter_name,
					'parameter_group'=> $paramet->sample_charecter_id,
					'unit_id' => $paramet->unit_id,
					'unit_name' => $paramet->unit_name
				]
			);
			if ($upserted) {
				return redirect()->back()->with('success', 'บันทึกข้อมูลพารามิเตอร์แล้ว');
			} else {
				redirect()->back()->with('error', 'บันทึกพารามิเตอร์ไม่ได้ โปรดตรวจสอบ');
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

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

	protected function createSample(CustSampleDataTable $dataTable, Request $request) {
		$sample_list = array();
		OrderDetail::select('id')->whereOrder_id($request->order_id)->whereCompleted('y')->get()->each(function($value, $key) use (&$sample_list) {
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
				switch ($request->sample_place_type) {
					case 1:
						$userDetail = User::find($request->user_id)->userCustomer;
						for ($i=$request->sample_select_begin; $i<=$request->sample_select_end; $i++) {
							$orderDetail = OrderDetail::find($i);
							if (!is_null($orderDetail)) {
								$orderDetail->sample_charecter = $request->sample_charecter;
								$orderDetail->sample_place_type = $request->sample_place_type;
								$orderDetail->sample_office_category = $request->sample_office_category;
								$orderDetail->sample_office_id = $userDetail->office_code;
								$orderDetail->sample_office_name = $userDetail->office_name;
								$orderDetail->sample_office_addr = $userDetail->office_address;
								$orderDetail->sample_office_sub_district = $userDetail->office_sub_district;
								$orderDetail->sample_office_district = $userDetail->office_district;
								$orderDetail->sample_office_province = $userDetail->office_province;
								$orderDetail->sample_office_postal = $userDetail->office_postal;
								$saved = $orderDetail->save();
							}
						}
						break;
					case 2:
						for ($i=$request->sample_select_begin; $i<=$request->sample_select_end; $i++) {
							$orderDetail = OrderDetail::find($i);
							if (!is_null($orderDetail)) {
								$orderDetail->sample_charecter = $request->sample_charecter;
								$orderDetail->sample_place_type = $request->sample_place_type;
								$orderDetail->sample_office_category = $request->sample_office_category;
								$orderDetail->sample_office_id = $request->sample_office_id;
								$orderDetail->sample_office_name = $request->sample_office_name;
								$orderDetail->sample_office_addr = $request->sample_office_addr;
								$orderDetail->sample_office_sub_district = $request->sample_office_sub_district;
								$orderDetail->sample_office_district = $request->sample_office_district;
								$orderDetail->sample_office_province = $request->sample_office_province;
								$orderDetail->sample_office_postal = $request->sample_office_postal;
								$saved = $orderDetail->save();
							}
						}
						break;
					default:
						return redirect()->route('logout');
						break;
				}
				if ($saved == true) {
					return redirect()->back()->with('success', 'บันทึกข้อมูลแล้ว');
				} else {
					return redirect()->back()->with('error', 'บันทึกข้อมูลไม่สมบูรณ์ โปรดตรวจสอบ');
				}
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

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

	protected function storeVerify(Request $request) {
		try {
			dd($request->order_id);
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function storeParamet(Request $request) {
        dd($request->paramets);
		foreach ($request->paramets as $key => $val) {
            echo $val.'<br>';
        }
	}
}
