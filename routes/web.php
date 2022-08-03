<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SchoolClassController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::middleware('check.user.type:teacher|admin')->prefix('teacher')->group( function() {
        Route::get('/', function () {
            return view('teacher.dashboard');
        })->name('teacher.dashboard');
    });


    Route::middleware('check.user.type:student|admin')->prefix('student')->group( function() {
        Route::get('/', function () {
            return view('student.dashboard');
        })->name('student.dashboard');
    });


    Route::prefix('courses')->group( function() {
        Route::get('/', [CourseController::class, 'index'])->name('courses');
        Route::get('/registerCourse', [CourseController::class, 'registerCourse'])->name('registerCourse');
        Route::post('/storeCourse', [CourseController::class, 'storeCourse'])->name('storeCourse');
    });


    Route::prefix('classes')->group( function() {
        Route::get('/', [SchoolClassController::class, 'index'])->name('classes');
        Route::get('/register', [SchoolClassController::class, 'registerClass'])->name('register');
        Route::post('/store', [SchoolClassController::class, 'storeClass'])->name('store');
    });


    Route::prefix('schedule')->group( function() {
        Route::get('/', [SchoolClassController::class, 'index'])->name('schedule');
        Route::get('/{name}', [SchoolClassController::class, 'show'])->name('show');
            Route::post('/store', [SchoolClassController::class, 'storeSchedule'])->name('storeSchedule');
        });
});



require __DIR__.'/auth.php';
