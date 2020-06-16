<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="adminlte/css/pdf.css">
    <title>Document</title>
    
</head>
<body>
    <center><h1><b>Reporte de guias por pagar por ciudad de origen</b></h1></center>
    <div class="datagrid">
        <table>
            <thead>
                <tr>
                    <th>N° Guia</th>
                    <th>Fecha Envio</th>
                    <th>Ciudad destino</th>
                    <th style="width: 15%;">Nom. Remitente</th>
                    <th style="width: 15%;">Nom. Destinatario</th>
                    <th>Forma Pago</th>
                    <th>Num. Items</th>
                    <th>Valor de la Guia</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($guiasXciudad as $guia)
                {
                    <tr>
                        <td>{{ $guia->num_guia }}</td>
                        <td>{{ $guia->fecha_emision }}</td>
                        <td>{{ $guia->ciudad_destino }}</td>
                        <td style="width: 15%;">{{ $guia->nom_remitente }}</td>
                        <td style="width: 15%;">{{ $guia->nom_destinatario }}</td>
                        <td >{{ $guia->descripcion }}</td>
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
    </div>
</body>
</html>