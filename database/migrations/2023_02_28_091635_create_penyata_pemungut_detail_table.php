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
        Schema::create('penyata_pemungut_detail', function (Blueprint $table) {
            $table->id();
            $table->string('fk_penyata_pemungut')->nullable()->comment('FK penyata pemungut');
            $table->string('receipt_no')->nullable()->comment('no resit');
            $table->string('kod_hasil')->nullable()->comment('payment_detail.kod_hasil');
            $table->string('perihal')->nullable()->comment('payment_detail.detail');
            $table->string('vott')->nullable()->comment('');
            $table->dateTime('tarikh')->nullable()->comment('payment.transaction_date ');
            $table->decimal('amaun',10,2)->nullable()->comment('payment_detail.amaun');
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
        Schema::dropIfExists('penyata_pemungut_detail');
    }
};
