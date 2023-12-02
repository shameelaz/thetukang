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
        Schema::create('feedback_form', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_agency')->nullable()->comment('foreign key agency');
            $table->string('name')->nullable()->comment('nama pelanggan');
            $table->string('email')->nullable()->comment('email pelanggan');
            $table->string('subject')->nullable()->comment('subjek emel');
            $table->text('message')->nullable()->comment('komen pelanggan');
            $table->integer('status')->nullable()->comment('status email 1-hantar 0-belum');
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
        Schema::dropIfExists('feedback_form');
    }
};
