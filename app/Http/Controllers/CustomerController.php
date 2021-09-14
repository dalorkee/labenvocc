<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\DataTables\CustomersDataTable;

class CustomerController extends Controller
{
	protected function index(CustomersDataTable $dataTable): object {
		return $dataTable->render('apps.customers.index');
		//return view('apps.customers.pj');
	}

	public function create() {}
	public function store(Request $request){}
	public function show(Order $customer){}
	public function edit(Order $customer){}
	public function update(Request $request, Order $customer){}
	public function destroy(Order $customer){}

    public function createGeneralInfo(): object {
        return view('apps.customers.general');
	}
}
