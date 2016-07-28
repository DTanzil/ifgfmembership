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
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('engage')->insert([
            ['name' => 'Batch #3 - 2015'],
            ['name' => 'Batch #4 - 2015'],
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
