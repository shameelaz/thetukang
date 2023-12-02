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
        Schema::create('service_rate', function (Blueprint $table) {
            $table->id();
            $table->integer('service_rate_mgt')->nullable()->comment('Service rate Mgt Fk');
            $table->string('location')->nullable();
            $table->integer('category')->nullable()->comment('FK tetapan');
            $table->integer('unit')->nullable()->comment('Fk tetapan');
            $table->decimal('rate',10,2)->nullable()->comment('Kadar');
            $table->integer('status');
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
        Schema::dropIfExists('service_rate');
    }
};
