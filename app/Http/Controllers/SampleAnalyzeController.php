<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,Storage,File,Log};
use App\DataTables\analyze\{listOrderDataTable};
use App\Models\{Order,OrderSample,OrderSampleParameter,RefMachine,FileUpload};
use Yajra\DataTables\Facades\DataTables;
use App\Traits\{FileTrait,StringTrait};

class SampleAnalyzeController extends Controller
{
	use FileTrait, StringTrait;

	private object $user;
	private string $user_role;

	public function __construct() {
		$this->middleware('auth');
		$this->middleware(['role:root|admin|customer|staff']);
		// $this->middleware('is_order_confirmed');
		$this->middleware(function($request, $next) {
			$this->user = Auth::user();
			$user_role_arr = $this->user->roles->pluck('name')->all();
			$this->user_role = $user_role_arr[0];
			return $next($request);
		});
	}

	protected function create(listOrderDataTable $dataTable): ?object {
		return $dataTable?->with(key: 'user_id', value: $this->user->id)?->render(view: 'apps.staff.analyze.create');
	}

	protected function sampleSelect(Request $request) {
		$data = [
			'lab_no' => $request->lab_no,
			'order_id' => $request->order_id,
			'user_id' => $request->user_id,
		];
		return view(view: 'apps.staff.analyze.sample-select', data: compact('data'));
	}

	protected function sampleSelectDt(Request $request) {
		try {
			if ($request->ajax()) {
				$data = [];
				$result = OrderSample::select('id', 'order_id', 'has_parameter', 'sample_test_no')
					->with(['parameters' => function($query) use ($request) {
						$query->select('id', 'order_id', 'order_sample_id', 'parameter_id', 'parameter_name', 'main_analys_user_id', 'status')->where('main_analys_user_id', $request->user_id);
				}])->whereOrder_id($request->id)->get();

				// เช็คว่่ามีพารามิเตอร์หรือไม่ ถ้ามีสถานะต้องยังไม่ถูกเเบิก */
				$result->each(function($item, $key) use (&$data) {
					if (count($item->parameters) > 0) {
						$check_paramet_status = true;
						foreach ($item->parameters as $key => $value) {
							if ($value['status'] != 'pending') {
								$check_paramet_status = false;
								break;
							}
						}
						if ($check_paramet_status == true) {
							array_push($data, $item);
						}
					}
				});
				return Datatables::of($data)
					->addIndexColumn()
					->addColumn('info', function() {
						return "<button type=\"button\" class=\"btn btn-info btn-sm btn-icon rounded-circle\" id=\"get-info\"><i class=\"fal fa-info\"></i></button>";
					})
					->addColumn('paramet', function($sample) {
						$htm = "<ul>\n";
						foreach ($sample->parameters as $key => $value) {
							$htm .= "<li><span class=\"badge badge-success\">".$value['parameter_name']."</span></li>\n";
						}
					$htm .= "</ul>\n";
					return $htm;
					})
					->rawColumns(['info', 'paramet', 'action'])
					->make(true);
			} else {
				Log::error('ไม่พบข้อมูล Ajax::sampleSelectDt()');
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function sampleReserve(Request $request): object {
		try {
			if (!empty($request->paramets) && count($request->paramets) > 0) {
				foreach ($request->paramets as $key => $value) {
					$paramet = OrderSampleParameter::findOr($value, fn () => throw new \Exception('[จองตัวอย่าง] ไม่พบข้อมูลพารามิเตอร์รหัส: '.$value));
					$paramet->status = 'reserved';
					$paramet->save();
				}
				$response = ['status' => true, 'msg' => 'จองตัวอย่างที่เลือกเรียบร้อยแล้ว'];
			} else {
				$response = ['status' => false, 'msg' => 'โปรดเลือกตัวอย่างที่ต้องการจอง !!'];
			}
			return response()->json($response);
		} catch (\Exception $e) {
			Log::error('จองตัวอย่าง: '.$e->getMessage());
			return response()->json(['status' => false, 'msg' => 'Error! ไม่สามารถจองตัวอย่างนี้ได้ โปรดตรวจสอบ']);
		}
	}

	protected function labResultCreate(Request $request): object {
		try {
			$result = OrderSample::select(
					'id',
					'order_id',
					'has_parameter',
					'sample_test_no',
					'air_volume',
					'weight_sample'
				)
				->with(['parameters' => function($query) use ($request) {
					$query->select(
						'id',
						'order_id',
						'order_sample_id',
						'parameter_id',
						'parameter_name',
						'main_analys_user_id',
						'machine_id',
						'lab_result_blank',
						'lab_result_amount',
						'lab_dilution',
						'lab_result',
						'status'
					)
					->where('main_analys_user_id', $request->user_id)
					->whereIn('status', ['analyzing', 'completed']);
				}])
			->whereOrder_id($request->id)
			->get();

			$order_id = $result[0]->order_id;
			$lab_no = $request->lab_no;
			$main_analys_user_id = $request->user_id;

			$data = [];
			$result->each(function($item, $key) use (&$data) {
				if (count($item->parameters) > 0) {
					array_push($data, $item->toArray());
				}
			});

			if (count($data) > 0) {
				$machine = (count($data) > 0) ? RefMachine::select('id', 'machine_name')->get()->toArray() : [];
				return view(view: 'apps.staff.analyze.lab-result', data: compact('order_id', 'lab_no', 'data', 'machine', 'main_analys_user_id'));
			} else {
				return redirect()->back()->with(key: 'warning', value: 'ไม่พบข้อมูล โปรดตรวจสอบการอนุมัติจากเจ้าหน้าที่ธุรการ');
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with('error', $e->getMessage());
		}
	}

	protected function labResultSave(Request $request) {
		try {
			$req = $request->toArray();
			if (count($req['ref_order_id']) > 0) {
				$data = [];
				$machine = RefMachine::select('id', 'machine_name')->get()->keyBy('id')->toArray();

				/* Prepare data */
				for ($i=0; $i<count($req['ref_order_id']); $i++) {
					$tmp['order_id'] = $req['ref_order_id'][$i];
					$tmp['order_sample_id'] = $req['ref_order_sample_id'][$i];
					$tmp['sample_test_no'] = $req['sample_test_no'][$i];
					$tmp['order_sample_parameter_id'] = $req['order_sample_parameter_id'][$i];
					$tmp['parameter_id'] = $req['parameter_id'][$i];
					$tmp['parameter_name'] = preg_replace("/\r|\n/", "", $req['parameter_name'][$i]);
					$tmp['machine_id'] = $req['machine_id'][$i];
					$tmp['machine_name'] = $machine[$req['machine_id'][$i]]['machine_name'];
					$tmp['lab_result_blank'] = $req['lab_result_blank'][$i];
					$tmp['lab_result_amount'] = $req['lab_result_amount'][$i];
					$tmp['air_volume'] = $req['air_volume'][$i];
					$tmp['weight_sample'] = $req['weight_sample'][$i];
					$tmp['lab_dilution'] = $req['lab_dilution'][$i];
					$tmp['lab_result'] = $req['lab_result'][$i];
					array_push($data, $tmp);
				}

				/* Save to db */
				foreach ($data as $key => $value) {
					$order_sample_parameter = OrderSampleParameter::findOr($value['order_sample_parameter_id'], fn () => throw new \Exception("บันทึกผลแลป::ไม่พบข้อมูลพารามิเตอร์ id: ".$value['order_sample_parameter_id']));
					switch($order_sample_parameter->threat_type_id) {
						case 1: /*กรด ด่าง/โลหะอัลคาไลน์ */
							switch ($order_sample_parameter->sample_character_id) {
								case 1: // สารละลาย
									$unit_value = $value['lab_result']; // หน่วยจากเครื่องมือ
									// customer
									$unit_customer_value = null;
									// choice1
									$unit_choice1_value = null;
									//choice2
									$unit_choice2_value = null;
									break;
								case 2: // ดิน
									$unit_value = $value['lab_result']; // หน่วยจากเครื่องมือ
									// customer
									$unit_customer_value = null;
									// choice1
									$unit_choice1_value = null;
									//choice2
									$unit_choice2_value = null;
									break;
								case 3: // น้ำ
									$unit_value = $value['lab_result']; // หน่วยจากเครื่องมือ
									// customer
									$unit_customer_value = null;
									// choice1
									$unit_choice1_value = null;
									//choice2
									$unit_choice2_value = null;
									break;
								case 5: // อากาศ
									$unit_value = $value['lab_result']; // หน่วยจากเครื่องมือ
									// customer
									$unit_customer_value = null;
									// choice1
									$unit_choice1_value = null;
									//choice2
									$unit_choice2_value = null;
									break;
								default:
									redirect()->back()->with('error', 'ไม่พบข้อมูลการคำนวณ กรด,ด่าง/โลหะอัลคาไลน์');
							}
							break;
						case 2: /* จุลชีววิทยา */
							switch ($order_sample_parameter->sample_character_id) {
								case 5: // อากาศ
									$unit_value = $value['lab_result']; // หน่วยจากเครื่องมือ
									// customer
									$unit_customer_value = null;
									// choice1
									$unit_choice1_value = null;
									//choice2
									$unit_choice2_value = null;
									break;
								default:
									redirect()->back()->with('error', 'ไม่พบข้อมูลการคำนวณ จุลชีววิทยา');
							}
							break;
						case 3: /* ฝุ่นซิลิก้า */
							switch ($order_sample_parameter->sample_character_id) {
								case 5: // อากาศ
									$unit_value = $value['lab_result']; // หน่วยจากเครื่องมือ
									// customer
									$unit_customer_value = null;
									// choice1
									$unit_choice1_value = null;
									//choice2
									$unit_choice2_value = null;
									break;
								default:
									redirect()->back()->with('error', 'ไม่พบข้อมูลการคำนวณ จุลชีววิทยา');
							}
							break;
						case 4: /* สารอินทรีย์ระเหย */
							switch ($order_sample_parameter->sample_character_id) {
								case 1: // สารละลาย
									$unit_value = $value['lab_result']; // หน่วยจากเครื่องมือ
									// customer
									$unit_customer_value = ($unit_value*1000); // (หน่วยจากเครื่องมือx1000)
									// choice1
									$unit_choice1_value = null;
									//choice2
									$unit_choice2_value = null;
									break;
								case 2: // ดิน
									$unit_value = $value['lab_result']; // หน่วยจากเครื่องมือ
									// customer
									$unit_customer_value = (($unit_value*1000)/$value['weight_sample']); // (หน่วยจากเครื่องมือx1000)/น้ำหนักดิน(กรัม)
									$unit_customier_name = 'μg/l';
									// choice1
									$unit_choice1_value = null;
									//choice2
									$unit_choice2_value = null;
									break;
								case 3: // น้ำ
									$unit_value = (int)$value['lab_result']; // หน่วยจากเครื่องมือ
									// customer
									$unit_customer_value = $unit_value; // หน่วยจากเครื่องมือ
									// choice1
									$unit_choice1_value = ($unit_value*1000); // หน่วยรายงานผลx1000
									//choice2
									$unit_choice2_value = null;
									break;
								case 4: // น้ำมัน
									$unit_value = $value['lab_result']; // หน่วยจากเครื่องมือ
									// customer
									$unit_customer_value = $unit_value; // หน่วยจากเครื่องมือ
									// choice1
									$unit_choice1_value = ($unit_value*1000); // หน่วยรายงานผลx1000
									//choice2
									$unit_choice2_value = null;
									break;
								case 5: // อากาศ
									$unit_value = $value['lab_result']; // หน่วยจากเครื่องมือ
									// customer
									$match_value = strtolower(trim($order_sample_parameter->unit_customer_name));
									$rs = match ($match_value) {
										'μg/tube', 'μg/sample', 'ppm', 'mg/m3' => $value['lab_result'], // หน่วยจากเครื่องมือ
										default => null
									};
									$unit_customer_value = $rs;
									// choice1
									$match_value = strtolower(trim($order_sample_parameter->unit_choice1_name));
									$rs = match ($match_value) {
										'mg/m3' => ($unit_value/$value['air_volume']), // หน่วยรายงานผล/ปริมาตรอากาศ
										'ppm' => null,
										default => null
									};
									$unit_choice1_value = $rs;
									// choice2
									$match_value = strtolower(trim($order_sample_parameter->unit_choice2_name));
									$rs = match ($match_value) {
										'ppm' => (($unit_choice1_value*24.45)/$value['weight_molecule']), // (หน่วยทางเลือก1x24.45)/น้ำหนักโมเลกุล
										default => null
									};
									$unit_choice2_value = $rs;
									break;
								case 6: // ปัสสาวะ
									$unit_value = $value['lab_result']; // หน่วยจากเครื่องมือ
									// customer
									$match_value = strtolower(trim($order_sample_parameter->unit_customer_name));
									$rs = match ($match_value) {
										'mg/l' => $value['lab_result'], // หน่วยจากเครื่องมือ
										'g/g creatinine' => (($value['lab_result']/1000)/$value['lab_result_creatinine']), // (หน่วยจากเครื่องมือ/1000 )/ค่า Creatinine
										'mg/g creatinine' => ($value['lab_result']/$value['lab_result_creatinine']), // หน่วยจากเครื่องมือ/ค่า Creatinine
										'μg/g creatinine' => (($value['lab_result']*1000)/$value['lab_result_creatinine']), // (หน่วยจากเครื่องมือx1000)/ค่า Creatinine
										default => null
									};
									$unit_customer_value = $rs;
									// choice1
									$match_value = strtolower(trim($order_sample_parameter->unit_choice1_name));
									$rs = match ($match_value) {
										'μg/l' => ($value['lab_result']*1000),
										'mg/l' => $value['lab_result'],
										default => null
									};
									$unit_choice1_value = $rs;
									// choice2
									$unit_choice2_value = null;
									break;
								case 8: // เลือด
									$unit_value = $value['lab_result']; // หน่วยจากเครื่องมือ
									// customer
									$unit_customer_value = $unit_value;
									// choice1
									$unit_choice1_value = ($unit_value*1000); // (หน่วยจากเครื่องมือx1000)
									//choice2
									$unit_choice2_value = null;
									break;
								default:
									redirect()->back()->with('error', 'ไม่พบข้อมูลการคำนวณ สารอินทรีย์ระเหย');
							}
							break;
						case 5: // แร่ใยหิน
							switch ($order_sample_parameter->sample_character_id) {
								case 5: // อากาศ
									$unit_value = $value['lab_result']; // หน่วยจากเครื่องมือ
									// customer
									$unit_customer_value = null;
									// choice1
									$unit_choice1_value = null;
									//choice2
									$unit_choice2_value = null;
									break;
								default:
									redirect()->back()->with('error', 'ไม่พบข้อมูลการคำนวณ แร่ใยหิน');
							}
							break;
						case 6: // โลหะหนัก
							switch ($order_sample_parameter->sample_character_id) {
								case 2: // ดิน
									$unit_value = $value['lab_result']; // หน่วยจากเครื่องมือ
									// customer
									$unit_customer_value = null;
									// choice1
									$unit_choice1_value = null;
									//choice2
									$unit_choice2_value = null;
									break;
								case 3: // น้ำ
									$unit_value = $value['lab_result']; // หน่วยจากเครื่องมือ
									// customer
									$unit_customer_value = null;
									// choice1
									$unit_choice1_value = null;
									//choice2
									$unit_choice2_value = null;
									break;
								case 5: // อากาศ
									$unit_value = $value['lab_result']; // หน่วยจากเครื่องมือ
									// customer
									$unit_customer_value = null;
									// choice1
									$unit_choice1_value = null;
									//choice2
									$unit_choice2_value = null;
									break;
								case 6: // ปัสสาวะ
									$unit_value = $value['lab_result']; // หน่วยจากเครื่องมือ
									// customer
									$unit_customer_value = null;
									// choice1
									$unit_choice1_value = null;
									//choice2
									$unit_choice2_value = null;
									break;
								case 7: // Wipes
									$unit_value = $value['lab_result']; // หน่วยจากเครื่องมือ
									// customer
									$unit_customer_value = null;
									// choice1
									$unit_choice1_value = null;
									//choice2
									$unit_choice2_value = null;
									break;
								case 8: // เลือด
									$unit_value = $value['lab_result']; // หน่วยจากเครื่องมือ
									// customer
									$unit_customer_value = null;
									// choice1
									$unit_choice1_value = null;
									//choice2
									$unit_choice2_value = null;
									break;
								case 9: // น้ำเหลือง
									$unit_value = $value['lab_result']; // หน่วยจากเครื่องมือ
									// customer
									$unit_customer_value = null;
									// choice1
									$unit_choice1_value = null;
									//choice2
									$unit_choice2_value = null;
									break;
								default:
									redirect()->back()->with('error', 'ไม่พบข้อมูลการคำนวณ โลหะหนัก');
							}
							break;
						case 7: // อื่นๆ
							switch ($order_sample_parameter->sample_character_id) {
								case 6: // ปัสสาวะ
									$unit_value = $value['lab_result']; // หน่วยจากเครื่องมือ
									// customer
									$match_value = strtolower(trim($order_sample_parameter->unit_customer_name));
									$rs = match ($match_value) {
										'g/l' => null,
										'mg/dg' => $value['lab_result'], // หน่วยจากเครื่องมือ
										default => null
									};
									$unit_customer_value = $rs;
									// choice1
									$match_value = strtolower(trim($order_sample_parameter->unit_choice1_name));
									$rs = match ($match_value) {
										'μg/l' => ($value['lab_result']*1000),
										'mg/l' => $value['lab_result'],
										default => null
									};
									$unit_choice1_value = $rs;
									// choice2
									$unit_choice2_value = null;
									break;
								default:
									redirect()->back()->with('error', 'ไม่พบข้อมูลการคำนวณ อื่นๆ');
							}
							break;
					}

					$order_sample_parameter->status = 'completed';

					$order_sample_parameter->machine_id = $value['machine_id'];
					$order_sample_parameter->machine_name = $value['machine_name'];

					$order_sample_parameter->unit_value = $unit_value;
					$order_sample_parameter->unit_customer_value = $unit_customer_value;
					$order_sample_parameter->unit_choice1_value = $unit_choice1_value;
					$order_sample_parameter->unit_choice2_value = $unit_choice2_value;

					$order_sample_parameter->lab_result_blank = $value['lab_result_blank'];
					$order_sample_parameter->lab_result_amount = $value['lab_result_amount'];
					$order_sample_parameter->lab_dilution = $value['lab_dilution'];
					$order_sample_parameter->lab_result = $value['lab_result'];

					$order_sample_parameter->save();
				};

				/* ตรวจสอบว่าแต่ละ parameter สถานะ completed หรือยัง ถ้าครบทั้ง lab no ให้เปลี่ยนสถานะ order เป็น Analyzed */
				if (!empty($req['ref_order_id'])) {
					$chkNotCompleteStatus = OrderSampleParameter::whereOrder_id($req['ref_order_id'][0])->where('status', '!=', 'completed')->count();
					if ($chkNotCompleteStatus == 0) {
						$order = Order::findOr($req['ref_order_id'][0], fn () => throw new \Exception('บันทึกผลการทดสอบ::เปลี่ยนสถานะ Order => analyzed ไม่ได้'));
						$order->order_status = 'analyzed';
						$order->save();
					}
				}
				return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จแล้ว');
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with('error', $e->getMessage());
		}
	}

	protected function labResultUploadFileModal(Request $request) {
		return "
		<div class=\"modal fade font-prompt\" id=\"default-example-modal-lg-center\" data-keyboard=\"false\" data-backdrop=\"static\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
			<form class=\"modal-dialog modal-lg modal-dialog-centered\" action=\"".route('sample.analyze.lab.result.upload.file')."\" method=\"POST\" enctype=\"multipart/form-data\" role=\"document\">
				<div class=\"modal-content\">
					<div class=\"modal-header bg-info text-white\">
						<h5 class=\"modal-title\">อับโหลดไฟล์ รหัส: ".$request->xparamet_id."</h5>
						<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
							<span aria-hidden=\"true\"><i class=\"fal fa-times\"></i></span>
						</button>
					</div>
					<div class=\"modal-body\">
						<div class=\"form-row pb-4\">
							<div class=\"form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12\">
								<label class=\"form-label\" for=\"lab_result_file\">เลือกไฟล์</label>
								<div class=\"input-group\">
									<div class=\"custom-file\">
										<input type=\"hidden\" name=\"_token\" value=\"".csrf_token()."\">
										<input type=\"hidden\" name=\"xorder_id\" value=\"".$request->xorder_id."\">
										<input type=\"hidden\" name=\"xparamet_id\" value=\"".$request->xparamet_id."\">
										<input type=\"file\" name=\"lab_result_file\" class=\"custom-file-input @error('lab_result_file') is-invalid @enderror\" id=\"lab_result_file\" aria-describedby=\"lab_result_file\">
										<label class=\"custom-file-label\" for=\"lab_result_file\">ยังไม่มีไฟล์</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class=\"modal-footer\">
						<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">ปิด</button>
						<button type=\"submit\" class=\"btn btn-info\">อับโหลด</button>
					</div>
				</div>
			</form>
		</div>
		<script type=\"text/javascript\">
			$(document).ready(function() {
				$('#lab_result_file').on('change',function() {
					let fileName = $(this).val();
					$(this).next('.custom-file-label').html(fileName);
				});
			});
		</script>";
	}

	protected function labResultUploadFile(Request $request) {
		$request->validate([
			'lab_result_file'=>'required|mimes:png,jpg,jpeg,pdf|max:2048'
		],[
			'lab_result_file.required'=>'โปรดแนบไฟล์',
		]);
		try {
			if ($request->hasFile('lab_result_file')) {
				$file = $request->file('lab_result_file');
				$file_mime = $file->getMimeType();
				$file_size_byte = $file->getSize();
				$file_size = round(($file_size_byte/1024), 2);
				$file_name = $file->getClientOriginalName();
				$file_extension = $file->extension();
				$new_name = $this->renameFile(prefix: 'lab_rs', free_txt: $this->user->id, file_extension: $file_extension);
				$uploaded = Storage::disk(name: 'labs')->put(path: $new_name, contents: File::get($file));
				if ($uploaded) {
					$file_upload = new FileUpload;
					$file_upload->ref_user_id = $this->user->id;
					$file_upload->order_id = $request->xorder_id;
					$file_upload->old_file_name = $file_name;
					$file_upload->file_name = $new_name;
					$file_upload->file_mime = $file_mime;
					$file_upload->file_path = '/labs';
					$file_upload->file_size = $file_size;
					$file_upload->note = 'ไฟล์ผลแลป';
					$file_upload->save();
					$file_upload_last_id = $file_upload->id;
					$order_sample_parameter = OrderSampleParameter::find($request->xparamet_id);
					$order_sample_parameter->lab_result_files = $file_upload_last_id;
					$order_sample_parameter->save();
					Log::notice($this->user->userStaff->first_name.' อับโหลดไฟล์ผลแลป '.$new_name);
					return redirect()->back()->with('success', 'อับโหลดไฟล์ผลแลป '.$new_name.' สำเร็จ');
				} else {
					Log::warning($this->user->userStaff->first_name.' อับโหลดไฟล์ผลแลปไม่สำเร็จ');
					return redirect()->back()->with('error', 'อับโหลดไฟล์ผลแลป '.$new_name.' ผิดพลาด');
				}
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with('error', $e->getMessage());
		}
	}

	protected function labResultCommentModal(Request $request) {
		$data = OrderSampleParameter::select('id', 'lab_result_comment')->whereId($request->yparamet_id)->get()->toArray();
		return "
		<div class=\"modal fade font-prompt\" id=\"comment-modal-lg-center\" data-keyboard=\"false\" data-backdrop=\"static\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
			<form class=\"modal-dialog modal-lg modal-dialog-centered\" action=\"".route('sample.analyze.lab.result.comment')."\" method=\"POST\" enctype=\"multipart/form-data\" role=\"document\">
				<div class=\"modal-content\">
					<div class=\"modal-header bg-primary text-white\">
						<h5 class=\"modal-title\">Parameter id: ".$request->yparamet_id."</h5>
						<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
							<span aria-hidden=\"true\"><i class=\"fal fa-times\"></i></span>
						</button>
					</div>
					<div class=\"modal-body\">
						<div class=\"form-row pb-4\">
							<div class=\"form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12\">
								<label class=\"form-label\" for=\"lab_result_file\">Comment</label>
								<input type=\"hidden\" name=\"_token\" value=\"".csrf_token()."\">
								<input type=\"hidden\" name=\"yparamet_id\" value=\"".$request->yparamet_id."\">
								<textarea cols=\"6\" name=\"lab_result_comment\" class=\"form-control\">".$data[0]['lab_result_comment']."</textarea>
							</div>
						</div>
					</div>
					<div class=\"modal-footer\">
						<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">ปิด</button>
						<button type=\"submit\" class=\"btn btn-primary\">บันทึก</button>
					</div>
				</div>
			</form>
		</div>";
	}

	protected function labResultComment(Request $request) {
		try {
			if (!empty($request->lab_result_comment)) {
				$order_sample_parameter = OrderSampleParameter::findOrFail($request->yparamet_id);
				$order_sample_parameter->lab_result_comment = $request->lab_result_comment;
				$order_sample_parameter->save();
			}
			return redirect()->back()->with('success', 'บันทึก Comment สำเร็จแล้ว');
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with('error', $e->getMessage());
		}
	}

	protected function analyzeResultUploadFileModal(Request $request) {
		// $data = OrderSampleParameter::select('id', 'lab_result_comment')->whereId($request->paramet_id)->get()->toArray();
		return "
		<div class=\"modal fade font-prompt\" id=\"chart-modal-lg-center\" data-keyboard=\"false\" data-backdrop=\"static\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
			<form class=\"modal-dialog modal-lg modal-dialog-centered\" action=\"".route('sample.analyze.result.upload.file')."\" method=\"POST\" enctype=\"multipart/form-data\" role=\"document\">
				<div class=\"modal-content\">
					<div class=\"modal-header bg-danger text-white\">
						<h5 class=\"modal-title\">อับโหลดไฟล์ Lab No: ".$request->zlab_no."</h5>
						<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
							<span aria-hidden=\"true\"><i class=\"fal fa-times\"></i></span>
						</button>
					</div>
					<div class=\"modal-body\">
						<div class=\"form-row pb-4\">
							<div class=\"form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12\">
								<label class=\"form-label\" for=\"lab_result_file\">เลือกไฟล์</label>
								<div class=\"input-group\">
									<div class=\"custom-file\">
										<input type=\"hidden\" name=\"_token\" value=\"".csrf_token()."\">
										<input type=\"hidden\" name=\"zlab_no\" value=\"".$request->zlab_no."\">
										<input type=\"hidden\" name=\"zorder_id\" value=\"".$request->zorder_id."\">
										<input type=\"file\" name=\"analyze_result_file\" class=\"custom-file-input @error('lab_result_chart_file') is-invalid @enderror\" id=\"lab_result_chart_file\" aria-describedby=\"lab_result_chart_file\">
										<label class=\"custom-file-label\" for=\"lab_result_chart_file\">ยังไม่มีไฟล์</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class=\"modal-footer\">
						<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">ปิด</button>
						<button type=\"submit\" class=\"btn btn-danger\">อับโหลด</button>
					</div>
				</div>
			</form>
		</div>
		<script type=\"text/javascript\">
			$(document).ready(function() {
				$('#lab_result_chart_file').on('change', function() {
					let fileName = $(this).val();
					$(this).next('.custom-file-label').html(fileName);
				});
			});
		</script>";
	}

	protected function analyzeResultUploadFile(Request $request) {
		$request->validate([
			'analyze_result_file'=>'required|mimes:png,jpg,jpeg,pdf|max:2048'
		],[
			'analyze_result_file.required'=>'โปรดแนบไฟล์',
		]);
		try {
			if ($request->hasFile('analyze_result_file')) {
				$file = $request->file('analyze_result_file');
				$file_mime = $file->getMimeType();
				$file_size_byte = $file->getSize();
				$file_size = round(($file_size_byte/1024), 2);
				$file_name = $file->getClientOriginalName();
				$file_extension = $file->extension();
				$new_name = $this->renameFile(prefix: 'lab_rsc', free_txt: $this->user->id, file_extension: $file_extension);
				$uploaded = Storage::disk('labs')->put($new_name, File::get($file));
				if ($uploaded) {
					$file_upload = new FileUpload;
					$file_upload->ref_user_id = $this->user->id;
					$file_upload->order_id = $request->zorder_id;
					$file_upload->old_file_name = $file_name;
					$file_upload->file_name = $new_name;
					$file_upload->file_mime = $file_mime;
					$file_upload->file_path = '/labs';
					$file_upload->file_size = $file_size;
					$file_upload->note = 'ไฟล์ผลแลป/chart';
					$file_upload->save();
					$file_upload_last_id = $file_upload->id;

					$order = Order::select('id', 'lab_no', 'analyze_result_files')->whereLab_no($request->zlab_no)->get()->toArray();
					$result_files = $order[0]['analyze_result_files'];
					if (empty($result_files) || is_null($result_files)) {
						$result_files = $file_upload_last_id;
					} else {
						$result_files = $this->stringToArray(sep: ",", str: $result_files);
						array_push($result_files, $file_upload_last_id);
						$result_files = $this->ArrayToString(sep: ',', str: $result_files);
					}
					Order::whereId($request->zorder_id)->update(['analyze_result_files' => $result_files]);
					Log::notice($this->user->userStaff->first_name.' อับโหลดไฟล์ผลแลป/chart '.$new_name);
					return redirect()->back()->with('success', 'อับโหลดไฟล์ผลแลป '.$new_name.' สำเร็จ');
				} else {
					Log::warning($this->user->userStaff->first_name.' อับโหลดไฟล์ผลแลป/chart ไม่สำเร็จ');
					return redirect()->back()->with('error', 'อับโหลดไฟล์ผลแลป '.$new_name.' ผิดพลาด');
				}
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with('error', $e->getMessage());
		}
	}

	protected function analyzeResultViewModal(Request $request) {
		$result = OrderSample::select('id', 'order_id', 'has_parameter', 'sample_test_no', 'weight_sample', 'air_volume')
			->with(['parameters' => function($query) use ($request) {
				$query->select('*')->where('main_analys_user_id', $request->view_analyze_user);
			}])
			->whereOrder_id($request->view_order_id)
			->get();

		$data = [];
		$result->each(function($item, $key) use (&$data) {
			if (count($item->parameters) > 0) {
				array_push($data, $item->toArray());
			}
		});
		$htm = "
		<div class=\"modal fade modal-fullscreen font-prompt\" id=\"view-modal-lg-center\" data-keyboard=\"false\" data-backdrop=\"static\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
			<form class=\"modal-dialog modal-dialog-centered\" action=\"".route('sample.analyze.result.upload.file')."\" method=\"POST\" enctype=\"multipart/form-data\" role=\"document\">
				<div class=\"modal-content\">
					<div class=\"modal-header bg-info text-white\">
						<h5 class=\"modal-title\">บันทึกการทวนสอบผลการวิเคราะห์ Lab No: ".$request->view_lab_no."</h5>
						<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
							<span aria-hidden=\"true\"><i class=\"fal fa-times\"></i></span>
						</button>
					</div>
					<div class=\"modal-body\">
					<div class=\"row\">
						<div class=\"col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3\">
							<div class=\"table-responsive\">
								<table id=\"result_table\" class=\"table table-bordered table-striped responsive\">
									<thead class=\"m-0\" style=\"background: #b0d7f1; color: #1b6394\">
										<tr>
											<th rowspan=\"2\" style=\"vertical-align:middle;text-align:center;\">ลำดับ</th>
											<th rowspan=\"2\" style=\"vertical-align:middle;text-align:center;\">หมายเลขทดสอบ</th>
											<th rowspan=\"2\" style=\"vertical-align:middle;text-align:center;\">พารามิเตอร์</th>
											<th rowspan=\"2\" style=\"vertical-align:middle;text-align:center;\">Blank</th>
											<th rowspan=\"2\" style=\"vertical-align:middle;text-align:center;\">Amount</th>
											<th rowspan=\"2\" style=\"vertical-align:middle;text-align:center;\">ปริมาตรอากาศ (l.)</th>
											<th rowspan=\"2\" style=\"vertical-align:middle;text-align:center;\">น้ำหนักดิน(g.)</th>
											<th colspan=\"3\" style=\"vertical-align:middle;text-align:center;\">ผลการทดสอบ</th>
										</tr>
										<tr>
											<th style=\"vertical-align:middle;text-align:center;\">".($data[0]['parameters'][0]['unit_customer_name'] ?? '')."</th>
											<th style=\"vertical-align:middle;text-align:center;\">".($data[0]['parameters'][0]['unit_choice1_name'] ?? '')."</th>
											<th style=\"vertical-align:middle;text-align:center;\">".($data[0]['parameters'][0]['unit_choice2_name'] ?? '')."</th>
										</tr>
									</thead>
									<tbody>";
									foreach ($data as $key => $value) {
										$i = 1;
										foreach ($value['parameters'] as $k => $v) {
											$htm .= "
											<tr>
												<td><div style=\"width:40px\">".$i."</div></td>
												<td><div style=\"width:120px\">".$value['sample_test_no']."</td>
												<td><div style=\"width:300px\">".preg_replace("/\r|\n/", "", $v['parameter_name'])."</div></td>
												<td><div style=\"width:100px\">".$v['lab_result_blank']."</div></td>
												<td><div style=\"width:100px\">".$v['lab_result_amount']."</div></td>
												<td><div style=\"width:130px\">".$value['air_volume']."</div></td>
												<td><div style=\"width:130px\">".$value['weight_sample']."</div></td>
												<td><div style=\"width:40px\">".$v['unit_customer_value']."</div></td>
												<td><div style=\"width:40px\">".$v['unit_choice1_value']."</div></td>
												<td><div style=\"width:40px\">".$v['unit_choice2_value']."</div></td>
											</tr>";
											$i++;
										}
									}
									$htm .= "</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class=\"modal-footer\">
						<button type=\"button\" class=\"btn btn-info\" data-dismiss=\"modal\" style=\"width: 120px\">Close</button>
					</div>
				</div>
			</form>
		</div>";
		return $htm;
	}

	protected function analyzeResultView(Request $request) {
		try {
			$lab_no = $request->vlab_no;
			dd($lab_no);
			// $result = OrderSample::select('id', 'order_id', 'has_parameter', 'sample_test_no', 'air_volume')
			// 	->with(['parameters' => function($query) use ($request) {
			// 		$query->select(
			// 			'id', 'order_id', 'order_sample_id',
			// 			'parameter_id', 'parameter_name', 'main_analys_user_id',
			// 			'machine_id', 'lab_result_blank', 'lab_result_amount',
			// 			'lab_dilution', 'lab_result', 'status'
			// 		)->where('main_analys_user_id', $request->user_id);
			// }])->whereOrder_id($request->id)->get();
			// $order_id = $result[0]->order_id;
			// $data = [];
			// $result->each(function($item, $key) use (&$data) {
			// 	if (count($item->parameters) > 0) {
			// 		array_push($data, $item->toArray());
			// 	}
			// });
			// dd($data);
			// $machine = (count($data) > 0) ? RefMachine::select('id', 'machine_name')->get()->toArray() : [];
			// return view(view: 'apps.staff.analyze.lab-result', data: compact('order_id', 'lab_no', 'data', 'machine'));
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with('error', $e->getMessage());
		}
	}
}
