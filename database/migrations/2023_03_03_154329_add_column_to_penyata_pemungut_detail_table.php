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
        Schema::table('penyata_pemungut_detail', function (Blueprint $table) {
            $table->integer('fk_payment')->after('fk_penyata_pemungut')->nullable()->comment('fk payment nya id');
            $table->integer('fk_payment_detail')->after('fk_payment')->nullable()->comment('fk payment detail nya id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penyata_pemungut_detail', function (Blueprint $table) {
            //
        });
    }
};
