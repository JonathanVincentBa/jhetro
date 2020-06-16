<table>
    <thead>
        <tr>
            <th>N° Guia</th>
            <th>Cantidad</th>
            <th>Fecha Envio</th>
            <th>Ciudad origen</th>
            <th>Ciudad destino</th>
            <th>Nom. Remitente</th>
            <th>Nom. Destinatario</th>
            <th>Valor de la Guia</th>
            <th>Descripcion</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($guiasXciudad as $guia)
        {
            <tr>
                <td>{{ $guia->num_guia }}</td>
                <td>{{ $guia->cantidad }}</td>
                <td>{{ $guia->fecha_emision }}</td>
                <td>{{ $guia->ciudad_origen }}</td>
                <td>{{ $guia->ciudad_destino }}</td>
                <td>{{ $guia->nom_remitente }}</td>
                <td>{{ $guia->nom_destinatario }}</td>
                <td>{{ $guia->valor_guia }}</td>
                <td>{{ $guia->descripcion}}</td>
            </tr>
        }
        @endforeach
    </tbody>
</table>