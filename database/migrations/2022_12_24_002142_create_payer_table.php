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
        Schema::create('payer', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_agency')->nullable()->comment('fk agency can be null');
            $table->integer('fk_ptj')->nullable()->comment('fk Ptj ');
            $table->string('name')->nullable()->comment('Nama');
            $table->string('account_no')->nullable()->comment('No Akaun');
            $table->string('identification_no')->nullable()->comment('ic/no tentera/polis');
            $table->text('adrress')->nullable()->comment('Full address include no,jalan or taman');
            $table->string('city')->nullable()->comment('Free text city');
            $table->integer('state')->nullable()->comment('fk lkp_state negeri default be malaysia');
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
        Schema::dropIfExists('payer');
    }
};
