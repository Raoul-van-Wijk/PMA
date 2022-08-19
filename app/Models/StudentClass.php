<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'student_id',
    ];

    public function class()
    {
        return $this->belongsTo('App\Models\SchoolClass', 'class_id', 'class_id');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\User', 'student_id', 'id');
    }

    public static function getClassesById($id)
    {
        return StudentClass::where('student_id', '=', $id)->with('class')->get();
    }
}
