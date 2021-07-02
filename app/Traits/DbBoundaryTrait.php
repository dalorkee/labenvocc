<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\{Province,District,SubDistrict,Postal};

trait DbBoundaryTrait {
	public function getPostCodeBySubDistrict(Request $request) {
		try {
			$postal = Postal::select('postal_id')->whereSub_district_id($request->id)->get();
			return $postal[0]['postal_id'];
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

}
?>
