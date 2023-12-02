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
        Schema::table('payer_bill', function (Blueprint $table) {
            $table->string('account_no')->after('fk_payer_account')->nullable()->comment('Account no');
            $table->string('name')->after('account_no')->nullable()->comment('Nama Pembayar');
            $table->string('identification_no')->after('name')->nullable()->comment('No Pengenalan Pembayar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payer_bill', function (Blueprint $table) {
            //
        });
    }
};
