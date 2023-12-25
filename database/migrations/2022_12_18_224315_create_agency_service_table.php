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
        Schema::create('agency_service', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_agency')->nullable();
            $table->integer('fk_ptj')->nullable();
            $table->integer('fk_perkhidmatan')->nullable();
            $table->integer('service_type')->nullable();
            $table->string('url')->nullable();
            $table->integer('status')->nullable();
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
        Schema::table('agency_service', function (Blueprint $table) {
            //
        });
    }
};
