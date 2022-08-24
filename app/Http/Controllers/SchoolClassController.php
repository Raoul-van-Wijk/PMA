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

    public function registerClass()
    {
        return view('classes.register');
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

    public function addStudentsView()
    {
        $classes = SchoolClass::get(['class_id', 'class_name']);
        $students = User::getStudentsEmail();
        return view('classes.add-students', compact('students', 'classes'));
    }

    public function addStudentsToClass(Request $request)
    {

        $request->validate([
            'selectedStudents' => 'required',
            'class_id' => 'required',
        ]);
        $selectedStudents = $request->selectedStudents;
        $class_id = $request->class_id;
        foreach ($selectedStudents as $student) {
            $studentClass = new StudentClass();
            $studentClass->student_id = $student;
            $studentClass->class_id = $class_id;
            $studentClass->save();
        }
        return redirect()->route('classes')->with('success', 'Students added successfully');
    }
}
