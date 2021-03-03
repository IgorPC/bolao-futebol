@extends('layouts.adm')

@section('titulo')
    {{$data->time1}} x {{$data->time2}}
@endsection

@section('conteudo')
    <div class="row">
        <div class="col-md-6">
            <h1>{{$data->time1}} x {{$data->time2}}</h1>
        </div>
        <div class="col-md-6">
            <div class="row">
                @if($data->status == '1')
                    <div class="col-12">
                        <a id="cancel" href="#" class="btn btn-outline-danger w-100 mt-2">Cancelar jogo</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <hr>
    <h3>Resultado:</h3>
    <div class="row mt-4">
        <div class="col-md-4">
            <a href="" class="btn btn-outline-primary mb-2 w-100">{{$data->time1}}</a>
        </div>
        <div class="col-md-4">
            <a href="" class="btn btn-outline-dark mb-2 w-100">Empate</a>
        </div>
        <div class="col-md-4">
            <a href="" class="btn btn-outline-primary w-100">{{$data->time2}}</a>
        </div>
    </div>
@endsection
