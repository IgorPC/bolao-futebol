<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApostaJogos extends Model
{
    use HasFactory;

    protected $table = 'aposta_jogos';
    protected $fillable = ['aposta_id', 'time1_id', 'time2_id', 'status_jogo_id'];
    public $timestamps = true;

    public function getJogosBolao(Aposta $aposta)
    {
        $query = $this->query();

        $data = $query -> leftJoin('apostas', 'aposta_jogos.aposta_id', '=', 'apostas.id')
                       -> leftJoin('times as time1', 'aposta_jogos.time1_id', '=', 'time1.id')
                       -> leftJoin('times as time2', 'aposta_jogos.time2_id', '=', 'time2.id')
                       -> select('aposta_jogos.id', 'apostas.nome as nome', 'time1.nome as time1', 'time1.imagem as time1_imagem', 'time2.nome as time2', 'time2.imagem as time2_imagem', 'aposta_jogos.placar_id as resultado', 'aposta_jogos.status_jogo_id as status')
                       -> where('aposta_jogos.aposta_id', '=', $aposta->id)
                       -> get();
        return $data;
    }

    public function getOne()
    {
        $query = $this->query();

        $data = $query  -> leftJoin('apostas', 'aposta_jogos.aposta_id', '=', 'apostas.id')
                        -> leftJoin('times as time1', 'aposta_jogos.time1_id', '=', 'time1.id')
                        -> leftJoin('times as time2', 'aposta_jogos.time2_id', '=', 'time2.id')
                        -> leftJoin('placar', 'aposta_jogos.placar_id', '=', 'placar.id')
                        -> select('aposta_jogos.id', 'placar.value as resultado', 'apostas.nome as nome', 'time1.nome as time1', 'time1.imagem as time1_imagem', 'time2.nome as time2', 'time2.imagem as time2_imagem', 'aposta_jogos.placar_id as resultado', 'aposta_jogos.status_jogo_id as status')
                        -> where('aposta_jogos.id', '=', $this->id)
                        -> first();
        return $data;
    }
}
