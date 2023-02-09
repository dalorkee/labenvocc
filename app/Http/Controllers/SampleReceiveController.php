<?php

namespace App\Http\Controllers;

use App\DataTables\ReceivedExampleDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\{DB,Log};
use App\Services\OrderService;
use App\Traits\{DateTimeTrait,CommonTrait,DbBoundaryTrait};
use App\Exceptions\{OrderNotFoundException,InvalidOrderException};
use App\Models\{Order,OrderSample,OrderReceived};
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
			/* clear all step session  */
			$request->session()->forget(keys: 'order');
			$request->session()->forget(keys: 'sample_result');
			$request->session()->forget(keys: 'sample_sumary');

			/* begin query */
			$order_year = (date('Y')-1);
			$orders = OrderService::getOrderwithCount(relations: ['orderSamples', 'parameters'], order_year: $order_year, order_status: 'pending');
			return Datatables::of($orders)
				->addColumn('total', fn ($order) => $order->order_samples_count.'/'.$order->parameters_count)
				->editColumn('order_confirmed', fn($order) => $this->setJsDateTimeToJsDate($order->order_confirmed))
				->addColumn('action', function ($order) {
					return "
						<a href=\"".route('sample.received.step01', ['order_id' => $order->id])."\" class=\"btn btn-sm btn-success\">รับ</a>\n
						<a href=\"#edit-".$order->id."\" class=\"btn btn-sm btn-warning\">แก้ไข</a>\n";
				})
				->make(true);
		} catch (InvalidOrderException $e) {
			report($e->getMessage());
			return redirect()->back()->with(key: 'error', value: $e->getMessage());
		} catch (\Exception $e) {
			return view(view: 'errors.show', data: ['error' => $e->getMessage()]);
		}
	}

	/**
	* Create Sample Step 01
	* @Get('sample.received.step01')
	*/
	protected function step01(Request $request) {
		try {
			$order = OrderService::get(id: $request->order_id);
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
			'lab_no' => 'required|max:60',
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
			$order = OrderService::create();
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
			$order_id = $request->order_id;
			$sample_result = $request->session()->get(key: 'sample_result');
			$order_arr = $request->session()->get(key: 'order')->toArray();
			$order = OrderService::get($order_id);
			$order->fill(attributes: $order_arr);
			DB::transaction(function() use ($sample_result, $order) {
				foreach ($sample_result as $key => $value) {
					$order_sample = OrderService::findOrderSample($value['id']);
					$order_sample->sample_verified_status = $value['sample_verified_status_'.$value['id']];
					$order_sample->sample_received_status = $value['sample_received_status_'.$value['id']];
					$order_sample->save();
				}
				$order->fill(attributes: ['order_status' => 'progress']);
				$order->save();
			});
			// return redirect()->route('sample.received.index')->with(key: 'success', value: 'บันทึกข้อมูลสำเร็จแล้ว !!');
			return view('apps.staff.receive.step04', compact('order_id', 'order_arr'));
		} catch (OrderNotFoundException $e) {
			report($e->getMessage());
			return redirect()->back()->with(key: 'error', value: $e->getMessage());
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->route('sample.received.index')->with(key: 'error', value: $e->getMessage());
		}
	}

	protected function print(Request $request) {

		$order = Order::with(['orderSamples', 'parameters'])->whereId($request->order_id)->get();

		$user_prov = $this->provinceNameByProvId(auth()->user()->userCustomer->province) ?? '';
		$user_dist = $this->districtNameByDistId(auth()->user()->userCustomer->district) ?? '';
		$user_sub_dist = $this->subDistrictNameBySubDistId(auth()->user()->userCustomer->sub_district) ?? '';
		$contact_user_prov = $this->provinceNameByProvId(auth()->user()->userCustomer->contact_province) ?? '';
		$contact_user_dist = $this->districtNameByDistId(auth()->user()->userCustomer->contact_district) ?? '';
		$contact_user_sub_dist = $this->subDistrictNameBySubDistId(auth()->user()->userCustomer->contact_sub_district) ?? '';
		$parameters_count_deep = $order[0]->parameters->countBy(fn($q) => $q->sample_character_id);
		$parameters_count_deep->all();

		$data = collect([
			'order_id' => $request->order_id,
			'lab_no' => $order[0]->lab_no,
			'report_due_date' => $order[0]->report_due_date,
			'type_of_work' => $order[0]->type_of_work,
			'order_type' => $order[0]->order_type,
			'order_samples_count' => $order[0]->orderSamples->count(),
			'parameters_count' => $order[0]->parameters->count(),
			'parameters_count_deep' => $parameters_count_deep->toArray(),
			'origin_threat_id' => $order[0]->orderSamples[0]->origin_threat_id,
			'customer_agency_name' => $order[0]->customer_agency_name,
			'customer_address' => auth()->user()->userCustomer->address.' ต.'.$user_sub_dist.' อ.'.$user_dist.' จ.'.$user_prov.' '.auth()->user()->userCustomer->postcode,
			'customer_mobile' => auth()->user()->userCustomer->mobile,
			'deliver_method' => $order[0]->deliver_method,
			'book_no' => $order[0]->book_no,
			'book_date' => $order[0]->book_date,
			'first_name' => auth()->user()->userCustomer->first_name,
			'last_name' => auth()->user()->userCustomer->last_name,
			'mobile' => auth()->user()->userCustomer->mobile,
			'contact_first_name' => auth()->user()->userCustomer->first_name,
			'contact_last_name' => auth()->user()->userCustomer->last_name,
			'contact_mobile' => auth()->user()->userCustomer->mobile,
			'contact_address'=> auth()->user()->userCustomer->address.' ต.'.$contact_user_sub_dist.' อ.'.$contact_user_dist.' จ.'.$contact_user_prov.' '.auth()->user()->userCustomer->contact_postcode,
			'order_created_at' => substr($this->convertMySQLDateTimeToJs($order[0]->created_at), 0, 10),
			'contact_addr_opt' => auth()->user()->userCustomer->contact_addr_opt,
			'report_result_receive_method' => $order[0]->report_result_receive_method,
			'sample_sumary' => $request->session()->get(key: 'sample_sumary'),
			'sample_verify_desc' => $order[0]->sample_verify_desc,
			'received_order_name' => $order[0]->received_order_name,
			'received_order_date' => $order[0]->received_order_date,
			'review_order_name' => $order[0]->review_order_name,
			'review_order_date' => $order[0]->review_order_date,
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
		$print = Pdf::loadView('print.sample-receipt', $data);
		return $print->download('patsri.pdf');
	}


	protected function printf(Request $request) {
		$order = Order::with(['orderSamples', 'parameters'])->whereId($request->order_id)->get();

		$user_prov = $this->provinceNameByProvId(auth()->user()->userCustomer->province) ?? '';
		$user_dist = $this->districtNameByDistId(auth()->user()->userCustomer->district) ?? '';
		$user_sub_dist = $this->subDistrictNameBySubDistId(auth()->user()->userCustomer->sub_district) ?? '';
		$contact_user_prov = $this->provinceNameByProvId(auth()->user()->userCustomer->contact_province) ?? '';
		$contact_user_dist = $this->districtNameByDistId(auth()->user()->userCustomer->contact_district) ?? '';
		$contact_user_sub_dist = $this->subDistrictNameBySubDistId(auth()->user()->userCustomer->contact_sub_district) ?? '';
		$parameters_count_deep = $order[0]->parameters->countBy(fn($q) => $q->sample_character_id);
		$parameters_count_deep->all();

		$data = collect([
			'order_id' => $request->order_id,
			'lab_no' => $order[0]->lab_no,
			'report_due_date' => $order[0]->report_due_date,
			'type_of_work' => $order[0]->type_of_work,
			'order_type' => $order[0]->order_type,
			'order_samples_count' => $order[0]->orderSamples->count(),
			'parameters_count' => $order[0]->parameters->count(),
			'parameters_count_deep' => $parameters_count_deep->toArray(),
			'origin_threat_id' => $order[0]->orderSamples[0]->origin_threat_id,
			'customer_agency_name' => $order[0]->customer_agency_name,
			'customer_address' => auth()->user()->userCustomer->address.' ต.'.$user_sub_dist.' อ.'.$user_dist.' จ.'.$user_prov.' '.auth()->user()->userCustomer->postcode,
			'customer_mobile' => auth()->user()->userCustomer->mobile,
			'deliver_method' => $order[0]->deliver_method,
			'book_no' => $order[0]->book_no,
			'book_date' => $order[0]->book_date,
			'first_name' => auth()->user()->userCustomer->first_name,
			'last_name' => auth()->user()->userCustomer->last_name,
			'mobile' => auth()->user()->userCustomer->mobile,
			'contact_first_name' => auth()->user()->userCustomer->first_name,
			'contact_last_name' => auth()->user()->userCustomer->last_name,
			'contact_mobile' => auth()->user()->userCustomer->mobile,
			'contact_address'=> auth()->user()->userCustomer->address.' ต.'.$contact_user_sub_dist.' อ.'.$contact_user_dist.' จ.'.$contact_user_prov.' '.auth()->user()->userCustomer->contact_postcode,
			'order_created_at' => substr($this->convertMySQLDateTimeToJs($order[0]->created_at), 0, 10),
			'contact_addr_opt' => auth()->user()->userCustomer->contact_addr_opt,
			'report_result_receive_method' => $order[0]->report_result_receive_method,
			'sample_sumary' => $request->session()->get(key: 'sample_sumary'),
			'sample_verify_desc' => $order[0]->sample_verify_desc,
			'received_order_name' => $order[0]->received_order_name,
			'received_order_date' => $order[0]->received_order_date,
			'review_order_name' => $order[0]->review_order_name,
			'review_order_date' => $order[0]->review_order_date,
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
		return view('print.sample-receipt', compact('data'));
	}
}
