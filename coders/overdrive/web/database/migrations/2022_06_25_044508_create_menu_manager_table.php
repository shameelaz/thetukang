<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenuManagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_bm');
            $table->string('name_en');
            $table->integer('type')->nullable()->comment = '1=sub,2=parent';
            $table->string('parent_id')->nullable();
            $table->string('route')->nullable();
            $table->string('permission')->nullable();
            $table->text('icon')->nullable();
            $table->integer('order');
            $table->integer('status');
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
        Schema::drop('menu');
    }
}
