<?php
namespace App\DataTables\destroy;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\{Button,Column};
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\{Log};
use App\Models\{Order,OrderSample,OrderSampleParameter};
use App\Traits\CommonTrait;

class listOrderDataTable extends DataTable
{
	use CommonTrait;

	public function dataTable($query): object {
		try {
			return datatables()
				->eloquent($query)
				->addIndexColumn()
				->addColumn('order_destroy_status', function($status) {
					switch ($status->order_destroy_status) {
						case "pending":
							$htm = "
							<div class=\"progress progress-md\">
								<div class=\"progress-bar bg-warning\" role=\"progressbar\" style=\"width: 25%;color:#000;\" aria-valuenow=\"25\" aria-valuemin=\"0\" aria-valuemax=\"100\">25%</div>
							</div>";
							break;
						case "approved": $htm = "
							<div class=\"progress progress-md\">
								<div class=\"progress-bar bg-warning\" role=\"progressbar\" style=\"width: 60%;\" aria-valuenow=\"60\" aria-valuemin=\"0\" aria-valuemax=\"100\">60%</div>
							</div>";
							break;
						case "destroyed": $htm = "
							<div class=\"progress progress-md\">
								<div class=\"progress-bar bg-success\" role=\"progressbar\" style=\"width: 100%;\" aria-valuenow=\"100\" aria-valuemin=\"0\" aria-valuemax=\"100\">100%</div>
							</div>";
							break;
						default: $htm = "";
					};
					return $htm;
				})
				->addColumn('action', function($order) {
					return "<div class=\"custom-control custom-checkbox\">
						<input type=\"checkbox\" name=\"lab_no[]\" class=\"custom-control-input\" value=\"".$order->lab_no."\" id=\"lab_no_\"".$order->lab_no."\" checked=\"\" readonly />
						<label class=\"custom-control-label\" for=\"lab_no_\"".$order->lab_no."\">&nbsp;</label>
						</div>";
				})
				->rawColumns(['order_destroy_status', 'action']);
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function query() {
		// $order_sample_id_arr = [];
		// OrderSampleParameter::select('order_sample_id')?->get()?->each(function($item, $key) use (&$order_sample_id_arr) {
		// 	array_push($order_sample_id_arr, $item->order_sample_id);
		// });
		// OrderSample::select('order_id')->whereIn('id', $order_sample_id_arr)->whereSample_verified_status('complete')->whereSample_received_status('y')->get();
		// $order_id =  (!empty($samples[0]['order_id'])) ? $samples[0]['order_id'] : 0;
		return Order::whereOrder_status('approved')->with('parameters')->orderBy('id', 'ASC');
	}

	public function html() {
		try {
			return $this->builder()
				->setTableId("order-table-list")
				->setTableAttribute("class", "table table-bordered table-hover table-striped w-100")
				->columns($this->getColumns())
				->minifiedAjax()
				->responsive(true)
				->parameters(['language' => ['url' => url('/vendor/DataTables/i18n/thai.json')]]);
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function getColumns() {
		try {
			return [
				Column::make('id')->title('ลำดับ'),
				Column::make('lab_no')->title('Lab No.'),
				Column::make('received_order_date')->title('รับตัวอย่าง'),
				Column::make('order_destroy_status')->title('สถานะรอทำลายตัวอย่าง'),
				Column::make('report_due_date')->title('กำหนดส่ง'),
				Column::make('order_destroy_date')->title('วันทำลายตัวอย่าง'),
				Column::computed('action')->title('อนุมัติ')->width('24%')->addClass('text-center')
			];
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function filename() {
		return 'order_detail' . date('YmdHis');
	}
}
