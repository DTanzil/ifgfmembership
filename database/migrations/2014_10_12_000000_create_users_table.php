<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->rememberToken();
            $table->timestamps();
        });

         // Insert some stuff
        DB::table('users')->insert([
            ['name' => 'Dania', 'email' => 'daniat@uw.edu', 'password' => '$2y$10$cbaBF9z7P32mBsQv54vKn.6W4yDdSc31TN.eHKto6TNAk1n19bBk.'],
            ['name' => 'Bobo', 'email' => 'bobo@uw.edu', 'password' => '$2y$10$cbaBF9z7P32mBsQv54vKn.6W4yDdSc31TN.eHKto6TNAk1n19bBk.'],
            ['name' => 'Lolo', 'email' => 'lolo@uw.edu', 'password' => '$2y$10$cbaBF9z7P32mBsQv54vKn.6W4yDdSc31TN.eHKto6TNAk1n19bBk.']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
