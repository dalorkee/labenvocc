<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Traits\{DateTimeTrait,CommonTrait};
use App\Exceptions\OrderNotFoundException;
use App\Exceptions\InvalidOrderException;
use Yajra\DataTables\Facades\DataTables;

class SampleReceiveController extends Controller
{
	use DateTimeTrait, CommonTrait;

	// #[Route('sample.receives.index', methods: ['RESOURCE'])]
	protected function index(): object {
		return view(view: 'apps.staff.receive.index');
	}

	// #[Route('sample.receives.create', methods: ['RESOURCE'])]
	protected function create(): object {
		try {
			$orders = OrderService::getOrderwithCount(relations: ['orderSamples', 'parameters']);
			return Datatables::of($orders)
				->addColumn('total', fn ($order) => $order->order_samples_count.'/'.$order->parameters_count)
				->editColumn('order_confirmed', fn($order) => $this->setJsDateTimeToJsDate($order->order_confirmed))
				->addColumn('action', function ($order) {
					return "
						<a href=\"".route('sample.receives.step01', ['order_id' => $order->id])."\" class=\"btn btn-sm btn-success\">รับ</a>\n
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

	// #[Route('sample.receives.step01', methods: ['GET'])]
	protected function step01(Request $request) {
		try {
			$orders = OrderService::get(id: $request->order_id);
			$type_of_work = $this->typeOfWork();
			return view(view: 'apps.staff.receive.step01', data: compact('orders', 'type_of_work'));
		} catch (OrderNotFoundException $e) {
			report($e->getMessage());
			return redirect()->back()->with(key: 'error', value: $e->getMessage());
		} catch (\Exception $e) {
			return view(view: 'errors.show', data: ['error' => $e->getMessage()]);
		}
	}
}
