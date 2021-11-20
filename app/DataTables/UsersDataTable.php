<?php

namespace App\DataTables;

use App\Models\User;
use App\Models\Postal;
use App\Traits\RefTrait;
use Yajra\DataTables\Html\{Button,Column};
use Yajra\DataTables\Html\Editor\{Editor,Fields};
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
			->editColumn('user_status',function($usercuschk1){
				if($usercuschk->user_status == 'สมัครใหม่'){
					return '<span class="badge badge-warning">สมัครใหม่</span>';
				}
				elseif($usercuschk->user_status == 'อนุญาต'){
					return '<span class="badge badge-success text-dark">อนุญาต</span>';
				}
				elseif($usercuschk->user_status == 'ปิด'){
					return '<span class="badge badge-secondary">ปิด</span>';
				}
				elseif($usercuschk->user_status == 'ไม่อนุญาต'){
					return '<span class="badge badge-danger">ไม่อนุญาต</span>';
				}
			})
			->addColumn('action', '<button type="button" class="office-manage-nav btn btn-sm btn-info" data-id="{{$id}}">จัดการ <i class="fal fa-angle-down"></i> </button>')
			->rawColumns(['user_status','action']);
	}

	public function query() {
		$userCus = User::with('userCustomer')
			->select('*')
			->where('user_type','customer');

		// $userCus = User::find(5);
		// $userCus = $userCus->userCustomer()
		// 	->with('userCus')
		// 	->join('users','users.id','=','users_customer_detail.user_id1')
		// 	->get();
		//dd($userCus);
		return $userCus;
	}


	public function html(): object {
		return $this->builder()
					->setTableId('usercustomer-table')
					->columns($this->getColumns())
					->minifiedAjax()
					->dom('Bfrtip')
					->orderBy(1);
	}

	protected function getColumns() {
		return [
			// Column::computed('action')
			//       ->exportable(false)
			//       ->printable(false)
			//       ->width(60)
			//       ->addClass('text-center'),
			Column::make('id')->title('ลำดับ'),
			Column::make('username')->title('username'),
			Column::make('ref_office_lab_code')->title('รหัสหน่วยงาน'),
			Column::make('ref_office_env_code')->title('รหัสหน่วยงาน(env)'),
			Column::make('office_name')->title('ชื่อหน่วยงาน'),
			Column::make('first_name')->title('ชื่อ'),
			Column::make('last_name')->title('นามสกลุ'),
			Column::make('user_status')->title('สถานะ'),
			Column::make('action')->title('จัดการ'),
			// Column::make('created_at'),
			// Column::make('updated_at'),
		];
	}

	protected function filename() {
		return 'Office_' . date('YmdHis');
	}
}
