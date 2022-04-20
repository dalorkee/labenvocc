<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model,SoftDeletes};

class OrderSample extends Model
{
	use SoftDeletes;

	protected $table = 'order_sample';
	protected $primaryKey = 'id';

	public function order() {
		return $this->belongTo(Order::class)->withDefault();
	}

	public function parameters() {
		return $this->hasMany(OrderSampleParameter::class, 'order_sample_id');
	}

	public static function boot() {
		parent::boot();
		self::deleting(function($orderSample) {
			$orderSample->parameters()->each(function($parameter) {
				$parameter->delete();
			});
		});
	}

	public function getSampleDateInJsAttribute() {
		if (strlen($this->sample_date) > 0) {
			$exp = explode("-", $this->sample_date);
			$str = $exp[2]."/".$exp[1]."/".$exp[0];
		} else {
			$str = "";
		}
		return $str;
	}

	protected $appends = ['sample_date_in_js'];
}
