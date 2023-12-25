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
        Schema::create('merchant_setup', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_agency')->nullable()->comment('FK agency');
            $table->integer('fk_ptj')->nullable()->comment('FK ptj');
            $table->integer('fk_lkp_bank')->nullable()->comment('FK lkp bank');
            $table->string('seller_id')->nullable()->comment('key in');
            $table->string('exchange_id')->nullable()->comment('key in');
            $table->string('merchant_id')->nullable()->comment('key in');
            $table->string('bank_name')->nullable()->comment('lkpbank.name');
            $table->string('bank_swift_code')->nullable()->comment('lkpbank.swiftcode');
            $table->string('bank_account_no')->nullable()->comment('key in');
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
        Schema::dropIfExists('merchant_setup');
    }
};
