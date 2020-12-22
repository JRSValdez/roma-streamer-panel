<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeyRuleta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sorteo_ruleta', function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('ruleta_id')->references('id')->on('roulette');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign('sorteo_ruleta_user_id_foreign');
        $table->dropForeign('sorteo_ruleta_ruleta_id_foreign');
    }
}
