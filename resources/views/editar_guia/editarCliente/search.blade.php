{!! Form::open(array('url'=>'editar_guia/editarCliente','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
	<div class="form-group">
		<div class="input-group">
			<input type="text" class="form-control" name="searchText" placeholder="Inserte el nombre cliente a buscar..." value="{{$searchText}}">
			<span class="input-group-btn">
				<button type="submit" class="btn btn-primary">Buscar</button>				
			</span>
		</div>
	</div>
{{Form::close()}}