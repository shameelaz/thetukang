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
        Schema::table('agency', function (Blueprint $table) {
            $table->text('add')->after('code')->comment('alamat agensi')->nullable();
            $table->string('phone_no')->after('add')->comment('no utk dihubungi')->nullable();
            $table->string('email')->after('phone_no')->comment('email agensi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agency', function (Blueprint $table) {
            //
        });
    }
};
