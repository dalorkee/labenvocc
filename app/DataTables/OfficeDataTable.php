<?php

namespace App\DataTables;

use App\Models\{User,UserCustomer};
use App\Models\Postal;
use App\Traits\CommonTrait;
use Yajra\DataTables\Html\{Button,Column};
use Yajra\DataTables\Html\Editor\{Editor,Fields};
use Yajra\DataTables\Services\DataTable;

class OfficeDataTable extends DataTable
{
	use CommonTrait;

	public function dataTable($query): object {
		$positions = $this->getPosition();
        $position_levels = $this->getPositionLevel();
        $duties = $this->getStaffDuty();
		return datatables()
			->eloquent($query)
			->addColumn('first_name', function($query) {
				return $query->userStaff->first_name ?? '';
			})
			->addColumn('last_name', function($query) {
				return $query->userStaff->last_name ?? '';
			})
			->addColumn('position', function($query) use ($positions) {
				return (!empty($query->userStaff->position)) ? $positions[$query->userStaff->position] : '';
			})
			->addColumn('position_level', function($query) use ($position_levels) {
				return (!empty($query->userStaff->position_level)) ? $position_levels[$query->userStaff->position_level] : '';
			})
			->addColumn('duty', function($query) use ($duties) {
				return (!empty($query->userStaff->duty)) ? $duties[$query->userStaff->duty] : '';
			})
			->editColumn('user_status',function($userstaffchk){
				if($userstaffchk->user_status == 'สมัครใหม่'){
					return '<span class="badge badge-warning">สมัครใหม่</span>';
				}
				elseif($userstaffchk->user_status == 'อนุญาต'){
					return '<span class="badge badge-success text-dark">อนุญาต</span>';
				}
				elseif($userstaffchk->user_status == 'ไม่อนุญาต'){
					return '<span class="badge badge-danger">ไม่อนุญาต</span>';
				}
                else{
                    return '<span></span>';
                }
			})
			->addColumn('action', '<button type="button" class="userstaff-manage-nav btn btn-sm btn-info" data-id="{{$id}}">จัดการ<i class="fal fa-angle-down"></i> </button>')
			->rawColumns(['user_status','action']);
	}

	public function query(User $user) {
		$user_staff = $user->whereUser_type('staff')->with('userStaff')->orderBy('id', 'ASC');
        return $user_staff;
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
			Column::make('username')->title('ชื่อผู้ใช้'),
			Column::make('first_name')->title('ชื่อ'),
			Column::make('last_name')->title('นามสกุล'),
			Column::make('user_status')->title('สถานะ'),
			Column::make('position')->title('ตำแหน่ง'),
			Column::make('position_level')->title('ระดับ'),
			Column::make('duty')->title('หน้าที่'),
			Column::make('action')->title('จัดการ'),
		];
	}

	protected function filename() {
		return 'UserStaff_' . date('YmdHis');
	}
}
