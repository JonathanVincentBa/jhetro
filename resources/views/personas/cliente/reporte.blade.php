<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/pdf.css">

    <title>Document</title>
</head>
<body>
    <center><h1><b>Reporte de Clientes</b></h1></center>
    <div class="datagrid">
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Documento</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                </tr>
            </thead>
            <tbody> 
                @foreach ($clientes as $cli)
                {
                    <tr>
                        <td>{{$cli->nombre}}</td>
                        <td>{{$cli->num_dni}}</td>
                        <td>{{$cli->direccion}}</td>
                        <td>{{$cli->telefono}}</td>
                    </tr>
                }
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>