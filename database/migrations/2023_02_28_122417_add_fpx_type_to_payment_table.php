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
        Schema::table('payment', function (Blueprint $table) {
           $table->string('fpx_type')->after('status')->nullable()->comment('01 – B2C / 02 – B2B1 / 03 - B2B2');
           $table->string('card_type')->after('fpx_type')->nullable()->comment('1=Debit 2=Kredit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment', function (Blueprint $table) {
            //
        });
    }
};
