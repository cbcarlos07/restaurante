@extends('layouts.app')

@section('content')

    <div class="progress" style="margin-top: -50px; position: absolute; z-index: 2;">
        <div class="indeterminate"></div>
    </div>
    <div class="mensagem"
         style="margin-top: -65px; margin-left: -15px; text-align: center; width: 110%; position: relative; font-size: 12px; z-index: 3">
        <p>Mensagem de retorno</p>
    </div>

    <div class="modal fade modal-question" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Aten&ccedil;&atilde;o</h4>
                </div>
                <div class="modal-body">
                    <p>Deseja realmente voltar &agrave; tela itens?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sim">Sim</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" style="z-index: -2">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li class="active"><a href="{{ route('item.index') }}">Item</a> / Alterar Cadastro de Item</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header col-lg-9">Alterar Cadastro Item</h1>

            </div>
        </div><!--/.row-->


        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <input id="token" type="hidden" value="{{ csrf_token() }}" />
                        <input id="id" type="hidden" value="{{ $item->id }}" />
                        <div class="form-group col-lg-5">
                            <label for="descricao">Descri&ccedil;&atilde;o</label>
                            <input id="descricao" class="form-control" value="{{ $item->ds_item }}" />
                        </div>

                        <div class="row"></div>
                        <div class="form-group col-lg-5 ">
                            <label for="preco">Pre&ccedil;o</label>
                            <input id="preco" class="form-control" value="R$ {{ number_format($item->vl_item, 2, ',', '.') }}"/>
                        </div>

                        <div class="row"></div>
                        <div class="col-lg-3">
                            <button class="btn btn-success btn-salvar">Salvar</button>
                            <!--<button class="btn btn-warning btn-limpar">Limpar</button>-->

                            <button class="btn btn-default btn-cancelar">Voltar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.row-->



    </div><!--/.main-->

    <script src="{{ url('js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
    <script src="{{ url('js/jquery.maskMoney.min.js') }}"></script>
    <script>
        $('.progress').fadeOut();
        $('.mensagem').fadeOut();

        $('.btn-salvar').on('click', function () {
            console.log('Click');
           var token = $('#token').val();
           var descricao  = $('#descricao').val();
           var valor = $('#preco').val();
           var id    = $('#id').val();
            valor = valor.replace( "R$ ","" ).replace( ",", "." );
       //    console.log( nome );
           $.ajax({
               url  : '{{ route('item.update') }}',
               type : 'post',
               dataType : 'json',
               data : {
                   _token    : token,
                   descricao : descricao,
                   valor     : valor,
                   id        : id
               },
                success : function (data) {
                   console.log( data );
                    if( data.success === 1 ){
                        var mensagem = $('.mensagem');
                        mensagem.empty().html( "<p class='alert alert-success'>Salvo com sucesso</p>" ).fadeIn();
                        setTimeout(function () {
                            location.href = '{{ route('item.index') }}';
                        }, 2000);

                    }
                }
           });
        });

        $('.btn-cancelar').on('click', function () {
            $('.modal-question').modal('show');
            $('.btn-sim').on('click', function () {
                location.href = '{{ route('item.index') }}';
            });
        });



        $("#preco").maskMoney({
            prefix: "R$ ",
            decimal: ",",
            thousands: "."
        });



    </script>
@endsection