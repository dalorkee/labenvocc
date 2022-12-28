<?php

namespace App\Http\Controllers;

use App\DataTables\ReceivedExampleDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Services\OrderService;
use App\Traits\{DateTimeTrait,CommonTrait};
use App\Exceptions\{OrderNotFoundException,InvalidOrderException};
use App\Models\{OrderSample,OrderReceived};
// use App\DataTables\ReceivedExampleDataTable;
use Yajra\DataTables\Facades\DataTables;


class SampleReceiveController extends Controller
{
	use DateTimeTrait, CommonTrait;

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
	protected function create(): object {
		try {
			$orders = OrderService::getOrderwithCount(relations: ['orderSamples', 'parameters'], year: '2022');
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
			"order_no_ref" => "nullable",
			"order_type" => "nullable",
			"order_type_name" => "nullable",
			'lab_no' => 'nullable',
			'report_due_date' => 'nullable',
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
			$order = $request->session()->get(key: 'order');
			$result = [];
			$order_sample = OrderSample::whereOrder_id($order['id'])->with('parameters')->get();
			$order_sample->each(function($item, $key) use (&$result) {
				$tmp['sample_id'] = $item->id;
				$tmp['sample_count'] = $item->parameters->count();
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
			return view(view: 'apps.staff.receive.step02', data: compact('order', 'result'));
		} catch (OrderNotFoundException $e) {
			report($e->getMessage());
			return redirect()->back()->with(key: 'error', value: $e->getMessage());
		} catch (\Exception $e) {
			return view(view: 'errors.show', data: ['error' => $e->getMessage()]);
		}
	}

	protected function step02Post(Request $request) {
		foreach ($request->sample_id as $key => $value) {
			$data[$value]['select'] = $request->select_sample[$key];
			if (in_array($value, $request->chk_sample)) {
				$data[$value]['check'] = 'complete';
			} else {
				$data[$value]['check'] = null;
			}
			$data[$value]['sample_count'] = $request->sample_count;
		}
		if ($request->session()->has(key: 'sample_sumary')) {
			$request->session()->forget(keys: 'sample_sumary');
		}
		$sample_sumary = [
			'sample_completed' => 0,
			'sample_completed_amount' => 0,
			'sample_not_completed' => 0,
			'sample_not_completed_amount' => 0
		];
		foreach ($data as $key => $value) {
			if ($value['select'] == 'y' && $value['check'] == 'complete') {
				$sample_sumary['sample_completed'] += 1;
				$sample_sumary['sample_completed_amount'] += (int)$value['sample_count'];
			} else {
				$sample_sumary['sample_not_completed'] += 1;
				$sample_sumary['sample_not_completed_amount'] += (int)$value['sample_count'];
			}
		}
		$request->session()->put(key: 'sample_result', value: $data);
		$request->session()->put(key: 'sample_sumary', value: $sample_sumary);
		return redirect()->route('sample.received.step03', ['order_id' => $request->order_id]);
	}

	protected function step03(Request $request) {
		$order_id = $request->order_id;
		/* get sample id here for mapping na ja */
		$sample_sumary = $request->session()->get(key: 'sample_sumary');
		$sample_result = $request->session()->get(key: 'sample_result');
		dd($sample_result);
		//$order = OrderService::get(id: $request->order_id);
		return view(view: 'apps.staff.receive.step03', data: compact('order_id', 'sample_sumary'));
	}

}
