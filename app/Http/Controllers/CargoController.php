<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Cargo;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CargoFormRequest;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
class CargoController extends Controller

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
    		$cargos=DB::table('cargo')
    			->where('descripcion','LIKE','%'.$query.'%')
    			->where('estado','=','1')
    			->orderBy('id_cargo','desc')
    			->paginate(7);
    		return view('mantenimiento.cargo.index',["cargos"=>$cargos,"searchText"=>$query]);
    	}
    }
    public function create()
    {
    	return view("mantenimiento.cargo.create");
    }

    public function store(CargoFormRequest $request)
    {
        $cargo=new Cargo;
        $cargo->descripcion=$request->get('descripcion');
        $cargo->estado='1';
        $cargo->save();
        Alert :: success ( '¡Registro Guardado! ' );  
        return Redirect::to('mantenimiento/cargo');
    }
    public function show($id)
    {
    	return view("mantenimiento.cargo.show",["cargo"=>Cargo::findOrFail($id)]);
    }

    public function edit($id)
    {
        $cargo=Cargo::findOrFail($id);
        
    	return view("mantenimiento.cargo.edit",["cargo"=>$cargo]);
    }
    public function update(CargoFormRequest $request,$id)
    {
        
        $cargo=Cargo::findOrFail($id);
        
    	$cargo->descripcion=$request->get('descripcion');
        $cargo->update();
        
        Alert::success('Registro actualizado', '');
    	return Redirect::to('mantenimiento/cargo');
    }
    public function destroy($id)
    {
    	$cargo=Cargo::findOrFail($id);
    	$cargo->estado='0';
    	$cargo->update();
        Alert::success('Registro eliminado', '');
    	return Redirect::to('mantenimiento/cargo');
    }
}