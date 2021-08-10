<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStaff extends Model
{
	protected $table = 'users_staff_detail';
	protected $primaryKey = 'id';

	public function user() {
		return $this->belongsTo(User::class)->withDefault();;
	}
}
