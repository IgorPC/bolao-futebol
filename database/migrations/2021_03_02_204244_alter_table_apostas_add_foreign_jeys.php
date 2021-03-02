<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableApostasAddForeignJeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apostas', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('status_jogo_id')->references('id')->on('status_jogo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apostas', function (Blueprint $table) {
            //
        });
    }
}
