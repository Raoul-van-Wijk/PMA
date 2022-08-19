<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;
use App\Models\SchoolClass;
use App\Models\User;
use App\Models\Course;
use App\Models\Assignments;
use App\Models\StudentClass;

class ScheduleController extends Controller
{

    public function schedules()
    {
        // get all the class_id's from the user that is logged in
        $class_ids = StudentClass::where('student_id' , '=' , auth()->user()->id)->get('class_id');
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
        $classes = StudentClass::getClassesById(auth()->user()->id);
        $teachers = User::getNameFromTeachers();
        $courses = Course::all();
        $assignments = Assignments::all();
        return view('schedules.create', \compact('classes', 'teachers', 'courses', 'assignments'));
    }

    public function storeSchedule(ScheduleRequest $request)
    {
        $schedule = new Schedule();
        $schedule->class_id = $request->class;
        $schedule->teacher_id = $request->teacher;
        $schedule->date = $request->date;
        $schedule->startdate = $request->start_time;
        $schedule->enddate = $request->end_time;
        $schedule->location = $request->classroom;
        $schedule->course_id = $request->course;
        $schedule->assignment_id = $request->assignment;
        $schedule->schoolweek = self::calculateSchoolWeeks($request->date);
        $schedule->yearweek = date('W', strtotime($request->date));
        $schedule->save();
        return redirect()->route('allSchedules')->with('success', 'Schedule created successfully');
    }


    public function getSchedulesByClassIds($ids)
    {
        $schedules = [];
        foreach($ids as $id) {
            array_push($schedules, Schedule::getScheduleByClassId($id->class_id));
        }
        return $schedules;
    }

    public function calculateSchoolWeeks($date)
    {
        $days = [
            'Mon' => '-0 day',
            'Tue' => '-1 day',
            'Wed' => '-2 day',
            'Thu' => '-3 day',
            'Fri' => '-4 day',
            'Sat' => '-5 day',
            'Sun' => '-6 day'
        ];
        $start = '08/01/2022';
        $day = date('D', strtotime($date));
        $date = explode('-', $date);
        $date = $date[1] . '/' . $date[2] . '/' . $date[0];
        $first = \DateTime::createFromFormat('m/d/Y', $start);
        $second = \DateTime::createFromFormat('m/d/Y', $date);
        $second->modify($days[$day]);
        $second;
        return floor($first->diff($second)->days/7);
    }


}
