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
        Schema::create('inbox', function (Blueprint $table) {
            $table->id();
            $table->integer('kepada')->nullable()->comment('user id kepada siapa');
            $table->integer('daripada')->nullable()->comment('user id daripada siapa default Sistem');
            $table->string('tajuk')->nullable()->comment('Title');
            $table->text('keterangan')->nullable()->comment('Keterangan inbox');
            $table->string('action')->nullable()->comment('kalo ada link untuk action');
            $table->integer('jenis')->nullable()->comment('Jenis message ');
            $table->integer('status')->nullable()->comment('1-read 0-unread null-unread');
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
        Schema::dropIfExists('inbox');
    }
};
