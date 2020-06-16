@extends ('layouts.admin')
@section ('contenido')
<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Guias 
				<a href="caja/create"><button class="btn btn-success">Crear Caja</button></a>
				
					<a href="caja/show"><button class="btn btn-primary">Revision Cajas</button></a>
				
			</h3>
			@include('caja.search')
		</div>	
	</div>	
	</div>
	<div class="row">
            <div class="col-lg-12 col-md.12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed able-hover">
                        <thead>
                            <th style="text-align: center;">Guia</th>
                            <th style="text-align: center;">Usuario Creador</th>
                            <th style="text-align: center;">C. Origen</th>
                            <th style="text-align: center;">C. Destino</th>
                            <th style="text-align: center;">Remitente</th>
                            <th style="text-align: center;">F. Creación</th>
                            <th style="text-align: center;">V. guia</th>
                            <th style="text-align: center;">Estado</th>
                            <th style="text-align: center;">Opciones</th>
                        </thead>
                        @foreach($guias as $guia)
                            <tr>
                                <td>{{ $guia->num_guia }}</td>
                                <td>{{ $guia->name }}</td>
                                <td>{{$guia->ciudad_origen}}</td>
                                <td>{{$guia->ciudad_destino}} </td>
                                <td>{{$guia->nom_remitente}} </td>
                                <td>{{$guia->created_at}} </td>
                                <td>{{$guia->valor_guia}} </td>
                                <td>{{$guia->estatus_cobro}} </td>
                                <td>
                                    <a href="{{URL::action('CajaController@edit',$guia->id_cabecera)}}"><button class="btn btn-primary">Editar</button></a>
                                    <a href="" data-target="#modal-delete-{{$guia->id_cabecera}}" data-toggle="modal"><button class="btn btn-danger">Pagar</button></a>
                                </td>
                            </tr>	
                            @include('caja.modal')
                            @endforeach
                    </table>
                </div>
                {{ $guias->render() }}
            </div>
	</div>
@endsection