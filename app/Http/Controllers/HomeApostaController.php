<?php

namespace App\Http\Controllers;

use App\Models\Aposta;
use App\Models\ApostaJogos;
use Illuminate\Http\Request;

class HomeApostaController extends Controller
{
    public function index()
    {
        $gamble = new Aposta();
        $bet = $gamble->getIndex();
        $apJogos = new ApostaJogos();
        $gambles = $apJogos->getJogosBolao($bet);
        return view('welcome', compact('gambles', 'bet'));
    }

    public function apostar(Request $request)
    {
        $aposta = $request->resp_jogo;
        $valor = $request->resp_value;
        $nome = $request->resp_name;
        $jogo = $request->resp_gamble;
        $jogo = (array) json_decode($jogo);

        $gamble = new Aposta();
        $bet = $gamble->getIndex();
        $apJogos = new ApostaJogos();
        $gambles = $apJogos->getJogosBolao($bet);

        $jogo_aposta = [];

        if(count($jogo) == count($gambles)){
            $i = 1;
            foreach ($gambles as $gamble){
                $jogo_aposta[$gamble->id] = $jogo[$i];
                $i++;
            }
            $conclusion = [
                'nome' => $nome,
                'valor' => $valor,
                'aposta_id' => $aposta,
                'jogo' => $jogo_aposta
            ];

            dd($conclusion);
        }else{
            return redirect()->back();
        }

    }
}
