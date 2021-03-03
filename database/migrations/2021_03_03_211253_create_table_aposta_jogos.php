<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableApostaJogos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aposta_jogos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aposta_id');
            $table->unsignedBigInteger('time1_id');
            $table->unsignedBigInteger('time2_id');
            $table->unsignedBigInteger('placar_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aposta_jogos');
    }
}
