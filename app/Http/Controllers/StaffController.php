<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,Log};
// use App\DataTables\InboxesDataTable;
use App\Traits\{CommonTrait, ColorTrait};
use App\Models\{Order,Calendar};

class StaffController extends Controller
{
	private object $user;
	private string $user_role;
	private array $inbox_data;
	private object $order;
	private int $count_order;

	use CommonTrait, ColorTrait;

	public function __construct() {
		$this->middleware('auth');
		$this->middleware(['role:root|admin|staff']);
		$this->middleware(function($request, $next) {
			$this->user = Auth::user();
			$user_role_arr = $this->user->roles->pluck('name')->all();
			$this->user_role = $user_role_arr[0];
			$this->inbox_data = [];
			$this->order = new Order();
			$this->getNewOrder($this->order);
			$this->getNewOrderReceived($this->order);
			$this->getRejectOrder($this->order);
			$this->getOverdueOrder($this->order);
			$this->count_order = count($this->inbox_data);
			return $next($request);
		});
	}

	private function getNewOrder($order): void {
		$new_order = $order?->select('id', 'order_no', 'lab_no')
			?->where('order_status', '=', 'pending')
			?->whereNotIn('order_receive_status', ['received', 'rejected'])
			?->withCount('parameters')
			?->get();
		foreach ($new_order as $key => $value) {
			array_push(
				$this->inbox_data,
				"<span class=\"text-danger\"><i class=\"fa fa-circle\"></i></span> งานใหม่ Lab NO. ".$value->lab_no." จำนวน ".number_format($value->parameters_count)." test"
			);
		}
	}

	private function getNewOrderReceived($order): void {
		$new_order_received = $order?->select('id', 'order_no', 'lab_no')
			?->where('order_status', '=', 'pending')
			?->where('order_receive_status', '=', 'received')
			?->withCount('parameters')
			?->get();
		foreach ($new_order_received as $key => $value) {
			array_push(
				$this->inbox_data,
				"<span class=\"text-success\"><i class=\"fa fa-circle\"></i></span> งานใหม่ Lab NO. ".$value->lab_no." จำนวน ".number_format($value->parameters_count)." test"
			);
		}
	}

	private function getRejectOrder($order): void {
		$reject_order = $order?->select('id', 'order_no', 'lab_no')
			?->where('order_receive_status', '=', 'rejected')
			?->get();
		foreach ($reject_order as $key => $value) {
			array_push(
				$this->inbox_data,
				"<span class=\"text-danger\"><i class=\"fa fa-circle\"></i></span> งานถูก Reject Lab NO. ".$value->lab_no
			);
		}
	}

	private function getOverdueOrder($order): void {
		$today = date('Y-m-d');
		$overdue_order = $order?->select('id', 'order_no', 'lab_no', 'report_due_date')
			?->where('report_due_date', '<', $today)
			?->get();
		foreach ($overdue_order as $key => $value) {
			array_push(
				$this->inbox_data,
				"<span class=\"text-danger\"><i class=\"fa fa-circle\"></i></span> งานเกินกำหนดส่ง Lab NO. ".$value->lab_no
			);
		}
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
		$total = $this->count_order;
		return view(view: 'apps.staff.index', data: compact('data', 'total'));
	}

	protected function inbox(): ?object {
		$data = $this->inbox_data;
		$total = $this->count_order;
		return view(view: 'apps.staff.inbox', data: compact('data', 'total'));
	}

	protected function calendar() {
		$calendar = Calendar::Where('user_id', '=', $this->user->id)->get();
		$color = $this->colorClass();
		$total = $this->count_order;
		return view(view: 'apps.staff.calendar', data: compact('calendar', 'color', 'total'));
	}
}
