<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Log};
use App\Models\{Order, User, SampleCharacter, RefParameter, Province, District, SubDistrict};

class FetchDataController extends Controller
{
	private object $user;
	private string $user_role;

	public function __construct() {
		$this->middleware('auth');
		$this->middleware(['role:root|admin|staff']);
		$this->middleware('is_order_confirmed');
		$this->middleware(function($request, $next) {
			$this->user = Auth::user();
			$user_role_arr = $this->user->roles->pluck('name')->all();
			$this->user_role = $user_role_arr[0];
			return $next($request);
		});
	}

	public function index(Province $provinces): object {
		$provinces = $provinces->select('province_id', 'province_name')->orderBy('province_name')->get();
		return view(view: 'fetchdata.index', data: compact('provinces'));
	}

	public function sampletype(Request $request, SampleCharacter $sample_type): string {
		$sample_type = $sample_type
			->select('id', 'sample_character_name')
				->when($request->id == "1", function($c) use ($request){
					return $c->where('sample_type_id', $request->id);
				})
				->when($request->id == "2", function($c) use ($request){
					return $c->where('sample_type_id', $request->id);
				})
			->get()
			->keyBy('id');
		if($request->id == "0"){
			$html = "<option value=\"\">เลือกทั้งหมด</option>";
		}
		elseif($request->id > "0"){
			$html = "<option value=\"\">เลือก</option>";
			foreach ($sample_type as $key => $val) {
				$html .= "<option value=\"".$key."\">".$val['sample_character_name']."</option>";
			}
		}		
		return $html;
	}

	public function parameter(Request $request, RefParameter $threat_type): string {		
		$threat_type = $threat_type
			->select('id', 'parameter_name')
				->when($request->id == "1", function($c) use ($request){
					return $c->where('threat_type_id', $request->id);
				})
				->when($request->id == "2", function($c) use ($request){
					return $c->where('threat_type_id', $request->id);
				})
				->when($request->id == "3", function($c) use ($request){
					return $c->where('threat_type_id', $request->id);
				})
				->when($request->id == "4", function($c) use ($request){
					return $c->where('threat_type_id', $request->id);
				})
				->when($request->id == "5", function($c) use ($request){
					return $c->where('threat_type_id', $request->id);
				})
				->when($request->id == "6", function($c) use ($request){
					return $c->where('threat_type_id', $request->id);
				})
				->when($request->id == "7", function($c) use ($request){
					return $c->where('threat_type_id', $request->id);
				})
			->get()
			->keyBy('id');
		if($request->id == "0"){
			$html = "<option value=\"\">เลือกทั้งหมด</option>";
		}
		elseif($request->id > "0"){
			$html = "<option value=\"\">เลือก</option>";
			foreach ($threat_type as $key => $val) {
				$html .= "<option value=\"".$key."\">".$val['parameter_name']."</option>";
			}
		}		
		return $html;
	}

	public function district(Request $request, District $district): string {
		$district = $district
			->select('district_id', 'district_name')
			->where('province_id', $request->id)
			->get()
			->keyBy('district_id');
		if($request->id >= "0"){
			$html = "<option value=\"\">เลือกทั้งหมด</option>";
			foreach ($district as $key => $val) {
				$html .= "<option value=\"".$key."\">".$val['district_name']."</option>";
			}
		}		
		return $html;
	}

	public function SubDistrict(Request $request, SubDistrict $sub_district): string {
		$sub_district = $sub_district
			->select('sub_district_id', 'sub_district_name')
			->where('district_id', $request->id)
			->get()
			->keyBy('sub_district_id');
		if($request->id >= "0"){
			$html = "<option value=\"\">เลือกทั้งหมด</option>";
			foreach ($sub_district as $key => $val) {
				$html .= "<option value=\"".$key."\">".$val['sub_district_name']."</option>";
			}
		}		
		return $html;
	}
}
