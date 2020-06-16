@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Empresas <a href="empresa/create"><button class="btn btn-success">Nuevo</button></a></h3>
			@include('mantenimiento.empresa.search')
		</div>	
	</div>
	<div class="row">
		<div class="col-lg-12 col-md.12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed able-hover">
					<thead>
						<th>Razon social</th>
						<th>Dirección</th>
						<th>Teléfono</th>
						<th>Logo</th>
						<th>Opciones</th>
					</thead>		
					@foreach ($empresas as $emp)
						<tr>
							<td>{{ $emp->razon_social}}</td>
							<td>{{ $emp->direccion}}</td>
							<td>{{ $emp->telefono}}</td>
							<td>
								<img src="{{asset('imagenes/empresa/'.$emp->logo)}}" alt="{{ $emp->razon_social}}" heigth="100px" width="100px" class="img-thumbnail">
							</td>
							<td>
								<a href="{{URL::action('EmpresaController@edit',$emp->id_empresa)}}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$emp->id_empresa}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('mantenimiento.empresa.modal')
					@endforeach	
				</table>
			</div>
			{{$empresas->render()}}
		</div>
	</div>
@endsection