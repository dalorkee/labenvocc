<?php

namespace App\DataTables;

use App\Models\Admin\Office;
use App\Models\Postal;
use Yajra\DataTables\Html\{Button,Column};
use Yajra\DataTables\Html\Editor\{Editor,Fields};
use Yajra\DataTables\Services\DataTable;

class OfficeDataTable extends DataTable
{
	public function dataTable($query): object {
		return datatables()
			->eloquent($query)
			->addColumn('action', '<button class="context-nav btn btn-custom-1 btn-sm">Manage <i class="fas fa-angle-down"></i></button>');
	}

	public function query(Office $model) {
		return $model->newQuery();
		//return $model->select('office_id', 'office_code', 'office_name', 'office_status')->get();
	}


	public function html(): object {
		return $this->builder()
					->setTableId('office-table')
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
			// Column::computed('action')
			//       ->exportable(false)
			//       ->printable(false)
			//       ->width(60)
			//       ->addClass('text-center'),
			Column::make('office_id'),
			Column::make('office_code'),
			Column::make('office_name'),
			Column::make('office_status'),
			// Column::make('action'),
			// Column::make('created_at'),
			// Column::make('updated_at'),
		];
	}

	protected function filename() {
		return 'Office_' . date('YmdHis');
	}
}
