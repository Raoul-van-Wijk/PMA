<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Course;

class DashboardController extends Controller
{
    public function teacherDashboard()
    {
        $schedules = Schedule::getScheduleById(auth()->user()->id)->with('courses')->get();
        return view('teacher.dashboard', compact('schedules'));
    }
}
