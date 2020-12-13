<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodigosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codigos', function (Blueprint $table) {
            $table->bigIncrements('id_codigo');
            $table->char('codigo', 50);
            $table->string('premio', 100);
            $table->integer('maximo_ganadores');
            $table->string('elegir_ganador');
            $table->char('estado', 1);
            $table->dateTime('fecha_creacion');
            $table->integer('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('codigos');
    }
}
