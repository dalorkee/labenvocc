<?php

namespace App\DataTables;

use App\Models\Parameter;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ParameterDataTable extends DataTable
{
    protected $dataTableVariable = 'dataTable1';

	public function dataTable($query) {
		return datatables()
			->eloquent($query)
			->addColumn('action', 'parameter.action');
	}

	public function query(Parameter $model) {
		return $model->select('id', 'parameter_id', 'parameter_name', 'sample_type_id', 'sample_type', 'method', 'office_id');
	}

	public function html() {
		return $this->builder()
			->setTableId('parameter-table')
			->columns($this->getColumns())
			->minifiedAjax()
			->dom('Bfrtip')
			->orderBy(1)
			->buttons(
				Button::make('create'),
				Button::make('export'),
				Button::make('print'),
				Button::make('reset'),
				Button::make('reload')
			);
	}

	protected function getColumns() {
		return [
			Column::make('parameter_name')->title('พารามิเตอร์'),
			Column::make('sample_type')->title('สิ่งส่งตรวจ'),
			Column::make('office_id')->title('ห้องปฏิบัติการ'),
			Column::make('method')->title('ราคา (บาท)'),
			Column::computed('action')->addClass('text-center')->title('เพิ่ม')
		];
	}

	protected function filename() {
		return 'Parameter_' . date('YmdHis');
	}
}
