@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Cliente</h3>
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
	{!!Form::open(array('url'=>'personas/cliente','method'=>'POST','autocomplete'=>'off'))!!}
	    {{Form::token()}}
            <div class="row">
            	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        			<div class="form-group">
		            	<label for="nombre">Nombre</label>
		            	<input type="text" name="nombre" requerid value="{{old('nombre')}}" class="form-control" placeholder="Nombre del cliente..." onKeyUp="this.value=this.value.toUpperCase();">
            		</div>
        		</div>
        		
        		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        			<div class="form-group">
		            	<label>Tipo D.N.I.</label>
		            	<select name="tipo_dni" requerid class="form-control selectpicker" data-live-search="true" title="Seleccione un tipo de documento...">
                            <option value="C">Cédula de Identidad</option>
                            <option value="R">R.U.C.</option>
                            <option value="P">Pasaporte</option>
                        </select>
            		</div>
        		</div>
        		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        			<div class="form-group">
		            	<label for="num_dni">Número DNI</label>
		            	<input type="number" requerid name="num_dni" id="num_dni" value="{{old('num_dni')}}" class="form-control" placeholder="Num. D.N.I. del cliente...">
            		</div>
        		</div>
        		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        			<div class="form-group">
		            	<label for="telefono">Teléfono</label>
		            	<input type="number" requerid name="telefono" value="{{old('telefono')}}" class="form-control" placeholder="Teléfono del cliente...">
            		</div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <input type="text" name="direccion" requerid value="{{old('direccion')}}" class="form-control" placeholder="Direccion del cliente..." onKeyUp="this.value=this.value.toUpperCase();">
                    </div>
                </div>
        	</div>
            <div class="form-group">
                
                <button class="btn btn-primary" id="bt_add" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
            
	{!!Form::close()!!}
@endsection