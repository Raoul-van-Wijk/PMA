<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Progress;

class OverviewController extends Controller
{
    public function overview()
    {
        
        return view('overview.overview');
    }

}
