<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSorteoRuletaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sorteo_ruleta', function (Blueprint $table) {
            $table->bigIncrements('id_sorteo_ruleta');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ruleta_id');
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
        Schema::dropIfExists('sorteo_ruleta');
    }
}
