<?php
namespace App\DataTables;

use Illuminate\Http\Request;

use Yajra\DataTables\Html\{Button,Column};
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\{Auth,Log};
use App\Models\{Order, OrderDetail};
use App\Traits\CommonTrait;

class CustVerifyDataTable extends DataTable
{
	use CommonTrait;

	public function dataTable($query) {
		try {
			$sample_office_category = $this->sampleOfficeCategory();
			return datatables()
				->eloquent($query)
				->editColumn('fullname', function($field) {
					return $field->firstname.' '.$field->lastname;
				})
				->editColumn('sample_date', function($field) {
					return Carbon::parse($field->created_at)->format('d/m/Y');
				})
				->editColumn('sample_office_category', function($field) use ($sample_office_category) {
					return $sample_office_category[$field->sample_office_category] ?? null;
				})
				->addColumn('parameter', function ($parameters) {
					return $parameters->parameters->map(function($parameter) {
						return "<span class=\"badge badge-info mb-1\">".$parameter->parameter_name."</span>";
					})->implode('<br />');
				})
				->addColumn('unit', function ($units) {
					return $units->parameters->map(function($parameter) {
						return $parameter->unit_name;
					})->implode('<br />');
				})
				->addColumn('action', '<button class="context-nav bg-purple-400 hover:bg-purple-500 text-white py-1 px-3 rounded" id="context-menu" data-id="{{$id}}">จัดการ <i class="fal fa-angle-down"></i></button>')
				->rawColumns(['parameter', 'action']);
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function query(Request $request, OrderDetail $orderDetail) {
		return $orderDetail->with('parameters')->whereOrder_id($request->order_id)->orderBy('id', 'ASC');
	}

	public function html() {
		try {
			return $this->builder()
				->setTableId("verify_table")
				->setTableAttribute("class", "table table-bordered table-hover table-striped w-100")
				->columns($this->getColumns())
				->minifiedAjax()
				->responsive(true)
				->orderBy(0, 'desc')
				->dom('
				<"row mb-2"
					<"col-8 d-flex justify-content-start dt-btn">
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
				//->buttons(
				//Button::make('create')->addClass('btn btn-success font-prompt')->text('<i class="fal fa-plus-circle"></i> <span class="d-none d-sm-inline">เพิ่มประเด็นมลพิษ</span>')->action("javascript:newData()"),
				//	Button::make('export')->addClass('btn btn-info font-prompt')->text('<i class="fal fa-download"></i> <span class="d-none d-sm-inline">ส่งออก</span>'),
				// Button::make('print')->addClass('btn btn-info font-prompt')->text('<i class="fal fa-print"></i> <span class="d-none d-sm-inline">print</span>')->action("javascript:alert('xx')"),
				// Button::make('reload')->addClass('btn btn-info')->text('<i class="fal fa-redo"></i> โหลดใหม่'),
				//)
				->parameters([
					'language' => ['url'=>url('/vendor/DataTables/i18n/thai.json')],
                    'responsive' => true,
                    'autoWidth' => true,
				]);
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function getColumns() {
		try {
			return [
				Column::make('id')->title('รหัสตัวอย่าง')->className('col-md-2'),
				Column::make('fullname')->title('ชื่อ-สกุล'),
				Column::make('age_year')->title('อายุ'),
				Column::make('division')->title('หน่วยงาน'),
				Column::make('work_life_year')->title('อายุงาน/ปี'),
				Column::make('sample_date')->title('วันที่เก็บตัวอย่าง'),
				Column::make('sample_charecter')->title('ประเด็นมลพิษ'),
				Column::make('parameter')->title('พารามิเตอร์'),
				Column::make('unit')->title('หน่วย'),
				Column::make('sample_office_category')->title('ประเภทสถานที่เก็บตัวอย่าง'),
				Column::make('sample_office_id')->title('รหัสสถานที่'),
				Column::make('sample_office_name')->title('ชื่อสถานที่'),
				Column::make('sample_office_addr')->title('ที่อยู่'),
				Column::make('sample_office_sub_district_name')->title('ตำบล'),
				Column::make('sample_office_district_name')->title('อำเภอ'),
				Column::make('sample_office_province_name')->title('จังหวัด'),
				Column::make('sample_office_postal')->title('รหัสไปรษณีย์'),
				Column::make('note')->title('หมายเหตุ'),
				Column::computed('action')->addClass('text-center')->title('#')
			];
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function filename() {
		return 'verify_data' . date('YmdHis');
	}
}
