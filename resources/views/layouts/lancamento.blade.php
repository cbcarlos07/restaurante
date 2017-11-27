@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/chosen.min.css') }}" type="text/css" rel="stylesheet" >
    <div class="progress" style="margin-top: -50px; position: absolute; z-index: 2;">
        <div class="indeterminate"></div>
    </div>
    <div class="mensagem "
         style="margin-top: -65px; margin-left: -15px; text-align: center; width: 110%; position: relative; font-size: 12px; z-index: 3">
        <p class="alert alert-success">Mensagem de retorno</p>
    </div>


    <div class="modal fade modal-pay" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog " role="document">

            <div class="modal-content">
                <input type="hidden" id="cdregistro">

                <div class="msgAvisoModal"
                     style="margin-top: 0;  text-align: center; width: 100%; position: relative; font-size: 12px; z-index: 3">
                    <p class="alert alert-success">Mensagem de retorno</p>
                </div>

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirmar Pagamento</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="cdregistro">

                    <p>Confirmar pagamento no valor de: </p>
                    <div class="col-lg-3"></div>
                    <div class="panel panel-default col-lg-6">
                        <!--<div class="panel-heading" style="text-align: center">Total</div>-->
                        <div class="panel-body" style="color: red; font-size: 35px; font-weight: bold; text-align: center">
                            <span class="vl-total"></span>
                        </div>
                    </div>
                    <div class="col-lg-3"></div>
                    <div class="row"></div>

                    <div class="col-lg-3"></div>
                    <div class="panel panel-default col-lg-6" >
                        <div class="panel-heading" style="text-align: center">Valor Pago</div>
                        <div class="panel-body" style="color: blue; font-size: 35px; font-weight: bold; text-align: center">
                            <div class="col-lg-3"></div>
                            <input type="text" id="valorpago" class="col-lg-12" style="text-align: center" placeholder="R$ 0,00">

                            <div class="col-lg-3"></div>
                        </div>
                    </div>

                    <div class="row"></div>

                    <div class="col-lg-3"></div>
                    <div class="panel panel-default col-lg-6" >
                        <div class="panel-heading" style="text-align: center">Troco</div>
                        <div class="panel-body" style="color: green; font-size: 35px; font-weight: bold; text-align: center">
                            <div class="col-lg-3"></div>
                            <input type="text" id="troco" class="col-lg-12" style="text-align: center" disabled>

                            <div class="col-lg-3"></div>
                        </div>
                    </div>


                    <div class="row"></div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-yes">Sim</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div class="modal fade modal-registro" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">

            <div class="modal-content">

                <div class="msgAvisoModal"
                     style="margin-top: 0;  text-align: center; width: 100%; position: relative; font-size: 12px; z-index: 3">
                    <p class="alert alert-success">Mensagem de retorno</p>
                </div>

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Novo Registro</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group col-lg-12 combo_cliente">
                        <label for="cliente">Cliente</label>
                        <select  id="cliente" class="form-control" data-placeholder="Escolha um cliente">
                            <option value="0">Selecione um cliente</option>
                            @foreach( $clientes as $cliente )
                                <option value="{{ $cliente->id }}">{{ $cliente->nm_cliente }}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr >
                    <div class="col-lg-4"></div>
                    <div class="panel panel-default col-lg-4">
                        <div class="panel-heading" style="text-align: center">Total</div>
                        <div class="panel-body" style="color: green; font-size: 35px; font-weight: bold; text-align: center">
                            <span class="vl-total"></span>
                        </div>
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="row"></div>
                    <div class="form-group col-lg-2">
                        <label for="qtde">Qtde</label>
                        <input id="qtde" class="form-control" type="number" value="1" min="1"/>
                    </div>
                    <div class="form-group col-lg-6 combo_produto">
                        <label for="produto">Produto</label>
                        <select  id="produto" class="form-control" data-placeholder="Escolha um produto">
                            <option value="0">Selecione um produto</option>
                            @foreach( $itens as $item )
                                <option value="{{ $item->id }}" >{{ $item->ds_item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-2">
                        <label for="valor">Valor Unit</label>
                        <input id="valor" class="form-control" />
                    </div>
                    <div class="form-group col-lg-2">
                        <label for="subtotal">Valor Total</label>
                        <input id="subtotal" class="form-control" style="color: blue; font-weight: bold"/>
                    </div>
                    <div class="row"></div>
                    <div class="form-group checkbox col-lg-2">
                        <label>
                            <input type="checkbox" id="pago" >Pago ?
                        </label>
                    </div>
                    <div class="row"></div>
                    <button class="btn btn-success btn-adicionar">Adicionar</button>
                    <div class="row"></div>

                    <table class="tb-produtos table table-hover">
                        <thead>
                        <th>#</th>
                        <th>Descri&ccedil;&atilde;o</th>
                        <th>Qtde</th>
                        <th>Valor</th>
                        </thead>
                        <tbody id="tb-itens"></tbody>
                    </table>


                    <div class="row"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sim">Salvar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->




    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li class="active">Lan&ccedil;amentos</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-12">
                    <h1 class="col-lg-9">Lan&ccedil;amento</h1>
                    <button class="btn btn-primary col-lg-1 btn-novo" style="margin-top: 50px;">Novo Registro</button>
                    <button class="btn btn-warning col-lg-1 btn-print" style="margin-top: 50px;">Imprimir</button>
                </div>
            </div>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="form-group col-lg-2">
                    <label for="total">Total a Receber</label>
                    <div class="panel panel-default"><span class="total"></span></div>
                </div>

            </div>

            <div class="col-lg-12">

                <form action="{{ route('lanc.pesquisar') }}" method="post" >
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group col-lg-5 {{ $errors->has('search') ? ' has-error' : '' }}">
                        <label for="nome">Cliente</label>
                        <input class="form-control" name="search" id="nome" placeholder="Nome ou crach&aacute;">
                        @if( $errors->has('search') )
                            <span class="help-block" style="text-align: center">
                               <strong>{{ $errors->first('search') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-lg-5">
                        <button type="submit"  href="#click" class="btn btn-success btn-pesq" style="margin-top: 25px;">
                            <i class="glyphicon glyphicon-search"></i> Pesquisar
                        </button>
                    </div>
                </form>
            </div>
        </div>

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

                                    <th >NOME</th>
                                    <th >CRACH&Aacute;</th>
                                    <th >EMPRESA</th>
                                    <th >VALOR</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody class="tbody">
                                @foreach( $registros as $registro )
                                    <tr>
                                        <td> {{ $registro->clientes->nm_cliente }} </td>
                                        <td> {{ $registro->clientes->nr_cracha }} </td>
                                        <td> {{ $registro->clientes->empresas->ds_empresa }} </td>
                                        <td> R$ {{ number_format($registro->valor, 2, ',', '.') }} </td>
                                        <td>
                                            <a href="#" class="btn btn-detail btn-primary"  data-id="{{ $registro->cliente }}"><i class="glyphicon glyphicon-new-window"></i> Detalhes </a>
                                            <a href="#" class="btn btn-pay btn-success"   data-id="{{ $registro->cliente }}" data-valor="{{ $registro->valor }}"><i class="glyphicon glyphicon-saved"></i> Registrar Pagamento </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div style="text-align: center">
                                {{ $registros->links() }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div><!--/.row-->



    </div><!--/.main-->
    @section('js')
        <script src="{{ url('js/chosen.jquery.min.js') }}"></script>
        <script src="{{ asset('js/jquery.mask.js') }}"></script>
        <script src="{{ asset('js/jquery.tabletojson.min.js') }}"></script>
        <script>



            $('#cliente').trigger('chosen:updated');




            //$('#cliente', '.modal-registro').chosen('destroy').chosen( {allow_single_deselect: true} );
            $('.progress').fadeOut();
            $('.mensagem').fadeOut();
            $('.msgAvisoModal').fadeOut();

            $(document).on('show.bs.modal', '.modal-registro', function () {
                $('#cliente', this).chosen('destroy').chosen( {allow_single_deselect: true} );
            });


            $(document).ready( function () {
                calcularTotalReceber();
            } );
            /*$('.modal-registro').on('shown.bs.modal', function () {
                $('#cliente', this).chosen('destroy').chosen( {allow_single_deselect: true} );
                $('#produto', this).chosen('destroy').chosen( {allow_single_deselect: true} );
                console.log('MOdal registro');
            });*/

            $('.btn-novo').on('click', function () {
                $('.modal-registro').modal('show');
            });
            $('#produto').on('change', function () {
                var id = $(this).val();
                if (id > 0 ){
                    getValor( id );
                    $('.combo_produto').removeClass('has-error');
                }else{
                    $('#valor').val("");
                    $('#subtotal').val("");


                }

            });

            $('#cliente').on('change', function () {
                $('.combo_cliente').removeClass('has-error');
            });
            var valor;
            function getValor( id ) {
                $.ajax({
                    url : '{{ route('item.getValue') }}',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token : '{{ csrf_token() }}',
                        id   :  id
                    },
                    success : function (data) {

                        valor = data.vl_item;
                        $('#valor').val( formataDinheiro( parseFloat( data.vl_item ) ) );
                        calcularSubTotal();

                    }
                });
            }


            function formataDinheiro( n ) {
                return "R$ " + n.toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1.");
            }

            function calcularSubTotal() {
                var qtde = $('#qtde').val();

                var subTotal = qtde * parseFloat( valor );

                $('#subtotal').val( formataDinheiro( subTotal ) )
            }

            $('.btn-adicionar').on('click', function () {
                //  console.log("Adicionar");
                if( ( $('#cliente').val() > 0 ) &&  ( $('#produto').val() > 0 ) ) {
                    adicionarItemTable();
                    $('#cliente.chosen-container-single').removeClass('required');
                    $('.combo_cliente').removeClass('has-error');
                    $('.combo_produto').removeClass('has-error');
                }else{

                    if( $('#cliente').val() == 0 ){
                        console.log("Falta selecionar um cliente");
                        /*  $('#cliente_chosen').addClass('required');*/
                        $('.combo_cliente').addClass('has-error');
                    }

                    if( $('#produto').val() == 0 ){
                        //$('#produto_chosen').addClass('required');
                        $('.combo_produto').addClass('has-error');
                    }
                }

            });

            function adicionarItemTable() {
                var produto = $('#produto :selected');
                var item = produto.val();
                var qtde = $('#qtde').val();
                var desc = produto.text();
                var valor = $('#subtotal').val();
                /*  console.log("Item: "+item);
                  console.log("Qtde: "+qtde);
                  console.log("Descricao: "+desc);
                  console.log("Valor: "+valor);*/

                var linha = "" +
                    "<tr>" +
                    "<td>"+ item +"</td>"+
                    "<td>"+ desc +"</td>"+
                    "<td>"+ qtde +"</td>"+
                    "<td>"+ valor +"</td>"+
                    "  <td><a href='#div' class='btn btn-danger btn-remove btn-xs'>remover</a></td>"+
                    "</tr>";
                $('#tb-itens').append( linha );

                calcularTotal();

            }

            $("#tb-itens").on("click", ".btn-remove", function(e){
                $(this).closest('tr').remove();
            });


            function calcularTotal() {
                var valor = 0;
                $('.tb-produtos').find('tr').each(function(indice){
                    var tableData = $(this).children("td").map(function()         {
                        return $(this).text();
                    }).get();
                    //console.log("Clique: "+$.trim(tableData[0]));
                    var dado = $.trim(tableData[3]) ;
                    //  console.log("Dado: "+dado);
                    if( dado != "" )
                        valor +=  parseFloat( dado.replace("R$ ","").replace(",",".") );
                });

                //  console.log( "Total: "+valor );
                $('.vl-total').text( formataDinheiro( valor ) );
            }


            function calcularTotalReceber() {
                var valor = 0;
                $('.tbody').find('tr').each(function(indice){
                    var tableData = $(this).children("td").map(function()         {
                        return $(this).text();
                    }).get();
                    //console.log("Clique: "+$.trim(tableData[0]));
                    var dado = $.trim(tableData[3]) ;
                    //  console.log("Dado: "+dado);
                    if( dado != "" )
                        valor +=  parseFloat( dado.replace("R$ ","").replace(",",".") );
                });

                //  console.log( "Total: "+valor );
                $('span.total').text( formataDinheiro( valor ) );
            }

            $('.btn-sim').on('click', function () {
                salvarItens();
            });



            $('#valorpago').on('input', function () {
                calcularTroco();
            });

            function calcularTroco() {
                console.log("Calcular troco");
                var idTroco = $('input[id="troco"]');
                var strTotal = $('span.vl-total').text();
                var fTotal = parseFloat( strTotal.replace("R$ ","").replace(",",".") );

                var strValor = $('#valorpago').val(  );
                var fValor   = parseFloat( strValor.replace( "R$ ","" ).replace( ",","." ) )

                var vTroco = fValor - fTotal;

                idTroco.val(  formataDinheiro( vTroco )  );

                if( vTroco < 0){
                    idTroco.css( "color", "red" );
                }else{
                    idTroco.css( "color", "green" );
                }


            }

            function salvarItens() {

                var pessoa = $('#cliente').val();
                var tabela  = getDataTable();
                // tabela = tableToJson(tabela);
                var itens   = JSON.stringify( tabela );
                var pago    = $('#pago');
                var snpago = "N";
                if( pago.is(":checked") ){
                    snpago = "S";
                }

                $.ajax({
                    url  : '{{ route('lanc.registrar') }}',
                    type : 'post',
                    dataType: 'json',
                    beforeSend : aguardandoModal,
                    data : {
                        _token : '{{ csrf_token() }}',
                        cliente : pessoa,
                        pago   : snpago,
                        itens  : itens
                    },
                    success : function (data) {
                        if( data.retorno > 0 ){
                            msgSucessoModal();
                        }else{
                            erroSendModal();
                        }
                    }
                })

            }
            function getDataTable() {
                var table = new Array();
                $('.tb-produtos tr').each( function (row, tr) {
                    table[row]={
                        '#'   :  $(tr).find( 'td:eq(0)' ).text( ),
                        'Qtde'   :  $(tr).find( 'td:eq(2)' ).text( ),
                        'Valor'   :  $(tr).find( 'td:eq(3)' ).text( )
                    }
                });
                table.shift();
                return table;
            }




            function aguardando() {
                $('.progress').fadeIn();
            }

            function erroSend() {
                var mensagem = $('.mensagem');
                mensagem.empty().html("<p class='alert alert-danger'><strong>Ops</strong> Ocorreu um erro ao processar sua requisi&ccedil;&atilde;o </p>").fadeIn();
                setTimeout(function () {
                    mensagem.fadeOut('slow');
                }, 3000)

            }

            function aguardandoModal() {
                var mensagem = $('.progressModal');
                mensagem.empty().html("<p class='alert alert-danger'><strong>Ops</strong> Ocorreu um erro ao processar sua requisi&ccedil;&atilde;o </p>").fadeIn();
                setTimeout(function () {
                    mensagem.fadeOut('slow');
                }, 3000)

            }

            function erroSendModal() {
                var mensagem = $('.msgAvisoModal');
                mensagem.empty().html("<p class='alert alert-danger'><strong>Ops</strong> Ocorreu um erro ao processar sua requisi&ccedil;&atilde;o </p>").fadeIn();
                setTimeout(function () {
                    mensagem.fadeOut('slow');
                }, 3000)

            }

            function msgSucesso() {
                var mensagem = $('.mensagem');
                mensagem.empty().html("<p class='alert alert-success'><strong>Parab&eacute;ns</strong> Opera&ccedil;&atilde;o realizada com sucesso! </p>").fadeIn();
                setTimeout(function () {
                    mensagem.fadeOut();
                    location.href = "pessoa.php";
                },3000);
            }


            function msgSucessoModal() {
                var mensagem = $('.msgAvisoModal');
                mensagem.empty().html("<p class='alert alert-success'><strong>Parab&eacute;ns</strong> Opera&ccedil;&atilde;o realizada com sucesso! </p>").fadeIn();
                setTimeout(function () {
                    location.reload();
                    preencherTabela();
                },3000);
            }


            $('.btn-detail').on('click', function () {

                var id = $(this).data('id');

                var form = $('<form action="{{ route('lanc.registro') }}" method="post">' +
                    '<input type="hidden" name="_token" value="{{ csrf_token() }}">'+
                    '<input type="hidden" name="id" value="'+id+'">'+
                    '</form>');
                $('body').append( form );
                form.submit();

            });

            $('.btn-pay').on('click', function () {
                var id = $(this).data('id');
                var total = $(this).data( 'valor' );
                console.log("Total: "+formataDinheiro( parseFloat( total ) ));

                calcularTotal();
                $('.modal-pay').modal('show');
                $('span.vl-total').text( formataDinheiro( parseFloat( total )) );
                //calcularTroco();
                $('.btn-yes').on( 'click', function () {
                    $.ajax({
                        url : '{{ route('lanc.pagamento') }}',
                        type: 'post',
                        dataType: 'json',
                        beforeSend : aguardandoModal(),
                        data: {
                            _token : '{{ csrf_token() }}',
                            id : id
                        },
                        success : function (data) {
                            if( data.retorno > 0 ){
                                msgSucessoModal();
                            }else{
                                erroSendModal();
                            }
                        }
                    })
                } );

            });


            $('.btn-print').on('click', function () {
                var total = $('span.total').text();
                //  alert('tOTAL: '+total);
                var form = $('<form action="{{ route('lanc.imprimir') }}" method="post">' +
                    '<input type="hidden" name="_token" value="{{ csrf_token() }}">'+
                    '<input type="hidden" name="valor" value="'+total+'">'+
                    '</form>');
                $('body').append( form );
                form.submit();
            });
            </script>

    @endsection

@endsection