<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\{Str,Arr};
use Illuminate\Support\Facades\{Auth,Storage,File,Log};
use App\DataTables\qc\{listOrderDataTable};
use App\Models\{Order,OrderSample,OrderSampleParameter,FileUpload};
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

	protected function listDataByLabNo(Request $request): object {
		$data = ['order_id' => $request->order_id, 'lab_no' => $request->lab_no, 'tm_verify' => $request->tm_verify];
		return view(view: 'apps.staff.qc.list-data', data: compact('data'));
	}

	protected function listDataByLabNoToDataTable(Request $request) {
		try {
			if ($request->ajax()) {
				$data = [];
				$orders = Order::with(relations: ['orderSamples', 'parameters'])->whereLab_no($request->lab_no)->get();
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
					->addColumn('sample_test_no', fn ($item) => $item['sample_test_no'])
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
						<button type=\"button\" class=\"btn btn-info btn-sm\" onClick=\"showResultModal('show_result_btn', '".$item['lab_no']."','".$item['order_id']."','".$item['sample_test_no']."');\">View result</button>
						<button type=\"button\" class=\"btn btn-info btn-sm\" onClick=\"showCurveAndQcResultModal('show_file_btn', '".$item['lab_no']."','".$item['order_id']."','".$item['sample_test_no']."');\">View curve & QC</button>";
					})
					->rawColumns(['paramet', 'btn'])
					->make(true);
			} else {
				return redirect()->back()->with(key: 'error', value: 'ไม่พบข้อมูลที่เรียก');
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with(key: 'error', value: $e->getMessage());
		}
	}

	public function showResultModal(Request $request) {
		try {
			$result = OrderSample::select('id', 'order_id', 'has_parameter', 'sample_test_no', 'weight_sample', 'air_volume')
				->whereSample_test_no($request->test_no)
				->with('parameters')
				->whereOrder_id($request->order_id)
				->get();

			$data = [];
			$result->each(function($item, $key) use (&$data) {
				if (count($item->parameters) > 0) {
					array_push($data, $item->toArray());
				}
			});

			$htm = "
			<div class=\"modal fade modal-fullscreen font-prompt\" id=\"view-modal-lg-center\" data-keyboard=\"false\" data-backdrop=\"static\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
				<form class=\"modal-dialog modal-dialog-centered\" action=\"#\" method=\"POST\" enctype=\"multipart/form-data\" role=\"document\">
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
													<td><div style=\"width:300px;text-align:left;\">".preg_replace("/\r|\n/", "", $v['parameter_name'])."</div></td>
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
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function showCurveAndQcResultModal(Request $request) {
		try {
			$order_id = [];
			$file_id = [];
			$data = [];

			$orders = Order::select('id', 'analyze_result_files')
				?->whereId($request->order_id)
				?->whereLab_no($request->lab_no)
				?->get();

			$orders->each(function($item, $key) use (&$order_id, &$file_id) {
				array_push($order_id, $item['id']);
				if (!is_null($item['analyze_result_files']) && !empty($item['analyze_result_files'])) {
					$exp = Str::of($item['analyze_result_files'])->explode(',');
					$exp->each(function($exp_item, $exp_key) use (&$file_id) {
						array_push($file_id, $exp_item);
					});
				}
			});

			$order_sample = OrderSample::select('id', 'order_id', 'sample_test_no')
				?->with('parameters', function($query) {
					$query->select('id', 'order_id', 'order_sample_id', 'lab_result_files');
				})
				?->whereSample_test_no($request->test_no)
				?->get();

			$order_sample->each(function($item, $key) use ($file_id, &$data) {
				$tmp['order_id'] = $item->order_id;
				$tmp['sample_test_no'] = $item->sample_test_no;
				$tmp['file_id'] = $file_id;
				$lab_result_files_coll = $item->parameters
					?->where('order_sample_id', $item->id)
					?->pluck('lab_result_files');

				foreach($lab_result_files_coll as $key => $value) {
					if (!is_null($value) && !empty($value)) {
						array_push($tmp['file_id'], $value);
					}
				}

				$tmp['files'] = FileUpload::find($tmp['file_id'])->toArray();
				array_push($data, $tmp);
			});

			$htm = "
			<div class=\"modal image-modal fade font-prompt\" id=\"view-curve-modal\" data-keyboard=\"false\" data-backdrop=\"static\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
				<div class=\"modal-dialog modal-lg modal-dialog-centered\" role=\"document\">
					<div class=\"modal-content\">
						<div class=\"modal-header bg-info text-white\">
							<h5 class=\"modal-title\">Lab No: ".$request->lab_no."</h5>
							<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
								<span aria-hidden=\"true\"><i class=\"fal fa-times\"></i></span>
							</button>
						</div>
						<div class=\"modal-body\">
							<div class=\"row\">
								<div class=\"col-xl-12 mb-3\">
									<div class=\"panel\">
										<div class=\"panel-container show\">
											<div class=\"panel-content\">";
											if (count($data[0]['file_id']) <= 0) {
												$htm .= "<span class=\"badge badge-lg badge-danger\">ไม่พบข้อมูล</span>";
											} else {
												$htm .= "
												<div id=\"carouselExampleCaptions\" class=\"carousel slide\" data-ride=\"carousel\">
													<ol class=\"carousel-indicators\">";
													$active = "active";
														foreach ($data[0]['file_id'] as $key => $value) {
															$htm .= "<li data-target=\"#carouselExampleCaptions\" data-slide-to=\"".$key."\" class=\"".$active."\">xx</li>\n";
															$active = "";
														}
													$htm .= "
													</ol>
													<div class=\"carousel-inner\">";
													$active = "active";
													foreach ($data[0]['files'] as $key => $value) {
														$htm .= "<div class=\"carousel-item ".$active."\">";
														$htm .= "<h1>".$value['note']."</h1>";
														$htm .= "<img class=\"d-block\" src=\"";
														$htm .= asset("labs/".$value['file_name']);
														$htm .= "\" alt=\"".$value['file_name']."\">";
														$htm .= "</div>";
														$active = "";
													}
													$htm .= "
													</div>
													<a class=\"carousel-control-prev\" href=\"#carouselExampleCaptions\" role=\"button\" data-slide=\"prev\">
														<span class=\"carousel-control-prev-icon\" aria-hidden=\"true\"></span>
														<span class=\"sr-only\">Previous</span>
													</a>
													<a class=\"carousel-control-next\" href=\"#carouselExampleCaptions\" role=\"button\" data-slide=\"next\">
														<span class=\"carousel-control-next-icon\" aria-hidden=\"true\"></span>
														<span class=\"sr-only\">Next</span>
													</a>
												</div>";
											}
											$htm .= "
											</div>
										</div>
									</div>
								</div>
							</div>
						<div class=\"modal-footer\">
							<button type=\"button\" class=\"btn btn-info\" data-dismiss=\"modal\" style=\"width: 120px\">Close</button>
						</div>
					</div>
				</div>
			</div>";
			$data = preg_replace(pattern: "/\r|\n|\t/", replacement: "", subject: $htm);
			return $data;
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
			$htm = "
			<div class=\"modal fade modal-fullscreen font-prompt\" id=\"view-modal-lg-center\" data-keyboard=\"false\" data-backdrop=\"static\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
				<form class=\"modal-dialog modal-dialog-centered\" action=\"#\" method=\"POST\" enctype=\"multipart/form-data\" role=\"document\">
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
												<th style=\"vertical-align:middle;text-align:center;\">หน่วยรายงานผล</th>
												<th style=\"vertical-align:middle;text-align:center;\">หน่วยทางเลือก 1</th>
												<th style=\"vertical-align:middle;text-align:center;\">หน่วยทางเลือก 2</th>
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
													<td><div class=\"v-wp\"><div>".$v['unit_customer_value']."</div><div>".$v['unit_customer_name']."</div></div></td>
													<td><div class=\"v-wp\"><div>".$v['unit_choice1_value']."</div><div>".$v['unit_choice1_name']."</div></div></td>
													<td><div class=\"v-wp\"><div>".$v['unit_choice2_value']."</div><div>".$v['unit_choice2_name']."</div></div></td>
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
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function approved(Request $request): mixed {
		try {
			$order = Order::findOr($request->order_id, fn () => throw new \Exception('ไม่พบข้อมูล Order ที่เรียก ID: '.$request->order_id));
			if (($order->count() > 0)) {
				if ($order->order_status == 'analyzed' && $order->tm_verify_status = 'pending') {
					$order->tm_verify_status = 'approve';
					$order->save();
					return redirect()->back()->with(key: 'success', value: 'Approved Lab No: '.$request->lab_no.' สำเร็จ');
				} else {
					return redirect()->back()->with(key: 'error', value: 'Lab No: '.$request->lab_no.' ไม่อยู่ในสถานะที่จะ Approved ได้ โปรดตรวจสอบความครบถ้วนของข้อมูล');
				};
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with(key: 'error', value: $e->getMessage());
		}
	}

	protected function reject(Request $request): mixed {
		try {
			$order = Order::findOr($request->order_id, fn () => throw new \Exception('ไม่พบข้อมูล Order ที่เรียก ID: '.$request->order_id));
			if (($order->count() > 0)) {
				if ($order->order_status == 'analyzed' &&  $order->tm_verify_status = 'pending') {
					$order->order_status = 'reject';
					$order->save();
					$msg = json_encode(['type' => 'success', 'title' => 'Success', 'text' => 'Reject Lab No: '.$request->lab_no.' สำเร็จ']);
				} else {
					$msg = json_encode(['type' => 'error', 'title' => 'Error!', 'text' => 'Lab No: '.$request->lab_no.' ไม่อยู่ในสถานะที่จะ Reject ได้']);
				};
				return $msg;
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return json_encode(['type' => 'error', 'title' => 'Error!', 'text' => $e->getMessage()]);
		}
	}
}
