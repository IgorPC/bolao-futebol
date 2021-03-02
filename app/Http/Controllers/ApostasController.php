<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApostasController extends Controller
{
    public function index()
    {
        $gambles = [
            0 => [
                'time1' => [
                    'id' => 1,
                    'sigla' => 'FLA',
                    'nome' => 'Flamengo',
                    'imagem' => 'https://cdn.worldvectorlogo.com/logos/flamengo.svg'
                ],
                'time2' => [
                    'id' => 2,
                    'sigla' => 'SAO',
                    'nome' => 'Sao Paulo',
                    'imagem' => 'https://cdn.worldvectorlogo.com/logos/sao-paulo-1.svg'
                ]
            ],
            1 => [
                'time1' => [
                    'id' => 3,
                    'sigla' => 'BOT',
                    'nome' => 'Botafogo',
                    'imagem' => 'https://cdn.worldvectorlogo.com/logos/botafogo.svg'
                ],
                'time2' => [
                    'id' => 4,
                    'sigla' => 'ATM',
                    'nome' => 'Atletico Mineiro',
                    'imagem' => 'https://cdn.worldvectorlogo.com/logos/clube-atletico-mineiro.svg'
                ]
            ],
            2 => [
                'time1' => [
                    'id' => 1,
                    'sigla' => 'FLA',
                    'nome' => 'Flamengo',
                    'imagem' => 'https://cdn.worldvectorlogo.com/logos/flamengo.svg'
                ],
                'time2' => [
                    'id' => 2,
                    'sigla' => 'SAO',
                    'nome' => 'Sao Paulo',
                    'imagem' => 'https://cdn.worldvectorlogo.com/logos/sao-paulo-1.svg'
                ]
            ],
            3 => [
                'time1' => [
                    'id' => 1,
                    'sigla' => 'FLA',
                    'nome' => 'Flamengo',
                    'imagem' => 'https://cdn.worldvectorlogo.com/logos/flamengo.svg'
                ],
                'time2' => [
                    'id' => 2,
                    'sigla' => 'SAO',
                    'nome' => 'Sao Paulo',
                    'imagem' => 'https://cdn.worldvectorlogo.com/logos/sao-paulo-1.svg'
                ]
            ],
            4 => [
                'time1' => [
                    'id' => 1,
                    'sigla' => 'FLA',
                    'nome' => 'Flamengo',
                    'imagem' => 'https://cdn.worldvectorlogo.com/logos/flamengo.svg'
                ],
                'time2' => [
                    'id' => 2,
                    'sigla' => 'SAO',
                    'nome' => 'Sao Paulo',
                    'imagem' => 'https://cdn.worldvectorlogo.com/logos/sao-paulo-1.svg'
                ]
            ],
            5 => [
                'time1' => [
                    'id' => 1,
                    'sigla' => 'FLA',
                    'nome' => 'Flamengo',
                    'imagem' => 'https://cdn.worldvectorlogo.com/logos/flamengo.svg'
                ],
                'time2' => [
                    'id' => 2,
                    'sigla' => 'SAO',
                    'nome' => 'Sao Paulo',
                    'imagem' => 'https://cdn.worldvectorlogo.com/logos/sao-paulo-1.svg'
                ]
            ],
            6 => [
                'time1' => [
                    'id' => 1,
                    'sigla' => 'FLA',
                    'nome' => 'Flamengo',
                    'imagem' => 'https://cdn.worldvectorlogo.com/logos/flamengo.svg'
                ],
                'time2' => [
                    'id' => 2,
                    'sigla' => 'SAO',
                    'nome' => 'Sao Paulo',
                    'imagem' => 'https://cdn.worldvectorlogo.com/logos/sao-paulo-1.svg'
                ]
            ],
            7 => [
                'time1' => [
                    'id' => 1,
                    'sigla' => 'FLA',
                    'nome' => 'Flamengo',
                    'imagem' => 'https://cdn.worldvectorlogo.com/logos/flamengo.svg'
                ],
                'time2' => [
                    'id' => 2,
                    'sigla' => 'SAO',
                    'nome' => 'Sao Paulo',
                    'imagem' => 'https://cdn.worldvectorlogo.com/logos/sao-paulo-1.svg'
                ]
            ],
            8 => [
                'time1' => [
                    'id' => 1,
                    'sigla' => 'FLA',
                    'nome' => 'Flamengo',
                    'imagem' => 'https://cdn.worldvectorlogo.com/logos/flamengo.svg'
                ],
                'time2' => [
                    'id' => 2,
                    'sigla' => 'SAO',
                    'nome' => 'Sao Paulo',
                    'imagem' => 'https://cdn.worldvectorlogo.com/logos/sao-paulo-1.svg'
                ]
            ],
            9 => [
                'time1' => [
                    'id' => 1,
                    'sigla' => 'FLA',
                    'nome' => 'Flamengo',
                    'imagem' => 'https://cdn.worldvectorlogo.com/logos/flamengo.svg'
                ],
                'time2' => [
                    'id' => 2,
                    'sigla' => 'SAO',
                    'nome' => 'Sao Paulo',
                    'imagem' => 'https://cdn.worldvectorlogo.com/logos/sao-paulo-1.svg'
                ]
            ],
            10 => [
                'time1' => [
                    'id' => 1,
                    'sigla' => 'FLA',
                    'nome' => 'Flamengo',
                    'imagem' => 'https://cdn.worldvectorlogo.com/logos/flamengo.svg'
                ],
                'time2' => [
                    'id' => 2,
                    'sigla' => 'SAO',
                    'nome' => 'Sao Paulo',
                    'imagem' => 'https://cdn.worldvectorlogo.com/logos/sao-paulo-1.svg'
                ]
            ]
        ];
        return view('welcome', compact('gambles'));
    }

    public function apostar(Request $request)
    {
        $valor = $request->resp_value;
        $nome = $request->resp_name;
        $aposta = $request->resp_gamble;

        dd(json_decode($aposta));
    }
}
