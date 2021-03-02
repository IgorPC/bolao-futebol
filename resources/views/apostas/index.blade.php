@extends('layouts.adm')

@section('titulo')
    Bolões
@endsection

@section('conteudo')
    <h1>Bolões</h1>
    <hr>
    @include('mensagens.sucesso')
    <form method="POST" action="{{route('times.find')}}">
        @csrf
        <div class="form-group">
            <label for="bolao">Busque um bolão</label>
            <input id="bolao" name="bolao" type="text" placeholder="bolao" class="form-control @error('bolao') is-invalid @enderror">
            @error('bolao')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <small id="siglaHelp" class="form-text text-muted">Busque um bolao pelo seu nome.</small>
        </div>
        <button type="submit" class="btn btn-primary">Buscar <span class="ml-2"><i class="fas fa-search"></i></span></button>
    </form>
    <hr>
    <div class="accordion" id="accordionExample">
        @foreach($apostas as $key => $aposta)
        <div class="card mt-1">
            <div class="card-header" id="heading{{$key}}">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                        {{$aposta->nome}}
                    </button>
                </h2>
            </div>

            <div id="collapse{{$key}}" class="collapse" aria-labelledby="heading{{$key}}" data-parent="#accordionExample">
                <div class="card-body">
                    {{$aposta->data_jogo}}
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
