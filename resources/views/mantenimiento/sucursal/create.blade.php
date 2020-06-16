@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Sucursal
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
	{!!Form::open(array('url'=>'mantenimiento/sucursal','method'=>'POST','autocomplete'=>'off'))!!}
        {{Form::token()}}
            <div class="row">
        		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        			<div class="form-group">
		            	<label for="direccion">Ciudad</label>
		            	<select name="id_ciudad" class="form-control selectpicker" data-live-search="true" title="Seleccione una ciudad..." required>
                        @foreach ($ciudades as $ciu)
                        {
                            <option value="{{$ciu->id_ciudad}}">{{$ciu->descripcion}}</option>
                        }
                        @endforeach
                </select>
            		</div>
        		</div>
        		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        			<div class="form-group">
		            	<label for="direccion">Dirección</label>
		            	<input type="text" name="direccion" requerid value="{{old('direccion')}}" class="form-control" placeholder="Dirección de la sucursal..." onKeyUp="this.value=this.value.toUpperCase();">
            		</div>
        		</div>
	            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        			<div class="form-group">
		            	<label for="telefono">Teléfono</label>
		            	<input type="number" name="telefono" requerid value="{{old('telefono')}}" class="form-control" placeholder="Teléfono de la sucursal...">
            		</div>
        		</div>
        		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        			<div class="form-group">
		            	<label for="email">e-mail</label>
		            	<input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="e-mail de la sucursal...">
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
	{!!Form::close()!!}
@endsection