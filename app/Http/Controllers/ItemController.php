<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Item;
use Validator;
class ItemController extends Controller
{
    //
    public function index(){

        $item = Item::paginate(10);
      //  return response()->json( $item );
        return view('layouts.item')->with('item', $item);

    }

    public function create(){
        return view('layouts.itemcad');
    }

    public function remove( Request $request ){
        $id = $request->input('id');
        $item = Item::find( $id );
        if( $item->delete() ){
            return response()->json( array( 'success' => 1 ) );
        }else{
            return response()->json( array( 'success' => 0 ) );
        }


    }

    public function store( Request $request ){

        $nome = $request->get('descricao');
        $valor = $request->get('valor');
        //echo $valor;

        $validator = Validator::make(
            [ 'nome'  => $nome
             ,'valor' => $valor
            ],
            [ 'nome'  => 'required'
             ,'valor' => 'required'
            ],
            ['required' => ':attribute é obrigatório']
        );
        if( $validator->fails() ){
            return redirect()->back()->withErrors( $validator )->withInput();
        }else{
            /*$subs = array( "R$ ", "." );
            $preco = str_replace( $subs,"", $valor );
            $preco = str_replace( ".", ",", $preco);*/
            $item = new Item();
            $item->ds_item = $nome;
            $item->vl_item = $valor;
            if( $item->save() ){
                return response()->json( array( 'success' => 1 ) );
            }else{
                return response()->json( array( 'success' => 0 ) );
            }

            //return redirect()->route('emp.index');

        }

    }

    public function edit( Request $request ){
        $id = $request->input( 'id' );
        $item = Item::find( $id );

        return view('layouts.itemalt')->with( 'item', $item );

    }

    public function update( Request $request ){
        $nome = $request->get('descricao');
        $valor = $request->get('valor');
        $id = $request->get('id');
        $validator = Validator::make(
            [ 'nome'  => $nome
             ,'valor' => $valor
            ],
            [
                'nome'  => 'required'
               ,'valor' => 'required'
            ],
            ['required' => ':attribute é obrigatório']
        );
        if( $validator->fails() ){
            return redirect()->back()->withErrors( $validator )->withInput();
        }else{
            $item = Item::find( $id );
            $item->ds_item = $nome;
            $item->vl_item = $valor;
            if( $item->save() ){
                return response()->json( array( 'success' => 1 ) );
            }else{
                return response()->json( array( 'success' => 0 ) );
            }

            //return redirect()->route('emp.index');

        }


    }
}
