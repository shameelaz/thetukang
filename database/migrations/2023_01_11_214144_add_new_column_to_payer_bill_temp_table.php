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
        Schema::table('payer_bill_temp', function (Blueprint $table) {
            $table->integer('fk_kod_hasil')->after('fk_ptj')->nullable()->comment('kod hasil');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payer_bill_temp', function (Blueprint $table) {
            //
        });
    }
};
