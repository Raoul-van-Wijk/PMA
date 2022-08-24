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
use Illuminate\Queue\Events\Looping;

class ScheduleController extends Controller
{

    public function schedules($id = null)
    {
        $days = ['Mon' => 'Monday', 'Tue' => 'Tuesday', 'Wed' => 'Wednesday', 'Thu' => 'Thursday', 'Fri' => 'Friday', 'Sat' => 'Saturday', 'Sun' => 'Sunday'];
        $class_ids = StudentClass::getClassIds();
        if(auth()->user()->isRoot()) {
            $schedules = Schedule::getAllSchedules($class_ids = 'root', $id);
        }
        if($id != null) {
            $schedules = Schedule::getAllSchedules($class_ids, $id);
        } else {
            $id = date('W');
            $schedules = Schedule::getAllSchedules($class_ids, $id);
        }
        $schedules = self::formatSchedules($schedules);
        return view('schedules.schedules', compact('schedules', 'id', 'days'));
    }

    public function showById($id)
    {
        $schedule = Schedule::getSingleScheduleWithRelations($id);

        return view('schedules.schedule', compact('schedule'));
    }

    public function createScheduleView()
    {
        $classes = StudentClass::getClassesById(auth()->user()->id);
        $teachers = User::getNameFromTeachers();
        $courses = Course::all();
        $assignments = Assignments::getAssignments();
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
        $schedule->yearweek = date('W', strtotime($request->date)) +0;
        $schedule->save();
        return redirect()->route('allSchedules')->with('success', 'Schedule created successfully');
    }

    public function deleteSchedule($id)
    {
        $schedule = Schedule::where('schedule_id', $id);
        $schedule->delete();
        return redirect()->route('allSchedules')->with('success', 'Schedule deleted successfully');
    }

    public function editScheduleView($id)
    {
        $schedule = Schedule::getScheduleById($id);
        $classes = StudentClass::getClassesById(auth()->user()->id);
        $teachers = User::getNameFromTeachers();
        $courses = Course::all();
        $assignments = Assignments::all();
        return view('schedules.update-schedule', \compact('schedule', 'classes', 'teachers', 'courses', 'assignments', 'id'));
    }

    public function editSchedule($id, Request $request)
    {
        $schedule = Schedule::find($id);
        $schedule->class_id = $request->class;
        $schedule->teacher_id = $request->teacher;
        $schedule->date = $request->date;
        $schedule->startdate = $request->start_time;
        $schedule->enddate = $request->end_time;
        $schedule->location = $request->classroom;
        $schedule->course_id = $request->course;
        $schedule->assignment_id = $request->assignment;
        $schedule->schoolweek = self::calculateSchoolWeeks($request->date);
        $schedule->yearweek = date('W', strtotime($request->date)) +0;
        $schedule->update();
        return redirect()->route('allSchedules')->with('success', 'Schedule updated successfully');
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



    public function formatSchedules($schedules)
    {
        $formattedSchedules = [
            'Mon' => [],
            'Tue' => [],
            'Wed' => [],
            'Thu' => [],
            'Fri' => [],
            'Sat' => [],
            'Sun' => []
        ];

            foreach($schedules as $schedule) {
                $day = date('D',strtotime($schedule->date));
                $formattedSchedules[$day][] = $schedule;
            }
        return $formattedSchedules;
    }


}
