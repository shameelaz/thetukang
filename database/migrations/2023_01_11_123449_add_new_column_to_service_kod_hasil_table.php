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
        Schema::table('service_kod_hasil', function (Blueprint $table) {
            $table->integer('fk_agency')->after('id')->nullable();
            $table->integer('fk_ptj')->after('fk_agency')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_kod_hasil', function (Blueprint $table) {
            //
        });
    }
};
