@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Guias </h3>
			@include('editar_guia.editarCliente.search')
		</div>	
	</div>
	<div class="row">
		<div class="col-lg-12 col-md.12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed able-hover">
					<thead>
                        <th>Remitente</th>
                        <th>Ciudad</th>
                        <th>Direccion</th>
						<th>Opciones</th>
					</thead>
						@foreach ($guias as $gui)
						<tr>
                            <td>{{ $gui->nom_remitente }}</td>
                            <td>{{ $gui->ciudad_origen }}</td>
                            <td>{{ $gui->direccion_remitente }}</td>
							<td>
								<a href="{{URL::action('EditarGuiaClienteController@edit',$gui->nom_remitente)}}"><button class="btn btn-primary">Pagar Guia</button></a>
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