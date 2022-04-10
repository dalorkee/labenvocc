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
			$lab_station = $this->latStation();
			return datatables()
				->eloquent($query)
				->editColumn('created_at', function($order) {
					return Carbon::parse($order->created_at)->format('d/m/Y');
				})
				->editColumn('lab_station_id', function($order) use ($lab_station) {
					return $lab_station[$order->lab_station_id] ?? null;
				})
				->addColumn('status', function() {
					$htm = "<form>";
					$htm .= "<div class=\"custom-control custom-checkbox\">";
					$htm .= "<input type=\"checkbox\" class=\"custom-control-input\" checked disabled>";
					$htm .= "<label class=\"custom-control-label\" for=\"receive\">รับตัวอย่างแล้ว</label>";
					$htm .= "</div>";
					$htm .= "<div class=\"custom-control custom-checkbox\">";
					$htm .= "<input type=\"checkbox\" class=\"custom-control-input\" disabled>";
					$htm .= "<label class=\"custom-control-label\" for=\"pending\">ชำระเงินแล้ว</label>";
					$htm .= "</div>";
					$htm .= "<div class=\"custom-control custom-checkbox\">";
					$htm .= "<input type=\"checkbox\" class=\"custom-control-input\" disabled>";
					$htm .= "<label class=\"custom-control-label\" for=\"success\">เสร็จสิ้น</label>";
					$htm .= "</div>";
					$htm .= "</form>";
					return $htm;
				})
				->editColumn('detail', function($order) {
					$htm = "<ul><li><a href=\"".$order->id."\"><i class=\"fal fa-print\"></i> ใบปะนำส่ง</a></li>";
					$htm .= "<li><a href=\"".$order->id."\"><i class=\"fal fa-print\"></i> รายงานผล</a></li></ul>";
					return $htm;
				})
				->addColumn('action', function($order) {
					return "<a href=\"".route('customer.info.create', ['order_id' => $order->id])."\" title=\"แก้ไข\" class=\"btn btn-warning\"><i class=\"fal fa-pencil\"></i></a>";
				 })
				->rawColumns(['status', 'detail', 'action']);
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
	public function query(Order $order) {
		return $order->whereUser_id($this->user_id)->orderBy('id', 'ASC');
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
				Column::make('id')->title('เลขที่'),
				Column::make('created_at')->title('วันที่สร้าง'),
				Column::make('lab_station_id')->title('ส่งที่'),
				Column::make('status')->title('สถานะ'),
				Column::make('detail')->title('รายละเอียด'),
				Column::make('action')->title('จัดการ')->addClass('text-right'),
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
