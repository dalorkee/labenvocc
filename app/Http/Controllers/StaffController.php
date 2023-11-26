<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,Log};
use App\DataTables\InboxesDataTable;
use App\Traits\CommonTrait;
use App\Models\{Order,Calendar};

class StaffController extends Controller
{
	private object $user;
	private string $user_role;

	use CommonTrait;

	public function __construct() {
		$this->middleware('auth');
		$this->middleware(['role:root|admin|staff']);
		$this->middleware(function($request, $next) {
			$this->user = Auth::user();
			$user_role_arr = $this->user->roles->pluck('name')->all();
			$this->user_role = $user_role_arr[0];
			return $next($request);
		});
	}

	protected function index(): object {
		$affiliation = $this->affiliation();
		$data = [
			'first_name' => Auth::user()->userStaff->first_name ,
			'last_name' => Auth::user()->userStaff->last_name,
			'position' => $this->getPositionById(Auth::user()->userStaff->position),
			'affiliation' => $affiliation[Auth::user()->userStaff->affiliation],
			'duty' => $this->getStaffDutyById(Auth::user()->userStaff->duty),
		];
		return view(view: 'apps.staff.index', data: compact('data'));
	}

	protected function inbox(Order $order): ?object {
		$data = [];
		$new = $order->select('id', 'order_no', 'lab_no')
			->where('order_status', '=', 'pending')
			->whereNotIn('order_receive_status', ['received', 'rejected'])
			->withCount('parameters')
			->get();
		foreach ($new as $key => $value) {
			array_push($data, "<span class=\"text-danger\"><i class=\"fa fa-circle\"></i></span> งานใหม่ Lab NO. ".$value->lab_no." จำนวน ".number_format($value->parameters_count)." test");
		}

		$new_received = $order->select('id', 'order_no', 'lab_no')
			->where('order_status', '=', 'pending')
			->where('order_receive_status', '=', 'received')
			->withCount('parameters')
			->get();
		foreach ($new_received as $key => $value) {
			array_push($data, "<span class=\"text-success\"><i class=\"fa fa-circle\"></i></span> งานใหม่ Lab NO. ".$value->lab_no." จำนวน ".number_format($value->parameters_count)." test");
		}

		$reject = $order->select('id', 'order_no', 'lab_no')
			->where('order_receive_status', '=', 'rejected')
			->get();
		foreach ($reject as $key => $value) {
			array_push($data, "<span class=\"text-danger\"><i class=\"fa fa-circle\"></i></span> งานถูก Reject Lab NO. ".$value->lab_no);
		}

		$today = date('Y-m-d');
		$overdue = $order->select('id', 'order_no', 'lab_no', 'report_due_date')
		->where('report_due_date', '<', $today)
		->get();
		foreach ($reject as $key => $value) {
			array_push($data, "<span class=\"text-danger\"><i class=\"fa fa-circle\"></i></span> งานเกินกำหนดส่ง Lab NO. ".$value->lab_no);
		}
		$total = count($data);
		return view(view: 'apps.staff.inbox', data: compact('data', 'total'));
	}

	protected function calendar() {
		$calendar = Calendar::Where('user_id', '=', $this->user->id)->get();
		return view(view: 'apps.staff.calendar', data: compact('calendar'));
	}
}
