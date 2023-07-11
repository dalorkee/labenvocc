<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\{Auth,Log};
use App\DataTables\destroy\{OrderDataTable,ApproveOrderDataTable};
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

	protected function showOrder(OrderDataTable $dataTable): ?object {
		return $dataTable?->render(view: 'apps.staff.destroy.order-show');
	}

	protected function approveOrder(ApproveOrderDataTable $dataTable): ?object {
		return $dataTable?->render(view: 'apps.staff.destroy.order-approve');
	}

	protected function approveOrderStore(Request $request, Order $order): ?object {
		try {
			if (isset($request->lab_no) && count($request->lab_no) > 0) {
				$order->whereIn('lab_no', $request->lab_no)->update(['order_destroy_status' => 'approved', 'order_destroy_date' => date('Y-m-d')]);
				return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จแล้ว');
			}
			return redirect()->back()->with('warning', 'Warning! บันทึกไม่สำเร็จ โปรดตรวจสอบความถูกต้อง');
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with('error', $e->getMessage());
		}
	}




}
