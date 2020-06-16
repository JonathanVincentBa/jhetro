@extends ('layouts.admin')
@section ('contenido')
{!!Form::open(array('url'=>'reportes/clientes/xfacturar1','method'=>'POST','autocomplete'=>'off'))!!}
	{{Form::token()}}
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<div class="form-group">
					<h3><b>Reportes de guias por facturar</b></h3>
				</div>	
			</div>
			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
				<div class="form-group">
					<label for="nombre">Seleccione un cliente</label>
					<select name="nom_remitente" required  class="form-control selectpicker" id="nom_remitente" data-live-search="true" title="Seleccione un cliente...">
						@foreach ($personas as $per)
							<option value="{{ $per->nom_remitente }}">{{  $per->nom_remitente}}</option>
						@endforeach
					</select>
				</div>	
			</div>
			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
				<div class="form-group">
					<label for="nombre">Seleccione una fecha</label>
					<input type="date" required  class = "form-control" id="fecha_inicio" name="fecha_inicio">
				</div>
			</div>

			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
				<div class="form-group">
					<label for="nombre">Seleccione una fecha</label>
					<input type="date" required  class = "form-control" id="fecha_final" name="fecha_final" >
				</div>
			</div>
			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
				<div class="form-group">
					<br>
					<button name="facturar" id="facturar" class="btn btn-primary">Reporte</button>
				</div>
			</div>
		</div>
	{!! Form::close() !!}
{!!Form::open(array('url'=>'reportes/clientes/xfacturar_excel','method'=>'POST','autocomplete'=>'off'))!!}
	{{Form::token()}}
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<div class="form-group">
					<h3><b>Reportes de guias por facturar Excel</b></h3>
				</div>	
			</div>
			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
				<div class="form-group">
					<label for="nombre">Seleccione un cliente</label>
					<select name="nom_remitente" required  class="form-control selectpicker" id="nom_remitente" data-live-search="true" title="Seleccione un cliente...">
						@foreach ($personas as $per)
							<option value="{{ $per->nom_remitente }}">{{  $per->nom_remitente}}</option>
						@endforeach
					</select>
				</div>	
			</div>
			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
				<div class="form-group">
					<label for="nombre">Seleccione una fecha</label>
					<input type="date" required class = "form-control" id="fecha_inicio_1" name="fecha_inicio_1">
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
					<button name="facturar_excel" id="facturar_excel" class="btn btn-success">Reporte Excel</button>
				</div>
			</div>
		</div>
    {!! Form::close() !!}
{!!Form::open(array('url'=>'reportes/clientes/xfacturarCanceladas','method'=>'POST','autocomplete'=>'off'))!!}
	{{Form::token()}}
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<div class="form-group">
					<h3><b>Reportes de guias por facturar canceladas</b></h3>
				</div>	
			</div>
			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
				<div class="form-group">
					<label for="nombre">Seleccione un cliente</label>
					<select name="nom_remitente" required  class="form-control selectpicker" id="nom_remitente" data-live-search="true" title="Seleccione un cliente...">
						@foreach ($personas as $per)
							<option value="{{ $per->nom_remitente }}">{{  $per->nom_remitente}}</option>
						@endforeach
					</select>
				</div>	
			</div>
			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
				<div class="form-group">
					<label for="nombre">Seleccione una fecha</label>
					<input type="date" required  class = "form-control" id="fecha_inicio_2" name="fecha_inicio_2">
				</div>
			</div>

			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
				<div class="form-group">
					<label for="nombre">Seleccione una fecha</label>
					<input type="date" required  class = "form-control" id="fecha_final_2" name="fecha_final_2" >
				</div>
			</div>
			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
				<div class="form-group">
					<br>
					<button name="facturar" id="facturar" class="btn btn-primary">Reporte</button>
				</div>
			</div>
		</div>
    {!! Form::close() !!}

	{!! Form::open(array('url'=>'reportes/clientes/xfacturarxPagar','method'=>'POST','autocomplete'=>'off'))!!}
	{{Form::token()}}
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<div class="form-group">
					<h3><b>Reportes de guias por facturar por pagar</b></h3>
				</div>	
			</div>
			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
				<div class="form-group">
					<label for="nombre">Seleccione un cliente</label>
					<select name="nom_remitente" required  class="form-control selectpicker" id="nom_remitente" data-live-search="true" title="Seleccione un cliente...">
						@foreach ($personas as $per)
							<option value="{{ $per->nom_remitente }}">{{  $per->nom_remitente}}</option>
						@endforeach
					</select>
				</div>	
			</div>
			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
				<div class="form-group">
					<label for="nombre">Seleccione una fecha</label>
					<input type="date" required  class = "form-control" id="fecha_inicio_3" name="fecha_inicio_3">
				</div>
			</div>

			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
				<div class="form-group">
					<label for="nombre">Seleccione una fecha</label>
					<input type="date" required  class = "form-control" id="fecha_final_3" name="fecha_final_3" >
				</div>
			</div>
			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
				<div class="form-group">
					<br>
					<button name="facturar" id="facturar" class="btn btn-primary">Reporte</button>
				</div>
			</div>
		</div>
	{!! Form::close() !!}

