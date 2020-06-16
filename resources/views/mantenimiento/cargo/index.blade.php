@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Cargos <a href="cargo/create"><button class="btn btn-success">Nuevo</button></a></h3>
			@include('mantenimiento.cargo.search')
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
					@foreach ($cargos as $car)
						<tr>
							<td>{{$car->id_cargo}}</td>
							<td>{{$car->descripcion}}</td>
							<td>
								<a href="{{URL::action('CargoController@edit',$car->id_cargo)}}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$car->id_cargo}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('mantenimiento.cargo.modal')
					@endforeach	
				</table>
			</div>
			{{$cargos->render()}}
		</div>
	</div>
@endsection