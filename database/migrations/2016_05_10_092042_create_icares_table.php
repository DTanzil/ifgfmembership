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
            ['name' => 'Social Justice', 'email' => 'lianichristi@yahoo.com', 'day' => 'Tuesday', 'time' => '1110', 'description' => '{"phone":"","city":"Bandung","address":"Hypersquare Olivia Shannon Hair Studio","zipcode":"11111"}'],
            ['name' => 'Boanerges Reborn', 'email' => 'yudhi.saputra1505@gmail.com', 'day' => 'Tuesday', 'time' => '1110', 'description' => '{"phone":"","city":"Bandung","address":"Jl. Taman Rahayu 1","zipcode":"11111"}'],
            ['name' => 'Jesus On You', 'email' => 'taufik_hanata_louis@yahoo.com', 'day' => 'Tuesday', 'time' => '1140', 'description' => '{"phone":"","city":"Bandung","address":"Jl. Tampomas","zipcode":"11111"}'],
            ['name' => 'College Community', 'email' => 'kevin.theophilus@gmail.com', 'day' => 'Friday', 'time' => '1110', 'description' => '{"phone":"","city":"Bandung","address":"Cahaya Garuda Pasteur","zipcode":"11111"}']
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
