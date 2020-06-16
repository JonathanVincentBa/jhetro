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
    <center><h1><b>Reporte al cobro por ciudades de destino y por fechas</b></h1></center>
    <div class="datagrid">
        <table>
            <thead>
                <tr>
                    <th>N° Guia</th>
                    <th>Fecha Envio</th>
                    <th>Ciudad origen</th>
                    <th>Ciudad destino</th>
                    <th>Nom. Destinatario</th>
                    <th>Forma Pago</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($guiasXciudad as $guia)
                {
                    <tr>
                        <td>{{ $guia->num_guia }}</td>
                        <td>{{ $guia->fecha_emision }}</td>
                        <td>{{ $guia->ciudad_origen }}</td>
                        <td>{{ $guia->ciudad_destino }}</td>
                        <td>{{ $guia->nom_destinatario }}</td>
                        <td >{{ $guia->descripcion }}</td>                       
                    </tr>
                }
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" style="text-align: left;">Total Guias</td>
                    @foreach ( $sumaXciudad as $reg )
                        <td style="text-align: right;">{{ $reg->total }}</td>
                    @endforeach
                    
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>