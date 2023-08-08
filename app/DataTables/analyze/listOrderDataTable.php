<?php
namespace App\DataTables\analyze;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\{Button,Column};
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Log;
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
							<div class=\"progress progress-md\">
								<div class=\"progress-bar bg-info\" role=\"progressbar\" style=\"width: 25%;\" aria-valuenow=\"25\" aria-valuemin=\"0\" aria-valuemax=\"100\">25%</div>
							</div>";
							break;
						case "preparing":
							$htm = "
							<div class=\"progress progress-md\">
								<div class=\"progress-bar bg-info\" role=\"progressbar\" style=\"width: 50%;\" aria-valuenow=\"50\" aria-valuemin=\"0\" aria-valuemax=\"100\">50%</div>
							</div>";
							break;
						case "approved": $htm = "
							<div class=\"progress progress-md\">
								<div class=\"progress-bar bg-info\" role=\"progressbar\" style=\"width: 75%;\" aria-valuenow=\"75\" aria-valuemin=\"0\" aria-valuemax=\"100\">75%</div>
							</div>";
							break;
						case "completed": $htm = "
							<div class=\"progress progress-md\">
								<div class=\"progress-bar bg-success\" role=\"progressbar\" style=\"width: 100%;\" aria-valuenow=\"100\" aria-valuemin=\"0\" aria-valuemax=\"100\">100%</div>
							</div>";
							break;
						default:
							$htm = "
							<div class=\"progress progress-md\">
								<div class=\"progress-bar bg-info\" role=\"progressbar\" style=\"width: 0%;\" aria-valuenow=\"0\" aria-valuemin=\"0\" aria-valuemax=\"100\">0%</div>
							</div>";
					};
					return $htm;
				})
				->addColumn('action', function($order) {
					return "
					<a href=\"".route('sample.analyze.select', ['lab_no' => $order->lab_no, 'id' => $order->id, 'user_id' => $this->user_id])."\" class=\"btn btn-success btn-sm\" id=\"reserved\">เบิกตัวอย่าง</a>
					<a href=\"".route('sample.analyze.lab.result.create', ['lab_no' => $order->lab_no, 'id' => $order->id, 'user_id' => $this->user_id])."\" class=\"btn btn-primary btn-sm\">ผลการทดสอบ</a>";
				})
				->rawColumns(['progress', 'action']);
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with(key: 'error', value: $e->getMessage());
		}
	}

	public function query(): object {
		try {
			$order_sample_id_arr = [];
			OrderSampleParameter::select('id', 'order_id', 'order_sample_id', 'status')
				->whereMain_analys_user_id($this->user_id)
				->get()
				->each(function($item, $key) use (&$order_sample_id_arr) {
					array_push($order_sample_id_arr, $item->order_sample_id);
				});
				$samples = OrderSample::select('order_id')->whereIn('id', $order_sample_id_arr)->whereSample_verified_status('complete')->whereSample_received_status('y')->get();
				$order_id =  (!empty($samples[0]['order_id'])) ? $samples[0]['order_id'] : 0;
				$data = Order::whereId($order_id)->whereIn('order_status', ['pending', 'preparing', 'approved', 'completed'])->with('parameters')->orderBy('id', 'ASC');
				return $data;
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
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
				Column::make('received_order_date')->title('รับตัวอย่าง'),
				Column::make('report_due_date')->title('กำหนดส่งงาน'),
				Column::make('progress')->title('ความคืบหน้า'),
				// Column::make('order_status')->title('สถานะ'),
				Column::computed('action')->title('#')->width('24%')->addClass('text-center')
			];
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function filename() {
		return 'order_detail' . date('YmdHis');
	}
}
