<?php

namespace App\DataTables;

use App\Models\SampleUpload;
use Yajra\DataTables\Html\{Button,Column};
use Yajra\DataTables\Html\Editor\{Editor,Fields};
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\Request;

class UploadBioDataTable extends DataTable
{
	public function dataTable($query): object {
		return datatables()
			->eloquent($query);
	}

	public function query(SampleUpload $sample_upload) {
		return $sample_upload->orderBy('id', 'ASC');
	}

	public function html(): object {
		return $this->builder()
					->setTableId('upload_bio-table')
					->columns($this->getColumns())
					->minifiedAjax()
					->orderBy(1)
                    ->parameters([
                        'language'=>['url'=>url('/vendor/DataTables/i18n/thai.json')],
                    ]);
	}

	protected function getColumns() {
		return [
			Column::make('id')->title('ลำดับที่'),
			Column::make('firstname')->title('ชื่อ-นามสกุล'),
			Column::make('advertise_title')->title('อายุปี'),
			Column::make('advertise_detail')->title('แผนก'),
			Column::make('advertise_date')->title('อายุงาน'),
			Column::make('action')->title('manage'),
		];
	}

	protected function filename() {
		return 'UploadBio_' . date('YmdHis');
	}
}
