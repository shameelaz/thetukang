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
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_main_service')->nullable();
            $table->integer('fk_user')->nullable();
            $table->string('title')->nullable();
            $table->string('desc')->nullable();
            $table->date('date_booking')->nullable();
            $table->integer('status')->nullable();
            $table->string('desc_handyman')->nullable();
            $table->date('date_booking_handyman')->nullable();
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
        Schema::dropIfExists('booking');
    }
};
