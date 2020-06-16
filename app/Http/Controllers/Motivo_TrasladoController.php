<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Motivo_Traslado;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Motivo_TrasladoFormRequest;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class Motivo_TrasladoController extends Controller
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
    		$motivos_traslados=DB::table('motivo_traslado')
    			->where('descripcion','LIKE','%'.$query.'%')
    			->where('estado','=','1')
    			->orderBy('id_motivo_traslado','desc')
    			->paginate(7);
    		return view('mantenimiento.motivo_traslado.index',["motivos_traslados"=>$motivos_traslados,"searchText"=>$query]);
    	}
    }

    public function create()
    {
    	return view("mantenimiento.motivo_traslado.create");
    }

    public function store(Motivo_TrasladoFormRequest $request)
    {
    	$motivo_traslado=New Motivo_Traslado;
    	$motivo_traslado->descripcion=$request->get('descripcion');
    	$motivo_traslado->estado='1';
    	$motivo_traslado->save();
        Alert :: success ( '¡Registro Guardado! ' ); 
    	return Redirect::to('mantenimiento/motivo_traslado');
    }

    public function show($id)
    {
    	return view("mantenimiento.motivo_traslado.show",["motivo_traslado"=>Motivo_Traslado::findOrFail($id)]);
    }

    public function edit($id)
    {
    	return view("mantenimiento.motivo_traslado.edit",["motivo_traslado"=>Motivo_Traslado::findOrFail($id)]);
    }

    public function update(Motivo_TrasladoFormRequest $request,$id)
    {
    	$motivo_traslado=Motivo_Traslado::findOrFail($id);
    	$motivo_traslado->descripcion=$request->get('descripcion');
    	$motivo_traslado->update();
        Alert::success('Registro actualizado', '');
    	return Redirect::to('mantenimiento/motivo_traslado');
    }

    public function destroy($id)
    {
    	$motivo_traslado=Motivo_Traslado::findOrFail($id);
    	$motivo_traslado->estado='0';
    	$motivo_traslado->update();
        Alert::success('Registro eliminado', '');
    	return Redirect::to('mantenimiento/motivo_traslado');
    }
}