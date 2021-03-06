<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CONTROLE DE LAN&Ccedil;AMENTO DE D&Eacute;BITOS</title>

    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('css/font-awesome.css') }}">

    <!--Icons-->
    <script src="{{ url('js/lumino.glyphs.js') }}"></script>

    <!--[if lt IE 9]>
    <script src="{{ url('js/html5shiv.js') }}"></script>
    <script src="{{ url('js/respond.min.js') }}"></script>
    <![endif]-->

</head>
<body id="app-layout">
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="z-index: 1">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><span>CONTROLE</span> DE LAN&Ccedil;AMENTO</a>
            <ul class="user-menu">
                <li class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>  {{ Auth::user()->name }}  <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#" class="btn-profile" data-id="{{ \Auth::id() }}"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
                       {{-- <li><a href="#" ><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Settings</a></li>--}}
                        <li><a href="{{ route('usu.sair') }}" class="btn-login"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>

    </div><!-- /.container-fluid -->
</nav>


<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">

    <ul class="nav menu">
        <!--<li><a href="index1.html"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
        <li><a href="widgets.html"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Widgets</a></li>
        <li><a href="charts.html"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Charts</a></li>
        <li><a href="tables.html"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Tables</a></li>-->
        <li ><a href="{{ route('lanc.index') }}"><i class="fa fa-users" aria-hidden="true"></i> Lan&ccedil;amentos</a></li>
        <li ><a href="{{ route('cli.index') }}"><i class="fa fa-rss" aria-hidden="true"></i> Cliente</a></li>
        <li ><a href="{{ route('item.index') }}"><i class="fa fa-book" aria-hidden="true"></i> Item</a></li>
        <li ><a href="{{ route('emp.index') }}"><i class="fa fa-bullhorn" aria-hidden="true"></i> Empresa</a></li>
        <li ><a href="{{ route('usu.index') }}"><i class="fa fa-user"></i> Usu&aacute;rios</a></li>




        <!--<li ><a href="graficos.php"><i class="fa fa-users" aria-hidden="true"></i> Graficos</a></li>-->
        <!--<li><a href="panels.html"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Alerts &amp; Panels</a></li>
        <li><a href="icons.html"><svg class="glyph stroked star"><use xlink:href="#stroked-star"></use></svg> Icons</a></li>
        <li class="parent ">
            <a href="#">
                <span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Dropdown
            </a>
            <ul class="children collapse" id="sub-item-1">
                <li>
                    <a class="" href="#">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 1
                    </a>
                </li>
                <li>
                    <a class="" href="#">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 2
                    </a>
                </li>
                <li>
                    <a class="" href="#">
                        <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 3
                    </a>
                </li>
            </ul>
        </li>
        <li role="presentation" class="divider"></li>-->

    </ul>
    <div class="attribution">Template by <a href="http://www.medialoot.com/item/lumino-admin-bootstrap-template/">Medialoot</a><br/><a href="http://www.glyphs.co" style="color: #333;">Icons by Glyphs</a></div>
</div><!--/.sidebar-->

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    @yield('js')
    <script>
        /**
         * Created by carlos on 20/08/17.
         */
        var selector = '.nav li';
        var url = window.location.href;
        var target = url.split('/');

        $(selector).each(function(){
            var urlAtual = target[target.length-1].split('#');
            var addressBar = $(this).find('a').attr('href');
            var alvo = addressBar.split('/');
            var link = alvo[alvo.length-1];
            //    console.log( url );
            ////  console.log(  $(this).find('a').attr('href')+" - "+ url);
            //  console.log(  link+" - "+ urlAtual[0]);
            if( link == urlAtual[0] ){
                //     console.log( "Igual" );
                // if($(this).find('a').attr('href')===urlAtual[0]){
                //    if($(this).find('a').attr('href')===($(this).find('a').attr('href'))){

                $(selector).removeClass('active');
                $(this).addClass('active');
            }
        });

        $('.btn-profile').on('click', function () {
            var id = $(this).data('id');
            console.log('ID: '+id);
            var form = $('<form action="{{ route('usu.edit') }}" method="post">'+
                            '<input type="hidden" name="_token" value="{{ csrf_token() }}">'+
                            '<input type="hidden" name="id" value="'+id+'">'+
                        '</form>');
            $('body').append( form );
            form.submit();
        })
    </script>
</body>
</html>
