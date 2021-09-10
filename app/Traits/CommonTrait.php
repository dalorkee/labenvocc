<?php
namespace App\Traits;
use App\Models\{Position,PositionLevel,Duty};
trait CommonTrait {
	public function titleName(): array {
		return ['mr'=>'นาย', 'mrs'=>'นาง', 'miss'=>'นางสาว'];
	}
	public function titleNameKeyNo(): array {
		return [1=>'นาย', 2=>'นาง', 3=>'นางสาว'];
	}
	public function gender(): array {
		return [1=>'ชาย', 2=>'หญิง'];
	}
	public function sex(): array {
		return ['male'=>'ชาย', 'female'=>'หญิง'];
	}
	public function agencyType(): array {
		return [1=>'หน่วยงานภาครัฐ', 2=>'หน่วยงานรัฐวิสาหกิจ', 3=>'หน่วยงานเอกชน'];
	}
	public function affiliation(): array {
		return [130=>'หน่วยงานส่วนกลาง', 131=>'ศูนย์จังหวัดระยอง'];
	}
    public function latStation(): array {
        return [130=>'ศูนย์อ้างอิง', 131=>'ศูนย์ระยอง'];
    }
	public function calcPercent($data=0, $allData=0): float {
		return (($data*100)/$allData);
	}
	public function convertJsDateToMySQL($date='00/00/0000'): string {
		if (!is_null($date) && !empty($date)) {
			$ep = explode("/", $date);
			$string = $ep[2]."-".$ep[1]."-".$ep[0];
		} else {
			$string = null;
		}
		return $string;
	}
	public function convertMySQLDateToJs($date='0000-00-00', $seperator="/"): string {
		if (!is_null($date) && !empty($date)) {
			$ep = explode("-", $date);
			$string = $ep[2].$seperator.$ep[1].$seperator.$ep[0];
		} else {
			$string = null;
		}
		return $string;
	}
	public function checkValidMysqlDateTime($mysql_date_time): bool {
		$pattern = "/^([0-9]{2,4})-([0-1][0-9])-([0-3][0-9])(?:( [0-2][0-9]):([0-5][0-9]):([0-5][0-9]))?(.[0-9]{1,6})?$/";
		if (preg_match($pattern, $mysql_date_time)) {
			return true;
		} else {
			return false;
		}
	}
	public function getPosition(): array {
		$result = array();
		Position::select('id', 'name')->get()->each(function($value, $key) use (&$result) {
			$result[$value->id] = $value->name;
		});
		return $result;
	}
	public function getPositionLevel(): array {
		$result = array();
		PositionLevel::select('id', 'name_th')->get()->each(function($value, $key) use (&$result) {
			$result[$value->id] = $value->name_th;
		});
		return $result;
	}
	public function getStaffDuty(): array {
		$result = array();
		Duty::select('id', 'duty_name')->get()->each(function($value, $key) use (&$result) {
			$result[$value->id] = $value->duty_name;
		});
		return $result;
	}
}
?>
