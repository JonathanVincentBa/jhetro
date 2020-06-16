@extends ('layouts.admin')
@section ('contenido')
<div class="row">
    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label>Fecha de emision</label><br>
            <p>{{ $manifiesto->created_at }}</p>
        </div>
    </div>
    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label>Vehiculo</label>
            <p>{{ $manifiesto->vehiculo }}</p>
        </div>
    </div>
    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label>Chofer</label>
            <p>{{ $manifiesto->chofer }}</p>
        </div>
    </div>
    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <a href="{{URL::action('ManifiestoController@index')}}"><button class="btn btn-info">Regresar</button></a>
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label>Ciudad Origen</label>
            <p>{{ $manifiesto->ciudad_origen }}</p>
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label>Ciudad Destino</label>
            <p>{{ $manifiesto->ciudad_destino }}</p>
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label>Creador</label>
            <p>{{ $manifiesto->name }}</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                    <thead style="background-color:#A9D0F5 ">
                        <th>N° Guia</th>
                        <th>Fecha de Envio</th>
                        <th>Remitente</th>
                        <th>Destinatario</th>
                        <th>Valor de Guia</th>
                    </thead>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="font-family: Arial; font-size: 12pt;"><br>$ {{ $manifiesto->valor }}</h4></td>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($detalles as $det)
                            <tr>
                                <td>{{ $det->num_guia }}</td>
                                <td>{{ $det->fecha_emision }}</td>
                                <td>{{ $det->nom_remitente }}</td>
                                <td>{{ $det->nom_destinatario }}</td>
                                <td>{{ $det->valor_guia }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

