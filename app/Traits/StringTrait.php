<?php
namespace App\Traits;

trait StringTrait {
	public function stringToArray($sep=",", $str): array {
		$pattern = "/[".$sep."]/";
		return preg_split($pattern, $str);
	}
	public function ArrayToString($sep=",", $str): string {
		return collect($str)->implode($sep);
	}
}
?>
