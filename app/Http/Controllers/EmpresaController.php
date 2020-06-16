<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Empresa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\EmpresaFormRequest;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class EmpresaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
    	if ($request) {
    		$query=trim($request->get('searchText'));
    		$empresas=DB::table('empresa')
            ->where('razon_social','LIKE','%'.$query.'%')
    		->where('estado','=','1')
    		->orderBy('id_empresa','desc')
    		->paginate(7);
    		return view('mantenimiento.empresa.index',["empresas"=>$empresas,"searchText"=>$query]);
    	}
    }

    public function create()
    {
    	return view('mantenimiento.empresa.create');
    }

    public function store(EmpresaFormRequest $request)
    {
    	$empresa=new Empresa;
    	$empresa->razon_social=$request->get('razon_social');
    	$empresa->ruc=$request->get('ruc');
    	$empresa->direccion=$request->get('direccion');
    	$empresa->telefono=$request->get('telefono');
    	$empresa->email=$request->get('email');
    	$empresa->representante=$request->get('representante');
    	if (Input::hasFile('logo')) 
        {
            $file=Input::file('logo');
            $file->move(public_path().'/imagenes/empresa/',$file->getClientOriginalName());
            $empresa->logo=$file->getClientOriginalName();   
        }
    	$empresa->estado='1';
    	$empresa->save();
        Alert::success('Registro guardado', '');
    	return Redirect::to('mantenimiento/empresa');
    }

    public function show($id)
    {
    	return view("mantenimiento.empresa.show",["empresa"=>Empresa::findOrFail($id)]);
    }

    public function edit($id)
    {
    	return view("mantenimiento.empresa.edit",["empresa"=>Empresa::findOrFail($id)]);
    }

    public function update(EmpresaFormRequest $request,$id)
    {
        $empresa=Empresa::findOrFail($id);
        $empresa->razon_social=$request->get('razon_social');
    	$empresa->ruc=$request->get('ruc');
    	$empresa->direccion=$request->get('direccion');
    	$empresa->telefono=$request->get('telefono');
    	$empresa->email=$request->get('email');
    	$empresa->representante=$request->get('representante');
    	if (Input::hasFile('logo')) 
        {
            $file=Input::file('logo');
            $file->move(public_path().'/imagenes/empresa/',$file->getClientOriginalName());
            $empresa->logo=$file->getClientOriginalName();   
        }
        $empresa->update();
        Alert::success('Registro actualizado', '');
        return Redirect::to('mantenimiento/empresa');
    }

    public function destroy($id)
    {
    	$empresa=Empresa::findOrFail($id);
    	$empresa->estado='0';
    	$empresa->update();
        Alert::success('Registro eliminado', '');
    	return Redirect::to('mantenimiento/empresa');
    }
}