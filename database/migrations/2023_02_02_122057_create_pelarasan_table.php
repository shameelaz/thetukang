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
        Schema::create('pelarasan', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_agency')->nullable()->comment('FK agency');
            $table->integer('fk_ptj')->nullable()->comment('FK ptj');
            $table->integer('fk_lkp_perkhidmatan')->nullable()->comment('FK lkp perkhidmatan');
            $table->integer('no_penyata_pemungut')->nullable()->comment('nombor penyata pemungut');
            $table->string('receipt_no')->nullable()->comment('no resit');
            $table->string('kod_hasil_lama')->nullable()->comment('kod hasil lama');
            $table->string('kod_hasil_baru')->nullable()->comment('kod hasil baru');
            $table->dateTime('tarikh_pelarasan')->nullable()->comment('tarikh pelarasan ');
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
        Schema::dropIfExists('pelarasan');
    }
};
