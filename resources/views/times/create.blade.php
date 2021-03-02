@extends('layouts.adm')

@section('titulo')
    Cadastrar novo time
@endsection

@section('conteudo')
    <h1>Cadastrar time</h1>
    <hr>
    <form method="POST" action="{{route('times.store')}}">
        @csrf
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{old('nome')}}">
            @error('nome')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="sigla">Sigla:</label>
            <input type="text" class="form-control @error('sigla') is-invalid @enderror" id="sigla" name="sigla" value="{{old('sigla')}}">
            @error('sigla')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="imagem">Imagem:</label>
            <input type="text" class="form-control @error('imagem') is-invalid @enderror" id="imagem" name="imagem" value="{{old('imagem')}}">
            @error('imagem')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-outline-primary">Cadastrar</button>
    </form>
@endsection

