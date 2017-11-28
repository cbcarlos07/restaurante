<!DOCTYPE html>
<html lang="pt_Br">
<head>
    <meta charset="UTF-8">
    <title>Alterar Senha</title>
    <link href="{{ url( 'css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url( 'css/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url( 'css/loader.css') }}" rel="stylesheet" type="text/css">


    {{--}}<link href="{{ asset( 'css/loader.css' }}" rel="stylesheet" type="text/css">--}}
</head>
<body>

        <div class="progress" style="margin-top: -50px; position: absolute;">
            <div class="indeterminate"></div>
        </div>
        <p class="mensagem alert" style="margin-top: -70px; margin-left: -15px; text-align: center; width: 110%;"></p>
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">Log in</div>
                    <div class="panel-body">

                        <p class="alert alert-success">Ol&aacute;, <b><span class="nome-user">{{ $user->name }}</span></b> altere sua senha agora para acessar o sistema </p>
                        <form role="form" action="{{ route( 'usu.update' ) }}" method="post">
                            <fieldset>
                                <input type="hidden" id="id" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" id="id" name="nome" value="{{ $user->name }}">
                                <input type="hidden" id="id" name="id" value="{{ $user->id }}">
                                <input type="hidden" id="email" name="email" value="{{ $user->email }}">
                                <input type="hidden" name="sn_ativo" value="S">
                                <input type="hidden" name="sn_senha_atual" value="S">
                                <div class="form-group {{ $errors->has('pwd') ? ' has-error' : '' }}">
                                    <input class="form-control" placeholder="Senha" name="password" id="pwd" type="password" autofocus="">
                                    @if ($errors->has('pwd'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('pwd') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group  {{ $errors->has('pwd1') ? ' has-error' : '' }}">
                                    <input class="form-control" placeholder="Repita a senha" name="password1" id="pwd1" type="password" value="">
                                    @if ($errors->has('pwd1'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('pwd1') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                {{--<div class="checkbox">
                                    <label>
                                        <input name="remember" id="lembrar" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>--}}
                                <button type="submit"  class="btn btn-primary btn-new-pwd">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div><!-- /.col-->
        </div><!-- /.row -->

        <script src="{{ url( 'js/jquery-1.11.1.min.js' ) }}"></script>
        <script src="{{ url( 'js/bootstrap.min.js' ) }}"></script>
        <script>
            $('.progress').fadeOut();
        </script>
      {{--  <script src="{{ url( 'js/bootstrap.min.js' }}"></script>--}}
</body>
</html>