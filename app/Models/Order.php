<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model,SoftDeletes};

class Order extends Model
{
	use SoftDeletes;

	protected $table = 'orders';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $fillable = [
		'id',
		'customer_type',
		'user_id',
		'order_status',
		'payment_status',
		'type_of_work',
		'type_of_work_other',
		'book_no',
		'book_date',
		'book_upload',
	];
	protected $appends = ['book_date_js'];

	public function orderSamples() {
		return $this->hasMany(OrderSample::class);
	}

	public function parameters(){
		return $this->hasManyThrough(OrderSampleParameter::class, OrderSample::class);
	}

	public function uploads() {
		return $this->hasMany(FileUpload::class);
	}

	public function getBookDateJsAttribute(): string {
		if (!is_null($this->book_date) && !empty($this->book_date)) {
			$exp = explode("-", $this->book_date);
			$str = $exp[2]."/".$exp[1]."/".$exp[0];
		} else {
			$str = "";
		}
		return $str;
	}
}
