<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,Log,Storage,File};
use Spatie\Permission\Models\{Role,Permission};
use App\Models\{Order,OrderDetail,Fileupload};
use App\DataTables\{CustomersDataTable,CustParameterDataTable};
use App\Traits\CommonTrait as TraitsCommonTrait;
use App\Traits\{CustomerTrait,FileTrait,CommonTrait};
use Illuminate\Routing\Redirector;

class CustomerController extends Controller
{
	private object $user;
	private string $user_role;

	public function __construct() {
		$this->middleware('auth');
		$this->middleware(['role:root|admin|customer']);
		$this->middleware(function($request, $next) {
			$this->user = Auth::user();
			$user_role_arr = $this->user->roles->pluck('name')->all();
			$this->user_role = $user_role_arr[0];
			return $next($request);
		});
	}

	use CustomerTrait, FileTrait, CommonTrait;

	protected function index(CustomersDataTable $dataTable): object {
		return $dataTable->render('apps.customers.index');
	}
	protected function createInfo(Request $request): object {
		$type_of_work = $this->typeOfWork();
		if ($request->id == 'new') {
			$order = null;
		} else {
			$order = Order::whereId($request->id)->get();
            dd($order->upload->file_name);
			//$file_name = FileUpload::find($request->id)->get();
			//dd($file_name);
		}
		return view('apps.customers.info', [
			'type_of_work' => $type_of_work,
			'order' => $order
		]);
	}
	protected function storeInfo(Request $request) {
		try {
			$order = new Order;
			$order->ref_user_id = $this->user->userCustomer->user->id;
			$order->order_status = 'pending';
			$order->payment_status = 'pending';
			$order->ref_office_id = $this->user->userCustomer->office_code;
			$order->ref_office_name = $this->user->userCustomer->office_name;
			$order->type_of_work = $request->type_of_work;
			$order->type_of_work_other = $request->type_of_work_other;
			$order->book_no = $request->book_no;
			$order->book_date = $this->convertJsDateToMySQL($request->book_date);
			$order->book_upload = ($request->hasFile('book_file')) ? 'y' : 'n';
			$order_saved = $order->save();
			$last_insert_order_id = $order->id;

			if ($request->hasFile('book_file')) {
				$file = $request->file('book_file');
				$file_mime = $file->getMimeType();
				$file_size_byte = $file->getSize();
				$file_size = ($file_size_byte/1024);
				$file_name = $file->getClientOriginalName();
				$file_extension = $file->extension();
				$new_name = $this->renameFile('cust_book', $this->user->userCustomer->user->id, $file_extension);
				$uploaded = Storage::disk('uploads')->put($new_name, File::get($file));
				if ($uploaded) {
					$file_upload = new FileUpload;
					$file_upload->ref_user_id = $this->user->id;
					$file_upload->order_id = $last_insert_order_id;
					$file_upload->old_file_name = $file_name;
					$file_upload->file_name = $new_name;
					$file_upload->file_mime = $file_mime;
					$file_upload->file_path = '/uploads';
					$file_upload->file_size = $file_size;
					$file_upload->note = 'หนังสือนำส่ง';
					$file_upload->save();
					Log::notice($this->user->userCustomer->user->first_name.' อับโหลดไฟล์หนังสือนำส่ง '.$new_name);
				} else {
					Log::warning($this->user->userCustomer->user->first_name.' อับโหลดไฟล์หนังสือนำส่งไม่สำเร็จ');
				}
			}
			if ($order_saved == true) {
				return redirect()->route('customer.info', ['id' => $last_insert_order_id])->with(['success' => 'บันทึกร่าง [ข้อมูลทั่วไป] สำเร็จ']);
			} else {
				return redirect()->back()->with('error', 'บันทึกร่าง [ข้อมูลทั่วไป] ไม่สำเร็จ');
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function createParameter(CustParameterDataTable $dataTable): object {
		return $dataTable->render('apps.customers.parameter');
	}
	protected function storeParameterPersonalInfo(Request $request) {
		// return redirect()->back()->with('action_alert', 'บันทึกข้อมูลผู้ใช้สำเร็จแล้ว');
		// exit;
		$request->validate([
			'id_card'=>'bail|required',
		],[
			'id_card.required'=>'โปรดกรอกเลขบัตรประชาชน',
		]);
		try {
			$orderDetail = new OrderDetail;
			$orderDetail->id_card = $request->id_card;

			$saved = $orderDetail->save();
			$last_insert_id = $orderDetail->id;
			if ($saved == true) {
				return redirect()->back()->with('success', 'บันทึกร่างข้อมูลทั่วไปสำเร็จ');
			} else {
				return redirect()->back()->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}
}
