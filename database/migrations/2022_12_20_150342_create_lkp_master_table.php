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
        Schema::create('lkp_master', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_lkp_master_type')->nullable()->comment('fk lkp master');
            $table->string('description')->nullable()->comment('Nama Lkp Master type');
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
        Schema::dropIfExists('lkp_master');
    }
};
