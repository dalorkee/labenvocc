<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCustomer extends Model
{
	protected $table = 'users_customer_detail';
	protected $primaryKey = 'id';

	protected $fillable = [
		'ref_office_lab_code',
		'ref_office_env_code',
		'user_id',
		'customer_type',
		'title_name',
		'first_name',
		'last_name',
		'id_card',
		'taxpayer_no',
		'email',
		'mobile',
		'address',
		'province',
		'province_name',
		'district',
		'district_name',
		'sub_district',
		'sub_district_name',
		'postcode',
		'contact_addr_opt',
		'contact_title_name',
		'contact_first_name',
		'contact_last_name',
		'contact_mobile',
		'contact_email',
		'contact_addr',
		'contact_province',
		'contact_province_name',
		'contact_district',
		'contact_district_name',
		'contact_sub_district',
		'contact_sub_district_name',
		'contact_postcode'
	];

	public function user() {
		return $this->belongsTo(User::class)->withDefault();
	}

}
