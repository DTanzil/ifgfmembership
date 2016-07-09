<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('title');
            $table->string('type');
            $table->tinyInteger('priority');
            $table->tinyInteger('maxlimit'); //max number of people
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('members_roles')->insert([
            ['name' => 'Father', 'title' => 'father', 'type' => 'App\Family', 'priority' => '1', 'maxlimit' => '1'],
            ['name' => 'Mother', 'title' => 'mother', 'type' => 'App\Family', 'priority' => '1', 'maxlimit' => '1'],
            ['name' => 'Children', 'title' => 'children', 'type' => 'App\Family', 'priority' => '2', 'maxlimit' => '0'],
            ['name' => 'Facilitator', 'title' => 'facilitator', 'type' => 'App\Icare', 'priority' => '1', 'maxlimit' => '1'],
            ['name' => 'Cg Leader', 'title' => 'cg-leader', 'type' => 'App\Icare', 'priority' => '2', 'maxlimit' => '4'],
            ['name' => 'Core Teams', 'title' => 'core-teams', 'type' => 'App\Icare', 'priority' => '3', 'maxlimit' => '6'],
            ['name' => 'Member', 'title' => 'member', 'type' => 'App\Icare', 'priority' => '4', 'maxlimit' => '0']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('members_roles');
    }
}
