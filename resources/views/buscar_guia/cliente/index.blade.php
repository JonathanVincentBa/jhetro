@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Guias por cliente</h3>
			@include('buscar_guia.cliente.search')
		</div>	
	</div>
	<div class="row">
		<div class="col-lg-12 col-md.12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed able-hover">
					<thead>
						<th>Num. Guia</th>
						<th>Ciudad Origen</th>
						<th>Remitente</th>
						<th>Ciudad Destino</th>
						<th>Destinatario</th>
						<th>Estado</th>
					</thead>
						@foreach ($guias as $gui)
						<tr>
							<td>{{$gui->num_guia}}</td>
							<td>{{$gui->ciudad_origen}}</td>
							<td>{{$gui->nom_remitente}}</td>
							<td>{{$gui->ciudad_destino}}</td>
							<td>{{$gui->nom_destinatario}}</td>
							@if( $gui->estado=='1')
								<td>ACTIVO</td>
							@else
								<td>INACTIVO</td>
							@endif
							<td>
								<a href="{{URL::action('BuscarGuiaController@show',$gui->id_cabecera)}}"><button class="btn btn-info">Detalles</button></a>
							</td>
						</tr>
					@endforeach	
				</table>
			</div>
		</div>
	</div>
@endsection