<?php
namespace App\DataTables;

use Illuminate\Http\Request;

use Yajra\DataTables\Html\{Button,Column};
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\{Auth,Log};
use App\Models\{OrderDetail};
use App\Traits\CommonTrait;

class CustVerifyDataTable extends DataTable
{
	use CommonTrait;

	public function dataTable($query) {
		try {
			$sample_office_category = $this->sampleOfficeCategory();
			switch (auth()->user()->userCustomer->customer_type) {
				case 'personal':
					return datatables()
					->eloquent($query)
					->editColumn('firstname', function(OrderDetail $orderDetail) {
						return "<div style=\"width: 160px\">".$orderDetail->firstname."</div>";
					})
					->editColumn('lastname', function(OrderDetail $orderDetail) {
						return "<div style=\"width: 180px\">".$orderDetail->lastname."</div>";
					})
                    ->editColumn('sample_date', function(Orderdetail $orderDetail) {
                        return Carbon::parse($orderDetail->sample_date)->format('d/m/Y');
                    })
					->addColumn('parameter', function (OrderDetail $orderDetail) {
						return $orderDetail->parameters->map(function($paramet) {
							return "
                            <div style=\"width: 500px\">
									<span class=\"badge badge-warning\">".$paramet->parameter_name."</span>
									<span class=\"badge badge-danger\">".$paramet->sample_charecter_name."</span>
									<span class=\"badge badge-success\">".$paramet->unit_customer_name."</span>
									<a href=\"".route('customer.parameter.data.destroy', ['id'=>$paramet->id])."\" data-toggle=\"tooltip\" data-placement=\"auto\" title=\"ลบ ".$paramet->parameter_name."\">
										<i class=\"fal fa-times-circle\"></i>
									</a>
								</div>";
						})->implode('<br>');
					})
                    ->editColumn('origin_threat_name', function(OrderDetail $orderDetail) {
                        return "<div style=\"width: 310px\">".$orderDetail->origin_threat_name."</div>";
                    })
					->editColumn('sample_location_place_name', '{{ $sample_location_place_name }}')
					->editColumn('sample_location_place_sub_district_name', '{{ $sample_location_place_sub_district_name }}')
					// ->addColumn('sample_office_district_name', function($orderDetail) {
					// 	return "<div style=\"width: 150px\">".$orderDetail->sample_office_district_name."</div>";
					// })
					// ->addColumn('sample_office_province_name', function($orderDetail) {
					// 	return "<div style=\"width: 150px\">".$orderDetail->sample_office_province_name."</div>";
					// })
					// ->addColumn('sample_office_postal', function($orderDetail) {
					// 	return "<div style=\"width: 100px\">".$orderDetail->sample_office_postal."</div>";
					// })
					->rawColumns(['firstname', 'lastname', 'parameter', 'origin_threat_name']);
					break;
				case 'private':
				case 'government':
					// return datatables()
					// 	->eloquent($query)
					// 	->editColumn('id', '{{ $id }}')
					// 	->editColumn('fullname', function($orderDetail) {
					// 		return "<div style=\"width: 200px\">".$orderDetail->firstname." ".$orderDetail->lastname."</div>";
					// 	})
					// 	->editColumn('division', function($orderDetail) {
					// 		return "<div style=\"width: 200px\">".$orderDetail->division."</div>";
					// 	})
					// 	->addColumn('work_life_year', function($orderDetail) {
					// 		return "<div style=\"width: 100px\">".$orderDetail->work_life_year."</div>";
					// 	})
					// 	->addColumn('sample_date', function($orderDetail) {
					// 		return "<div style=\"width: 120px\">".Carbon::parse($orderDetail->created_at)->format('d/m/Y')."</div>";
					// 	})
					// 	->addColumn('parameter', function ($parameters) {
					// 		return $parameters->parameters->map(function($parameter) {
					// 			return "<span class=\"badge badge-info mb-1\">".$parameter->parameter_name."</span>";
					// 		})->implode('<br />');
					// 	})
					// 	->addColumn('unit', function ($units) {
					// 		return $units->parameters->map(function($parameter) {
					// 			return "<span class=\"badge badge-info mb-1\">".$parameter->unit_name."</span>";
					// 		})->implode('<br />');
					// 	})
					// 	->editColumn('sample_office_category', function($orderDetail) use ($sample_office_category) {
					// 		$rs = $sample_office_category[$orderDetail->sample_office_category] ?? null;
					// 		return "<div style=\"width: 180px\">".$rs."</div>";
					// 	})
					// 	->addColumn('sample_office_id', function($orderDetail) {
					// 		return "<div style=\"width: 100px\">".$orderDetail->sample_office_id."</div>";
					// 	})
					// 	->addColumn('sample_office_name', function($orderDetail) {
					// 		return "<div style=\"width: 300px\">".$field->sample_office_name."</div>";
					// 	})
					// 	->addColumn('sample_office_addr', function($orderDetail) {
					// 		return "<div style=\"width: 300px\">".$orderDetail->sample_office_addr."</div>";
					// 	})
					// 	->addColumn('sample_office_sub_district_name', function($orderDetail) {
					// 		return "<div style=\"width: 150px\">".$orderDetail->sample_office_sub_district_name."</div>";
					// 	})
					// 	->addColumn('sample_office_district_name', function($orderDetail) {
					// 		return "<div style=\"width: 150px\">".$orderDetail->sample_office_district_name."</div>";
					// 	})
					// 	->addColumn('sample_office_province_name', function($orderDetail) {
					// 		return "<div style=\"width: 150px\">".$orderDetail->sample_office_province_name."</div>";
					// 	})
					// 	->addColumn('sample_office_postal', function($orderDetail) {
					// 		return "<div style=\"width: 100px\">".$orderDetail->sample_office_postal."</div>";
					// 	})
					// 	->addColumn('action', '<button class="context-nav bg-purple-400 hover:bg-purple-500 text-white py-1 px-3 rounded" id="context-menu" data-id="{{$id}}">จัดการ <i class="fal fa-angle-down"></i></button>')
					// 	->rawColumns([
					// 		'id',
					// 		'fullname',
					// 		'division',
					// 		'work_life_year',
					// 		'sample_date',
					// 		'parameter',
					// 		'unit',
					// 		'sample_office_category',
					// 		'sample_office_id',
					// 		'sample_office_name',
					// 		'sample_office_addr',
					// 		'sample_office_sub_district_name',
					// 		'sample_office_district_name',
					// 		'sample_office_province_name',
					// 		'sample_office_postal',
					// 		'action'
					// 	]);
						break;
					}
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
					'autoWidth' => false,
					// 'scrollY' => "300px",
					// 'scrollX' => true,
					// 'scrollCollapse' => true,
					// 'columnDefs' => [
					// 	["targets" => ['2'], "width" => "500px"],
					// 	["targets" => ['3'], 'width' => '600'],
					// ],
					// 'fixedColumns' => true,
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
						Column::make('id')->title('รหัส')->className('bg-red-200'),
						Column::make('firstname')->title('ชื่อ'),
						Column::make('lastname')->title('สกุล'),
						Column::make('age_year')->title('อายุ'),
						Column::make('sample_date')->title('วันที่เก็บ ตย.'),
						Column::make('parameter')->title('พารามิเตอร์'),
						Column::make('origin_threat_name')->title('ประเด็นมลพิษ'),
						Column::make('sample_location_place_name')->title('สถานที่เก็บ ตย.'),
						Column::make('sample_location_place_address')->title('ที่อยู่'),
						Column::make('sample_location_place_sub_district_name')->title('ตำบล'),
						Column::make('sample_location_place_district_name')->title('อำเภอ'),
						Column::make('sample_location_place_province_name')->title('จังหวัด'),
						Column::make('note')->title('หมายเหตุ'),
					];
					break;
				case 'private':
				case 'government':
					// return [
					// 	Column::make('id')->title('รหัส')->className('bg-red-200'),
					// 	Column::make('fullname')->title('ชื่อ-สกุล'),
					// 	Column::make('age_year')->title('อายุ'),
					// 	Column::make('division')->title('หน่วยงาน'),
					// 	Column::make('work_life_year')->title('อายุงาน/ปี'),
					// 	Column::make('sample_date')->title('วันที่เก็บตัวอย่าง'),
					// 	Column::make('parameter')->title('พารามิเตอร์'),
					// 	Column::make('unit')->title('หน่วย'),
					// 	Column::make('sample_office_category')->title('ประเภทสถานที่เก็บตัวอย่าง'),
					// 	Column::make('sample_office_id')->title('รหัสสถานที่'),
					// 	Column::make('sample_office_name')->title('ชื่อสถานที่'),
					// 	Column::make('sample_office_addr')->title('ที่อยู่'),
					// 	Column::make('sample_office_sub_district_name')->title('ตำบล'),
					// 	Column::make('sample_office_district_name')->title('อำเภอ'),
					// 	Column::make('sample_office_province_name')->title('จังหวัด'),
					// 	Column::make('sample_office_postal')->title('รหัสไปรษณีย์'),
					// 	Column::make('note')->title('หมายเหตุ'),
					// 	Column::computed('action')->addClass('text-center')->title('#')
					// ];
					// break;
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function filename() {
		return 'verify_data' . date('YmdHis');
	}
}
