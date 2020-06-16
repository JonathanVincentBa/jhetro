<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="adminlte/css/pdf.css">
</head>
<body>
    <center><h1><b>Reportes de guias por facturar y por cliente</b></h1></center>    
    <div class="datagrid">
        <table>
            <thead>
                <tr>
                    <th>N° Guia</th>
                    <th>Fecha Envio</th>
                    <th>Ciudad origen</th>
                    <th>Ciudad destino</th>
                    <th>Nom. Destinatario</th>
                    <th>N° Items</th>
                    <th>Valor de la Guia</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($guias as $guia)
                {
                    <tr>
                        <td>{{ $guia->num_guia }}</td>
                        <td>{{ $guia->fecha_emision }}</td>
                        <td>{{ $guia->ciudad_origen }}</td>
                        <td>{{ $guia->ciudad_destino }}</td>
                        <td>{{ $guia->nom_destinatario }}</td>
                        <td>{{ $guia->cantidad }}</td>
                        <td style="text-align: right;">{{ $guia->valor_guia }}</td>                       
                    </tr>
                }
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" style="text-align: left;">Total Guias</td>
                    @foreach ( $suma as $reg )
                        <td style="text-align: right;">{{ $reg->total }}</td>
                    @endforeach
                    
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>