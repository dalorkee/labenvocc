<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Traits\DateTimeTrait;

class Parcel extends Model
{
	use DateTimeTrait;

	protected $table = 'parcel';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $fillable = [
		'id',
		'order_id',
		'order_sample_id',
		'order_sample_parameter_id',
		'lab_no',
		'user_id',
		'post_service',
		'post_no',
		'post_date',
		'post_status',
		'post_received_date',
		'post_received_name',
	];

	protected function postDate(): Attribute {
		return new Attribute(
			get: fn ($value) => $this->convertMySQLDateToJs(date: $value),
			set: fn ($value) => $this->convertJsDateToMySQL(date: $value),
		);
	}

	protected function postReceivedDate(): Attribute {
		return new Attribute(
			get: fn ($value) => $this->convertMySQLDateToJs(date: $value),
			set: fn ($value) => $this->convertJsDateToMySQL(date: $value),
		);
	}
}
