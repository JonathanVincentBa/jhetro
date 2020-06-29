<table class="table table-striped">
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