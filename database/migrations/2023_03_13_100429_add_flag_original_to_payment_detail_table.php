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
        Schema::table('payment_detail', function (Blueprint $table) 
        {
            $table->integer('flag_original')->after('receipt_no')->nullable()->comment('1=Original, 2=copy');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_detail', function (Blueprint $table) {
            //
        });
    }
};
