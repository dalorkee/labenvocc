<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\DataTables\CustomersDataTable;

class CustomerController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	protected function index(CustomersDataTable $dataTable): object {
		return $dataTable->render('apps.customers.index');
		//return view('apps.customers.pj');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Order  $customer
	 * @return \Illuminate\Http\Response
	 */
	public function show(Order $customer)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Order  $customer
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Order $customer)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Order  $customer
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Order $customer)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Customer  $customer
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Order $customer)
	{
		//
	}
}
