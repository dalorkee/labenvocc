<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model,SoftDeletes};

class Order extends Model
{
	use SoftDeletes;

	protected $table = 'orders';
	protected $primaryKey = 'id';
	public $timestamps = true;

	public function detail() {
		return $this->hasMany(OrderDetail::class);
	}
}
