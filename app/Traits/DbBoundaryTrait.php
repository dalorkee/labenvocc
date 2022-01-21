<?php
namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\{Province,District,SubDistrict,Postal};

trait DbBoundaryTrait {
	public function getPostCodeBySubDistrict(Request $request): string {
		try {
			$postal = Postal::select('postal_id')->whereSub_district_id($request->id)->get();
			$postcode = $postal[0]['postal_id'] ?? "";
			return $postcode;
		} catch (\Exception $e) {
			echo $e->getMessage();
		}
	}

	public function getProvinceNameByProvId($prov_id=0): string  {
		$prov = Province::select('province_name')->whereProvince_id($prov_id)->get();
		return $prov[0]->province_name;
	}

	public function getDistrictNameByDistId($dist_id=0): string  {
		$dist = District::select('district_name')->whereDistrict_id($dist_id)->get();
		return $dist[0]->district_name;
	}

	public function getSubDistrictNameBySubDistId($sub_dist_id=0): string  {
		$sub_dist = SubDistrict::select('sub_district_name')->whereSub_district_id($sub_dist_id)->get();
		return $sub_dist[0]->sub_district_name;
	}

}
?>
