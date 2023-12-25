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
        Schema::table('laman_agensi_perkhidmatan_dalaman', function (Blueprint $table) {
            $table->integer('fk_lkp_perkhidmatan')->after('fk_laman_agensi')->nullable()->comment('lkp_perkhidmatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laman_agensi_perkhidmatan_dalaman', function (Blueprint $table) {
            //
        });
    }
};
