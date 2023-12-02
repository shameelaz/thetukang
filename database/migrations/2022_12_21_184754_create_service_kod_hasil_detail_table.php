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
        Schema::create('service_kod_hasil_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_service_kod_hasil')->nullable()->comment('foreign key service_kod_hasil');
            $table->integer('fk_kod_hasil')->nullable()->comment('foreign key kod_hasil');
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
        Schema::dropIfExists('service_kod_hasil_detail');
    }
};
