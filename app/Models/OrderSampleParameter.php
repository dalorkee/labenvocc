<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model,SoftDeletes};

class OrderSampleParameter extends Model
{
	use SoftDeletes;

	protected $table = 'order_sample_parameters';
	protected $primaryKey = 'id';

	protected $fillable = [
		'id',
		'order_detail_id',
		'parameter_id',
		'parameter_name',
		'sample_charecter_id',
		'sample_charecter_name',
		'sample_type_id',
		'sample_type_name',
		'threat_type_id',
		'threat_type_name',
		'unit_id',
		'unit_name',
		'unit_customer_name',
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
		'office_name'
	];

	public function orderSample() {
		return $this->belongTo(OrderSample::class)->withDefault();
	}
}
