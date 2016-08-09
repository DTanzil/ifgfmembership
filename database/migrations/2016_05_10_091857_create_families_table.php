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

        // $info = '{"phone":"022-839281","city":"Bandung","address":"Jalan Kejaksaan XII no 8 Blok 3","zipcode":"32513"}';

        $info = '{"phone":"","city":"Bandung","address":"","zipcode":""}';

        DB::table('families')->insert([
            ['name' => 'Sam Hartanto', 'description' => $info],
            // ['name' => 'Widodo', 'description' => $info],
            // ['name' => 'Hartanto', 'description' => $info],
            // ['name' => 'Sutanto', 'description' => $info]
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
