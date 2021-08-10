<?php
namespace App\Traits;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Storage;
use App\Models\{Postal};

trait DbBoundaryTrait {
	public function getPostCodeBySubDistrict(Request $request): null|string {
		try {
			$postal = Postal::select('postal_id')->whereSub_district_id($request->id)->get();
			$postcode = (count($postal) > 0) ? $postal[0]['postal_id'] : null;
			return $postcode;
		} catch (\Exception $e) {
			echo $e->getMessage();
		}
	}

}
?>
