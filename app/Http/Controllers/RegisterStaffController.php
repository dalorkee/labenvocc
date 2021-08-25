<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Hash,Log};
use App\Models\{User,UserStaff};
use App\Traits\{CommonTrait};

class RegisterStaffController extends Controller
{
	use CommonTrait;

	protected function index() {}

	/**
	 * @Route("registerStaff", methods={GET})
	 */
	protected function create(): object {
		try {
			$titleName = $this->titleName();
			$positions = $this->getPosition();
            $affiliation = $this->affiliation();
			$staffDuty = $this->getStaffDuty();
			return view('auth.register-staff', [
				'title_name' => $titleName,
				'positions' => $positions,
                'affiliation' => $affiliation,
				'staffDuty' => $staffDuty
			]);
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	/**
	 * @Route("registerStaff, methods={POST})
	 */
	protected function store(Request $request): object {
		$request->validate([
			'id_card'=>'bail|numeric|digits_between:1,13|required',
			'title_name'=>'required',
			'firstname'=>'required|min:3|max:100',
			'lastname'=>'required|min:3|max:100',
			'mobile'=>'required',
			'email'=>'required|email|unique:users,email',

			'affiliation'=>'required',
			'position'=>'required|min:1|max:10',
			'position_other'=>'required_if:position,81',
			'duty'=>'required',

			'username'=>'required|unique:users,username',
			'password'=>'required|min:6|confirmed',
			'password_confirmation'=>'required|min:6',
			'captcha'=>'required|captcha'
		],[
			'id_card.required'=>'โปรดกรอก เลขบัตรประชาชน',
			'title_name.required'=>'โปรดเลือก คำนำหน้าชื่อ',
			'first_name.required'=>'โปรดกรอก ชื่อจริง',
			'last_name.required'=>'โปรดกรอก นามสกุุล',
			'mobile.required'=>'โปรดกรอก โทรศัพท์เคลื่อนที่',
			'email.required'=>'โปรดกรอก อีเมล์',
			'email.unique'=>'อีเมล์ที่ระบุ มีผู้ใช้งานแล้ว',

			'affiliation.required'=>'โปรดเลือก สังกัด',
			'position.required'=>'โปรดเลือก ตำแหน่ง',
			'position_other.required_if'=>'โปรดเลือก ตำแหน่งอื่นๆ',
			'duty.required'=>'โปรดเลือก หน้าที่',

			'username.required'=>'โปรดกรอก รหัสผู้ใช้',
			'username.unique'=>'รหัสผู้ใช้ มีผู้ใช้งานแล้ว',
			'password.required'=>'โปรดกรอก รหัสผ่าน',
			'captcha.required' => 'โปรดกรอก รหัส Captcha',
			'captcha.captcha' => 'รหัส Captcha ไม่ถูกต้อง',
		]);
		try {
			$user = new User;
			$user->user_type = 'staff';
			$user->username = $request->username;
			$user->password = Hash::make($request->password);
			$user->email = $request->email;
			$user->user_status = 'สมัครใหม่';

			$staff = new UserStaff;
			$staff->id_card = $request->id_card;
			$staff->title_name = $request->title_name;
			$staff->first_name = $request->firstname;
			$staff->last_name = $request->lastname;
			$staff->mobile = $request->mobile;

			$staff->affiliation = $request->affiliation;
			$staff->position = $request->position;
			$staff->position_other = $request->position_other ?? NULL;
			$staff->position_level = $request->position_level ?? NULL;
			$staff->duty = $request->duty;

			$saved = $user->save();
			$last_insert_id = $user->id;
			if ($saved === true) {
				$staff->user_id = $last_insert_id;
				$staff->save();
				return redirect()->back()->with('success', 'บันทึกข้อมูลผู้ใช้สำเร็จแล้ว');
			} else {
				return redirect()->back()->with('error', 'ไม่สามารถบันทึกข้อมูลได้');
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}
	public function show() {}
	public function edit() {}
	public function update() {}
	public function destroy() {}
}
