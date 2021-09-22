<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,Log,Storage,File};
use App\Models\{Order,OrderDetail,Fileupload};
use App\DataTables\{CustomersDataTable,CustParameterDataTable};
use App\Traits\CommonTrait as TraitsCommonTrait;
use App\Traits\{CustomerTrait,FileTrait,CommonTrait};

class CustomerController extends Controller
{
	use CustomerTrait, FileTrait, CommonTrait;

	protected function index(CustomersDataTable $dataTable): object {
		return $dataTable->render('apps.customers.index');
	}
	protected function createInfo(): object {
		$type_of_work = $this->typeOfWork();
		return view('apps.customers.info', [
			'type_of_work' => $type_of_work
		]);
	}
	protected function storeInfo(Request $request) {
		try {
			$user = Auth::user();
			if ($request->hasFile('book_file')) {
				$file = $request->file('book_file');
				$file_mime = $file->getMimeType();
				$file_size_byte = $file->getSize();
				$file_size = ($file_size_byte/1024);
				$file_extension = $file->extension();
				$new_name = $this->renameFile('cust_book', $user->userCustomer->user->id, $file_extension);
				$uploaded = Storage::disk('uploads')->put($new_name, File::get($file));
				if ($uploaded) {
					$file_upload = new FileUpload;
					$file_upload->file_name = $new_name;
					$file_upload->file_mime = $file_mime;
					$file_upload->file_path = '/uploads';
					$file_upload->file_size = $file_size;
					$file_upload->ref_user_id = auth()->user()->id;
					$file_upload->note = 'หนังสือนำส่ง';
					$file_upload->save();
					$last_file_upload_insert_id = $file_upload->id;

					$order = new Order;
					$order->ref_user_id = $user->userCustomer->user->id;
					$order->order_status = 'pending';
					$order->payment_status = 'pending';
					$order->ref_office_id = $user->userCustomer->office_code;
					$order->ref_office_name = $user->userCustomer->office_name;
					$order->type_of_work = $request->type_of_work;
					$order->type_of_work_other = $request->type_of_work_other;
					$order->book_no = $request->book_no;
					$order->book_date = $this->convertJsDateToMySQL($request->book_date);
					$order->ref_book_file_id = $last_file_upload_insert_id;
					$order->save();
                    $last_idx_id = $order->id;
					Log::notice($user->userCustomer->user->first_name.' อับโหลดไฟล์หนังสือนำส่ง '.$new_name);
					return redirect()
						->back()
						->with('action_notic', $user->userCustomer->user->first_name.' อับโหลดไฟล์หนังสือนำส่ง')
						->with('success', 'บันทึกร่างข้อมูลทั่วไปสำเร็จ')
                        ->with('idx', $last_idx_id);
				} else {
					Log::warning($user->userCustomer->user->first_name.' อับโหลดไฟล์หนังสือนำส่งไม่สำเร็จ');
					return redirect()->back()->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
				}
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
