<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetailParameter extends Model
{
	protected $table = 'order_detail_parameter';
	protected $primaryKey = 'id';

	protected $fillable = [
		'order_detail_id',
		'parameter_id',
		'parameter_name',
        'parameter_group',
		'unit_id',
		'unit_name'
	];

	public function orderDetail() {
		return $this->belongTo(OrderDetail::class)->withDefault();
	}
}
