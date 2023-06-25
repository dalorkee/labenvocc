<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,Storage,File,Log};
use App\DataTables\qc\{listOrderDataTable};
use App\Models\{Order,OrderSample,OrderSampleParameter};
use Yajra\DataTables\Facades\DataTables;

class SampleQcController extends Controller
{
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

	protected function create(listOrderDataTable $dataTable): object {
		return $dataTable->with('user_id', $this->user->id)->render(view: 'apps.staff.qc.create');
	}

	protected function listDataByLabNo(Request $request) {
		$data = ['order_id' => $request->order_id, 'lab_no' => $request->lab_no];
		return view(view: 'apps.staff.qc.list-data', data: compact('data'));
	}

	protected function listDataByLabNoToDataTable(Request $request) {
		try {
			if ($request->ajax()) {
				$data = [];
				$orders = Order::with('orderSamples', 'parameters')->whereLab_no($request->lab_no)->get();
				$orders->each(function($order, $order_key) use ($request, &$data) {
					if ($order->orderSamples->count() > 0) {
						foreach ($order->orderSamples as $key => $value) {
							$tmp['lab_no'] = $request->lab_no;
							$tmp['sample_id'] = $value->id;
							$tmp['order_id'] = $value->order_id;
							$tmp['sample_test_no'] = $value->sample_test_no;
							$paramet = $order->parameters->where('order_sample_id', $value->id);
							$tmp['parameters'] = $paramet;
							array_push($data, $tmp);
						}
					}
				});
				return Datatables::of($data)
					->addIndexColumn()
					->addColumn('sample_test_no', function($item) {
						return $item['sample_test_no'];
					})
					->addColumn('paramet', function($item) {
						$htm = "<ul>\n";
						foreach ($item['parameters'] as $key => $value) {
							$htm .= "<li>".$value->parameter_name."</li>\n";
						}
					$htm .= "</ul>\n";
					return $htm;
					})
					->addColumn('btn', function($item) {
						return "
						<button type=\"button\" class=\"btn btn-info btn-sm\" onClick=\"showResultModal('rs_btn', '".$item['lab_no']."','".$item['order_id']."','".$item['sample_test_no']."');\">View result</button>
						<button type=\"button\" class=\"btn btn-info btn-sm\" onClick=\"showCurveResultModal('rs_btn', '".$item['lab_no']."','".$item['order_id']."','".$item['sample_test_no']."');\">View curve & QC</button>";
					})
					->rawColumns(['paramet', 'btn'])
					->make(true);
			} else {
				return redirect()->back()->with('error', 'ไม่พบข้อมูลที่เรียก');
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with('error', $e->getMessage());
		}
	}

	public function showResultModal(Request $request) {
		try {
			$result = OrderSample::select('id', 'order_id', 'has_parameter', 'sample_test_no', 'weight_sample', 'air_volume')
				->with('parameters')
				->whereOrder_id($request->order_id)
				->whereSample_test_no($request->test_no)
				->get();

				$data = [];
				$result->each(function($item, $key) use (&$data) {
					if (count($item->parameters) > 0) {
						array_push($data, $item->toArray());
					}
				});
				$chk = [];
				foreach ($data as $key => $value) {
					foreach ($value['parameters'] as $k => $v) {
						if (!empty($v['lab_result_ug_sample'])) {
							$chk['lab_result_ug_sample'] = '&#956;g/sample';
						}
						if (!empty($v['lab_result_mg_sample'])) {
							$chk['lab_result_mg_sample'] = 'mg/sample';
						}
						if (!empty($v['lab_result_mg_m3'])) {
							$chk['lab_result_mg_m3'] = 'mg/m<sup>3</sup>';
						}
						if (!empty($v['lab_result_ppm'])) {
							$chk['lab_result_ppm'] = 'ppm';
						}
						if (!empty($v['lab_result_ug_g_creatinine'])) {
							$chk['lab_result_ug_g_creatinine'] = '&#956;g/creatinine';
						}
						if (!empty($v['lab_result_mg_g_creatinine'])) {
							$chk['lab_result_mg_g_creatinine'] = 'mg/creatinine';
						}
						if (!empty($v['lab_result_percent_w_v'])) {
							$chk['lab_result_percent_w_v'] = '% w/v';
						}
						if (!empty($v['lab_result_percent_w_w'])) {
							$chk['lab_result_percent_w_w'] = '% w/w';
						}
						if (!empty($v['lab_result_mg_l'])) {
							$chk['lab_result_mg_l'] = 'mg/l';
						}
						if (!empty($v['lab_result_ug_l'])) {
							$chk['lab_result_ug_l'] = '&#956;g/l';
						}
						if (!empty($v['lab_result_mg_kg'])) {
							$chk['lab_result_mg_kg'] = 'mg/kg';
						}
						if (!empty($v['lab_result_ug_dl'])) {
							$chk['lab_result_ug_dl'] = '&#956;g/dl';
						}
						if (!empty($v['lab_result_fiber_cc'])) {
							$chk['lab_result_fiber_cc'] = 'fiber/cc';
						}
						if (!empty($v['lab_result_dfu_m3'])) {
							$chk['lab_result_dfu_m3'] = 'cfu/m<sup>3</sup>';
						}
						if (!empty($v['lab_result_percent_sio2'])) {
							$chk['lab_result_percent_sio2'] = '% SiO<sub>2</sub>';
						}
						if (!empty($v['lab_result_ug_tube'])) {
							$chk['lab_result_ug_tube'] = '&#956;g/tube';
						}
					}
				}
			$htm = "
			<div class=\"modal fade modal-fullscreen font-prompt\" id=\"view-modal-lg-center\" data-keyboard=\"false\" data-backdrop=\"static\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
				<form class=\"modal-dialog modal-dialog-centered\" action=\"".route('sample.analyze.result.upload.file')."\" method=\"POST\" enctype=\"multipart/form-data\" role=\"document\">
					<div class=\"modal-content\">
						<div class=\"modal-header bg-info text-white\">
							<h5 class=\"modal-title\">บันทึกการทวนสอบผลการวิเคราะห์ Lab No: ".$request->lab_no."</h5>
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
												<th colspan=\"".count($chk)."\" style=\"vertical-align:middle;text-align:center;\">ผลการทดสอบ</th>
											</tr>
											<tr>";
											foreach ($chk as $key => $value) {
												$htm .= "<th style=\"vertical-align:middle;text-align:center;\">".$value."</>";
											}
											$htm .= "</tr>
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
													<td><div style=\"width:130px\">".$value['weight_sample']."</div></td>";

													if (!empty($v['lab_result_ug_sample'])) {
														$htm .= "<td><div style=\"width:100px\">".$v['lab_result_ug_sample']."</div></td>";
													}
													if (!empty($v['lab_result_mg_sample'])) {
														$htm .= "<td><div style=\"width:100px\">".$v['lab_result_mg_sample']."</div></td>";
													}
													if (!empty($v['lab_result_mg_m3'])) {
														$htm .= "<td><div style=\"width:100px\">".$v['lab_result_mg_m3']."</div></td>";
													}
													if (!empty($v['lab_result_ppm'])) {
														$htm .= "<td><div style=\"width:100px\">".$v['lab_result_ppm']."</div></td>";
													}
													if (!empty($v['lab_result_ug_g_creatinine'])) {
														$htm .= "<td><div style=\"width:130px\">".$v['lab_result_ug_g_creatinine']."</div></td>";
													}
													if (!empty($v['lab_result_mg_g_creatinine'])) {
														$htm .= "<td><div style=\"width:130px\">".$v['lab_result_mg_g_creatinine']."</div></td>";
													}
													if (!empty($v['lab_result_percent_w_v'])) {
														$htm .= "<td><div style=\"width:100px\">".$v['lab_result_percent_w_v']."</div></td>";
													}
													if (!empty($v['lab_result_percent_w_w'])) {
														$htm .= "<td><div style=\"width:100px\">".$v['lab_result_percent_w_w']."</div></td>";
													}
													if (!empty($v['lab_result_mg_l']) || !empty($v['parameter_name'])) {
														$htm .= "<td><div style=\"width:100px\">".$v['lab_result_mg_l']."</div></td>";
													}
													if (!empty($v['lab_result_ug_l'])) {
														$htm .= "<td><div style=\"width:100px\">".$v['lab_result_ug_l']."</div></td>";
													}
													if (!empty($v['lab_result_mg_kg'])) {
														$htm .= "<td><div style=\"width:100px\">".$v['lab_result_mg_kg']."</div></td>";
													}
													if (!empty($v['lab_result_ug_dl'])) {
														$htm .= "<td><div style=\"width:100px\">".$v['lab_result_ug_dl']."</div></td>";
													}
													if (!empty($v['lab_result_fiber_cc'])) {
														$htm .= "<td><div style=\"width:100px\">".$v['lab_result_fiber_cc']."</div></td>";
													}
													if (!empty($v['lab_result_dfu_m3'])) {
														$htm .= "<td><div style=\"width:100px\">".$v['lab_result_dfu_m3']."</div></td>";
													}
													if (!empty($v['lab_result_percent_sio2'])) {
														$htm .= "<td><div style=\"width:100px\">".$v['lab_result_percent_sio2']."</div></td>";
													}
													if (!empty($v['lab_result_ug_tube'])) {
														$htm .= "<td><div style=\"width:100px\">".$v['lab_result_ug_tube']."</div></td>";
													}
												$htm .= "</tr>";
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
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function showCurveResultModal(Request $request) {
		try {
			$htm = "
			<div class=\"modal fade modal-fullscreen font-prompt\" id=\"view-curve-modal-lg-center\" data-keyboard=\"false\" data-backdrop=\"static\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
				<form class=\"modal-dialog modal-dialog-centered\" action=\"".route('sample.analyze.result.upload.file')."\" method=\"POST\" enctype=\"multipart/form-data\" role=\"document\">
					<div class=\"modal-content\">
						<div class=\"modal-header bg-info text-white\">
							<h5 class=\"modal-title\">Lab No: นอเปี๊ยว</h5>
							<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
								<span aria-hidden=\"true\"><i class=\"fal fa-times\"></i></span>
							</button>
						</div>
						<div class=\"modal-body\">
						<div class=\"row\">
							<div class=\"col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3\">
								<div class=\"table-responsive\">

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
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function showAllResultModal(Request $request) {
		try {
			$result = OrderSample::select('id', 'order_id', 'has_parameter', 'sample_test_no', 'weight_sample', 'air_volume')
				->with('parameters')
				->whereOrder_id($request->order_id)
				->get();

				$data = [];
				$result->each(function($item, $key) use (&$data) {
					if (count($item->parameters) > 0) {
						array_push($data, $item->toArray());
					}
				});
				$chk = [];
				foreach ($data as $key => $value) {
					foreach ($value['parameters'] as $k => $v) {
						if (!empty($v['lab_result_ug_sample'])) {
							$chk['lab_result_ug_sample'] = '&#956;g/sample';
						}
						if (!empty($v['lab_result_mg_sample'])) {
							$chk['lab_result_mg_sample'] = 'mg/sample';
						}
						if (!empty($v['lab_result_mg_m3'])) {
							$chk['lab_result_mg_m3'] = 'mg/m<sup>3</sup>';
						}
						if (!empty($v['lab_result_ppm'])) {
							$chk['lab_result_ppm'] = 'ppm';
						}
						if (!empty($v['lab_result_ug_g_creatinine'])) {
							$chk['lab_result_ug_g_creatinine'] = '&#956;g/creatinine';
						}
						if (!empty($v['lab_result_mg_g_creatinine'])) {
							$chk['lab_result_mg_g_creatinine'] = 'mg/creatinine';
						}
						if (!empty($v['lab_result_percent_w_v'])) {
							$chk['lab_result_percent_w_v'] = '% w/v';
						}
						if (!empty($v['lab_result_percent_w_w'])) {
							$chk['lab_result_percent_w_w'] = '% w/w';
						}
						if (!empty($v['lab_result_mg_l'])) {
							$chk['lab_result_mg_l'] = 'mg/l';
						}
						if (!empty($v['lab_result_ug_l'])) {
							$chk['lab_result_ug_l'] = '&#956;g/l';
						}
						if (!empty($v['lab_result_mg_kg'])) {
							$chk['lab_result_mg_kg'] = 'mg/kg';
						}
						if (!empty($v['lab_result_ug_dl'])) {
							$chk['lab_result_ug_dl'] = '&#956;g/dl';
						}
						if (!empty($v['lab_result_fiber_cc'])) {
							$chk['lab_result_fiber_cc'] = 'fiber/cc';
						}
						if (!empty($v['lab_result_dfu_m3'])) {
							$chk['lab_result_dfu_m3'] = 'cfu/m<sup>3</sup>';
						}
						if (!empty($v['lab_result_percent_sio2'])) {
							$chk['lab_result_percent_sio2'] = '% SiO<sub>2</sub>';
						}
						if (!empty($v['lab_result_ug_tube'])) {
							$chk['lab_result_ug_tube'] = '&#956;g/tube';
						}
					}
				}
			$htm = "
			<div class=\"modal fade modal-fullscreen font-prompt\" id=\"view-all-modal-lg-center\" data-keyboard=\"false\" data-backdrop=\"static\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
				<form class=\"modal-dialog modal-dialog-centered\" action=\"".route('sample.analyze.result.upload.file')."\" method=\"POST\" enctype=\"multipart/form-data\" role=\"document\">
					<div class=\"modal-content\">
						<div class=\"modal-header bg-info text-white\">
							<h5 class=\"modal-title\">บันทึกการทวนสอบผลการวิเคราะห์ Lab No: ".$request->lab_no."</h5>
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
												<th colspan=\"".count($chk)."\" style=\"vertical-align:middle;text-align:center;\">ผลการทดสอบ</th>
											</tr>
											<tr>";
											foreach ($chk as $key => $value) {
												$htm .= "<th style=\"vertical-align:middle;text-align:center;\">".$value."</>";
											}
											$htm .= "</tr>
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
													<td><div style=\"width:130px\">".$value['weight_sample']."</div></td>";

													if (!empty($v['lab_result_ug_sample'])) {
														$htm .= "<td><div style=\"width:100px\">".$v['lab_result_ug_sample']."</div></td>";
													}
													if (!empty($v['lab_result_mg_sample'])) {
														$htm .= "<td><div style=\"width:100px\">".$v['lab_result_mg_sample']."</div></td>";
													}
													if (!empty($v['lab_result_mg_m3'])) {
														$htm .= "<td><div style=\"width:100px\">".$v['lab_result_mg_m3']."</div></td>";
													}
													if (!empty($v['lab_result_ppm'])) {
														$htm .= "<td><div style=\"width:100px\">".$v['lab_result_ppm']."</div></td>";
													}
													if (!empty($v['lab_result_ug_g_creatinine'])) {
														$htm .= "<td><div style=\"width:130px\">".$v['lab_result_ug_g_creatinine']."</div></td>";
													}
													if (!empty($v['lab_result_mg_g_creatinine'])) {
														$htm .= "<td><div style=\"width:130px\">".$v['lab_result_mg_g_creatinine']."</div></td>";
													}
													if (!empty($v['lab_result_percent_w_v'])) {
														$htm .= "<td><div style=\"width:100px\">".$v['lab_result_percent_w_v']."</div></td>";
													}
													if (!empty($v['lab_result_percent_w_w'])) {
														$htm .= "<td><div style=\"width:100px\">".$v['lab_result_percent_w_w']."</div></td>";
													}
													if (!empty($v['lab_result_mg_l']) || !empty($v['parameter_name'])) {
														$htm .= "<td><div style=\"width:100px\">".$v['lab_result_mg_l']."</div></td>";
													}
													if (!empty($v['lab_result_ug_l'])) {
														$htm .= "<td><div style=\"width:100px\">".$v['lab_result_ug_l']."</div></td>";
													}
													if (!empty($v['lab_result_mg_kg'])) {
														$htm .= "<td><div style=\"width:100px\">".$v['lab_result_mg_kg']."</div></td>";
													}
													if (!empty($v['lab_result_ug_dl'])) {
														$htm .= "<td><div style=\"width:100px\">".$v['lab_result_ug_dl']."</div></td>";
													}
													if (!empty($v['lab_result_fiber_cc'])) {
														$htm .= "<td><div style=\"width:100px\">".$v['lab_result_fiber_cc']."</div></td>";
													}
													if (!empty($v['lab_result_dfu_m3'])) {
														$htm .= "<td><div style=\"width:100px\">".$v['lab_result_dfu_m3']."</div></td>";
													}
													if (!empty($v['lab_result_percent_sio2'])) {
														$htm .= "<td><div style=\"width:100px\">".$v['lab_result_percent_sio2']."</div></td>";
													}
													if (!empty($v['lab_result_ug_tube'])) {
														$htm .= "<td><div style=\"width:100px\">".$v['lab_result_ug_tube']."</div></td>";
													}
												$htm .= "</tr>";
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
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}
}