@extends ('layouts.admin')
@section ('contenido')
{!!Form::open(array('url'=>'controlpersonal/todosEmpleados','method'=>'POST','autocomplete'=>'off'))!!}
	{{Form::token()}}
	<div class="row">
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
			<div class="form-group">
				<h3><b>Reportes de asistencia todo el personal</b></h3>
			</div>	
		</div>
		
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
				<label for="nombre">Seleccione una fecha de inicia</label>
				<input type="date" required class = "form-control" id="fecha_inicio" name="fecha_inicio">
			</div>
		</div>

		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
				<label for="nombre">Seleccione una fecha de fin</label>
				<input type="date" required  class = "form-control" id="fecha_final" name="fecha_final" >
			</div>
		</div>

		<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
			<div class="form-group">
				<br>
				<button name="todosEmpleados" id="todosEmpleados" class="btn btn-success">Reporte</button>
			</div>
		</div>
	</div>
	{!! Form::close() !!}
{!!Form::open(array('url'=>'controlpersonal/porEmpleado','method'=>'POST','autocomplete'=>'off'))!!}
	{{Form::token()}}
	<div class="row">
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
			<div class="form-group">
				<h3><b>Reportes de asistencia por empleado</b></h3>
			</div>	
		</div>
		<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
			<div class="form-group">
				<label for="nombre">Seleccione un empleado</label>
				<select name="name" required  class="form-control selectpicker" id="name" data-live-search="true" title="Seleccione un cliente...">
					@foreach ($usuarios as $usu)
						<option value="{{ $usu->name }}">{{  $usu->name }}</option>
					@endforeach
				</select>
			</div>	
		</div>
		<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
			<div class="form-group">
				<label for="nombre">Seleccione una fecha</label>
				<input type="date" required  class = "form-control" id="fecha_inicio_1" name="fecha_inicio_1">
			</div>
		</div>

		<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
			<div class="form-group">
				<label for="nombre">Seleccione una fecha</label>
				<input type="date" required  class = "form-control" id="fecha_final_1" name="fecha_final_1" >
			</div>
		</div>
		<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
			<div class="form-group">
				<br>
				<button name="porEmpleado" id="porEmpleado" class="btn btn-primary">Reporte</button>
			</div>
		</div>
	</div>
    {!! Form::close() !!}

		</div>
	{!! Form::close() !!}
@push ('scripts')
    <script>
        $('#fecha_inicio').on('change',fecha_inicio);
        $('#fecha_final').on('change',fecha_fin);

        $('#fecha_inicio_1').on('change',fecha_inicio_1);
        $('#fecha_final_1').on('change',fecha_fin_1);
        
        
		function fecha_inicio()
		{
			
			var hoy = new Date();
			var inicio = $("#fecha_inicio").val();
			var fecha_actual= new Date(inicio);
			//fecha_actual.setDate(fecha_actual.getDate()+1);
			if(fecha_actual >= hoy)
			{
				sweetAlert( "Oops" ,  "¡Debe seleccionar una fecha igual o menor a la fecha actual!" ,  "error" );
				document.getElementById("fecha_inicio").value = "";
			}
		}
			
		
		function fecha_fin()
		{
			var hoy = new Date();
			var inicio = $("#fecha_inicio").val();
			var fecha_inicio = new Date(inicio);
			var fin = $("#fecha_final").val();
            var fecha_fin= new Date(fin);
			if(fecha_fin >= hoy)
			{
				sweetAlert( "Oops" ,  "¡Debe seleccionar una fecha igual o menor a la fecha actual!" ,  "error" );
				document.getElementById("fecha_final").value = "";
			}
			if(fecha_fin < fecha_inicio)
			{
				sweetAlert( "Oops" ,  "¡Debe seleccionar una fecha igual o menor a la fecha anterior!" ,  "error" );
				document.getElementById("fecha_final").value = "";
			}
		}

		function fecha_inicio_1()
		{
			
			var hoy = new Date();
			var inicio = $("#fecha_inicio_1").val();
			var fecha_actual= new Date(inicio);
			//fecha_actual.setDate(fecha_actual.getDate()+1);
			if(fecha_actual >= hoy)
			{
				sweetAlert( "Oops" ,  "¡Debe seleccionar una fecha igual o menor a la fecha actual!" ,  "error" );
				document.getElementById("fecha_inicio_1").value = "";
			}
		}
			
		
		function fecha_fin_1()
		{
			var hoy = new Date();
			var inicio = $("#fecha_inicio_1").val();
			var fecha_inicio = new Date(inicio);
			var fin = $("#fecha_final_1").val();
            var fecha_fin= new Date(fin);
			if(fecha_fin >= hoy)
			{
				sweetAlert( "Oops" ,  "¡Debe seleccionar una fecha igual o menor a la fecha actual!" ,  "error" );
				document.getElementById("fecha_final_1").value = "";
			}
			if(fecha_fin < fecha_inicio)
			{
				sweetAlert( "Oops" ,  "¡Debe seleccionar una fecha igual o menor a la fecha anterior!" ,  "error" );
				document.getElementById("fecha_final_1").value = "";
			}
        }
        
       
	</script>
@endpush
@endsection