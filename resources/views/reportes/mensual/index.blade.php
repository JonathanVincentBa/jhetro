@extends ('layouts.admin')
@section ('contenido')
{!!Form::open(array('url'=>'reportes/mensual/xenvioExcel','method'=>'POST','autocomplete'=>'off'))!!}
	{{Form::token()}}
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<div class="form-group">
					<h3><b>Reporte manifiesto por ciudades de destino</b></h3>
				</div>	
			</div>
			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
				<div class="form-group">
					<label for="ciudad">Seleccione las ciudades de destino</label>
					<select name="ciudad_destino[]" required  class="form-control selectpicker" multiple id="ciudad" data-live-search="true" title="Seleccione una ciudad...">
						@foreach ($ciudades as $per)
							<option value="{{ $per->descripcion }}">{{  $per->descripcion}}</option>
						@endforeach
					</select>
				</div>	
			</div>
			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
				<div class="form-group">
					<label for="nombre">Seleccione una fecha</label>
					<input type="date" required class = "form-control" id="fecha_inicio_3" name="fecha_inicio_3">
				</div>
			</div>

			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
					<div class="form-group">
						<label for="nombre">Seleccione una fecha</label>
						<input type="date" required class = "form-control" id="fecha_final_3" name="fecha_final_3">
					</div>
				</div>
			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
				<div class="form-group">
					<br>
					<button name="facturar" id="facturar" class="btn btn-success">Reporte Excel</button>
				</div>
			</div>
		</div>
		
	{!! Form::close() !!}
{!!Form::open(array('url'=>'reportes/mensual/xciudadExcel','method'=>'POST','autocomplete'=>'off'))!!}
	{{Form::token()}}
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<div class="form-group">
					<h3><b>Reporte manifiesto por ciudad de origen</b></h3>
				</div>	
			</div>
			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
				<div class="form-group">
					<label for="ciudad">Seleccione una ciudad</label>
					<select name="ciudad" required  class="form-control selectpicker" id="ciudad" data-live-search="true" title="Seleccione una ciudad...">
						@foreach ($sucursales as $suc)
							<option value="{{ $suc->descripcion }}">{{  $suc->descripcion}}</option>
						@endforeach
					</select>
				</div>	
			</div>
			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
				<div class="form-group">
					<label for="nombre">Seleccione una fecha</label>
					<input type="date" required class = "form-control" id="fecha_inicio_2" name="fecha_inicio_2">
				</div>
			</div>

			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
					<div class="form-group">
						<label for="nombre">Seleccione una fecha</label>
						<input type="date" required class = "form-control" id="fecha_final_2" name="fecha_final_2">
					</div>
				</div>
			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
				<div class="form-group">
					<br>
					<button name="facturar" id="facturar" class="btn btn-success">Reporte Excel</button>
				</div>
			</div>
		</div>
		
    {!! Form::close() !!}
{!!Form::open(array('url'=>'reportes/mensual/guiasAnuladas','method'=>'POST','autocomplete'=>'off'))!!}
	{{Form::token()}}
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<div class="form-group">
					<h3><b>Reporte de guias anuladas</b></h3>
				</div>	
			</div>
			
			<div class="col-lg-5 col-sm-5 col-md-5 col-xs-12">
				<div class="form-group">
					<label for="nombre">Seleccione una fecha</label>
					<input type="date" required class = "form-control" id="fecha_inicio_4" name="fecha_inicio_4">
				</div>
			</div>

			<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
					<div class="form-group">
						<label for="nombre">Seleccione una fecha</label>
						<input type="date" required class = "form-control" id="fecha_final_4" name="fecha_final_4">
					</div>
				</div>
			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
				<div class="form-group">
					<br>
					<button name="facturar" id="facturar" class="btn btn-primary">Generar</button>
				</div>
			</div>
		</div>
		
	{!! Form::close() !!}
