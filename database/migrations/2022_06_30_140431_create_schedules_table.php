<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id('schedule_id');
            $table->integer('class_id');
            $table->integer('teacher_id');
            $table->integer('course_id');
            $table->integer('assignment_id');
            $table->string('location');
            $table->string('startdate');
            $table->string('enddate');
            $table->string('date');

            $table->foreign('class_id')->references('class_id')->on('school_classes');
            $table->foreign('teacher_id')->references('id')->on('users');
            $table->foreign('course_id')->references('course_id')->on('courses');
            $table->foreign('assignment_id')->references('assignment_id')->on('assignments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
