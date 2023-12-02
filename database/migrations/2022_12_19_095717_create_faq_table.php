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
        Schema::create('faq', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_agency')->nullable()->comment('fk_agency');
            $table->integer('fk_perkhidmatan')->nullable()->comment('fk_perkhidmatan');
            $table->string('soalan_ms')->nullable()->comment('Soalan MS');
            $table->string('soalan_en')->nullable()->comment('Soalan EN');
            $table->text('jawapan_ms')->nullable()->comment('Jawapan MS');
            $table->text('jawapan_en')->nullable()->comment('Jawapan EN');
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
        Schema::dropIfExists('faq');
    }
};
