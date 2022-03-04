<?php

namespace App\DataTables;

use App\Models\Admin\Advertise;
use Yajra\DataTables\Html\{Button,Column};
use Yajra\DataTables\Html\Editor\{Editor,Fields};
use Yajra\DataTables\Services\DataTable;

class AdvertiseDataTable extends DataTable
{
	// private function officeFilter(array $academy_arr) {
	// 	$str = "";
	// 	foreach ($academy_arr as $key => $value) {
	// 		$str .= "WHEN academy = \"".$key."\" THEN \"".$value['name_academy']."\" ";
	// 	}
	// 	return $str;
	// }
	public function dataTable($query): object {
		return datatables()
			->eloquent($query)
			->editColumn('advertise_type',function($adverchk){
				if($adverchk->advertise_type == 'ประชาสัมพันธ์'){
					return '<span class="badge badge-info">ประชาสัมพันธ์</span>';
				}else{
					return '<span class="badge badge-success">มาตราฐานคุณภาพ</span>';
				}
			})
			->editColumn('advertise_date',function($format_date){
				return date('Y-F-d',strtotime($format_date->advertise_date));
			})
			->addColumn('action', '<button type="button" class="advertise-manage-nav btn btn-sm btn-info" data-id="{{$id}}">จัดการ<i class="fal fa-angle-down"></i> </button>')
			->rawColumns(['advertise_type','action']);
	}

	public function query(Advertise $advertise) {
		return $advertise->orderBy('id', 'DESC');		
	}

	public function html(): object {
		return $this->builder()
					->setTableId('advertise-table')
					->columns($this->getColumns())
					->minifiedAjax()
					->dom('Bfrtip')
					->orderBy(1)
					->buttons(
						Button::make('create')->text('<button class="btn btn-primary"><i class="fal fa-plus"></i> เพิ่มข่าว</button>')->action("window.location = '".route('advertise.create')."';"),
					);
	}

	protected function getColumns() {
		return [
			Column::make('id')->title('ลำดับ'),
			Column::make('advertise_type')->title('ประเภทข่าว'),
			Column::make('advertise_title')->title('หัวข้อข่าว'),
			Column::make('advertise_detail')->title('รายละเอียด'),
			Column::make('advertise_date')->title('วันที่ลงรายการ'),
			Column::make('action')->title('จัดการ'),
		];
	}

	protected function filename() {
		return 'Advertise_' . date('YmdHis');
	}
}
