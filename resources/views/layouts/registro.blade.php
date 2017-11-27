@extends('layouts.app')

@section('content')
    <div class="progress" style="margin-top: -50px; position: absolute; z-index: 2;">
        <div class="indeterminate"></div>
    </div>
    <div class="mensagem "
         style="margin-top: -65px; margin-left: -15px; text-align: center; width: 110%; position: relative; font-size: 12px; z-index: 3">
        <p class="alert alert-success">Mensagem de retorno</p>
    </div>
    <div class="modal fade modal-registro" tabindex="-1" role="dialog" data-backdrop="static">
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
                    <button type="button" class="btn btn-primary btn-sim">Sim</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li class="active">Lan&ccedil;amento / Registros</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="col-lg-9">Registros</h1>
                <button class="btn btn-primary col-lg-2 btn-multiple" style="margin-top: 50px;" disabled>M&uacute;ltiplos Pagamentos</button>
            </div>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="form-group col-lg-1">
                    <label for="cracha">Crach&aacute;</label>
                    <div class="panel panel-default"><span class="cracha">{{ $cliente->nr_cracha }}</span></div>
                </div>
                <div class="form-group col-lg-5">
                    <label for="nome">Nome</label>
                    <div class="panel panel-default"><span class="nome">{{ $cliente->nm_cliente }}</span></div>
                </div>
                <div class="row"></div>
                <div class="form-group col-lg-4">
                    <label for="empresa">Empresa</label>
                    <div class="panel panel-default"><span class="empresa">{{ $cliente->empresas->ds_empresa }}</span></div>
                </div>
                <div class="form-group col-lg-2">
                    <label for="total">Total</label>
                    <div class="panel panel-default"><span class="total">R$ {{ number_format($total[0]->valor, 2, ',', '.') }}</span></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <table class="table table-responsive table-hover table-stripped">
                            <thead>
                            <tr>
                                <!--<th data-field="state" data-checkbox="true" >ID</th>-->
                                <th><input type="checkbox" id="checkHead"></th>
                                <th >#</th>
                                <th >Produto</th>
                                <th >Qtde</th>
                                <th >Valor</th>
                                <th >Data</th>
                                <th ></th>
                            </tr>
                            </thead>
                            <tbody class="tbody">
                               @foreach( $registros as $registro)
                                   <tr>
                                       <td><input type="checkbox" id="check" data-valor="{{ $registro->vl_preco }}" value="{{ $registro->id }}"  class='chcktbl'></td>
                                       <td>{{ $registro->id }}</td>
                                       <td>{{ $registro->itens->ds_item }}</td>
                                       <td>{{ $registro->qt_compra }}</td>
                                       <td>R$ {{ number_format( $registro->vl_preco, 2, ',', '.') }}</td>
                                       <td>{{ $registro->dt_registro }}</td>
                                       <td><a class="btn btn-success btn-pay-one" data-valor="{{ $registro->vl_preco }}" data-id="{{ $registro->id }}">Registar Pagamento</a></td>
                                   </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!--/.row-->



    </div><!--/.main-->

    <script src="{{ asset('js/jquery-3.2.1.js') }}"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
    <script src="{{ url('js/chosen.jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.js') }}"></script>
    <script src="{{ asset('js/jquery.tabletojson.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.progress').fadeOut();
            $('.mensagem').fadeOut();
            $('.msgAvisoModal').fadeOut();
        });



        $('#valorpago').on("input", function () {
            calcularTroco();
        });




        $('.btn-pay-one').on('click', function () {
            var valor = $(this).data('valor');
            var id = $(this).data('id');
            console.log("Id do registro: "+id);
            $('span.vl-total').html( formataDinheiro( parseFloat( valor ) ) );
            var divValor = $('#valorpago');
            //divValor.val( "R$ 0,00" );
            $('#valorpago').val( '0' );
            $('#cdregistro').val( id );
            calcularTroco();
            $('.modal-registro').modal('show');

            $('.btn-sim').on('click', function () {
                console.log("Registrar pagamento");
                registrarPagamento( id );
            });
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


        $(document).on('change', '#checkHead', function (e) {
            // console.log("Click");
            var table= $(e.target).closest('table');
            $('td input:checkbox',table).prop('checked',this.checked);
            totalChecado();
        });

        $(document).on('change', '.chcktbl', function (e) {

            totalChecado();
        });
        var numberOfChecked = 0;
        function totalChecado() {

            // numberOfChecked = $('input:checkbox:checked').length;
            numberOfChecked = $('input[class="chcktbl"]:checked').length;
            console.log("Numero checado: "+numberOfChecked);
            if( numberOfChecked > 1 ){
                $('.btn-multiple').removeAttr("disabled");
            }else{
                $('.btn-multiple').attr("disabled",true);
            }
        }

        function formataDinheiro( n ) {
            return "R$ " + n.toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1.");
        }


        $('.btn-multiple').on('click', function () {
            var valor = 0;
            var id = [];
            $('.chcktbl:checked').each(function () {

                //   console.log( "Codigo: "+$(this).val()+" Valor: "+$(this).data('valor') );

                valor += parseFloat( $(this).data('valor') );

                id.push( $(this).val() );




            });

            $('span.vl-total').html( formataDinheiro( valor ) );
            var divValor = $('#valorpago');
            //divValor.val( "R$ 0,00" );

            calcularTroco();
            $('.modal-registro').modal('show');

            $('.btn-sim').on('click', function () {
                $.each( id, function (i, j) {
                    console.log("Registrar pagamento: "+i);

                    registrarPagamento( id[i] );
                } );

            });
        });


        function registrarPagamento( id ){
            console.log("funcao registrarPagamento");
            $.ajax({
                url  : '{{ route('lanc.pagar') }}',
                type : 'post',
                dataType : 'json',
                beforeSend: aguardandoModal,
                data : {
                    _token   : '{{ csrf_token() }}',
                    registro : id,
                },
                success : function ( data ) {
                    console.log("Retorno: "+data.retorno);
                    if( data.retorno == 1 ){
                        msgSucessoModal();
                    }else{
                        erroSendModal();
                    }
                },
                error : function (data) {
                    console.log(data);
                }
            })
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
                //  preencherTabela();
            },3000);
        }
    </script>

@endsection