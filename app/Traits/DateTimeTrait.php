<?php
namespace App\Traits;

trait DateTimeTrait {
	public function convertJsDateToMySQL($date='00/00/0000'): string|null {
		if (preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/", $date)) {
			$ep = explode("/", $date);
			return $ep[2]."-".$ep[1]."-".$ep[0];
		} else {
			return $date;
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
	public function convertMySQLDateToJs($date='0000-00-00'): string|null {
		if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
			$ep = explode("-", $date);
			return $ep[2]."/".$ep[1]."/".$ep[0];
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
}

