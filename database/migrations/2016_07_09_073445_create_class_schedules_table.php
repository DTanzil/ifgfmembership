<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_schedules', function (Blueprint $table) {
            $table->increments('id');           
            $table->string('name', 100);
            $table->integer('teacher_id');
            // $table->integer('teacher_id')->unsigned();
            // $table->foreign('teacher_id')->references('id')->on('members');


            $table->integer('lesson_id');
            $table->string('lesson_type');
            $table->date('class_date')->nullable();
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('class_schedules')->insert([
            ['name' => 'Baptisan Air', 'teacher_id' => 4, 'lesson_id' => 1, 'lesson_type' => 'App\Engage'],
            ['name' => 'Holy Spirit Baptism', 'teacher_id' => 2, 'lesson_id' => 1, 'lesson_type' => 'App\Engage'],
            ['name' => 'Introduction', 'teacher_id' => 2, 'lesson_id' => 1, 'lesson_type' => 'App\Engage'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('class_schedules');
    }
}
