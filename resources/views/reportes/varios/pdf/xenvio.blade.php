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
    <center><h1><b>Reporte manifiesto por ciudades de destino</b></h1></center>
    <div class="datagrid">
        <table>
            <thead>
                <tr>
                    <th>N° Guia</th>
                    <th>Fecha Envio</th>
                    <th>Ciudad origen</th>
                    <th>Nom. Remitente</th>
                    <th>Nom. Destinatario</th>
                    <th>Forma Pago</th>
                    <th>Num. Items</th>
                    <th>Valor de la Guia</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($guiasXenvio as $guia)
                {
                    <tr>
                        <td>{{ $guia->num_guia }}</td>
                        <td>{{ $guia->fecha_emision }}</td>
                        <td>{{ $guia->ciudad_origen }}</td>
                        <td>{{ $guia->nom_remitente }}</td>
                        <td>{{ $guia->nom_destinatario }}</td>
                        <td>{{ $guia->descripcion }}</td>
                        <td>{{ $guia->cantidad }}</td>
                        <td style="text-align: right;">{{ $guia->valor_guia }}</td>                       
                    </tr>
                }
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7" style="text-align: left;">Total de dinero de las Guias</td>
                    @foreach ( $sumaXciudad as $reg )
                        <td style="text-align: right;">{{ $reg->total }}</td>
                    @endforeach
                    
                </tr>
            </tfoot>
        </table>
    </div>
        <br>
        <br>
    <center><h1><b>Numero de guias por cada provincia</b></h1></center>
    <div class="datagrid">
        <table>
            <thead>
                <tr>
                    <th>Ciudad Origen</th>
                    <th>Ciudad destino</th>
                    <th>Numero de Items</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $contarXciudad as $reg)
                    <tr>
                        <td>{{ $reg->ciudad_origen }}</td>
                        <td>{{ $reg->ciudad_destino }}</td>
                        <td>{{ $reg->total }}</td>
                    </tr>                
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>