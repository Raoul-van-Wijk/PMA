<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Progress;

class ProgressController extends Controller
{
    public function createProgress($id) {
        $progress = Progress::where('student_id', auth()->user()->id)->where('assignment_id', $id)->get();
        $pc = $progress->count();
        if($pc == 0) {
            $progress = new Progress();
            $progress->student_id = auth()->user()->id;
            $progress->assignment_id = $id;
            $progress->completed = 1;
            $progress->save();
            return redirect(url()->previous());
        } elseif($pc == 1) {
            $bools = [0 => true, 1 => false];
            $completed = $bools[$progress[0]->completed];
            Progress::find($progress[0]->progress_id)->update(['completed' => $completed]);
            return redirect(url()->previous());
        }
    }
}
