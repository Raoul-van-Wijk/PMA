<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

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

    public function class()
    {
        return $this->belongsTo('App\Models\Classes', 'class_id', 'class_id');
    }
    public function teacher()
    {
        return $this->belongsTo('App\Models\User', 'id', 'teacher_id');
    }
    public function courses()
    {
        return $this->belongsTo('App\Models\Course', 'course_id', 'course_id');
    }
    public function assignment()
    {
        return $this->belongsTo('App\Models\Assignment', 'assignment_id', 'assignment_id');
    }


}
