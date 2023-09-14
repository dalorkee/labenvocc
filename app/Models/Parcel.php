<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Traits\DateTimeTrait;

class Parcel extends Model
{
	protected $table = 'parcel';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $fillable = [
		'lab_no',
		'user_id',
		'post_no',
		'post_date',
		'post_status'
	];

	protected function postDate(): Attribute {
		return new Attribute(
			get: fn ($value) => $this->convertMySQLDateToJs(date: $value),
			set: fn ($value) => $this->convertJsDateToMySQL(date: $value),
		);
	}
}
