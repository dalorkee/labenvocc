<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Storage,Log};
use App\Models\{Province,District,SubDistrict};

trait JsonBoundaryTrait {
	public function getProvince(): array {
		try {
			if (Storage::disk('json')->exists('ref_province.json')) {
				$data = json_decode(Storage::disk('json')->get('ref_province.json'), true);
				return $data;
			} else {
				return array();
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function getDistrict(): array {
		try {
			if (Storage::disk('json')->exists('ref_district.json')) {
				$data = json_decode(Storage::disk('json')->get('ref_district.json'), true);
				return $data;
			} else {
				return array();
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function getSubDistrict(): array {
		try {
			if (Storage::disk('json')->exists('ref_sub_district.json')) {
				$data = json_decode(Storage::disk('json')->get('ref_sub_district.json'), true);
				return $data;
			} else {
				return array();
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function getMinProvince(): array {
		try {
			$provinces = $this->getProvince();
			foreach ($provinces as $key => $val) {
				$minProvince[$key] = $val['province_name'];
			}
			asort($minProvince);
			return $minProvince;
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function getMinDistrict(): array {
		try {
			$districts = $this->getDistrict();
			foreach ($districts as $key => $val) {
				$minDistrict[$key] = $val['district_name'];
			}
			asort($minDistrict);
			return $minDistrict;
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function getMinSubDistrict(): array {
		try {
			$sub_districts = $this->getSubDistrict();
			foreach ($sub_districts as $key => $val) {
				$minSubDistrict[$key] = $val['sub_district_name'];
			}
			asort($minSubDistrict);
			return $minSubDistrict;
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function getDistrictByProvince($prov_id): object {
		try {
			if (Storage::disk('json')->exists('ref_district.json')) {
				$data = json_decode(Storage::disk('json')->get('ref_district.json'), true);
				$data = collect($data);
				$result = $data->where('province_id', $prov_id);
				$result->all();
				return $result;
			} else {
				return collect();
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function getSubDistrictByDistrict($district_id): object {
		try {
			if (Storage::disk('json')->exists('ref_sub_district.json')) {
				$data = json_decode(Storage::disk('json')->get('ref_sub_district.json'), true);
				$data = collect($data);
				$result = $data->where('district_id', $district_id);
				$result->all();
				return $result;
			} else {
				return collect();
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function renderDistrictToHtmlSelect(Request $request): string {
		try {
			$district = $this->getDistrictByProvince($request->id);
			$htm = "<option value=\"\">-- โปรดเลือก --</option>";
			foreach ($district as $key => $val) {
				$htm .= "<option value=\"".$key."\">".$val['district_name']."</option>";
			}
			return $htm;
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function renderSubDistrictToHtmlSelect(Request $request): string {
		try {
			$sub_district = $this->getSubDistrictByDistrict($request->id);
			$htm = "<option value=\"\">-- โปรดเลือก --</option>";
			foreach ($sub_district as $key => $val) {
				$htm .= "<option value=\"".$key."\">".$val['sub_district_name']."</option>";
			}
			return $htm;
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}
}
?>
