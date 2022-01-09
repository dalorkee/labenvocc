<?php
namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\{Postal};

trait DbBoundaryTrait {
	public function getPostCodeBySubDistrict(Request $request): string {
		try {
			$postal = Postal::select('postal_id')->whereSub_district_id($request->id)->get();
			$postcode = (count($postal) > 0) ? $postal[0]['postal_id'] : "";
			return $postcode;
		} catch (\Exception $e) {
			echo $e->getMessage();
		}
	}

}
?>
