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
        Schema::create('laman_agensi', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_agency')->comment('FK for agency')->nullable();
            $table->text('keterangan')->comment('full description')->nullable();
            $table->string('logo_agensi')->comment('Logo agensi')->nullable();
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
        Schema::dropIfExists('laman_agensi');
    }
};
