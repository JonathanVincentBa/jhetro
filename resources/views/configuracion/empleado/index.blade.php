@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Empleados <a href="empleado/create"><button class="btn btn-success">Nuevo</button></a></h3>
			@include('configuracion.empleado.search')
		</div>	
	</div>
	<div class="row">
		<div class="col-lg-12 col-md.12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed able-hover">
					<thead>
						<td>Cargo</td>
						<th>Nombre</th>
						<th>Tipo de D.N.I.</th>
						<th>Num. D.N.I.</th>
						<th>Direccion</th>
						<th>Telefono</th>
						<th>Email</th>
						<th>Tipo Licencia</th>
					</thead>		
					@foreach ($personas as $per)
						<tr>
							<td>{{ $per->cargo }}
							<td>{{$per->nombre}}</td>
							@if( $per->tipo_dni=='C')
								<td>CÉDULA DE IDENTIDAD</td>
							@elseif( $per->tipo_dni=='R')
								<td>R.U.C.</td>
							@else
								<td>PASAPORTE</td>
							@endif
							<td>{{$per->num_dni}}</td>
							<td>{{$per->direccion}}</td>
							<td>{{$per->telefono}}</td>
							<td>{{$per->email}}</td>
							<td>{{$per->tipo_licencia}}</td>
							<td>
								<a href="{{URL::action('EmpleadoController@edit',$per->id_persona)}}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$per->id_persona}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('configuracion.empleado.modal')
					@endforeach	
				</table>
			</div>
			{{$personas->render()}}
		</div>
	</div>
@endsection