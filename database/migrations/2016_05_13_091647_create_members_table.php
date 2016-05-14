<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->string('name');
            $table->string('email', 100);
            $table->timestamps();
            $table->string('phone', 15);
            $table->enum('gender', ['Male', 'Female']);
            $table->date('birthdate');
            $table->enum('status', ['Single', 'Married']);
            $table->integer('family_id');
            // $table->integer('icare');   
            // $table->integer('ministry');
            $table->boolean('member');
            $table->string('address');
            // $table->string('city');

            // $table->string('classes');
            $table->date('date_baptized');
            $table->date('date_joined');
            $table->boolean('finish_engage');
            
            // roles, families, icares, ministry can be multiple so later
        });

        // Insert some stuff
        DB::table('members')->insert([
            ['name' => 'Anton', 'email' => 'aaaa@yahoo.com', 'gender' => 'Female', 'birthdate' => '1991-02-05'],
            ['name' => 'bobo', 'email' => 'bobo@yahoo.com', 'gender' => 'Male', 'birthdate' => '1988-12-05'],
            ['name' => 'Girang', 'email' => 'gg@yahoo.com', 'gender' => 'Male', 'birthdate' => '1988-12-05'],
            ['name' => 'Paul', 'email' => 'bobo@yahoo.com', 'gender' => 'Female', 'birthdate' => '1978-12-05'],
            ['name' => 'Orang', 'email' => 'bobo@yahoo.com', 'gender' => 'Male', 'birthdate' => '1948-12-05'],
            ['name' => 'Yeye', 'email' => 'bobo@yahoo.com', 'gender' => 'Female', 'birthdate' => '1938-12-05'],
            ['name' => 'Haha', 'email' => 'bobo@yahoo.com', 'gender' => 'Male', 'birthdate' => '1948-12-05']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('members');
    }
}
