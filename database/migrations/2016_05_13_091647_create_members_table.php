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
            $table->string('member_id', 10)->unique()->nullable();
            $table->string('name');
            $table->string('email', 100);
            $table->enum('status', array_keys(Config::get('constants.MARITAL_STATUS')));
            
            // $table->string('phone', 15);
            $table->enum('gender', array_keys(Config::get('constants.GENDER')));
            $table->date('birthdate')->nullable();
            $table->text('description');
            $table->boolean('is_member'); 
            $table->boolean('approve_member'); 
            // $table->integer('family_id');
            $table->date('date_baptized')->nullable();
            $table->integer('date_joined')->nullable();

            // $table->integer('icare');   
            // $table->integer('ministry');
            $table->string('image');
            $table->string('qr_image');
            // $table->boolean('is_engage'); 
            // $table->boolean('is_establish'); 
            // $table->boolean('is_empower'); 
            // $table->boolean('is_equip'); 

            // $table->string('city');
            $table->enum('service', array_keys(Config::get('constants.IBADAH')));
            // $table->string('classes');
            // $table->boolean('finish_engage');
            $table->timestamps();
            
            // roles, families, icares, ministry can be multiple so later
        });

        // Insert some stuff
        DB::table('members')->insert([
            ['name' => 'Anton', 'email' => 'aaaa@yahoo.com', 'gender' => 'female', 'birthdate' => '1991-02-05'],
            ['name' => 'Jiji', 'email' => 'bobo1@yahoo.com', 'gender' => 'male', 'birthdate' => '1988-12-05'],
            ['name' => 'Girang', 'email' => 'gg@yahoo.com', 'gender' => 'male', 'birthdate' => '1988-12-05'],
            ['name' => 'Paul', 'email' => 'bobo@yahoo.com', 'gender' => 'female', 'birthdate' => '1978-12-05'],
            ['name' => 'Nana', 'email' => 'bobo2@yahoo.com', 'gender' => 'male', 'birthdate' => '1948-12-05'],
            ['name' => 'Paul', 'email' => 'bobo3@yahoo.com', 'gender' => 'female', 'birthdate' => '1938-12-05'],
            ['name' => 'Luke', 'email' => 'bobo4@yahoo.com', 'gender' => 'male', 'birthdate' => '1948-12-05'],

            ['name' => 'Bob', 'email' => 'aa3aa@yahoo.com', 'gender' => 'female', 'birthdate' => '2007-02-05'],
            ['name' => 'Bil', 'email' => 'bobo21@yahoo.com', 'gender' => 'male', 'birthdate' => '2009-12-05'],
            ['name' => 'Xiang', 'email' => 'gg@yaho4o.com', 'gender' => 'male', 'birthdate' => '2007-12-05'],
            ['name' => 'Birdman', 'email' => 'bobo@yahooa.com', 'gender' => 'female', 'birthdate' => '2000-12-05'],
            ['name' => 'Spiderman', 'email' => 'bobo2@yaehoo.com', 'gender' => 'male', 'birthdate' => '2011-12-05'],
            ['name' => 'Iron Man', 'email' => 'bobo3@yah3oo.com', 'gender' => 'female', 'birthdate' => '2007-12-05'],
            ['name' => 'Piano Man', 'email' => 'bobo4@ya2hoo.com', 'gender' => 'male', 'birthdate' => '2010-12-05'],

            ['name' => 'Air Man', 'email' => 'aaaa@yahoo33.com', 'gender' => 'female', 'birthdate' => '2003-02-05'],
            ['name' => 'Super Duper', 'email' => 'bobo1@yah2doo.com', 'gender' => 'male', 'birthdate' => '2004-12-05'],
            ['name' => 'Dimo', 'email' => 'gg@yahoo.acom', 'gender' => 'male', 'birthdate' => '2002-12-05'],
            ['name' => 'Boboho', 'email' => 'bobo@yafvhoo.com', 'gender' => 'female', 'birthdate' => '2004-12-05'],
            ['name' => 'Harry', 'email' => 'bobo2@yavahoo.com', 'gender' => 'male', 'birthdate' => '2005-12-05'],
            ['name' => 'Ian', 'email' => 'bobo3@yaho3o.com', 'gender' => 'female', 'birthdate' => '2006-12-05'],
            ['name' => 'Sheila', 'email' => 'bobo4@y22ahoo.com', 'gender' => 'male', 'birthdate' => '2007-12-05'],
            
            ['name' => 'Dao Ming', 'email' => 'aaa4a@yahoo.com', 'gender' => 'female', 'birthdate' => '1991-02-05'],
            ['name' => 'Jie Xang', 'email' => 'b55obo1@yahoo.com', 'gender' => 'male', 'birthdate' => '1988-12-05'],
            ['name' => 'Grace', 'email' => 'ggsg@yahoo.com', 'gender' => 'male', 'birthdate' => '1988-12-05'],
            ['name' => 'Phelp', 'email' => 'bgrsobo@yahoo.com', 'gender' => 'female', 'birthdate' => '1978-12-05'],
            ['name' => 'Mince', 'email' => 'borrgbo2@yahoo.com', 'gender' => 'male', 'birthdate' => '1948-12-05'],
            ['name' => 'Myanko', 'email' => 'bokubo3@yahoo.com', 'gender' => 'female', 'birthdate' => '1938-12-05'],
            ['name' => 'Roki', 'email' => 'bobow44@yahoo.com', 'gender' => 'male', 'birthdate' => '1948-12-05']
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
