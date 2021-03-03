<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableApostaJogosAddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aposta_jogos', function (Blueprint $table) {
            $table->foreign('aposta_id')->references('id')->on('apostas');
            $table->foreign('time1_id')->references('id')->on('times');
            $table->foreign('time2_id')->references('id')->on('times');
            $table->foreign('placar_id')->references('id')->on('placar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aposta_jogos', function (Blueprint $table) {
            //
        });
    }
}
