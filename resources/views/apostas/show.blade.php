@extends('layouts.adm')

@section('titulo')
    {{$data->nome}}
@endsection

@section('conteudo')
    <div class="row">
        <div class="col-md-6">
            <h3>{{$data->nome}}</h3>
        </div>
        <div class="col-md-6">
            <div class="row">
                @if($data->status == 'aguardando')
                    <div class="col-md-6 mb-2">
                        <a id="publish" href="#" class="btn btn-outline-success w-100">Publicar bolão</a>
                    </div>
                    <div class="col-md-6">
                        <a id="cancel" href="#" class="btn btn-outline-danger w-100">Cancelar bolão</a>
                    </div>
                @elseif($data->status == 'aberto')
                    <div class="col-md-6 mb-2">
                        <a id="finish" href="#" class="btn btn-outline-primary w-100">Encerrar bolão</a>
                    </div>
                    <div class="col-md-6">
                        <a id="cancel" href="#" class="btn btn-outline-danger w-100">Cancelar bolão</a>
                    </div>
                @elseif($data->status == 'encerrado')
                    <div class="col-md-12">
                        <a id="results" href="#" class="btn btn-primary w-100">Ver resultados</a>
                    </div>
                @else
                    <div class="col-md-12">
                        <a id="publish" href="#" class="btn btn-outline-success w-100">Publicar bolão</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <hr>
    @include('mensagens.error')
    @include('mensagens.sucesso')
    @if($data->status == 'aguardando' || $data->status == 'cancelado')
        <form method="POST" action="{{route('apostas.update', ['id' => $data->id])}}">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nome">Alterar nome:</label>
                        <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" aria-describedby="nomeHelp" value="{{$data->nome}}">
                        @error('nome')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="data">Alterar data:</label>
                        <input type="datetime-local" class="form-control @error('data') is-invalid @enderror" name="data_jogo" id="data">
                        <small id="dataHelp" class="form-text text-muted">A data atual do jogo é: <strong style="color: red">{{date_format($data->data, 'd/m/Y - H:i')}}</strong>.</small>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    @else
    @if($data->status == 'aguardando')
    <form method="POST" action="{{route('apostas.update', ['id' => $data->id])}}">
        @csrf
        <div class="form-group">
            <label for="nome">Alterar nome:</label>
            <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" aria-describedby="nomeHelp" value="{{$data->nome}}">
            @error('nome')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
    @endif
    @endif
    @if($data->status == 'aguardando')
    <hr>
    <form action="{{route('aposta.jogo.store', ['id' => $data->id])}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <div class="form-group">
                        <label for="time1">Time 1:</label>
                        <select class="form-control" name="time1" id="time1" required>
                            <option value="0" selected disabled>Escolha time:</option>
                            @foreach($times as $time)
                                <option value="{{$time->id}}">{{$time->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="form-group">
                        <label for="time2">Time 2:</label>
                        <select class="form-control" name="time2" id="time2" required>
                            <option value="0" selected disabled>Escolha time:</option>
                            @foreach($times as $time)
                                <option value="{{$time->id}}">{{$time->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <button id="add" class="btn btn-success w-100" disabled>Adicionar ao bolao</button>
    </form>
    <hr>
    @endif
    <ul class="list-group mt-3">
        @foreach($jogos as $key => $jogo)
            <a style="text-decoration: none; color: black" class="mb-2" href="{{route('aposta.jogo.show', ['id' => $jogo['id']])}}">
                <li class="list-group-item d-flex @if($jogo['status'] == '3') bg-danger @elseif($jogo['status'] == '2') bg-success @endif justify-content-between align-items-center">
                    <span><img class="mr-3" src="{{$jogo['time1_imagem']}}" alt="" width="20" height="24"> {{$jogo['time1']}}</span>
                    <span>{{$jogo['time2']}} <img class="ml-3" src="{{$jogo['time2_imagem']}}" alt="" width="20" height="24"></span>
                </li>
            </a>
        @endforeach
    </ul>
    <script>
        let addBtn = document.querySelector('#add');
        let time1 = document.querySelector('#time1');
        let time2 = document.querySelector('#time2');

        let valid = [false,false];

        listener(time1, time2, addBtn, valid)

        function listener(time1, time2, addBtn, valid)
        {
            time1.addEventListener('input', function (event){
                if(time1.value !== '0'){
                    valid[0] = true;
                }
                unlockButton(addBtn, valid)
            });
            time2.addEventListener('input', function (event){
                if(time2.value !== '0'){
                    valid[1] = true;
                }
                unlockButton(addBtn, valid)
            });
        }

        function unlockButton(addBtn, valid)
        {
            if(valid[0] == true && valid[1] == true){
                addBtn.removeAttribute('disabled');
            }
        }
    </script>
@endsection
