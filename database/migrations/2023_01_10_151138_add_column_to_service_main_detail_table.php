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
        Schema::table('service_main_detail', function (Blueprint $table) {
            $table->integer('fk_category')->after('fk_service_main')->nullable();
            $table->integer('number')->after('fk_category')->nullable();
            $table->decimal('perpax',10,2)->after('number')->nullable();
            $table->decimal('total',10,2)->after('perpax')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_main_detail', function (Blueprint $table) {
            //
        });
    }
};
