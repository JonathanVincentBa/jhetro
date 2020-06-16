<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Ciudad;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CiudadFormRequest;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class CiudadController extends Controller
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
            $ciudades=DB::table('ciudad')
                ->where('descripcion','LIKE','%'.$query.'%')
                ->where('estado','=','1')
                ->orderBy('id_ciudad','desc')
                ->paginate(7);
            return view('mantenimiento.ciudad.index',["ciudades"=>$ciudades,"searchText"=>$query]);
        }
    }
    public function create()
    {
    	return view("mantenimiento.ciudad.create");
    }
    public function store(CiudadFormRequest $request)
    {
    	$ciudad=New Ciudad;
    	$ciudad->descripcion=$request->get('descripcion');
    	$ciudad->estado='1';
    	$ciudad->save();
        Alert :: success ( '¡Registro Guardado! ' ); 
    	return Redirect::to('mantenimiento/ciudad');
    }

    public function show($id)
    {
    	return view("mantenimiento.ciudad.show",["ciudad"=>Ciudad::findOrFail($id)]);
    }

    public function edit($id)
    {
    	return view("mantenimiento.ciudad.edit",["ciudad"=>Ciudad::findOrFail($id)]);
    }

    public function update(CiudadFormRequest $request,$id)
    {
    	$ciudad=Ciudad::findOrFail($id);
    	$ciudad->descripcion=$request->get('descripcion');
    	$ciudad->update();
        Alert::success('Registro actualizado', '');
    	return Redirect::to('mantenimiento/ciudad');
    }

    public function destroy($id)
    {
    	$ciudad=Ciudad::findOrFail($id);
    	$ciudad->estado='0';
    	$ciudad->update();
        Alert::success('Registro eliminado', '');
    	return Redirect::to('mantenimiento/ciudad');
    }

}

