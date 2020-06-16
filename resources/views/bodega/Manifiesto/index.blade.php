@extends('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de Manifiestos <a href="manifiesto/create"><button class="btn btn-success">Nuevo</button></a></h3>
        @include('bodega.manifiesto.search')
    </div>	
</div>
<div class="row">
    <div class="col-lg-12 col-md.12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed able-hover">
                <thead>
                    <th>Id</th>
                    <th>Vehiculo</th>
                    <th>Ciudad de Origen</th>
                    <th>Ciudad de destino</th>
                    <th>Fecha</th>
                    <th>Opciones</th>
                </thead>		
                @foreach ($manifiestos as $man)
                    <tr>
                        <td>{{$man->id_manifiesto}}</td>
                        <td>{{ $man->vehiculo }}</td>
                        <td>{{ $man->ciudad_origen }}</td>
                        <td>{{ $man->ciudad_destino }}</td>
                        <td>{{ $man->created_at }}</td>
                        <td>
                            <a href="{{URL::action('ManifiestoController@show',$man->id_manifiesto)}}"><button class="btn btn-info">Detalles</button></a>
                            <a target="_blank" href="{{ URL::action('PdfController@reporteManifiesto',$man->id_manifiesto) }}"><button class="btn btn-info">Imprimir</button></a>
                            <a href="" data-target="#modal-delete-{{$man->id_manifiesto}}" data-toggle="modal"><button class="btn btn-danger">Recibir</button></a>
                        </td>
                    </tr>
                    @include('bodega.manifiesto.modal')
                @endforeach	
            </table>
        </div>
        {{$manifiestos->render()}}
    </div>
</div>
@endsection