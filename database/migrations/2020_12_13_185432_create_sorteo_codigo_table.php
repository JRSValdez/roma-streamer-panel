<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSorteoCodigoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sorteo_codigo', function (Blueprint $table) {
            $table->bigIncrements('id_sorteo_codigo');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('codigo_id');
            $table->string('codigo');
            $table->string('id_free_fire');
            $table->string('nombre_free_fire');
            $table->string('servidor');
            $table->dateTime('fecha_canjeado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sorteo_codigo');
    }
}
