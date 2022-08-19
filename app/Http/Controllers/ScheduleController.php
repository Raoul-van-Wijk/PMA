<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;
use App\Models\SchoolClass;
use App\Models\User;
use App\Models\Course;
use App\Models\Assignments;

class ScheduleController extends Controller
{

    public function schedules()
    {
        // get all the class_id's from the user that is logged in
        $class_ids = SchoolClass::where('student_id' , '=' , auth()->user()->id)->get('class_id');
        $schedules = self::getSchedulesByClassIds($class_ids);
        return view('schedules.schedules', compact('schedules'));
    }

    public function showById($id)
    {
        $schedules = Schedule::getScheduleById($id);
        return view('schedules.schedule-components.schedule', compact('schedules'));
    }

    public function create()
    {
        $classes = SchoolClass::getClassesById(auth()->user()->id);
        $teachers = User::getNameFromTeachers();
        $courses = Course::all();
        $assignments = Assignments::all();
        return view('schedules.create', \compact('classes', 'teachers', 'courses', 'assignments'));
    }

    public function storeSchedule(ScheduleRequest $request)
    {
        $schedule = new Schedule();
        $schedule->class_id = $request->class_id;
        $schedule->day = $request->day;
        $schedule->start_time = $request->start_time;
        $schedule->end_time = $request->end_time;
        $schedule->room = $request->room;
        $schedule->course_id = $request->course_id;
        $schedule->save();
        return redirect()->route('schedules')->with('success', 'Schedule created successfully');
    }


    public function getSchedulesByClassIds($ids)
    {
        $schedules = [];
        foreach($ids as $id) {
            array_push($schedules, Schedule::getScheduleByClassId($id->class_id));
        }
        return $schedules;
    }


}
