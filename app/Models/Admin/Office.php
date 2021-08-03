<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;
    protected $table = 'ref_office_copy1';
    protected $primaryKey = 'office_id';
    public $timestamps = true;
}
