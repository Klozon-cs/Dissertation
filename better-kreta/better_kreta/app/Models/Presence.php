<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presence extends Model
{    protected $fillable = [
    'student_id',
    'schoolday_id',
    'state',
    'created_by'
];
    use HasFactory;
    use SoftDeletes;
}
