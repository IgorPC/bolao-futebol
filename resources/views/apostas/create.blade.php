@extends('layouts.adm')

@section('titulo')
    Bolões
@endsection

@section('conteudo')
    <h1>Novo Bolão</h1>
    <hr>
    @include('mensagens.error')
    <form method="POST" action="{{route('apostas.store')}}">
        @csrf
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" aria-describedby="nomeHelp">
            @error('nome')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <small id="nomeHelp" class="form-text text-muted">Digite aqui o nome do bolão.</small>
        </div>
        <div class="form-group">
            <label for="data">Data do bolão</label>
            <input type="datetime-local" class="form-control @error('data') is-invalid @enderror"name="data" id="data">
            @error('data')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
@endsection
