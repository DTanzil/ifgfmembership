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
     
            ['name' => Config::get('constants.ENGAGE_CLASSES.0'), 'lesson_id' => 1, 'lesson_type' => 'App\Engage', 'class_date' => '2015-01-26'],
            ['name' => Config::get('constants.ENGAGE_CLASSES.1'), 'lesson_id' => 1, 'lesson_type' => 'App\Engage', 'class_date' => '2015-02-02'],
            ['name' => Config::get('constants.ENGAGE_CLASSES.2'), 'lesson_id' => 1, 'lesson_type' => 'App\Engage', 'class_date' => '2015-02-09'],
            ['name' => Config::get('constants.ENGAGE_CLASSES.3'), 'lesson_id' => 1, 'lesson_type' => 'App\Engage', 'class_date' => '2015-02-16'],
            ['name' => Config::get('constants.ENGAGE_CLASSES.4'), 'lesson_id' => 1, 'lesson_type' => 'App\Engage', 'class_date' => '2015-02-23'],
            ['name' => Config::get('constants.ENGAGE_CLASSES.5'), 'lesson_id' => 1, 'lesson_type' => 'App\Engage', 'class_date' => '2015-02-09'],
            ['name' => Config::get('constants.ENGAGE_CLASSES.6'), 'lesson_id' => 1, 'lesson_type' => 'App\Engage', 'class_date' => '2015-03-16'],


            // ['name' => Config::get('constants.ENGAGE_CLASSES.0'), 'lesson_id' => 2, 'lesson_type' => 'App\Engage', 'class_date' => '2016-07-08'],
            // ['name' => Config::get('constants.ENGAGE_CLASSES.1'), 'lesson_id' => 2, 'lesson_type' => 'App\Engage', 'class_date' => '2016-07-22'],
            // ['name' => Config::get('constants.ENGAGE_CLASSES.2'), 'lesson_id' => 2, 'lesson_type' => 'App\Engage', 'class_date' => '2016-07-12'],
            // ['name' => Config::get('constants.ENGAGE_CLASSES.3'), 'lesson_id' => 2, 'lesson_type' => 'App\Engage', 'class_date' => '2016-07-30'],
            // ['name' => Config::get('constants.ENGAGE_CLASSES.4'), 'lesson_id' => 2, 'lesson_type' => 'App\Engage', 'class_date' => '2016-07-02'],
            // ['name' => Config::get('constants.ENGAGE_CLASSES.5'), 'lesson_id' => 2, 'lesson_type' => 'App\Engage', 'class_date' => '2016-07-04'],
            // ['name' => Config::get('constants.ENGAGE_CLASSES.6'), 'lesson_id' => 2, 'lesson_type' => 'App\Engage', 'class_date' => '2016-07-04'],

            ['name' => Config::get('constants.ESTABLISH_CLASSES.0'), 'lesson_id' => 1, 'lesson_type' => 'App\Establish', 'class_date' => '2016-04-11'],
            ['name' => Config::get('constants.ESTABLISH_CLASSES.1'), 'lesson_id' => 1, 'lesson_type' => 'App\Establish', 'class_date' => '2016-04-18'],
            ['name' => Config::get('constants.ESTABLISH_CLASSES.2'), 'lesson_id' => 1, 'lesson_type' => 'App\Establish', 'class_date' => '2016-04-25'],
            ['name' => Config::get('constants.ESTABLISH_CLASSES.3'), 'lesson_id' => 1, 'lesson_type' => 'App\Establish', 'class_date' => '2016-05-09'],
            ['name' => Config::get('constants.ESTABLISH_CLASSES.4'), 'lesson_id' => 1, 'lesson_type' => 'App\Establish', 'class_date' => '2016-05-16'],
            ['name' => Config::get('constants.ESTABLISH_CLASSES.5'), 'lesson_id' => 1, 'lesson_type' => 'App\Establish', 'class_date' => '2016-05-23'],
            ['name' => Config::get('constants.ESTABLISH_CLASSES.6'), 'lesson_id' => 1, 'lesson_type' => 'App\Establish', 'class_date' => '2016-05-30'],

            // ['name' => Config::get('constants.EQUIP_CLASSES.0'), 'lesson_id' => 1, 'lesson_type' => 'App\Equip', 'class_date' => '2016-07-08'],
            // ['name' => Config::get('constants.EQUIP_CLASSES.1'), 'lesson_id' => 1, 'lesson_type' => 'App\Equip', 'class_date' => '2016-07-22'],
            // ['name' => Config::get('constants.EQUIP_CLASSES.2'), 'lesson_id' => 1, 'lesson_type' => 'App\Equip', 'class_date' => '2016-07-12'],
            // ['name' => Config::get('constants.EQUIP_CLASSES.3'), 'lesson_id' => 1, 'lesson_type' => 'App\Equip', 'class_date' => '2016-07-30'],
            // ['name' => Config::get('constants.EQUIP_CLASSES.4'), 'lesson_id' => 1, 'lesson_type' => 'App\Equip', 'class_date' => '2016-07-02'],
            // ['name' => Config::get('constants.EQUIP_CLASSES.5'), 'lesson_id' => 1, 'lesson_type' => 'App\Equip', 'class_date' => '2016-07-04'],
            // ['name' => Config::get('constants.EQUIP_CLASSES.6'), 'lesson_id' => 1, 'lesson_type' => 'App\Equip', 'class_date' => '2016-07-04'],


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
