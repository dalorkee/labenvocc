<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model,SoftDeletes};

class OrderDetail extends Model
{
	use SoftDeletes;

	protected $table = 'order_detail';
	protected $primaryKey = 'id';

	public function order() {
		return $this->belongTo(Order::class)->withDefault();
	}

	public function parameters() {
		return $this->hasMany(OrderDetailParameter::class, 'order_detail_id');
	}

	public static function boot() {
		parent::boot();
		self::deleting(function($orderDetail) {
			$orderDetail->parameters()->each(function($parameter) {
				$parameter->delete();
			});
		});

	}
}
