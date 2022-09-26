<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model,SoftDeletes};

class RefParameter extends Model
{
	use SoftDeletes;

	protected $table = 'ref_parameter';
	protected $primaryKey = 'id';
	public $timestamps = true;
}
