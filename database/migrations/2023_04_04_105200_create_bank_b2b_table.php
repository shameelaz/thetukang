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
        Schema::create('bank_b2b', function (Blueprint $table) {
            $table->id();
            $table->string('bank_id')->nullable()->comment('BANK ID');
            $table->string('bank_name')->nullable()->comment('BANK NAME');
            $table->string('display_name')->nullable()->comment('DISPLAY NAME');
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
        Schema::dropIfExists('bank_b2b');
    }
};
