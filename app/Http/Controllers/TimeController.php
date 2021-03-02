<?php

namespace App\Http\Controllers;

use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Paginator;

class TimeController extends Controller
{
    private Time $time;

    public function __construct(Time $time)
    {
        $this->time = $time;
    }

    public function index(Request $request)
    {
        $sucesso = $request->session()->get('sucesso');
        $error = $request->session()->get('error');
        $times = $this->time->getAllTimes(10);
        $pagination = Paginator::paginate($times->links(), $request);
        return view('times.index', compact('times', 'pagination', 'sucesso', 'error'));
    }

    public function create()
    {
        return view('times.create');
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'nome' => 'required|min:3',
            'sigla' => 'required|max:3|unique:times',
            'imagem' => 'required'
        ])->validate();

        $time = $this->time->create([
            'nome' => $request->nome,
            'sigla' => $request->sigla,
            'imagem' => $request->imagem,
            'status_id' => 1
        ]);
        if($time){
            session()->flash('sucesso', 'Time cadastrado com sucesso!');
            return redirect()->route('times.index');
        }else{
            return redirect()->back();
        }
    }

    public function show($id, Request $request)
    {
        $error = $request->session()->get('error');
        $time = $this->time->find($id);
        if($time){
            return view('times.show', compact('time', 'error'));
        }else{
            return redirect()->back();
        }
    }

    public function update($id, Request $request)
    {
        Validator::make($request->all(), [
            'nome' => 'required|min:3',
            'sigla' => 'required|max:3',
            'imagem' => 'required'
        ])->validate();

        $time = $this->time->find($id);
        if($time){
            if ($time->sigla != $request->sigla){
                if($time->verifySigla($request->sigla)){
                    session()->flash('error', 'Sigla em uso!');
                    return redirect()->back();
                }
            }

            $action = $time->update($request->all());
            if($action){
                session()->flash('sucesso', 'Time atualizado com sucesso!');
                return redirect()->route('times.index');
            }else{
                session()->flash('error', 'Erro ao atualizar o time!');
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }

    public function find(Request $request)
    {
        Validator::make($request->all(), [
            'sigla_input' => 'required'
        ])->validate();

        $time = $this->time->findBySigla($request->sigla_input);
        if(!$time){
            session()->flash('error', 'Time nao encontrado!');
            return redirect()->back();
        }else{
            return redirect()->route('times.show', ['id' => $time->id]);
        }
    }
}
