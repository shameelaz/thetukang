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
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_payment_gateway')->nullable()->comment('FK Payment Gateway');
            $table->integer('fk_user')->nullable()->comment('FK User');
            $table->string('transaction_no')->nullable()->comment('Transaction NO sistem create');
            $table->string('transaction_id')->nullable()->comment('Trans id -return dari FPX');
            $table->dateTime('transaction_date')->nullable()->comment('Trans Date FRom FPX');
            $table->decimal('total_amount',10,2)->nullable()->comment('Total amount dari payment detail');
            $table->integer('status')->nullable()->comment('0=NEW 1=SUCESS 2=FAILED 3-PENDINGB2B');
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
        Schema::dropIfExists('payment');
    }
};
