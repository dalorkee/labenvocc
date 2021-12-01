<?php
namespace App\Traits;

use Carbon\Carbon;
trait FileTrait {
	public function setFileName( $prefix='f', $uid='0', $extension='csv'): string {
		$now = Carbon::now()->timestamp;
		$file_name = $prefix.'u'.$uid.'t'.$now.'.'.$extension;
		return $file_name;
	}
	public function renameFile($prefix='prefix', $free_txt='free_txt', $file_extension='ext'): string {
		return $prefix.'_'.$free_txt.'_t'.time().'.'.$file_extension;

	}
	public function randomNumberToArray($min=0, $max=20, $quantity=6): array {
		$numbers = range($min, $max);
		shuffle($numbers);
		return array_slice($numbers, 0, $quantity);
	}

}
?>
