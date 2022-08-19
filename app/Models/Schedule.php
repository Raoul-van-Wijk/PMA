<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\SchoolClass;
use App\Models\Assignments;

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
        'date',
        'schoolweek',
        'yearweek',
    ];

    public function class()
    {
        return $this->belongsTo('App\Models\StudentClass', 'class_id', 'class_id');
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
        return $this->belongsTo('App\Models\Assignments', 'assignment_id', 'assignment_id');
    }



    public static function getScheduleByClassId($id)
    {
        return Schedule::where('class_id', '=', $id)->with('courses')->get();
    }
    public static function getScheduleByTeacherId($id)
    {
        return Schedule::where('teacher_id', '=', $id);
    }
    public static function getScheduleById($id)
    {
        return Schedule::where('schedule_id', '=', $id)->with('courses')->first()->get();
    }
}
