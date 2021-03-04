<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioApostaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_aposta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aposta_id');
            $table->longText('aposta');
            $table->string('nome_usuario');
            $table->double('valor');
            $table->boolean('pago')->nullable();
            $table->unsignedBigInteger('status_aposta_id');
            $table->string('hash');
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
        Schema::dropIfExists('usuario_aposta');
    }
}
