<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Relat&oacute;rio</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page { margin-top: 60px ;
                margin-bottom: 50px; }
        #header {
            position: fixed;
            left: 0px;
            top: -50px;
            right: 0px;
            height: 30px;
            background-color: orange;
            text-align: center;
        }
        #footer {
            position: fixed;
            left: 0px;
            bottom: -40px;
            right: 0px;
            height: 30px;
            background-color: lightblue;
        }

        #footer
        .page:after { content: counter(page, upper-roman); }

        table.bordasimples {border-collapse: collapse;}

        table.bordasimples tr td  {border:1px solid #000000;}
        table.bordasimples tr th  {border:1px solid #000000;}
        .title {
            padding-bottom: 120px;
        }

    </style>
</head>
<body>

<div style="text-align: center">
    <h4></h4>
    <div id="header">
        <h3 class="title" style="margin-top: 5px;">Lista de Nomes -  Total a receber: {{ $total }} </h3>
    </div>



    <hr />
    <table width="100%" class="bordasimples">
        <thead>
        <tr>

            <th align="center"> ITEM </th>
            <th align="center"> CRACH&Aacute;</th>
            <th align="center"> NOME </th>
            <th align="center"> EMPRESA </th>
            <th align="center"> TOTAL </th>
        </tr>
        </thead>
        <tbody>

        @foreach( $registros as $chave => $registro )
             {{ $j = 0 }}
             @if( $j > 40 )
                <tr style="page-break-before: always;">
                    <td align="center"> {{ $chave + 1 }} </td>
                    <td align="center"> {{ $registro->clientes->nr_cracha }} </td>
                    <td> {{ $registro->clientes->nm_cliente }} </td>
                    <td> {{ $registro->clientes->empresas->ds_empresa }} </td>
                    <td align="center"> R$ {{ number_format($registro->total, 2, ',', '.') }} </td>
                </tr>
              @else
                 <tr >
                     <td align="center"> {{ $chave + 1  }} </td>
                     <td align="center"> {{ $registro->clientes->nr_cracha }} </td>
                     <td> {{ $registro->clientes->nm_cliente }} </td>
                     <td> {{ $registro->clientes->empresas->ds_empresa }} </td>
                     <td align="center"> R$ {{ number_format($registro->total, 2, ',', '.') }} </td>
                 </tr>
              @endif
        @endforeach
        </tbody>
    </table>

</div>


</body>
</html>