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
            ['name' => 'IFGF Admin', 'email' => 'admin@ifgfbandung.org', 'password' => '$2y$10$5Dd//i8d3I8rNAIpf7kBTukmgsyhzHR9vg9lOHKAeHJYAhfmgz27u'],
            ['name' => 'IFGF Kids', 'email' => 'kids@ifgfbandung.org', 'password' => '$2y$10$5Dd//i8d3I8rNAIpf7kBTukmgsyhzHR9vg9lOHKAeHJYAhfmgz27u'],
            ['name' => 'Jonathan Kasmin', 'email' => 'jonathankasmin@gmail.com', 'password' => '$2y$10$5Dd//i8d3I8rNAIpf7kBTukmgsyhzHR9vg9lOHKAeHJYAhfmgz27u'],
            ['name' => 'Sam Hartanto', 'email' => 'samhartanto@gmail.com', 'password' => '$2y$10$5Dd//i8d3I8rNAIpf7kBTukmgsyhzHR9vg9lOHKAeHJYAhfmgz27u'],
            ['name' => 'Sandy Harsono', 'email' => 'sandyharsono@gmail.com', 'password' => '$2y$10$5Dd//i8d3I8rNAIpf7kBTukmgsyhzHR9vg9lOHKAeHJYAhfmgz27u'],
            ['name' => 'Max Thenu', 'email' => 'maxthenu@yahoo.com', 'password' => '$2y$10$5Dd//i8d3I8rNAIpf7kBTukmgsyhzHR9vg9lOHKAeHJYAhfmgz27u']            
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
