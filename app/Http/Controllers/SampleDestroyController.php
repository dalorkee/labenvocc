<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,Log};
use App\DataTables\destroy\listOrderDataTable;
use App\Models\Order;
// use Yajra\DataTables\Facades\DataTables;

class SampleDestroyController extends Controller
{
	private object $user;
	private string $user_role;

	public function __construct() {
		$this->middleware('auth');
		$this->middleware(['role:root|admin|customer|staff']);
		// $this->middleware('is_order_confirmed');
		$this->middleware(function($request, $next) {
			$this->user = Auth::user();
			$user_role_arr = $this->user->roles->pluck('name')->all();
			$this->user_role = $user_role_arr[0];
			return $next($request);
		});
	}

	protected function index() {
		//
	}

	protected function create(listOrderDataTable $dataTable): object {
		return $dataTable?->render(view: 'apps.staff.destroy.create');
	}

	protected function store(Request $request) {
		try {
			$lab_no_arr = $request->toArray();
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}

	}


}
