<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableApostaJogosAddStatusJogoId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aposta_jogos', function (Blueprint $table) {
            $table->unsignedBigInteger('status_jogo_id')->default(1);
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
