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
            $table->string('description');
            $table->integer('level');
            $table->integer('parent_ministry_id');
        });

        // Insert some stuff
        DB::table('ministries')->insert([
            ['parent_ministry_id' => '1', 'level' => '1', 'name' => 'Senior Pastor' ],
            ['parent_ministry_id' => '1', 'level' => '2', 'name' => 'iServe'],
            ['parent_ministry_id' => '2', 'level' => '3', 'name' => 'Event Management'],
            ['parent_ministry_id' => '3', 'level' => '4', 'name' => 'Finance'],
            ['parent_ministry_id' => '3', 'level' => '4', 'name' => 'Communication'],
            ['parent_ministry_id' => '3', 'level' => '4', 'name' => 'Worship Services'],
            ['parent_ministry_id' => '4', 'level' => '5', 'name' => 'Budgeting Controller'],
            ['parent_ministry_id' => '4', 'level' => '5', 'name' => 'Petty Cash Holder'],
            ['parent_ministry_id' => '5', 'level' => '5', 'name' => 'In House Production'],
            ['parent_ministry_id' => '5', 'level' => '5', 'name' => 'Marketing'], 


            ['parent_ministry_id' => '6', 'level' => '5', 'name' => 'Production'],
            ['parent_ministry_id' => '6', 'level' => '5', 'name' => 'Music'],
            ['parent_ministry_id' => '6', 'level' => '5', 'name' => 'Hospitality'],
            ['parent_ministry_id' => '6', 'level' => '5', 'name' => 'Props'],
            ['parent_ministry_id' => '6', 'level' => '5', 'name' => 'Tech'],
            ['parent_ministry_id' => '6', 'level' => '5', 'name' => 'Special Performance'],
            ['parent_ministry_id' => '6', 'level' => '5', 'name' => 'Sekretariat'],

            ['parent_ministry_id' => '9', 'level' => '6', 'name' => 'Video Producer'],
            ['parent_ministry_id' => '9', 'level' => '6', 'name' => 'Hard Copy Producer'],
            ['parent_ministry_id' => '9', 'level' => '6', 'name' => 'Script Writer'],
            ['parent_ministry_id' => '10', 'level' => '6', 'name' => 'Ticketing & Booth'],
            ['parent_ministry_id' => '10', 'level' => '6', 'name' => 'Sponsorship & Bazaar'],
            ['parent_ministry_id' => '10', 'level' => '6', 'name' => 'Advertisement'],
            ['parent_ministry_id' => '10', 'level' => '6', 'name' => 'Merchandise & Souvenir'],

            ['parent_ministry_id' => '11', 'level' => '6', 'name' => 'Service Quality Control'],
            ['parent_ministry_id' => '12', 'level' => '6', 'name' => 'Vocal'],
            ['parent_ministry_id' => '12', 'level' => '6', 'name' => 'Instrument'],
            ['parent_ministry_id' => '13', 'level' => '6', 'name' => 'Engage'],
            ['parent_ministry_id' => '13', 'level' => '6', 'name' => 'Parking'],
            ['parent_ministry_id' => '13', 'level' => '6', 'name' => 'Step 1'],
            ['parent_ministry_id' => '13', 'level' => '6', 'name' => 'Lobby'],
            ['parent_ministry_id' => '13', 'level' => '6', 'name' => 'Usher'],
            ['parent_ministry_id' => '13', 'level' => '6', 'name' => 'Nursery'],

            ['parent_ministry_id' => '14', 'level' => '6', 'name' => 'Seasonal'],
            ['parent_ministry_id' => '14', 'level' => '6', 'name' => 'Event Based'],
            ['parent_ministry_id' => '14', 'level' => '6', 'name' => "Prop's Inventory"],
            ['parent_ministry_id' => '15', 'level' => '6', 'name' => 'Sound'],
            ['parent_ministry_id' => '15', 'level' => '6', 'name' => 'Visual'],
            ['parent_ministry_id' => '15', 'level' => '6', 'name' => 'IFGF Asset Management'],

            ['parent_ministry_id' => '16', 'level' => '6', 'name' => 'Choir'],
            ['parent_ministry_id' => '16', 'level' => '6', 'name' => 'Performance Art'],
            ['parent_ministry_id' => '16', 'level' => '6', 'name' => 'Fashion Stylist'],
            ['parent_ministry_id' => '16', 'level' => '6', 'name' => 'Make Up & Hair Stylist'],

            ['parent_ministry_id' => '17', 'level' => '6', 'name' => 'Legal Medis Safety Security'],
            ['parent_ministry_id' => '17', 'level' => '6', 'name' => 'F&B Accomodation Transportation'],
            ['parent_ministry_id' => '17', 'level' => '6', 'name' => 'Lliason Officer'],

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
