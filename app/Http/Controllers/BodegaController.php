<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class BodegaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $ciudades=DB::table('ciudad')->where('estado','=','1')->get();
        $vehiculos=DB::table('vehiculo')->where('estado','=','1')->get();
        $guias=DB::table('cabecera')->where('estatus_entrega','<>','E')->get();
        return view("bodega.vehiculo.index",["ciudades"=>$ciudades,"vehiculos"=>$vehiculos]);
    }
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function byCiudadOrigen($id)
    {
        return $ciudadesDestino=DB::table('ciudad')->where('id_ciudad','<>',$id)->where('estado','=','1')->get();
    }
    public function ByVehiculo($id)
    {
        return $vehiculos=DB::table('vehiculo')->select('id_vehiculo',DB::raw('CONCAT(marca,"/",MODELO,"/",PLACA)as nombre'))->where('estado','=','1')->get();
    }
    public function ByGuia($origen, $destino)
    {
        return $guias=DB::table('cabecera')->select('id_cabecera','nom_remitente','nom_destinatario','valor_guia')->where('ciudad_origen','=',$origen)->where('ciudad_destino','=',$destino)->where('estatus_entrega','=','B')->get();
    }

}

