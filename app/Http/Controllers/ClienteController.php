<?php

namespace App\Http\Controllers;

use App\Fone;
use Illuminate\Http\Request;

use App\Http\Requests;
use Exception;
use Validator;
use App\Cliente;
use App\Empresa;

use Hash;

class ClienteController extends Controller
{
    //
    public function index(){

        $cliente = Cliente::with('empresas')
                            ->orderBy('nm_cliente')
                            ->paginate( 10 )
                            ;
      //  $cliente = Cliente::all();
      //  echo json_encode( $cliente );
        return view('layouts.cliente')->with('cliente', $cliente);

    }

    public function create(){
        $empresa = Empresa::all();
        return view('layouts.clientecad')->with( 'empresa' , $empresa );
    }

    public function remove( Request $request ){
        $id = $request->input('id');

        $phones = Fone::where( 'cliente', $id );

        $phones->delete();

        $cliente = Cliente::find( $id );
        if( $cliente->delete() ){
            return response()->json( array( 'success' => 1 ) );
        }else{
            return response()->json( array( 'success' => 0 ) );
        }


    }

    public function store( Request $request ){

        $nome         = $request->get('nome');
        $cracha       = $request->get('cracha');
        $empresa      = $request->get('empresa');
        $cep          = $request->get('cep');
        $casa         = $request->get('casa');
        $complemento  = $request->get('complemento');
        $email        = $request->get('email');
        $phone        = $request->get('telefone');
        $tpphone        = $request->get('tipo');
        $obphone        = $request->get('obs');

        /*for ( $i = 0; $i < sizeof( $phone ); $i++ ){
            echo "$phone[$i] - $tpphone[$i] - $obphone[$i]<br>";
        }*/

        $validator = Validator::make(
            [  'nome'        => $nome
              ,'cracha'      => $cracha
              ,'empresa'     => $empresa
              ,'cep'         => $cep
              ,'casa'        => $casa
              ,'email'       => $email
            ],
            [    'nome'        => 'required|min:6'
                ,'cracha'      => 'required'
                ,'empresa'     => 'required'
                ,'cep'         => 'required|min:8'
                ,'casa'        => 'required'
                ,'email'       => 'required|min:8'
            ],
            [  'required'      => ':attribute é obrigatório'
              ,'nome.min'      => ':attribute deve ter no mínimo 6 dígitos'
              ,'cep.min'       => ':attribute deve ter no mínimo 8 dígitos'
              ,'email.min'     => ':attribute deve ter no mínimo 8 dígitos'
            ]
        );
        if( $validator->fails() ){
            return redirect()->back()->withErrors( $validator )->withInput();
        }else{
            try{
                $remover = array( ".", "-");
                $newCep = str_replace( $remover, "", $cep );
                $cliente = new Cliente();
                $cliente->nm_cliente      = $nome;
                $cliente->empresa         = $empresa;
                $cliente->nr_cep          = $newCep;
                $cliente->nr_cracha       = $cracha;
                $cliente->nr_casa         = $casa;
                $cliente->ds_complemento  = $complemento;
                $cliente->dt_cadastro     = date('Y-m-d');
                $cliente->email           = $email;
                $cliente->senha           = Hash::make('12345678');
                $cliente->sn_senha_atual  = 'N';
                $cliente->save();

                if( sizeof( $phone ) > 0 ){
                    for ( $i = 0; $i < sizeof( $phone ); $i++ ){
                        $telefone = new Fone();
                        $telefone->cliente  = $cliente->id;
                        $telefone->nr_fone  = $phone[$i];
                        $telefone->tp_fone  = $tpphone[$i];
                        $telefone->obs_fone = $obphone[$i];
                        $telefone->save();
                    }

                }
                return redirect()->route('cli.index');
               // echo "Salvo com sucesso";
            }catch (Exception $exception){
               // echo "Problema ao salvar ".$exception->getMessage();
                return redirect()->back( )->with( 'exception','Um ocorreu um problema ao salvar' );
            }


            //return redirect()->route('emp.index');

        }

    }

    public function edit( Request $request ){
        $id      = $request->input( 'id' );
        $phone   = Fone::where( 'cliente', $id )->get();
        $empresa = Empresa::all();
        $cliente = Cliente::find( $id );
        // echo json_encode( $phone );
        return view('layouts.clientealt')->with( ['cliente' => $cliente, 'phone' => $phone, 'empresa' => $empresa] );

    }

    public function update( Request $request ){
        $id           = $request->get('id');
        $nome         = $request->get('nome');
        $cracha       = $request->get('cracha');
        $empresa      = $request->get('empresa');
        $cep          = $request->get('cep');
        $casa         = $request->get('casa');
        $complemento  = $request->get('complemento');
        $email        = $request->get('email');
        $phone        = $request->get('telefone');
        $tpphone        = $request->get('tipo');
        $obphone        = $request->get('obs');
      //  echo "Chegou!";
        $validator = Validator::make(
            [  'nome'        => $nome
                ,'cracha'      => $cracha
                ,'empresa'     => $empresa
                ,'cep'         => $cep
                ,'casa'        => $casa
                ,'email'       => $email
            ],
            [    'nome'        => 'required|min:6'
                ,'cracha'      => 'required'
                ,'empresa'     => 'required'
                ,'cep'         => 'required|min:8'
                ,'casa'        => 'required'
                ,'email'       => 'required|min:8'
            ],
            [   'required'       => ':attribute é obrigatório'
                ,'nome.min'      => ':attribute deve ter no mínimo 6 dígitos'
                ,'min'           => ':attribute deve ter no mínimo 8 dígitos'
            ]
        );
        if( $validator->fails() ){
            return redirect()->back()->withErrors( $validator )->withInput();
        }else{
            try{
                $remover = array( '.','-' );
                $newCep = str_replace( $remover, "", $cep );
                $cliente = Cliente::find( $id );
                $cliente->nm_cliente      = $nome;
                $cliente->empresa         = $empresa;
                $cliente->nr_cep          = $newCep;
                $cliente->nr_cracha       = $cracha;
                $cliente->nr_casa         = $casa;
                $cliente->ds_complemento  = $complemento;
                $cliente->dt_cadastro     = date('Y-m-d');
                $cliente->email           = $email;
                $cliente->save();

                $telefone = Fone::where('cliente', $id )->delete();

                if( sizeof( $phone ) > 0 ){
                    for ( $i = 0; $i < sizeof( $phone ); $i++ ){
                        $telefone = new Fone();
                        $telefone->cliente  = $cliente->id;
                        $telefone->nr_fone  = $phone[$i];
                        $telefone->tp_fone  = $tpphone[$i];
                        $telefone->obs_fone = $obphone[$i];
                        $telefone->save();
                    }

                }

                return redirect()->route('cli.index');
            }catch (Exception $exception){
                return redirect()->back( )->with( 'exception','Um ocorreu um problema ao salvar' );
            }


            //return redirect()->route('emp.index');

        }


    }
}
