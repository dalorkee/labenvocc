<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Hash,Log};
use App\Models\{User,UserCustomer};
use App\Traits\{CommonTrait,JsonBoundaryTrait};

class RegisterPersonalController extends Controller
{
	use CommonTrait, JsonBoundaryTrait;

	protected function createPersonalStep2Get(Request $request): object {
		try {
			$userData = $request->session()->get('userData');
			$provinces = $this->getMinProvince();
			$districts = $this->getMinDistrict();
			$sub_districts = $this->getMinSubDistrict();
			return view('auth.register.personalStep2', compact('userData', 'provinces', 'districts', 'sub_districts'));
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function createPersonalStep2Post(Request $request): object {
		$validatedData = $request->validate([
			'title_name' => 'required|max:20',
			'first_name' => 'required|max:200',
			'last_name' => 'required|max:200',
			'id_card' => 'required|numeric|digits:13',
			'taxpayer_no' => 'required|numeric|digits:13',
			'email' => 'required|unique:users_customer_detail,email|email:rfc,filter',
			'mobile' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:10',
			'address' => 'required|max:255',
			'province' => 'required',
			'district' => 'required',
			'sub_district' => 'required',
			'postcode' => 'required|max:30'
		]);
		try {
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
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function createPersonalStep3Get(Request $request): object {
		try {
			if ($request->session()->has('userData')) {
				$userData = $request->session()->get('userData');
				$provinces = $this->getMinProvince();
				$districts = $this->getMinDistrict();
				$sub_districts = $this->getMinSubDistrict();
				return view('auth.register.personalStep3', compact('userData', 'provinces', 'districts', 'sub_districts'));
			} else {
				return redirect()->route('register.index');
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function createPersonalStep3Post(Request $request): object {
		$validatedData = $request->validate([
			'contact_addr_opt' => 'bail|required',
			'contact_title_name' => 'required_if:contact_addr_opt,==,2',
			'contact_first_name' => 'required_if:contact_addr_opt,==,2',
			'contact_last_name' => 'required_if:contact_addr_opt,==,2',
			'contact_mobile' => 'required_if:contact_addr_opt,==,2|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:10',
			'contact_email' => 'required_if:contact_addr_opt,==,2|unique:users_customer_detail,contact_email|email:rfc,filter',
			'contact_addr' => 'required_if:contact_addr_opt,==,2',
			'contact_province' => 'required_if:contact_addr_opt,==,2',
			'contact_district' => 'required_if:contact_addr_opt,==,2',
			'contact_sub_district' => 'required_if:contact_addr_opt,==,2',
			'contact_postcode' => 'required_if:contact_addr_opt,==,2'
		]);
		try {
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
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function createpersonalStep4Get(Request $request): object {
		try {
			$userData = $request->session()->get('userData');
			$userLoginData = $request->session()->get('userLoginData');
			return view('auth.register.personalStep4', compact('userData', 'userLoginData'));
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function createPersonalStep4Post(Request $request): object {
		$validatedLoginData = $request->validate([
			'username' => 'required|min:6|max:10|unique:users,username|regex:/^[a-zA-Z0-9]+$/',
			'email' => 'required|unique:users,email|email:rfc,filter',
			'password' => 'required|min:8|max:12|required_with:password_confirmation|same:password_confirmation',
			'password_confirmation' => 'required|min:8|max:12'
		]);
		try {
			$userLoginData = ($request->session()->missing('userLoginData')) ?  new User() : $request->session()->get('userLoginData');
			$userLoginData->fill($validatedLoginData);
			$request->session()->put('userLoginData', $userLoginData);
			return redirect()->route('register.personal.step5.get');
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function createPersonalStep5Get(Request $request): object {
		try {
			$userData = $request->session()->get('userData');
			$userLoginData = $request->session()->get('userLoginData');
			$titleName = $this->titleName();
			$provinces = $this->getMinProvince();
			$districts = $this->getMinDistrict();
			$sub_districts = $this->getMinSubDistrict();
			return view('auth.register.personalStep5', compact('userData', 'userLoginData', 'titleName', 'provinces', 'districts', 'sub_districts'));
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function createPersonalStep5Post(Request $request): object {
		$validated = $request->validate([
			'captcha'=>'bail|required|captcha'
		],[
			'captcha.required' => 'โปรดกรอก รหัส Captcha',
		]);
		try {
			$userLoginData = $request->session()->get('userLoginData');
			$userLoginData->fill([
				'user_type' => 'customer',
				'user_status' => 'สมัครใหม่',
				'approved' => 'n'
			]);
			$userLoginData->password = Hash::make($userLoginData->password);
			$userLoginData->password_confirmation = Hash::make($userLoginData->password_confirmation);
			$userLoginDataSaved = $userLoginData->save();

			$userData = $request->session()->get('userData');
			$userData->fill([
				'ref_office_lab_code' => '114114',
				'ref_office_env_code' => '87787',
				'user_id' => $userLoginData->id,
				'customer_type' => 'personal'
			]);

			$userDataSaved = $userData->save();

			$request->session()->forget('userLoginData');
			$request->session()->forget('userData');

			if ($userLoginDataSaved == true && $userDataSaved == true) {
				return redirect()->route('login')->with('success', 'ลงทะเบียน บุคคลทั่วไป สำเร็จแล้ว โปรดรอผลการพิจารณาใช้ระบบฯ');
			} else {
				return redirect()->route('login')->with('error', 'ไม่สามารถลงทะเบียนได้ โปรดตรวจสอบ');
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}
}
