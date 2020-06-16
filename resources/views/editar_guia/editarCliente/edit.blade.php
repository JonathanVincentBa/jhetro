@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>
            Cliente: {{ $nombre->nom_remitente }} 
            <br><br>
			<a href="{{  URL::action('EditarGuiaClienteController@index')}}"><button class="btn btn-info">Cancelar</button></a>
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
<form method="POST" action="{{ url("editar_guia/editarCliente/{$nombre->nom_remitente}") }}">
	@csrf
	@method('PUT')
    <div class="row">
        <div class="col-lg-12 col-md.12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                
                <table class="table table-striped table-bordered table-condensed able-hover">
                    <thead>
                        <th>
                            <input type="checkbox" id="todo" onclick="todos()" />
                              Opcion
                        </th>
                        <th>Numero Guia</th>
                        <th>Destinatario</th>
                        <th>Ciudad Destino</th>
                        <th>Fecha</th>
                        <th>Valor</th>
                    </thead>
                    
                    @foreach ($cabecera as $cab)
                        <tr>
                            <td><input type="checkbox" class="checar" name="id_cabecera[]" id="id_cabecera[]" value="{{ $cab->id_cabecera }}"></span></td>
                            <td>{{ $cab->num_guia }}</td>
                            <td>{{ $cab->nom_destinatario }}</td>
                            <td>{{ $cab->ciudad_destino}}</td>
                            <td>{{ $cab->created_at}}</td>
                            <td>{{ $cab->valor_guia}}</td>
                        </tr>
                    @endforeach	    
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <br><button class="btn btn-primary" type="submit">Guardar</button>
        </div>
    </div>
</form>
@push ('scripts')
@endpush
    <script>
        function todos()
        {
            if ($(todo).prop('checked'))
            {
                $('.checar').prop('checked', true);
            }
            else
            {
                $('.checar').prop('checked', false);
            }
        } 
    </script>

@endsection
