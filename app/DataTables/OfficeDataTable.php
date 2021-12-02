<?php

namespace App\DataTables;

use App\Models\{User,UserCustomer};
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
			 ->addColumn('first_name', function($query) {
			 	return $query->userStaff->first_name;
			})
			// ->addColumn('last_name', function($query) {
			// 	return $query->userStaff->last_name;
			// })
			// ->addColumn('position', function($query) {
			// 	return $query->userStaff->position;
			// })
			// ->addColumn('position_level', function($query) {
			// 	return $query->userStaff->position_level;
			// })
			// ->addColumn('duty', function($query) {
			// 	return $query->userStaff->duty;
			// })
			->editColumn('user_status',function($userstaffchk){
				if($userstaffchk->user_status == 'สมัครใหม่'){
					return '<span class="badge badge-warning">สมัครใหม่</span>';
				}
				elseif($userstaffchk->user_status == 'อนุญาต'){
					return '<span class="badge badge-success text-dark">อนุญาต</span>';
				}
				elseif($userstaffchk->user_status == 'ปิด'){
					return '<span class="badge badge-secondary">ปิด</span>';
				}
				elseif($userstaffchk->user_status == 'ไม่อนุญาต'){
					return '<span class="badge badge-danger">ไม่อนุญาต</span>';
				}
			})
			->addColumn('action', '<button type="button" class="userstaff-manage-nav btn btn-sm btn-info" data-id="{{$id}}">จัดการ<i class="fal fa-angle-down"></i> </button>')
			->rawColumns(['user_status','action']);
	}

	public function query(User $user) {

		$userStaff = $user->whereUser_type('staff')->with('userStaff')->orderBy('id', 'ASC');
		//dd($userStaff);
		return $userStaff;
	}


	public function html(): object {

		return $this->builder()
					->setTableId('userstaff-table')
					->columns($this->getColumns())
					->minifiedAjax()
					->dom('frtip')
					->orderBy(1);
	}

	protected function getColumns() {
		return [
			Column::make('id')->title('ลำดับ'),
			Column::make('username')->title('username'),
			Column::make('first_name')->title('ชื่อ'),
			// Column::make('last_name')->title('นามสกุล'),
			Column::make('user_status')->title('สถานะ'),
			// Column::make('position')->title('ตำแหน่ง'),
			// Column::make('position_level')->title('ระดับ'),
			// Column::make('duty')->title('หน้าที่'),
			Column::make('action')->title('จัดการ'),
		];
	}

	protected function filename() {
		return 'UserStaff_' . date('YmdHis');
	}
}
