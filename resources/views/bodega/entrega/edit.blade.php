@extends ('layouts.admin')
@section ('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Entregar Guia: {{ $cabecera->num_guia }}</h3>
        <div class="form-group" >
                <a href="{{URL::action('EntregaController@index')}}"><button class="btn btn-danger">Cancelar</button></a>
        </div>
        @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{  $error }}</li>
                    @endforeach
                </ul>
            </div>			
        @endif
    </div>
</div>
<form method="POST" action="{{ url("bodega/entrega/{$cabecera->id_cabecera}") }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nombre_recibe">Nombre remitente</label>
        <input type="text" name="nombre_recibe" class="form-control" value="" placeholder="Nombre de la persona que recibe..." onKeyUp="this.value=this.value.toUpperCase();" required>
    </div>
    <div class="form-group">
            <label for="dni_recibe">DNI remitente</label>
            <input type="number" name="dni_recibe" class="form-control" value="" placeholder="Numero de documento de la persona que recibe..." onKeyUp="this.value=this.value.toUpperCase();" required>
        </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">Guardar</button>
    </div>
</form>
@endsection