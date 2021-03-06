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
                    <p>Deseja realmente voltar &agrave; tela usu&aacute;rios?</p>
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
                <li class="active"><a href="{{ route('usu.index') }}">Usuario</a> / Alterar Cadastro de Usu&aacute;rio</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header col-lg-9">Alterar Cadastro de Usu&aacute;rio</h1>

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
                        <form action="{{ route('usu.update') }}" method="post">
                                <input id="token" type="hidden" value="{{ csrf_token() }}" name="_token"/>
                                <input type="hidden" value="{{ $usuario->id }}" name="id">

                                @if( \Auth::id() == $usuario->id )
                                    <input type="hidden" value="S" name="sn_atual">
                                @else
                                    <input type="hidden" value="N" name="sn_atual">
                                @endif

                                <div class="form-group col-lg-10 {{ $errors->has('nome') ? ' has-error' : '' }}">
                                    <label for="nome">Nome</label>
                                    <input id="nome" name="nome" class="form-control " required value="{{ $usuario->name }}"/>
                                    @if ($errors->has('nome'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('nome') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-lg-5 {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email">E-mail</label>
                                    <input id="email" name="email" type="email" class="form-control" required required value="{{ $usuario->email }}"/>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif


                                </div>

                                <div class="row"></div>
                                <div class="form-group col-lg-3">
                                    <label>
                                        <input type="checkbox" value="S" name="sn_ativo" checked >Ativo
                                    </label>
                                </div>

                                @if( Auth::id() == $usuario->id )
                                    <div class="form-group col-lg-3 {{ $errors->has('pwd') ? ' has-error' : '' }}">
                                        {{--<label for="senha">Digite a senha</label>--}}
                                        <input  name="password" id="senha" class="form-control" placeholder="Senha" required />
                                        @if ($errors->has('pwd'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('pwd') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-lg-3">
                                        {{--<label for="senha">Repita a senha</label>--}}
                                        <input name="password1" id="senha" class="form-control" placeholder="Repita a Senha" required />
                                    </div>
                                @else
                                    <div class="form-group col-lg-3">
                                        {{--<label for="senha">Digite a senha</label>--}}
                                        <input type="hidden" name="password" id="senha" class="form-control" placeholder="Senha" required value="12345678"/>
                                    </div>
                                    <div class="form-group col-lg-3">
                                        {{--<label for="senha">Repita a senha</label>--}}
                                        <input type="hidden" name="password1" id="senha" class="form-control" placeholder="Repita a Senha" required value="12345678"/>
                                    </div>
                                @endif



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
    <script src="{{ url('js/jquery.maskMoney.min.js') }}"></script>
    <script>
        $('.progress').fadeOut();
        $('.mensagem').fadeOut();



        $('.btn-cancelar').on('click', function () {
            $('.modal-question').modal('show');
            $('.btn-sim').on('click', function () {
                location.href = '{{ route('usu.index') }}';
            });
        });




    </script>
@endsection