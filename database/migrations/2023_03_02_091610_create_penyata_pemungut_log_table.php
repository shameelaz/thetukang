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
        Schema::create('penyata_pemungut_log', function (Blueprint $table) {
            $table->id();
            $table->string('fk_penyata_pemungut')->nullable()->comment('key table ppm');
            $table->string('file_name')->nullable()->comment('generated filename');
            $table->string('header')->nullable()->comment('generated header');
            $table->longText('body')->nullable()->comment('generated body');
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
        Schema::dropIfExists('penyata_pemungut_main');
    }
};
