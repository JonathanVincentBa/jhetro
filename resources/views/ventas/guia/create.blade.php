@extends ('layouts.admin')
@section ('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3><B>Nueva Guia</B></h3>
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
{!!Form::open(array('url'=>'ventas/guia','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
        <div class="row">
             <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                    <label>Fecha de emision</label><br>
                    <input type="date" readonly name="fecha" step="1" min="2013-01-01" max="2013-12-31" value="<?php echo date("Y-m-d");?>">
                </div>
            </div>
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                    <label>Numero de Guia Jhetro</label>
                    <input type="number" required name="num_guia" class="form-control" placeholder="Numero de Guia...">
                </div>
            </div>
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                    <label>Numero de Guia Transbordo</label>
                    <input type="number" name="num_guia_trans" class="form-control" placeholder="Numero de Guia...">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <div class="form-group">
                    <label>Guia Cliente</label>
                    <input type="text" name="guia_rem_cliente" class="form-control" placeholder="Guia de remision del cliente..." onKeyUp="this.value=this.value.toUpperCase();">
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <div class="form-group">
                    <label>Factura Cliente</label>
                    <input type="text" name="factura_cliente" class="form-control" placeholder="Guia de remision del cliente..." onKeyUp="this.value=this.value.toUpperCase();">
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <div class="form-group">
                    <label>Ciudad de Origen</label>
                    <select name="ciudad_origen" required class="form-control selectpicker" id="ciudad_origen" data-live-search="true" title="Seleccione la ciudad de origen...">
                    @foreach($sucursales as $sucursal)
                        <option value="{{ $sucursal->id_sucursal }}">{{ $sucursal->ciudad }}</option>
                    @endforeach
                    </select>
                    <input type="hidden" readonly name="ciu_ori" id="ciu_ori" >
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <div class="form-group">
                    <label>Ciudad de Destino</label>
                    <select name="ciudad_destino" required class="form-control selectpicker" id="ciudad_destino" data-live-search="true" title="Seleccione la ciudad de origen...">
                    @foreach($ciudades as $ciudad)
                        <option value="{{ $ciudad->id_ciudad }}">{{ $ciudad->descripcion }}</option>
                    @endforeach
                    </select>
                    <input type="hidden" readonly name="ciu_des" id="ciu_des" >
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <div class="form-group">
                    <label>Remitente</label>
                    <select name="nombre_remitente" id="nombre_remitente" required class="form-control selectpicker" data-live-search="true" title="Seleccione el remitente...">
                        @foreach($personas as $per)
                            <option value="{{ $per->id_persona }}_{{ $per->num_dni }}_{{ $per->direccion }}_{{ $per->telefono }}_{{ $per->nombre }}">{{ $per->nombre }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" readonly name="nom_remitente" id="nom_remitente" >
                    <input type="hidden" readonly name="id_persona" id="id_persona" >
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <div class="form-group">
                    <label>C.I./RUC</label>
                    <input type="number" readonly name="dni_remitente" id="dni_remitente" class="form-control" placeholder="D.N.I. del remitente..." onKeyUp="this.value=this.value.toUpperCase();">
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <div class="form-group">
                    <label>Direccion</label>
                    <input type="text"readonly  name="direccion_remitente" id="direccion_remitente" class="form-control" placeholder="Direccion del remitente..." onKeyUp="this.value=this.value.toUpperCase();">
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <div class="form-group">
                    <label>Telefono</label>
                    <input type="text" readonly name="fono_remitente" id="fono_remitente" class="form-control" placeholder="Telefono del remitente..." onKeyUp="this.value=this.value.toUpperCase();">
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <div class="form-group">
                    <label>Destinatario</label>
                    <input type="text"  name="nom_destinatario" id="nom_destinatario" class="form-control" placeholder="Nombre del destinatario..." onKeyUp="this.value=this.value.toUpperCase();">
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <div class="form-group">
                    <label>C.I./RUC</label>
                    <input type="number" name="dni_destinatario" id="dni_destinatario" class="form-control" placeholder="D.N.I. del destinatario..." onKeyUp="this.value=this.value.toUpperCase();">
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <div class="form-group">
                    <label>Direccion</label>
                    <input type="text"  name="direccion_destinatario" id="direccion_destinatario" class="form-control" placeholder="Direccion del destinatario..." onKeyUp="this.value=this.value.toUpperCase();">
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <div class="form-group">
                    <label>Telefono</label>
                    <input type="number"  name="fono_destinatario" id="fono_destinatario" class="form-control" placeholder="Telefono del destinatario..." onKeyUp="this.value=this.value.toUpperCase();">
                </div>
            </div>
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                    <label>Motivo de Traslado</label>
                    <select name="id_motivo_traslado" required class="form-control selectpicker" id="id_motivo_traslado" data-live-search="false" title="Seleccione el motivo de traslado...">
                    @foreach($motivos_traslado as $motivo_traslado)
                        <option value="{{ $motivo_traslado->id_motivo_traslado }}">{{ $motivo_traslado->descripcion }}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                    <label>Forma de pago</label>
                    <select name="id_forma_pago" required class="form-control selectpicker" id="id_forma_pago" data-live-search="false" title="Seleccione la forma de pago...">
                    @foreach($formas_pagos as $forma_pago)
                        <option value="{{ $forma_pago->id_formas_pago }}">{{ $forma_pago->descripcion }}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                    <label>Prima</label>
                    <input type="number" step="0.01" name="pprima" id="pprima" class="form-control" placeholder="Prima..." value="0" onKeyUp="this.value=this.value.toUpperCase();">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                        <div class="form-group">
                            <label>Cantidad</label>
                            <input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad...">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                        <div class="form-group">
                            <label>DESCRIPCION</label>
                            <input type="text" name="pdescripcion" id="pdescripcion" class="form-control" placeholder="Descripcion..." onKeyUp="this.value=this.value.toUpperCase();">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                        <div class="form-group">
                            <label>V.UNITARIO</label>
                            <input type="number" name="pv_unitario" id="pv_unitario" class="form-control" placeholder="Valor unitario...">
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                        <div class="form-group">
                            <br><button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color:#A9D0F5 ">
                                <th>Opciones</th>
                                <th>Cantidad</th>
                                <th>Descripcion</th>
                                <th>V. Unitario</th>
                                <th>V. Parcial</th>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align:right;"><B><br>FLETE</B></td>
                                    <td style="font-family: Arial; font-size: 12pt;"><br>$ <input  size="10" style="font-family: Arial; font-size: 12pt; width : 60px; border: none; " readonly name="flete" id="flete" value="0.00"></input></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align:right;"><B><br>PRIMA</B></td>
                                    <td style="font-family: Arial; font-size: 12pt;"><br>$ <input  size="10" style="font-family: Arial; font-size: 12pt; width : 60px; border: none; " readonly name="prima" id="prima" value="0.00"></input></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align:right;"><B><br>VALOR GUIA</B></td>
                                    <td style="font-family: Arial; font-size: 12pt;"><br>$ <input  size="10" style="font-family: Arial; font-size: 12pt; width : 60px; border: none; " readonly name="valor_guia" id="valor_guia" value="0.00"></input></td>
                                </tr>
                            </tfoot>
                            <tbody>
                                      
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="guardar">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" >
                <div class="form-group">
                    <input name"_token" value="{{ csrf_token() }}" type="hidden"></input>
                    <button class="btn btn-primary" type="submit" id="bt_guardar">Guardar</button>
                    <button class="btn btn-danger" type="reset">Cancelar</button>
                </div>
            </div>
        </div>
        
{!!Form::close()!!}
@push ('scripts')
    <script>
        $(document).ready(function(){
          $('#bt_add').click(function(){
            agregar();
          });
        });

        

        total = 0;
        var cont = 0;
        var i = 0;
        subtotal = [];
        
        $("#guardar").hide();
        //$("#id_persona").change(mostrarValoresRemitente);
        $("#nombre_remitente").change(mostrarValoresRemitente);
        $('#ciudad_origen').on('change',onSelectPersonaOrigenChange);
        $('#ciudad_destino').on('change',onSelectPersonaDestinoChange);

        function agregar()
        {
            cantidad=$("#pcantidad").val();
            descripcion=$("#pdescripcion").val();
            v_unitario=$("#pv_unitario").val();
            if(cantidad!="" && cantidad>0 && descripcion!="" && v_unitario!="")
            {
                subtotal[cont]=(cantidad*v_unitario);
                total=total+subtotal[cont];

                var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger btn-xs btn-block" onclick="eliminar('+cont+');">X</button></td><td><input type="number" readonly name="cantidad[]" value="'+cantidad+'"></td><td><input type="text" name="descripcion[]" value="'+descripcion+'"></td><td><input type="number" readonly step="0.01" name="v_unitario[]" value="'+v_unitario+'"></td><td><input type="number" readonly id="v_parcial[]" name="v_parcial[]" value="'+subtotal[cont]+'"></td></tr>';
                cont++;
                limpiar();
                totales();
                evaluar();
                $('#detalles').append(fila);
            }
            else
            {
                if(cantidad=="")
                    sweetAlert("Error",'No ha ingresado una cantidad',"error");
                else
                {
                    if(parseInt(cantidad)<0)
                        sweetAlert("Error",'La cantidad tiene que ser mayor a cero (0)',"error");
                    else
                    {
                        if(descripcion=="")
                            sweetAlert("Error",'No ha ingresado una descripcion',"error");
                        else
                        {
                            if(v_unitario=="")
                                sweetAlert("Error",'No ha ingresado un precio unitario',"error");
                            else
                            {                                
                                if(parseFloat(v_unitario)<0)
                                    sweetAlert("Error",'El precio unitario tiene que ser mayor a cero (0)',"error");
                            }
                        }
                    }
                }
            }
            i++;
            bloquear(i);
                  
        }
        
        function bloquear(i)
        {
            console.log(i);
            if(i==5)
            {
                $("#pcantidad").prop("disabled",true);
                $("#pdescripcion").prop("disabled",true);
                $("#pv_unitario").prop("disabled",true);
            } 
            else
            {
                $("#pcantidad").prop("disabled",false);
                $("#pdescripcion").prop("disabled",false);
                $("#pv_unitario").prop("disabled",false);
            }

        }
        function totales()
        {
            prima=$("#pprima").val();
            flete = total;
            total_pagar = parseFloat(total)+parseFloat(prima);
            $("#flete").val(flete.toFixed(2));
            $("#prima").val(prima);
            $("#valor_guia").val(total_pagar.toFixed(2));
        }

        function onSelectPersonaOrigenChange() 
        {
            ciudad_origen=$("#ciudad_origen option:selected").text();
            console.log(ciudad_origen);
            $("#ciu_ori").val(ciudad_origen);
        }
        
        function onSelectPersonaDestinoChange() 
        {
            ciudad_origen=$("#ciudad_destino option:selected").text();
            $("#ciu_des").val(ciudad_origen);    
        }

        function mostrarValoresRemitente()
        {
           
          datosRemitente=document.getElementById('nombre_remitente').value.split('_');
          $("#id_persona").val(datosRemitente[0]);
          $("#dni_remitente").val(datosRemitente[1]);
          $("#direccion_remitente").val(datosRemitente[2]);
          $("#fono_remitente").val(datosRemitente[3]);   
          $("#nom_remitente").val(datosRemitente[4]);
        }

        function limpiar()
        {
            $("#pcantidad").val("");
            $("#pdescripcion").val("");
            $("#pv_unitario").val("");
            $("#pcantidad").focus();
        }

        function evaluar()
        {
            if(total>0)
            {
                $("#guardar").show();
            }
            else
            {
                $("#guardar").hide();
                
                    sweetAlert("Error",'No ha ingrasado ningun valor Item para enviar',"error");
                
            }
        }

        function eliminar(index)
        {
            total=total-subtotal[index];
            $("#flete").val(total);
            $("#valor_guia").val(total);
            $("#fila" + index).remove();
            i--;
            bloquear(i);
            evaluar();
        }

    </script>
@endpush
@endsection