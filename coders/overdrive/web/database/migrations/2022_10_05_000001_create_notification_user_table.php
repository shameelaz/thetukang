<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_user', function (Blueprint $table) {
            $table->id()->comment = 'Unique id';
            $table->integer('fk_users')->nullable()->comment = 'foreign key, relation with table users';
            $table->string('url')->nullable()->comment = 'notification url';
            $table->string('content')->nullable()->comment = 'notification content';
            $table->smallInteger('status')->nullable()->comment = '0-inactive, 1-active';
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
        Schema::dropIfExists('notification_user');
    }
}
