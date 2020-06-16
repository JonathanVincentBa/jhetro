@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Empresa
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
			{!!Form::open(array('url'=>'mantenimiento/empresa','method'=>'POST','autocomplete'=>'off'))!!}
	            {{Form::token()}}
		            <div class="row">
	            		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
	            			<div class="form-group">
				            	<label for="razon_social">Razón Social</label>
				            	<input type="text" name="razon_social" requerid value="{{old('razon_social')}}" class="form-control" placeholder="Nombre de la empresa..." onKeyUp="this.value=this.value.toUpperCase();">
		            		</div>
		            	</div>
			            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
	            			<div class="form-group">
				            	<label for="ruc">R.U.C.s</label>
				            	<input type="number" name="ruc" requerid value="{{old('ruc')}}" class="form-control" placeholder="R.U.C. de la empresa...">
		            		</div>
	            		</div>
	            		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
	            			<div class="form-group">
				            	<label for="direccion">Dirección</label>
				            	<input type="text" name="direccion" requerid value="{{old('direccion')}}" class="form-control" placeholder="Dirección de la empresa..." onKeyUp="this.value=this.value.toUpperCase();">
		            		</div>
	            		</div>
			            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
	            			<div class="form-group">
				            	<label for="telefono">Teléfono</label>
				            	<input type="number" name="telefono" requerid value="{{old('telefono')}}" class="form-control" placeholder="Teléfono de la empresa...">
		            		</div>
	            		</div>
	            		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
	            			<div class="form-group">
				            	<label for="email">e-mail</label>
				            	<input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="e-mail de la empresa...">
		            		</div>
	            		</div>
	            		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
	            			<div class="form-group">
				            	<label for="representante">Representante</label>
				            	<input type="text" name="representante" value="{{old('representante')}}" class="form-control" placeholder="Representante legal de la empresa..." onKeyUp="this.value=this.value.toUpperCase();">
		            		</div>
	            		</div>
	            		
	            		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
	            			<div class="form-group">
				            	<label for="logo">Logo</label>
				            	<input type="file" name="logo" class="form-control">
		            		</div>
	            		</div>
	            		
			        </div>
			        <div class="form-group">
		            	<button class="btn btn-primary" type="submit">Guardar</button>
		            </div>
			{!!Form::close()!!}
@endsection