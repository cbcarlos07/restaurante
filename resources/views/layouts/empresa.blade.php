@extends('layouts.app')

@section('content')
    <div class="progress" style="margin-top: -50px; position: absolute; z-index: 2;">
        <div class="indeterminate"></div>
    </div>
    <div class="mensagem "
         style="margin-top: -65px; margin-left: -15px; text-align: center; width: 110%; position: relative; font-size: 12px; z-index: 3">
        <p class="alert alert-success">Mensagem de retorno</p>
    </div>
    <div class="modal fade modal-question" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="msgAvisoModal"
                     style="margin-top: 0;  text-align: center; width: 100%; position: relative; font-size: 12px; z-index: 3">
                    <p class="alert alert-success alerta">Mensagem de retorno</p>
                </div>

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Aten&ccedil;&atilde;o</h4>
                </div>
                <div class="modal-body">
                    <p>Deseja realmente excluir a empresa <b><span class="user-nome"></span></b>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sim">Sim</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li class="active">Empresas</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header col-lg-9">Empresas</h1>
                <a href="{{ route('emp.create') }}" class="btn btn-primary col-lg-3" style="margin-top: 20px;">Novo</a>
            </div>
        </div><!--/.row-->


        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <div class="container">
                            <input type="hidden" id="token" value="{{ csrf_token() }}">
                            <table class="table table-responsive  table-striped table-hover" >
                                <thead>
                                <tr>
                                    <!--<th data-field="state" data-checkbox="true" >ID</th>-->
                                    <th data-field="id" data-sortable="true">ID</th>
                                    <th data-field="name"  data-sortable="true">NOME</th>
                                    <th data-field="" data-sortable="true"></th>
                                </tr>
                                </thead>
                                <tbody class="tbody">
                                @foreach( $empresa as $empresas )
                                    <tr>
                                        <td> {{ $empresas->id }} </td>
                                        <td> {{ $empresas->ds_empresa }} </td>
                                        <td>

                                            <a href="#" class="btn-remove"  data-nome="{{ $empresas->ds_empresa }}" data-id="{{ $empresas->id }}"><i class="glyphicon glyphicon-remove"></i></a>
                                            <a href="#" class="btn-edit"  data-nome="{{ $empresas->ds_empresa }}" data-id="{{ $empresas->id }}"><i class="glyphicon glyphicon-edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div><!--/.row-->



    </div><!--/.main-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script>
        $('.progress').fadeOut();
        $('.mensagem').fadeOut();
        $('.msgAvisoModal').fadeOut();

        
        $('.btn-edit').on('click', function () {
            var id = $(this).data('id');
            var form = $('<form action="{{ route( 'emp.edit' ) }}" method="post">'+
                         ' <input type="hidden" name="_token" value="{{ csrf_token() }}">'+
                         ' <input type="hidden" name="id" value="'+ id +'">'+
                         '</form>');
            $('body').append( form );
            form.submit();
        });
        
        $('.btn-remove').on('click', function () {
            var id = $(this).data('id');
            var nome = $(this).data('nome');
            var token = $('#token').val();
            $('span.user-nome').text( nome );
            $('.modal-question').modal('show');
            console.log( token );
            $('.btn-sim').on('click', function () {

                $.ajax({
                    url : '{{ route('emp.remove') }}',
                    dataType: 'json',
                    type : 'post',
                    beforeSend: aguarde,
                    data : {
                        _token : token,
                        id     : id
                    },
                    success : function (data) {
                        console.log('Success: '+data.success);
                        if( data.success == '1' ){
                            successMsg();


                        }

                    }
                });

            });
        });
        function aguarde() {
            var mensagem = $('.msgAvisoModal');
            mensagem.empty().html( "<p class='alert alert-warning'> Aguarde um momento </p>" ).fadeIn();
        }
        function erroMsg() {
            var mensagem = $('.msgAvisoModal');
            mensagem.empty().html( "<p class='alert alert-danger'><strong>Ops</strong> Ocorreu um erro. Tente novamente mais tarde </p>" ).fadeIn();
        }

        function successMsg() {
            var mensagem = $('.msgAvisoModal');
            mensagem.empty().html( "<p class='alert alert-success'><strong>OK</strong> Opera&ccedil&atilde;o realizada com sucesso </p>" ).fadeIn();
            setTimeout(function () {
                location.reload();
            }, 3000)
        }


    </script>
@endsection