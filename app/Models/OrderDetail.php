<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
	protected $table = 'order_detail';
	protected $primaryKey = 'id';

	public function order() {
		return $this->belongTo(Order::class)->withDefault();
	}

	public function parameters() {
		return $this->hasMany(OrderDetailParameter::class, 'order_detail_id');
	}
}
