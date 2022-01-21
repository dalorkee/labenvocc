<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Hash,Log};
use App\Models\{User,UserCustomer};
use App\Traits\{CommonTrait,JsonBoundaryTrait,DbBoundaryTrait,DbHospitalTrait};
use Kineticamobile\Lumki\Controllers\UserController;

class RegisterController extends Controller
{
	use CommonTrait, JsonBoundaryTrait, DbBoundaryTrait, DbHospitalTrait;

	public function index(Request $request): object {
		if ($request->session()->has('userLoginData'))  $request->session()->forget('userLoginData');
		if ($request->session()->has('userData')) $request->session()->forget('userData');
		return view('auth.register.index');
	}

	protected function createPersonalStep2Get(Request $request): object {
		$userData = $request->session()->get('userData');
		$provinces = $this->getMinProvince();
		$districts = $this->getMinDistrict();
		$sub_districts = $this->getMinSubDistrict();
		return view('auth.register.personalStep2', compact('userData', 'provinces', 'districts', 'sub_districts'));
	}

	protected function createPersonalStep2Post(Request $request): object {
		$validatedData = $request->validate([
			'title_name' => 'required|max:20',
			'first_name' => 'required|max:200',
			'last_name' => 'required|max:200',
			'id_card' => 'required|numeric|digits_between:1,13',
			'taxpayer_no' => 'nullable',
			'email' => 'required|unique:users_customer_detail,email',
			'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
			'address' => 'required',
			'province' => 'required',
			'district' => 'required',
			'sub_district' => 'required',
			'postcode' => 'required'
		]);
		if (empty($request->session()->get('userData'))) {
			$userData = new UserCustomer();
			$userData->fill($validatedData);
			$request->session()->put('userData', $userData);
		} else {
			$userData = $request->session()->get('userData');
			$userData->fill($validatedData);
			$request->session()->put('userData', $userData);
		}
		return redirect()->route('register.personal.step3.get');
	}

	protected function createPersonalStep3Get(Request $request): object {
		if ($request->session()->has('userData')) {
			$userData = $request->session()->get('userData');
			$provinces = $this->getMinProvince();
			$districts = $this->getMinDistrict();
			$sub_districts = $this->getMinSubDistrict();
			return view('auth.register.personalStep3', compact('userData', 'provinces', 'districts', 'sub_districts'));
		} else {
			return redirect()->route('register.index');
		}
	}

	protected function createPersonalStep3Post(Request $request): object {
		$validatedData = $request->validate([
			'contact_addr_opt' => 'bail|required',
			'contact_title_name' => 'required_if:contact_addr_opt,==,2',
			'contact_first_name' => 'required_if:contact_addr_opt,==,2',
			'contact_last_name' => 'required_if:contact_addr_opt,==,2',
			'contact_mobile' => 'required_if:contact_addr_opt,==,2|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
			'contact_email' => 'required_if:contact_addr_opt,==,2|unique:users_customer_detail,contact_email',
			'contact_addr' => 'required_if:contact_addr_opt,==,2',
			'contact_province' => 'required_if:contact_addr_opt,==,2',
			'contact_district' => 'required_if:contact_addr_opt,==,2',
			'contact_sub_district' => 'required_if:contact_addr_opt,==,2',
			'contact_postcode' => 'required_if:contact_addr_opt,==,2'
		]);
		$userData = $request->session()->get('userData');
		if ($request->contact_addr_opt == '1') {
			$userData->fill([
				'contact_addr_opt' => $request->contact_addr_opt,
				'contact_title_name' => $userData->title_name,
				'contact_first_name' => $userData->first_name,
				'contact_last_name' => $userData->last_name,
				'contact_mobile' => $userData->mobile,
				'contact_email' => $userData->email,
				'contact_addr' => $userData->address,
				'contact_province' => $userData->province,
				'contact_district' => $userData->district,
				'contact_sub_district' => $userData->sub_district,
				'contact_postcode' => $userData->postcode,
			]);
		} else {
			$userData->fill($validatedData);
		}
		$request->session()->put('userData', $userData);
		return redirect()->route('register.personal.step4.get');
	}

