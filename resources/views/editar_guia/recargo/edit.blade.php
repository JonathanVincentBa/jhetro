@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>
			<a href="{{URL::action('EditarGuiaController@index')}}"><button class="btn btn-info">Cancelar</button></a>
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
<form method="POST" action="{{ url("editar_guia/recargo/{$cabecera->id_cabecera}") }}">
	@csrf
	@method('PUT')
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label for="recargo">Numero de Guia</label>
				<input type="number" name="num_guia" id="num_guia" class="form-control" value="{{  $cabecera->num_guia}}" placeholder="Recargo..." onKeyUp="this.value=this.value.toUpperCase();">
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label for="recargo">Forma de pago</label>
				<select name="id_formas_pago" class="form-control selectpicker" data-live-search="true"  requerid>
					@foreach ($forma_pago as $for)
					{
						@if($for->id_formas_pago==$cabecera->id_forma_pago)
							<option value="{{$for->id_formas_pago}}" selected>{{$for->descripcion}}</option>
						@else
							<option value="{{$for->id_formas_pago}}">{{$for->descripcion}}</option>
						@endif
					}
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label for="recargo">Recargo</label>
				<input type="number" step="0.001" name="recargo" id="recargo" class="form-control" value="{{$cabecera->recargo}}" placeholder="Recargo..." onKeyUp="this.value=this.value.toUpperCase();">
			</div>
		</div>
		
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label for="recargo">Ciudad Origen</label>
				<select name="ciudad_origen" class="form-control selectpicker" data-live-search="true"  requerid>
					@foreach ($sucursales as $ciu)
					{
						@if($ciu->descripcion==$cabecera->ciudad_origen)
							<option value="{{$ciu->descripcion}}" selected>{{$ciu->descripcion}}</option>
						@else
							<option value="{{$ciu->descripcion}}">{{$ciu->descripcion}}</option>
						@endif
					}
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label for="recargo">Ciudad Destino</label>
				<select name="ciudad_destino" class="form-control selectpicker" data-live-search="true"  requerid>
					@foreach ($ciudades as $suc)
					{
						@if($suc->descripcion==$cabecera->ciudad_destino)
							<option value="{{$suc->descripcion}}" selected>{{$suc->descripcion}}</option>
						@else
							<option value="{{$suc->descripcion}}">{{$suc->descripcion}}</option>
						@endif
					}
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label for="recargo">Remitente</label>
				<select name="id_persona" class="form-control selectpicker" data-live-search="true"  requerid>
					@foreach ($personas as $per)
					{
						@if($per->id_persona==$cabecera->id_persona)
							<option value="{{$per->id_persona}}" selected>{{$per->nombre}}</option>
						@else
							<option value="{{$per->id_persona}}">{{$per->nombre}}</option>
						@endif
						
					}
					@endforeach
				</select>
			</div>
		</div>
		

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-group">
				<label for="nota">Nota</label>
				<textarea class="form-control" name="nota" rows="5">{{ $cabecera->nota }}</textarea>
			</div>
		</div>

		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
			<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
				<thead style="background-color:#A9D0F5 ">
					<th style="text-align:center; width : 60px">Cantidad</th>
					<th style="text-align:center; width : 600px">Descripcion</th>
					<th style="text-align:center; width : 60px">V. Unitario</th>
					<th style="text-align:center; width : 60px">V. Parcial</th>
				</thead>
				<tfoot>
					<tr>
						<td></td>
						<td></td>
						<td style="text-align:right;"><B><br>FLETE</B></td>
						<td style="font-family: Arial; font-size: 12pt;"><br>$ <input  size="10" style="font-family: Arial; font-size: 12pt; width : 60px; border: none; " readonly name="flete" id="flete" value="{{ $cabecera->flete }}"></input></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td style="text-align:right;"><B><br>PRIMA</B></td>
						<td style="font-family: Arial; font-size: 12pt;"><br>$ <input style="font-family: Arial; font-size: 12pt; width : 60px; border: none; " type="number"  size="10"  name="prima" id="prima" value="{{ $cabecera->prima }}" onKeyUp="this.value=this.value.toUpperCase();"></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td style="text-align:right;"><B><br>VALOR GUIA</B></td>
						<td style="font-family: Arial; font-size: 12pt;"><br>$ <input  size="10" style="font-family: Arial; font-size: 12pt; width : 60px; border: none; " readonly name="valor_guia" id="valor_guia" value="{{ $cabecera->valor_guia }}"></input></td>
					</tr>
				</tfoot>
				<tbody>
						<?php
							$cont=0;
						?>
					@foreach($detalles as $det)
						<tr>			
							<input type="hidden" name="id_detalle[]" value="{{ $det->id_detalle }}">
							<td><input style=" width : 60px; border: none " type="number" name="cantidad[]" id="cantidad[]" value="{{ $det->cantidad }}" onblur="cantidad();"></td>
							<td><input style=" width : 600px; border: none " type="text" readonly name="descripcion[]" id="descripcion[]" value="{{ $det->descripcion }}"></td>
							<td><input style=" width : 90px; border: none " type="number" step="0.01" name="v_unitario[]" id="v_unitario" value="{{ $det->v_unitario }}" onblur="unitario();"></td>
							<td><input style=" width : 90px; border: none " type="number" readonly id="v_parcial<?php echo $cont; ?>" name="v_parcial[]" value="{{ $det->v_parcial }}"></td>
							<?php
								$cont++;
							?>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<br><button class="btn btn-primary" type="submit">Guardar</button>
		</div>
	</div>
