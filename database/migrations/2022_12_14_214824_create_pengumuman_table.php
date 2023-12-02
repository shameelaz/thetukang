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
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_user')->comment('User yang add/kemaskini')->nullable();
            $table->string('tajuk')->comment('Tajuk Pengumuman')->nullable();
            $table->string('penerangan')->comment('Penerangan Banner')->nullable();
            $table->string('url')->nullable();
            $table->string('image')->nullable();
            $table->date('tarikh_mula')->nullable();
            $table->date('tarikh_tamat')->nullable();
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
        Schema::dropIfExists('pengumuman');
    }
};
