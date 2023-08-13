<?php
namespace App\Exports;

use App\Models\OrderSampleParameter;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class ExportSample implements FromCollection, WithHeadings
{
    protected $split_request;
    public function __construct(array $split_request)
    {
        $this->split_request = $split_request;
    }

    public function Collection()
    {
		$this->split_request['date_start'] = Carbon::createFromFormat('d/m/Y', $this->split_request['date_start'])->format('Y-m-d');
		$this->split_request['date_end'] = Carbon::createFromFormat('d/m/Y', $this->split_request['date_end'])->format('Y-m-d');
        if($this->split_request['sample_type'] == '1'){
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
				'order_sample.sample_received_date'
			);
		}
		elseif($this->split_request['sample_type'] == '2'){
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
				'order_sample_parameter.threat_type_name',
				'order_sample_parameter.parameter_name',
				'order_sample.sample_location_place_province_name',
				'order_sample.sample_location_place_district_name',
				'order_sample.sample_location_place_sub_district_name',
				'order_sample.sample_received_date'
			);
		}
		$ep_query = $ep_query
		->join('orders', 'orders.id', '=' ,'order_sample_parameter.order_id')
		->join('order_sample','order_sample.id','=','order_sample_parameter.order_sample_id')
		->where('order_sample_parameter.sample_type_id', $this->split_request['sample_type'])
		->whereBetween('order_sample.sample_received_date', [$this->split_request['date_start'], $this->split_request['date_end']])
		->when($this->split_request['sample_character'] != "seall", function($cond_sam_char){
			return $cond_sam_char->where('order_sample_parameter.sample_character_id', $this->split_request['sample_character']);
		})
		->when($this->split_request['type_of_work'] != "seall", function($cond_type_work){
			return $cond_type_work->where('orders.type_of_work', $this->split_request['type_of_work']);
		})
		->when(!empty($this->split_request['original_threat']) && $this->split_request['original_threat'] != "seall", function($cond_ori_threat){
				return $cond_ori_threat->where('order_sample.origin_threat_id', $this->split_request['original_threat']);
		})
		->when(!empty($this->split_request['factory_type']) && $this->split_request['factory_type'] != "seall", function($cond_fact){
			return $cond_fact->where('orders.type_of_factory', $this->split_request['factory_type']);
		})
		->when($this->split_request['parameter_group'] != "seall", function($cond_para_group){
			return $cond_para_group->where('order_sample_parameter.threat_type_id', $this->split_request['parameter_group']);
		})
		->when(!empty($this->split_request['parameter']) && $this->split_request['parameter'] != "seall", function($cond_para){
			return $cond_para->where('order_sample_parameter.parameter_id', $this->split_request['parameter']);
		})
		->when($this->split_request['province'] != "seall", function($cond_prov){
			return $cond_prov->where('order_sample.sample_location_place_province', $this->split_request['province']);
		})
		->when($this->split_request['district'] != "seall", function($cond_distr){
			return $cond_distr->where('order_sample.sample_location_place_district', $this->split_request['district']);
		})
		->when($this->split_request['sub_district'] != "seall", function($cond_subdistr){
			return $cond_subdistr->where('order_sample.sample_location_place_sub_district', $this->split_request['sub_district']);
		})
		->get();
		return $ep_query;
    }

	public function headings(): array{
		if($this->split_request['sample_type'] == '1'){
			$ex_head = array('ประเภทตัวอย่าง', 'ชนิดตัวอย่าง', 'รหัสตัวอย่าง', 'ชื่อ', 'นามสกุล', 'อายุ', 'ประเภทงาน', 'แหล่งมลพิษ', 'พารามิเตอร์', 'กลุ่มพารามิเตอร์', 'จังหวัด', 'อำเภอ', 'ตำบล', 'วันรับตัวอย่าง');
		}
		elseif($this->split_request['sample_type'] == '2'){
			$ex_head = array('ประเภทตัวอย่าง', 'ชนิดตัวอย่าง', 'รหัสตัวอย่าง', 'ชื่อ', 'นามสกุล', 'อายุ', 'ตำแหน่งงาน', 'แผนก', 'ประเภทงาน', 'ประเภทสถานประกอบการ', 'พารามิเตอร์', 'กลุ่มพารามิเตอร์', 'จังหวัด', 'อำเภอ', 'ตำบล', 'วันรับตัวอย่าง');
		}
		return $ex_head;
	}
}