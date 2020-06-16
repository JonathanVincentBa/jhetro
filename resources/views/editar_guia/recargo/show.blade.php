@extends ('layouts.admin')
@section ('contenido')
        <div class="row">
            <div class="col-lg-5 col-sm-5 col-md-5 col-xs-12">
                <div class="form-group">
                    <label>Fecha de emision</label><br>
                    <p>{{ $cabecera->fecha_emision }}</p>
                </div>
            </div>
            <div class="col-lg-5 col-sm-5 col-md-5 col-xs-12">
                <div class="form-group">
                    <label>Numero de Guia</label>
                    <p>{{ $cabecera->num_guia }}</p>
                </div>
            </div>
            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                <div class="form-group">
                    <a href="{{URL::action('EditarGuiaController@index')}}"><button class="btn btn-info">Regresar</button></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <div class="form-group">
                    <label>Guia Cliente</label>
                    <p>{{ $cabecera->guia_rem_cliente }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <div class="form-group">
                    <label>Factura Cliente</label>
                    <p>{{ $cabecera->factura_cliente }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <div class="form-group">
                    <label>Ciudad de Origen</label>
                    <p>{{ $cabecera->ciudad_origen }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <div class="form-group">
                    <label>Ciudad de Destino</label>
                    <p>{{ $cabecera->ciudad_destino }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <div class="form-group">
                    <label>Remitente</label>
                    <p>{{ $cabecera->nom_remitente }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <div class="form-group">
                    <label>C.I./RUC</label>
                    <p>{{ $cabecera->dni_remitente }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <div class="form-group">
                    <label>Direccion</label>
                    <p>{{ $cabecera->direccion_remitente }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <div class="form-group">
                    <label>Telefono</label>
                    <p>{{ $cabecera->fono_remitente }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <div class="form-group">
                    <label>Destinatario</label>
                    <p>{{ $cabecera->nom_destinatario }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <div class="form-group">
                    <label>C.I./RUC</label>
                    <p>{{ $cabecera->dni_destinatario }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <div class="form-group">
                    <label>Direccion</label>
                    <p>{{ $cabecera->direccion_destinatario }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <div class="form-group">
                    <label>Telefono</label>
                    <p>{{ $cabecera->fono_destinatario }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <div class="form-group">
                    <label>Motivo de Traslado</label>
                    <p>{{ $cabecera->motivo_traslado }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <div class="form-group">
                    <label>Forma de pago</label>
                    <p>{{ $cabecera->forma_pago }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <div class="form-group">
                    <label>Prima</label>
                    <p>{{ $cabecera->prima }}</p>
                </div>
            </div>
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <div class="form-group">
                    <label>Nota</label>
                    <p>{{ $cabecera->nota }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color:#A9D0F5 ">
                                <th>Cantidad</th>
                                <th>Descripcion</th>
                                <th>V. Unitario</th>
                                <th>V. Parcial</th>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                     <td style="text-align:right;"><B><br>FLETE</B></td>
                                    <td style="font-family: Arial; font-size: 12pt;"><br>$ {{ $cabecera->flete }}</h4></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align:right;"><B><br>PRIMA</B></td>
                                    <td style="font-family: Arial; font-size: 12pt;"><br>$ {{ $cabecera->prima }}</h4></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align:right;"><B><br>RECARGO</B></td>
                                    <td style="font-family: Arial; font-size: 12pt;"><br>$ {{ $cabecera->recargo }}</h4></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align:right;"><B><br>VALOR GUIA</B></td>
                                    <td style="font-family: Arial; font-size: 12pt;"><br>$ {{ $cabecera->valor_guia }}</h4></td>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($detalles as $det)
                                    <tr>
                                        <td>{{ $det->cantidad }}</td>
                                        <td>{{ $det->descripcion }}</td>
                                        <td>{{ $det->v_unitario }}</td>
                                        <td>{{ $det->v_parcial }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection