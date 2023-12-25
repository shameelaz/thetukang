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
        Schema::create('lkp_kod_hasil', function (Blueprint $table) {
            $table->id();
            $table->string('kod_hasil')->nullable()->comment('kod_hasil');
            $table->string('description')->nullable()->comment('description');
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
        Schema::table('lkp_kod_hasil', function (Blueprint $table) {
            //
        });
    }
};
