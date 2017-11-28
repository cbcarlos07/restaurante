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

Route::get('/',['as' => 'login', 'uses' => 'UsuarioController@login' ] );

Route::auth();

/*Route::get('/home', 'HomeController@index');*/


Route::group( ['middleware' => 'usuario'], function (){

        Route::group(['as' => 'lanc.', 'prefix' => 'lancamento'], function (){
            Route::get('',['as' => 'index', 'middleware' => 'senha','uses' => 'RegistroController@lancamentos']);
            Route::post('registrarCompra',['as' => 'registrar', 'uses' => 'RegistroController@registrarCompra']);
            Route::post('registro',['as' => 'registro', 'uses' => 'RegistroController@listaRegistros']);
            Route::post('pagar',['as' => 'pagar', 'uses' => 'RegistroController@registrarPagamento']);
            Route::post('pagamento',['as' => 'pagamento', 'uses' => 'RegistroController@registrarPagamentos']);
            Route::post('imprimir',['as' => 'imprimir', 'uses' => 'RegistroController@imprimir']);
            Route::post('pesquisar',['as' => 'pesquisar', 'uses' => 'RegistroController@pesquisar']);
        });


        Route::group(['as' => 'cli.', 'prefix' => 'cliente'], function (){
            Route::get('',['as' => 'index', 'uses' => 'ClienteController@index']);
            Route::get('cadastrar',['as' => 'create', 'uses' => 'ClienteController@create']);
            Route::post('salvar',['as' => 'store', 'uses' => 'ClienteController@store']);
            Route::post('delete',['as' => 'remove', 'uses' => 'ClienteController@remove']);
            Route::post('edit',['as' => 'edit', 'uses' => 'ClienteController@edit']);
            Route::post('update',['as' => 'update', 'uses' => 'ClienteController@update']);
        });

        Route::group(['as' => 'usu.', 'prefix' => 'usuario'], function (){
            Route::get('',['as' => 'index', 'uses' => 'UsuarioController@index']);
            Route::get('cadastrar',['as' => 'create', 'uses' => 'UsuarioController@create']);
            Route::post('salvar',['as' => 'store', 'uses' => 'UsuarioController@store']);
            Route::post('delete',['as' => 'remove', 'uses' => 'UsuarioController@remove']);
            Route::post('edit',['as' => 'edit', 'uses' => 'UsuarioController@edit']);
            Route::post('update',['as' => 'update', 'uses' => 'UsuarioController@update']);
            Route::get('sair',['as' => 'sair', 'uses' => 'UsuarioController@sair']);
            Route::get('logoff',['as' => 'logoff', 'uses' => 'UsuarioController@logOff']);
            Route::get('alterar',['as' => 'alterar', 'uses' => 'UsuarioController@alterarSenha']);

        });

        Route::group(['as' => 'item.', 'prefix' => 'item'], function (){
            Route::get('',['as' => 'index', 'uses' => 'ItemController@index']);
            Route::get('cadastrar',['as' => 'create', 'uses' => 'ItemController@create']);
            Route::post('salvar',['as' => 'store', 'uses' => 'ItemController@store']);
            Route::post('delete',['as' => 'remove', 'uses' => 'ItemController@remove']);
            Route::post('edit',['as' => 'edit', 'uses' => 'ItemController@edit']);
            Route::post('update',['as' => 'update', 'uses' => 'ItemController@update']);
            Route::post('getValue',['as' => 'getValue', 'uses' => 'ItemController@getItemValue']);
        });

        Route::group(['as' => 'emp.','prefix' => 'empresa'], function(){
            Route::get('',['as' => 'index', 'uses' => 'EmpresaController@index']);
            Route::post('lista',['as' => 'list', 'uses' => 'EmpresaController@lista']);
            Route::get('cadastrar',['as' => 'create', 'uses' => 'EmpresaController@create']);
            Route::post('salvar',['as' => 'store', 'uses' => 'EmpresaController@store']);
            Route::post('delete',['as' => 'remove', 'uses' => 'EmpresaController@remove']);
            Route::post('edit',['as' => 'edit', 'uses' => 'EmpresaController@edit']);
            Route::post('update',['as' => 'update', 'uses' => 'EmpresaController@update']);
        });


} );

Route::get('alterar',['as' => 'alterar', 'uses' => 'UsuarioController@alterarSenha']);






