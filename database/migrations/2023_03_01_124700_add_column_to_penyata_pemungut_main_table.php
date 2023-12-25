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
            $table->string('agency_code')->after('fk_ptj')->nullable()->comment('code dari agency');
            $table->string('ptj_code')->after('agency_code')->nullable()->comment('code dari ptj');

            $table->string('no_akaun')->after('jenis_transaksi')->nullable()->comment('no akaun ');

            $table->string('penyedia_name')->after('penyedia')->nullable()->comment('id penyedia dari table userprofile');
            $table->string('penyemak_name')->after('penyedia_name')->nullable()->comment('id penyemak dari table userprofile');
            $table->string('pelulus_name')->after('penyemak_name')->nullable()->comment('id pelulus dari table userprofile');

            $table->string('penyedia_position')->after('pelulus_name')->nullable()->comment('fkposition penyedia dari table userprofile');
            $table->string('penyemak_position')->after('penyedia_position')->nullable()->comment('fkposition penyemak dari table userprofile');
            $table->string('pelulus_position')->after('penyemak_position')->nullable()->comment('fkposition pelulus dari table userprofile');

            $table->date('penyedia_date')->after('pelulus_position')->nullable()->comment('tarikh waktu simpan dari penyata pemungut');
            $table->date('penyemak_date')->after('penyedia_date')->nullable()->comment('tarikh waktu simpan dari penyata pemungut');
            $table->date('pelulus_date')->after('penyemak_date')->nullable()->comment('tarikh waktu simpan dari penyata pemungut');

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
