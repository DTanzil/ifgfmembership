<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('member_id');
            $table->string('description');
            $table->integer('group_id');
            $table->string('group_type');
        });

        // Insert some stuff
        DB::table('groups')->insert([
            ['title' => 'father', 'description' => '', 'group_type' => 'App\Family', 'member_id' => '1', 'group_id' => '1'],
            ['title' => 'mother', 'description' => '', 'group_type' => 'App\Family', 'member_id' => '4', 'group_id' => '2'],
            ['title' => 'facilitator', 'description' => '', 'group_type' => 'App\Icare', 'member_id' => '1', 'group_id' => '1'],
            ['title' => 'member', 'description' => '', 'group_type' => 'App\Icare', 'member_id' => '3', 'group_id' => '1'],
            ['title' => 'mother', 'description' => '', 'group_type' => 'App\Family', 'member_id' => '2', 'group_id' => '4'],
            ['title' => 'facilitator', 'description' => '', 'group_type' => 'App\Icare', 'member_id' => '1', 'group_id' => '2'],
            ['title' => 'core-teams', 'description' => '', 'group_type' => 'App\Icare', 'member_id' => '4', 'group_id' => '3'],
            ['title' => 'member', 'description' => '', 'group_type' => 'App\Ministry', 'member_id' => '1', 'group_id' => '2'],
            ['title' => 'member', 'description' => '', 'group_type' => 'App\Ministry', 'member_id' => '3', 'group_id' => '3'],
            ['title' => 'member', 'description' => '', 'group_type' => 'App\Ministry', 'member_id' => '2', 'group_id' => '4'],
            ['title' => 'member', 'description' => '', 'group_type' => 'App\Ministry', 'member_id' => '1', 'group_id' => '4'],

            ['title' => 'student', 'description' => 'Attending', 'group_type' => 'App\Engage', 'member_id' => '5', 'group_id' => '1'],
            ['title' => 'student', 'description' => 'Attending', 'group_type' => 'App\Engage', 'member_id' => '3', 'group_id' => '1'],
            ['title' => 'student', 'description' => 'Attending', 'group_type' => 'App\Engage', 'member_id' => '2', 'group_id' => '1'],
            ['title' => 'student', 'description' => 'Attending', 'group_type' => 'App\Engage', 'member_id' => '8', 'group_id' => '1'],
            ['title' => 'student', 'description' => 'Attending', 'group_type' => 'App\Engage', 'member_id' => '7', 'group_id' => '1'],
            ['title' => 'student', 'description' => 'Attending', 'group_type' => 'App\Engage', 'member_id' => '4', 'group_id' => '1'],
            ['title' => 'student', 'description' => 'Attending', 'group_type' => 'App\Engage', 'member_id' => '12', 'group_id' => '1'],

        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('groups');
    }
}
