<?php
namespace App\DataTables;

use App\Models\OrderDetail;
use App\Models\OrderDetailParameter;
use Yajra\DataTables\Html\{Button,Column};
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Traits\CommonTrait;

class CustParameterDataTable extends DataTable
{
	use CommonTrait;

	public function dataTable($query) {
		try {
			$lab_station = $this->latStation();
			return datatables()
				->eloquent($query)
				->editColumn('created_at', function($field) {
					return Carbon::parse($field->created_at)->format('d/m/Y');
				})
				->addColumn('parameter', function (OrderDetail $detail) {
					return $detail->parameters->map(function($parameter) {
						return $parameter->parameter_name;
					})->implode('<br>');
				})
				->addColumn('unit', function (OrderDetail $detail) {
					return $detail->parameters->map(function($parameter) {
						return $parameter->unit_name;
					})->implode('<br>');
				})
				->addColumn('action', '<button class="context-nav bg-purple-400 hover:bg-purple-500 text-white py-1 px-3 rounded" id="context-menu" data-id="{{$id}}">จัดการ <i class="fal fa-angle-down"></i></button>')
				->rawColumns(['parameter', 'unit', 'action']);;
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function query(OrderDetail $orderDetail) {
		//return $orderDetail->newQuery();
		//$orders =  OrderDetail::select('id', 'firstname', 'lastname', 'age_year', 'work_life_year', 'specimen_date' );
		$orders = OrderDetail::with('parameters')->select('*');
		return $orders;
	}

	public function html() {
		try {
			return $this->builder()
				->setTableId("order-table")
				->setTableAttribute("class", "table table-bordered table-hover table-striped w-100")
				->columns($this->getColumns())
				->minifiedAjax()
				->responsive(true)
				->orderBy(0, 'desc')
				->dom('
				<"row"
					<"col-xs-12 col-sm-12 col-md-6 col-xl-6 col-lg-6 d-flex justify-content-start"B>
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
					Button::make('create')->addClass('btn btn-success font-prompt')->text('<i class="fal fa-plus-circle"></i> เพิ่มข้อมูลใหม่')->action("javascript:newData()"),
				// 	Button::make('export')->addClass('btn btn-info')->text('<i class="fal fa-download"></i> <span class="d-none d-sm-inline">ส่งออก</span>'),
				// 	Button::make('print')->addClass('btn btn-info')->text('<i class="fal fa-print"></i> <span class="d-none d-sm-inline">พิมพ์</span>'),
				// 	Button::make('reload')->addClass('btn btn-info')->text('<i class="fal fa-redo"></i> โหลดใหม่'),
				)
				->parameters([
					'language'=>['url'=>url('/vendor/DataTables/i18n/thai.json')],
				]);
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function getColumns() {
		try {
			return [
				Column::make('id')->title('รหัส'),
				Column::make('firstname')->title('ชื่อ'),
				Column::make('lastname')->title('นามสกุล'),
				Column::make('age_year')->title('อายุ (ปี)'),
				Column::make('division')->title('แผนก'),
				Column::make('work_life_year')->title('อายุงาน'),
				Column::make('specimen_date')->title('วันที่เก็บตัวอย่าง'),
				Column::make('parameter')->title('พารามิเตอร์'),
				Column::make('unit')->title('หน่วย'),
				Column::make('note')->title('หมายเหตุ'),
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
