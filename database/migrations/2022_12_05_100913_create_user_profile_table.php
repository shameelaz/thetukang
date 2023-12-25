<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profile', function (Blueprint $table) {

            /***************************************
                user_level = 1-staff 2-pengguna
                flag_ptj = 1-admin ptj 0/NULL = not admin
                user_type = 1-individu 2-company
                ref_type = 1-no ic , 2-passport 3-tentera/polis
                refid = txt ic/tentera/polis/passport
                ref_name = nama wakil syarikat
                mobile_phone = mobile phone no
                add = add 1
                add2 = add 2
                postcode = postcode 
                city = city
                state = lkp_state

            **************************************/
            $table->id();
            $table->integer('fk_users')->nullable(); //ref_user
            $table->integer('user_level')->nullable(); //user level 1-staff 2-pengguna
            $table->integer('flag_ptj')->nullable(); //flag for admin ptj
            $table->integer('user_type')->nullable(); //jenis user 1-ind 2-comp
            $table->integer('ref_type')->nullable(); // jenis pengenalan 1-ic 2-pasport 3-tentera/polis
            $table->string('refid')->nullable(); // text pengenalan ic
            $table->string('ref_name')->nullable(); // nama wakil syarikat
            $table->string('mobile_no')->nullable(); // mobile-phone
            $table->string('add1')->nullable(); // add1
            $table->string('add2')->nullable(); // add2
            $table->integer('postcode')->nullable(); //postcode
            $table->string('city')->nullable(); //city
            $table->integer('state')->nullable(); //state
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profile');
    }
};
