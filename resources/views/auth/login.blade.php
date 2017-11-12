<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Controle de Lan&ccedil;amentos</title>

    <link href="{{ URL('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL('css/styles.css') }}" rel="stylesheet">
    <link href="{{ URL('css/loader.css') }}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="{{ URL('js/html5shiv.js') }}"></script>
    <script src="{{ URL('js/respond.min.js') }}"></script>
    <![endif]-->

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
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> Remember Me
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-sign-in"></i> Login
                            </button>

                            <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.col-->
</div><!-- /.row -->



<script src="{{ URL('js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ URL('js/bootstrap.min.js') }}"></script>
<script>
    $('.progress').fadeOut();
</script>
</body>

</html>

