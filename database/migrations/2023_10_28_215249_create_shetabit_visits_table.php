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
        Schema::create('shetabit_visits', function (Blueprint $table) {
            $table->id();
            $table->string('method')->nullable();
            $table->string('request')->nullable();
            $table->string('url')->nullable();
            $table->string('referer')->nullable();
            $table->string('languages')->nullable();
            $table->string('useragent')->nullable();
            $table->string('headers')->nullable();
            $table->string('device')->nullable();
            $table->string('platform')->nullable();
            $table->string('browser')->nullable();
            $table->string('ip')->nullable();
            $table->string('visitor_id')->nullable();
            $table->string('visitor_type')->nullable();
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
        Schema::dropIfExists('shetabit_visits');
    }
};
