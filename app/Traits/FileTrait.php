<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Carbon\Carbon;

trait FileTrait {
	public function setFileName( $prefix='f', $uid='0', $extension='csv') {
		$now = Carbon::now()->timestamp;
		$file_name = $prefix.'u'.$uid.'t'.$now.'.'.$extension;
		return $file_name;
	}

}
?>
