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
		'report_due_date',
		'lab_no',
		'order_status',
		'order_reviewer_name',
		'order_reviewer_date',
		'order_receive_status',
		'order_received_date',
		'order_receiver_name',
		'order_payment_status',
		'order_payment_date',
		'order_analyze_date',
		'tm_verify_status',
		'tm_verify_date',
		'qm_verify_status',
		'qm_verify_date',
		'destroy_approve_status',
		'destroy_date',
		'report_result_receive_method',
		'sample_verify_desc',
		'receipt_status',
		'analyze_result_files',
	];

	public function orderSamples() {
		return $this->hasMany(related: OrderSample::class);
	}

	public function parameters() {
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

	protected function reportDueDate(): Attribute {
		return new Attribute(
			get: fn ($value) => $this->convertMySQLDateToJs(date: $value),
			set: fn ($value) => $this->convertJsDateToMySQL(date: $value),
		);
	}

	protected function orderReviewerDate(): Attribute {
		return new Attribute(
			get: fn ($value) => $this->convertMySQLDateToJs(date: $value),
			set: fn ($value) => $this->convertJsDateToMySQL(date: $value),
		);
	}

	protected function orderReceivedDate(): Attribute {
		return new Attribute(
			get: fn ($value) => $this->convertMySQLDateToJs(date: $value),
			set: fn ($value) => $this->convertJsDateToMySQL(date: $value),
		);
	}

	protected function orderPaymentDate(): Attribute {
		return new Attribute(
			get: fn ($value) => $this->convertMySQLDateTimeToJs(date: $value),
			set: fn ($value) => $this->convertJsDateTimeToMySQL(date: $value),
		);
	}

	protected function orderAnalyzeDate(): Attribute {
		return new Attribute(
			get: fn ($value) => $this->convertMySQLDateToJs(date: $value),
			set: fn ($value) => $this->convertJsDateToMySQL(date: $value),
		);
	}

	protected function tmVerifyDate(): Attribute {
		return new Attribute(
			get: fn ($value) => $this->convertMySQLDateTimeToJs(date: $value),
			set: fn ($value) => $this->convertJsDateTimeToMySQL(date: $value),
		);
	}

	protected function qmVerifyDate(): Attribute {
		return new Attribute(
			get: fn ($value) => $this->convertMySQLDateTimeToJs(date: $value),
			set: fn ($value) => $this->convertJsDateTimeToMySQL(date: $value),
		);
	}

	protected function destroyDate(): Attribute {
		return new Attribute(
			get: fn ($value) => $this->convertMySQLDateToJs(date: $value),
			set: fn ($value) => $this->convertJsDateToMySQL(date: $value),
		);
	}
}
