<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->text('site_name')->nullable(false);
            $table->text('site_desc')->nullable(false);
            $table->text('site_img')->nullable(false);
            $table->json('roulette')->nullable();
            $table->json('polls')->nullable();
            $table->json('codes')->nullable();
            $table->json('messages')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config');
    }
}
