<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Course;
use App\Models\Assignments;
use App\Models\StudentClass;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $class_ids = StudentClass::getClassIds();
        $schedules = Schedule::getTodaysScheduleByClassID($class_ids);
        $courseIds = Schedule::getCourseIdsByClassID($class_ids);
        $courses = Course::getCoursesByIds($courseIds);
        $assignments = Assignments::getTodaysAssignments($schedules);
        return view('dashboard', compact('schedules','courses', 'assignments'));
    }


}
