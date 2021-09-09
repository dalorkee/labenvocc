<?php

namespace App\DataTables;

use App\Models\Order;
use Yajra\DataTables\Html\{Button,Column};
//use Yajra\DataTables\Html\Editor\{Editor,Fields};
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Carbon;


class CustomersDataTable extends DataTable
{
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query) {
		return datatables()
			->eloquent($query)
			->editColumn('created_at', function($field) {
				return Carbon::parse($field->created_at)->format('d/m/Y');
			})
			->addColumn('status', function() {
				$htm = "<ul>";
				$htm .= "<li><input type=\"checkbox\" checked>รับตัวอย่างแล้ว</li>";
				$htm .= "<li><input type=\"checkbox\">ชำระเงินแล้ว</li>";
				$htm .= "<li><input type=\"checkbox\">เสร็จสิ้น</li>";
				$htm .= "</ul>";
				return $htm;
			})
			// ->addColumn('action', function() {
			// 	$htm = "<button type=\"button\" class=\"btn btn-danger\">จัดการ <i class=\"fal fa-angle-down\"></i></button>";
			// 	return $htm;
			// })
			->rawColumns(['status']);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Order $order
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Order $order) {
		return $order->newQuery();
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html() {
		return $this->builder()
			->setTableId("order-table")
			->setTableAttribute("class", "table table-bordered table-hover table-striped w-100")
			->columns($this->getColumns())
			->minifiedAjax()
			->responsive(true)
			->dom("
				<'row mb-3'
					<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'B>
					<'mt-2 col-sm-12 col-md-6 d-flex align-items-center justify-content-end'f>
				>
				<'row'
					<'col-sm-12'tr>
				>
				<'row'
					<'col-sm-12 col-md-5'i>
					<'col-sm-12 col-md-7'p>
				>"
			)
			->orderBy(0)
			->parameters(['language'=>['url'=>url('/vendor/DataTables/i18n/thai.json')]])
			->buttons(
				Button::make('create')->addClass('btn btn-success')->text('<i class="fal fa-plus-circle"></i> สร้างคำขอส่งตัวอย่าง')->action(""),
				// Button::make('export')->addClass('btn btn-info')->text('<i class="fal fa-download"></i> ส่งออก'),
				Button::make('print')->addClass('btn btn-info')->text('<i class="fal fa-print"></i> พิมพ์'),
				Button::make('reload')->addClass('btn btn-info')->text('<i class="fal fa-redo"></i> โหลดใหม่'),
			);
	}

	/**
	 * Get columns.
	 *
	 * @return array
	 */
	protected function getColumns() {
		return [
			Column::make('order_no')->title('เลขที่'),
			Column::make('created_at')->title('วันที่สร้าง'),
			Column::make('lab_station_id')->title('ส่งที่'),
			Column::make('status')->title('สถานะ'),
			Column::make('detail')->title('รายละเอียด'),
			// Column::make('action')->title('จัดการ')->addClass('text-right'),
			// Column::computed('action')
			// ->exportable(false)
			// ->printable(false)
			// ->width(60)
			// ->addClass('text-center'),
		];
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
