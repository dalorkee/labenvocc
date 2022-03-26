<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model,SoftDeletes};

class SampleUpload extends Model
{
    use SoftDeletes;
    protected $table = 'tmp_bio_sample';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $dates = ['deleted_at'];
	protected $fillable = [
		'title_name',
        'firstname',
        'lastname',
        'age_year',
        'division',
        'work_life_year',
        'sample_date',
        'note',
        'sample_sender_name',
        'phone_sample_sender',
        'email_sample_sender',
        'user_entry'
	];

}
