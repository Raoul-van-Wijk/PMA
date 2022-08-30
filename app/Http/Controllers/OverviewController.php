<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Progress;

class OverviewController extends Controller
{
    public function overview()
    {
        switch (true):
            case auth()->user()->hasRole([ 'root','admin', 'teacher' ]):
                $progress = Progress::getProgressByTeacher(auth()->user()->id);
                break;
            default:
                $progress = Progress::getProgressByStudent(auth()->user()->id);
                break;
        endswitch;
        return view('overview.overview', compact('progress'));
    }

}
