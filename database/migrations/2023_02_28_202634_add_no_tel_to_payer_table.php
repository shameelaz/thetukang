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
        Schema::table('payer', function (Blueprint $table) 
        {
            //
            $table->string('no_tel', 15)->after('identification_no')->nullable()->comment('No telefon');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payer', function (Blueprint $table) 
        {
            //
        });
    }
};
