<?php

namespace App\DataTables;

use App\Models\Admin\Office;
use App\Models\Postal;
use App\Traits\RefTrait;
use Yajra\DataTables\Html\{Button,Column};
use Yajra\DataTables\Html\Editor\{Editor,Fields};
use Yajra\DataTables\Services\DataTable;

class OfficeDataTable extends DataTable
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
			->editColumn('office_status',function($officechk){
				if($officechk->office_status == 'สมัครใหม่'){
					return '<span class="badge badge-warning">สมัครใหม่</span>';
				}
				elseif($officechk->office_status == 'อนุญาต'){
					return '<span class="badge badge-success text-dark">อนุญาต</span>';
				}
				elseif($officechk->office_status == 'ปิด'){
					return '<span class="badge badge-secondary">ปิด</span>';
				}
				elseif($officechk->office_status == 'ไม่อนุญาต'){
					return '<span class="badge badge-danger">ไม่อนุญาต</span>';
				}
			})
			->addColumn('action', '<button type="button" class="office-manage-nav btn btn-sm btn-info" data-id="{{$office_id}}">จัดการ <i class="fal fa-angle-down"></i> </button>')
			->rawColumns(['office_status','action']);
	}

	public function query(Office $model) {
		//return $model->newQuery();

		return $model->select('office_id', 'office_code', 'office_name', 'office_status')
						->orderBy('office_id','DESC');
	}


	public function html(): object {
		return $this->builder()
					->setTableId('office-table')
					->columns($this->getColumns())
					->minifiedAjax()
					->dom('Bfrtip')
					->orderBy(1)
					->buttons(
						Button::make('create')->text('เพิ่มหน่วยงาน'),
						// Button::make('export'),
						// Button::make('print'),
						// Button::make('reset'),
						// Button::make('reload')
					);
	}

	protected function getColumns() {
		return [
			// Column::computed('action')
			//       ->exportable(false)
			//       ->printable(false)
			//       ->width(60)
			//       ->addClass('text-center'),
			Column::make('office_id')->title('ลำดับ'),
			Column::make('office_code')->title('รหัสหน่วยงาน'),
			Column::make('office_name')->title('ชื่อ'),
			Column::make('office_status')->title('สถานะ'),
			Column::make('action')->title('จัดการ'),
			// Column::make('created_at'),
			// Column::make('updated_at'),
		];
	}

	protected function filename() {
		return 'Office_' . date('YmdHis');
	}
}
