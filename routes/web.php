<?php

use Illuminate\Support\Facades\Route;
//rotas de produtos
Route::get('/produtos', 'ControladorProduto@indexView');
/*Route::get('/produtos/novo', 'ControladorProduto@create');
Route::post('/produtos', 'ControladorProduto@store');
Route::get('/produtos/alterar/{id}', 'ControladorProduto@edit');
Route::post('/produtos/atualizar/{id}','ControladorProduto@update');
Route::get('/produtos/excluir/{id}', 'ControladorProduto@destroy'); */

//rotas de categorias
Route::get('/categorias','ControladorCategoria@index');
Route::get('categorias/novo', 'ControladorCategoria@create');
Route::post('/categorias', 'ControladorCategoria@store');
Route::get('/categorias/apagar/{id}', 'ControladorCategoria@destroy');
Route::get('/categorias/editar/{id}', 'ControladorCategoria@edit');
Route::post('/categorias/{id}', 'ControladorCategoria@update');

Route::get('/', function () {
    return view('index');
});
