<?php
namespace App\Models;

use Illuminate\Database\Eloquent\{Model,SoftDeletes};
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Traits\DateTimeTrait;

class Order extends Model
{
	use SoftDeletes, DateTimeTrait;

	protected $table = 'orders';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $fillable = [
		'id',
		'order_no',
		'order_no_ref',
		'order_type',
		'order_type_name',
		'user_id',
		'customer_type',
		'customer_agency_code',
		'customer_agency_name',
		'type_of_factory',
		'type_of_factory_name',
		'type_of_work',
		'type_of_work_name',
		'type_of_work_other',
		'deliver_method',
		'book_no',
		'book_date',
		'book_upload',
		'detail',
		'order_confirmed_date',
		'received_order_name',
		'received_order_date',
		'review_order_name',
		'review_order_date',
		'order_payment_date',
		'order_status',
		'lab_no',
		'report_due_date',
		'report_result_receive_method',
		'sample_verify_desc',
		'receipt_status',
		'analyze_result_files',
		'order_destroy_status',
		'order_destroy_date',
	];

	public function orderSamples() {
		return $this->hasMany(related: OrderSample::class);
	}

	public function parameters(){
		return $this->hasManyThrough(related: OrderSampleParameter::class, through: OrderSample::class);
	}

	public function uploads() {
		return $this->hasMany(related: FileUpload::class);
	}

	protected function bookDate(): Attribute {
		return new Attribute(
			get: fn ($value) => $this->convertMySQLDateToJs(date: $value),
			set: fn ($value) => $this->convertJsDateToMySQL(date: $value),
		);
	}

	protected function orderConfirmedDate(): Attribute {
		return new Attribute(
			get: fn ($value) => $this->convertMySQLDateTimeToJs(date: $value),
			set: fn ($value) => $this->convertJsDateTimeToMySQL(date: $value),
		);
	}

	protected function receivedOrderDate(): Attribute {
		return new Attribute(
			get: fn ($value) => $this->convertMySQLDateToJs(date: $value),
			set: fn ($value) => $this->convertJsDateToMySQL(date: $value),
		);
	}

	protected function reviewOrderDate(): Attribute {
		return new Attribute(
			get: fn ($value) => $this->convertMySQLDateToJs(date: $value),
			set: fn ($value) => $this->convertJsDateToMySQL(date: $value),
		);
	}

	protected function reportDueDate(): Attribute {
		return new Attribute(
			get: fn ($value) => $this->convertMySQLDateToJs(date: $value),
			set: fn ($value) => $this->convertJsDateToMySQL(date: $value),
		);
	}

	protected function orderDestroyDate(): Attribute {
		return new Attribute(
			get: fn ($value) => $this->convertMySQLDateToJs(date: $value),
			set: fn ($value) => $this->convertJsDateToMySQL(date: $value),
		);
	}




	// public function getBookDateJsAttribute(): string {
	// 	if (!is_null($this->book_date) && !empty($this->book_date)) {
	// 		$exp = explode("-", $this->book_date);
	// 		$str = $exp[2]."/".$exp[1]."/".$exp[0];
	// 	} else {
	// 		$str = "";
	// 	}
	// 	return $str;
	// }


}
