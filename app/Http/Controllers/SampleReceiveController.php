<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,Log};
use App\Models\Order,User;
use Yajra\DataTables\Facades\DataTables;

class SampleReceiveController extends Controller
{

	#[Route('sample.receive.index', methods: ['resource'])]
	protected function index(): object {
		return view(view: 'apps.staff.receive.index');
	}

	#[Route('sample.receive.create', methods: ['resource'])]
	protected function create() {
		try {
			$orders = Order::withCount(['orderSamples', 'parameters']);
			return Datatables::of($orders)
				->addColumn('total', function($order) {
					return $order->order_samples_count.'/'.$order->parameters_count;
				})
                ->addColumn('action', function ($order) {
                    return '<a href="#edit-'.$order->id.'" class="btn btn-xs btn-primary"><i class="fal fa-pencil"></i> Edit</a>';
                })
				->make(true);
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
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
