<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model,SoftDeletes};
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Traits\DateTimeTrait;

class OrderSample extends Model
{
	use SoftDeletes, DateTimeTrait;

	protected $table = 'order_sample';
	protected $primaryKey = 'id';
	protected $fillable = [
		'order_id',
		'id_card',
		'passport',
		'title_name',
		'firstname',
		'lastname',
		'age_year',
		'division',
		'work_life_year',
		'sample_date',
		'note'
	];
	// protected $appends = ['sample_date_in_js'];

	public function order() {
		return $this->belongTo(related: Order::class)->withDefault();
	}

	public function parameters() {
		return $this->hasMany(related: OrderSampleParameter::class, foreignKey: 'order_sample_id');
	}

	public static function boot() {
		parent::boot();
		self::deleting(function($orderSample) {
			$orderSample->parameters()->each(function($parameter) {
				$parameter->delete();
			});
		});
	}

/* 	public function getSampleDateInJsAttribute() {
		if (strlen($this->sample_date) > 0) {
			$exp = explode("-", $this->sample_date);
			$str = $exp[2]."/".$exp[1]."/".$exp[0];
		} else {
			$str = "";
		}
		return $str;
	} */

	protected function sampleDate(): Attribute {
		return new Attribute(
			get: fn ($value) => $this->convertMySQLDateToJs(date: $value),
			set: fn ($value) => $this->convertJsDateToMySQL(date: $value),
		);
	}

}
