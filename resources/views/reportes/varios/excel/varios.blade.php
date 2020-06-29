<table>
            <thead>
                <tr>
                    <th>N° Guia</th>
                    <th>Fecha Envio</th>
                    <th>Ciudad origen</th>
                    <th>Ciudad destino</th>
                    <th>Nom. Remitente</th>
                    <th>Forma Pago</th>
                    <th>Valor de Guia</th>
                </tr>
            </thead>
            <tbody>
                @foreach($guiasXciudad as $guia)
                {
                    <tr>
                        <td>{{ $guia->num_guia }}</td>
                        <td>{{ $guia->fecha_emision }}</td>
                        <td>{{ $guia->ciudad_origen }}</td>
                        <td>{{ $guia->ciudad_destino }}</td>
                        <td>{{ $guia->nom_remitente }}</td>
                        <td >{{ $guia->descripcion }}</td>
                        <td >{{ $guia->valor_guia }}</td>                       
                    </tr>
                }
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" style="text-align: left;">Total Guias</td>
                    @foreach($sumaXciudad as $reg)
                        <td style="text-align: right;">{{ $reg->total }}</td>
                    @endforeach
                    
                </tr>
            </tfoot>
        </table>