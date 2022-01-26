<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Hash,Log};
use App\Models\{User,UserCustomer};
use App\Traits\{CommonTrait,JsonBoundaryTrait,GovernmentTrait};

class RegisterGovernmentController extends Controller
{
	use CommonTrait, JsonBoundaryTrait, GovernmentTrait;

	protected function createGovernmentStep2Get(Request $request): object {
		try {
			$userData = $request->session()->get('userData');
			$governments = $this->getGovernmentToArray();
			$departments = $this->getGovernmentDeptToArray();
			$provinces = $this->getMinProvince();
			$districts = $this->getMinDistrict();
			$sub_districts = $this->getMinSubDistrict();
			return view('auth.register.governmentStep2', compact('userData', 'governments', 'departments', 'provinces', 'districts', 'sub_districts'));
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function createGovernmentStep2Post(Request $request): object {
		$validatedData = $request->validate([
			'agency_ministry' => 'required|max:30',
			'agency_department' => 'required|max:30',
			'agency_name' => 'required|max:100',
			'agency_code' => 'required|max:30',
			'taxpayer_no' => 'required|max:30',
			'email' => 'required|unique:users_customer_detail,email',
			'mobile' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:10',
			'address' => 'required',
			'province' => 'required',
			'district' => 'required',
			'sub_district' => 'required',
			'postcode' => 'required'
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
			return redirect()->route('register.gov.step3.get');
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function createGovernmentStep3Get(Request $request): object {
		try {
			if ($request->session()->has('userData')) {
				$userData = $request->session()->get('userData');
				$governments = $this->getGovernmentToArray();
				$departments = $this->getGovernmentDeptToArray();
				$provinces = $this->getMinProvince();
				$districts = $this->getMinDistrict();
				$sub_districts = $this->getMinSubDistrict();
				return view('auth.register.governmentStep3', compact('userData', 'governments', 'departments', 'provinces', 'districts', 'sub_districts'));
			} else {
				return redirect()->route('register.index');
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function createGovernmentStep3Post(Request $request): object {
		$validatedData = $request->validate([
			'contact_title_name' => 'required',
			'contact_first_name' => 'required',
			'contact_last_name' => 'required',
			'contact_addr_opt' => 'required',
			'contact_mobile' => 'required_if:contact_addr_opt,==,2|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:10',
			'contact_email' => 'required_if:contact_addr_opt,==,2|unique:users_customer_detail,contact_email',
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
					'contact_title_name' => $request->contact_title_name,
					'contact_first_name' => $request->contact_first_name,
					'contact_last_name' => $request->contact_last_name,
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
			return redirect()->route('register.gov.step4.get');
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function createGovernmentStep4Get(Request $request): object {
		try {
			$userData = $request->session()->get('userData');
			$userLoginData = $request->session()->get('userLoginData');
			return view('auth.register.governmentStep4', compact('userData', 'userLoginData'));
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function createGovernmentStep4Post(Request $request): object {
		$validatedLoginData = $request->validate([
			'username' => 'required|min:6|max:10|unique:users,username|regex:/^[a-zA-Z0-9 ]+$/',
			'email' => 'required|unique:users,email',
			'password' => 'required|min:6|max:12|required_with:password_confirmation|same:password_confirmation',
			'password_confirmation' => 'required|min:6|max:12'
		]);
		try {
			$userLoginData = ($request->session()->missing('userLoginData')) ?  new User() : $request->session()->get('userLoginData');
			$userLoginData->fill($validatedLoginData);
			$request->session()->put('userLoginData', $userLoginData);
			return redirect()->route('register.gov.step5.get');
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function createGovernmentStep5Get(Request $request): object {
		try {
			$userData = $request->session()->get('userData');
			$userLoginData = $request->session()->get('userLoginData');
			$titleName = $this->titleName();
			$governments = $this->getGovernmentToArray();
			$departments = $this->getGovernmentDeptToArray();
			$provinces = $this->getMinProvince();
			$districts = $this->getMinDistrict();
			$sub_districts = $this->getMinSubDistrict();
			return view('auth.register.governmentStep5', compact('userData', 'userLoginData', 'titleName', 'governments', 'departments', 'provinces', 'districts', 'sub_districts'));
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	protected function createGovernmentStep5Post(Request $request): object {
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
				'customer_type' => 'government'
			]);
			$userDataSaved = $userData->save();

			$request->session()->forget('userLoginData');
			$request->session()->forget('userData');

			if ($userLoginDataSaved == true && $userDataSaved == true) {
				return redirect()->route('login')->with('success', 'ลงทะเบียน หน่วยงานรัฐบาล สำเร็จแล้ว โปรดรอผลการพิจารณาใช้ระบบฯ');
			} else {
				return redirect()->route('login')->with('error', 'ไม่สามารถลงทะเบียนได้สำเร็จ โปรดตรวจสอบ');
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}
}
