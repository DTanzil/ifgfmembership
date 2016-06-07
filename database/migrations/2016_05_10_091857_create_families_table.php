<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('families', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->text('description');
        });

        // Insert some stuff

        $info = '{"phone":"022-839281","city":"Bandung","address":"Jalan Kejaksaan XII no 8 Blok 3","zipcode":"32513"}';

        DB::table('families')->insert([
            ['name' => 'GNH', 'description' => $info],
            ['name' => 'Widodo Fam', 'description' => $info],
            ['name' => 'Danbo fam', 'description' => $info],
            ['name' => 'AHJIOJFh', 'description' => $info]
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('families');
    }
}
