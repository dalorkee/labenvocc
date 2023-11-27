<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model,SoftDeletes};
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Traits\DateTimeTrait;

class Calendar extends Model
{
	use SoftDeletes, DateTimeTrait;

	protected $table = 'calendar';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $fillable = [
		'user_id',
		'title',
		'start',
		'end',
		'description',
		'color',
	];

	protected function start(): Attribute {
		return new Attribute(
			get: fn ($value) => $value,
			set: fn ($value) => $this->convertJsDateTimeToMySQL(date: $value),
		);
	}

	protected function end(): Attribute {
		return new Attribute(
			get: fn ($value) => $value,
			set: fn ($value) => $this->convertJsDateTimeToMySQL(date: $value),
		);
	}
}
