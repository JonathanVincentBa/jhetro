@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<h3>Nuevo Usuario <a href="{{URL::action('UsuarioController@index')}}"><button class="btn btn-danger">Cancelar</button></a>
			</h3>
		</div>
	</div>
	{!!Form::open(array('url'=>'seguridad/usuario','method'=>'POST','autocomplete'=>'off'))!!}
		{{Form::token()}}
		<div class="row">
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group{{ $errors->has('id_rol') ? ' has-error' : '' }}">
					<label for="id_rol" class="col-md-4 control-label">Roles</label>
					<select name="id_rol" id="id_rol" class="form-control selectpicker" data-live-search="true" title="Seleccione un rol..." requerid>
						@foreach ($roles as $rol)
								<option value="{{ $rol->id_rol }}">{{ $rol->descripcion }}</option>
						@endforeach
					</select>
					@if ($errors->has('id_rol'))
						<span class="help-block">
							<strong>{{ $errors->first('id_rol') }}</strong>
						</span>
					@endif
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					<label for="name" class="col-md-4 control-label">Nombre</label>
					<select name="id_persona" id="id_persona" class="form-control selectpicker" data-live-search="true" title="Seleccione una persona..." requerid>
						@foreach ($personas as $per)
								<option value="{{ $per->id_persona }}_{{ $per->nombre }}">{{ $per->nombre }}</option>
						@endforeach
					</select>
					<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" style="display: none">
					@if ($errors->has('name'))
						<span class="help-block">
							<strong>{{ $errors->first('name') }}</strong>
						</span>
					@endif
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<label for="email" class="col-md-4 control-label">E-Mail</label>
					<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
					@if ($errors->has('email'))
						<span class="help-block">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
					@endif
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<label for="password" class="col-md-4 control-label">Password</label>
					<input id="password" type="password" class="form-control" name="password">
					@if ($errors->has('password'))
						<span class="help-block">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
					@endif
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
					<label for="password-confirm" class="col-md-4 control-label">Confirmar Password</label>
					<input id="password-confirm" type="password" class="form-control" name="password_confirmation">
					@if ($errors->has('password_confirmation'))
						<span class="help-block">
							<strong>{{ $errors->first('password_confirmation') }}</strong>
						</span>
					@endif
				</div>
			</div>
		</div>
		<div class="form-group">
			<button class="btn btn-primary" type="submit">Guardar</button>
		</div>
	{!!Form::close()!!}
	
	@push ('scripts')
    <script>
			$("#id_persona").change(cargarName);
			function cargarName(){
				datosRemitente=document.getElementById('id_persona').value.split('_');
				$("#name").val(datosRemitente[1]);
			}
	</script>
	@endpush
@endsection