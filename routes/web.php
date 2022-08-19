<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;


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
    });


    Route::prefix('schedule')->group( function() {
        Route::get('/', [ScheduleController::class, 'schedules'])->name('allSchedules');
        Route::get('/create', [ScheduleController::class, 'create'])->middleware('check.user.type:admin|teacher')->name('registerSchedule');

        Route::get('/{id}', [ScheduleController::class, 'showById'])->name('showSingleSchedule');
        Route::get('/{id}/edit', [ScheduleController::class, 'edit'])->name('editSchedule');

        Route::post('/store', [ScheduleController::class, 'storeSchedule'])->name('storeSchedule');
    });
});



require __DIR__.'/auth.php';
