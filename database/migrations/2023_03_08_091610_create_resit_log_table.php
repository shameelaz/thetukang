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
        Schema::create('resit_perbendaharaan_log', function (Blueprint $table) {
            $table->id();
            $table->string('file_name')->nullable()->comment('generated filename');
            $table->string('header')->nullable()->comment('generated header');
            $table->longText('body')->nullable()->comment('generated body');
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
        Schema::dropIfExists('resit_perbendaharaan_log');
    }
};
