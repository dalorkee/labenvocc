<?php

namespace App\DataTables;

use App\Models\{User,SampleUpload};
use Yajra\DataTables\Html\{Button,Column};
use Yajra\DataTables\Html\Editor\{Editor,Fields};
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\Request;

class UploadBioDataTable extends DataTable
{

	public function dataTable($query): object {
		return datatables()
			->eloquent($query)
            ->addColumn('id', function ($dataupload){
                return '<input type="checkbox" name="biobox" id="biochk" value="'.$dataupload->id.'"/>';
            })
            ->addColumn('action', '<button type="button" class="bioupload-manage-nav btn btn-sm btn-info" data-id="{{$id}}">จัดการ<i class="fal fa-angle-down"></i> </button>')
            ->rawColumns(['id','action']);
	}

	public function query(SampleUpload $sample_upload) {
		return $sample_upload->whereUser_entry(auth()->user()->id)->orderBy('id', 'ASC');
	}

	public function html(): object {
		return $this->builder()
					->setTableId('upload_bio-table')
					->columns($this->getColumns())
					->minifiedAjax()
					->orderBy(1)
                    ->dom('rtip')
                    ->parameters([
                        'language'=>['url'=>url('/vendor/DataTables/i18n/thai.json')],
                    ]);
	}

	protected function getColumns() {
		return [
			Column::make('id')->title('check'),
			Column::make('firstname')->title('ชื่อ'),
            Column::make('lastname')->title('นามสกุล'),
			Column::make('age_year')->title('อายุปี'),
			Column::make('division')->title('แผนก'),
			Column::make('work_life_year')->title('อายุงาน'),
			Column::make('action')->title('manage'),
		];
	}

	protected function filename() {
		return 'UploadBio_' . date('YmdHis');
	}
}
