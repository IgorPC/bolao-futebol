<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUsuarioApostaAddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuario_aposta', function (Blueprint $table) {
            $table->foreign('aposta_id')->references('id')->on('apostas');
            $table->foreign('status_aposta_id')->references('id')->on('status_aposta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuario_aposta', function (Blueprint $table) {
            //
        });
    }
}
