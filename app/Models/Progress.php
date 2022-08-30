<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentClass;
use App\Models\Assignments;

class Progress extends Model
{
    use HasFactory;

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

    public static function getProgressByStudent($student_id)
    {
        $assignments = Assignments::getAssignments();
        return $assignments;
    }
}
