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
								<div class=\"progress-bar bg-info\" role=\"progressbar\" style=\"width: 20%;\" aria-valuenow=\"20\" aria-valuemin=\"0\" aria-valuemax=\"100\">20%</div>
							</div>";
							break;
						case "received":
							$htm = "
							<div class=\"progress progress-md\">
								<div class=\"progress-bar bg-info\" role=\"progressbar\" style=\"width: 40%;\" aria-valuenow=\"40\" aria-valuemin=\"0\" aria-valuemax=\"100\">40%</div>
							</div>";
							break;
						case "analyzed": $htm = "
							<div class=\"progress progress-md\">
								<div class=\"progress-bar bg-info\" role=\"progressbar\" style=\"width: 60%;\" aria-valuenow=\"60\" aria-valuemin=\"0\" aria-valuemax=\"100\">60%</div>
							</div>";
							break;
						case "sent": $htm = "
							<div class=\"progress progress-md\">
								<div class=\"progress-bar bg-success\" role=\"progressbar\" style=\"width: 80%;\" aria-valuenow=\"80\" aria-valuemin=\"0\" aria-valuemax=\"100\">80%</div>
							</div>";
							break;
						case "destroy": $htm = "
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
					switch($order->order_status) {
						case 'pending':
						case 'received':
							$htm = "
							<a href=\"".route('sample.analyze.select', ['lab_no' => $order->lab_no, 'id' => $order->id, 'user_id' => $this->user_id])."\" class=\"btn btn-success btn-sm\" id=\"reserved\">เบิกตัวอย่าง</a>
							<a href=\"".route('sample.analyze.lab.result.create', ['lab_no' => $order->lab_no, 'id' => $order->id, 'user_id' => $this->user_id])."\" class=\"btn btn-primary btn-sm\">ผลการทดสอบ</a>";
							break;
						default:
							$htm = "
							<button class=\"btn btn-success btn-sm\" id=\"reserved\">เบิกตัวอย่าง</button>
							<button class=\"btn btn-primary btn-sm\">ผลการทดสอบ</button>";
					}
					return $htm;
				})
				->rawColumns(['progress', 'action']);
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with(key: 'error', value: $e->getMessage());
		}
	}

	public function query(): ?object {
		try {
			$order_sample_id_arr = [];
			OrderSampleParameter::select('id', 'order_id', 'order_sample_id', 'status')
				?->whereMain_analys_user_id($this->user_id)
				?->get()
				?->each(function($item, $key) use (&$order_sample_id_arr) {
					array_push($order_sample_id_arr, $item->order_sample_id);
				});
			if (count($order_sample_id_arr) > 0) {
				$samples = OrderSample::select('order_id')
					?->whereIn('id', $order_sample_id_arr)
					?->whereSample_verified_status('complete')
					?->whereSample_received_status('y')
					?->whereNotNull('sample_test_no')
					?->get();
				$order_id = (!empty($samples[0]['order_id'])) ? $samples[0]['order_id'] : 0;
				$data = Order::whereId($order_id)?->where('order_receive_status', '!=', 'reject')?->with('parameters')?->orderBy('id', 'ASC');
			}
			return $data ?? null;
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
				Column::make('order_receive_status')->title('รับตัวอย่าง'),
				Column::make('report_due_date')->title('กำหนดส่งงาน'),
				Column::make('progress')->title('สถานะ'),
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
