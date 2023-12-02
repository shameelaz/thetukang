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
        Schema::create('troli', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_payer_bill')->nullable()->comment('fk payer_bill');
            $table->integer('fk_user')->nullable()->comment('kalo null user tanpa login');
            $table->integer('type')->nullable()->comment('1- bill 2- service/tiket wajib ada ni');
            $table->integer('fk_service')->nullable()->comment('fk service');
            $table->integer('fk_payer')->nullable()->comment('data pembayar');
            $table->decimal('total_amount')->nullable()->comment('total bayaran');
            $table->integer('status')->nullable()->comment('0-troli 1-ready payment 2-paid');
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
        Schema::dropIfExists('troli');
    }
};