	protected function createpersonalStep4Get(Request $request): object {
		$userData = $request->session()->get('userData');
		$userLoginData = $request->session()->get('userLoginData');
		return view('auth.register.personalStep4', compact('userData', 'userLoginData'));
	}

	protected function createPersonalStep4Post(Request $request): object {
		$validatedLoginData = $request->validate([
			'username' => 'required',
			'email' => 'required',
			'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
			'password_confirmation' => 'required'
		]);
		$userLoginData = ($request->session()->missing('userLoginData')) ?  new User() : $request->session()->get('userLoginData');
		$userLoginData->fill($validatedLoginData);
		$request->session()->put('userLoginData', $userLoginData);
		 return redirect()->route('register.personal.step5.get');
	}

	protected function createPersonalStep5Get(Request $request) {
		$userData = $request->session()->get('userData');
		$userLoginData = $request->session()->get('userLoginData');
		$titleName = $this->titleName();
		$provinces = $this->getMinProvince();
		$districts = $this->getMinDistrict();
		$sub_districts = $this->getMinSubDistrict();
		return view('auth.register.personalStep5', compact('userData', 'userLoginData', 'titleName', 'provinces', 'districts', 'sub_districts'));
	}

	protected function createPersonalStep5Post(Request $request) {
		$validated = $request->validate([
			'captcha'=>'bail|required|captcha'
		],[
			'captcha.required' => 'โปรดกรอก รหัส Captcha',
		]);
		$userLoginData = $request->session()->get('userLoginData');
		$userLoginData->fill([
			'user_type' => 'customer',
			'user_status' => 'สมัครใหม่',
			'approved' => 'n'
		]);

		$userData = $request->session()->get('userData');
		$userData->fill([
			'ref_office_lab_code' => '114114',
			'ref_office_env_code' => '87787'
		]);

		$userLoginDataSaved = $userLoginData->save();
		$userDataSaved = $userData->save();

		$request->session()->forget('userLoginData');
		$request->session()->forget('userData');

		if ($userLoginDataSaved == true && $userDataSaved == true) {
			return redirect()->route('login')->with('success', 'ลงทะเบียนสำเร็จแล้ว โปรดรอผลการพิจารณาใช้ระบบฯ');
		} else {
			return redirect()->route('login')->with('error', 'ไม่สามารถลงทะเบียนได้สำเร็จ โปรดตรวจสอบ');
		}

	}

	protected function create(): object {
		$agency_type = $this->agencyType();
		$provinces = $this->getMinProvince();
		$positions = $this->getPosition();
		return view('auth.register', [
			'agency_type' => $agency_type,
			'provinces' => $provinces,
			'positions' => $positions
		]);
	}

