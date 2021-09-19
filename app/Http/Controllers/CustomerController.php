<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\{Order,OrderDetail};
use App\DataTables\{CustomersDataTable,CustParameterDataTable};

class CustomerController extends Controller
{
	protected function index(CustomersDataTable $dataTable): object {
		return $dataTable->render('apps.customers.index');
	}

	public function create() {}
	public function store(Request $request){}
	public function show(Order $customer){}
	public function edit(Order $customer){}
	public function update(Request $request, Order $customer){}
	public function destroy(Order $customer){}

	protected function createInfo(): object {
		return view('apps.customers.info');
	}
	protected function createParameter(CustParameterDataTable $dataTable): object {
		return $dataTable->render('apps.customers.parameter');
	}
    protected function storeParameterPersonalInfo(Request $request) {
        // return redirect()->back()->with('action_alert', 'บันทึกข้อมูลผู้ใช้สำเร็จแล้ว');
        // exit;
		$request->validate([
			'id_card'=>'bail|required',
		],[
			'id_card.required'=>'โปรดกรอกเลขบัตรประชาชน',

		]);
		try {
			$odt = new OrderDetail;
			$odt->id_card = $request->id_card;


			$saved = $odt->save();
			$last_insert_id = $odt->id;
			if ($saved == true) {
				return redirect()->back()->with('action_alert', 'บันทึกข้อมูลผู้ใช้สำเร็จแล้ว');
			} else {
				return redirect()->back()->with('action_alert', 'ไม่สามารถบันทึกข้อมูลได้');
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
    }
}
