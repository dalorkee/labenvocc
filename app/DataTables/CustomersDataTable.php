<?php
namespace App\DataTables;

use Yajra\DataTables\Html\{Button,Column};
use Yajra\DataTables\Html\Editor\{Editor,Fields};
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\{Order,FileUpload};
use App\Traits\CommonTrait;

class CustomersDataTable extends DataTable
{
	use CommonTrait;
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query) {
		try {
			return datatables()
				->eloquent($query)
				->editColumn(name: 'order_confirmed_date', content: fn ($order) => $order->order_confirmed_date)
				->addColumn(name: 'lab', content: function ($order) {
					return $order->parameters->map(function($parameter) {
						return "
						<div>
							<span class=\"badge badge-info\">".$parameter->parameter_name."</span>
							<span class=\"badge badge-warning\">".$parameter->office_name."</span>
						</div>";
					})->implode('<br>');
				})
				->addColumn(name: 'status', content: function($order) {
					$htm = "<form>";
					$htm .= "<div class=\"custom-control custom-checkbox\">";
					$htm .= "<input type=\"checkbox\" class=\"custom-control-input\"";
					(!is_null($order->order_confirmed_date)) ? $htm .= " checked" : $htm .= "";
					$htm .= " disabled>";
					$htm .= "<label class=\"custom-control-label\" for=\"receive\">ส่งคำขอ</label>";
					$htm .= "</div>";
					$htm .= "<div class=\"custom-control custom-checkbox\">";
					$htm .= "<input type=\"checkbox\" class=\"custom-control-input\"";
					($order->order == 'received') ? $htm .= " checked" : $htm .= "";
					$htm .= " disabled>";
					$htm .= "<label class=\"custom-control-label\" for=\"receive\">รับตัวอย่าง</label>";
					$htm .= "</div>";
					$htm .= "<div class=\"custom-control custom-checkbox\">";
					$htm .= "<input type=\"checkbox\" class=\"custom-control-input\"";
					(!is_null($order->order_payment_date)) ? $htm .= " checked" : $htm .= "";
					$htm .= " disabled>";
					$htm .= "<label class=\"custom-control-label\" for=\"pending\">ชำระเงิน</label>";
					$htm .= "</div>";
					$htm .= "<div class=\"custom-control custom-checkbox\">";
					$htm .= "<input type=\"checkbox\" class=\"custom-control-input\"";
					(!is_null($order->order_sent_date)) ? $htm .= " checked" : $htm .= "";
					$htm .= " disabled>";
					$htm .= "<label class=\"custom-control-label\" for=\"success\">เสร็จสิ้น</label>";
					$htm .= "</div>";
					$htm .= "</form>";
					return $htm;
				})
				->editColumn(name: 'detail', content: function($order) {
					$htm = "<ul><li><a href=\"".$order->id."\"><i class=\"fal fa-print\"></i> ใบปะนำส่ง</a></li>";
					$htm .= "<li><a href=\"".$order->id."\"><i class=\"fal fa-print\"></i> รายงานผล</a></li></ul>";
					return $htm;
				})
				->addColumn(name: 'action', content: function($order) {
					if (is_null($order->order_confirmed_date) || empty($order->order_confirmed_date)) {
						return "
							<a href=\"".route('customer.info.create', ['order_id' => $order->id, 'order_type' => $order->order_type])."\" title=\"แก้ไข\" class=\"btn btn-warning btn-sm \"><i class=\"fal fa-pencil\"></i> แก้ไข</a>
							<a href=\"#\" class=\"btn btn-danger btn-sm \">ลบ <i class=\"fal fa-times\"></i></a>";
					} else {
						return "
							<a href=\"#\" class=\"btn btn-secondary btn-sm \">แก้ไข</a>
							<a href=\"#\" class=\"btn btn-secondary btn-sm \">ลบ</a>";
					}
				 })
				->rawColumns(['lab', 'status', 'detail', 'action']);
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Order $order
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Order $order): object {
		return $order?->whereUser_id($this->user_id)
			/* ?->whereIn('order_status', ['pending', 'received', 'analyzing', 'analyzed', 'destroy']) */
			?->with('parameters')
			?->orderBy('id', 'ASC');
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html() {
		try {
			return $this->builder()
				->setTableId("order-table")
				->setTableAttribute("class", "table table-bordered table-hover table-striped w-100")
				->columns($this->getColumns())
				->minifiedAjax()
				->responsive(true)
				->orderBy(0, 'desc')
				// ->dom("
				// 	<'row mb-3'
				// 		<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'B>
				// 		<'mt-2 col-sm-12 col-md-6 d-flex align-items-center justify-content-end'f>
				// 	>
				// 	<'row'
				// 		<'col-sm-12'tr>
				// 	>
				// 	<'row'
				// 		<'col-sm-12 col-md-5'i>
				// 		<'col-sm-12 col-md-7'p>
				// 	>"
				// )
				->dom('
				<"row"
					<"col-xs-12 col-sm-12 col-md-6 col-xl-6 col-lg-6 d-flex justify-content-center">
					<"col-xs-12 col-sm-12 col-md-6 col-xl-6 col-lg-6 d-flex justify-content-end"f>
				>
				<"row"
					<"col-sm-12"tr>
				>
				<"row"
					<"col-sm-12 col-md-5"i>
					<"col-sm-12 col-md-7"p>
				>'
				)
				->buttons(
					// Button::make('create')->addClass('btn btn-success font-prompt')->text('<i class="fal fa-plus-circle"></i> สร้างคำขอส่งตัวอย่าง')->action(""),
					Button::make('export')->addClass('btn btn-info')->text('<i class="fal fa-download"></i> <span class="d-none d-sm-inline">ส่งออก</span>'),
					Button::make('print')->addClass('btn btn-info')->text('<i class="fal fa-print"></i> <span class="d-none d-sm-inline">พิมพ์</span>'),
					// Button::make('reload')->addClass('btn btn-info')->text('<i class="fal fa-redo"></i> โหลดใหม่'),
				)
				->parameters([
					'language'=>['url'=>url('/vendor/DataTables/i18n/thai.json')],
				]);
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	/**
	 * Get columns.
	 *
	 * @return array
	 */
	protected function getColumns() {
		try {
			return [
				//Column::make('id')->title('รหัส'),
				Column::make('order_no')->title('เลขที่คำขอ'),
				Column::make('order_confirmed_date')->title('วันที่สร้าง'),
				Column::make('lab')->title('ตัวอย่าง/ส่งที่'),
				Column::make('status')->title('สถานะ'),
				Column::make('detail')->title('รายละเอียด'),
				Column::make('action')->title('จัดการ')->addClass('text-center'),
				// Column::computed('action')
				// ->exportable(false)
				// ->printable(false)
				// ->width(60)
				// ->addClass('text-center'),
			];
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename() {
		return 'orders' . date('YmdHis');
	}
}