@push ('scripts')
    <script>

		$('#fecha_inicio_2').on('change',fecha_inicio_2);
		$('#fecha_final_2').on('change',fecha_fin_2);

		$('#fecha_inicio_3').on('change',fecha_inicio_3);
        $('#fecha_final_3').on('change',fecha_fin_3);
        
        $('#fecha_inicio_4').on('change',fecha_inicio_4);
		$('#fecha_final_4').on('change',fecha_fin_4);
	
		function fecha_inicio_2()
		{
			
			var hoy = new Date();
			var inicio = $("#fecha_inicio_2").val();
			var fecha_actual= new Date(inicio);
			//fecha_actual.setDate(fecha_actual.getDate()+1);
			if(fecha_actual >= hoy)
			{
				sweetAlert( "Oops" ,  "¡Debe seleccionar una fecha igual o menor a la fecha actual!" ,  "error" );
				document.getElementById("fecha_inicio_2").value = "";
			}
		}
			
		
		function fecha_fin_2()
		{
			var hoy = new Date();
			var inicio = $("#fecha_inicio_2").val();
			var fecha_inicio = new Date(inicio);
			var fin = $("#fecha_final_2").val();
            var fecha_fin= new Date(fin);
			if(fecha_fin > hoy)
			{
				sweetAlert( "Oops" ,  "¡Debe seleccionar una fecha igual o menor a la fecha actual!" ,  "error" );
				document.getElementById("fecha_final_2").value = "";
			}
			if(fecha_fin < fecha_inicio)
			{
				sweetAlert( "Oops" ,  "¡Debe seleccionar una fecha igual o menor a la fecha anterior!" ,  "error" );
				document.getElementById("fecha_final_2").value = "";
			}
		}

		function fecha_inicio_3()
		{
			
			var hoy = new Date();
			var inicio = $("#fecha_inicio_3").val();
			var fecha_actual= new Date(inicio);
			//fecha_actual.setDate(fecha_actual.getDate()+1);
			if(fecha_actual > hoy)
			{
				sweetAlert( "Oops" ,  "¡Debe seleccionar una fecha igual o menor a la fecha actual!" ,  "error" );
				document.getElementById("fecha_inicio_3").value = "";
			}
		}
			
		
		function fecha_fin_3()
		{
			var hoy = new Date();
			var inicio = $("#fecha_inicio_3").val();
			var fecha_inicio = new Date(inicio);
			var fin = $("#fecha_final_3").val();
            var fecha_fin= new Date(fin);
			if(fecha_fin >= hoy)
			{
				sweetAlert( "Oops" ,  "¡Debe seleccionar una fecha igual o menor a la fecha actual!" ,  "error" );
				document.getElementById("fecha_final_3").value = "";
			}
			if(fecha_fin < fecha_inicio)
			{
				sweetAlert( "Oops" ,  "¡Debe seleccionar una fecha igual o menor a la fecha anterior!" ,  "error" );
				document.getElementById("fecha_final_3").value = "";
			}
        }
        
        function fecha_inicio_4()
		{
			
			var hoy = new Date();
			var inicio = $("#fecha_inicio_4").val();
			var fecha_actual= new Date(inicio);
			//fecha_actual.setDate(fecha_actual.getDate()+1);
			if(fecha_actual > hoy)
			{
				sweetAlert( "Oops" ,  "¡Debe seleccionar una fecha igual o menor a la fecha actual!" ,  "error" );
				document.getElementById("fecha_inicio_4").value = "";
			}
		}
			
		
		function fecha_fin_4()
		{
			var hoy = new Date();
			var inicio = $("#fecha_inicio_4").val();
			var fecha_inicio = new Date(inicio);
			var fin = $("#fecha_final_4").val();
            var fecha_fin= new Date(fin);
			if(fecha_fin >= hoy)
			{
				sweetAlert( "Oops" ,  "¡Debe seleccionar una fecha igual o menor a la fecha actual!" ,  "error" );
				document.getElementById("fecha_final_4").value = "";
			}
			if(fecha_fin < fecha_inicio)
			{
				sweetAlert( "Oops" ,  "¡Debe seleccionar una fecha igual o menor a la fecha anterior!" ,  "error" );
				document.getElementById("fecha_final_4").value = "";
			}
		}
		
	</script>
@endpush
@endsection