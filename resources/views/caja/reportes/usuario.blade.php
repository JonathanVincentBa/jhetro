<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/pdf.css">
    <title>Document</title>
    
</head>
<body>
    <center><h1><b>CAJA DE {{Auth::user()->name}}</b></h1></center>
    <center><h1><b>FECHA: {{date("Y-m-d")}} </b></h1></center>
    <div class="datagrid">
        <table>
            <thead>
                <tr>
                    <th>N° Guia</th>
                    <th>Ciudad Origen</th>
                    <th>Ciudad destino</th>
                    <th style="width: 15%;">Nombre de Remitente</th>
                    <th style="width: 15%;">Fecha de Creacion</th>
                    <th>Valor de la Guia</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($guias as $guia)
                {
                    <tr>
                        <td>{{ $guia->num_guia }}</td>
                        <td>{{ $guia->ciudad_origen }}</td>
                        <td>{{ $guia->ciudad_destino }}</td>
                        <td style="width: 15%;">{{ $guia->nom_remitente }}</td>
                        <td style="width: 15%;">{{ $guia->created_at }}</td>   
                        <td style="text-align: right;">{{ $guia->valor_guia }}</td>                    
                    </tr>
                }
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" style="text-align: left;">Total de dinero de las Guias</td>
                    @foreach ( $suma as $reg )
                        <td style="text-align: right;">{{ $reg->total }}</td>
                    @endforeach
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>