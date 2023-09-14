<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model,SoftDeletes};

class OrderSampleParameter extends Model
{
	use SoftDeletes;
	use \Znck\Eloquent\Traits\BelongsToThrough;

	protected $table = 'order_sample_parameter';
	protected $primaryKey = 'id';

	protected $fillable = [
		'id',
		'order_id',
		'order_sample_id',
		'parameter_id',
		'parameter_name',
		'sample_character_id',
		'sample_character_name',
		'sample_type_id',
		'sample_type_name',
		'threat_type_id',
		'threat_type_name',
		'unit_id',
		'unit_name',
		'unit_value',
		'unit_customer_id',
		'unit_customer_name',
		'unit_customer_value',
		'unit_choice1_id',
		'unit_choice1_name',
		'unit_choice1_value',
		'unit_choice2_id',
		'unit_choice2_name',
		'unit_choice2_value',
		'price_id',
		'price_name',
		'main_analys_user_id',
		'main_analys_name',
		'sub_analys_user_id',
		'sub_analys_name',
		'control_analys_user_id',
		'control_analys_name',
		'technical_id',
		'technical_name',
		'method_analys_id',
		'method_analys_name',
		'machine_id',
		'machine_name',
		'office_id',
		'office_name',
		'status',
		'lab_result_blank',
		'lab_result_amount',
		'lab_dilution',
		'lab_result',
		'lab_result_files',
		'lab_result_comment',
		'lab_result_creatinine'
	];

	public function orderSample() {
		return $this->belongTo(OrderSample::class)->withDefault();
	}

	public function order() {
		return $this->belongsToThrough(Order::class, orderSample::class);
	}
}
