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

    public function class()
    {
        return $this->belongsTo('App\Models\Classes');
    }
    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }
    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }
    public function assignment()
    {
        return $this->belongsTo('App\Models\Assignment');
    }


}
