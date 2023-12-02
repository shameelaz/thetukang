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
        Schema::create('payer_bill_temp', function (Blueprint $table) {
            $table->id();

            $table->integer('fk_payer_account')->nullable()->comment('fk payer account.. boleh NULL untuk yg bayaran selain bil');
            $table->string('reference_no')->nullable()->comment('cth BIL001');
            $table->string('bill_detail')->nullable()->comment('cth Bil Air April 2022');
            $table->date('bill_date')->nullable()->comment('bill date');
            $table->date('bill_end_date')->nullable()->comment('bill end date');
            $table->integer('status')->nullable()->comment('default 0 sebab draft');

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
        Schema::dropIfExists('payer_bill_temp');
    }
};
