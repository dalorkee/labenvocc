<?php

namespace App\DataTables;

use App\Models\Admin\Advertise;
use Yajra\DataTables\Html\{Button,Column};
use Yajra\DataTables\Html\Editor\{Editor,Fields};
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\Request;

class UserAdvertiseDataTable extends DataTable
{
	public function dataTable($query): object {
		return datatables()
			->eloquent($query)
			->editColumn('advertise_type',function($adverchk){
				if($adverchk->advertise_type == 'ประชาสัมพันธ์'){
					return '<span class="badge badge-info">ประชาสัมพันธ์</span>';
				}
				else{
					return '<span class="badge badge-success">มาตราฐานคุณภาพ</span>';
				}
			})
			->editColumn('advertise_date',function($format_date){
				return date('Y-F-d',strtotime($format_date->advertise_date));
			})
			->addColumn("action", function($data) {
                return "<a href=\"".route('user.advertise.detail', ['id' => $data->id])."\"  class=\"advertise-manage-nav btn btn-sm btn-info text-white\">view</a>";
            })
			->rawColumns(['advertise_type','action']);
	}

	public function query(Advertise $advertise) {
		return $advertise->where('advertise_type',$this->adv_type)->orderBy('id', 'DESC');
	}

	public function html(): object {
		return $this->builder()
					->setTableId('advertise-table')
					->columns($this->getColumns())
					->minifiedAjax()
					->orderBy(1);
	}

	protected function getColumns() {
		return [
			Column::make('id')->title('ลำดับ'),
			Column::make('advertise_type')->title('ประเภทข่าว'),
			Column::make('advertise_title')->title('หัวข้อข่าว'),
			Column::make('advertise_detail')->title('รายละเอียด'),
			Column::make('advertise_date')->title('วันที่ลงรายการ'),
			Column::make('action')->title('view'),
		];
	}

	protected function filename() {
		return 'Advertise_' . date('YmdHis');
	}
}
