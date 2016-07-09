<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscipleshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discipleships', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', ['attending', 'graduated', 'failed']);
            $table->integer('member_id');
            $table->integer('discipleship_id');
            $table->string('discipleship_type');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('discipleships')->insert([
            ['discipleship_type' => 'App\Engage', 'member_id' => '5', 'discipleship_id' => '1'],
            ['discipleship_type' => 'App\Engage', 'member_id' => '3', 'discipleship_id' => '1'],
            ['discipleship_type' => 'App\Engage', 'member_id' => '2', 'discipleship_id' => '1'],
            ['discipleship_type' => 'App\Engage', 'member_id' => '8', 'discipleship_id' => '1'],
            ['discipleship_type' => 'App\Engage', 'member_id' => '7', 'discipleship_id' => '1'],
            ['discipleship_type' => 'App\Engage', 'member_id' => '4', 'discipleship_id' => '1'],
            ['discipleship_type' => 'App\Engage', 'member_id' => '12', 'discipleship_id' => '1'],
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('discipleships');
    }
}
