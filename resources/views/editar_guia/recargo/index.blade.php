@extends ('layouts.admin')
@section ('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de Guias </h3>
        @include('editar_guia.recargo.search')
    </div>	
</div>
<div class="row">
    <div class="col-lg-12 col-md.12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed able-hover">
                <thead>
                <th>Num. Guia</th>
                <th>Ciudad Origen</th>
                <th>Remitente</th>
                <th>Ciudad Destino</th>
                <th>Destinatario</th>
                <th>Estado de pago</th>
                <th>Opciones</th>
                </thead>
                @foreach ($guias as $gui)
                <tr>
                    <td>{{$gui->num_guia}}</td>
                    <td>{{$gui->ciudad_origen}}</td>
                    <td>{{$gui->nom_remitente}}</td>
                    <td>{{$gui->ciudad_destino}}</td>
                    <td>{{$gui->nom_destinatario}}</td>
                    <td>{{$gui->estatus_cobro}}</td>
                    <td>
                        <a href="{{URL::action('EditarGuiaController@edit',$gui->id_cabecera)}}"><button class="btn btn-primary">Editar</button></a>
                        @if($gui->estatus_cobro=='Pendiente')
                        <a href="" data-target="#modal-delete-{{$gui->id_cabecera}}" data-toggle="modal"><button class="btn btn-danger">Pagar</button></a>
                        @else
                        <a href="" data-target="#modal-delete-{{$gui->id_cabecera}}" data-toggle="modal"><button class="btn btn-danger">Cancelar</button></a>	
                        @endif

                        <a href="{{URL::action('EditarGuiaController@show',$gui->id_cabecera)}}"><button class="btn btn-info">Detalle</button></a>
                    </td>
                </tr>
                @include('editar_guia.recargo.modal')
                @endforeach	
            </table>
        </div>
        {{ $guias->render() }}
    </div>
</div>
@endsection