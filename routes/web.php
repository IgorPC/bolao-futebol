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

    Route::get('/adm/logout', 'AutenticacaoController@logout')->name('a.logout');
});

