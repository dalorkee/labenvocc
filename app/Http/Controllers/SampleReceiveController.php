<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,Log};
use App\Models\Order,User;
use Yajra\DataTables\Facades\DataTables;

class SampleReceiveController extends Controller
{

	#[Route('sample.receive.index', methods: ['RESOURCE'])]
	protected function index(): object {
		return view(view: 'apps.staff.receive.index');
	}

	#[Route('sample.receive.create', methods: ['RESOURCE'])]
	protected function create(): object {
		try {
			$orders = Order::withCount(relations: ['orderSamples', 'parameters']);
			return Datatables::of($orders)
				->addColumn('total', function($order) {
					return $order->order_samples_count.'/'.$order->parameters_count;
				})
				->addColumn('action', function ($order) {
					// return '<button class="context-nav bg-purple-600 hover:bg-purple-500 text-white py-1 px-3 rounded" data-order_id="'.$order->id.'">จัดการ <i class="fal fa-angle-down"></i></button>';
					return '
						<a href="'.route('sample.receive.step01', ['order_id' => $order->id]).'" class="btn btn-sm btn-success">รับ</a>
						<a href="#edit-'.$order->id.'" class="btn btn-sm btn-warning">แก้ไข</a>
					';
				})
				->make(true);
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	#[Route('sample.receive.step01', methods: ['GET'])]
	protected function step01(Request $request): object {
		$order_id = $request->order_id;
		return view(view: 'apps.staff.receive.step01', data: compact('order_id'));
	}

	public function store(Request $request) {
		//
	}

	public function show($id)
	{
		//
	}


	public function edit($id)
	{
		//
	}


	public function update(Request $request, $id)
	{
		//
	}


	public function destroy($id)
	{
		//
	}



}
