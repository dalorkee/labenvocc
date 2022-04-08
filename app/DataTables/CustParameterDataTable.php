<?php
namespace App\DataTables;

use Illuminate\Http\Request;

use Yajra\DataTables\Html\{Button,Column};
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\OrderDetail;
use App\Traits\CommonTrait;

class CustParameterDataTable extends DataTable
{
	use CommonTrait;

	public function dataTable($query) {
		try {
			switch (auth()->user()->userCustomer->customer_type) {
				case 'personal':
					return datatables()
						->eloquent($query)
						->editColumn('sample_date', function($field) {
							return Carbon::parse($field->sample_date)->format('d/m/Y');
						})
						->addColumn('parameter', function (OrderDetail $detail) {
							return $detail->parameters->map(function($parameter) {
								return "
								<div>
									<span class=\"badge badge-warning\">".$parameter->parameter_name."</span>
									<span class=\"badge badge-danger\">".$parameter->sample_charecter_name."</span>
									<span class=\"badge badge-info\">".$parameter->unit_customer_name."</span>
									<a href=\"".route('customer.parameter.data.destroy', ['id'=>$parameter->id])."\" data-toggle=\"tooltip\" data-placement=\"auto\" title=\"ลบ ".$parameter->parameter_name."\">
										<i class=\"fal fa-times-circle\"></i>
									</a>
								</div>";
							})->implode('<br>');
						})
						->addColumn('action', '<button class="context-nav bg-purple-400 hover:bg-purple-500 text-white py-1 px-3 rounded" id="context-menu" data-id="{{$id}}">จัดการ <i class="fal fa-angle-down"></i></button>')
						->rawColumns(['parameter', 'action']);
					break;
				case 'private':
				case 'government':
					return datatables()
						->eloquent($query)
						->editColumn('sample_date', function($field) {
							return Carbon::parse($field->sample_date)->format('d/m/Y');
						})
						->addColumn('parameter', function (OrderDetail $detail) {
							return $detail->parameters->map(function($parameter) {
								return "
								<div>
									<span class=\"badge badge-warning\">".$parameter->parameter_name."</span>
									<span class=\"badge badge-danger\">".$parameter->sample_charecter_name."</span>
									<span class=\"badge badge-info\">".$parameter->unit_customer_name."</span>
									<a href=\"".route('customer.parameter.data.destroy', ['id'=>$parameter->id])."\" data-toggle=\"tooltip\" data-placement=\"auto\" title=\"ลบ ".$parameter->parameter_name."\">
										<i class=\"fal fa-times-circle\"></i>
									</a>
								</div>";
							})->implode('<br>');
						})
						->addColumn('action', '<button class="context-nav bg-purple-400 hover:bg-purple-500 text-white py-1 px-3 rounded" id="context-menu" data-id="{{$id}}">จัดการ <i class="fal fa-angle-down"></i></button>')
						->rawColumns(['parameter', 'action']);
					break;
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function query(Request $request, OrderDetail $orderDetail) {
		return $orderDetail::with('parameters')->select('*')->whereOrder_id($request->order_id)->orderBy('id', 'ASC');
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
				<"row mb-2"
					<"col-8 d-flex justify-content-start dt-btn"B>
					<"col-4 d-flex justify-content-end">
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
					Button::make('create')->addClass('btn btn-success font-prompt')->text('<i class="fal fa-plus-circle"></i> <span class="d-none d-sm-inline">เพิ่มข้อมูลตัวอย่าง</span>')->action("javascript:newData()"),
					// Button::make('export')->addClass('btn btn-info font-prompt ml-2')->text('<i class="fal fa-download"></i> <span class="d-none d-sm-inline">ดาวน์โหลด</span>'),
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
			switch (auth()->user()->userCustomer->customer_type) {
				case 'personal':
					return [
						Column::make('id')->title('รหัสตัวอย่าง'),
						Column::make('firstname')->title('ชื่อ'),
						Column::make('lastname')->title('นามสกุล'),
						Column::make('age_year')->title('อายุ'),
						Column::make('sample_date')->title('วันที่เก็บ ตย.'),
						Column::make('parameter')->title('พารามิเตอร์'),
						Column::make('note')->title('หมายเหตุ'),
						Column::computed('action')->addClass('text-center')->title('#')
					];
					break;
				case 'private':
				case 'government':
					return [
						Column::make('id')->title('รหัสตัวอย่าง'),
						Column::make('firstname')->title('ชื่อ'),
						Column::make('lastname')->title('นามสกุล'),
						Column::make('age_year')->title('อายุ (ปี)'),
						Column::make('division')->title('แผนก'),
						Column::make('work_life_year')->title('อายุงาน'),
						Column::make('sample_date')->title('วันที่เก็บ ตย.'),
						Column::make('parameter')->title('พารามิเตอร์'),
						Column::make('note')->title('หมายเหตุ'),
						Column::computed('action')->addClass('text-center')->title('#')
					];
					break;
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function filename() {
		return 'order_detail' . date('YmdHis');
	}
}
