<?php
namespace App\DataTables;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\{Button,Column};
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\{Log,DB};
use App\Models\OrderSample;
use App\Traits\CommonTrait;

class ReceivedExampleDataTable extends DataTable
{
	use CommonTrait;

	public function dataTable($query): object {
		try {
			return datatables()
				->eloquent($query)
				// ->editColumn('firstname', function($orderSample) {
				// 	return "<div style=\"width: 160px\">".$orderSample->firstname."</div>";
				// })
				// ->editColumn('lastname', function($orderSample) {
				// 	return "<div style=\"width: 180px\">".$orderSample->lastname."</div>";
				// })
				// ->editColumn('sample_date', function($orderSample) {
				// 	return Carbon::parse($orderSample->sample_date)->format('d/m/Y');
				// })
				->addColumn('parameter', function ($orderSample) {
					return $orderSample->parameters->map(function($parameter) {
						return "<div style=\"width: 500px\">".$parameter->parameter_name."</div>";
					})->implode('<br>');
				})
				->addColumn('parameter_quantity', function($orderSample) {
					return $orderSample->parameters->count();
				})
				// ->addColumn('total_price', function ($orderSample) {
				// 	$sum_price = 0;
				// 	$calc = $orderSample->parameters->map(function($parameter) use (&$sum_price) {
				// 		$sum_price += (int)$parameter->price_name;
				// 	});
				// 	return number_format($sum_price);
				// })
				->addColumn('selected', function($orderSample) {

					return '<input type="checkbox" name="a[] class="pjx" /> <label><span class="ok" id="chkbox'.$orderSample->id.'">สมบูรณ์</label>';
				})
				->addColumn('action', function($orderSample) {
					return "<button class=\"context-nav bg-purple-400 hover:bg-purple-500 text-white py-1 px-3 rounded\" id=\"context-menu\" data-order_id=\"".$orderSample->order_id."\" data-id=\"".$orderSample->id."\">จัดการ <i class=\"fal fa-angle-down\"></i></button>";
				})
				->rawColumns(['parameter', 'selected', 'action']);
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function query(Request $request, OrderSample $orderSample) {
		return $orderSample::with('parameters')->select('*')->whereOrder_id($request->order_id)->orderBy('id', 'ASC');
	}

	public function html() {
		try {
			return $this->builder()
				->setTableId("example_table")
				->setTableAttribute("class", "table table-bordered table-hover table-striped w-100")
				->columns($this->getColumns())
				->minifiedAjax()
				->responsive(true)
				// ->orderBy(0, 'desc')
				->parameters([
					'language' => ['url' => url('/vendor/DataTables/i18n/thai.json')],
					'columnDefs' => [
						// [
						// 	'targets' => 0,
						// 	'checkboxes' => ['selectRow' => true],
						// 	'width' => '8%'
						// ]
					],
					// 'select' => ['style' => 'multi'],
				]);
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function getColumns() {
		try {
			return [
				Column::make('id')->title('รหัส'),
				Column::make('firstname')->title('ชนิดตัวอย่าง'),
				Column::make('parameter')->title('รายการทดสอบ'),
				Column::make('parameter_quantity')->title('จำนวนรายการทดสอบ'),
				Column::make('selected')->title("เลือกทั้งหมด <input type='checkbox'>")->className('pja'),
				Column::computed('action')->addClass('text-center')->title('#')
			];
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function filename() {
		return 'order_detail' . date('YmdHis');
	}
}
