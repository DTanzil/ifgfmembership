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
            ['title' => 'mother', 'description' => '', 'group_type' => 'App\Family', 'member_id' => '2', 'group_id' => '1'],
            ['title' => 'head-department', 'description' => '', 'group_type' => 'App\Ministry', 'member_id' => '1', 'group_id' => '1'],
            ['title' => 'member', 'description' => '', 'group_type' => 'App\Ministry', 'member_id' => '3', 'group_id' => '2'],            
            ['title' => 'member', 'description' => '', 'group_type' => 'App\Ministry', 'member_id' => '5', 'group_id' => '26'],
            ['title' => 'member', 'description' => '', 'group_type' => 'App\Ministry', 'member_id' => '15', 'group_id' => '26'],
            ['title' => 'member', 'description' => '', 'group_type' => 'App\Ministry', 'member_id' => '16', 'group_id' => '29'],
            ['title' => 'student', 'description' => 'Not Graduated', 'group_type' => 'App\Engage', 'member_id' => '9', 'group_id' => '1'],
            ['title' => 'student', 'description' => 'Not Graduated', 'group_type' => 'App\Engage', 'member_id' => '10', 'group_id' => '1'],
            ['title' => 'student', 'description' => 'Graduated', 'group_type' => 'App\Engage', 'member_id' => '11', 'group_id' => '1'],
            ['title' => 'student', 'description' => 'Not Graduated', 'group_type' => 'App\Engage', 'member_id' => '12', 'group_id' => '1'],
            ['title' => 'student', 'description' => 'Graduated', 'group_type' => 'App\Engage', 'member_id' => '13', 'group_id' => '1'],
            ['title' => 'student', 'description' => 'Graduated', 'group_type' => 'App\Engage', 'member_id' => '14', 'group_id' => '1'],


            ['title' => 'facilitator', 'description' => '', 'group_type' => 'App\Icare', 'member_id' => '5', 'group_id' => '1'],
            ['title' => 'facilitator', 'description' => '', 'group_type' => 'App\Icare', 'member_id' => '5', 'group_id' => '2'],
            ['title' => 'core-teams', 'description' => '', 'group_type' => 'App\Icare', 'member_id' => '17', 'group_id' => '1'],
            ['title' => 'core-teams', 'description' => '', 'group_type' => 'App\Icare', 'member_id' => '15', 'group_id' => '2'],
            ['title' => 'core-teams', 'description' => '', 'group_type' => 'App\Icare', 'member_id' => '18', 'group_id' => '2'],
            ['title' => 'member', 'description' => '', 'group_type' => 'App\Icare', 'member_id' => '19', 'group_id' => '2'],
            ['title' => 'core-teams', 'description' => '', 'group_type' => 'App\Icare', 'member_id' => '16', 'group_id' => '4'],


            // ['title' => 'mother', 'description' => '', 'group_type' => 'App\Family', 'member_id' => '2', 'group_id' => '4'],
            // ['title' => 'facilitator', 'description' => '', 'group_type' => 'App\Icare', 'member_id' => '1', 'group_id' => '2'],
            
            // ['title' => 'student', 'description' => 'Not Graduated', 'group_type' => 'App\Establish', 'member_id' => '3', 'group_id' => '1'],
            // ['title' => 'student', 'description' => 'Not Graduated', 'group_type' => 'App\Establish', 'member_id' => '1', 'group_id' => '1'],
            // ['title' => 'student', 'description' => 'Not Graduated', 'group_type' => 'App\Establish', 'member_id' => '6', 'group_id' => '1'],
            // ['title' => 'student', 'description' => 'Not Graduated', 'group_type' => 'App\Establish', 'member_id' => '4', 'group_id' => '1'],
            // ['title' => 'children', 'description' => '', 'group_type' => 'App\Family', 'member_id' => '7', 'group_id' => '3'],
            // ['title' => 'children', 'description' => '', 'group_type' => 'App\Family', 'member_id' => '7', 'group_id' => '1'],
            // ['title' => 'children', 'description' => '', 'group_type' => 'App\Family', 'member_id' => '7', 'group_id' => '8'],
            // ['title' => 'mother', 'description' => '', 'group_type' => 'App\Family', 'member_id' => '7', 'group_id' => '4'],
            // ['title' => 'father', 'description' => '', 'group_type' => 'App\Family', 'member_id' => '7', 'group_id' => '5'],


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
