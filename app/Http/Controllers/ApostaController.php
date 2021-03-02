<?php

namespace App\Http\Controllers;

use App\Models\Aposta;
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
        $apostas = $this->aposta->getAll();
        return view('apostas.index', compact('sucesso', 'apostas'));
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
            'status_jogo_id' => 1
        ]);

        if($aposta){
            session()->flash('sucesso', 'Bolão cadastrado com sucesso!');
            return redirect()->route('apostas.index');
        }else{
            session()->flash('error', 'Ouve um erro ao cadastrar esse bolao!');
            return redirect()->back();
        }
    }
}
