<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Progress;
use App\Models\StudentClass;

class OverviewController extends Controller
{
    public function overview($id)
    {
        $progression = Progress::Test($id);
        $students = self::formatStudents($id);
        $ass = self::formatAssignments($progression, $students);

        return view('overview.overview', compact('ass'));
    }


    public function formatStudents($class_id) {
        $students = StudentClass::where('class_id', $class_id)->with('student')->get();
        $students = $students->map(function($student) {
            return [
                'name' => $student->student->name,
                'user_id' => $student->student->id,
                'progress' => [
                    'completed' => false
                ]
            ];
        });
        return $students;
    }

    // public function formatAssignments($assignments, $users_from_class)
    // {
    //     $res = [];
    //     $i = 0;
    //     foreach($assignments as $assignment) {

    //         $period = $assignment->period->name;
    //         $sw = $assignment->schoolweek;
    //         $assignment = $assignment->assignment;
    //         $aa = $assignment->assignment_id;
    //         $res[$period] = [
    //             $sw => [
    //                 'assignments' => []
    //             ]
    //         ];
    //         $res[$period][$sw]['assignments'][] = [
    //                 'title' => $assignment->title,
    //                 'students_progression' =>$users_from_class->toArray()
    //         ];

    //         foreach($assignment->progress as $progress) {
    //             $index = array_search($progress->student_id, array_column($res[$period][$sw]['assignments'][$i]['students_progression'], 'user_id'));
    //             $res[$period][$sw]['assignments'][$i]['students_progression'][$index]['progress']['completed'] = $progress->completed ?? false;
    //         }
    //         $i++;
    //     }
    //     return $res;
    // }


    public function formatAssignments($prog, $uc)
    {
        $uc = $uc->toArray();
        $res = $prog->map(function($p) use ($prog, $uc) {
            return [
                $p->period->name => [
                    'W'.strval($p->schoolweek) => [
                        'assignments' => [
                            $prog->map(function($p) use ($uc) {
                                return [
                                    'title' => $p->assignment->title,
                                    'students_progression' => $uc
                            ];
                            })
                        ]
                    ]
                ]
            ];
        });
        return array_merge_recursive(...$res->toArray());
    }
}


