<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMinistriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ministries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->tinyInteger('level');
            $table->integer('parent_ministry_id');
            $table->string('leader');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('ministries')->insert([
            ['name' => 'Senior Pastor', 'parent_ministry_id' => '0', 'level' => '1'],
            ['name' => 'iServe', 'parent_ministry_id' => '1', 'level' => '2'],
            ['name' => 'Event Management', 'parent_ministry_id' => '2', 'level' => '3'],
            ['name' => 'Finance', 'parent_ministry_id' => '3', 'level' => '4'],
            ['name' => 'Communication', 'parent_ministry_id' => '3', 'level' => '4'],
            ['name' => 'Worship Services', 'parent_ministry_id' => '3', 'level' => '4'],
            ['name' => 'Marketing', 'parent_ministry_id' => '5', 'level' => '5'],            
            ['name' => 'Merchandise & Souvenir', 'parent_ministry_id' => '7', 'level' => '6'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ministries');
    }
}