	public function store(Request $request) {
		$request->validate([
			// 'office_category'=>'bail|required',
			// 'office_type'=>'required',
			// 'office_name_establishment'=>'required_if:office_type,1',
			// 'office_code_establishment'=>'required_if:office_type,1',
			// 'health_place_code'=>'required_if:office_type,2',
			// 'border_check_point_code'=>'required_if:office_type,3',
			// 'office_type_other_name'=>'required_if:office_type,4',
			// 'office_type_other_code'=>'required_if:office_type,4',
			// 'office_taxpayer_no'=>'required',
			// 'office_address'=>'required',
			// 'office_province'=>'required',
			// 'office_district'=>'required',
			// 'office_sub_district'=>'required',
			// 'office_postal'=>'required',

			// 'title_name'=>'required',
			// 'first_name'=>'required|min:3|max:50',
			// 'last_name'=>'required|min:3|max:50',
			// 'position'=>'required|min:3|max:50',
			// 'mobile'=>'required',
			// 'service_email'=>'required|email|unique:users_customer_detail,service_email',

			// 'contact_addr_opt'=>'required',
			// 'contact_title_name'=>'required_if:contact_addr_opt,2',
			// 'contact_first_name'=>'required_if:contact_addr_opt,2',
			// 'contact_last_name'=>'required_if:contact_addr_opt,2',
			// 'contact_position'=>'required_if:contact_addr_opt,2',
			// 'contact_mobile'=>'required_if:contact_addr_opt,2',
			// 'contact_email'=>'required_if:contact_addr_opt,2|email|unique:users_customer_detail,contact_email',
			// 'contact_addr'=>'required_if:contact_addr_opt,2',
			// 'contact_province'=>'required_if:contact_addr_opt,2',
			// 'contact_district'=>'required_if:contact_addr_opt,2',
			// 'contact_sub_district'=>'required_if:contact_addr_opt,2',
			// 'contact_postcode'=>'required_if:contact_addr_opt,2',

			// 'username'=>'required',
			// 'username'=>'required|unique:users,username',
			// 'email'=>'required|email|unique:users,email',
			// 'password'=>'required|min:6|confirmed',
			// 'password_confirmation' => 'required|min:6',
			'captcha'=>'required|captcha'
		],[
			// 'office_category.required'=>'โปรดเลือกประเภทหน่วยงาน',
			// 'office_type.required'=>'โปรดเลือกชนิดหน่วยงาน',
			// 'office_name_establishment.required_if'=>'โปรดกรอก ชื่อสถานประกอบการ',
			// 'office_code_establishment.required_if'=>'โปรดกรอก รหัสสถานประกอบการ',
			// 'health_place_code.required_if'=>'โปรดเลือก เลือกสถานพยาบาล',
			// 'border_check_point_code.required_if'=>'โปรดเลือก ด่านควบคุมโรค',
			// 'office_type_other_name.required_if'=>'โปรดเลือก ชื่อหน่วยงาน',
			// 'office_type_other_code.required_if'=>'โปรดเลือก รหัสหน่วยงาน',
			// 'office_taxpayer_no.required'=>'โปรดกรอก หมายเลขผู้เสียภาษี',
			// 'office_address.required'=>'โปรดกรอก หมายเลขผู้เสียภาษี',
			// 'office_province.required'=>'โปรดเลือก จังหวัด',
			// 'office_district.required'=>'โปรดเลือก อำเภอ',
			// 'office_sub_district.required'=>'โปรดเลือก ตำบล',
			// 'office_postal.required'=>'โปรดกรอก รหัสไปรษณีย์',

			// 'title_name.required'=>'โปรดกรอก คำนำหน้าชื่อ',
			// 'first_name.required'=>'โปรดกรอก ชื่อจริง',
			// 'last_name.required'=>'โปรดกรอก นามสกุุล',
			// 'position.required'=>'โปรดกรอก ตำแหน่ง',
			// 'mobile.required'=>'โปรดกรอก โทรศัพท์เคลื่อนที่',
			// 'service_email.required'=>'โปรดกรอก อีเมล์ผู้รับบริการ',
			// 'service_email.email'=>'อีเมล์ผู้รับบริการ ไม่ถูกต้อง',
			// 'service_email.unique'=>'อีเมล์ผู้รับบริการ มีผู้ใช้งานแล้ว',

			// 'contact_addr_opt.required'=>'โปรดเลือก ที่อยู่สำหรับส่งผลการตรวจ',
			// 'contact_title_name.required'=>'โปรดเลือก คำนำหน้าชื่อ ผู้รับบริการ',
			// 'contact_first_name.required'=>'โปรดเลือก ชื่อ ผู้รับบริการ',
			// 'contact_position.required'=>'โปรดเลือก นามสกุล ผู้รับบริการ',
			// 'contact_mobile.required'=>'โปรดเลือก โทรศัพท์ ผู้รับบริการ',
			// 'contact_email.required'=>'โปรดกรอก อีเมล์ข้อมูลติดต่อ',
			// 'contact_email.unique'=>'อีเมล์ข้อมูลติดต่อ มีผู้ใช้งานแล้ว',
			// 'contact_addr.required'=>'โปรดเลือก ที่อยู่ ผู้รับบริการ',
			// 'contact_province.required'=>'โปรดเลือก จังหวัด ผู้รับบริการ',
			// 'contact_district.required'=>'โปรดเลือก อำเภอ ผู้รับบริการ',
			// 'contact_sub_district.required'=>'โปรดเลือก ตำบล ผู้รับบริการ',
			// 'contact_postcode.required'=>'โปรดเลือก รหัสไปรษณีย์ รับบริการ',

			// 'username.required'=>'โปรดกรอก รหัสผู้ใช้',
			// 'username.unique'=>'รหัสผู้ใช้ มีผู้ใช้งานแล้ว',
			// 'email.required'=>'โปรดกรอก อีเมล์บัญชีผู้ใช้',
			// 'email.unique'=>'อีเมล์บัญชีผู้ใช้ มีผู้ใช้งานแล้ว',
			// 'password.required'=>'โปรดกรอก รหัสผ่าน',
			// 'captcha.required' => 'โปรดกรอก รหัส Captcha',
			'captcha.captcha' => 'รหัส Captcha ไม่ถูกต้อง',
		]);
		dd('jet');
		try {
			$user = new User;
			$user->user_type = 'customer';
			$user->username = $request->username;
			$user->password = Hash::make($request->password);
			$user->email = $request->email;
			$user->user_status = 'สมัครใหม่';

			$customer = new UserCustomer;
			$customer->title_name = $request->title_name;
			$customer->first_name = $request->first_name;
			$customer->last_name = $request->last_name;
			$customer->position = $request->position;
			$customer->service_email = $request->service_email;
			$customer->mobile = $request->mobile;

			$customer->office_category = $request->office_category;
			$customer->office_type = $request->office_type;

			switch ($request->office_type) {
				case "1":
					$customer->office_code = $request->office_code_establishment;
					$customer->office_name = $request->office_name_establishment;
					break;
				case "2":
					$customer->office_code = $request->health_place_code;
					$customer->office_name = null;
					break;
				case "3":
					$customer->office_code = $request->border_check_point_code;
					$customer->office_name = null;
					break;
				case "4":
					$customer->office_code = $request->office_type_other_code;
					$customer->office_name = $request->office_type_other_name;
					break;
			}

			$customer->office_taxpayer_no = $request->office_taxpayer_no;
			$customer->office_address = $request->office_address;
			$customer->office_province = $request->office_province;
			$customer->office_district = $request->office_district;
			$customer->office_sub_district = $request->office_sub_district;
			$customer->office_postal = $request->office_postal;

			$customer->contact_addr_opt = $request->contact_addr_opt;
			$customer->contact_title_name = $request->contact_title_name;
			$customer->contact_first_name = $request->contact_first_name;
			$customer->contact_last_name = $request->contact_last_name;
			$customer->contact_position = $request->contact_position;
			$customer->contact_mobile = $request->contact_mobile;
			$customer->contact_email = $request->contact_email;
			$customer->contact_addr = $request->contact_addr;
			$customer->contact_province = $request->contact_province;
			$customer->contact_district = $request->contact_district;
			$customer->contact_sub_district = $request->contact_sub_district;
			$customer->contact_postcode = $request->contact_postcode;

			$saved = $user->save();
			$last_insert_id = $user->id;
			if ($saved == true) {
				$customer->user_id = $last_insert_id;
				$customer->save();
				return redirect()->back()->with('success', 'บันทึกข้อมูลผู้ใช้สำเร็จแล้ว');
			} else {
				return redirect()->back()->with('error', 'ไม่สามารถบันทึกข้อมูลได้');
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function refreshCaptcha() {
		return response()->json(['captcha'=> captcha_img('flat')]);
	}

}
