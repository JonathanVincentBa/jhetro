@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Empleado</h3>
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
	{!!Form::open(array('url'=>'seguridad/empleado','method'=>'POST','autocomplete'=>'off'))!!}
	    {{Form::token()}}
            <div class="row">
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        			<div class="form-group">
		            	<label for="nombre">Nombre</label>
		            	<input type="text" name="nombre" requerid value="{{old('nombre')}}" class="form-control" placeholder="Nombre del empleado..." onKeyUp="this.value=this.value.toUpperCase();" required>
            		</div>
        		</div>
        		
        		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        			<div class="form-group">
		            	<label>Tipo D.N.I.</label>
		            	<select name="tipo_dni" class="form-control selectpicker" data-live-search="true" title="Seleccione un tipo de documento..." required>
                            <option value="C">Cédula de Identidad</option>
                            <option value="R">R.U.C.</option>
                            <option value="P">Pasaporte</option>
                        </select>
            		</div>
        		</div>
        		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        			<div class="form-group">
		            	<label for="num_dni">Número DNI</label>
		            	<input type="number" name="num_dni" id="num_dni" value="{{old('num_dni')}}" class="form-control" placeholder="Num. D.N.I. del empleado..." onChange="validarDocumento(this.value);" required>
            		</div>
        		</div>
                           	
        		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        			<div class="form-group">
		            	<label for="direccion">Dirección</label>
		            	<input type="text" name="direccion"value="{{old('direccion')}}" class="form-control" placeholder="Dirección del empleado..." onKeyUp="this.value=this.value.toUpperCase();" required>
            		</div>
        		</div>
        		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        			<div class="form-group">
		            	<label for="telefono">Teléfono</label>
		            	<input type="number" name="telefono" value="{{old('telefono')}}" class="form-control" placeholder="Teléfono del empleado...">
            		</div>
        		</div>
                
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label>Cargo</label>
                        <select name="id_cargo" class="form-control selectpicker" data-live-search="true" title="Seleccione un cargo..." required>
                            @foreach ($cargos as $car)
                            {
                                <option value="{{$car->id_cargo}}">{{$car->descripcion}}</option>
                            }
                            @endforeach
                        </select>
                    </div>
                </div>
        	</div>
	        <div class="form-group">
				<button class="btn btn-primary" id="bt_add" type="submit">Guardar</button>
				
            </div>
            </div>
			{!!Form::close()!!}
			<div class="form-group" style="position:absolute; top:330px; left:95px;">
				<a href="{{URL::action('EmpleadoController@index')}}"><button class="btn btn-danger">Cancelar</button></a>
			</div>
			
@endsection