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
        Schema::table('agency_service', function (Blueprint $table) {
            $table->integer('userid')->after('fk_perkhidmatan')->nullable()->comment('User ID');
            $table->string('token')->after('userid')->nullable()->comment('Token to access API');
            $table->string('system_name')->after('token')->nullable()->comment('Nama Sistem');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agency_service', function (Blueprint $table) {
            //
        });
    }
};
