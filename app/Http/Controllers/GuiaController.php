<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Cabecera;
use App\Detalle;
use\Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use\App\Http\Requests\GuiaFormRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Fpdf;

class GuiaController extends Controller
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
                ->where([
                        ['num_guia', 'LIKE', '%' . $query . '%'],
                        ['estado','=','1']])
                ->orderBy('id_cabecera', 'desc')
                ->paginate(10);
            return view('ventas.guia.index', ["guias" => $guias, "searchText" => $query]);
        }

        if ($request) 
        {
            $query = trim($request->get('searchText'));
            $guias = DB::table('cabecera')
                ->where([['num_guia', 'LIKE', '%' . $query . '%'],
                    ['ciudad_origen','=',session('sucursal')],
                    ['estatus_cobro','=','Pendiente'],
                    ['estado','=','1']])
                ->orderBy('id_cabecera', 'desc')
                ->paginate(7);
            return view('ventas.guia.index', ["guias" => $guias, "searchText" => $query]);
        }

    }

    public function create()
    {
        $sucursales = DB::table('sucursal as s')
        ->join('ciudad as c','s.id_ciudad','=','c.id_ciudad')
        ->select('s.id_sucursal','c.descripcion as ciudad')
        ->where('s.estado', '=', '1')
        ->get();
        $motivos_traslado = DB::table('motivo_traslado')->where('estado', '=', '1')->get();
        $formas_pagos = DB::table('formas_pago')->where('estado', '=', '1')->get();
        $ciudades = DB::table('ciudad')->where('estado', '=', '1')->get();
        $personas = DB::table('persona as p')
        ->select('p.id_persona','p.nombre','p.num_dni','p.direccion','p.telefono')
        ->orderby('nombre','asc')
        ->where('p.estado', '=', '1')->get();
        return view('ventas.guia.create', ["sucursales" => $sucursales, "motivos_traslado" => $motivos_traslado, "formas_pagos" => $formas_pagos, "ciudades" => $ciudades,"personas"=>$personas]);
    }

    public function store(GuiaFormRequest $request)
    {
        
        if (Auth::check()) {
            try
            {
                DB::beginTransaction();
                $cabecera = new Cabecera;
                $cabecera->id_sucursal = session('sucursal');
                $cabecera->id_motivo_traslado = $request->get('id_motivo_traslado');
                $cabecera->id_forma_pago = $request->get('id_forma_pago');
                $cabecera->id_persona= $request->get('id_persona');
                $cabecera->id_users = Auth::user()->id;
                $cabecera->ciudad_origen = $request->get('ciu_ori');
                $cabecera->ciudad_destino = $request->get('ciu_des');
                $cabecera->nom_remitente = $request->get('nom_remitente');
                $cabecera->dni_remitente = $request->get('dni_remitente');
                $cabecera->direccion_remitente = $request->get('direccion_remitente');
                $cabecera->fono_remitente = $request->get('fono_remitente');
                $cabecera->nom_destinatario = $request->get('nom_destinatario');
                $cabecera->dni_destinatario = $request->get('dni_destinatario');
                $cabecera->direccion_destinatario = $request->get('direccion_destinatario');
                $cabecera->fono_destinatario = $request->get('fono_destinatario');
                $cabecera->num_guia = $request->get('num_guia');
                if($request->get('num_guia_trans')==0)
                {
                    $cabecera->num_guia_trans = "0";
                }
                else
                {
                    $cabecera->num_guia_trans = $request->get('num_guia_trans');
                }
                
                $mytime = Carbon::now('America/Guayaquil');
                $cabecera->fecha_emision = $mytime->toDateTimeString();
                $cabecera->guia_rem_cliente = $request->get('guia_rem_cliente');
                $cabecera->factura_cliente = $request->get('factura_cliente');
                $cabecera->flete = $request->get('flete');
                $cabecera->valor_guia = $request->get('valor_guia');
                $cabecera->prima = $request->get('prima');
                if ($request->get('id_forma_pago') == 1) {
                    //$cabecera->id_users_update = Auth::user()->id;
                    $cabecera->estatus_cobro ='Cancelado';
                }
                else
                {
                    $cabecera->estatus_cobro ='Pendiente';
                }
                $cabecera->estatus_entrega ='R';
                $cabecera->recargo= "0.00";
                $cabecera->estado = '1';
                $cabecera->save();
                $descripcion = $request->get('descripcion');
                $cantidad = $request->get('cantidad');
                $v_unitario = $request->get('v_unitario');
                $v_parcial = $request->get('v_parcial');
                $cont = 0;
                while ($cont < count($descripcion)) {
                    $detalle = new Detalle;
                    $detalle->id_cabecera = $cabecera->id_cabecera;
                    $detalle->descripcion = $descripcion[$cont];
                    $detalle->cantidad = $cantidad[$cont];
                    $detalle->v_unitario = $v_unitario[$cont];
                    $detalle->v_parcial = $v_parcial[$cont];
                    $detalle->save();
                    $cont = $cont + 1;
                }
                DB::commit();
                Alert::success('¡Registro Guardado! ');
            } catch (Exception $e) {
                DB::rollBack();
                Alert::success('No se pudo guardar el registro', '');
            }
            return Redirect::to('ventas/guia');
        }
    }

    public function show($id)
    {
        $cabecera=DB::table('cabecera as c')
           ->join('motivo_traslado as mt','c.id_motivo_traslado','=','mt.id_motivo_traslado')
            ->join('formas_pago as fp','c.id_forma_pago','=','fp.id_formas_pago')
            ->select('c.ciudad_origen','c.ciudad_destino','c.nom_remitente','c.dni_remitente','c.direccion_remitente','c.fono_remitente','c.nom_destinatario','c.dni_destinatario','c.direccion_destinatario','c.fono_destinatario','c.num_guia','c.num_guia_trans','c.fecha_emision','c.guia_rem_cliente','c.factura_cliente','c.flete','c.valor_guia','c.prima','mt.descripcion as motivo_traslado','fp.descripcion as forma_pago')
            ->where('c.id_cabecera','=',$id)
            ->first();
         $detalles=DB::table('detalle')
            ->where('id_cabecera','=',$id)
            ->get();
        return view("ventas.guia.show",["cabecera"=>$cabecera,"detalles"=>$detalles]);
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $cabecera=Cabecera::findOrFail($id);
        $cabecera->estado='0';
        $cabecera->update();
        Alert::success('Registro cancelado', '');
        return Redirect::to('ventas/guia');
    }

    public function reporteP($id)
    {
        //Obtengo los datos
        $cabecera=DB::table('cabecera as c')
            ->select('c.fecha_emision','c.guia_rem_cliente','c.factura_cliente','c.ciudad_origen','c.ciudad_destino','c.id_motivo_traslado','c.nom_remitente','c.nom_destinatario','c.direccion_remitente','c.direccion_destinatario','c.fono_remitente','c.dni_remitente','c.fono_destinatario','c.dni_remitente','c.flete','c.prima','c.valor_guia')
            ->where('c.id_cabecera','=',$id)
            ->first();
        $detalles=DB::table('detalle as d')
            ->select('d.cantidad','d.descripcion','d.v_unitario','d.v_parcial')
            ->where('d.id_cabecera','=',$id)
            ->get();
            $pdf = new Fpdf('L', 'mm', 'A4');
            $pdf::AddPage();
            $pdf::SetFont('Arial','B',12);
            //Inicio del reporte
            $pdf::SetXY(10,20);
            $pdf::cell(0,0,utf8_decode($cabecera->fecha_emision));
            $pdf::SetFont('Arial','B',2);
            $pdf::SetXY(10,30);
            $pdf::cell(0,0,utf8_decode($cabecera->guia_rem_cliente));
            $pdf::SetFont('Arial','B',18);
            $pdf::SetXY(50,30);
            $pdf::cell(0,0,utf8_decode($cabecera->factura_cliente));
            $pdf::SetFont('Arial','B',12);
            $pdf::SetXY(90,30);
            $pdf::cell(0,0,utf8_decode($cabecera->ciudad_origen));
            $pdf::SetFont('Arial','B',12);
            $pdf::SetXY(130,30);
            $pdf::cell(0,0,utf8_decode($cabecera->ciudad_destino));
            $pdf::SetFont('Arial','B',12);
            $pdf::SetXY(185,30);
            $pdf::cell(0,0,utf8_decode($cabecera->id_motivo_traslado));
            $pdf::SetFont('Arial','B',12);
            $pdf::SetXY(10,40);
            $pdf::cell(0,0,utf8_decode($cabecera->nom_remitente));
            $pdf::SetFont('Arial','B',12);
            $pdf::SetXY(100,40);
            $pdf::cell(0,0,utf8_decode($cabecera->nom_destinatario));
            $pdf::SetFont('Arial','B',12);
            $pdf::SetXY(10,50);
            $pdf::cell(0,0,utf8_decode($cabecera->direccion_remitente));
            $pdf::SetFont('Arial','B',12);
            $pdf::SetXY(100,50);
            $pdf::cell(0,0,utf8_decode($cabecera->direccion_destinatario));
            $pdf::SetFont('Arial','B',12);
            $pdf::SetXY(10,60);
            $pdf::cell(0,0,utf8_decode($cabecera->fono_remitente));
            $pdf::SetFont('Arial','B',12);
            $pdf::SetXY(50,60);
            $pdf::cell(0,0,utf8_decode($cabecera->dni_remitente));
            $pdf::SetFont('Arial','B',12);
            $pdf::SetXY(100,60);
            $pdf::cell(0,0,utf8_decode($cabecera->fono_destinatario));
            $pdf::SetFont('Arial','B',12);
            $pdf::SetXY(140,60);
            $pdf::cell(0,0,utf8_decode($cabecera->dni_remitente));
            $pdf::SetFont('Arial','B',12);
            $pdf::SetXY(180,130);
            $pdf::cell(0,0,utf8_decode($cabecera->flete));
            $pdf::SetFont('Arial','B',12);
            $pdf::SetXY(180,150);
            $pdf::cell(0,0,utf8_decode($cabecera->valor_guia));
            $pdf::SetFont('Arial','B',12);
            $pdf::SetXY(180,160);
            $pdf::cell(0,0,utf8_decode($cabecera->prima));

            //Mostrar detalles

            $y=70;
            foreach ($detalles as $det) 
            {
                $pdf::SetXY(10,$y);
                $pdf::cell(0,0,utf8_decode($det->cantidad));
                $pdf::SetXY(25,$y);
                $pdf::cell(0,0,utf8_decode($det->descripcion));
                $pdf::SetXY(120,$y);
                $pdf::cell(0,0,utf8_decode($det->v_unitario));
                $pdf::SetXY(150,$y);
                $pdf::cell(0,0,utf8_decode($det->v_parcial));
                $y=$y+10;
            }
            $pdf::Output();
            exit;
    }
}