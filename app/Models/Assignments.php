<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Schedule;

class Assignments extends Model
{
    use HasFactory;

    protected $primaryKey = 'assignment_id';

    protected $fillable = [
        'assignment_id',
        'teacher_id',
        'title',
        'content',
    ];

    public function teacher()
    {
        return $this->belongsTo('App\Models\User', 'teacher_id', 'id');
    }

    public function assignment()
    {
        return $this->hasMany('App\Models\Progress', 'assignment_id', 'assignment_id');
    }

    public function progress()
    {
        return $this->hasMany('App\Models\Progress', 'assignment_id', 'assignment_id');
    }

    public static function getAssignmentsByIds($id)
    {
        return Assignments::whereIn('assignment_id', $id)->get();
    }


    public static function getTodaysAssignments($ids)
    {
        $assignment_ids = [];
        foreach($ids as $id) {
            $assignment_ids[] = $id->assignment_id;
        }
        return Assignments::getAssignmentsByIds($assignment_ids);
    }

    public static function getAssignments($class_id = null, $period = null)
    {
        switch (true) {
            case auth()->user()->hasRole(['root', 'admin']):
                return Assignments::all();
                break;
            case auth()->user()->hasRole(['teacher']):
                if($class_id != null) {
                    return Assignments::whereIn('assignment_id', Schedule::getAssignmentIdsFromClassIdAndDate($class_id, $period))->where('teacher_id', '=', auth()->user()->id)->with(['assignment', 'progress'])->get();
                }
                return Assignments::where('teacher_id', '=', auth()->user()->id)->with('assignment')->get();
                break;
            default:
                return Assignments::whereIn('assignment_id', Schedule::getAssignmentIdsFromClassIds())->with(['assignment' => function($q) {
                    $q->where('student_id', auth()->user()->id);
                }])->get();
                break;
        }
    }
}
