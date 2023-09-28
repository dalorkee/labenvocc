<?php
namespace App\DataTables\destroy;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\{Button,Column};
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\{Log};
use App\Models\Order;
use App\Traits\CommonTrait;

class DestroyOrderDataTable extends DataTable
{
	use CommonTrait;

	public function dataTable($query): object {
		try {
			return datatables()
				->eloquent($query)
				->addIndexColumn()
				->addColumn('destroy_status', function($order) {
					switch ($order->order_status) {
						case "pending":
						case "received":
						case "analyzing":
						case "analyzed":
							$htm = "
							<div class=\"progress progress-lg\">
								<div class=\"progress-bar bg-info\" role=\"progressbar\" style=\"width:60%;\" aria-valuenow=\"60\" aria-valuemin=\"0\" aria-valuemax=\"100\">60%</div>
							</div>";
							break;
						case "destroyed":
							$htm = "
							<div class=\"progress progress-lg\">
								<div class=\"progress-bar bg-success\" role=\"progressbar\" style=\"width:100%;\" aria-valuenow=\"100\" aria-valuemin=\"0\" aria-valuemax=\"100\">100%</div>
							</div>";
							break;
						default:
							$htm = "
							<div class=\"progress progress-lg\">
								<div class=\"progress-bar bg-secondary\" role=\"progressbar\" style=\"width:0%;\" aria-valuenow=\"0\" aria-valuemin=\"0\" aria-valuemax=\"100\">0%</div>
							</div>";
					};
					return $htm;
				})
				->addColumn('destroy_approve_status', function($status) {
					$htm = match ($status->destroy_approve_status) {
						"y" => "<div class=\"text-success text-center\"><i class=\"fas fa-star\"></i></div>",
						default => "<div class=\"text-danger text-center\"><i class=\"fas fa-star\"></i></div>",
					};
					return $htm;
				})
				->addColumn('action', function($order) {
					$checked = match ($order->order_status) {
						'destroyed' => ' checked disabled',
						default => ''
					};
					$htm = "
					<div class=\"from-check ml-2 inline-block\">
						<input type=\"checkbox\" name=\"destroy_order[]\" class=\"form-check-input\" value=\"".$order->id."\" id=\"destroy_".$order->id."\"".$checked.">
						<label class=\"form-check-label\" for=\"destroy".$order->id."\">&nbsp;</label>
					</div>";
					return $htm;
				})
				->rawColumns(['destroy_status', 'destroy_approve_status', 'action']);
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function query(Order $order) {
		return $order->whereNotNull('lab_no')->whereNotNull('order_received_date');
	}

	public function html() {
		try {
			return $this->builder()
				->setTableId("destory_table")
				->setTableAttribute("class", "table table-bordered table-hover table-striped w-100")
				->columns($this->getColumns())
				->minifiedAjax()
				// ->fixedHeader(true)
				->responsive(true)
				// ->scrollCollapse(true)
				// ->scrollX(300)
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
				Column::make('order_received_date')->title('รับตัวอย่าง'),
				Column::make('destroy_status')->title('สถานะรอทำลายตัวอย่าง'),
				Column::make('destroy_approve_status')->title('อนุมัติทำลายตัวอย่าง'),
				Column::make('report_due_date')->title('กำหนดส่ง'),
				Column::make('destroy_date')->title('วันทำลายตัวอย่าง'),
				Column::computed('action')->title('บันทึก')->addClass('text-center')
			];
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function filename() {
		return 'order_detail' . date('YmdHis');
	}
}
