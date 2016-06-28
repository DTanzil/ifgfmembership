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
            $table->tinyInteger('priority');
            $table->tinyInteger('maxlimit'); //max number of people
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('memberroles')->insert([
            ['title' => 'father', 'type' => 'App\Family', 'priority' => '1', 'maxlimit' => '1'],
            ['title' => 'mother', 'type' => 'App\Family', 'priority' => '1', 'maxlimit' => '1'],
            ['title' => 'children', 'type' => 'App\Family', 'priority' => '2', 'maxlimit' => '0'],
            ['title' => 'facilitator', 'type' => 'App\Icare', 'priority' => '1', 'maxlimit' => '1'],
            ['title' => 'cg-leader', 'type' => 'App\Icare', 'priority' => '2', 'maxlimit' => '4'],
            ['title' => 'core-teams', 'type' => 'App\Icare', 'priority' => '3', 'maxlimit' => '6'],
            ['title' => 'member', 'type' => 'App\Icare', 'priority' => '4', 'maxlimit' => '0']
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
