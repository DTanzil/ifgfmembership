<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIcaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('icares', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
        });

        // Insert some stuff
        DB::table('icares')->insert([
            ['name' => 'Social Justice'],
            ['name' => 'Fear Factor'],
            ['name' => 'Faith'],
            ['name' => 'Breakthrough']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('icares');
    }
}
