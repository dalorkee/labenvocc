<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Lab404\Impersonate\Models\Impersonate;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
	use HasApiTokens;
	use HasFactory;
	use HasProfilePhoto;
	use HasRoles;
	use Impersonate;
	use Notifiable;
	use TwoFactorAuthenticatable;

	protected $fillable = [
		'user_type',
		'username',
		'password',
		'password_confirmation',
		'email',
		'user_status',
		'approved',
		'approved_by_user',
		'profile_photo_url',
		'is_admin'
	];

	protected $hidden = [
		'password',
		'remember_token',
		'two_factor_recovery_codes',
		'two_factor_secret',
	];

	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	protected $appends = [
		'profile_photo_url',
	];

	public function userCustomer() {
		return $this->hasOne(UserCustomer::class);
	}

	public function userStaff() {
		return $this->hasOne(UserStaff::class);
	}

}
