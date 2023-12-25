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
        Schema::create('main_service', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_lkp_service_type')->nullable();
            $table->integer('fk_user')->nullable();
            $table->string('desc')->nullable();
            $table->integer('price')->nullable();
            $table->string('location')->nullable();
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
        Schema::dropIfExists('main_service');
    }
};
