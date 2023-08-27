<?php

namespace App\Http\Controllers;

// use App\DataTables\ReceivedExampleDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\{Response,DB,Storage,Log};
use App\Services\OrderService;
use App\Traits\{DateTimeTrait,CommonTrait,DbBoundaryTrait};
use App\Exceptions\{OrderNotFoundException,InvalidOrderException};
use App\Models\{User,UserCustomer,Order,OrderSample,OrderSampleParameter,FileUpload,Parameter};
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

class SampleReceiveController extends Controller
{
	use DateTimeTrait, CommonTrait, DbBoundaryTrait;

	/**
	* Show the index page
	* @Resource('sample.received.index')
	*/
	protected function index(): object {
		return view(view: 'apps.staff.receive.index');
	}

	/**
	* Create Order page
	* @Resource('sample.received.create')
	*/
	protected function create(Request $request): object {
		try {
			/* clear all session for page step */
			$request->session()->forget(keys: 'order');
			$request->session()->forget(keys: 'sample_result');
			$request->session()->forget(keys: 'sample_sumary');

			/* begin query */
			$order_year = (date('Y'));
			$orders = OrderService::getOrderwithCount(relations: ['orderSamples', 'parameters'], order_year: $order_year, order_status: ['pending', 'preparing', 'approved', 'completed']);
			return Datatables::of($orders)
				?->addColumn('total', fn ($order) => $order->order_samples_count.'/'.$order->parameters_count)
				?->editColumn('order_confirmed_date', fn ($order) => $this->setJsDateTimeToJsDate($order->order_confirmed_date))
				?->addColumn('action', function ($order) {
					if (!empty($order->order_confirmed_date)) {
						switch ($order->order_status) {
							case 'pending':
								return "
									<a href=\"".route('sample.received.step01', ['order_id' => $order->id])."\" class=\"btn btn-sm btn-success\" style=\"width:70px\">รับ</a>\n
									<button type=\"button\" class=\"btn btn-sm btn-secondary\" style=\"width:70px\">แก้ไข</button>\n";
									break;
							case 'preparing':
							case 'approved':
								return "<button type=\"button\" class=\"btn btn-sm btn-warning\" style=\"width:140px\" disabled>รับตัวอย่างแล้ว</button>\n";
								break;
							case 'completed':
								return "<button type=\"button\" class=\"btn btn-sm btn-success\" style=\"width:140px\" disabled>เสร็จสิ้น</button>\n";
								break;
							default:
								return "<button type=\"button\" class=\"btn btn-sm btn-secondary\" style=\"width:140px\" disabled>ไม่ทราบสถานะ</button>\n";
								break;
						}
					} else {
						return "<button class=\"btn btn-sm btn-warning\" style=\"width:140px\" disable>ไม่สมบูรณ์</button>";
					}
				})->make(true);
		} catch (InvalidOrderException $e) {
			report($e->getMessage());
			return redirect()->back()->with(key: 'error', value: $e->getMessage());
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return view(view: 'errors.show', data: ['error' => $e->getMessage()]);
		}
	}

	private function setLabNo($order_id=0, $created_at=null): string {
		$exp1 = explode(" ", $created_at);
		$exp2 = explode("-", $exp1[0]);
		$th_year = substr((intval($exp2[0])+543), -2);
		$tmp = sprintf('%05d', $order_id);
		$lab_no = $tmp.$th_year;
		return $lab_no;
	}

	/**
	* Create Sample Step 01
	* @Get('sample.received.step01')
	*/
	protected function step01(Request $request) {
		try {
			$order = OrderService::get(id: $request->order_id);
			$order->lab_no = (empty($order->lab_no)) ? $this->setLabNo(order_id: $order->id, created_at: $order->created_at) : $order->lab_no;
			$sample_character_name = [];
			$work_group = [];
			$order_parameter = $order->parameters
				->groupBy('sample_character_name')
				->map(function($item, $key) use (&$sample_character_name, &$work_group) {
					$tmp_order_sample = [];
					$tmp_work_group = [];
					$item->each(function($i, $k) use (&$tmp_order_sample, &$tmp_work_group) {
						array_push($tmp_order_sample, $i['order_sample_id']);
						array_push($tmp_work_group, $i['threat_type_name']);
					});
					$tmp_order_sample = array_unique($tmp_order_sample);
					$tmp_work_group = array_unique($tmp_work_group);
					$sample_character_name[$key] = ['sample_amount' => count($tmp_order_sample), 'paramet_amount' => $item->count()];
					array_push($work_group, $tmp_work_group);
			});
			$work_group = collect(array_unique(Arr::collapse($work_group)))->implode(',');
			$type_of_work = $this->typeOfWork();
			return view(view: 'apps.staff.receive.step01', data: compact('order', 'type_of_work', 'sample_character_name', 'work_group'));
		} catch (OrderNotFoundException $e) {
			report($e->getMessage());
			return redirect()->back()->with(key: 'error', value: $e->getMessage());
		} catch (\Exception $e) {
			return view(view: 'errors.show', data: ['error' => $e->getMessage()]);
		}
	}

	protected function step01Post(Request $request): object {
		$validated = $request->validate([
			'id' => 'required',
			"order_no" => "required",
			"order_no_ref" => "required",
			"order_type" => "required",
			"order_type_name" => "required",
			'lab_no' => 'required|max:30|unique:orders,lab_no',
			'report_due_date' => 'required',
			'type_of_work' => 'required',
			'type_of_work_other' => 'nullable|max:90',
			'book_no' => 'required|max:60',
			'book_date' => 'required',
			'work_group' => 'required',
		],[
			'lab_no.required' => 'โปรดกรอกรหัสแลป',
			'report_due_date.required' => 'โปรดเลือกวันที่กำหนดส่งรายงาน',
			'book_no.required' => 'โปรดกรอกเลขที่หนังสือนำส่ง',
		]);

		if (empty($request->session()->get(key: 'order'))) {
			$order = new Order();
			$order->fill(attributes: $validated);
			$request->session()->put(key: 'order', value: $order);
		} else {
			$order = $request->session()->get(key: 'order');
			$order->fill(attributes: $validated);
			$request->session()->put(key: 'order', value: $order);
		}
		return redirect()->route(route: 'sample.received.step02', parameters: ['order_id' => $order['id']]);
	}

