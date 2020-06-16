@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Empresa: {{$empresa->descripcion}}
				<a href="{{URL::action('EmpresaController@index')}}"><button class="btn btn-danger">Cancelar</button></a>
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
	<form method="POST" action="{{ url("mantenimiento/empresa/{$empresa->id_empresa}") }}">
		@csrf
		@method('PUT')
		<div class="row">
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<label for="razon_social">Razón Social</label>
					<input type="text" name="razon_social" requerid value="{{$empresa->razon_social}}" class="form-control" onKeyUp="this.value=this.value.toUpperCase();">
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<label for="ruc">R.U.C.</label>
					<input type="text" name="ruc" requerid value="{{$empresa->ruc}}" class="form-control" placeholder="R.U.C. de la empresa..." >
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<label for="direccion">Dirección</label>
					<input type="text" name="direccion" requerid value="{{$empresa->direccion}}" class="form-control" placeholder="Dirección de la empresa..." onKeyUp="this.value=this.value.toUpperCase();">
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<label for="telefono">Teléfono</label>
					<input type="text" name="telefono" requerid value="{{$empresa->telefono}}" class="form-control" placeholder="Teléfono de la empresa...">
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<label for="email">e-mail</label>
					<input type="text" name="email" value="{{$empresa->email}}" class="form-control" placeholder="e-mail de la empresa...">
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<label for="representante">Representante</label>
					<input type="text" name="representante" value="{{$empresa->representante}}" class="form-control" placeholder="Representante legal de la empresa..." onKeyUp="this.value=this.value.toUpperCase();">
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<label for="logo">Logo</label>
					<input type="file" name="logo" class="form-control">
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					@if (($empresa->logo)!="")
						<img src="{{asset('/imagenes/empresa/'.$empresa->logo)}}" height="150px" width="150px">
					@endif
				</div>
			</div>
		</div>
		<div class="form-group">
			<button class="btn btn-primary" type="submit">Guardar</button>
		</div>
	</form>
@endsection