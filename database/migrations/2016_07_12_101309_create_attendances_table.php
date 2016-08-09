<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->increments('id');           
            $table->integer('member_id');
            $table->integer('class_schedules_id');
        });

        // Insert some stuff
        DB::table('attendances')->insert([
            ['member_id' => 9, 'class_schedules_id' => 1],
            ['member_id' => 10, 'class_schedules_id' => 1],
            ['member_id' => 11, 'class_schedules_id' => 1],
            ['member_id' => 12, 'class_schedules_id' => 1],
            ['member_id' => 13, 'class_schedules_id' => 1],
            ['member_id' => 14, 'class_schedules_id' => 1],
            ['member_id' => 11, 'class_schedules_id' => 2],
            ['member_id' => 12, 'class_schedules_id' => 2],
            ['member_id' => 13, 'class_schedules_id' => 2],
            ['member_id' => 14, 'class_schedules_id' => 2],
            ['member_id' => 11, 'class_schedules_id' => 3],
            ['member_id' => 12, 'class_schedules_id' => 3],
            ['member_id' => 13, 'class_schedules_id' => 3],
            ['member_id' => 14, 'class_schedules_id' => 3],
            ['member_id' => 11, 'class_schedules_id' => 4],
            ['member_id' => 13, 'class_schedules_id' => 4],
            ['member_id' => 14, 'class_schedules_id' => 4],
            ['member_id' => 11, 'class_schedules_id' => 5],
            ['member_id' => 13, 'class_schedules_id' => 5],
            ['member_id' => 14, 'class_schedules_id' => 5],
            ['member_id' => 11, 'class_schedules_id' => 6],
            ['member_id' => 13, 'class_schedules_id' => 6],
            ['member_id' => 14, 'class_schedules_id' => 6],
            ['member_id' => 11, 'class_schedules_id' => 7],
            ['member_id' => 13, 'class_schedules_id' => 7],
            ['member_id' => 14, 'class_schedules_id' => 7]


           

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attendances');
    }
}
