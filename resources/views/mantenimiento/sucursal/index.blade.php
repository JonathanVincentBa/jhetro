@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Lisado de Sucursales <a href="sucursal/create"><button class="btn btn-success">Nuevo</button></a></h3>
			@include('mantenimiento.sucursal.search')
		</div>	
	</div>
	<div class="row">
		<div class="col-lg-12 col-md.12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed able-hover">
					<thead>
						<th>Ciudad</th>
						<th>Dirección</th>
						<th>Teléfono</th>
						<th>email</th>
						<th>Opciones</th>
					</thead>		
					@foreach ($sucursales as $suc)
						<tr>
							<td>{{ $suc->ciudad}}</td>
							<td>{{ $suc->direccion}}</td>
							<td>{{ $suc->telefono}}</td>
							<td>{{ $suc->email}}</td>
							<td>
								<a href="{{URL::action('SucursalController@edit',$suc->id_sucursal)}}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$suc->id_sucursal}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('mantenimiento.sucursal.modal')
					@endforeach
				</table>
			</div>
			{{ $sucursales->render() }}
		</div>
	</div>
@endsection