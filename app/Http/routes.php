<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::group(['as' => 'usu.', 'prefix' => 'usuario'], function (){
    Route::get('',['as' => 'index', 'uses' => 'UsuarioController@index']);
    Route::get('cadastrar',['as' => 'create', 'uses' => 'UsuarioController@create']);
    Route::post('salvar',['as' => 'store', 'uses' => 'UsuarioController@store']);
    Route::post('delete',['as' => 'remove', 'uses' => 'UsuarioController@remove']);
    Route::post('edit',['as' => 'edit', 'uses' => 'UsuarioController@edit']);
    Route::post('update',['as' => 'update', 'uses' => 'UsuarioController@update']);
});


Route::group(['as' => 'item.', 'prefix' => 'item'], function (){
    Route::get('',['as' => 'index', 'uses' => 'ItemController@index']);
    Route::get('cadastrar',['as' => 'create', 'uses' => 'ItemController@create']);
    Route::post('salvar',['as' => 'store', 'uses' => 'ItemController@store']);
    Route::post('delete',['as' => 'remove', 'uses' => 'ItemController@remove']);
    Route::post('edit',['as' => 'edit', 'uses' => 'ItemController@edit']);
    Route::post('update',['as' => 'update', 'uses' => 'ItemController@update']);
});

Route::group(['as' => 'emp.','prefix' => 'empresa'], function(){
    Route::get('',['as' => 'index', 'uses' => 'EmpresaController@index']);
    Route::get('cadastrar',['as' => 'create', 'uses' => 'EmpresaController@create']);
    Route::post('salvar',['as' => 'store', 'uses' => 'EmpresaController@store']);
    Route::post('delete',['as' => 'remove', 'uses' => 'EmpresaController@remove']);
    Route::post('edit',['as' => 'edit', 'uses' => 'EmpresaController@edit']);
    Route::post('update',['as' => 'update', 'uses' => 'EmpresaController@update']);
});
Route::auth();




