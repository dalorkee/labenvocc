<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,Log};
use Yajra\DataTables\Facades\DataTables;
use App\Models\{Order,Position};
use App\Traits\CommonTrait;
use Carbon\Traits\Comparison;

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

	public function index(): object {
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

	public function getInbox() {
		try {
			return Datatables::of(Order::query())->make(true);
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function inbox() {
		return view('apps.staff.inbox');
	}

	public function calendar() {
		return view('apps.staff.calendar');
	}
}
