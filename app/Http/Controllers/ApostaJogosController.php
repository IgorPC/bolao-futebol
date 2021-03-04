<?php

namespace App\Http\Controllers;

use App\Models\Aposta;
use App\Models\ApostaJogos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApostaJogosController extends Controller
{
    private ApostaJogos $apJogo;

    public function __construct(ApostaJogos $apJogo)
    {
        $this->apJogo = $apJogo;
    }

    public function store($id, Request $request)
    {
        Validator::make($request->all(), [
            'time1' => 'required',
            'time2' => 'required'
        ])->validate();

        $aposta = Aposta::find($id);
        if($aposta){
            $data = $request->all();
            $data['aposta_id'] = $id;
            unset($data['_token']);
            $apJogo = $this->apJogo->create([
                'aposta_id' => $data['aposta_id'],
                'time1_id' => $data['time1'],
                'time2_id' => $data['time2'],
                'placar_id' => 'NULL',
                'status_jogo_id' => 4
            ]);
            if($apJogo){
                session()->flash('sucesso', 'O jogo foi adicionado ao bolao com sucesso!');
                return redirect()->back();
            }else{
                session()->flash('error', 'Ouve um erro ao cadastrar esse jogo ao bolao!');
                return redirect()->back();
            }
        }else{
            session()->flash('error', 'Ouve um erro ao cadastrar esse jogo ao bolao!');
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $apJogo = $this->apJogo->find($id);
        if($apJogo){
            $data = $apJogo->getOne();
            return view('apostas.apostas-jogo', compact('data'));
        }else{
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        $apJogo = $this->apJogo->find($id);
        if($apJogo){
            $aposta = Aposta::find($apJogo->aposta_id);
            if($aposta){
                if($aposta->status_jogo_id != 4){
                    session()->flash('error', 'Você nao pode cancelar um jogo em andamento ou que ja esta finalizado!');
                    return redirect()->route('apostas.index');
                }elseif ($apJogo->status_jogo_id != 4){
                    session()->flash('error', 'Você nao pode cancelar um jogo em andamento ou que ja esta finalizado!');
                    return redirect()->route('apostas.index');
                }else{
                    $apJogo->delete();
                    session()->flash('sucesso', 'Jogo apagado com sucesso!');
                    return redirect()->route('apostas.index');
                }
            }else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }
}
