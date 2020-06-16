@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Lisado de Formas de Pago <a href="formas_pago/create"><button class="btn btn-success">Nuevo</button></a></h3>
			@include('mantenimiento.formas_pago.search')
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
					@foreach ($formas_pagos as $for)
						<tr>
							<td>{{ $for->id_formas_pago}}</td>
							<td>{{ $for->descripcion}}</td>
							<td>
								<a href="{{URL::action('Formas_PagoController@edit',$for->id_formas_pago)}}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{  $for->id_formas_pago }}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('mantenimiento.formas_pago.modal')
					@endforeach	
				</table>
			</div>
			{{$formas_pagos->render()}}
		</div>
	</div>
@endsection