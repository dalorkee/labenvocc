<?php
namespace App\Traits;

trait CommonTrait {
	public function schoolClass(): array {
		return [
			'kin_1' => 'เด็กเล็ก',
			'pri_1' => 'ประถม 1',
			'pri_2' => 'ประถม 2',
			'pri_3' => 'ประถม 3',
			'pri_4' => 'ประถม 4',
			'pri_5' => 'ประถม 5',
			'pri_6' => 'ประถม 6',
			'sec_1' => 'มัธยม 1',
			'sec_2' => 'มัธยม 2',
			'sec_3' => 'มัธยม 3',
			'sec_4' => 'มัธยม 4',
			'sec_5' => 'มัธยม 5',
			'sec_6' => 'มัธยม 6'
		];
	}

	public function titleName(): array {
		return [
			1 => 'ด.ช',
			2 => 'ด.ญ',
			3 => 'นาย',
			4 => 'นาง',
			5 => 'นางสาว'
		];
	}

	public function gender(): array {
		return [
			1 => 'ชาย',
			2 => 'หญิง'
		];
	}

	public function examResult(): array {
		return [
			'detected' => 'ตรวจพบ',
			'not_detected' => 'ไม่พบ',
			'unknown' => 'ไม่ทราบ'
		];
	}

	public function affliliateType(): array {
		return [
			1 => 'ตชด',
			2 => 'สพฐ',
			3 => 'กศน',
			4 => 'สช',
			5 => 'โรงเรียนพระปริยัติธรรม',
			6 => 'สนศ กทม',
			7 => 'อปท',
			8 => 'ศูนย์เด็กวัยเตาะแตะ',
			9 => 'สังกัดอื่นๆ'
		];
	}

	public function verifyType(): array {
		return [
			'student' => 'นักเรียน',
			'teacher' => 'ครู',
			'people' => 'ประชาชนทั่วไป'
		];
	}

	public function calcPercent($data=0, $allData=0): float {
		return (($data*100)/$allData);
	}

	public function convertJsDateToMySQL($date='00/00/0000') {
		if (!is_null($date) && !empty($date)) {
			$ep = explode("/", $date);
			$string = $ep[2]."-".$ep[1]."-".$ep[0];
		} else {
			$string = null;
		}
		return $string;
	}

	public function convertMySQLDateToJs($date='0000-00-00', $seperator="/") {
		if (!is_null($date) && !empty($date)) {
			$ep = explode("-", $date);
			$string = $ep[2].$seperator.$ep[1].$seperator.$ep[0];
		} else {
			$string = null;
		}
		return $string;
	}

	public function checkValidMysqlDateTime($mysql_date_time) {
		$pattern = "/^([0-9]{2,4})-([0-1][0-9])-([0-3][0-9])(?:( [0-2][0-9]):([0-5][0-9]):([0-5][0-9]))?(.[0-9]{1,6})?$/";
		if (preg_match($pattern, $mysql_date_time)) {
			return true;
		} else {
			return false;
		}
	}

}
?>
