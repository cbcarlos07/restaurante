@extends('layouts.app')

@section('content')
    <link href="{{ URL('css/chosen.min.css') }}" type="text/css" rel="stylesheet" >
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
                    <p>Deseja realmente voltar &agrave; tela clientes?</p>
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
                <li class="active"><a href="{{ route('cli.index') }}">Cliente</a> / Cadastrar Cliente</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header col-lg-9">Cadastrar Cliente</h1>

            </div>
        </div><!--/.row-->


        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="panel-body">
                        @if( \Session::has('exception')  )
                            <p class="alert alert-danger">
                               {{ \Session::get('exception') }}
                            </p>
                        @endif
                        <form action="{{ route('cli.store') }}" method="post">
                                <input id="token" type="hidden" value="{{ csrf_token() }}" name="_token"/>
                                <div class="form-group col-lg-7 {{ $errors->has('nome') ? ' has-error' : '' }}">
                                    <label for="nome">Nome</label>
                                    <input id="nome" class="form-control" name="nome" required />
                                    @if ($errors->has('nome'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('nome') }}</strong>
                                            </span>
                                    @endif
                                </div>

                                <div class="row"></div>
                                <div class="form-group col-lg-2 {{ $errors->has('cracha') ? ' has-error' : '' }}">
                                    <label for="cracha">Crach&aacute;</label>
                                    <input id="cracha" class="form-control" name="cracha" required/>
                                    @if ($errors->has('cracha'))
                                        <span class="help-block">
                                               <strong>{{ $errors->first('cracha') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group col-lg-5 {{ $errors->has('empresa') ? ' has-error' : '' }}">
                                    <label for="empresa">Empresa</label>
                                    <select id="empresa" class="form-control empresa" data-placeholder="Selecione" name="empresa">
                                        @foreach( $empresa as $empresas )
                                            <option value="{{ $empresas->id }}">{{ $empresas->ds_empresa }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('empresa'))
                                        <span class="help-block">
                                               <strong>{{ $errors->first('empresa') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-lg-2" style="margin-top: 25px;">
                                    <label for="fa"></label>
                                    <a href="#refresh" title="Clique para atualizar a lista de empresa" class="btn-refresh"><i class=" fa fa-refresh" aria-hidden="true"></i></a>
                                </div>


                                <div class="row"></div>
                                <div class="form-group col-lg-2 {{ $errors->has('cep') ? ' has-error' : '' }}">
                                    <label for="cep">CEP</label>
                                    <input id="cep" class="form-control" name="cep" required/>
                                    @if ($errors->has('cep'))
                                        <span class="help-block">
                                               <strong>{{ $errors->first('cep') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="row"></div>
                                <div class="form-group col-lg-6 ">
                                    <label for="logradouro">Logradouro</label>
                                    <input id="logradouro" class="form-control" />
                                </div>
                                <div class="form-group col-lg-2 {{ $errors->has('casa') ? ' has-error' : '' }}">
                                    <label for="nrcasa">No. Casa</label>
                                    <input id="nrcasa" class="form-control" name="casa" required/>
                                    @if ($errors->has('casa'))
                                        <span class="help-block">
                                               <strong>{{ $errors->first('casa') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="row"></div>
                                <div class="form-group col-lg-6">
                                    <label for="bairro">Bairro</label>
                                    <input id="bairro" class="form-control" />
                                </div>
                                <div class="row"></div>
                                <div class="form-group col-lg-6">
                                    <label for="complemento">Complemento</label>
                                    <input id="complemento" class="form-control" name="complemento"/>
                                </div>
                                <div class="row"></div>
                                <div class="form-group col-lg-6">
                                    <label for="email">E-mail</label>
                                    <input type="email" id="email" class="form-control" name="email" required/>
                                </div>

                                <div class="row"></div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">Telefone</div>
                                    <div class="panel-body">
                                        <div class="form-group col-lg-3">
                                            <label for="telefone">Telefone</label>
                                            <input id="telefone" class="form-control" />
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="observacao">Observa&ccedil;&atilde;o</label>
                                            <input id="observacao" class="form-control" />
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="tipo">Tipo de Telefone</label>
                                            <select id="tipo" class="form-control" >
                                                <option value="C">Celular</option>
                                                <option value="R">Residencial</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-3">
                                            <a href="#phone" class="btn btn-primary btn-add">Adicionar</a>
                                        </div>

                                        <table class="table table-hover table-striped table-fone">
                                            <thead>
                                            <tr>
                                                <th>Telefone</th>
                                                <th>Obs</th>
                                                <th width="1px">Tipo</th>
                                                <th>Descricao</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody class="tbodycad"></tbody>
                                        </table>

                                    </div>


                            </div>


                            <div class="row"></div>
                            <div class="col-lg-3">
                                <button type="submit" class="btn btn-success btn-salvar">Salvar</button>
                                <!--<button class="btn btn-warning btn-limpar">Limpar</button>-->

                                <a class="btn btn-default btn-cancelar">Voltar</a>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div><!--/.row-->



    </div><!--/.main-->

    <script src="{{ url('js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/chosen.jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.js') }}"></script>
    <script>
        $('.progress').fadeOut();
        $('.mensagem').fadeOut();



        $('.btn-cancelar').on('click', function () {
            $('.modal-question').modal('show');
            $('.btn-sim').on('click', function () {
                location.href = '{{ route('cli.index') }}';
            });
        });


        $('#empresa').chosen();
        $('#tipo').chosen();

        $(document).ready(function () {
            getEmpresa();
        });

        function getEmpresa() {

            $.ajax({
                url  : '{{ route('emp.list') }}',
                type : 'post',
                dataType : 'json',
                data : {
                    _token : '{{ csrf_token() }}'
                },
                success : function (data) {
                    var empresa = $('.empresa');
                    console.log( typeof  empresa);
                //    empresa.find('option').remove();
                    console.log( data );
                    empresa.append(
                        "<option value='0'>1</option>"
                    );
                   /* $.each( data, function (i, j) {
                        console.log( j.id+ ' - '+j.ds_empresa );
                        empresa.append(
                            $('<option />').val( j.id ).text( j.ds_empresa )
                        );
                    } )*/
                }
            });

        }


        $('.btn-add').on('click',function () {
            // alert("Add");
            var corpo = $('.tbodycad');
            var telefone    = $('#telefone').val();
            var observacao  = $('#observacao').val();
            var tipo        = $('#tipo').val();
            var dsTipo      = $('#tipo option:selected').text();
            var fone = "";
            /*    if(telefone.length <= 11){
                    if( telefone.length === 11 ){
                      fone = "("+telefone.substr(0,2)+")"+telefone.substr(2,5)+"-"+telefone.substr(7,4);
                    }else if( telefone.length === 9 ){

                    }
                }else{
                    fone = "("+telefone.substr(0,2)+")"+telefone.substr(2,4)+"-"+telefone.substr(6,4);
                }*/
            console.log( "Tipo: "+tipo );
            var content = "<tr>"+
                "  <td> <input name='telefone[]' value='"+telefone+"'></td>"+
                "  <td> <input name='obs[]' value='"+observacao+"'></td>"+
                "  <td> <input name='tipo[]' value='"+tipo+"' size='1'></td>"+
                "  <td> <input name='dstipo[]' value='"+dsTipo+"'></td>"+
                "  <td><a href='#div' class='btn btn-danger btn-remove btn-xs'>remover</a></td>"+
                "</tr>";
            $(corpo).append(content);
            $('#telefone').val("");
            $('#observacao').val("");
            $('#tipo').val('C');
            //document.getElementById('tipo').selectedIndex = "0";

        });

        $(".tbodycad").on("click", ".btn-remove", function(e){
            $(this).closest('tr').remove();
        });

        $('#cep').on("focusout", function () {
            buscarCEP();
            $('#nrcasa').focus();
        })

        function buscarCEP() {
            //alert("CE OUt");
            var text_cep = $('#cep').val();
            var cep = text_cep.replace(".","").replace("-","");
            //alert('Buscar CEp');
            //Preenche os campos com "..." enquanto consulta webservice.
            $("#logradouro").val("...");
            $("#bairro").val("...");

            //Consulta o webservice viacep.com.br/
            $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                if (!("erro" in dados)) {
                    //Atualiza os campos com os valores da consulta.
                    $("#logradouro").val(dados.logradouro);
                    $("#bairro").val(dados.bairro);
                } //end if.
                else {
                    //CEP pesquisado não foi encontrado.
                    //limpa_formulário_cep();
                    errosend("CEP não encontrado.");
                }
            });
        }

        $('#cep').mask('00.000-000');



    </script>
@endsection