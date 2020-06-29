<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Persona;
use App\User;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PersonaFormRequest;
use App\Http\Requests\DireccionFormRequest;
use App\Http\Requests\UsuarioFormRequest;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade as PDF;

class ClienteController extends Controller

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
    		$personas=DB::table('persona as p')
    			->join('empresa as e', 'p.id_empresa','=','e.id_empresa')
    			->select('p.id_persona','e.razon_social as empresa','p.tipo_persona','p.nombre','p.direccion','p.tipo_dni','p.num_dni','p.telefono','p.estado')
    			->where([
                        ['p.nombre','LIKE','%'.$query.'%'],
                        ['p.tipo_persona','=','C'],
                        ['p.estado','=','1']])
    			->orderBy('p.id_persona','desc')
                ->paginate(7);
                return view('personas.cliente.index',["personas"=>$personas,"searchText"=>$query]);
        }
    }

    public function create()
    {
        return view('personas.cliente.create');
    }

   public function store(PersonaFormRequest $request)
    {
        $persona=new Persona;
        $persona->id_empresa='1';
        $persona->id_cargo='1';
        $persona->tipo_persona='C';
        $persona->nombre=$request->get('nombre');
        $persona->direccion=$request->get('direccion');
        $persona->tipo_dni=$request->get('tipo_dni');
        $persona->num_dni=$request->get('num_dni');
        $persona->telefono=$request->get('telefono');
        $persona->estado='1';
        $persona->save();
        
        Alert :: success ( '¡Registro Guardado! ' ); 
        return Redirect::to('personas/cliente');
    }
    public function show($id)
    {
    	return view("personas.cliente.show",["persona"=>Persona::findOrFail($id)]);
    }

    public function edit($id)
    {
    	$persona=Persona::findOrFail($id);
        
    	return view("personas.cliente.edit",["persona"=>$persona]);
    }

    
    public function update(Request $request,$id)
    {
    	$persona= Persona::findOrFail($id);
        $persona->tipo_persona='C';
        $persona->nombre=$request->get('nombre');
        $persona->direccion=$request->get('direccion');
        $persona->tipo_dni=$request->get('tipo_dni');
        $persona->num_dni=$request->get('num_dni');
        $persona->telefono=$request->get('telefono');
        $persona->update();
        Alert::success('Registro actualizado', '');
        return Redirect::to('personas/cliente');
    }

    

    public function destroy($id)
    {
    	$persona=Persona::findOrFail($id);
    	$persona->estado='0';
    	$persona->update();
        Alert::success('Registro eliminado', '');
    	return Redirect::to('personas/cliente');
    }

    public function byCiudad($id)
    {
        return DB::table('direccion as d')
        ->join('persona as p','p.id_persona','=','d.id_persona')
        ->where('d.id_ciudad','=',$id)
        ->select('d.id_persona','p.nombre','p.num_dni','d.descripcion','p.telefono')
        ->get();
    }

     public function reporte()
    {
        
        //Obtener los registros
        $clientes=DB::table('persona as p')
            ->select('p.num_dni','p.nombre','p.direccion','p.telefono')
            ->where('p.tipo_persona','=','C')
            ->orderby('nombre','asc')
            ->get();
            
        $pdf = PDF::loadView('personas.cliente.reporte',['clientes'=>$clientes]);
        return $pdf->download('Clientes.pdf');
    }
}

