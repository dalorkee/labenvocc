<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $table = 'orders';
	protected $primaryKey = 'id';

	public function detail() {
		return $this->hasMany(OrderDetail::class);
	}
}
