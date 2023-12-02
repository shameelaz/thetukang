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
        Schema::create('service_rate_mgt', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_agency')->nullable()->comment('fk agency');
            $table->integer('fk_ptj')->nullable()->comment('fk ptj');
            $table->integer('fk_lkp_perkhidmatan')->nullable()->comment('foreign key utk lkp perkhidmatan');
            $table->integer('fk_kod_hasil')->nullable()->comment('foreign key kod hasil');
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
        Schema::dropIfExists('service_rate_mgt');
    }
};
