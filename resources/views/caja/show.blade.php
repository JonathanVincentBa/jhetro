@extends ('layouts.admin')
@section ('contenido')
{!!Form::open(array('url'=>'caja/reportes/admin','method'=>'POST','autocomplete'=>'off'))!!}
	{{Form::token()}}
    <h3>Busqueda de Cajas de Usuarios <button class="btn btn-primary" type="submit">Generar</button></h3>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div>
                <label for="">Usuario:</label>
                <select name="usuario" required  class="form-control selectpicker" id="usuario" data-live-search="true" title="Seleccione un usuario...">
                    @foreach ($users as $usu)
                        <option value="{{ $usu->id }}">{{  $usu->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                    <label for="nombre">Seleccione una fecha</label>
					<input type="date" required class = "form-control" id="fecha" name="fecha">
            </div>
        </div>
    {!! Form::close() !!}
    @push ('scripts')
        <script>
            $('#fecha').on('change',fecha);
            function fecha()
            {  
                var hoy = new Date();
                var inicio = $("#fecha").val();
                var fecha_actual= new Date(inicio);
                //fecha_actual.setDate(fecha_actual.getDate()+1);
                if(fecha_actual > hoy)
                {
                    sweetAlert( "Oops" ,  "¡Debe seleccionar una fecha igual o menor a la fecha actual!" ,  "error" );
                    document.getElementById("fecha").value = "";
                }
            }
        </script>
    @endpush
@endsection