{!! Form::open(array('url'=>'reportes/clientes/xfacturarxPagarTodos','method'=>'POST','autocomplete'=>'off'))!!}
	{{Form::token()}}
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<div class="form-group">
					<h3><b>Reportes de guias por facturar por pagar todos los clientes</b></h3>
				</div>	
			</div>
			<div class="col-lg-5 col-sm-4 col-md-4 col-xs-12">
				<div class="form-group">
					<label for="nombre">Seleccione una fecha</label>
					<input type="date" required  class = "form-control" id="fecha_inicio_5" name="fecha_inicio_5">
				</div>
			</div>

			<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
				<div class="form-group">
					<label for="nombre">Seleccione una fecha</label>
					<input type="date" required  class = "form-control" id="fecha_final_5" name="fecha_final_5" >
				</div>
			</div>
			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
				<div class="form-group">
					<br>
					<button name="facturar" id="facturar" class="btn btn-primary">Reporte</button>
				</div>
			</div>
		</div>
	{!! Form::close() !!}

	{!! Form::open(array('url'=>'reportes/clientes/xTodasFormasPago','method'=>'POST','autocomplete'=>'off'))!!}
	{{Form::token()}}
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<div class="form-group">
					<h3><b>Reportes de cliente con todas las formas de pago</b></h3>
				</div>	
			</div>
			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
				<div class="form-group">
					<label for="nombre">Seleccione un cliente</label>
					<select name="nom_remitente" required  class="form-control selectpicker" id="nom_remitente" data-live-search="true" title="Seleccione un cliente...">
						@foreach ($personas as $per)
							<option value="{{ $per->nom_remitente }}">{{  $per->nom_remitente}}</option>
						@endforeach
					</select>
				</div>	
			</div>
			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
				<div class="form-group">
					<label for="nombre">Seleccione una fecha</label>
					<input type="date" required  class = "form-control" id="fecha_inicio_4" name="fecha_inicio_4">
				</div>
			</div>

			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
				<div class="form-group">
					<label for="nombre">Seleccione una fecha</label>
					<input type="date" required  class = "form-control" id="fecha_final_4" name="fecha_final_4">
				</div>
			</div>
			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
				<div class="form-group">
					<br>
					<button name="facturar" id="facturar" class="btn btn-primary">Reporte</button>
				</div>
			</div>
		</div>
	{!! Form::close() !!}
@push ('scripts')
    <script>
		$('#fecha_inicio').on('change',fecha_inicio);
		$('#fecha_final').on('change',fecha_fin);

		$('#fecha_inicio_1').on('change',fecha_inicio_1);
        $('#fecha_final_1').on('change',fecha_fin_1);
        
        $('#fecha_inicio_2').on('change',fecha_inicio_2);
		$('#fecha_final_2').on('change',fecha_fin_2);

		$('#fecha_inicio_3').on('change',fecha_inicio_3);
		$('#fecha_final_3').on('change',fecha_fin_3);

		$('#fecha_inicio_4').on('change',fecha_inicio_4);
		$('#fecha_final_4').on('change',fecha_fin_4);
		
		$('#fecha_inicio_5').on('change',fecha_inicio_5);
		$('#fecha_final_5').on('change',fecha_fin_5);
		
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

		function fecha_inicio_5()
		{
			
			var hoy = new Date();
			var inicio = $("#fecha_inicio_5").val();
			var fecha_actual= new Date(inicio);
			//fecha_actual.setDate(fecha_actual.getDate()+1);
			if(fecha_actual > hoy)
			{
				sweetAlert( "Oops" ,  "¡Debe seleccionar una fecha igual o menor a la fecha actual!" ,  "error" );
				document.getElementById("fecha_inicio_5").value = "";
			}
		}
			
		
		function fecha_fin_5()
		{
			var hoy = new Date();
			var inicio = $("#fecha_inicio_5").val();
			var fecha_inicio = new Date(inicio);
			var fin = $("#fecha_final_5").val();
            var fecha_fin= new Date(fin);
			if(fecha_fin >= hoy)
			{
				sweetAlert( "Oops" ,  "¡Debe seleccionar una fecha igual o menor a la fecha actual!" ,  "error" );
				document.getElementById("fecha_final_5").value = "";
			}
			if(fecha_fin < fecha_inicio)
			{
				sweetAlert( "Oops" ,  "¡Debe seleccionar una fecha igual o menor a la fecha anterior!" ,  "error" );
				document.getElementById("fecha_final_5").value = "";
			}
		}
	</script>
@endpush
@endsection