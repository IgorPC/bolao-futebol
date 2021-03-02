@extends('layouts.adm')

@section('titulo')
    {{$time->nome}}
@endsection

@section('conteudo')
    <h1>{{$time->nome}}</h1>
    <hr>
    @include('mensagens.error')
    <form method="POST" action="{{route('times.update', ['id' => $time->id])}}">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{$time->nome}}">
            @error('nome')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="sigla">Sigla:</label>
            <input type="text" class="form-control @error('sigla') is-invalid @enderror" id="sigla" name="sigla" value="{{$time->sigla}}">
            @error('sigla')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="imagem">Imagem:</label>
            <input type="text" class="form-control @error('imagem') is-invalid @enderror" id="imagem" name="imagem" value="{{$time->imagem}}">
            @error('imagem')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-outline-primary">Atualizar</button>
    </form>
@endsection

