<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model,SoftDeletes};

class FileUpload extends Model
{
    use SoftDeletes;

	protected $table = 'files_upload';
	protected $primaryKey = 'id';
    public $timestamps = true;
}
