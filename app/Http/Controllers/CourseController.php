<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    //
    public function index()
    {
        return view('courses.index', [
            'courses' => Course::all(),
        ]);
    }

    public function registerCourse()
    {
        return view('courses.create');
    }

    public function storeCourse(Request $request)
    {
        $course = new Course();
        $course->course_name = $request->course_name;
        $course->description = $request->description;
        $course->year = $request->year;
        $course->save();
        return redirect('/courses');
    }


    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        $course->course_name = $request->course_name;
        $course->description = $request->description;
        $course->year = $request->year;
        $course->save();
        return redirect('/courses');
    }

    public function destroy($id)
    {
        $course = Course::find($id);
        $course->delete();
        return redirect('/courses');
    }

    public function show($id)
    {
        $course = Course::find($id);
        return view('courses.show', compact('course'));
    }


}
