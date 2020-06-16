<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Sucursal;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\SucursalFormRequest;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class SucursalController extends Controller
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
    		$sucursales=DB::table('sucursal as s')
    		->join('ciudad as c','s.id_ciudad','=','c.id_ciudad')
    		->select('s.id_sucursal','c.descripcion as ciudad','s.direccion','s.telefono','s.email','s.estado')
    		->where([
                        ['s.direccion','LIKE','%'.$query.'%'],
                        ['s.estado','=','1']])
			->where([
					['c.descripcion','LIKE','%'.$query.'%'],
					['c.estado','=','1']])        
    		->orderby('s.id_sucursal','desc')
    		->paginate(7);
    		return view('mantenimiento.sucursal.index',["sucursales"=>$sucursales,"searchText"=>$query]);
    	}
    }

	public function create()
    {
    	$empresas=DB::table('empresa')->where('estado','=','1')->get();
    	$ciudades=DB::table('ciudad')->where('estado','=','1')->get();
    	return view('mantenimiento.sucursal.create',["empresas"=>$empresas,"ciudades"=>$ciudades]);
    }

	public function store(SucursalFormRequest $request)
    {
    	$sucursal=new Sucursal;
    	$sucursal->id_empresa=$request->get('id_empresa');
    	$sucursal->id_ciudad=$request->get('id_ciudad');
    	$sucursal->direccion=$request->get('direccion');
    	$sucursal->telefono=$request->get('telefono');
    	$sucursal->email=$request->get('email');
    	$sucursal->estado='1';
    	$sucursal->save();
        Alert :: success ( '¡Registro Guardado! ' ); 
    	return Redirect::to('mantenimiento/sucursal');
    }

    public function show($id)
    {
		return view('mantenimiento.sucursal.show',["sucursal"=>Sucursal::findOrFail($id)]);
    }

    public function edit($id)
    {
    	$sucursal=Sucursal::findOrFail($id);
    	$empresas=DB::table('empresa')->where('estado','=','1')->get();
    	$ciudades=DB::table('ciudad')->where('estado','=','1')->get();
    	return view("mantenimiento.sucursal.edit",["sucursal"=>$sucursal,"empresas"=>$empresas,"ciudades"=>$ciudades]);
    }

    public function update(SucursalFormRequest $request,$id)
    {
    	$sucursal=Sucursal::findOrFail($id);
    	$sucursal->id_empresa=$request->get('id_empresa');
    	$sucursal->id_ciudad=$request->get('id_ciudad');
    	$sucursal->direccion=$request->get('direccion');
    	$sucursal->telefono=$request->get('telefono');
    	$sucursal->email=$request->get('email');
    	$sucursal->update();
        Alert::success('Registro actualizado', '');
    	return Redirect::to('mantenimiento/sucursal');
    }

    public function destroy($id)
    {
    	$sucursal=Sucursal::findOrFail($id);
    	$sucursal->estado='0';
    	$sucursal->update();
        Alert::success('Registro eliminado', '');
    	return Redirect::to('mantenimiento/sucursal');
    }
}