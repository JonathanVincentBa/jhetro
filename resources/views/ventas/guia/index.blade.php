@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Guias <a href="guia/create"><button class="btn btn-success">Nuevo</button></a></h3>
			@include('ventas.guia.search')
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
						<th><center>Opciones</center></th>
					</thead>
						@foreach ($guias as $gui)
						<tr>
							<td>{{$gui->num_guia}}</td>
							<td>{{$gui->ciudad_origen}}</td>
							<td>{{$gui->nom_remitente}}</td>
							<td>{{$gui->ciudad_destino}}</td>
							<td>{{$gui->nom_destinatario}}</td>
							<td>
								<a href="{{URL::action('GuiaController@show',$gui->id_cabecera)}}"><button class="btn btn-info">Detalles</button></a>
								<a target="_blank" href="{{ URL::action('PdfController@reporteGuia',$gui->id_cabecera) }}"><button class="btn btn-info">Imprimir</button></a>
								<a href="" data-target="#modal-delete-{{$gui->id_cabecera}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
							</td>
						</tr>
						@include('ventas.guia.modal')
					@endforeach	
				</table>
			</div>
			{{$guias->render()}}
		</div>
	</div>
@endsection