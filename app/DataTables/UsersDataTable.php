<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use App\Models\User;

class UsersDataTable extends DataTable
{
	public function dataTable($query): object {
		return datatables()
			->eloquent($query)
			->addColumn('ref_office_lab_code', fn ($user) => $user->userCustomer->ref_office_lab_code)
			->addColumn('ref_office_env_code', fn ($user) => $user->userCustomer->ref_office_env_code)
			->addColumn('agency_name', fn ($user) => $user->userCustomer->agency_name)
			->addColumn('first_name', fn ($user) => $user->userCustomer->first_name)
			->addColumn('last_name', fn ($user) => $user->userCustomer->last_name)
			->editColumn('user_status', function($user_chk) {
				$htm = match($user_chk->user_status) {
					'สมัครใหม่' => '<span class="badge badge-warning">สมัครใหม่</span>',
					'อนุญาต' => '<span class="badge badge-success text-white">อนุญาต</span>',
					'ไม่อนุญาต' => '<span class="badge badge-danger">ไม่อนุญาต</span>',
				};
				return $htm;
			})
			->addColumn('action', '<button type="button" class="usercus-manage-nav btn btn-sm btn-info" data-id="{{$id}}">จัดการ <i class="fal fa-angle-down"></i></button>')
			->rawColumns(['user_status','action']);
	}

	public function query(User $user): ?object {
		return $user?->whereUser_type('customer')?->with('userCustomer')?->orderBy('id', 'ASC');
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
			Column::make('username')->title('ชื่อผู้ใช้'),
			Column::make('ref_office_lab_code')->title('รหัสหน่วยงาน'),
			Column::make('ref_office_env_code')->title('รหัสหน่วยงาน (ENV)'),
			Column::make('agency_name')->title('ชื่อหน่วยงาน'),
			Column::make('first_name')->title('ชื่อ'),
			Column::make('last_name')->title('นามสกุล'),
			Column::make('user_status')->title('สถานะ'),
			Column::make('action')->title('จัดการ'),
		];
	}

	protected function filename() {
		return 'UserCus_' . date('YmdHis');
	}
}
