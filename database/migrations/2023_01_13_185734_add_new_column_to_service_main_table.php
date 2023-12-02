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
        Schema::table('service_main', function (Blueprint $table) {
            $table->integer('fk_payer_bill')->after('fk_payer')->nullable()->comment('Kalo null = bayar tiket/timbangan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_main', function (Blueprint $table) {
            //
        });
    }
};
