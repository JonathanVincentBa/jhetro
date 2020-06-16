@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Cargo
				<a href="{{URL::action('CargoController@index')}}"><button class="btn btn-danger">Cancelar</button></a>
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

			{!!Form::open(array('url'=>'mantenimiento/cargo','method'=>'POST','autocomplete'=>'off'))!!}
	            {{Form::token()}}
		            <div class="form-group">
		            	<label for="descripcion">Descripción</label>
		            	<input type="text" name="descripcion" class="form-control" placeholder="Descripción..." onKeyUp="this.value=this.value.toUpperCase();">
		            </div>
		            <div class="form-group">
		            	<button class="btn btn-primary" type="submit">Guardar</button>
		            </div>

			{!!Form::close()!!}
@endsection