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
            $table->integer('member_id')->index();
            $table->string('name');
            $table->string('email', 100);
            $table->enum('status', ['single', 'married']);
            
            // $table->string('phone', 15);
            $table->enum('gender', ['male', 'female']);
            $table->date('birthdate');
            $table->text('description');
            $table->boolean('is_member');            
            $table->integer('family_id');
            $table->date('date_baptized');
            $table->date('date_joined');

            // $table->integer('icare');   
            // $table->integer('ministry');
            $table->string('image');
            // $table->string('city');

            // $table->string('classes');
            // $table->boolean('finish_engage');
            $table->timestamps();
            
            // roles, families, icares, ministry can be multiple so later
        });

        // Insert some stuff
        DB::table('members')->insert([
            ['name' => 'Anton', 'email' => 'aaaa@yahoo.com', 'gender' => 'female', 'birthdate' => '1991-02-05'],
            ['name' => 'bobo', 'email' => 'bobo1@yahoo.com', 'gender' => 'male', 'birthdate' => '1988-12-05'],
            ['name' => 'Girang', 'email' => 'gg@yahoo.com', 'gender' => 'male', 'birthdate' => '1988-12-05'],
            ['name' => 'Paul', 'email' => 'bobo@yahoo.com', 'gender' => 'female', 'birthdate' => '1978-12-05'],
            ['name' => 'Orang', 'email' => 'bobo2@yahoo.com', 'gender' => 'male', 'birthdate' => '1948-12-05'],
            ['name' => 'Yeye', 'email' => 'bobo3@yahoo.com', 'gender' => 'female', 'birthdate' => '1938-12-05'],
            ['name' => 'Haha', 'email' => 'bobo4@yahoo.com', 'gender' => 'male', 'birthdate' => '1948-12-05']
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
