@extends('layouts.app')

@section('content')
    <br />
    <div class="container" style="margin-top: 50px;">
        <div class="row"></div>
        <div class="col-lg-12"></div>
        <div class="row col-lg-12">


            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"  style=" text-align: center">


                <a href="{{ route( 'usu.logoff' ) }}" class="btn btn-lg btn-primary btn-sim" style="width: 150px; float: right" title="Confirmar sa&iacute;da do sistema">Sim</a>

            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="text-align: center" >


                <a href="{{ route( 'lanc.index' ) }}" class="btn btn-lg btn-danger btn-nao" style=" width: 150px; float: left" title="Voltar &agrave; tela inicial">N&atilde;o</a>


            </div>


        </div>
    </div>

@stop