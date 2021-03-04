@extends('layouts.adm')

@section('titulo')
    Bolões
@endsection

@section('conteudo')
    <h1>Bolões</h1>
    <hr>
    @include('mensagens.sucesso')
    @include('mensagens.error')
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
    <ul class="list-group">
        @foreach($apostas as $key => $aposta)
                <li class="list-group-item">
                    @if($aposta->status == 'andamento')
                        <span class="badge badge-success float-left mr-4 mt-1">{{$aposta->status}} </span>
                    @elseif($aposta->status == 'encerrado')
                        <span class="badge badge-dark float-left mr-4 mt-1">{{$aposta->status}} </span>
                    @elseif($aposta->status == 'cancelado')
                        <span class="badge badge-danger float-left mr-4 mt-1">{{$aposta->status}} </span>
                    @else
                        <span class="badge badge-warning float-left mr-4 mt-1">{{$aposta->status}} </span>
                    @endif
                    <a style="text-decoration: none; color: black" href="{{route('apostas.show', ['id' => $aposta->id])}}">{{$aposta->nome}}</a>
                    <span class="badge badge-primary badge-pill float-right mt-1">0</span>
                </li>
        @endforeach
    </ul>
@endsection
