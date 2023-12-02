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
        Schema::create('payment_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_payment')->nullable()->comment('FK Payment');
            $table->integer('fk_troli')->nullable()->comment('FK troli');
            $table->integer('fk_payer')->nullable()->comment('FK payer');
            $table->integer('fk_lkp_perkhidmatan')->nullable()->comment('FK lkp perkhidmatan');
            $table->integer('fk_kod_hasil')->nullable()->comment('Untuk senangkan searching');
            $table->decimal('amount',10,2)->nullable()->comment('Amount ');
            $table->text('details')->nullable()->comment('Detail Bil/detail Lesen');
            $table->string('kod_hasil')->nullable()->comment('KOd Hasil string');
            $table->string('reference_no')->nullable()->comment('refer pada troli.type diwang wuz here 2023');
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
        Schema::dropIfExists('payment_detail');
    }
};
