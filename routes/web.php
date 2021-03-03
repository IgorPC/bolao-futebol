<?php

use Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', 'ApostasController@index')->name('home');
Route::post('/finalizar-aposta', 'ApostasController@apostar')->name('apostar');

Route::get('/adm/login', 'AutenticacaoController@login')->name('a.login.view');
Route::post('/adm/login', 'AutenticacaoController@finalizarLogin')->name('a.login');
Route::get('/adm/cadastro', 'AutenticacaoController@cadastro')->name('a.register.view');
Route::post('/adm/cadastro', 'AutenticacaoController@finalizarCadastro')->name('a.register');

Route::prefix('/adm')->middleware('auth')->group(function (){
    Route::get('/dashboard', 'DashboardController@index')->name('adm');

    Route::get('/times', 'TimeController@index')->name('times.index');
    Route::get('/times-cadastrar', 'TimeController@create')->name('times.create');
    Route::post('/times-cadastrar', 'TimeController@store')->name('times.store');
    Route::get('/times/{id}', 'TimeController@show')->name('times.show');
    Route::put('/times/{id}', 'TimeController@update')->name('times.update');
    Route::post('/times-buscar', 'TimeController@find')->name('times.find');

    Route::get('/apostas', 'ApostaController@index')->name('apostas.index');
    Route::get('/apostas-cadastrar', 'ApostaController@create')->name('apostas.create');
    Route::post('/apostas', 'ApostaController@store')->name('apostas.store');
    Route::get('/apostas/{id}', 'ApostaController@show')->name('apostas.show');
    Route::put('/apostas/{id}', 'ApostaController@update')->name('apostas.update');

    Route::post('/aposta-jogo/{id}', 'ApostaJogosController@store')->name('aposta.jogo.store');
    Route::get('/aposta-jogo/{id}', 'ApostaJogosController@show')->name('aposta.jogo.show');

    Route::get('/adm/logout', 'AutenticacaoController@logout')->name('a.logout');
});

