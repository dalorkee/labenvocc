<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Hospital;

trait DbHospitalTrait {
	public function getHospital(): array {
		try {
			return Hospital::select('hospcode', 'hosp_name')
			->whereIn('hosp_type_code', ['01'])
			->whereStatus_code(1)
			->get()
			->chunk(1000)->toArray();
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function getHospitalByHospType(array $hosp_type): array {
		try {
			return Hospital::select('hospcode', 'hosp_name')
			->whereIn('hosp_type_code', $hosp_type)
			->whereStatus_code(1)
			->get()
			->chunk(1000)->toArray();
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function getHospitalType() {
		try {
			return Hospital::select('hosp_type_code', 'hosp_type_detail')
				->groupBy('hosp_type_code')
				->get();
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function searchHospitalByName(Request $request): array {
		try {
			$data = Hospital::select('id', 'hosp_name')
				->whereRaw("hosp_name like ? ", array('%'.$request->q.'%'))
				->whereStatus_code(1)
				->get();
			$items = array();
			$data->map(function($item, $key) use (&$items) {
				$tmp['id'] = $item->id;
				$tmp['value'] = $item->hosp_name;
				array_push($items, $tmp);
			});
			$json = array(
				"total" => $data->count(),
				"items" => $items
			);
			return $json;
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function searchDiseaseBorderByName(Request $request): array {
		try {
			$data = Hospital::select('hosp_id', 'hosp_name')
				->whereRaw("hosp_name like ? ", array('%'.$request->q.'%'))
				->whereStatus_code(1)
				->get();
			$items = array();
			$data->map(function($item, $key) use (&$items) {
				$tmp['id'] = $item->hosp_id;
				$tmp['value'] = $item->hosp_name;
				array_push($items, $tmp);
			});
			$json = array(
				"total" => $data->count(),
				"items" => $items
			);
			return $json;
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function hospTypeToHtmlSelect() {
		$hosp_type_arr = $this->getHospitalType();
        dd($hosp_type_arr);
		$htm = "<option value=\"\">-- โปรดเลือก --</option>";
		foreach ($hosp_type_arr as $key => $val) {
			$htm .= "<option value=\"".$key."\">".$val['hosp_type_detail']."</option>";
		}
		return $htm;
	}
}
?>
