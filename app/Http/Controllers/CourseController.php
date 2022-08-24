<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
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

    public function storeCourse(CourseRequest $request)
    {
        $year = self::formatPeriod($request->education, $request->year, $request->semester, $request->period, $request->startYear);
        $course = new Course();
        $course->course_name = $request->course_name;
        $course->description = $request->description;
        $course->year = $year;
        $course->save();
        return redirect('/courses');
    }


    public function update(CourseRequest $request, $id)
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


    public function formatPeriod($education, $year, $semester, $period, $startYear)
    {
        $education = preg_replace('/([^A-Z])./', '', $education);
        $year = "J{$year}";
        $semester = "S{$semester}";
        $period = "P{$period}";
        $startYear = "C{$startYear}";
        return $education . $year . $semester . $period . $startYear;
    }
}
