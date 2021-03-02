@extends('layouts.adm')

@section('titulo')
    Times
@endsection

@section('conteudo')
    <div class="row">
        <div class="col-6">
            <a class="btn btn-outline-info mb-4" href="{{route('times.create')}}"><i class="fas fa-plus"></i> Novo Time</a>
        </div>
    </div>
    <hr>
    <form method="POST" action="{{route('times.find')}}">
        @csrf
        <div class="form-group">
            <label for="sigla-input">Busque um time</label>
            <input id="sigla_input" name="sigla_input" type="text" placeholder="Sigla" class="form-control @error('sigla_input') is-invalid @enderror">
            @error('sigla_input')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <small id="siglaHelp" class="form-text text-muted">Busque o time pela sigla.</small>
        </div>
        <button type="submit" class="btn btn-primary">Buscar <span class="ml-2"><i class="fas fa-search"></i></span></button>
    </form>
    <hr>
    @include('mensagens.sucesso')
    @include('mensagens.error')
    <ul class="list-group list-group-flush">
        @foreach($times as $key => $time)
        <li class="list-group-item">
            <span class="float-left"><img class="mr-2" src="{{$time->imagem}}" alt="" width="20" height="24"> {{$time->nome}} | {{$time->sigla}}</span>
            <span class="float-right"><a class="btn btn-outline-info btn-sm" href="{{route('times.show', ['id' => $time->id])}}"><i class="fas fa-edit"></i></a></span>
        </li>
        @endforeach
        <hr class="mt-4">
        @if(count($pagination[0]) >= 10)
            <nav aria-label="Page navigation example mt-2">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="{{$pagination['url']}}/?page={{$pagination['current'] - 1}}">Anterior</a></li>
                    @foreach($pagination[0] as $key => $page)
                        @if($key <= 6)
                            <li class="page-item"><a class="page-link" href="{{$page}}">{{$key}}</a></li>
                        @endif
                    @endforeach
                    <li class="page-item"><a class="page-link" href="{{$pagination['url']}}/?page={{$pagination['current'] + 1}}">Proxima</a></li>
                </ul>
            </nav>
        @endif
    </ul>
@endsection
