<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model,SoftDeletes};

class Parameter extends Model
{
	use SoftDeletes;

	protected $table = 'z_parameter';
	protected $primaryKey = 'id';
	public $timestamps = true;
}
