<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEngageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engage', function (Blueprint $table) {
            $table->increments('id');           
            $table->string('name', 100);
            $table->tinyInteger('total_session');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('engage')->insert([
            ['name' => 'Engage Batch #3', 'total_session' => 7],
            ['name' => 'Engage Batch #4', 'total_session' => 7],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('engage');
    }
}
