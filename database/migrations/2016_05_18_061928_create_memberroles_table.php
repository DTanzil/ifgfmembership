<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberrolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberroles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('type');
            $table->integer('priority');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('memberroles')->insert([
            ['title' => 'father', 'type' => 'App\Family', 'priority' => '1'],
            ['title' => 'mother', 'type' => 'App\Family', 'priority' => '1'],
            ['title' => 'children', 'type' => 'App\Family', 'priority' => '2'],
            ['title' => 'teacher', 'type' => 'App\ICare', 'priority' => '1'],
            ['title' => 'student', 'type' => 'App\Family', 'priority' => '1']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('memberroles');
    }
}
