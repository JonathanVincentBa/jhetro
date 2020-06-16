@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
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
<form method="POST"  action="" class="needs-validation">
    @csrf
    <div class="card login-card">
        <div class="row no-gutters">
            <div class="col-md-5">
                <img src="adminlte/imagenes/login.jpg" alt="login" class="login-card-img">
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <div class="brand-wrapper">
                        <img src="adminlte/imagenes/logo.svg" alt="logo" class="logo">
                    </div>
                    <p class="login-card-description">Seleccione su sucursal</p>
                    <div class="panel-body">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" >
                            <div class="form-group">
                                <select name="select" id="select" required class="form-control selectpicker" title="Seleccione una sucursal...">
                                    <option ></option>
                                    @foreach ($sucursales as $suc)
                                    {
                                        <option value="{{$suc->ciudad}}">{{$suc->ciudad}}</option>
                                    }
                                    @endforeach
                                </select>
                                <div class="col-md-8 offset-md-2">
                                    <button class="btn btn-block login-btn mb-4" id="ver">Seleccionar</button>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</form>   

@endsection
