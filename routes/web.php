<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AssignmentController;


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

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');


    Route::middleware('check.user.type:student|admin')->prefix('student')->group( function() {
        Route::get('/', function () {
            return view('student.dashboard');
        })->name('student.dashboard');
    });


    Route::prefix('courses')->middleware('check.user.type:teacher|admin|root')->group( function() {
        Route::get('/', [CourseController::class, 'index'])->name('courses');
        Route::get('/registerCourse', [CourseController::class, 'registerCourse'])->name('registerCourse');
        Route::post('/storeCourse', [CourseController::class, 'storeCourse'])->name('storeCourse');
    });


    Route::prefix('classes')->middleware('check.user.type:teacher|admin|root')->group( function() {
        Route::get('/', [SchoolClassController::class, 'index'])->name('classes');
        Route::get('/register', [SchoolClassController::class, 'registerClass'])->name('registerClass');
        Route::post('/store', [SchoolClassController::class, 'storeClass'])->name('storeClass');
        Route::get('/addStudent', [SchoolClassController::class, 'addStudentsView'])->name('addStudentsToClass');
        Route::post('/addStudent/', [SchoolClassController::class, 'addStudentsToClass'])->name('addStudentsToClassConfirmed');
    });

    Route::prefix('assignments')->group( function() {
        Route::get('/', [AssignmentController::class, 'index'])->name('assignments');
        Route::get('/view/{id}', [AssignmentController::class, 'viewSingleAssignment'])->name('viewSingleAssignment');
        Route::group(['middleware' => 'check.user.type:teacher|admin|root'], function () {
            Route::get('/register', [AssignmentController::class, 'registerAssignment'])->name('registerAssignment');
            Route::post('/store', [AssignmentController::class, 'storeAssignment'])->name('storeAssignment');
            Route::get('/edit/{id}', [AssignmentController::class, 'editAssignment'])->name('editAssignment');
            Route::post('/edit/{id}/confirmed', [AssignmentController::class, 'updateAssignment'])->name('editAssignmentConfirmed');
            Route::delete('/delete/{id}', [AssignmentController::class, 'deleteAssignment'])->name('deleteAssignment');
        });
    });


    Route::prefix('schedule')->group( function() {
        Route::get('/single/{id}', [ScheduleController::class, 'showById'])->name('showSingleSchedule');

        Route::middleware('check.user.type:root|admin|teacher')->group(function () {
            Route::get('/create', [ScheduleController::class, 'createScheduleView'])->name('registerSchedule');
            Route::get('/edit/{id}', [ScheduleController::class, 'editScheduleView'])->name('editSchedule');
            Route::put('/edit/{id}/confirmed', [ScheduleController::class, 'editSchedule'])->name('editScheduleConfirmed');
            Route::delete('/delete/{id}', [ScheduleController::class, 'deleteSchedule'])->name('deleteSchedule');
            Route::post('/store', [ScheduleController::class, 'storeSchedule'])->name('storeSchedule');
        });

        Route::get('/{id?}', [ScheduleController::class, 'schedules'])->name('allSchedules');
    });
});



require __DIR__.'/auth.php';
