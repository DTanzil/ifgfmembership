<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('member_id', 10)->unique()->nullable();
            $table->string('name');
            $table->string('email', 100);
            $table->enum('status', array_keys(Config::get('constants.MARITAL_STATUS')));            
            $table->enum('gender', array_keys(Config::get('constants.GENDER')));
            $table->date('birthdate')->nullable();
            $table->text('description');
            $table->boolean('is_member'); 
            $table->boolean('approve_member'); 
            $table->date('date_baptized')->nullable();
            $table->integer('date_joined')->nullable();
            $table->string('image');
            $table->string('qr_image');
            $table->enum('service', array_keys(Config::get('constants.IBADAH')));
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('members')->insert([
            ['member_id' => 'L120454', 'qr_image' => '88AE80A.png', 'approve_member' => 1, 'gender' => 'male', 'name' => 'Sammy Hartanto', 'email' => 'samhartanto@gmail.com'],
            ['member_id' => 'LE7F61B', 'qr_image' => '07A5559.png', 'approve_member' => 1, 'gender' => 'male', 'name' => 'Naf Hartanto', 'email' => 'bobo1@yahoo.com'],
            ['member_id' => 'L139785', 'qr_image' => '3422DBD.png', 'approve_member' => 1, 'gender' => 'male', 'name' => 'Jonathan Kasmin', 'email' =>  'jonathankasmin@gmail.com'],
            ['member_id' => 'L132R85', 'qr_image' => 'F45A5D1.png', 'approve_member' => 1, 'gender' => 'male', 'name' => 'Llano Feliciano', 'email' => 'lanofeliciano@gmail.com'],
            ['member_id' => 'P1NA250', 'qr_image' => 'D2B41C5.png', 'approve_member' => 1, 'gender' => 'female', 'name' => 'Liani Christi', 'email' => 'lianichristi@gmail.com'],
            ['member_id' => 'P83RY23', 'qr_image' => '64DA261.png', 'approve_member' => 1, 'gender' => 'female', 'name' => 'Angie Tanudjaja', 'email' => 'angie.tanudjaja@gmail.com'],
            ['member_id' => 'L3XA902', 'qr_image' => '837EFAC.png', 'approve_member' => 1, 'gender' => 'male', 'name' => 'Rocky Sudhanta', 'email' =>  'rockysudhanta@gmail.com'],
            ['member_id' => 'P82YI32', 'qr_image' => '8CDD582.png', 'approve_member' => 1, 'gender' => 'female', 'name' => 'Sariwati Goenawan', 'email' => 'sariwati@kayumanis.net'],    
            ['member_id' => 'P2BPR40', 'qr_image' => '96194C4.png', 'approve_member' => 0, 'gender' => 'female', 'name' => 'Queerin Prawinadewi', 'email' => 'aa@yahoo.com'],
            ['member_id' => 'P82A511', 'qr_image' => 'A5E07B4.png', 'approve_member' => 0, 'gender' => 'female', 'name' => 'Stefani K Dewi', 'email' => 'aa1@yahoo.com'],
            ['member_id' => 'P78890C', 'qr_image' => '7CDB316.png', 'approve_member' => 0, 'gender' => 'female', 'name' => 'Novita Setiawan', 'email' => 'aa2@yahoo.com'], 
            ['member_id' => 'L9D832A', 'qr_image' => '45ABDC2.png', 'approve_member' => 0, 'gender' => 'male', 'name' => 'Hendry Heryawan', 'email' => 'aa3@yahoo.com'],
            ['member_id' => 'L5RB902', 'qr_image' => 'B4D7742.png', 'approve_member' => 0, 'gender' => 'male', 'name' => 'Fredrick Fransjaya', 'email' =>  'aa4@yahoo.com'],
            ['member_id' => 'L1299F9', 'qr_image' => '1357E78.png', 'approve_member' => 0, 'gender' => 'male', 'name' => 'Asen', 'email' => 'asen.yeung@yahoo.com'],
            ['member_id' => 'P1O3573', 'qr_image' => 'DA5B4D8.png', 'approve_member' => 0, 'gender' => 'female', 'name' => 'Gracia Ruth', 'email' => 'gracia.ruth92@gmail.com'],
            ['member_id' => 'L3A41KL', 'qr_image' => '51E352E.png', 'approve_member' => 0, 'gender' => 'male', 'name' => 'Caka Mikael', 'email' => 'cakamikael@gmail.com'],
            ['member_id' => 'L8A91CB', 'qr_image' => 'B5C1C71.png', 'approve_member' => 0, 'gender' => 'male', 'name' => 'Billy Wahyudi', 'email' => 'billywahyudi@yahoo.com'],
            ['member_id' => 'PD82ANZ', 'qr_image' => '421FC1B.png', 'approve_member' => 0, 'gender' => 'female', 'name' => 'Michelle Natalia', 'email' => 'aa@gmail.com'],
            ['member_id' => 'P82HABN', 'qr_image' => 'F8B1286.png', 'approve_member' => 0, 'gender' => 'female', 'name' => 'Felicia Nathania', 'email' => 'a3a@gmail.com'],
            

            
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('members');
    }
}
