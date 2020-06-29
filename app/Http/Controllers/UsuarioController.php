<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UsuarioFormRequest;
use App\Http\Requests\EditUsuarioFormRequest;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class UsuarioController extends Controller

{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $usuarios=DB::table('users')->where('name','LIKE','%'.$query.'%')
            ->orderBy('id','desc')
            ->paginate(7);
            return view('seguridad.usuario.index',["usuarios"=>$usuarios,"searchText"=>$query]);
        }
    }

    public function create()
    {
        $personas=DB::table('persona as p')
        ->select('p.id_persona','p.nombre')
        ->where('p.tipo_persona','=','E')
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('users as u')
                  ->whereRaw('u.id_persona!=p.id_persona');
        })
        ->get();
        $roles=DB::table('rol')->where('estado','=','1')->get();
        return view("seguridad.usuario.create",["personas"=>$personas,"roles"=>$roles]);
    }

    public function store(UsuarioFormRequest $request)
    {
        $usuario=new User;
        $usuario->id_rol=$request->get('id_rol');
        $usuario->id_persona=$request->get('id_persona');
        $usuario->name=$request->get('name');
        $usuario->email=$request->get('email');
        $usuario->password=bcrypt($request->get('password'));
        $usuario->save();
        Alert::success('Registro Guardado', '');
        return Redirect::to('seguridad/usuario');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $roles=DB::table('rol')->where('estado','=','1')->get();
        return view("seguridad.usuario.edit",["roles"=>$roles,"usuario"=>User::findOrFail($id)]);
    }

    public function update(EditUsuarioFormRequest $request, $id)
    {
        $usuario=User::findOrFail($id);
        $usuario->id_rol=$request->get('id_rol');
        $usuario->email=$request->get('email');
        $usuario->password=bcrypt($request->get('password'));
        $usuario->update();
        Alert::success('Registro actualizado', '');
        return Redirect::to('seguridad/usuario');
    }

    public function destroy($id)
    {
        $usuario=User::findOrFail($id);
    	$usuario->estado='0';
        $usuario->update();
        Alert::success('Registro eliminado', '');
        return Redirect::to('seguridad/usuario');
    }
}