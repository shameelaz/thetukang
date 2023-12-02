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
        Schema::create('kod_hasil', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_agency')->nullable();
            $table->integer('fk_ptj')->nullable();
            $table->integer('fk_perkhidmatan')->nullable();
            $table->string('name')->nullable();
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
        Schema::dropIfExists('kod_hasil');
    }
};
