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
        Schema::table('penyata_pemungut_main', function (Blueprint $table) {
            $table->dateTime('tarikh_perbendaharaan')->after('tarikh_bayaran')->nullable()->comment('tarikh utk perbendaharaan');
            $table->integer('resit_perbendaharaan')->after('tarikh_perbendaharaan')->nullable()->comment('resit utk perbendaharaan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penyata_pemungut_main', function (Blueprint $table) {
            //
        });
    }
};
