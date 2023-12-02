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
            $table->integer('fk_agency')->after('id')->nullable()->comment('Fk Agency foreign key');
            $table->integer('fk_ptj')->after('fk_agency')->nullable()->comment('Fk PTJ foreign key');
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
