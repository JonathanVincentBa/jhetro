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
    <center><h1><b>Reporte de guias anuladas</b></h1></center>
    <div class="datagrid">
        <table>
            <thead>
                <tr>
                    <th>N° Guia</th>
                    <th>Fecha Envio</th>
                    <th>Ciudad origen</th>
                    <th>Ciudad destino</th>
                    <th style="width: 15%;">Nom. de quien anulo</th>
                    <th>Valor Guia</th>
                    <th>Nota</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($guiasAnuladas as $guia)
                {
                    <tr>
                        <td>{{ $guia->num_guia }}</td>
                        <td>{{ $guia->fecha_emision }}</td>
                        <td>{{ $guia->ciudad_origen }}</td>
                        <td>{{ $guia->ciudad_destino }}</td>
                        <td style="width: 15%;">{{ $guia->name }}</td>
                        <td style="text-align: right;">{{ $guia->valor_guia }}</td>                    
                        <td>{{ $guia->nota }}</td>   
                    </tr>
                }
                @endforeach
            </tbody>
            <tfoot>
                
            </tfoot>
        </table>
    </div>
</body>
</html>