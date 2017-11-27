<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Cliente;
use App\Registro;
use App\Item;
use Exception;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Validator;

class RegistroController extends Controller
{
    //
    public function lancamentos(){

        $registro = Registro::with([ 'clientes' => function( $query ) {
                                           $query->with('empresas');
                                       }, 'itens'] )
                                    ->select( DB::raw('sum( vl_preco ) as valor, cliente, item') )
                                    ->where( 'sn_pago', 'N' )
                                    ->groupBy('cliente')
                                    ->paginate(10);


        $cliente = Cliente::all();
        $item    = Item::all();

       // return response()->json( $registro );
        return view('layouts.lancamento')->with( [
                                                         'registros' => $registro,
                                                         'clientes'  => $cliente,
                                                         'itens'      => $item
                                                       ] );
    }

    public function pesquisar( Request $request ){

        $pequisa = $request->get('search');
        /* $values = array(
             'search' => $pequisa
         );

         $validator = Validator::make(
             $values,
             [
                 'search' => 'required'
             ]
             ,
             [
                 'required' => 'É necessário preencher este campo para pesquisar'
             ]
         );
         if( $validator->fails() ){
             return redirect()->back()->withErrors( $validator )->withInput();*/
    //    }else{
            $registro = Registro::with([ 'clientes' => function( $query ) {
                $query->with('empresas');
            }, 'itens'] )
                ->select( DB::raw('sum( vl_preco ) as valor, cliente, item') )
                ->where( 'sn_pago', 'N' )
                ->whereHas( 'clientes', function ( $query ){
                    $query->where( 'nm_cliente', 'like', '%'.\Request::input('search').'%' )
                        ->orWhere( 'nr_cracha', 'like', '%'.\Request::input('search').'%' )  ;
                } )
                ->groupBy('cliente')
                ->paginate(10);


            $cliente = Cliente::all();
            $item    = Item::all();

            // return response()->json( $registro );
            return view('layouts.lancamento')->with( [
                'registros' => $registro,
                'clientes'  => $cliente,
                'itens'      => $item
            ] );
      //  }



    }

    public function registrarCompra( Request $request ){
        $cliente = $request->get('cliente');
        $pago    = $request->get('pago');
        $itens   = $request->get('itens');

        $arr = json_decode( $itens );

        //var_dump( $itens );
        $retorno = 0;
        foreach ( $arr as $a => $b ){

             try{
                 $registros = new Registro();
                 $registros->cliente   = $cliente;
                 $registros->item      = $b->{ '#' };
                 $registros->vl_preco  = str_replace("R$ ", "", str_replace(",", ".", $b->{'Valor'}));
                 $registros->sn_pago   = $pago;
                 $registros->qt_compra = $b->{'Qtde'};

                 if( $registros->save() )
                    $retorno = 1;

             }catch ( Exception $exception ){

             }

        }

        return response()->json( array('retorno' => $retorno) );

    }


    public function listaRegistros ( Request $request ){

            $id = $request->get('id');

            $cliente = Cliente::with('empresas')
                                ->find( $id );



            $total = Registro::select( DB::raw('sum( vl_preco ) as valor') )
                ->where( 'sn_pago', 'N' )
                ->where( 'cliente', $id )
                ->groupBy('cliente')
                ->get();

            $registro = Registro::with('itens')
                                  ->select(DB::raw("DATE_FORMAT(created_at, '%d/%m/%Y %H:%i' ) as dt_registro, item, qt_compra, vl_preco, id"))
                                  ->where('sn_pago', 'N')
                                  ->where( 'cliente', $id)
                                  ->get();

           //echo json_encode($registro);
            return view( 'layouts.registro' )->with(
                                                          ['cliente' => $cliente,
                                                           'registros' => $registro,
                                                           'total' => $total
                                                          ] );
    }


     public function registrarPagamento( Request $request ){

        $id = $request->get('registro');


        if( $this->registrar( $id ) ){

            return response()->json( array( "retorno" => 1 ) );

        }
        else{
            return response()->json( array( "retorno" => 0 ) );
        }

     }

     public function registrarPagamentos( Request $request ){

         $id = $request->get('id');

         $registros = Registro::with('clientes')
                              ->where('sn_pago','N')
                              ->where('cliente', $id )
                             ->get();

         $retorno = false;
        //comp echo json_encode( $registros );
         foreach ( $registros as $registro ){

             $retorno = $this->registrar( $registro->id );
           //  echo "Codigo: ".$registro->id. "\n";

         }

         if( $retorno ){
             return response()->json( array('retorno' => 1) );
         }
         else{
             return response()->json( array('retorno' => 0) );
         }


     }

     private function registrar( $id ){

         $registro = Registro::find( $id );
         $registro->sn_pago = 'S';
         $retorno =  false;

         if( $registro->save() ){

             $retorno = true;

         }

         return $retorno;
     }

     public function imprimir( Request $request ){

         $total = $request->get('valor');

         $registros = Registro::with(['clientes' => function ( $query ){
                                      $query->with('empresas');
                                 }])
                              ->select(DB::raw('cliente, sum( vl_preco ) as total'))
                              ->where( 'sn_pago','N' )
                              ->groupBy( 'cliente' )
                              ->get();

        //echo json_encode( $registros );
         return PDF::loadView('layouts.imprimir',
             [
                 'registros' => $registros
                 ,'total'     => $total
             ])->stream( 'my.pdf',array('Attachment'=>0) );


     }

}
