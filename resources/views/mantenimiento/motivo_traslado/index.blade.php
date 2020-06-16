@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Motivos de Traslado <a href="motivo_traslado/create"><button class="btn btn-success">Nuevo</button></a></h3>
			@include('mantenimiento.motivo_traslado.search')
		</div>	
	</div>
	<div class="row">
		<div class="col-lg-12 col-md.12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed able-hover">
					<thead>
						<th>Id</th>
						<th>Descripción</th>
						<th>Opciones</th>
					</thead>		
					@foreach ($motivos_traslados as $tra)
						<tr>
							<td>{{ $tra->id_motivo_traslado}}</td>
							<td>{{ $tra->descripcion}}</td>
							<td>
								<a href="{{URL::action('Motivo_TrasladoController@edit',$tra->id_motivo_traslado)}}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$tra->id_motivo_traslado}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('mantenimiento.motivo_traslado.modal')
					@endforeach	
				</table>
			</div>
			{{$motivos_traslados->render()}}
		</div>
	</div>
@endsection