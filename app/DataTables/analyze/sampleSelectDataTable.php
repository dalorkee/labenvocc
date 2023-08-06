<?php

namespace App\DataTables\analyze;

use App\Models\{OrderSample};
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class sampleSelectDataTable extends DataTable
{
	public function dataTable($query) {
		return datatables()
			->eloquent($query)
			->addColumn('info', fn () => "<a href=\"javascript:void(0);\" class=\"btn btn-info btn-sm btn-icon rounded-circle\"><i class=\"fal fa-info\"></i></a>")
			->addColumn('paramet', function($sample) {
				$htm = "<ul>\n";
				foreach ($sample->parameters as $key => $value) {
					$htm .= "<li><span class=\"badge badge-\">".$value['parameter_name']."</span></li>\n";
				}
				$htm .= "</ul>\n";
				return $htm;
			})
			->addColumn('action', '<button>pjx</button>')
			->rawColumns(['info', 'paramet', 'action']);
	}
	public function query(OrderSample $model) {
		$user_id = $this->user_id;
		$data = array();
		$sample = $model->with(['parameters' => function($paramet) use ($user_id) {
			$paramet->where('main_analys_user_id', '=', $user_id);
		}])->whereOrder_id($this->order_id)->each(function($item, $key) use (&$data) {
			if (count($item->parameters) > 0) {
				array_push($data, $key);
			}
		});
		return $sample;
	}
	public function html() {
		return $this->builder()
		->setTableId("order-table-list")
		->setTableAttribute("class", "table table-bordered table-hover table-striped w-100")
		->columns($this->getColumns())
		->minifiedAjax()
		->responsive(true)
		->parameters(['language' => ['url' => url('/vendor/DataTables/i18n/thai.json')]]);
	}
	protected function getColumns() {
		return [
			Column::make('id')->title('ลำดับ'),
			Column::make('sample_test_no')->title('หมายเลขทดสอบ'),
			Column::make('info')->title('รายละเอียด'),
			Column::make('paramet')->title('พารามิเตอร์'),
			Column::computed('action')->title('#')->width('24%')->addClass('text-center')
		];
	}

	protected function filename() {
		return 'sampleSelect_' . date('YmdHis');
	}
}
