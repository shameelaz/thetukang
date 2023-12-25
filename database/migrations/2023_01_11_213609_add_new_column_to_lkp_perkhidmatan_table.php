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
        Schema::table('lkp_perkhidmatan', function (Blueprint $table) {
            $table->integer('type')->after('status')->nullable()->comment('Jenis Bayaran 1-Bil 2-Kadar Bayaran');
            $table->integer('type_rate')->after('type')->nullable()->comment('bila type 2, 1=tiket 2=timbangan ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lkp_perkhidmatan', function (Blueprint $table) {
            //
        });
    }
};
