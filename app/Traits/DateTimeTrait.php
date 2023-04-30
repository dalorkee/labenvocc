<?php
namespace App\Traits;
use Carbon\Carbon;

trait DateTimeTrait {
	public function convertJsDateToMySQL($date=null): ?string {
		if (preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/", $date) || !is_null($date)) {
			// $ep = explode("/", $date);
			// return $ep[2]."-".$ep[1]."-".$ep[0];
			return Carbon::createFromFormat('d/m/Y', $date)->format('Y/m/d');
		} else {
			return null;
		}
	}
	public function convertMySQLDateToJs($date=null): ?string {
		if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date) || !is_null($date)) {
			// $date = '2021-01-02';
			// $ep = explode("-", $date);
			// return $ep[2]."/".$ep[1]."/".$ep[0];
			return Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');
		} else {
			return null;
		}
	}
	public function convertJsDateTimeToMySQL($date='00/00/0000 00:00:00'): string|null {
		if (preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4} [0-2][0-9]:[0-5][0-9]:[0-5][0-9]$/", $date)) {
			$dt = explode(" ", $date);
			$d = explode("/", $dt[0]);
			return $d[2]."-".$d[1]."-".$d[0].' '.$dt[1];
		} else {
			return $date;
		}
	}
	public function convertMySQLDateTimeToJs($date='0000-00-00 00:00:00'): string|null {
		if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]) [0-2][0-9]:[0-5][0-9]:[0-5][0-9]$/", $date)) {
			$dt = explode(" ", $date);
			$d = explode("-", $dt[0]);
			return $d[2]."/".$d[1]."/".$d[0].' '.$dt[1];
		} else {
			return $date;
		}
	}
	public function setJsDateTimeToJsDate($datetime='00/00/0000 00:00:00'): string|null {
		if (preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4} [0-2][0-9]:[0-5][0-9]:[0-5][0-9]$/", $datetime)) {
			$ep = explode(" ", $datetime);
			return $ep[0];
		} else {
			return null;
		}
	}
	public function checkValidMysqlDateTime($mysql_date_time): bool {
		$pattern = "/^([0-9]{2,4})-([0-1][0-9])-([0-3][0-9])(?:( [0-2][0-9]):([0-5][0-9]):([0-5][0-9]))?(.[0-9]{1,6})?$/";
		if (preg_match($pattern, $mysql_date_time)) {
			return true;
		} else {
			return false;
		}
	}

	public function getDateFromCreatedAt($datetime = '0000-00-00 00:00:00'): string {
		$date_exp = explode(" ", $datetime);
		return $date_exp[0];
	}
}

