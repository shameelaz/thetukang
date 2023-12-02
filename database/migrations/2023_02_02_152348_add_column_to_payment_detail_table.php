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
        Schema::table('payment_detail', function (Blueprint $table) {
            $table->string('receipt_no')->after('reference_no')->nullable()->comment('No resit dari payment detail');
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
