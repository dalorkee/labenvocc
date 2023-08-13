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
		'origin_threat_id',
		'origin_threat_name',
		'sample_location_define',
		'sample_location_place_type',
		'sample_location_place_ministry_id',
		'sample_location_place_ministry_name',
		'sample_location_place_department_id',
		'sample_location_place_department_name',
		'sample_location_place_id',
		'sample_location_place_name',
		'sample_location_place_address',
		'sample_location_place_sub_district',
		'sample_location_place_sub_district_name',
		'sample_location_place_district',
		'sample_location_place_district_name',
		'sample_location_place_province',
		'sample_location_place_province_name',
		'sample_location_place_postal',
		'sample_collection_method',
		'kind_of_sample',
		'collection_point',
		'weight_sample',
		'air_volume',
		'note',
		'has_parameter',
		'sample_verified_status',
		'sample_received_status',
		'sample_test_no',
		'sample_received_date',
		'analys_complete_date',
		'report_result_date',
	];

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

	protected function sampleDate(): Attribute {
		return new Attribute(
			get: fn ($value) => $this->convertMySQLDateToJs(date: $value),
			set: fn ($value) => $this->convertJsDateToMySQL(date: $value),
		);
	}

	protected function sampleReceiveDate(): Attribute {
		return new Attribute(
			get: fn ($value) => $this->convertMySQLDateToJs(date: $value),
			set: fn ($value) => $this->convertJsDateToMySQL(date: $value),
		);
	}

	protected function analysCompleteDate(): Attribute {
		return new Attribute(
			get: fn ($value) => $this->convertMySQLDateToJs(date: $value),
			set: fn ($value) => $this->convertJsDateToMySQL(date: $value),
		);
	}

	protected function reportResultDate(): Attribute {
		return new Attribute(
			get: fn ($value) => $this->convertMySQLDateToJs(date: $value),
			set: fn ($value) => $this->convertJsDateToMySQL(date: $value),
		);
	}

}
