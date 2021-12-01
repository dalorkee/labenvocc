<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model,SoftDeletes};

class FileUpload extends Model
{
	use SoftDeletes;

	protected $table = 'files_upload';
	protected $primaryKey = 'id';
	public $timestamps = true;

	public function order() {
		return $this->belongTo(Order::class)->withDefault();
	}
}
