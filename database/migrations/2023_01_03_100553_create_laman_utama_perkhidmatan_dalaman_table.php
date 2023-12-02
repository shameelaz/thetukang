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
        Schema::create('laman_utama_perkhidmatan_dalaman', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_kod_hasil')->nullable()->comment('fk kod');
            $table->integer('status')->nullable()->comment('status kadaran');
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
        Schema::dropIfExists('laman_utama_perkhidmatan_dalaman');
    }
};
