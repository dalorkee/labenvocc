<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\{Auth,Log};
use App\DataTables\destroy\{ApproveOrderDataTable,DestroyOrderDataTable};
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

	protected function showApproveOrder(ApproveOrderDataTable $dataTable): ?object {
		return $dataTable?->render(view: 'apps.staff.destroy.order-approve');
	}

	protected function storeApproveOrder(Request $request): ?object {
		try {
			if (!empty($request->approve_order) && count($request->approve_order) > 0) {
				foreach ($request->approve_order as $key => $value) {
					$order = Order::findOr($value, fn () => throw new \Exception('[Approve:อนุมัติทำลายตัวอย่าง] ไม่พบข้อมูลรหัส: '.$value));
					$order->destroy_approve_status = 'y';
					$order->save();
				}
				return redirect()->back()->with(key: 'success', value: 'บันทึกข้อมูลสำเร็จแล้ว');
			} else {
				return redirect()->back()->with(key: 'warning', value: 'ไม่พบข้อมูลที่ต้องการ Approve โปรดตรวจสอบ');
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with(key: 'error', value: $e->getMessage());
		}
	}

	protected function showDestroyOrder(DestroyOrderDataTable $dataTable): ?object {
		return $dataTable?->render(view: 'apps.staff.destroy.order-show');
	}

	protected function storeDestroyOrder(Request $request): ?object {
		try {
			if (!empty($request->destroy_order) && count($request->destroy_order) > 0) {
				foreach ($request->destroy_order as $key => $value) {
					$order = Order::findOr($value, fn () => throw new \Exception('[Approve:ทำลายตัวอย่าง] ไม่พบข้อมูลรหัส: '.$value));
					$order->order_status = 'destroyed';
					$order->destroy_date = date('d/m/Y');
					$order->save();
				}
				return redirect()->back()->with(key: 'success', value: 'บันทึกข้อมูลสำเร็จแล้ว');
			} else {
				return redirect()->back()->with(key: 'warning', value: 'ไม่สามารถบันทึกข้อมูลได้ โปรดตรวจสอบความถูกต้อง');
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return redirect()->back()->with(key: 'error', value: $e->getMessage());
		}
	}

}
