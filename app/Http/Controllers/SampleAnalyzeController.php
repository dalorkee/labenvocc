<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Log};
use App\DataTables\analyze\{listOrderDataTable};
use App\Models\{OrderSample,OrderSampleParameter};
use Yajra\DataTables\Facades\DataTables;

class SampleAnalyzeController extends Controller
{
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

}
