<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstablishTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('establish', function (Blueprint $table) {
            $table->increments('id');           
            $table->string('name', 100);
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('establish')->insert([
            ['name' => 'Batch #1 - 2015'],
            // ['name' => 'Batch #2 - 2012'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('establish');
    }
}