</form>
@push ('scripts')
	<script>
			flete=0;
			total=0;
			prima=0;

						
			$("#recargo").change(function()
			{
				recargo=$("#recargo").val();
				flete=$("#flete").val();
				prima=$("#prima").val();
				valor_guia=parseFloat(flete)+parseFloat(prima)+parseFloat(recargo);
				$("#valor_guia").val(valor_guia);
			});

			$("#prima").change(function()
			{
				recargo=$("#recargo").val();
				flete=$("#flete").val();
				prima=$("#prima").val();
				valor_guia=parseFloat(flete)+parseFloat(prima)+parseFloat(recargo);
				$("#valor_guia").val(valor_guia);
			});
			
	
			function cantidad()
			{
				//Obtengo todos los campos con el nombre cantidad[]
				var cantidad = document.getElementsByName("cantidad[]");
				var v_unitario = document.getElementsByName("v_unitario[]");
				//Creo el arreglo donde almaceno sus valores
				var cant = [];
				var unit = [];
				
				flete=0;
				//Recorro todos los nodos que encontre que coinciden con ese nombre
				for(var i=0;i<cantidad.length;i++){
					//Añado el valor que contienen los campos
					cant.push(cantidad[i].value);
					unit.push(v_unitario[i].value);
					parcial = cant[i]*unit[i];
					$('#v_parcial'+i).val(parcial);
					flete=flete+parcial;
				}
				totales(flete);
			}

			function unitario()
			{
				//Obtengo todos los campos con el nombre cantidad[]
				var cantidad = document.getElementsByName("cantidad[]");
				var v_unitario = document.getElementsByName("v_unitario[]");
				//Creo el arreglo donde almaceno sus valores
				var cant = [];
				var unit = [];
				var parc = [];
				flete=0;
				//Recorro todos los nodos que encontre que coinciden con ese nombre
				for(var i=0;i<cantidad.length;i++){
					//Añado el valor que contienen los campos
					cant.push(cantidad[i].value);
					unit.push(v_unitario[i].value);
					parcial = cant[i]*unit[i];
					$('#v_parcial'+i).val(parcial);
					flete=flete+parcial;
				}
				totales(flete);
				
			}

			function totales()
			{
				$("#flete").val(flete.toFixed(2));
				recargo=$("#recargo").val();
				flete=$("#flete").val();
				prima=$("#prima").val();
				valor_guia=parseFloat(flete)+parseFloat(prima)+parseFloat(recargo);
				$("#valor_guia").val(valor_guia);
			}
	</script>
@endpush
@endsection