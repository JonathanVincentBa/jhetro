@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h3>Editar Sucursal: {{$sucursal->direccion}}
				<a href="{{URL::action('SucursalController@index')}}"><button class="btn btn-danger">Cancelar</button></a>
			</h3>
			@if (count($errors)>0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>			
			@endif
		</div>
	</div>
	<form method="POST" action="{{ url("mantenimiento/sucursal/{$sucursal->id_sucursal}") }}">
		@csrf
		@method('PUT')
		<div class="row">
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<label>Ciudad</label>
					<select name="id_ciudad" class="form-control selectpicker" data-live-search="true" title="Seleccione una ciudad..." requerid>
						@foreach ($ciudades as $ciu)
						{
							@if( $ciu->id_ciudad==$sucursal->id_ciudad)
								<option value="{{$ciu->id_ciudad}}" selected>{{$ciu->descripcion}}</option>
							@else
								<option value="{{$ciu->id_ciudad}}">{{$ciu->descripcion}}</option>
							@endif
						}
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<label for="direccion">Dirección</label>
					<input type="text" name="direccion" requerid value="{{$sucursal->direccion}}" class="form-control" placeholder="Dirección de la sucursal..." onKeyUp="this.value=this.value.toUpperCase();">
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<label for="telefono">Teléfono</label>
					<input type="number" name="telefono" requerid value="{{$sucursal->telefono}}" class="form-control" placeholder="Teléfono de la sucursal...">
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<label for="email">e-mail</label>
					<input type="email" name="email" value="{{$sucursal->email}}" class="form-control" placeholder="e-mail de la sucursal...">
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" style="display: none;">
			<div class="form-group">
				<label>Empresa</label>
				<select name="id_empresa" class="form-control">
					@foreach ($empresas as $emp)
					{
						<option value="{{$emp->id_empresa}}">{{$emp->razon_social}}</option>
					}
					@endforeach
				</select>
			</div>
		</div>
		<div class="form-group">
			<button class="btn btn-primary" type="submit">Guardar</button>
		</div>
	</form>
@endsection