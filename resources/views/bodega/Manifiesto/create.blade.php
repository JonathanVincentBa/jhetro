@extends('layouts.admin')
@section('contenido')
    {!!Form::open(array('url'=>'bodega/manifiesto','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="">Ciudad de Origen</label>
                <select name="ciudad_origen" id="ciudad_origen" class="form-control selectpicker" id="ciudad_origen" data-live-search="true" title="Seleccione la ciudad de origen...">
                    @foreach($ciudades as $ciu)
                        <option value="{{ $ciu->id_ciudad }}">{{ $ciu->descripcion }}</option>
                    @endforeach
                </select>
                <input type="hidden" readonly name="ciu_ori" id="ciu_ori" >
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="">Ciudad de Destino</label>
                <select name="ciudad_destino" id="ciudad_destino" class="ciudad_destino form-control">
                        
                </select>
            
                <input type="hidden" readonly name="ciu_des" id="ciu_des" >
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="">Vehiculo</label>
                <select name="vehiculo" id="vehiculo" class="vehiculo form-control">
                        <option value=""></option>
                </select>
            </div>
        </div>
    </div>
    <div class="row" id="guardar">
        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                    <div class="form-group">
                        <label for="">Guia</label>
                        <select name="id_cabecera" id="id_cabecera" class="guia form-control">
                                <option value=""></option>
                        </select>
                        <input type="hidden" readonly name="ciu_des" id="ciu_des" >
                    </div>
                </div>
                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <label for="">Nombre Remitente</label><br>
                        <input type="text" readonly value="" name="nombre_remitente" id="nombre_remitente" >
                    </div>
                </div>
                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <label for="">Nombre Destinatario</label><br>
                        <input type="text" readonly value="" name="nombre_destinatario" id="nombre_destinatario" >
                    </div>
                </div>
                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <label for="">Valor de Giua</label><br>
                        <input type="text" readonly value="" name="valor" id="valor"  >
                    </div>
                </div>
                <input type="hidden" readonly name="num_guia" id="num_guia" >
                <input type="hidden" readonly name="id_guia" id="id_guia" >
                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <br><button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
                    </div>
                </div>
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color:#A9D0F5 ">
                            <th>Opciones</th>
                            <th>Num. guia</th>
                            <th>Remitente</th>
                            <th>Destinatario</th>
                            <th>V. Parcial</th>
                        </thead>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td ></td>
                                <td ></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align:right;"><B><br>Valor del manifiesto</B></td>
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
    <div class="row" id="cargar">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" >
            <div class="form-group">
                <input name"_token" value="{{ csrf_token() }}" type="hidden"></input>
                <button class="btn btn-primary" type="submit">Guardar</button>
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
        $("#ciudad_origen").on('change',onSelectCiudadChange);
        $("#ciudad_destino").on('change',onSelectVehiculoChange);
        $("#vehiculo").on('change',onSelectGuiaChange);
        $("#id_cabecera").change(mostrarValoresGuia);
        $("#guardar").hide();
        $("#cargar").hide();
        $(document).ready(function() {
            $('.ciudad_destino').select2({
                placeholder: 'Seleccione una ciudad de origen primero...'
            });
        });
        $(document).ready(function() {
            $('.vehiculo').select2({
                placeholder: 'Seleccione una ciudad de destino primero...'
            });
        });
        $(document).ready(function() {
            $('.guia').select2({
                placeholder: 'Seleccione un vehiculo primero...'
            });
        });

        total = 0;
        var cont = 0;
        subtotal = [];
        var elimina;
        var id;
        var añadir=[];
        var datosGuia;

        function agregar()
        {
            $("#cargar").show();
            nom_rem=$("#nombre_remitente").val();
            nom_des=$("#nombre_destinatario").val();
            val=$("#valor").val();
            num=$("#num_guia").val();
            id_guia=$("#id_guia").val();
            if(nom_rem!="" && nom_des!="" && val!="" && num!="")
            {
                añadir[cont]=$("#id_cabecera").val();
                subtotal[cont]=parseFloat(val);
                total=total+parseFloat(val);
                var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger btn-xs btn-block" onclick="eliminar('+cont+');">X</button><td><input type="text" readonly name="num[]" value="'+num+'"></td></td><td><input type="text" readonly name="nom_rem[]" value="'+nom_rem+'"></td><td><input type="text" readonly name="nom_des[]" value="'+nom_des+'"></td><td><input type="number" readonly name="val[]" value="'+val+'"></td><td><input type="hidden" readonly name="id_guia[]" value="'+id_guia+'"></td></tr>';
                cont++;
                limpiar();
                totales();
                $('#detalles').append(fila);
            }
            else
            {
                sweetAlert("Error",'El precio unitario tiene que ser mayor a cero (0)',"error");
            }  
        }

        function totales()
        {
            $("#valor_guia").val(total);
        }

        function limpiar()
        {
            $("#nombre_remitente").val("");
            $("#nombre_destinatario").val("");
            $("#valor").val("");
            $("#num_guia").val("");
            elimina=$("#id_cabecera").val();
            $("#id_cabecera").find("option[value='"+elimina+"']").remove();
        }
        function eliminar(index)
        {
            total=total-subtotal[index];
            $("#valor_guia").val(total);
            $("#fila" + index).remove();
            var a= añadir[index].split('_');
            $('#id_cabecera').append('<option value="'+añadir[index]+'" selected="selected">'+a[1]+' '+a[2]+'</option>'); 
            document.ready = document.getElementById("id_cabecera").value = '0';
            if(index==0)
                $("#cargar").hide();
        }

        function onSelectCiudadChange()
        {
            var id_ciudad_origen = $(this).val();
            //alert(id_ciudad_origen);
            ciudad_origen=$("#ciudad_origen option:selected").text();
            $("#ciu_ori").val(ciudad_origen);

            //Ajax

            $.get('/bodega/manifiesto/create/'+id_ciudad_origen+'/ciudadDestino',function(data){
                //console.log(data);
                var html_select = '<option value=""></option>'
                $(".ciudad_destino").select2({
                    placeholder: 'Seleccione una ciudad de destino...',
                });
                for(var i=0; i<data.length; i++)
                    //console.log(data[i]);
                    html_select += '<option value="'+data[i].id_ciudad+'">'+data[i].descripcion+'</option>';
                //console.log(html_select);
                $("#ciudad_destino").html(html_select);
            });
        }
        function onSelectVehiculoChange()
        {
            var id_vehiculo = $(this).val();
            //alert(id_ciudad_origen);
            ciudad_destino=$("#ciudad_destino option:selected").text();
            $("#ciu_des").val(ciudad_destino);
            //Ajax

            $.get('/bodega/manifiesto/create/'+id_vehiculo+'/vehiculo',function(data){
                //console.log(data);
                var html_select = '<option value=""></option>';
                $(".vehiculo").select2({
                    placeholder: 'Seleccione un vehiculo...',
                });
                for(var i=0; i<data.length; i++)
                    //console.log(data[i]);
                    html_select += '<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
                //console.log(html_select);
                $("#vehiculo").html(html_select);
            });
        }

        function onSelectGuiaChange()
        {
            $("#guardar").show();
            var origen = $("#ciu_ori").val();
            var destino = $("#ciu_des").val();
            //alert(origen);
            //alert(destino);
            $.get('/bodega/manifiesto/create/'+origen+'/'+destino+'/Guia',function(data){
                //console.log(data);
                var html_select = '<option value=""></option>'
                $(".guia").select2({
                    placeholder: 'Seleccione una guia de remision...',
                });
                for(var i=0 ;i<data.length; i++)
                    //console.log(data[i]);
                    html_select += '<option value="'+data[i].id_cabecera+'_'+data[i].num_guia+'_'+data[i].nom_remitente+'_'+data[i].nom_destinatario+'_'+data[i].valor_guia+'">'+data[i].guia+'</option>';
                //console.log(html_select);
                $("#id_cabecera").html(html_select);
            });
        }

        function mostrarValoresGuia()
        {
            datosGuia=document.getElementById('id_cabecera').value.split('_');
            $("#nombre_remitente").val(datosGuia[2]);
            $("#nombre_destinatario").val(datosGuia[3]);
            $("#valor").val(datosGuia[4]);
            $("#num_guia").val(datosGuia[1]);   
            $("#id_guia").val(datosGuia[0]);
        }
    </script>
@endpush
@endsection