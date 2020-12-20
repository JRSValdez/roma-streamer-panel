<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mensaje', function(Blueprint $table) {
            $table->foreign('user_id_envia')->references('id')->on('users');
        });

        Schema::table('codigos', function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('premio')->references('id_premio')->on('premio');
        });

        Schema::table('sorteo_codigo', function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('codigo_id')->references('id_codigo')->on('codigos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign('mensaje_user_id_envia_foreign');
        $table->dropForeign('codigos_user_id_foreign');
        $table->dropForeign('codigos_premio_foreign');
        $table->dropForeign('sorteo_codigo_user_id_foreign');
        $table->dropForeign('sorteo_codigo_codigo_id_foreign');
    }
}
