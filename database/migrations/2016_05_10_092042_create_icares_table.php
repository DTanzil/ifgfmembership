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
            $table->string('name');
            $table->string('email', 100);
            $table->enum('day', ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']);
            $table->smallInteger('time');
            $table->text('description');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('icares')->insert([
            ['name' => 'Inside Out', 'email' => 'billywahyudi@yahoo.com', 'day' => 'Tuesday', 'time' => '1110', 'description' => '{"phone":"","city":"Bandung","address":"Hypersquare (Olivia Shannon Hair Studio)","zipcode":""}'],
            ['name' => 'Faith Factor', 'email' => 'gracia.ruth92@gmail.com', 'day' => 'Wednesday', 'time' => '1140', 'description' => '{"phone":"","city":"Bandung","address":"Dago Pakar","zipcode":""}'],
            ['name' => 'Jesus On You', 'email' => 'taufik_hanata_louis@yahoo.com', 'day' => 'Tuesday', 'time' => '1140', 'description' => '{"phone":"","city":"Bandung","address":"Jl. Tampomas","zipcode":""}'],
            ['name' => 'College Community', 'email' => 'kevin.theophilus@gmail.com', 'day' => 'Friday', 'time' => '1110', 'description' => '{"phone":"","city":"Bandung","address":"Cahaya Garuda Pasteur","zipcode":""}']
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
