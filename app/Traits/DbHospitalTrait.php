<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Storage,Log};
use App\Models\Hospital;

trait DbHospitalTrait {
	public function getHospital(): array {
		try {
			return Hospital::select('hospcode', 'hosp_name')
			->whereIn('hosp_type_code', ['01'])
			->whereStatus_code(1)
			->limit(10000)
			->get()
			->chunk(1000)->toArray();
		} catch (Exception $e) {
			Log::error($e->getMessage());
		}
	}

	public function searchHospitalByName(Request $request): array {
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
	}

	// public function searchDiseaseBorderByName(Request $request): array {
	// 	$data = Hospital::select('hosp_id', 'hosp_name')
	// 		->whereRaw("hosp_name like ? ", array('%'.$request->q.'%'))
	// 		->whereHosp_type_code('01')
	// 		->whereStatus_code(1)
	// 		->get();
	// 	$items = array();
	// 	$data->map(function($item, $key) use (&$items) {
	// 		$tmp['id'] = $item->hosp_id;
	// 		$tmp['value'] = $item->hosp_name;
	// 		array_push($items, $tmp);
	// 	});
	// 	$json = array(
	// 		"total" => $data->count(),
	// 		"items" => $items
	// 	);
	// 	return $json;
	// }
}
?>
