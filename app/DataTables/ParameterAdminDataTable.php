<?php

namespace App\DataTables;

use App\Models\{Parameter};
use Yajra\DataTables\Html\{Button,Column};
// use Yajra\DataTables\Html\Editor\{Editor,Fields};
use Yajra\DataTables\Services\DataTable;

class ParameterAdminDataTable extends DataTable
{
	public function dataTable($query): object {
		return datatables()
			->eloquent($query)
			->addColumn('action', '<button type="button" class="parameter-manage-nav btn btn-sm btn-info" data-id="{{$id}}">จัดการ<i class="fal fa-angle-down"></i> </button>');
	}

	public function query(Parameter $parameter) {
		$parameters = $parameter->orderBy('id', 'ASC');
        return $parameters;
	}

	public function html(): object {
		return $this->builder()
					->setTableId('parameter-table')
					->columns($this->getColumns())
					->minifiedAjax()
					->dom('Bfrtip')
					->orderBy(1)
                    ->buttons(
						Button::make('create')
						->text('<button class="btn btn-success"><i class="fal fa-plus"></i> เพิ่มพารามิเตอร์</button>')
						->action("window.location = '".route('paramet.create')."';")
                    );
	}

	protected function getColumns() {
		return [
			Column::make('id')->title('ลำดับ'),
			Column::make('parameter_name')->title('พารามิเตอร์'),
			Column::make('sample_character_name')->title('ประเภทตัวอย่าง'),
			Column::make('sample_type_name')->title('ประเภทใบคำขอ'),
			Column::make('threat_type_name')->title('ประเภทมลพิษ'),
			Column::make('office_name')->title('หน่วยงาน'),
            Column::make('action')->title('จัดการ'),
		];
	}

	protected function filename() {
		return 'ParameterAdmin_' . date('YmdHis');
	}
}
