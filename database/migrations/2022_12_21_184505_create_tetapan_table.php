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
        Schema::create('tetapan', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_agency')->nullable()->comment('foreign key agensi');
            $table->integer('fk_ptj')->nullable()->comment('foreign key ptj');
            $table->integer('fk_lkp_perkhidmatan')->nullable()->comment('foreign key perkhidmatan');
            $table->integer('jenis')->nullable()->comment('foreign key lkp_master');
            $table->string('description')->nullable()->comment('nama tetapan');
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('tetapan');
    }
};
