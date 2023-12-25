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
        // table for bayaran service bukan lesen
        Schema::create('service_main', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_user')->nullable()->comment('Fk user can be null kalo bayaran tanpa login');
            $table->integer('fk_service_rate_mgt')->nullable()->comment('fk Service Rate Mgt');
            $table->integer('fk_kod_hasil')->nullable()->comment('fk kod hasil');
            $table->date('tarikh_lawatan')->nullable()->comment('tarikh tiket masuk ');
            $table->decimal('total',10,2)->nullable()->comment('total amount');
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
        Schema::dropIfExists('service_main');
    }
};
