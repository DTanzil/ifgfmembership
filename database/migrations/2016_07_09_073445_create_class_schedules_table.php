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
            // $table->integer('teacher_id_1');
            // $table->integer('teacher_id_2');
            // $table->integer('teacher_id_1')->unsigned();
            // $table->foreign('teacher_id_1')->references('id')->on('members');


            $table->integer('lesson_id');
            $table->string('lesson_type');
            $table->date('class_date')->nullable();
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('class_schedules')->insert([
            ['name' => 'Keselamatan', 'lesson_id' => 1, 'lesson_type' => 'App\Engage', 'class_date' => '2016-07-08'],
            ['name' => 'Transformasi Kehidupan', 'lesson_id' => 1, 'lesson_type' => 'App\Engage', 'class_date' => '2016-07-22'],
            ['name' => 'Baptisan Air', 'lesson_id' => 1, 'lesson_type' => 'App\Engage', 'class_date' => '2016-07-12'],
            ['name' => 'Setiap Hari Bersama Kristus', 'lesson_id' => 1, 'lesson_type' => 'App\Engage', 'class_date' => '2016-07-30'],
            ['name' => 'Ikatan Perjanjian', 'lesson_id' => 1, 'lesson_type' => 'App\Engage', 'class_date' => '2016-07-02'],
            ['name' => 'Spiritual Formation', 'lesson_id' => 1, 'lesson_type' => 'App\Engage', 'class_date' => '2016-07-04'],
            ['name' => 'IFGF DNA Dan Icare Group', 'lesson_id' => 1, 'lesson_type' => 'App\Engage', 'class_date' => '2016-07-04'],
            ['name' => 'Keselamatan', 'lesson_id' => 2, 'lesson_type' => 'App\Engage', 'class_date' => '2016-07-08'],
            ['name' => 'Transformasi Kehidupan', 'lesson_id' => 2, 'lesson_type' => 'App\Engage', 'class_date' => '2016-07-22'],
            ['name' => 'Baptisan Air', 'lesson_id' => 2, 'lesson_type' => 'App\Engage', 'class_date' => '2016-07-12'],
            ['name' => 'Setiap Hari Bersama Kristus', 'lesson_id' => 2, 'lesson_type' => 'App\Engage', 'class_date' => '2016-07-30'],
            ['name' => 'Ikatan Perjanjian', 'lesson_id' => 2, 'lesson_type' => 'App\Engage', 'class_date' => '2016-07-02'],
            ['name' => 'Spiritual Formation', 'lesson_id' => 2, 'lesson_type' => 'App\Engage', 'class_date' => '2016-07-04'],
            ['name' => 'IFGF DNA Dan Icare Group', 'lesson_id' => 2, 'lesson_type' => 'App\Engage', 'class_date' => '2016-07-04'],

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
