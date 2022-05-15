<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,Log};
use App\Models\Order,User;
use Yajra\DataTables\Facades\DataTables;

class StaffHomeController extends Controller
{
	private object $user;
	private string $user_role;

	public function __construct() {
		$this->middleware('auth');
		$this->middleware(['role:root|admin|staff']);
		$this->middleware('is_order_confirmed');
		$this->middleware(function($request, $next) {
			$this->user = Auth::user();
			$user_role_arr = $this->user->roles->pluck('name')->all();
			$this->user_role = $user_role_arr[0];
			return $next($request);
		});
	}

	public function index(): object {
		return view(view: 'apps.staff.index');
	}

	public function getInbox() {
		try {
			return Datatables::of(Order::query())->make(true);
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function inbox() {
		$x = $this->user->load(['userStaff'])->toArray();
		return view('apps.staff.inbox');
	}

	public function calendar() {
		return view('apps.staff.calendar');
	}
}
