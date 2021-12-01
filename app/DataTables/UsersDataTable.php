<?php

namespace App\DataTables;

use App\Models\{User,UserCustomer};
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
			->addColumn('ref_office_lab_code', function($query) {
				return $query->userCustomer->ref_office_lab_code;
			})
			->editColumn('user_status',function($usercuschk) {
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
			->addColumn('action', '<button type="button" class="usercus-manage-nav btn btn-sm btn-info" data-id="{{$id}}">จัดการ <i class="fal fa-angle-down"></i></button>')
			->rawColumns(['user_status','action']);
	}

	public function query(User $user) {
		// $userCus = User::join('users_customer_detail','users.id','=','users_customer_detail.user_id')->where('users.user_type','customer');

		// $userCus = $userCus->userCustomer()
		// 	->with('userCus')
		// 	->join('users','users.id','=','users_customer_detail.user_id1')
		// 	->get();
		// dd($userCus);
		$userCus = $user->whereUser_type('customer')->with('userCustomer')->select('*')->orderBy('id', 'ASC');
		return $userCus;
	}


	public function html(): object {
		return $this->builder()
					->setTableId('usercustomer-table')
					->columns($this->getColumns())
					->minifiedAjax()
					->dom('frtip')
					->orderBy(1);
	}

	protected function getColumns() {
		return [
			Column::make('id')->title('ลำดับ'),
			Column::make('username')->title('username'),
			Column::make('ref_office_lab_code')->title('รหัสหน่วยงาน'),
			// Column::make('ref_office_env_code')->title('รหัสหน่วยงาน(env)'),
			// Column::make('office_name')->title('ชื่อหน่วยงาน'),
			// Column::make('first_name')->title('ชื่อ'),
			// Column::make('last_name')->title('นามสกุล'),
			Column::make('user_status')->title('สถานะ'),
			Column::make('action')->title('จัดการ'),
		];
	}

	protected function filename() {
		return 'UserCus_' . date('YmdHis');
	}
}
