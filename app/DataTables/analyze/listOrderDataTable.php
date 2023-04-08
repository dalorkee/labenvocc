<?php
namespace App\DataTables\analyze;

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
				->addColumn('progress', function($status) {
					switch ($status->order_status) {
						case "pending":
							$htm = "
							<div class=\"progress\">
								<div class=\"progress-bar bg-info\" role=\"progressbar\" style=\"width: 25%;\" aria-valuenow=\"25\" aria-valuemin=\"0\" aria-valuemax=\"100\">25%</div>
							</div>";
							break;
						case "preparing": $htm = "
							<div class=\"progress progress-md\">
								<div class=\"progress-bar bg-info\" role=\"progressbar\" style=\"width: 50%;\" aria-valuenow=\"50\" aria-valuemin=\"0\" aria-valuemax=\"100\">50%</div>
							</div>";
							break;
						case "completed": $htm = "
							<div class=\"progress progress-md\">
								<div class=\"progress-bar bg-success\" role=\"progressbar\" style=\"width: 100%;\" aria-valuenow=\"100\" aria-valuemin=\"0\" aria-valuemax=\"100\">100%</div>
							</div>";
							break;
						default: $htm = null;
					};
					return $htm;
				})
				->addColumn('action', function($order) {
					return "
					<button class=\"btn btn-secondary btn-sm\" id=\"requisition\" data-order=\"".$order->id."\">เบิกตัวอย่าง</button>
					<button class=\"btn btn-secondary btn-sm\" id=\"result\" data-order=\"".$order->id."\">ผลการทดสอบ</button>";
				})
				->rawColumns(['progress', 'action']);
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function query(Order $order, OrderSample $orderSample, OrderSampleParameter $paramet) {
		$order_sample_arr = [];
		$paramet->select('order_sample_id')->whereMain_analys_user_id($this->user_id)->get()->each(function($item, $key) use (&$order_sample_arr) {
			array_push($order_sample_arr, $item->order_sample_id);
		});
		$samples = $orderSample->select('order_id')->whereIn('id', $order_sample_arr)->whereSample_verified_status('complete')->whereSample_received_status('y')->get();
		$order_id =  (!empty($samples[0]['order_id'])) ? $samples[0]['order_id'] : 0;
		return $order::whereId($order_id)->whereIn('order_status', ['pending', 'preparing', 'completed'])->orderBy('id', 'ASC');
	}

	public function html() {
		try {
			return $this->builder()
				->setTableId("order-table-list")
				->setTableAttribute("class", "table table-bordered table-hover table-striped w-100")
				->columns($this->getColumns())
				->minifiedAjax()
				->responsive(true)
				->parameters([
					'language' => ['url' => url('/vendor/DataTables/i18n/thai.json')],
				]);
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function getColumns() {
		try {
			return [
				Column::make('id')->title('ลำดับ'),
				Column::make('lab_no')->title('Lab No.'),
				Column::make('progress')->title('ความคืบหน้า'),
				Column::make('received_order_date')->title('รับตัวอย่าง'),
				Column::make('report_due_date')->title('กำหนดส่งงาน'),
				Column::make('order_status')->title('สถานะ'),
				Column::computed('action')->title('#')->width('16%')
			];
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function filename() {
		return 'order_detail' . date('YmdHis');
	}
}
