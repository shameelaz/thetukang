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
        Schema::table('kod_hasil', function (Blueprint $table) {
            $table->integer('type_rate')->after('type')->nullable()->comment('bila type == 2 kalo 1= 0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kod_hasil', function (Blueprint $table) {
            //
        });
    }
};
