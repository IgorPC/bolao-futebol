<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableApostaJogosAddStatusJogoIdAddForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aposta_jogos', function (Blueprint $table) {
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
        Schema::table('aposta_jogos', function (Blueprint $table) {
            //
        });
    }
}
