@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Empleados 
				<a href="empleado/create">
					<button class="btn btn-success">
						Nuevo
					</button>
				</a>
				<a href={{ url('reporteempleados') }}>
					<button class="btn btn-info">
						Reporte
					</button>
				</a>
			</h3>
			@include('seguridad.empleado.search')
		</div>	
	</div>
	<div class="row">
		<div class="col-lg-12 col-md.12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed able-hover">
					<thead>
						<th>Cargo</th>
						<th>Nombre</th>
						<th>Tipo de D.N.I.</th>
						<th>Num. D.N.I.</th>
						<th>Direccion</th>
						<th>Opciones</th>
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
							<td>
								<a href="{{URL::action('EmpleadoController@edit',$per->id_persona)}}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$per->id_persona}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('seguridad.empleado.modal')
					@endforeach	
				</table>
			</div>
			{{$personas->render()}}
		</div>
	</div>
@endsection