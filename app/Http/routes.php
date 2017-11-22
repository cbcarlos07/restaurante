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
Route::group(['as' => 'emp.','prefix' => 'empresa'], function(){
    Route::get('',['as' => 'index', 'uses' => 'EmpresaController@index']);
    Route::get('cadastrar',['as' => 'create', 'uses' => 'EmpresaController@create']);
    Route::post('salvar',['as' => 'store', 'uses' => 'EmpresaController@store']);
    Route::post('delete',['as' => 'remove', 'uses' => 'EmpresaController@remove']);
    Route::post('edit',['as' => 'edit', 'uses' => 'EmpresaController@edit']);
    Route::post('update',['as' => 'update', 'uses' => 'EmpresaController@update']);
});
Route::auth();




