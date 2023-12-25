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
        Schema::create('panduan_pdf', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_agensi')->nullable()->comment('fk agensi');
            $table->integer('fk_perkhidmatan')->nullable()->comment('fk perkhidmatan from lkp perkhidmatan');
            $table->string('fail')->nullable()->comment('full path pdf');
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
        Schema::dropIfExists('panduan_pdf');
    }
};
