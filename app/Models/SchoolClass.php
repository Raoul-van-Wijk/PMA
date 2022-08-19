<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'class_name',
        'student_id',
    ];

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public static function getClassesById($id)
    {
        return SchoolClass::where('student_id', '=', $id)->get();
    }
}
