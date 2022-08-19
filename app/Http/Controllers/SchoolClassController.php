<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolClass;

class SchoolClassController extends Controller
{

    public function index()
    {
        return view('classes.index', [
            'classes' => SchoolClass::all(),
        ]);
    }

    public function show($id) {
        dd($id);
    }
}
