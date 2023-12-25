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
            $table->string('catatan')->after('bill_end_date')->nullable()->comment('if status=3 , kena letak catatan');
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
