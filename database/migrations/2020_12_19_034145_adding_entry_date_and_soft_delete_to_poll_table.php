<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddingEntryDateAndSoftDeleteToPollTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poll', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('poll', function (Blueprint $table) {
            $table->dateTime("entry_date")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('poll', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('poll', function (Blueprint $table) {
            $table->dateTime("entry_date");
        });
    }
}
