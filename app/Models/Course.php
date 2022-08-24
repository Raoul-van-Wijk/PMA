<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'course_name',
        'description',
        'year'
    ];


    public static function getCourseNameById($id)
    {
        return Course::where('course_id', '=', $id)->get('course_name');
    }

    public static function getCoursesByIds($ids)
    {
        return Course::whereIn('course_id', $ids)->get();
    }
}
