<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Persona;
use\Illuminate\Support\Facades\Redirect;
use\App\Http\Requests\PersonaFormRequest;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade as PDF;

class EmpleadoController extends Controller
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
    			->join('cargo as c', 'p.id_cargo','=','c.id_cargo')
                ->select('p.id_persona','e.razon_social as empresa','c.descripcion as cargo','p.tipo_persona','p.nombre','p.direccion','p.tipo_dni','p.num_dni','p.telefono','p.estado')
                ->where([
                        ['p.nombre','LIKE','%'.$query.'%'],
                        ['p.tipo_persona','=','E'],
                        ['p.estado','=','1']])
                ->orderBy('p.id_persona','asc')
    			->paginate(7);
    		return view('seguridad.empleado.index',["personas"=>$personas,"searchText"=>$query]);
    	}
    }

    public function create()
    {
    	$empresas=DB::table('empresa')->where('estado','=','1')->get();
    	$cargos=DB::table('cargo')->where('estado','=','1')->get();
       	return view('seguridad.empleado.create',compact('empresas','cargos'));
    }

    public function store(PersonaFormRequest $request)
    {
            $persona=new Persona;
            $persona->id_empresa='1';
            $persona->id_cargo=$request->get('id_cargo');
            $persona->tipo_persona='E';
            $persona->nombre=$request->get('nombre');
            $persona->direccion=$request->get('direccion');
            $persona->tipo_dni=$request->get('tipo_dni');
            $persona->num_dni=$request->get('num_dni');
            $persona->telefono=$request->get('telefono');
            $persona->estado='1';
            $persona->save();
            Alert::success('¡Registro Guardado!');
            return Redirect::to('seguridad/empleado');
    }

    public function show($id)
    {
    	return view("seguridad.empleado.show",["persona"=>Persona::findOrFail($id)]);
    }

    public function edit($id)
    {
    	$persona=Persona::findOrFail($id);
    	$empresas=DB::table('empresa')->where('estado','=','1')->get();
    	$cargos=DB::table('cargo')->where('estado','=','1')->get();
    	return view("seguridad.empleado.edit",compact('persona','empresas','cargos'));
    }

    public function update(PersonaFormRequest $request,$id)
    {
        $persona= Persona::findOrFail($id);
        $persona->id_cargo=$request->get('id_cargo');
        $persona->tipo_persona='E';
        $persona->nombre=$request->get('nombre');
        $persona->direccion=$request->get('direccion');
        $persona->tipo_dni=$request->get('tipo_dni');
        $persona->num_dni=$request->get('num_dni');
        $persona->telefono=$request->get('telefono');
        $persona->update();
        
        Alert :: success ( '¡Registro Guardado! ' );
        return Redirect::to('seguridad/empleado');
    }

    public function destroy($id)
    {
    	$persona=Persona::findOrFail($id);
    	$persona->estado='0';
    	$persona->update();
        Alert::success('Registro eliminado', '');
    	return Redirect::to('seguridad/empleado');
    }

    public function reporteEmpleados()
    {
        //Obtener los registros
        $empleados=DB::table('persona as p')
            ->join('cargo as c','c.id_cargo','=','p.id_cargo')
            ->select('p.num_dni','p.nombre','p.telefono','c.descripcion as cargo')
            ->where('p.tipo_persona','=','E')
            ->orderby('nombre','asc')
            ->get();
        $pdf = PDF::loadView('seguridad.empleado.reporte',['empleados'=>$empleados]);
        return $pdf->download('empleados.pdf');
    }
}