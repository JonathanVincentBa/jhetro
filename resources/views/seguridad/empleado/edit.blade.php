@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Empleado: {{ $persona->nombre }}
				<a href="{{URL::action('EmpleadoController@index')}}"><button class="btn btn-danger">Cancelar</button></a>
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
	<form method="POST" action="{{ url("seguridad/empleado/{$persona->id_persona}") }}">
		@csrf
		@method('PUT')
		<div class="row">
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<label>Cargo</label>
					<select name="id_cargo" class="form-control selectpicker" data-live-search="true" title="Seleccione un cargo..." requerid>
						@foreach ($cargos as $car)
						{
							@if( $car->id_cargo==$persona->id_cargo)
								<option value="{{$car->id_cargo}}" selected>{{$car->descripcion}}</option>
							@else
								<option value="{{$car->id_cargo}}">{{$car->descripcion}}</option>
							@endif
						}
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<label for="nombre">Nombre</label>
					<input type="text" name="nombre" requerid value="{{ $persona->nombre }}" class="form-control" placeholder="Nombre del empleado..." onKeyUp="this.value=this.value.toUpperCase();">
				</div>
			</div>
			
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<label>Tipo D.N.I.</label>
					<select id="tipo_dni" name="tipo_dni" class="form-control selectpicker" data-live-search="true" title="Seleccione un tipo de documento...">
						@if( $persona->tipo_dni=='C' )
						{
							<option value="C" selected>Cédula de Identidad</option>
							<option value="R">R.U.C.</option>
							<option value="P">Pasaporte</option>
						}
						@elseif( $persona->tipo_dni=='R' )
						{
							<option value="C" >Cédula de Identidad</option>
							<option value="R" selected>R.U.C.</option>
							<option value="P">Pasaporte</option>
						}
						@else
						{
							<option value="C" >Cédula de Identidad</option>
							<option value="R">R.U.C.</option>
							<option value="P" selected>Pasaporte</option>
						}
						@endif
					</select>
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<label for="num_dni">Número DNI</label>
					<input type="number" name="num_dni" id="num_dni" value="{{ $persona->num_dni }}" class="form-control" placeholder="Num. D.N.I. del empleado..." onChange="validarDocumento(this.value);">
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<label for="direccion">Dirección</label>
						<input type="text" name="direccion"value="{{ $persona->direccion }}" class="
					form-control" placeholder="Dirección del empleado..." onKeyUp="this.value=this.value.toUpperCase();">
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<label for="telefono">Teléfono</label>
					<input type="number" name="telefono" value="{{ $persona->telefono }}" class="form-control" placeholder="Teléfono del empleado...">
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
		</div>
		<div class="form-group">
			<button class="btn btn-primary" id="bt_add" type="submit">Guardar</button>
		</div>
	</form>
@endsection