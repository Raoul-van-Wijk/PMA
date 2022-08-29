<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolClass;
use App\Models\StudentClass;
use App\Models\User;

class SchoolClassController extends Controller
{

    public function index()
    {
        $countStudents = self::countStudentInClass();
        $classes = SchoolClass::all()->groupBy('class_name');
        return view('classes.index', compact('classes', 'countStudents'));
    }

    public function viewSingleClass($class_id)
    {
        $class = SchoolClass::find($class_id);
        $students = StudentClass::where('class_id', '=', $class_id)->with('student')->get();
        return view('classes.single_class', compact('class', 'students'));
    }

    public function registerClass()
    {
        return view('classes.register');
    }

    public function removeStudentsFromClassView($class_id)
    {
        $class_name = SchoolClass::find($class_id)->class_name;
        $ids = StudentClass::where('class_id', '=', $class_id)->get(['student_id']);
        $students = User::getStudentsEmails($ids);
        return view('classes.remove-students', compact('class_id', 'students', 'class_name'));
    }

    public function storeClass(Request $request)
    {
        $request->validate([
            'class_name' => 'required|unique:school_classes',
        ]);
        $class = new SchoolClass();
        $class->class_name = $request->class_name;
        $class->save();
        return redirect()->route('classes')->with('success', 'Class created successfully');
    }

    public function countStudentInClass()
    {
        $res = [];
        $classnames = SchoolClass::get(['class_id', 'class_name']);
        foreach ($classnames as $class) {
            $cn = $class->class_name;
            $count = StudentClass::where('class_id', '=', $class->class_id)->count();
            $res[$cn] = $count;
        }
        return $res;
    }

    public function removeStudentsFromClass($class_id, Request $request)
    {
        $class_id = $request->class_id;
        $students = $request->students;
        foreach ($students as $student) {
            StudentClass::where('student_id', '=', $student)->where('class_id', '=', $class_id)->delete();
        }
        return redirect()->route('viewSingleClass', $class_id)->with('success', 'Students removed successfully');
    }

    public function deleteClass($class_id)
    {
        $class = SchoolClass::find($class_id);
        $class->delete();
        return redirect()->route('classes')->with('success', 'Class deleted successfully');
    }

    public function addStudentsView($class_id)
    {
        $ids = StudentClass::where('class_id', '=', $class_id)->get(['student_id']);
        $students = User::getStudentsEmail($ids);
        return view('classes.add-students', compact('students', 'class_id'));
    }

    public function addStudentsToClass($class_id, Request $request)
    {

        $request->validate([
            'selectedStudents' => 'required',
        ]);
        $selectedStudents = $request->selectedStudents;
        foreach ($selectedStudents as $student) {
            $studentClass = new StudentClass();
            $studentClass->student_id = $student;
            $studentClass->class_id = $class_id;
            $studentClass->save();
        }
        return redirect()->route('classes')->with('success', 'Students added successfully');
    }

}
