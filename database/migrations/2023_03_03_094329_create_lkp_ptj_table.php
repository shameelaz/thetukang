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
        Schema::create('lkp_ptj', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_agency')->nullable()->comment('FK agency');
            $table->string('ptj_name')->nullable()->comment('nama ptj');
            $table->string('ptj_code')->nullable()->comment('code ptj');
            $table->string('ptj_prefix')->nullable()->comment('prefix ptj');
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
        Schema::dropIfExists('lkp_ptj');
    }
};
