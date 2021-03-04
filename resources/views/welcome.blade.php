@extends('layouts.office')

@section('titulo')
    Bolao
@endsection

@section('conteudo')
    <div class="progress">
        <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
    </div>
    <div class="form-row mt-4">
        <div class="col-6">
            <div class="mb-3">
                <label for="nome" class="form-label ml-2"><i class="fas fa-user"></i> <span class="ml-2">Nome:</span> </label>
                <input type="text" class="form-control" name="name" id="nome" required placeholder="Digite seu nome">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="valor"><i class="fas fa-money-bill-wave"></i><span class="ml-2">Valor: </span></label>
                <select class="form-control" name="valor" id="valor" required>
                    <option value="0" selected disabled>Escolha o valor...</option>
                    <option value="5">R$ 5,00</option>
                    <option value="10">R$ 10,00</option>
                    <option value="20">R$ 20,00</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-6">
            <div style="font-size: 15px" class="alert alert-secondary" role="alert">
                Duplas restantes: <strong><span id="duplas">0</span></strong>
            </div>
        </div>
        <div class="col-6">
            <div style="font-size: 15px" class="alert alert-secondary" role="alert">
                Triplas restantes: <strong><span id="triplas">0</span></strong>
            </div>
        </div>
    </div>
    <hr>
    <p class="text-center">
        {{$bet->nome}} |
        <span style="color: @if($bet->status == 'andamento') yellowgreen @elseif($bet->status == 'encerrado') blue @else red @endif">{{$bet->status}}</span></p>
    <table id="gamble-table" class="table table-striped mt-4">
        <thead>
        <tr class="text-center">
            <th scope="col"><i class="fas fa-futbol"></i></th>
            <th scope="col">VIT | EMPT | VIT</th>
            <th scope="col"><i class="far fa-futbol"></i></th>
        </tr>
        </thead>
        <tbody>
        @foreach($gambles as $key => $gamble)
        <tr>
            <td class="float-left"><span class="mr-2"><img src="{{$gamble->time1_imagem}}" alt="" width="20" height="24"></span><strong>{{$gamble->time1_sigla}}</strong></td>
            <td class="text-center">
                <div class="form-check form-check-inline">
                    <input disabled class="form-check-input ml-3 checkInput" type="checkbox" id="inlineCheckbox1" value="{{$key+1}}-A">
                </div>
                <div class="form-check form-check-inline">
                    <input disabled class="form-check-input checkInput" type="checkbox" id="inlineCheckbox2" value="{{$key+1}}-B">
                </div>
                <div class="form-check form-check-inline">
                    <input disabled class="form-check-input checkInput" type="checkbox" id="inlineCheckbox3" value="{{$key+1}}-C">
                </div>
            </td>
            <td class="float-right"><strong>{{$gamble->time2_sigla}}</strong><span class="ml-2"><img src="{{$gamble->time2_imagem}}" alt="" width="20" height="24"></span></td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <form id="form-submit" action="{{route('apostar')}}" method="POST">
        @csrf
        <input type="text" hidden name="resp_jogo" id="resp_jogo" value="{{$bet->id}}">
        <input type="text" hidden name="resp_gamble" id="resp_gamble">
        <input type="text" hidden name="resp_value" id="resp_value">
        <input type="text" hidden name="resp_name" id="resp_name">
        <button id="confirm" type="submit" class="btn btn-primary mt-2 w-100 mb-4" disabled hidden>Finalizar</button>
    </form>
    <script src="{{asset('js/scripts.js')}}"></script>
    <script>
        let nome = document.querySelector('#nome');
        let valor = document.querySelector('#valor');
        let confirmBtn = document.querySelector("#confirm")
        let progress = document.querySelector("#progress-bar")
        let checkInputs = document.querySelectorAll(".checkInput");
        let formSubmit = document.querySelector("#form-submit");
        let doubleInput = document.querySelector("#duplas");
        let tripleInput = document.querySelector("#triplas");
        let dbTag = 0;
        let counter = []

        let limiter =
            {
                5: "3,0",
                10: "3,1",
                20: "3,2"
            }

        let valid = {
            nome: false,
            valor: false,
            limits: false
        }

        watchNameAndValue(valid);

        let gamble = {
            1: "",
            2: "",
            3: "",
            4: "",
            5: "",
            6: "",
            7: "",
            8: "",
            9: "",
            10: "",
            11: "",
        }

        let count = 0;
        let list = [false, false, false, false, false, false, false, false, false, false, false];

        checkInputs.forEach(verifyProgress)

        submitForm(formSubmit)
    </script>
@endsection
