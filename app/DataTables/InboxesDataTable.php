<?php

namespace App\DataTables;

use App\Models\Order;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class InboxesDataTable extends DataTable
{
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query) {
		return datatables()
			->eloquent($query)
			// ->addColumn('action', function() {
			// 	return '<span class="text-success"><i class="fa fa-circle"></i></span>';
			// })
			->addColumn('title', function($q) {

                $new_order = $q->select('order_no')->where('order_status', '=', 'pending')->get();

				$x = $q->whereOrder_receive_status('received')->count();
				return 'งานใหม่ Lab No. 1123 จำนวน '.$new_order[0]->order_no.' test';
			});
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Inbox $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Order $model)
	{
		return $model->newQuery();
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html()
	{
		return $this->builder()
					->setTableId('inboxs-table')
					->columns($this->getColumns())
					->minifiedAjax()
					->dom('rtip')
					->orderBy(0)
					->buttons(
						Button::make('create'),
						Button::make('export'),
						Button::make('print'),
						Button::make('reset'),
						Button::make('reload')
					);
	}

	/**
	 * Get columns.
	 *
	 * @return array
	 */
	protected function getColumns()
	{
		return [
			// Column::computed('action')
			// 	->exportable(false)
			// 	->printable(false)
			// 	->width(60)
			// 	->addClass('text-center')
			// 	->title('#'),
			Column::make('title')
				->title('รายการ'),
		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename()
	{
		return 'Inboxs_' . date('YmdHis');
	}
}
