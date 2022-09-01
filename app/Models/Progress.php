<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentClass;
use App\Models\Assignments;
use App\Models\Schedule;

class Progress extends Model
{
    use HasFactory;

    protected $primaryKey = 'progress_id';
    protected $fillable = [
        'progress_id',
        'assignment_id',
        'student_id',
        'content',
        'percentage',
        'completed',
    ];

    public function assignment()
    {
        return $this->belongsTo('App\Models\Assignment');
    }
    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public static function getProgressByTeacher($class, $period)
    {
        // get period start and end dates
        $period = Period::where('id', $period)->get();
        $assignments = Assignments::getAssignments($class, $period);
        return $assignments;
    }


    public static function Test($class_id)
    {
        return Schedule::where('class_id', $class_id)->with(['assignment.progress'])->get();
    }
}
