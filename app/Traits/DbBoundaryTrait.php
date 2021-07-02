<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\{Province,District,SubDistrict,Postal};

trait DbBoundaryTrait {
	public function getPostCodeBySubDistrict($sub_district_id=0): object|null {
		try {
			return Postal::select('sub_district_id', 'postal_id')->whereSub_district_id($sub_district_id)->get();
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

}
?>
