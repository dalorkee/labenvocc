<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Log};
use App\Models\{
	OrderSampleParameter,
	User,
	SampleCharacter,
	RefParameter,
	Province,
	District,
	SubDistrict
};

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

	public function sampleType(Request $request, SampleCharacter $sample_type): string {
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
		if($request->id != ""){
			$html = "<option value=\"seall\">เลือกทั้งหมด</option>";
			foreach ($sample_type as $key => $val) {
				$html .= "<option value=\"".$key."\">".$val['sample_character_name']."</option>";
			}
		}
		else {
			$html = "<option value=\"seall\">เลือกทั้งหมด</option>";
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
		if($request->id != ""){
			$html = "<option value=\"seall\">เลือกทั้งหมด</option>";
			foreach ($threat_type as $key => $val) {
				$html .= "<option value=\"".$key."\">".$val['parameter_name']."</option>";
			}
		}
		else{
			$html = "<option value=\"seall\">เลือกทั้งหมด</option>";
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
			$html = "<option value=\"seall\">เลือกทั้งหมด</option>";
			foreach ($district as $key => $val) {
				$html .= "<option value=\"".$key."\">".$val['district_name']."</option>";
			}
		}
		return $html;
	}

	public function subDistrict(Request $request, SubDistrict $sub_district): string {
		$sub_district = $sub_district
			->select('sub_district_id', 'sub_district_name')
			->where('district_id', $request->id)
			->get()
			->keyBy('sub_district_id');
		if($request->id >= "0"){
			$html = "<option value=\"seall\">เลือกทั้งหมด</option>";
			foreach ($sub_district as $key => $val) {
				$html .= "<option value=\"".$key."\">".$val['sub_district_name']."</option>";
			}
		}
		return $html;
	}

	public function dataFetch(Request $request) {		
		$this->validate($request,[
			'sample_type'=>'required',
			'date_start'=>'required',
			'date_end'=>'required',
			]);
		if($request->sample_type == '1'){
			$ep_query = OrderSampleParameter::select(
				'order_sample_parameter.sample_type_name',
				'order_sample_parameter.sample_character_name',
				'order_sample.sample_test_no',
				'order_sample.firstname',
				'order_sample.lastname',
				'order_sample.age_year',
				'orders.type_of_work_name',
				'order_sample.origin_threat_name',
				'order_sample_parameter.threat_type_name',
				'order_sample_parameter.parameter_name',
				'order_sample.sample_location_place_province_name',
				'order_sample.sample_location_place_district_name',
				'order_sample.sample_location_place_sub_district_name',
				'order_sample.sample_receive_date'
			);
		}
		elseif($request->sample_type == '2'){
			$ep_query = OrderSampleParameter::select(
				'order_sample_parameter.sample_type_name',
				'order_sample_parameter.sample_character_name',
				'order_sample.sample_test_no',
				'order_sample.firstname',
				'order_sample.lastname',
				'order_sample.age_year',
				'order_sample.sample_position',
				'order_sample.division',
				'orders.type_of_work_name',
				'orders.type_of_factory_name',
				'order_sample_parameter.parameter_name',
				'order_sample.sample_location_place_province_name',
				'order_sample.sample_location_place_district_name',
				'order_sample.sample_location_place_sub_district_name',
				'order_sample.sample_receive_date'
			);
		}
		$ep_query = $ep_query
		->join('orders', 'orders.id', '=' ,'order_sample_parameter.order_id')
		->join('order_sample','order_sample.id','=','order_sample_parameter.order_sample_id')
		->where('order_sample_parameter.sample_type_id', $request->sample_type)
		->whereBetween('order_sample.sample_receive_date', [$request->date_start, $request->date_end])
		->when($request->sample_character != "seall", function($cond_sam_char) use ($request){
			return $cond_sam_char->where('order_sample_parameter.sample_character_id', $request->sample_character);
		})
		->when($request->type_of_work != "seall", function($cond_type_work) use ($request){
			return $cond_type_work->where('orders.type_of_work', $request->type_of_work);
		})
		->when(!empty($request->original_threat) && $request->original_threat != "seall", function($cond_ori_threat) use ($request){
				return $cond_ori_threat->where('order_sample.origin_threat_id', $request->original_threat);
		})
		->when(!empty($request->factory_type) && $request->factory_type != "seall", function($cond_fact) use ($request){
			return $cond_fact->where('orders.type_of_factory', $request->factory_type);
		})
		->when($request->parameter_group != "seall", function($cond_para_group) use ($request){
			return $cond_para_group->where('order_sample_parameter.threat_type_id', $request->parameter_group);
		})
		->when(!empty($request->parameter) && $request->parameter != "seall", function($cond_para) use ($request){
			return $cond_para->where('order_sample_parameter.parameter_id', $request->parameter);
		})
		->when($request->province != "seall", function($cond_prov) use ($request){
			return $cond_prov->where('order_sample.sample_location_place_province', $request->province);
		})
		->when($request->district != "seall", function($cond_distr) use ($request){
			return $cond_distr->where('order_sample.sample_location_place_district', $request->district);
		})
		->when($request->sub_district != "seall", function($cond_subdistr) use ($request){
			return $cond_subdistr->where('order_sample.sample_location_place_sub_district', $request->sub_district);
		})
		->get();
		dd($ep_query);
	}
}
