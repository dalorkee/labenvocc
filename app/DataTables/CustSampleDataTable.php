<?php
namespace App\DataTables;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\{Button,Column};
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\OrderSample;

class CustSampleDataTable extends DataTable
{
	public function dataTable($query) {
		try {
			switch (auth()->user()->userCustomer->customer_type) {
				case 'personal':
				case 'private':
				case 'government':
					return datatables()
						->eloquent($query)
						->editColumn('firstname', function($order_sample) {
							return "<div style=\"width: 160px\">".$order_sample->firstname."</div>";
						})
						->editColumn('lastname', function($order_sample) {
							return "<div style=\"width: 180px\">".$order_sample->lastname."</div>";
						})
						->editColumn('sample_date', function($order_sample) {
							return Carbon::parse($order_sample->sample_date)->format('d/m/Y');
						})
						->addColumn('parameter', function ($order_sample) {
							return $order_sample->parameters->map(function($parameter) {
								return "
								<div style=\"width: 500px\">
									<span class=\"badge badge-warning\">".$parameter->parameter_name."</span>
									<span class=\"badge badge-info\">".$parameter->sample_charecter_name."</span>
									<span class=\"badge badge-success\">".$parameter->unit_customer_name."</span>
									<!--
									<a href=\"".route('customer.parameter.data.destroy', ['id'=>$parameter->id, 'order_sample_id' => $parameter->order_sample_id])."\" data-toggle=\"tooltip\" data-placement=\"auto\" title=\"ลบ ".$parameter->parameter_name."\">
										<i class=\"fal fa-times-circle\"></i>
									</a>
									-->
								</div>";
							})->implode('<br>');
						})
						->addColumn('total_price', function ($order_sample) {
							$sum_price = 0;
							$calc = $order_sample->parameters->map(function($parameter) use (&$sum_price) {
								$sum_price += (int)$parameter->price_name;
							});
							return number_format($sum_price);
						})
						->editColumn('origin_threat_name', function($order_sample) {
							return "<div style=\"width: 310px\">".$order_sample->origin_threat_name."</div>";
						})
						->editColumn('place_name', function($order_sample) {
							return "<div style=\"width: 310px\">"
								.$order_sample->sample_location_place_ministry_name." "
								.$order_sample->sample_location_place_department_name. " "
								.$order_sample->sample_location_place_name
								."</div>";
						})
						->rawColumns(['firstname', 'lastname', 'parameter', 'origin_threat_name', 'place_name']);
					break;
				default:
						return redirect()->route('logout');
				}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function query(Request $request, OrderSample $order_sample) {
		return $order_sample::with('parameters')->select('*')->whereOrder_id($request->order_id)->orderBy('id', 'ASC');
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
					<"col-4 d-flex justify-content-end"f>
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
					Button::make('create')->addClass('btn btn-success font-prompt')->text('<i class="fal fa-plus-circle"></i> <span class="d-none d-sm-inline">เพิ่มประเด็นมลพิษ</span>')->action("javascript:newData()"),
					// Button::make('export')->addClass('btn btn-info font-prompt ml-2')->text('<i class="fal fa-download"></i> <span class="d-none d-sm-inline">ดาวน์โหลด</span>'),
					// Button::make('print')->addClass('btn btn-info font-prompt')->text('<i class="fal fa-print"></i> <span class="d-none d-sm-inline">print</span>')->action("javascript:alert('xx')"),
					// Button::make('reload')->addClass('btn btn-info')->text('<i class="fal fa-redo"></i> โหลดใหม่'),
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
				case 'private':
				case 'government':
					return [
						Column::make('id')->title('รหัส'),
						Column::make('firstname')->title('ชื่อ'),
						Column::make('lastname')->title('นามสกุล'),
						Column::make('age_year')->title('อายุ'),
						Column::make('sample_date')->title('วันที่เก็บตัวอย่าง'),
						Column::make('parameter')->title('พารามิเตอร์'),
						Column::make('total_price')->title('ราคา'),
						Column::make('origin_threat_name')->title('ประเด็นมลพิษ'),
						Column::make('place_name')->title('สถานที่เก็บ ตย.'),
						Column::make('sample_location_place_address')->title('ที่อยู่'),
						Column::make('sample_location_place_sub_district_name')->title('ตำบล'),
						Column::make('sample_location_place_district_name')->title('อำเภอ'),
						Column::make('sample_location_place_province_name')->title('จังหวัด'),
						Column::make('note')->title('หมายเหตุ'),
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
