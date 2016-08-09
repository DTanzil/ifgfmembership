<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equip', function (Blueprint $table) {
            $table->increments('id');           
            $table->string('name', 100);
            $table->timestamps();
        });

        // Insert some stuff
        // DB::table('equip')->insert([
        //     ['name' => 'Batch Equip #1 - 2013'],
        //     ['name' => 'Batch Equip #2 - 2012'],
        // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('equip');
    }
}
