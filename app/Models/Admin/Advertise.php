<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model,SoftDeletes};

class Advertise extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'advertise';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
