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
            ['member_id' => 5, 'class_schedules_id' => 1],
            ['member_id' => 3, 'class_schedules_id' => 1],
            ['member_id' => 2, 'class_schedules_id' => 1],
            ['member_id' => 8, 'class_schedules_id' => 1],
            ['member_id' => 5, 'class_schedules_id' => 2],
            ['member_id' => 3, 'class_schedules_id' => 2],
            ['member_id' => 2, 'class_schedules_id' => 2],
            ['member_id' => 8, 'class_schedules_id' => 2],
            ['member_id' => 5, 'class_schedules_id' => 3],
            ['member_id' => 3, 'class_schedules_id' => 3],
            ['member_id' => 2, 'class_schedules_id' => 3],
            ['member_id' => 8, 'class_schedules_id' => 3],
            ['member_id' => 5, 'class_schedules_id' => 4],
            ['member_id' => 3, 'class_schedules_id' => 4],
            ['member_id' => 2, 'class_schedules_id' => 4],
            ['member_id' => 8, 'class_schedules_id' => 4],
            ['member_id' => 5, 'class_schedules_id' => 5],
            ['member_id' => 3, 'class_schedules_id' => 5],
            ['member_id' => 2, 'class_schedules_id' => 5],
            ['member_id' => 8, 'class_schedules_id' => 5],

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
