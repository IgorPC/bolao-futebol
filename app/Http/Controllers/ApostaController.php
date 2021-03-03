<?php

namespace App\Http\Controllers;

use App\Models\Aposta;
use App\Models\ApostaJogos;
use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApostaController extends Controller
{
    private Aposta $aposta;

    public function __construct(Aposta $aposta)
    {
        $this->aposta = $aposta;
    }

    public function index(Request $request)
    {
        $sucesso = $request->session()->get('sucesso');
        $error = $request->session()->get('error');
        $apostas = $this->aposta->getAll();
        return view('apostas.index', compact('sucesso', 'error', 'apostas'));
    }

    public function create(Request $request)
    {
        $error = $request->session()->get('error');
        return view('apostas.create', compact('error'));
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'nome' => 'required|min:3',
            'data' => 'required'
        ])->validate();

        $aposta = $this->aposta->create([
            'user_id' => auth()->user()->id,
            'nome' => $request->nome,
            'data_jogo' => $request->data,
            'status_jogo_id' => 4
        ]);

        if($aposta){
            session()->flash('sucesso', 'Bolão cadastrado com sucesso!');
            return redirect()->route('apostas.index');
        }else{
            session()->flash('error', 'Ouve um erro ao cadastrar esse bolao!');
            return redirect()->back();
        }
    }

    public function show($id, Request $request)
    {
        $aposta = $this->aposta->find($id);
        if($aposta){
            $error = $request->session()->get('error');
            $sucesso = $request->session()->get('sucesso');
            $data = $aposta->getOne();
            $jogos = (new ApostaJogos())->getJogosBolao($aposta);
            $times = Time::all();
            return view('apostas.show', compact('data', 'error', 'sucesso', 'times', 'jogos'));
        }else{
            return redirect()->back();
        }
    }

    public function update($id, Request $request)
    {
        Validator::make($request->all(), [
            'nome' => 'required'
        ])->validate();

        $aposta = $this->aposta->find($id);
        if($aposta){
            $data = $request->all();
            unset($data['_method']);
            unset($data['_token']);
            if($data['data_jogo'] == null){
                unset($data['data_jogo']);
            }
            $action = $aposta->update($data);
            if($action){
                session()->flash('sucesso', 'Bolão atualizado com sucesso!');
                return redirect()->back();
            }else{
                session()->flash('error', 'Ouve um erro ao atualizar o bolao!');
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }
}
