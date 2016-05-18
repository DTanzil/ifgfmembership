<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('approles')->insert([
            ['name' => 'edit_family'],
            ['name' => 'add_family'],
            ['name' => 'delete_family'],
            ['name' => 'move_family'],
            ['name' => 'get_family']
             
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('approles');
    }
}
