<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Course;
use App\Models\Assignments;

class DashboardController extends Controller
{
    public function dashboard()
    {

        $schedules = Schedule::getScheduleByTeacherId(auth()->user()->id)->with('courses')->get();
        $courses = Course::all();
        $assignments = Assignments::getAssignmentsBySchedule(auth()->user()->id);
        return view('dashboard', compact('schedules','courses', 'assignments'));
    }


}
