<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Formas_Pago;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Formas_PagoFormRequest;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class Formas_PagoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
    	if ($request) 
    	{
    		$query=trim($request->get('searchText'));
    		$formas_pagos=DB::table('formas_pago')
    			->where('descripcion','LIKE','%'.$query.'%')
    			->where('estado','=','1')
    			->orderBy('id_formas_pago','desc')
    			->paginate(7);
    		return view('mantenimiento.formas_pago.index',["formas_pagos"=>$formas_pagos,"searchText"=>$query]);
    	}
    }

    public function create()
    {
    	return view("mantenimiento.formas_pago.create");
    }

    public function store(Formas_PagoFormRequest $request)
    {
    	$formas_pago=New Formas_Pago;
    	$formas_pago->descripcion=$request->get('descripcion');
    	$formas_pago->estado='1';
    	$formas_pago->save();
        Alert :: success ( '¡Registro Guardado! ' ); 
    	return Redirect::to('mantenimiento/formas_pago');
    }

    public function show($id)
    {
    	return view("mantenimiento.formas_pago.show",["formas_pago"=>Formas_Pago::findOrFail($id)]);
    }

    public function edit($id)
    {
    	return view("mantenimiento.formas_pago.edit",["formas_pago"=>Formas_Pago::findOrFail($id)]);
    }

    public function update(Formas_PagoFormRequest $request,$id)
    {
    	$formas_pago=Formas_Pago::findOrFail($id);
    	$formas_pago->descripcion=$request->get('descripcion');
    	$formas_pago->update();
        Alert::success('Registro actualizado', '');
    	return Redirect::to('mantenimiento/formas_pago');
    }

    public function destroy($id)
    {
    	$formas_pago=Formas_Pago::findOrFail($id);
    	$formas_pago->estado='0';
    	$formas_pago->update();
        Alert::success('Registro eliminado', '');
    	return Redirect::to('mantenimiento/formas_pago');
    }
}