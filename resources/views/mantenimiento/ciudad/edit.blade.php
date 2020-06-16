@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Ciudad: {{$ciudad->descripcion}}
				<a href="{{URL::action('CiudadController@index')}}"><button class="btn btn-danger">Cancelar</button></a>
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
	<form method="POST" action="{{ url("mantenimiento/ciudad/{$ciudad->id_ciudad}") }}">
		@csrf
		@method('PUT')
		<div class="form-group">
			<label for="descripcion">Descripción</label>
			<input type="text" name="descripcion" class="form-control" value="{{$ciudad->descripcion}}" placeholder="Descripción..." onKeyUp="this.value=this.value.toUpperCase();">
		</div>
		<div class="form-group">
			<button class="btn btn-primary" type="submit">Guardar</button>
		</div>
	</form>
	<div class="form-group" style="position:absolute; top:130px; left:95px;">
		
	</div>
@endsection