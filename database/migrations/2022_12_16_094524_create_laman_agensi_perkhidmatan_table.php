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
        Schema::create('laman_agensi_perkhidmatan', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_laman_agensi')->comment('Foreign Key laman_agensi')->nullable();
            $table->string('nama')->comment('Nama Perkhidmatan')->nullable();
            $table->string('url')->comment('full url with http:://')->nullable();
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
        Schema::dropIfExists('laman_agensi_perkhidmatan');
    }
};
