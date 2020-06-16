<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use\Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Cabecera;

class EditarGuiaClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request) 
            {
                $query = trim($request->get('searchText'));
                $guias = DB::table('cabecera')
                    ->where([['nom_remitente', 'LIKE', '%' . $query . '%'],
                             ['estatus_cobro','=','Pendiente'],
                             ['estado','=','1']])
                    ->orderBy('nom_remitente', 'asc')
                    ->paginate(7);
            return view('editar_guia.editarCliente.index', ["guias" => $guias, "searchText" => $query]);
        }
    }
    public function edit(Request $request,$id)
    {
        $nombre = DB::table('cabecera')
        ->select('nom_remitente')
        ->where([
                ['nom_remitente','=',$id],
                ['estatus_cobro','=','Pendiente'],
                ['estado','=','1']])
        ->groupBy('nom_remitente')
        ->first();
        $cabecera = DB::table('cabecera')
        ->where([
                ['nom_remitente','=',$id],
                ['estatus_cobro','=','Pendiente'],
                ['estado','=','1']])
        ->orderBy('num_guia','asc')
        ->get();
        if ($nombre=='null') {
            return view("editar_guia.editarCliente.edit",["nombre"=>$nombre,"cabecera"=>$cabecera]);
        }
        else{
            Alert::error('Este cliente no tiene registro', '');
            return Redirect::to('editar_guia/editarCliente');
        }
    }

    public function update(Request $request, $id)
    {
        $id_cabecera= $request->get('id_cabecera');
        if ($id_cabecera == null) {
            Alert::error('No selecciono ninguna guia', '¡Oops! ');
            return Redirect::to('editar_guia/editarCliente');
        }
        else
        {
            dd($id_cabecera);
            $cont = 0;
            while ($cont < count($id_cabecera)) {
                $cabecera = Cabecera::findOrFail($id_cabecera[$cont]);
                $cabecera->estatus_cobro = 'Cancelado';
                $cabecera->id_users_update= Auth::user()->id;
                $cabecera->update();
                $cont = $cont + 1;
            }
            Alert::success('Registro actualizado', '');
            return Redirect::to('editar_guia/editarCliente');
        }
    }
}