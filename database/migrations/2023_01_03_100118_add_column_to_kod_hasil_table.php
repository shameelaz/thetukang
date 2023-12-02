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
        Schema::table('kod_hasil', function (Blueprint $table) {
            $table->integer('type')->after('reference_name')->nullable()->comment('Jenis Bayaran 1-Bil 2-Kadar Bayaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kod_hasil', function (Blueprint $table) {
            //
        });
    }
};
