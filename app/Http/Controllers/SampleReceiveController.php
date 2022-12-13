<?php

namespace App\Http\Controllers;

use App\DataTables\ReceivedExampleDataTable;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Traits\{DateTimeTrait,CommonTrait};
use App\Exceptions\{OrderNotFoundException,InvalidOrderException};
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
			$orders = OrderService::getOrderwithCount(relations: ['orderSamples', 'parameters']);
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
			// $order_example = $order->orderSamples->toArray();
			// $order_parameter = $order->parameters->toArray();
			$type_of_work = $this->typeOfWork();
			// return $dataTable->render('apps.staff.receive.step01', compact('order', 'order_example', 'order_parameter', 'type_of_work'));
			return view(view: 'apps.staff.receive.step01', data: compact('order', 'type_of_work'));
		} catch (OrderNotFoundException $e) {
			report($e->getMessage());
			return redirect()->back()->with(key: 'error', value: $e->getMessage());
		} catch (\Exception $e) {
			return view(view: 'errors.show', data: ['error' => $e->getMessage()]);
		}
	}

	protected function step02(Request $request) {
		try {
			$order = OrderService::get(id: $request->order_id);
			$order_example = $order->orderSamples->toArray();
			$order_parameter = $order->parameters->toArray();
			// $type_of_work = $this->typeOfWork();
			return view(view: 'apps.staff.receive.step02', data: compact('order', 'order_example', 'order_parameter'));
		} catch (OrderNotFoundException $e) {
			report($e->getMessage());
			return redirect()->back()->with(key: 'error', value: $e->getMessage());
		} catch (\Exception $e) {
			return view(view: 'errors.show', data: ['error' => $e->getMessage()]);
		}
	}

	protected function step03(Request $request) {
		$order = OrderService::get(id: $request->order_id);
        dd($order);
		return view(view: 'apps.staff.receive.step03', data: compact('order'));
	}

    protected function store(Request $request) {
		dd($request);
	}

}
