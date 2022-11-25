<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model,SoftDeletes};
use App\Traits\DateTimeTrait;

class OrderReceived extends Model
{
	use SoftDeletes, DateTimeTrait;

	protected $table = 'order_received';
	protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'order_id',
		'lab_no',
		'report_due_date',
		'type_of_work',
		'type_of_work_other',
		'work_group',
	];

	public function order() {
		return $this->belongTo(related: Order::class)->withDefault();
	}

}
