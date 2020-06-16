<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Cabecera;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\GuiaFormRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class EntregaController extends Controller
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
                ->where('num_guia', 'LIKE', '%' . $query . '%')
                ->where('estatus_entrega','=','R')
                ->orderBy('id_cabecera', 'desc')
                ->paginate(7);
            return view("bodega.entrega.index",["guias"=>$guias,"searchText"=>$query]);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $cabecera=DB::table('cabecera as c')
           ->join('motivo_traslado as mt','c.id_motivo_traslado','=','mt.id_motivo_traslado')
            ->join('formas_pago as fp','c.id_forma_pago','=','fp.id_formas_pago')
            ->select('c.ciudad_origen','c.ciudad_destino','c.nom_remitente','c.dni_remitente','c.direccion_remitente','c.fono_remitente','c.nom_destinatario','c.dni_destinatario','c.direccion_destinatario','c.fono_destinatario','c.num_guia','c.fecha_emision','c.guia_rem_cliente','c.factura_cliente','c.flete','c.recargo','c.valor_guia','c.prima','mt.descripcion as motivo_traslado','fp.descripcion as forma_pago')
            ->where('c.id_cabecera','=',$id)
            ->first();
         $detalles=DB::table('detalle')
            ->where('id_cabecera','=',$id)
            ->get();
        return view("bodega.entrega.show",["cabecera"=>$cabecera,"detalles"=>$detalles]);
    }

    public function edit($id)
    {
        return view("bodega.entrega.edit",["cabecera"=>Cabecera::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $cabecera=Cabecera::findOrFail($id);
        $cabecera->nombre_recibe=$request->get('nombre_recibe');
        $cabecera->dni_recibe=$request->get('dni_recibe');
        $mytime = Carbon::now('America/Guayaquil');
        $cabecera->fecha_recepcion = $mytime->toDateTimeString();
        $cabecera->estatus_entrega='E';
        $cabecera->update();
        Alert::success('Registro actualizado', '');
        return Redirect::to('bodega/entrega');
    }

    public function destroy($id)
    {
        //
    }
}