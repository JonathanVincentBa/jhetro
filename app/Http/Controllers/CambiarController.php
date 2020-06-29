<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use \Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Cabecera;
use App\Detalle;

class CambiarController extends Controller
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
                    ['num_guia', 'LIKE', '%' . $query . '%'],
                    ['estado', '=', '1']
                ])
                ->orderBy('nom_remitente', 'asc')
                ->paginate(7);
            return view('editar_guia.cambiar.index', ["guias" => $guias, "searchText" => $query]);
        }
    }



    public function show($id)

    {

        $cabecera = DB::table('cabecera as c')

            ->join('motivo_traslado as mt', 'c.id_motivo_traslado', '=', 'mt.id_motivo_traslado')

            ->join('formas_pago as fp', 'c.id_forma_pago', '=', 'fp.id_formas_pago')

            ->select('c.ciudad_origen', 'c.ciudad_destino', 'c.nom_remitente', 'c.dni_remitente', 'c.direccion_remitente', 'c.fono_remitente', 'c.nom_destinatario', 'c.dni_destinatario', 'c.direccion_destinatario', 'c.fono_destinatario', 'c.num_guia', 'c.fecha_emision', 'c.guia_rem_cliente', 'c.factura_cliente', 'c.flete', 'c.recargo', 'c.valor_guia', 'c.prima', 'mt.descripcion as motivo_traslado', 'fp.descripcion as forma_pago', 'nota')

            ->where('c.id_cabecera', '=', $id)

            ->first();



        $detalles = DB::table('detalle')

            ->where('id_cabecera', '=', $id)

            ->get();



        return view("editar_guia.recargo.show", ["cabecera" => $cabecera, "detalles" => $detalles]);
    }





    public function edit(Request $request, $id)

    {

        $detalles = DB::table('detalle')

            ->where('id_cabecera', '=', $id)

            ->get();

        $forma_pago = DB::table('formas_pago')->get();

        $ciudades = DB::table('ciudad')->get();

        $sucursales = DB::table('sucursal as s')

            ->join('ciudad as c', 'c.id_ciudad', '=', 's.id_ciudad')

            ->select('c.descripcion')

            ->get();

        $personas = DB::table('persona')->get();

        return view("editar_guia.cambiar.edit", ["cabecera" => Cabecera::findOrFail($id), "detalles" => $detalles, "forma_pago" => $forma_pago, "ciudades" => $ciudades, "sucursales" => $sucursales, "personas" => $personas]);
    }



    public function update(Request $request, $id)

    {

        try {

            DB::beginTransaction();

            $cabecera = Cabecera::findOrFail($id);

            $cabecera->recargo = $request->get('recargo');

            $cabecera->id_forma_pago = $request->get('id_formas_pago');

            $cabecera->ciudad_origen = $request->get('ciudad_origen');

            $cabecera->ciudad_destino = $request->get('ciudad_destino');

            $cabecera->nom_remitente = $request->get('nom_remitente');

            $cabecera->nota = $request->get('nota');

            $cabecera->num_guia = $request->get('num_guia');

            $cabecera->flete = $request->get('flete');

            $cabecera->prima = $request->get('prima');

            $cabecera->valor_guia = $request->get('valor_guia');

            if ($request->get('id_formas_pago') == 1) {

                $cabecera->estatus_cobro = 'Cancelado';
            } else {

                $cabecera->estatus_cobro = 'Pendiente';
            }

            $cabecera->update();



            $id_detalle = $request->get('id_detalle');

            $descripcion = $request->get('descripcion');

            $cantidad = $request->get('cantidad');

            $v_unitario = $request->get('v_unitario');

            $v_parcial = $request->get('v_parcial');

            $cont = 0;

            while ($cont < count($descripcion)) {

                $detalle = Detalle::findOrFail($id_detalle[$cont]);

                $detalle->descripcion = $descripcion[$cont];

                $detalle->cantidad = $cantidad[$cont];

                $detalle->v_unitario = $v_unitario[$cont];

                $detalle->v_parcial = $v_parcial[$cont];

                $detalle->update();

                $cont = $cont + 1;
            }

            DB::commit();

            Alert::success('Registro actualizado', '');
        } catch (Exception $e) {

            DB::rollBack();

            Alert::success('No se pudo guardar el registro', '');
        }

        return Redirect::to('editar_guia/cambiar');
    }
}
