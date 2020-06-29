@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Empleado: {{ $persona->nombre }} </h3>
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
			{!!Form::model($persona,['method'=>'PATCH','route'=>['configuracion.empleado.update',$persona->id_persona]])!!}
	            {{Form::token()}}
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
                    <div class="form-group">
                        <label>Ciudad</label>
                        <select name="id_ciudad" class="form-control selectpicker" data-live-search="true" title="Seleccione una ciudad..." required>
                            @foreach ($ciudades as $ciu)
                            {
                            	@if( $ciu->id_ciudad==$direcciones->id_ciudad)
                                	<option value="{{$ciu->id_ciudad}}" selected>{{$ciu->descripcion}}</option>
                                @else
                                	<option value="{{$ciu->id_ciudad}}">{{$ciu->descripcion}}</option>
                                @endif
                            }
                            @endforeach
                        </select>
                    </div>
                </div>
		            	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
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
				            	<label for="descripcion">Dirección</label>
				            		<input type="text" name="descripcion"value="{{ $direcciones->direccion }}" class="
				            	form-control" placeholder="Dirección del empleado..." onKeyUp="this.value=this.value.toUpperCase();">
		            		</div>
		        		</div>
		        		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		        			<div class="form-group">
				            	<label for="telefono">Teléfono</label>
				            	<input type="number" name="telefono" value="{{ $persona->telefono }}" class="form-control" placeholder="Teléfono del empleado...">
		            		</div>
		        		</div>
		        		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		        			<div class="form-group">
				            	<label for="email">Email</label>
				            	<input type="text" name="email"value="{{ $persona->email }}" class="form-control" placeholder="e-mail del empleado...">
		            		</div>
		        		</div>
		        		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		                    <div class="form-group">
		                        <label>Tipo de licencia</label>
		                        <select name="tipo_licencia" class="form-control selectpicker" data-live-search="true" title="Seleccione un tipo de licencia...">
		                        	@if( $persona->tipo_licencia=='A' )
		                        	{
										<option value="A" selected>A</option>
			                            <option value="A1">A1</option>
			                            <option value="B">B</option>
			                            <option value="C">C</option>
			                            <option value="C1">C1</option>
			                            <option value="D">D</option>
			                            <option value="D1">D1</option>
			                            <option value="E">E</option>
			                            <option value="E1">E1</option>
			                            <option value="F">F</option>
			                            <option value="G">G</option>
			                            <option value="SN">SIN LICENCIA</option>
		                        	}
		                        	@elseif( $persona->tipo_licencia=='A1' )
		                        	{
										<option value="A" >A</option>
			                            <option value="A1" selected>A1</option>
			                            <option value="B">B</option>
			                            <option value="C">C</option>
			                            <option value="C1">C1</option>
			                            <option value="D">D</option>
			                            <option value="D1">D1</option>
			                            <option value="E">E</option>
			                            <option value="E1">E1</option>
			                            <option value="F">F</option>
			                            <option value="G">G</option>
			                            <option value="SN">SIN LICENCIA</option>
		                        	}
		                        	@elseif( $persona->tipo_licencia=='B' )
		                        	{
										<option value="A">A</option>
			                            <option value="A1">A1</option>
			                            <option value="B" selected>B</option>
			                            <option value="C">C</option>
			                            <option value="C1">C1</option>
			                            <option value="D">D</option>
			                            <option value="D1">D1</option>
			                            <option value="E">E</option>
			                            <option value="E1">E1</option>
			                            <option value="F">F</option>
			                            <option value="G">G</option>
			                            <option value="SN">SIN LICENCIA</option>
		                        	}
		                        	@elseif( $persona->tipo_licencia=='C' )
		                        	{
										<option value="A">A</option>
			                            <option value="A1">A1</option>
			                            <option value="B">B</option>
			                            <option value="C" selected>C</option>
			                            <option value="C1">C1</option>
			                            <option value="D">D</option>
			                            <option value="D1">D1</option>
			                            <option value="E">E</option>
			                            <option value="E1">E1</option>
			                            <option value="F">F</option>
			                            <option value="G">G</option>
			                            <option value="SN">SIN LICENCIA</option>
		                        	}
		                        	@elseif( $persona->tipo_licencia=='C1' )
		                        	{
										<option value="A">A</option>
			                            <option value="A1">A1</option>
			                            <option value="B">B</option>
			                            <option value="C" >C</option>
			                            <option value="C1" selected>C1</option>
			                            <option value="D">D</option>
			                            <option value="D1">D1</option>
			                            <option value="E">E</option>
			                            <option value="E1">E1</option>
			                            <option value="F">F</option>
			                            <option value="G">G</option>
			                            <option value="SN">SIN LICENCIA</option>
		                        	}
		                        	@elseif( $persona->tipo_licencia=='D' )
		                        	{
										<option value="A">A</option>
			                            <option value="A1">A1</option>
			                            <option value="B">B</option>
			                            <option value="C" >C</option>
			                            <option value="C1">C1</option>
			                            <option value="D" selected>D</option>
			                            <option value="D1">D1</option>
			                            <option value="E">E</option>
			                            <option value="E1">E1</option>
			                            <option value="F">F</option>
			                            <option value="G">G</option>
			                            <option value="SN">SIN LICENCIA</option>
		                        	}
									@elseif( $persona->tipo_licencia=='D1' )
		                        	{
										<option value="A">A</option>
			                            <option value="A1">A1</option>
			                            <option value="B">B</option>
			                            <option value="C" >C</option>
			                            <option value="C1">C1</option>
			                            <option value="D" >D</option>
			                            <option value="D1" selected>D1</option>
			                            <option value="E">E</option>
			                            <option value="E1">E1</option>
			                            <option value="F">F</option>
			                            <option value="G">G</option>
			                            <option value="SN">SIN LICENCIA</option>
		                        	}
		                        	@elseif( $persona->tipo_licencia=='E' )
		                        	{
										<option value="A">A</option>
			                            <option value="A1">A1</option>
			                            <option value="B">B</option>
			                            <option value="C" >C</option>
			                            <option value="C1">C1</option>
			                            <option value="D" >D</option>
			                            <option value="D1" >D1</option>
			                            <option value="E" selected>E</option>
			                            <option value="E1">E1</option>
			                            <option value="F">F</option>
			                            <option value="G">G</option>
			                            <option value="SN">SIN LICENCIA</option>
		                        	}
		                        	@elseif( $persona->tipo_licencia=='E1' )
		                        	{
										<option value="A">A</option>
			                            <option value="A1">A1</option>
			                            <option value="B">B</option>
			                            <option value="C" >C</option>
			                            <option value="C1">C1</option>
			                            <option value="D" >D</option>
			                            <option value="D1" >D1</option>
			                            <option value="E" >E</option>
			                            <option value="E1" selected>E1</option>
			                            <option value="F">F</option>
			                            <option value="G">G</option>
			                            <option value="SN">SIN LICENCIA</option>
		                        	}
		                        	@elseif( $persona->tipo_licencia=='F' )
		                        	{
										<option value="A">A</option>
			                            <option value="A1">A1</option>
			                            <option value="B">B</option>
			                            <option value="C" >C</option>
			                            <option value="C1">C1</option>
			                            <option value="D" >D</option>
			                            <option value="D1" >D1</option>
			                            <option value="E" >E</option>
			                            <option value="E1" >E1</option>
			                            <option value="F" selected>F</option>
			                            <option value="G">G</option>
			                            <option value="SN">SIN LICENCIA</option>
		                        	}
		                        	@elseif( $persona->tipo_licencia=='F' )
		                        	{
										<option value="A">A</option>
			                            <option value="A1">A1</option>
			                            <option value="B">B</option>
			                            <option value="C" >C</option>
			                            <option value="C1">C1</option>
			                            <option value="D" >D</option>
			                            <option value="D1" >D1</option>
			                            <option value="E" >E</option>
			                            <option value="E1" >E1</option>
			                            <option value="F" selected>F</option>
			                            <option value="G">G</option>
			                            <option value="SN">SIN LICENCIA</option>
		                        	}
		                        	@elseif( $persona->tipo_licencia=='G' )
		                        	{
										<option value="A">A</option>
			                            <option value="A1">A1</option>
			                            <option value="B">B</option>
			                            <option value="C" >C</option>
			                            <option value="C1">C1</option>
			                            <option value="D" >D</option>
			                            <option value="D1" >D1</option>
			                            <option value="E" >E</option>
			                            <option value="E1" >E1</option>
			                            <option value="F" >F</option>
			                            <option value="G" selected>G</option>
			                            <option value="SN">SIN LICENCIA</option>
		                        	}
		                        	@else
		                        	{
										<option value="A">A</option>
			                            <option value="A1">A1</option>
			                            <option value="B">B</option>
			                            <option value="C" >C</option>
			                            <option value="C1">C1</option>
			                            <option value="D" >D</option>
			                            <option value="D1" >D1</option>
			                            <option value="E" >E</option>
			                            <option value="E1" >E1</option>
			                            <option value="F" >F</option>
			                            <option value="G" >G</option>
			                            <option value="SN" selected>SIN LICENCIA</option>
		                        	}
									@endif
		                        </select>
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
			{!!Form::close()!!}
			<div class="form-group" style="position:absolute; top:426px; left:95px;">
				<a href="{{URL::action('EmpleadoController@index')}}"><button class="btn btn-info">Cancelar</button></a>
			</div>
@endsection