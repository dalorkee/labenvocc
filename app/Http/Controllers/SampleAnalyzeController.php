<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Log};
use App\DataTables\analyze\listOrderDataTable;
// use App\Models\{Order,OrderSample};
// use Yajra\DataTables\Facades\DataTables;

class SampleAnalyzeController extends Controller
{
	private object $user;
	private string $user_role;

	public function __construct() {
		$this->middleware('auth');
		$this->middleware(['role:root|admin|customer|staff']);
		$this->middleware('is_order_confirmed');
		$this->middleware(function($request, $next) {
			$this->user = Auth::user();
			$user_role_arr = $this->user->roles->pluck('name')->all();
			$this->user_role = $user_role_arr[0];
			return $next($request);
		});
	}

	protected function create(listOrderDataTable $dataTable, $user_id=0): object {
		return $dataTable->with('user_id', $this->user->id)->render(view: 'apps.staff.analyze.create');
	}

    protected function sampleReserve(Request $request) {
        dd($request->paramet_id);
    }

}
