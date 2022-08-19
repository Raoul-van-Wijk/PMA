<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Schedule;

class Assignments extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'title',
        'content',
    ];


    public static function getAssignmentsBySchedule($teacher_id)
    {
        return Schedule::where('teacher_id', $teacher_id)->with('assignment')->get();
    }
}
