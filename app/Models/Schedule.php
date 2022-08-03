<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_id',
        'class_id',
        'teacher_id',
        'course_id',
        'assignment_id',
        'location',
        'startdate',
        'enddate',
        'schoolweek',
        'yearweek',
    ];

}
