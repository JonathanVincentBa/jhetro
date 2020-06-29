<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Cabecera;
use\Illuminate\Support\Facades\Redirect;
use\App\Http\Requests\GuiaFormRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class BuscarGuiaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('searchText'));
            $guias = DB::table('cabecera')
                ->where([
                        ['nom_remitente', 'LIKE', '%' . $query . '%'],
                        ['estado','=','1']])
                ->orwhere([
                        ['nom_destinatario', 'LIKE', '%' . $query . '%'],
                        ['estado','=','1']])
                ->orwhere([
                        ['num_guia', 'LIKE', '%' . $query . '%'],
                        ['estado','=','1']])
                ->orderBy('id_cabecera', 'desc')
                ->paginate(10);
            return view("buscar_guia.cliente.index", ["guias" => $guias, "searchText" => $query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cabecera=DB::table('cabecera as c')
           ->join('motivo_traslado as mt','c.id_motivo_traslado','=','mt.id_motivo_traslado')
            ->join('formas_pago as fp','c.id_forma_pago','=','fp.id_formas_pago')
            ->select('c.ciudad_origen','c.ciudad_destino','c.nom_remitente','c.dni_remitente','c.direccion_remitente','c.fono_remitente','c.nom_destinatario','c.dni_destinatario','c.direccion_destinatario','c.fono_destinatario','c.num_guia','c.fecha_emision','c.guia_rem_cliente','c.factura_cliente','c.flete','c.recargo','c.valor_guia','c.prima','mt.descripcion as motivo_traslado','fp.descripcion as forma_pago','c.estatus_entrega','c.nombre_recibe','c.dni_recibe','c.fecha_recepcion')
            ->where('c.id_cabecera','=',$id)
            ->first();
         $detalles=DB::table('detalle')
            ->where('id_cabecera','=',$id)
            ->get();
        return view("buscar_guia.cliente.show",["cabecera"=>$cabecera,"detalles"=>$detalles]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