	protected function step02(Request $request) {
		try {
			$session_sample_result = ($request->session()->has(key: 'sample_result')) ? $request->session()->get(key: 'sample_result') : null;
			$order = $request->session()->get(key: 'order');
			$result = [];
			$order_sample = OrderSample::whereOrder_id($order['id'])->with('parameters')->get();
			$order_sample->each(function($item, $key) use (&$result) {
				$tmp['sample_id'] = $item->id;
				$tmp['sample_count'] = $item->parameters->count();
				$tmp['sample_verified_status_'.$item->id] = $item->sample_verified_status;
				$tmp['sample_received_status_'.$item->id] = $item->sample_received_status;
				$tmp_paramet_type = [];
				$tmp_paramet_name = [];
				foreach ($item->parameters as $key => $value) {
					array_push($tmp_paramet_type, $value->sample_character_name);
					array_push($tmp_paramet_name, $value->parameter_name);
				}
				$tmp_paramet_type = array_unique($tmp_paramet_type);
				$tmp['parameter_type'] = $tmp_paramet_type;
				$tmp_paramet_name = array_unique($tmp_paramet_name);
				$tmp['parameter_name'] = $tmp_paramet_name;
				array_push($result, $tmp);
			});

			return view(view: 'apps.staff.receive.step02', data: compact('order', 'result', 'session_sample_result'));
		} catch (OrderNotFoundException $e) {
			report($e->getMessage());
			return redirect()->back()->with(key: 'error', value: $e->getMessage());
		} catch (\Exception $e) {
			return view(view: 'errors.show', data: ['error' => $e->getMessage()]);
		}
	}

	protected function step02Post(Request $request) {
		foreach ($request->sample_id as $val) {
			$req['sample_verified_status_'.$val] = 'required';
			$req['sample_received_status_'.$val] = 'required';
		}
		$validated = $request->validate($req);

		$data = $request->toArray();
		if (count($data['sample_id']) > 0) {
			foreach ($data['sample_id'] as $value) {
				$sample[$value]['id'] = $value;
				$sample[$value]['sample_count'] = $data['sample_count_'.$value];
				$sample[$value]['sample_verified_status_'.$value] = $data['sample_verified_status_'.$value] ?? null;
				$sample[$value]['sample_received_status_'.$value] = $data['sample_received_status_'.$value] ?? null;
			}
		}

		if ($request->session()->has(key: 'sample_result')) {
			$request->session()->forget(keys: 'sample_result');
		}
		$request->session()->put(key: 'sample_result', value: $sample);

		if ($request->session()->has(key: 'sample_sumary')) {
			$request->session()->forget(keys: 'sample_sumary');
		}
		$sample_sumary = [
			'sample_completed' => 0,
			'sample_completed_amount' => 0,
			'sample_not_completed' => 0,
			'sample_not_completed_amount' => 0
		];
		foreach ($sample as $key => $value) {
			if ($value['sample_verified_status_'.$value['id']] == 'complete' && $value['sample_received_status_'.$value['id']] == 'y') {
				$sample_sumary['sample_completed'] += 1;
				$sample_sumary['sample_completed_amount'] += (int)$value['sample_count'];
			} else {
				$sample_sumary['sample_not_completed'] += 1;
				$sample_sumary['sample_not_completed_amount'] += (int)$value['sample_count'];
			}
		}
		$request->session()->put(key: 'sample_sumary', value: $sample_sumary);
		return redirect()->route(route: 'sample.received.step03', parameters: ['order_id' => $request->order_id]);
	}

	protected function step03(Request $request) {
		$order_id = $request->order_id;
		$sample_sumary = $request->session()->get(key: 'sample_sumary');
		// $sample_result = $request->session()->get(key: 'sample_result');
		return view(view: 'apps.staff.receive.step03', data: compact('order_id', 'sample_sumary'));
	}

	protected function step03Post(Request $request) {
		try {
			$user_staff = User::find(auth()->user()->id)->userStaff;
			$user_staff_full_name = $user_staff->first_name." ".$user_staff->last_name;
			$order_id = $request->order_id;
			$sample_result = $request->session()->get(key: 'sample_result');
			$order_arr = $request->session()->get(key: 'order')->toArray();
			$order = OrderService::get($order_id);
			$order->fill(attributes: $order_arr);
			// DB::transaction(function() use ($sample_result, $order, $user_staff_full_name) {
				foreach ($sample_result as $key => $value) {
					$order_sample = OrderSample::findOr($value['id'], fn () => throw new \Exception('ไม่พบข้อมูล Order Sample id: '.$value['id']));
					$order_sample->sample_verified_status = $value['sample_verified_status_'.$value['id']];
					$order_sample->sample_received_status = $value['sample_received_status_'.$value['id']];
					$order_sample->sample_received_date = date('Y-m-d');
					$order_sample->save();
				}
				$order->fill(attributes: ['order_status' => 'preparing', 'received_order_name' => $user_staff_full_name, 'received_order_date' => date('d/m/Y')]);
				$order->save();
			// });
			return view('apps.staff.receive.step04', compact('order_id', 'order_arr'));
		} catch (OrderNotFoundException $e) {
			report($e->getMessage());
			return redirect()->back()->with(key: 'error', value: $e->getMessage());
		} catch (\Exception $e) {
			dd($e->getMessage());
			Log::error($e->getMessage());
			return redirect()->route('sample.received.index')->with(key: 'error', value: $e->getMessage());
		}
	}

