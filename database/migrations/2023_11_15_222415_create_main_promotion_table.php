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
        Schema::create('main_promotion', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_user')->nullable();
            $table->integer('fk_main_service')->nullable();
            $table->integer('fk_booking')->nullable();
            $table->string('title')->nullable();
            $table->string('desc')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('main_promotion');
    }
};
