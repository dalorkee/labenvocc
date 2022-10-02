<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model,SoftDeletes};

class RefUnitChoice1 extends Model
{
	use SoftDeletes;

	protected $table = 'ref_unit_choice1';
	protected $primaryKey = 'id';
	public $timestamps = true;
}
