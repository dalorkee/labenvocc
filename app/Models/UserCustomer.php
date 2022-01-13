<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCustomer extends Model
{
	protected $table = 'users_customer_detail';
	protected $primaryKey = 'id';

	protected $fillable = [
		'title_name',
		'first_name',
		'last_name',
		'id_card',
		'taxpayer_no',
		'email',
		'mobile',
		'address',
		'province',
		'district',
		'sub_district',
		'postcode',
		'contact_addr_opt',
		'contact_title_name'
	];

	public function user() {
		return $this->belongsTo(User::class)->withDefault();
	}
}
