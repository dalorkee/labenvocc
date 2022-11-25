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
		$validate_order_receive_data = $request->validate([
            'order_id',
            'lab_no',
            'report_due_date',
            'type_of_work',
            'type_of_work_other',
            'work_group',
			// 'agency_ministry' => 'required|max:30',
		]);
		try {

			if (empty($request->session()->get('order_receive_data'))) {
				$order_receive_data = new OrderReceived();
				$order_receive_data->fill($validate_order_receive_data);
				$request->session()->put('order_receive_data', $order_receive_data);
			} else {
				$order_receive_data = $request->session()->get('order_receive_data');
				$order_receive_data->fill($validate_order_receive_data);
				$request->session()->put('order_receive_data', $order_receive_data);
			}

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


	protected function step02(Request $request) {
		try {
			$order_id = $request->order_id;
			$result = [];

			$order_sample = OrderSample::whereOrder_id($order_id)->with('parameters')->get();

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
			// dd($result);
			return view(view: 'apps.staff.receive.step02', data: compact('order_id', 'result'));
		} catch (OrderNotFoundException $e) {
			report($e->getMessage());
			return redirect()->back()->with(key: 'error', value: $e->getMessage());
		} catch (\Exception $e) {
			return view(view: 'errors.show', data: ['error' => $e->getMessage()]);
		}
	}

	protected function step03(Request $request) {
		$order = OrderService::get(id: $request->order_id);
		return view(view: 'apps.staff.receive.step03', data: compact('order'));
	}

	protected function store(Request $request) {
		dd($request);
	}

}
