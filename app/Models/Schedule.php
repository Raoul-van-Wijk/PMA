<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\SchoolClass;
use App\Models\StudentClass;
use App\Models\Assignments;

class Schedule extends Model
{
    use HasFactory;

    protected $primaryKey = 'schedule_id';

    protected $fillable = [
        'schedule_id',
        'class_id',
        'teacher_id',
        'course_id',
        'assignment_id',
        'period_id',
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
        return $this->belongsTo('App\Models\User', 'teacher_id', 'id');
    }
    public function courses()
    {
        return $this->belongsTo('App\Models\Course', 'course_id', 'course_id');
    }
    public function assignment()
    {
        return $this->belongsTo('App\Models\Assignments', 'assignment_id', 'assignment_id');
    }
    public function period()
    {
        return $this->belongsTo('App\Models\Period', 'period_id', 'id');
    }



    public static function getScheduleByClassId($id)
    {
        return Schedule::where('class_id', '=', $id)->where('date', '>=', date('Y-m-d'))->with('courses')->orderBy('date')->get();
    }
    public static function getScheduleByTeacherId($id)
    {
        return Schedule::where('teacher_id', '=', $id);
    }
    public static function getScheduleById($id)
    {
        return Schedule::where('schedule_id', $id)->with('courses')->limit(1)->get();
    }



    public static function getTodaysScheduleByClassID($id)
    {
        return Schedule::whereIn('class_id', $id)->where('date', '=', date('Y-m-d'))->with('courses')->orderBy('startdate')->get();
    }


    public static function getAllSchedules($id, $yearweek = null)
    {
        if($id == 'root') {
            return Schedule::where('yearweek', '=', $yearweek)->with('courses')->get();
        }
        return Schedule::whereIn('class_id', $id)->where('yearweek', '=', $yearweek)->orderBy('startdate', 'asc')->get();
    }

    public static function getSingleScheduleWithRelations($id) {
        return Schedule::where('schedule_id', $id)->with('courses')->with('assignment')->with('teacher')->with('class')->limit(1)->get();
    }


    public static function getCourseIdsByClassID($id)
    {
        return Schedule::whereIn('class_id', $id)->get('course_id');
    }


    public static function getAssignmentIdsFromClassIds()
    {

        return Schedule::whereIn('class_id', StudentClass::where('student_id', auth()->user()->id)->get('class_id'))->get('assignment_id');
    }

    public static function getAssignmentIdsFromClassIdAndDate($class, $date)
    {
        return Schedule::where('class_id', $class)->where('date', '>', $date[0]->start)->where('date', '<', $date[0]->end)->get('assignment_id');
    }
}

