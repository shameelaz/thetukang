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
        Schema::create('penyata_pemungut_main', function (Blueprint $table) {
            $table->id();
            $table->string('no_penyata_pemungut')->nullable()->comment('generate no penyata');
            $table->dateTime('tarikh_pp')->nullable()->comment('tarikh penyata pemungut');
            $table->dateTime('tarikh_bayaran')->nullable()->comment('tarikh payment');
            $table->integer('fk_agency')->nullable()->comment('FK agency');
            $table->integer('fk_ptj')->nullable()->comment('FK ptj');
            $table->decimal('jumlah_rm',10,2)->nullable()->comment('sum dari payment=total_amount');
            $table->decimal('jumlah_transaksi',10,2)->nullable()->comment('count dari payment detail=receipt_no');
            $table->integer('bank')->nullable()->comment('0=draf, 1=selesai');
            $table->integer('jenis_transaksi')->nullable()->comment('fpx online');
            $table->integer('penyedia')->nullable()->comment('dari table user');
            $table->integer('penyemak')->nullable()->comment('dari table user');
            $table->integer('pelulus')->nullable()->comment('dari table user');
            $table->integer('status')->nullable()->comment('0=draf 1=selesai ');
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
        Schema::dropIfExists('penyata_pemungut_main');
    }
};