	protected function print(Request $request) {
		try {
			$order = Order::with(['orderSamples' => fn ($q) => $q->where('sample_received_status', '=', 'y')])->whereId($request->order_id)->get();
			if ($order[0]->orderSamples->count() > 0) {
				$file_name = 'sample_receipt_order_'.$request->order_id.'_lab_'.$order[0]->lab_no.'.pdf';
				if ($order[0]->receipt_status != 'y') {
					$order_sample_id_arr = $order[0]->orderSamples->map(fn ($value, $key) => $value->id)->toArray();
					$parameters = OrderSampleParameter::whereIn('order_sample_id', $order_sample_id_arr)->get();
					$parameters_total_price = $parameters->reduce(fn($sum, $value) => ($sum+$value->price_name));
					$user_id_arr = str_split(sprintf("%04d", auth()->user()->id));
					$lab_no_arr = str_split($order[0]->lab_no);

					$user_customer = UserCustomer::whereUser_id($order[0]->user_id)->get();

					$user_prov = $this->provinceNameByProvId($user_customer[0]->province) ?? '';
					$user_dist = $this->districtNameByDistId($user_customer[0]->district) ?? '';
					$user_sub_dist = $this->subDistrictNameBySubDistId($user_customer[0]->sub_district) ?? '';
					$contact_user_prov = $this->provinceNameByProvId($user_customer[0]->contact_province) ?? '';
					$contact_user_dist = $this->districtNameByDistId($user_customer[0]->contact_district) ?? '';
					$contact_user_sub_dist = $this->subDistrictNameBySubDistId($user_customer[0]->contact_sub_district) ?? '';

					$parameters_count_deep = $parameters->countBy(fn ($q) => $q->sample_character_id);
					$parameters_count_deep->all();

					$data = collect([
						'order_id' => $request->order_id,
						'user_id_arr' => $user_id_arr,
						'lab_no' => $order[0]->lab_no,
						'lab_no_arr' => $lab_no_arr,
						'report_due_date' => $order[0]->report_due_date,
						'type_of_work' => $order[0]->type_of_work,
						'order_type' => $order[0]->order_type,
						'order_samples_count' => $order[0]->orderSamples->count(),
						'parameters_count' => $parameters->count(),
						'parameters_count_deep' => $parameters_count_deep->toArray(),
						'origin_threat_id' => $order[0]->orderSamples[0]->origin_threat_id,
						'customer_agency_name' => $order[0]->customer_agency_name,
						'customer_address' => $user_customer[0]->address.' ต.'.$user_sub_dist.' อ.'.$user_dist.' จ.'.$user_prov.' '.$user_customer[0]->postcode,
						'customer_mobile' => $user_customer[0]->mobile,
						'deliver_method' => $order[0]->deliver_method,
						'book_no' => $order[0]->book_no,
						'book_date' => $order[0]->book_date,
						'first_name' => $user_customer[0]->first_name,
						'last_name' => $user_customer[0]->last_name,
						'mobile' => $user_customer[0]->mobile,
						'contact_first_name' => $user_customer[0]->first_name,
						'contact_last_name' => $user_customer[0]->last_name,
						'contact_mobile' => $user_customer[0]->mobile,
						'contact_address'=> $user_customer[0]->address.' ต.'.$contact_user_sub_dist.' อ.'.$contact_user_dist.' จ.'.$contact_user_prov.' '.$user_customer[0]->contact_postcode,
						'order_created_at' => substr($this->convertMySQLDateTimeToJs($order[0]->created_at), 0, 10),
						'contact_addr_opt' => $user_customer[0]->contact_addr_opt,
						'report_result_receive_method' => $order[0]->report_result_receive_method,
						'sample_sumary' => $request->session()->get(key: 'sample_sumary'),
						'sample_verify_desc' => $order[0]->sample_verify_desc,
						'received_order_name' => $order[0]->received_order_name,
						'received_order_date' => $order[0]->received_order_date,
						'review_order_name' => $order[0]->review_order_name,
						'review_order_date' => $order[0]->review_order_date,
						'parameters_total_price' => $parameters_total_price,
					]);

					switch($data['contact_addr_opt']) {
						case "1":
							$data->put('report_result_receive_first_name', $data['first_name']);
							$data->put('report_result_receive_last_name', $data['last_name']);
							$data->put('report_result_receive_mobile', $data['mobile']);
							$data->put('report_result_receive_addr', $data['customer_address']);
							break;
						case "2":
							$data->put('report_result_receive_first_name', $data['contact_first_name']);
							$data->put('report_result_receive_last_name', $data['contact_last_name']);
							$data->put('report_result_receive_mobile', $data['contact_mobile']);
							$data->put('report_result_receive_addr', $data['contact_address']);
							break;
					}
					$data = $data->all();

					/* put file to storage */
					$pdf = Pdf::loadView('print.sample-receipt', $data);
					$content = $pdf->download()->getOriginalContent();
					Storage::disk('receipt')->put($file_name ,$content);

					/* insert file detail to table */
					$file_upload = new FileUpload;
					$file_upload->ref_user_id = auth()->user()->id;
					$file_upload->order_id = $request->order_id;
					$file_upload->file_name = $file_name;
					$file_upload->file_mime = Storage::disk('receipt')->mimeType($file_name);
					$file_upload->file_path = '/receipt';
					$file_upload->file_size =  (round(Storage::disk('receipt')->size($file_name)/1024)) ?? 0;
					$file_upload->note = 'ใบรับตัวอย่าง';
					$file_upload->save();

					/* update receipt status */
					$order_model = Order::find($request->order_id);
					$order_model->receipt_status = 'y';
					$order_model->save();

					if (!Storage::disk('receipt')->missing($file_name)) {
						return Storage::disk('receipt')->download($file_name);
					} else {
						return false;
					}
				} else {
					return redirect()->route(route: 'sample.received.index')->with(key: 'error', value: 'ข้อมูลรายการนี้ ถูกพิมพ์ครบกำหนดแล้ว');
				}
			} else {
				return redirect()->route(route: 'sample.received.index')->with(key: 'error', value: 'ข้อมูลรายการนี้ อยู่ในสถานะยกเลิกหรือไม่สมบูรณ์');
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->route(route: 'sample.received.index')->with(key: 'error', value: $e->getMessage());
		}
	}

	protected function createTestNo(): object {
		return view(view: 'apps.staff.receive.testno.create');
	}

	protected function searchOrderSampleByLabNo(Request $request): string {
		try {
			if (!empty($request->lab_no)) {
				$order = Order::select('id')->whereLab_no($request->lab_no)->get();
				$result = [];
				if (count($order) > 0) {
					$order_sample = OrderSample::select(
						'id',
						'order_id',
						'has_parameter',
						'sample_verified_status',
						'sample_received_status',
						'sample_received_date',
						'sample_test_no'
					)
					?->with('parameters')
					?->whereOrder_id($order[0]->id)
					?->whereSample_received_status('y')
					?->where('sample_test_no', '=', '')
					?->orWhereNull('sample_test_no')
					?->get();
					$order_sample->each(function($item, $key) use (&$result) {
						$tmp['sample_id'] = $item->id;
						$tmp['sample_count'] = $item->parameters->count();
						$tmp['sample_verified_status_'.$item->id] = $item->sample_verified_status;
						$tmp['sample_received_status_'.$item->id] = $item->sample_received_status;
						$tmp['sample_test_no'] = $item->sample_test_no;
						$tmp_paramet_type = [];
						$tmp_paramet_name = [];
						foreach ($item->parameters as $key => $value) {
							array_push($tmp_paramet_type, $value->sample_character_name);
							array_push($tmp_paramet_name, $value->parameter_name);
						}
						$tmp_paramet_type = array_unique($tmp_paramet_type);
						$tmp['parameter_type'] = $tmp_paramet_type;
						$tmp_paramet_name = array_unique($tmp_paramet_name);
						$tmp['parameter_name'] = $tmp_paramet_name;
						array_push($result, $tmp);
					});
				}
				$htm_component = $this->orderSampleComponent(data: $result, lab_no: $request->lab_no);
				return $htm_component;
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function orderSampleComponent($data=array(), $lab_no=0) {
		$htm = "
			<div class=\"table-responsive\">
				<table class=\"table table-striped\" style=\"width: 100%\">
					<thead>
						<tr class=\"bg-primary text-white\">
							<th>ลำดับ</th>
							<th>รหัส ตย.</th>
							<th>ชนิด ตย.</th>
							<th>รายการทดสอบ</th>
							<th>จำนวนรายการทดสอบ</th>
							<th>หมายเลขทดสอบ</th>
						</tr>
					</thead>
					<tfoot></tfoot>
					<tbody>";
					if (count($data) > 0) {
						$i = 1;
						foreach ($data as $key => $value) {
							$htm .= "<tr>";
								$htm .= "<td>".$i."</td>";
								$htm .= "<td>";
									$htm .= "<span>".$value['sample_id']."</span>";
									$htm .= "<input type=\"hidden\" name=\"sample_id[]\" value=\"".$value['sample_id']."\" />";
								$htm .=" </td>";
								$htm .= "<td>";
									foreach ($value['parameter_type'] as $key1 => $value1) {
										$htm .= "<ul>";
										$htm .= "<li>".$value1."</li>";
										$htm .= "</ul>";
									}
								$htm .= "</td>";
								$htm .= "<td>";
									foreach ($value['parameter_name'] as $key2 => $value2) {
										$htm .= "<ul>";
										$htm .= "<li>".$value2."</li>";
										$htm .= "</ul>";
									}
								$htm .= "</td>";
								$htm .= "<td>".$value['sample_count']."</td>";
								$htm .= "<td><input type=\"text\" name=\"sample_no[]\" value=\"".$value['sample_test_no']."\" class=\"form-control\" readonly /></td>";
							$htm .= "</tr>";
							$i++;
						}
					} else {
						$htm .= "<tr>";
							$htm .= "<td colspan=\"6\">";
								$htm .= "<div class=\"alert alert-warning\" role=\"alert\"><strong><i class=\"fa fa-info-circle\"></i> ไม่พบข้อมูลหรือกำหนดหมายเลขทดสอบแล้ว Lab No. ".$lab_no."</strong></div>";
							$htm .= "</td>";
						$htm .= "</tr>";
					}
					$htm .= "
					</tbody>
				</table>
			</div>";
		return $htm;
	}

	private function generateTestNo(): string {
		do {
			$rand_number = mt_rand(min: 1000000000, max: 9999999999);
		} while (OrderSample::whereSample_test_no($rand_number)->exists());
		return $rand_number;
	}

	protected function setTestNo(Request $request) {
		try {
			$data = $request->all();
			if (!empty($data['sample_id']) && count($data['sample_id']) > 0) {
				foreach ($data['sample_id'] as $key => $value) {
					$order_sample = OrderSample::findOr($value, fn () => throw new \Exception(message: 'ไม่พบข้อมูล Order Sample id: '.$value));
					if (empty($order_sample->sample_test_no)) {
						$order_sample->sample_test_no = $this->generateTestNo();
						$order_sample->save();
					}
				}
				return $this->createTestNoBarcode(lab_no: $data['set_test_no_search'], message: 'บันทึกหมายเลขทดสอบแล้ว');
			} else {
				return redirect()->back()->with('error', 'โปรดตรวจสอบรายการข้อมูล');
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with('error', $e->getMessage());
		}
	}

	protected function createTestNoBarcode($lab_no=null, $message=null) {
		try {
			if (!empty($lab_no)) {
				$order = Order::select('id')->whereLab_no($lab_no)->get();
				$result = [];
				if (count($order) > 0) {
					$order_sample = OrderSample::whereOrder_id($order[0]->id)->with('parameters')->whereSample_received_status('y')->get();
					$order_sample->each(function($item, $key) use (&$result) {
						$tmp['sample_id'] = $item->id;
						$tmp['sample_count'] = $item->parameters->count();
						$tmp['sample_verified_status_'.$item->id] = $item->sample_verified_status;
						$tmp['sample_received_status_'.$item->id] = $item->sample_received_status;
						$tmp['sample_test_no'] = $item->sample_test_no;
						$tmp_paramet_type = [];
						$tmp_paramet_name = [];
						foreach ($item->parameters as $key => $value) {
							array_push($tmp_paramet_type, $value->sample_character_name);
							array_push($tmp_paramet_name, $value->parameter_name);
						}
						$tmp_paramet_type = array_unique($tmp_paramet_type);
						$tmp['parameter_type'] = $tmp_paramet_type;
						$tmp_paramet_name = array_unique($tmp_paramet_name);
						$tmp['parameter_name'] = $tmp_paramet_name;
						array_push($result, $tmp);
					});
				}
				return view(view: 'apps.staff.receive.testno.barcode', data: ['result' => $result]);
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with('error', $e->getMessage());
		}
	}

	protected function printTestNoBarcode(Request $request) {
		try {
			$req = $request->all();
			if (count($req) > 0 && count($req['sample_no']) > 0) {
				$file_name = 'sample_test_no_barcode_'.time().'.pdf';
				$data = ['sample_no' => $req['sample_no']];
				$pdf = Pdf::loadView('print.test-no-barcode', $data);
				return $pdf->download($file_name);
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with('error', $e->getMessage());
		}
	}

	protected function createRequisition(Request $request) {
		/* get analyze user for select option */
		$parameters = Parameter::select('main_analys_user_id', 'main_analys')->groupBy('main_analys_user_id')->orderBy('main_analys')->get()->toArray();
		foreach ($parameters as $key => $value) {
			if (!is_null($value['main_analys_user_id'])) {
				$analyze_user[$value['main_analys_user_id']] = $value['main_analys'];
			} else {
				continue;
			}
		};
		return view(view: 'apps.staff.receive.requisition.create', data: compact('analyze_user'));
	}

	protected function createRequisitionAjax(Request $request) {
		try {
			if (!empty($request->lab_no)) {
				$order = Order::select('id')->whereLab_no(trim($request->lab_no))->get();
				if (count($order) > 0) {
					$order_sample = OrderSample::whereOrder_id($order[0]->id)
						->with('parameters', function($query) {
							$query->whereIn('status', ['pending', 'reserved', 'requisition', 'analyzing', 'completed']);
						})
						->whereSample_verified_status('complete')
						->whereSample_received_status('y')
						->whereNotNull('sample_test_no')
						->get();
					$result = [];
					$order_sample->each(function($item, $key) use (&$result, $request) {
						$analyze_user = trim($request->analyze_user);
						foreach ($item->parameters as $k => $v) {
							if (!empty($analyze_user) && $analyze_user != $v['main_analys_user_id']) {
									continue;
								} else {
								$tmp['lab_no'] = $request->lab_no;
								$tmp['order_id'] = $v['order_id'];
								$tmp['order_sample_id'] = $v['order_sample_id'];
								$tmp['order_sample_parameter_id'] = $v['id'];
								$tmp['paramet_id'] = $v['parameter_id'];
								$tmp['paramet_name'] = $v['parameter_name'];
								$tmp['sample_character_id'] = $v['sample_character_id'];
								$tmp['sample_character_name'] = $v['sample_character_name'];
								$tmp['main_analys_user_id'] = $v['main_analys_user_id'];
								$tmp['main_analys_name'] = $v['main_analys_name'];
								$tmp['status'] = $v['status'];
							}
							array_push($result, $tmp);
						};
					});
				}
				$htm = "
				<div class=\"table-responsive\">
					<table class=\"table table-striped\" style=\"width: 100%\">
						<thead>
							<tr class=\"bg-primary text-white\">
								<th>ลำดับ</th>
								<th>Lab No</th>
								<th>รายการทดสอบ</th>
								<th>ผู้วิเคราะห์</th>
								<th>เลือก</th>
							</tr>
						</thead>
						<tfoot></tfoot>
						<tbody>";
						if (count($result) > 0) {
							$i = 1;
							foreach ($result as $key => $value) {
								if (count($value) > 1) {
									$htm .= "<tr>";
										$htm .= "<td>".$i."</td>";
										$htm .= "<td>".$value['lab_no']."</td>";
										$htm .= "<td>".$value['paramet_name']."</td>";
										$htm .= "<td>".$value['main_analys_name']."</td>";
										match ($value['status']) {
											'pending' => $htm .= "<td><button type=\"button\" class=\"btn btn-info btn-sm\" style=\"width:100px;\" disabled>รอจอง</button></td>",
											'reserved' => $htm .= "
												<td>
													<button type=\"button\" class=\"btn btn-success btn-sm requisition-btn\" style=\"width:100px;\" onClick='updateRequisitionStatus(\"".$value['lab_no']."\", \"".$value['main_analys_user_id']."\", \"".$value['order_sample_parameter_id']."\")'>เบิก</button>
												</td>",
											'analyzing' => $htm .= "<td><button type=\"button\" class=\"btn btn-warning btn-sm\" style=\"width:100px;\" disabled>วิเคราะห์</button></td>",
											'completed' => $htm .= "<td><button type=\"button\" class=\"btn btn-primary btn-sm\" style=\"width:100px;\" disabled>เสร็จสิ้น</button></td>",
										};
									$htm .= "</tr>";
								} else {
									continue;
								}
								$i++;
							}
						} else {
							$htm .= "<tr>";
								$htm .= "<td colspan=\"6\">";
									$htm .= "<div class=\"alert alert-danger\" role=\"alert\"><strong>ไม่พบข้อมูลที่ค้นหา</strong></div>";
								$htm .= "</td>";
							$htm .= "</tr>";
						}
						$htm .= "
						</tbody>
					</table>
				</div>";

				return $htm;
			} else {
				return "<div class=\"alert alert-danger mt-4\" role=\"alert\"><strong>โปรดกรอกข้อมูลให้ถูกต้อง</strong></div>";
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with(key: 'error', value: $e->getMessage());
		}
	}

	protected function updateRequisition(Request $request) {
		try {
			if (!empty($request->order_sample_parameter_id)) {
				$order_sample_paramet = OrderSampleParameter::findOrFail($request->order_sample_parameter_id);
				$order_sample_paramet->status = 'analyzing';
				$saved = $order_sample_paramet->save();
				if ($saved) {
					return response()->json([
						'success' => true,
						'lab_no' => $request->lab_no,
						'analyze_user' => $request->analyze_user,
						'order_sample_parameter_id' => $request->order_sample_parameter_id
					]);
				} else {
					return response()->json(['success' => false, 'message' => 'เบิกตัวอย่างไม่ได้']);
				}
			} else {
				return response()->json(['success' => false, 'message' => 'ไม่พบรหัส Parameter ที่เลือก']);
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function printRequisition(Request $request) {
		if (!empty($request->lab_no)) {
			$order = Order::select('id', 'type_of_work', 'received_order_date', 'lab_no', 'report_due_date')->whereLab_no(trim($request->lab_no))->get();
			if (count($order) > 0) {
				$order_sample = OrderSample::whereOrder_id($order[0]->id)->with('parameters', function($query) {
					$query->whereIn('status', ['pending', 'reserved', 'analyzing', 'completed']);
				})->whereSample_received_status('y')->get();

				$result = [
					'order' => [
						'order_id' => $order[0]->id,
						'type_of_work' => $order[0]->type_of_work,
						'report_due_date' => $order[0]->report_due_date,
						'lab_no' => $order[0]->lab_no,
						'received_order_date' => $order[0]->received_order_date,
					],
					'order_sample_paramet' => [],
					'order_main_analys_name' => [],
					'order_main_control_analys_name' => []
				];

				$order_sample->each(function($item, $key) use (&$result, $request) {
					foreach ($item->parameters as $k => $v) {
						// if (!empty($request->analyze_user) && $v['main_analys_user_id'] != $request->analyze_user) {
						// 	continue;
						// } else {
							$tmp['order_id'] = $v['order_id'];
							$tmp['order_sample_id'] = $v['order_sample_id'];
							$tmp['order_sample_parameter_id'] = $v['id'];
							$tmp['paramet_id'] = $v['parameter_id'];
							$tmp['paramet_name'] = $v['parameter_name'];
							$tmp['sample_character_id'] = $v['sample_character_id'];
							$tmp['sample_character_name'] = $v['sample_character_name'];
							$tmp['main_analys_user_id'] = $v['main_analys_user_id'];
							$tmp['main_analys_name'] = $v['main_analys_name'];
							$tmp['status'] = $v['status'];
							$tmp['sample_test_no'] = $item->sample_test_no;
							if (!empty($v['main_analys_user_id'])) {
								$result['order_main_analys_name'][$v['main_analys_user_id']] = $v['main_analys_name'];
							}
							if (!empty($v['main_control_user_id'])) {
								$result['order_main_control_analys_name'][$v['main_control_user_id']] = $v['main_control'];
							}
							array_push($result['order_sample_paramet'], $tmp);
						// }
					};
				});
				$result['order']['paramet_amount'] = count($result['order_sample_paramet']);
				return view(view: 'apps.staff.receive.requisition.print', data: compact('result'));
			}
		}
		return redirect()->back()->with(key: 'error', value: 'ไม่พบ Lab No. โปรดตรงจสอบ');
	}

	protected function createReport(): object {
		return view(view: 'apps.staff.receive.report.create');
	}

	protected function createReportAjax(Request $request) {
		try {
			if (!empty($request->lab_no)) {
				$order = Order::select('id', 'lab_no', 'order_status', 'report_due_date')->whereLab_no(trim($request->lab_no))->get();
				if (count($order) > 0) {
					$order_sample = OrderSample::whereOrder_id($order[0]->id)->with('parameters', function($query) {
						$query->whereIn('status', ['pending', 'requisition']);
					})->whereSample_received_status('y')->get();
					$result = [
						'order' => []
					];
					$order_sample->each(function($item, $key) use (&$result, $request, $order) {
						foreach ($item->parameters as $k => $v) {
							if (array_key_exists($v['main_analys_user_id'], $result['order'])) {
								continue;
							} else {
								$tmp['lab_no'] = $request->lab_no;
								$tmp['report_due_date'] = $order[0]->report_due_date;
								$tmp['order_status'] = $order[0]->order_status;
								$tmp['order_id'] = $v['order_id'];
								$tmp['order_sample_id'] = $v['order_sample_id'];
								$tmp['order_sample_parameter_id'] = $v['id'];
								$tmp['main_analys_user_id'] = $v['main_analys_user_id'];
								$tmp['main_analys_name'] = $v['main_analys_name'];
								$tmp['status'] = $v['status'];
								$result['order'][$v['main_analys_user_id']] = $tmp;
							}
						}
					});
					$htm = "
					<div class=\"table-responsive\">
						<table class=\"table table-striped\" style=\"width: 100%\">
							<thead>
								<tr class=\"bg-primary text-white\">
									<th class=\"text-center\">ลำดับ</th>
									<th>Lab No</th>
									<th>ผู้วิเคราะห์</th>
									<th>กำหนดส่งงาน</th>
									<th>สถานะ</th>
									<th style=\"width:20%;text-align:center\"></th>
								</tr>
							</thead>
							<tfoot></tfoot>
							<tbody>";
							if (count($result) > 0) {
								$i = 1;
								foreach ($result['order'] as $key => $value) {
									if (count($value) > 1) {
										$htm .= "<tr>";
											$htm .= "<td class=\"text-center\">".$i."</td>";
											$htm .= "<td>".$value['lab_no']."</td>";
											$htm .= "<td>".$value['main_analys_name']."</td>";
											$htm .= "<td>".$value['report_due_date']."</td>";
											match ($value['order_status']) {
												"pending" => $htm .= "
													<td>
														<div class=\"progress\">
															<div class=\"progress-bar bg-danger\" role=\"progressbar\" style=\"width: 25%;\" aria-valuenow=\"25\" aria-valuemin=\"0\" aria-valuemax=\"100\">25%</div>
														</div>
													</td>
													<td class=\"text-center\">
													<button type=\"button\" class=\"btn btn-secondary btn-sm\" style=\"width:86px;\" disabled>พิมพ์</button>
													<button type=\"button\" class=\"btn btn-secondary btn-sm\" style=\"width:86px;\" disabled>ส่งผล</button>
												</td>",
												"preparing" => $htm .= "
													<td>
														<div class=\"progress progress-md\">
															<div class=\"progress-bar bg-danger\" role=\"progressbar\" style=\"width: 50%;\" aria-valuenow=\"50\" aria-valuemin=\"0\" aria-valuemax=\"100\">50%</div>
														</div>
													</td>
													<td class=\"text-center\">
														<button type=\"button\" class=\"btn btn-secondary btn-sm\" style=\"width:86px;\" disabled>พิมพ์</button>
														<button type=\"button\" class=\"btn btn-secondary btn-sm\" style=\"width:86px;\" disabled>ส่งผล</button>
													</td>",
												"completed" => $htm .= "
													<td>
														<div class=\"progress progress-md\">
															<div class=\"progress-bar bg-success\" role=\"progressbar\" style=\"width: 100%;\" aria-valuenow=\"100\" aria-valuemin=\"0\" aria-valuemax=\"100\">100%</div>
														</div>
													</td>
													<td class=\"text-center\">
														<a href=\"".route('sample.received.report.print', ['lab_no' => $value['lab_no'], 'analys_user' => $value['main_analys_user_id']])."\" type=\"button\" class=\"btn btn-success btn-sm\" style=\"width:86px;\">พิมพ์</a>
														<button type=\"button\" class=\"btn btn-success btn-sm\" style=\"width:86px;\">ส่งผล</button>
												</td>"
											};

										$htm .= "</tr>";
									} else {
										continue;
									}
									$i++;
								}
							} else {
								$htm .= "<tr>";
									$htm .= "<td colspan=\"6\">";
										$htm .= "<div class=\"alert alert-danger\" role=\"alert\"><strong>ไม่พบข้อมูล</strong></div>";
									$htm .= "</td>";
								$htm .= "</tr>";
							}
							$htm .= "
							</tbody>
						</table>
					</div>";
				}
			} else {
				$htm = "<div class=\"alert alert-danger mt-4\" role=\"alert\"><strong>โปรดกรอกข้อมูลให้ถูกต้อง</strong></div>";
			}
			return $htm;
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function printReport(Request $request) {
		try {
			if (!empty($request->lab_no)) {
				$order = Order::select('id', 'order_no', 'user_id', 'customer_agency_name', 'type_of_work', 'received_order_date', 'lab_no', 'report_due_date')->whereLab_no(trim($request->lab_no))->get();

				if (count($order) > 0) {
					$user = User::select('id', 'user_type')->with('userCustomer')->whereId($order[0]->user_id)->get();
					$staff = User::select('id', 'user_type')->with('userStaff')->whereId(auth()->user()->id)->get();
					dump($user);
					dd($staff);

					$order_sample = OrderSample::whereOrder_id($order[0]->id)->with('parameters', function($query) {
						$query->whereIn('status', ['requisition', 'print']);
					})->whereSample_received_status('y')->get();

					$result = [
						'customer' => [
							'user_id' => $user[0]->userCustomer->user_id,
							'user_type' => $user[0]->user_type,
							'agency_code' => $user[0]->userCustomer->agency_code,
							'agency_name' => $user[0]->userCustomer->agency_name,
							'address' => $user[0]->userCustomer->address,
							'sub_district' => $user[0]->userCustomer->sub_district,
							'district' => $user[0]->userCustomer->district,
							'province' => $user[0]->userCustomer->province,
							'postcode' => $user[0]->userCustomer->postcode
						],
						'order' => [
							'order_id' => $order[0]->id,
							'order_no' => $order[0]->order_no,
							'lab_no' => $order[0]->lab_no,
						],
						'order_sample' => [
							'sample_test_no' => $order_sample[0]->sample_test_no,
							'sample_receive_date' => $order_sample[0]->sample_receive_date,
							'analys_complete_date' => $order_sample[0]->analys_complete_date,
							'report_result_date' => $order_sample[0]->report_result_date,
						],
						'order_sample_paramet' => [],
						'order_sample_paramet_unique' => [
							'sample_character_name' => [],
							'technical_name' => []
						],
					];

					// dd($result);

					$order_sample->each(function($item, $key) use (&$result, $request) {
						foreach ($item->parameters as $k => $v) {
							if (!empty($request->analys_user) && $v['main_analys_user_id'] != $request->analys_user) {
								continue;
							} else {
								$tmp['order_id'] = $v['order_id'];
								$tmp['order_sample_id'] = $v['order_sample_id'];
								$tmp['order_sample_parameter_id'] = $v['id'];
								$tmp['order_no'] = $result['order']['order_no'];
								$tmp['sample_test_no'] = $result['order_sample']['sample_test_no'];
								$tmp['paramet_id'] = $v['parameter_id'];
								$tmp['paramet_name'] = $v['parameter_name'];
								$tmp['sample_character_id'] = $v['sample_character_id'];
								$tmp['sample_character_name'] = $v['sample_character_name'];
								$tmp['main_analys_user_id'] = $v['main_analys_user_id'];
								$tmp['main_analys_name'] = $v['main_analys_name'];
								$tmp['main_analys_position'] = $this->getPositionById($v['main_analys_user_id']);
								$tmp['control_analys_name'] = $v['control_analys_name'];
								$tmp['technical_name'] = $v['technical_name'];
								$tmp['status'] = $v['status'];
								$tmp['sample_test_no'] = $item->sample_test_no;
								array_push($result['order_sample_paramet'], $tmp);
							}
						};
					});

					foreach ($result['order_sample_paramet'] as $key => $val) {
						if (!in_array(trim($val['sample_character_name']), $result['order_sample_paramet_unique']['sample_character_name'], false)) {
							array_push($result['order_sample_paramet_unique']['sample_character_name'], $val['sample_character_name']);
						}
						if (!in_array(trim($val['technical_name']), $result['order_sample_paramet_unique']['technical_name'], false)) {
							array_push($result['order_sample_paramet_unique']['technical_name'], $val['technical_name']);
						}
					}

				}
			}

			// dd($result);
			return view(view: 'apps.staff.receive.report.print', data: compact('result'));

		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function createReturn(): object {
		return view(view: 'apps.staff.receive.return.create');
	}

	protected function createReturnAjax(Request $request) {
		try {
			if (!empty($request->lab_no)) {
				$order = Order::select('id', 'lab_no', 'order_status', 'report_due_date')->whereLab_no(trim($request->lab_no))->whereOrder_status('completed')->get();
				if (count($order) > 0) {
					$order_sample = OrderSample::whereOrder_id($order[0]->id)->with('parameters', function($query) {
						$query->whereIn('status', ['pending', 'requisition', 'print']);
					})->whereSample_received_status('y')->get();
					$result = [
						'order' => []
					];
					$order_sample->each(function($item, $key) use (&$result, $request, $order) {
						foreach ($item->parameters as $k => $v) {
							if (array_key_exists($v['main_analys_user_id'], $result['order'])) {
								continue;
							} else {
								$tmp['lab_no'] = $request->lab_no;
								$tmp['report_due_date'] = $order[0]->report_due_date;
								$tmp['order_status'] = $order[0]->order_status;
								$tmp['order_id'] = $v['order_id'];
								$tmp['order_sample_id'] = $v['order_sample_id'];
								$tmp['order_sample_parameter_id'] = $v['id'];
								$tmp['main_analys_user_id'] = $v['main_analys_user_id'];
								$tmp['main_analys_name'] = $v['main_analys_name'];
								$tmp['status'] = $v['status'];
								$result['order'][$v['main_analys_user_id']] = $tmp;
							}
						}
					});
					$htm = "
					<div class=\"table-responsive\">
						<table class=\"table table-striped\" style=\"width: 100%\">
							<thead>
								<tr class=\"bg-primary text-white\">
									<th class=\"text-center\">ลำดับ</th>
									<th>Lab No</th>
									<th>ผู้วิเคราะห์</th>
									<th>กำหนดส่งงาน</th>
									<th>สถานะ</th>
									<th style=\"width:20%;text-align:center\"></th>
								</tr>
							</thead>
							<tfoot></tfoot>
							<tbody>";
							if (count($result) > 0) {
								$i = 1;
								foreach ($result['order'] as $key => $value) {
									if (count($value) > 1) {
										$htm .= "<tr>";
											$htm .= "<td class=\"text-center\">".$i."</td>";
											$htm .= "<td>".$value['lab_no']."</td>";
											$htm .= "<td>".$value['main_analys_name']."</td>";
											$htm .= "<td>".$value['report_due_date']."</td>";
											match ($value['order_status']) {
												"pending" => $htm .= "
													<td>
														<div class=\"progress\">
															<div class=\"progress-bar bg-danger\" role=\"progressbar\" style=\"width: 25%;\" aria-valuenow=\"25\" aria-valuemin=\"0\" aria-valuemax=\"100\">25%</div>
														</div>
													</td>
													<td class=\"text-center\">
													<button type=\"button\" class=\"btn btn-secondary btn-sm\" style=\"width:86px;\" disabled>พิมพ์</button>
													<button type=\"button\" class=\"btn btn-secondary btn-sm\" style=\"width:86px;\" disabled>ส่งผล</button>
												</td>",
												"preparing" => $htm .= "
													<td>
														<div class=\"progress progress-md\">
															<div class=\"progress-bar bg-danger\" role=\"progressbar\" style=\"width: 50%;\" aria-valuenow=\"50\" aria-valuemin=\"0\" aria-valuemax=\"100\">50%</div>
														</div>
													</td>
													<td class=\"text-center\">
														<button type=\"button\" class=\"btn btn-secondary btn-sm\" style=\"width:86px;\" disabled>พิมพ์</button>
														<button type=\"button\" class=\"btn btn-secondary btn-sm\" style=\"width:86px;\" disabled>ส่งผล</button>
													</td>",
												"completed" => $htm .= "
													<td>
														<div class=\"progress progress-md\">
															<div class=\"progress-bar bg-success\" role=\"progressbar\" style=\"width: 100%;\" aria-valuenow=\"100\" aria-valuemin=\"0\" aria-valuemax=\"100\">100%</div>
														</div>
													</td>
													<td class=\"text-center\">
														<a href=\"".route('sample.received.report.print', ['lab_no' => $value['lab_no'], 'analys_user' => $value['main_analys_user_id']])."\" type=\"button\" class=\"btn btn-success btn-sm\" style=\"width:86px;\">พิมพ์</a>
														<button type=\"button\" class=\"btn btn-success btn-sm\" style=\"width:86px;\">ส่งผล</button>
												</td>"
											};

										$htm .= "</tr>";
									} else {
										continue;
									}
									$i++;
								}
							} else {
								$htm .= "<tr>";
									$htm .= "<td colspan=\"6\">";
										$htm .= "<div class=\"alert alert-danger\" role=\"alert\"><strong>ไม่พบข้อมูล</strong></div>";
									$htm .= "</td>";
								$htm .= "</tr>";
							}
							$htm .= "
							</tbody>
						</table>
					</div>";
				} else {
				$htm = "<div class=\"alert alert-danger mt-4\" role=\"alert\"><strong>ไม่พบข้อมูลหรือยังประมวลผลไม่เสร็จสิ้น !!</strong></div>";
				}
			} else {
				$htm = "<div class=\"alert alert-danger mt-4\" role=\"alert\"><strong>โปรดกรอกข้อมูลให้ถูกต้อง !!</strong></div>";
			}
			return $htm;
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	private function downloadFile($dir, $file_name): mixed {
		try {
			if (!Storage::disk('receipt')->missing($file_name)) {
				$file = public_path().'/'.$dir.'/'.$file_name;
				return Response::download($file, $file_name, ['Content-Type: application/pdf'], '');
			} else {
				return false;
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}
}
