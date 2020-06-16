@extends ('layouts.admin')
@section ('contenido')
{!!Form::open(array('url'=>'caja/reportes/usuario','method'=>'POST','autocomplete'=>'off'))!!}
	{{Form::token()}}
        <h3>Creacion de Cajas <button class="btn btn-primary" type="submit">Generar</button></h3>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div>
                    <label for="">Usuario:</label>
                    <input type="text" readonly name="usuario" class="form-control" value="{{Auth::user()->name}}" placeholder="Usuario..." onKeyUp="this.value=this.value.toUpperCase();">
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="">Fecha:</label>
                    <input type="text" readonly name="fecha" class="form-control" value="<?php echo date("d/m/Y");?>" placeholder="Fecha..." onKeyUp="this.value=this.value.toUpperCase();">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md.12 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed able-hover">
                            <thead>
                                <th style="text-align: center;">Num. Guia</th>
                                <th style="text-align: center;">Ciudad Origen</th>
                                <th style="text-align: center;">Ciudad Destino</th>
                                <th style="text-align: center;">Remitente</th>
                                <th style="text-align: center;">Fecha de Creación</th>
                                <th style="text-align: center;">Valor de la guia</th>
                            </thead>
                            <tbody>
                                @foreach($guias as $guia)
                                    <tr>
                                        <td>{{$guia->num_guia }}</td>
                                        <td>{{$guia->ciudad_origen}}</td>
                                        <td>{{$guia->ciudad_destino}} </td>
                                        <td>{{$guia->nom_remitente}} </td>
                                        <td>{{$guia->created_at}} </td>
                                        <td style="text-align: right;">{{$guia->valor_guia}} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                        <td colspan="5" style="text-align: left;">Total de dinero de las Guias</td>
                                    @foreach ( $suma as $reg )
                                        <td style="text-align: right;">{{ $reg->total }}</td>
                                    @endforeach
                                    
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
    {!! Form::close() !!}
@endsection