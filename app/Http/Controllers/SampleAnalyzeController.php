<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,Storage,File,Log};
use App\DataTables\analyze\{listOrderDataTable};
use App\Models\{OrderSample,OrderSampleParameter,RefMachine,FileUpload};
use Yajra\DataTables\Facades\DataTables;
use App\Traits\FileTrait;

class SampleAnalyzeController extends Controller
{
	use FileTrait;

	private object $user;
	private string $user_role;

	public function __construct() {
		$this->middleware('auth');
		$this->middleware(['role:root|admin|customer|staff']);
		$this->middleware('is_order_confirmed');
		$this->middleware(function($request, $next) {
			$this->user = Auth::user();
			$user_role_arr = $this->user->roles->pluck('name')->all();
			$this->user_role = $user_role_arr[0];
			return $next($request);
		});
	}

	protected function create(listOrderDataTable $dataTable): object {
		return $dataTable->with('user_id', $this->user->id)->render(view: 'apps.staff.analyze.create');
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
							$htm .= "<li>".$value['parameter_name']."</li>\n";
						}
					$htm .= "</ul>\n";
					return $htm;
					})
					->rawColumns(['info', 'paramet', 'action'])
					->make(true);
			} else {
				dd('ไม่พบข้อมูล Ajax');
			}
		} catch (\Exception $e) {
			dd($e->getMessage());
		}
	}

	protected function sampleReserve(Request $request) {
		try {
			if (!empty($request->paramets) && count($request->paramets) > 0) {
				OrderSampleParameter::whereMain_analys_user_id($this->user->id)
				->orWhere('sub_analys_user_id', $this->user->id)
				->whereIn('id', $request->paramets)->update(['status' => 'reserved']);
				return response()->json(['status' => true, 'msg' => 'จองตัวอย่างที่เลือกเรียบร้อยแล้ว']);
			} else {
				return response()->json(['status' => false, 'msg' => 'โปรดเลือกตัวอย่างที่ต้องการจอง !!']);
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return response()->json(['status' => false, 'msg' => 'Error! ไม่สามารถจองตัวอย่างนี้ได้ โปรดตรวจสอบ']);

		}
	}

	protected function labResultCreate(Request $request) {
		try {
			$lab_no = $request->lab_no;
			$result = OrderSample::select('id', 'order_id', 'has_parameter', 'sample_test_no', 'air_volume')
				->with(['parameters' => function($query) use ($request) {
					$query->select(
						'id', 'order_id', 'order_sample_id',
						'parameter_id', 'parameter_name', 'main_analys_user_id',
						'machine_id', 'lab_result_blank', 'lab_result_amount',
						'lab_dilution', 'lab_result', 'status'
					)->where('main_analys_user_id', $request->user_id);
			}])->whereOrder_id($request->id)->get();
			$data = [];
			$result->each(function($item, $key) use (&$data) {
				if (count($item->parameters) > 0) {
					array_push($data, $item->toArray());
				}
			});
			// dd($data);
			$machine = (count($data) > 0) ? RefMachine::select('id', 'machine_name')->get()->toArray() : [];
			return view(view: 'apps.staff.analyze.lab-result', data: compact('lab_no', 'data', 'machine'));
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with('error', $e->getMessage());
		}
	}

	protected function labResultSave(Request $request) {
		try {
			$req = $request->toArray();
			$data = array();
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
				$tmp['lab_dilution'] = $req['lab_dilution'][$i];
				$tmp['lab_result'] = $req['lab_result'][$i];
				array_push($data, $tmp);
			}
			/* Save to db */
			foreach ($data as $key => $value) {
				$order_sample_parameter = OrderSampleParameter::find($value['order_sample_parameter_id']);
				$order_sample_parameter->machine_id = $value['machine_id'];
				$order_sample_parameter->machine_name = $value['machine_name'];
				$order_sample_parameter->lab_result_blank = $value['lab_result_blank'];
				$order_sample_parameter->lab_result_amount = $value['lab_result_amount'];
				$order_sample_parameter->lab_dilution = $value['lab_dilution'];
				$order_sample_parameter->lab_result = $value['lab_result'];
				$saved = $order_sample_parameter->save();
			};
			return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จแล้ว');
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
						<h5 class=\"modal-title\">อับโหลดไฟล์ รหัส: ".$request->paramet_id."</h5>
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
										<input type=\"hidden\" name=\"paramet_id\" value=\"".$request->paramet_id."\">
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
		try {
			if ($request->hasFile('lab_result_file')) {
				$file = $request->file('lab_result_file');
				$file_mime = $file->getMimeType();
				$file_size_byte = $file->getSize();
				$file_size = ($file_size_byte/1024);
				$file_name = $file->getClientOriginalName();
				$file_extension = $file->extension();
				$new_name = $this->renameFile(prefix: 'lab_rs', free_txt: $this->user->id, file_extension: $file_extension);
				$uploaded = Storage::disk('labs')->put($new_name, File::get($file));
				if ($uploaded) {
					$file_upload = new FileUpload;
					$file_upload->ref_user_id = $this->user->id;
					$file_upload->order_id = $request->order_id;
					$file_upload->old_file_name = $file_name;
					$file_upload->file_name = $new_name;
					$file_upload->file_mime = $file_mime;
					$file_upload->file_path = '/labs';
					$file_upload->file_size = $file_size;
					$file_upload->note = 'ไฟล์ผลแลป';
					$file_upload->save();
					$file_upload_last_id = $file_upload->id;
					$order_sample_parameter = OrderSampleParameter::find($request->paramet_id);
					$order_sample_parameter->lab_result_files = $file_upload_last_id;
					$order_sample_parameter->save();
					Log::notice($this->user->userStaff->first_name.' อับโหลดไฟล์ผลแลป '.$new_name);
					return redirect()->back()->with('success', 'อับโหลดไฟล์ผลแลป '.$new_name.' สำเร็จ');
				} else {
					Log::warning($this->user->userStaff->first_name.' อับโหลดไฟล์ผลแลปสำเร็จ');
					return redirect()->back()->with('error', 'อับโหลดไฟล์ผลแลป '.$new_name.' ผิดพลาด');
				}
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with('error', $e->getMessage());
		}
	}

	protected function labResultCommentModal(Request $request) {
        $data = OrderSampleParameter::select('id', 'lab_result_comment')->whereId($request->paramet_id)->get()->toArray();
		return "
		<div class=\"modal fade font-prompt\" id=\"comment-modal-lg-center\" data-keyboard=\"false\" data-backdrop=\"static\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
			<form class=\"modal-dialog modal-lg modal-dialog-centered\" action=\"".route('sample.analyze.lab.result.comment')."\" method=\"POST\" enctype=\"multipart/form-data\" role=\"document\">
				<div class=\"modal-content\">
					<div class=\"modal-header bg-success text-white\">
						<h5 class=\"modal-title\">Parameter id: ".$request->paramet_id."</h5>
						<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
							<span aria-hidden=\"true\"><i class=\"fal fa-times\"></i></span>
						</button>
					</div>
					<div class=\"modal-body\">
						<div class=\"form-row pb-4\">
							<div class=\"form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12\">
								<label class=\"form-label\" for=\"lab_result_file\" style=\"padding-buttom: 6px;\">Comment</label>
								<div class=\"input-group\">
									<div class=\"custom-file\">
										<input type=\"hidden\" name=\"_token\" value=\"".csrf_token()."\">
										<input type=\"hidden\" name=\"paramet_id\" value=\"".$request->paramet_id."\">
										<textarea cols=\"6\" name=\"lab_result_comment\" class=\"form-control\">".$data[0]['lab_result_comment']."</textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class=\"modal-footer\">
						<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">ปิด</button>
						<button type=\"submit\" class=\"btn btn-success\">บันทึก</button>
					</div>
				</div>
			</form>
		</div>";
	}

	protected function labResultComment(Request $request) {
		try {
			if (!empty($request->lab_result_comment)) {
				$order_sample_parameter = OrderSampleParameter::find($request->paramet_id);
				$order_sample_parameter->lab_result_comment = $request->lab_result_comment;
				$order_sample_parameter->save();
			}
			return redirect()->back()->with('success', 'บันทึก Comment สำเร็จแล้ว');
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with('error', $e->getMessage());
		}
	}

    protected function labResultUploadChartModal(Request $request) {
        // $data = OrderSampleParameter::select('id', 'lab_result_comment')->whereId($request->paramet_id)->get()->toArray();
		return "
		<div class=\"modal fade font-prompt\" id=\"chart-modal-lg-center\" data-keyboard=\"false\" data-backdrop=\"static\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
			<form class=\"modal-dialog modal-lg modal-dialog-centered\" action=\"".route('sample.analyze.lab.result.upload.chart')."\" method=\"POST\" enctype=\"multipart/form-data\" role=\"document\">
				<div class=\"modal-content\">
					<div class=\"modal-header bg-danger text-white\">
						<h5 class=\"modal-title\">อับโหลดไฟล์ รหัส: ".$request->lab_no."</h5>
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
										<input type=\"hidden\" name=\"paramet_id\" value=\"".$request->lab_no."\">
										<input type=\"file\" name=\"lab_result_chart\" class=\"custom-file-input @error('lab_result_chart') is-invalid @enderror\" id=\"lab_result_chart\" aria-describedby=\"lab_result_chart\">
										<label class=\"custom-file-label\" for=\"lab_result_chart\">ยังไม่มีไฟล์</label>
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
				$('#lab_result_chart').on('change',function() {
					let fileName = $(this).val();
					$(this).next('.custom-file-label').html(fileName);
				});
			});
		</script>";
	}

    protected function labResultUploadChart(Request $request) {
        dd($request->toArray());

    }
}
