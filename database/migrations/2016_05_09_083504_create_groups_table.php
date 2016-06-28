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
        // Schema::create('groups', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('title');
        //     $table->string('description');
        //     $table->integer('member_role_id');
        //     $table->integer('member_id');
            
        //     $table->integer('group_id');
        //     $table->string('group_type');
        //     $table->timestamps();
        // });

        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('member_id');
            $table->string('description');
            $table->integer('group_id');
            $table->string('group_type');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('groups')->insert([
            ['title' => 'father', 'group_type' => 'App\Family', 'member_id' => '1', 'group_id' => '1'],
            ['title' => 'mother', 'group_type' => 'App\Family', 'member_id' => '4', 'group_id' => '2'],
            ['title' => 'facilitator', 'group_type' => 'App\Icare', 'member_id' => '1', 'group_id' => '1'],
            ['title' => 'member', 'group_type' => 'App\Icare', 'member_id' => '3', 'group_id' => '1'],
            ['title' => 'mother', 'group_type' => 'App\Family', 'member_id' => '2', 'group_id' => '4'],
            ['title' => 'facilitator', 'group_type' => 'App\Icare', 'member_id' => '1', 'group_id' => '2'],
            ['title' => 'core-teams', 'group_type' => 'App\Icare', 'member_id' => '4', 'group_id' => '3'],
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
