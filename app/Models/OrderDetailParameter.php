<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetailParameter extends Model
{
	protected $table = 'order_detail_parameter';
	protected $primaryKey = 'id';

	public function orderDetail() {
		return $this->belongTo(OrderDetail::class)->withDefault();
	}
}
