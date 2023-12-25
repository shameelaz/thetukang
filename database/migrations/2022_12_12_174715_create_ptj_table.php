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
        Schema::create('ptj', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_agency')->nullable();
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->string('prefix')->nullable();
            $table->string('seller_id')->nullable();
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
        Schema::dropIfExists('ptj');
    }
};
