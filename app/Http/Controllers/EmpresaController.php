<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Empresa;
use Validator;
class EmpresaController extends Controller
{
    //
    public function index(){

        $empresa = Empresa::paginate(10);
        return view('layouts.empresa')->with('empresa', $empresa);

    }

    public function lista(){

        $empresa = Empresa::all(  );
        return response()->json( $empresa );

    }

    public function create(){
        return view('layouts.empresacad');
    }

    public function remove( Request $request ){
        $id = $request->input('id');
        $empresa = Empresa::find( $id );
        if( $empresa->delete() ){
            return response()->json( array( 'success' => 1 ) );
        }else{
            return response()->json( array( 'success' => 0 ) );
        }


    }

    public function store( Request $request ){

        $nome = $request->get('nome');
        $validator = Validator::make(
            [ 'nome' => $nome],
            ['nome' => 'required'],
            ['required' => ':attribute é obrigatório']
        );
        if( $validator->fails() ){
            return redirect()->back()->withErrors( $validator )->withInput();
        }else{
            $empresa = new Empresa();
            $empresa->ds_empresa = $nome;
            if( $empresa->save() ){
                return response()->json( array( 'success' => 1 ) );
            }else{
                return response()->json( array( 'success' => 0 ) );
            }

            //return redirect()->route('emp.index');

        }

    }

    public function edit( Request $request ){
        $id = $request->input( 'id' );
        $empresa = Empresa::find( $id );

        return view('layouts.empresaalt')->with( 'empresa', $empresa );

    }

    public function update( Request $request ){
        $nome = $request->get('nome');
        $id = $request->get('id');
        $validator = Validator::make(
            [ 'nome' => $nome],
            ['nome' => 'required'],
            ['required' => ':attribute é obrigatório']
        );
        if( $validator->fails() ){
            return redirect()->back()->withErrors( $validator )->withInput();
        }else{
            $empresa = Empresa::find( $id );
            $empresa->ds_empresa = $nome;
            if( $empresa->save() ){
                return response()->json( array( 'success' => 1 ) );
            }else{
                return response()->json( array( 'success' => 0 ) );
            }

            //return redirect()->route('emp.index');

        }


    }
}
