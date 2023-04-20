<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Log};
use App\DataTables\analyze\listOrderDataTable;
use App\Models\{Order,OrderSample};
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

	protected function create(listOrderDataTable $dataTable): object {
		return $dataTable->with('user_id', $this->user->id)->render(view: 'apps.staff.analyze.create');
	}

	protected function selectSample(Request $request) {
		$req_data = [
			'lab_no' => $request->lab_no,
			'order_id' => $request->order_id,
			'user_id' => $request->user_id,
		];
		$data = [];
		$result = OrderSample::with(['parameters' => function($query) use ($request) {
			$query->where('main_analys_user_id', '=', $request->user_id);
		}])->whereOrder_id($request->id)->get();

		$result->each(function($item, $key) use (&$data) {
			if (count($item->parameters) > 0) {
				array_push($data, $item);
			}
		});
        // dd($data);
		return view(view: 'apps.staff.analyze.select', data: compact('req_data', 'data'));
	}

	protected function sampleReserve(Request $request) {
		dd($request->paramet_id);
	}

}
