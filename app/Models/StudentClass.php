<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    use HasFactory;

    public $timestamps = false;


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

    public static function getClassIds()
    {
        $ids = StudentClass::where('student_id' , '=' , auth()->user()->id)->get('class_id');
        $class_ids_in_array = [];
        foreach($ids as $id) {
            // if(Schedule::where('class_id', '=', $id->class_id)->exists()) {
                array_push($class_ids_in_array, $id->class_id);
            }
        // }
        return $class_ids_in_array;
    }
}
