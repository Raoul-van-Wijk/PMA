<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignmentRequest;
use App\Models\Assignments;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignments::getAssignments();
        return view('assignments.assignments', compact('assignments'));
    }

    public function viewSingleAssignment($id, $class_id = 8)
    {
        $progress = [1 => 'Completed', 0 => 'Complete assignment'];
        $assignment = Assignments::find($id);
        $progression = 'Not completed';
        if($assignment->progress()->exists()) {
            $progression = $progress[$assignment->progress[0]->completed];
        }
        return view('assignments.single-assignment', compact('assignment', 'progression', 'class_id'));
    }

    public function registerAssignment()
    {
        return view('assignments.register-assignment');
    }

    public function storeAssignment(AssignmentRequest $request)
    {
        $assignment = new Assignments();
        $assignment->title = $request->title;
        $assignment->content = $request->content;
        $assignment->teacher_id = auth()->user()->id;
        $assignment->save();
        return redirect('/assignments');
    }

    public function editAssignment($id)
    {
        $assignment = Assignments::find($id);
        return view('assignments.edit-assignment', compact('assignment', 'id'));
    }

    public function updateAssignment(AssignmentRequest $request, $id)
    {
        $assignment = Assignments::find($id);
        $assignment->title = $request->title;
        $assignment->content = $request->content;
        $assignment->update();
        return redirect('/assignments');
    }

    public function deleteAssignment($id)
    {
        $assignment = Assignments::find($id);
        $assignment->delete();
        return redirect('/assignments');
    }
}
