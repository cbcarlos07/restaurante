<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Validator;
use App\User;
use Illuminate\Support\Facades\Hash;
use Exception;
class UsuarioController extends Controller
{
    //
    public function index(){

        $usuario = User::paginate(10);
        //  return response()->json( $usuario );
        return view('layouts.usuario')->with('usuario', $usuario);

    }

    public function create(){
        return view('layouts.usuariocad');
    }

    public function remove( Request $request ){
        $id = $request->input('id');
        $usuario = User::find( $id );
        if( $usuario->delete() ){
            return response()->json( array( 'success' => 1 ) );
        }else{
            return response()->json( array( 'success' => 0 ) );
        }


    }

    public function store( Request $request ){

        $nome = $request->get('nome');
        $email = $request->get('email');

        //echo $valor;

        $validator = Validator::make(
            [ 'nome'  => $nome
             ,'email' => $email
            ],
            [ 'nome'  => 'required|min:7'
             ,'email' => 'required'
            ],
            [
                'required' => ':attribute é obrigatório'
               ,'min'    => ':attribute deve ter ao menos 7 caracteres'
            ]
        );
        if( $validator->fails() ){
            return redirect()->back()->withErrors( $validator )->withInput();
        }else{
            /*$subs = array( "R$ ", "." );
            $preco = str_replace( $subs,"", $valor );
            $preco = str_replace( ".", ",", $preco);*/
            try{
                $usuario = new User();
                $usuario->name  = $nome;
                $usuario->email = $email;
                $usuario->password = Hash::make('12345678');
                $usuario->sn_ativo = 'N';
                $usuario->sn_senha_atual = 'N';
                $usuario->save();
               // if( $usuario->save() ){
                    //return response()->json( array( 'success' => 1 ) );
                   return redirect()->route('usu.index');
                //}
                //echo "Deu certo!";
            }catch (Exception $exception){
                // echo $exception->getMessage();
                 //echo $erros[0];

                return redirect()->back()->with( "exception", 'Provavelmente o e-mail informado j&aacute; est&aacute; cadastrado' );
            }


            //return redirect()->route('emp.index');

        }

    }

    public function edit( Request $request ){
        $id = $request->input( 'id' );
        $usuario = User::find( $id );

        return view('layouts.usuarioalt')->with( 'usuario', $usuario );

    }

    public function update( Request $request ){
        $nome      = $request->get('nome');
        $email     = $request->get('email');
        $password  = $request->get('password');
        $password1 = $request->get('password1');
        $ativo     = $request->get('sn_ativo');
        $senha     = $request->get('sn_atual');
        $id = $request->get('id');

       // var_dump( $ativo );
        if( isset( $ativo ) ){
            $ativo = 'S';
        }else{
            $ativo = 'N';
        }

       // echo $ativo;
       // echo $id;


        $validator = Validator::make(
            [    'nome'   => $nome
                ,'pwd'    => $password
                ,'pwd1'   => $password1
                ,'email'  => $email
            ],
            [
                'nome'  => 'required|min:6'
                ,'pwd'   => 'required|min:8'
                ,'pwd1'   => 'required|min:8'
                ,'email' => 'required'
            ],
            [
                'required' => ':attribute é obrigatório'
               ,'nome.min' => ':attribute tem que no mínimo 6 caracteres'
               ,'pwd.min' => ':attribute tem que no mínimo 8 caracteres'
            ]
        );
        if( $validator->fails() ){
            return redirect()->back()->withErrors( $validator )->withInput();
        }else{
            $usuario = User::find( $id );
            $usuario->name           = $nome;
            $usuario->email          = $email;
            $usuario->password       = Hash::make( $password );
            $usuario->sn_ativo       = $ativo;
            $usuario->sn_senha_atual = $senha;
            if( $usuario->save() ){
                //return response()->json( array( 'success' => 1 ) );
                return redirect()->route('usu.index');
            }else{
                //return response()->json( array( 'success' => 0 ) );
                return redirect()->back()->with( 'exception', 'Um problema ocorreu' );
            }

            //return redirect()->route('emp.index');

        }


    }
}
