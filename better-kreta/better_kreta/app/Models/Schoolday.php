<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schoolday extends Model
{
    protected $fillable = [
        'title',
        'date',
        'course_id',
        'created_by'
    ];
    use HasFactory;
    use SoftDeletes;
}
