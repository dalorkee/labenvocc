<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model,SoftDeletes};

class Office extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'ref_office';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
