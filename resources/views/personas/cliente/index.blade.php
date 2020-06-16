@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Clientes 
				<a href="cliente/create">
					<button class="btn btn-success">
						Nuevo
					</button>
				</a>
				<a href={{ url('reporteclientes') }}>
					<button class="btn btn-success">
						Reporte
					</button>
				</a>
			</h3>
			@include('personas.cliente.search')
		</div>	
	</div>
	<div class="row">
		<div class="col-lg-12 col-md.12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed able-hover">
					<thead>
						<th>Nombre</th>
						<th>Dirección</th>
						<th>Num. D.N.I.</th>
						<th>Telefono</th>
					</thead>		
					@foreach ($personas as $per)
						<tr>
							<td>{{$per->nombre}}</td>
							<td>{{$per->direccion}}</td>
							<td>{{$per->num_dni}}</td>
							<td>{{$per->telefono}}</td>
							<td>
								<a href="{{ URL::action('ClienteController@edit',$per->id_persona) }}"><button class="btn btn-info">Editar cliente</button></a>
								<a href="" data-target="#modal-delete-{{$per->id_persona}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('personas.cliente.modal')
					@endforeach	
				</table>
			</div>
			{{$personas->render()}}
		</div>
	</div>
@endsection