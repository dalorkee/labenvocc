<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCustomer extends Model
{
	protected $table = 'users_customer_detail';
	protected $primaryKey = 'id';

    protected $fillable = [
        'title_name', 'first_name', 'last_name'
    ];

	public function user() {
		return $this->belongsTo(User::class)->withDefault();
	}
}
