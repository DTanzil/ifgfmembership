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
            
          
            $table->timestamps();
            $table->string('name');
            $table->string('description');
            $table->integer('parent_group_id');
            $table->date('date_start');
            // $table->date('date_end');
            $table->enum('type', ['family', 'icare', 'ministry']);
            
            // roles, families, icares, ministry can be multiple so later


        });
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
