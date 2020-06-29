<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClienteXFacturarExport;

class ClientesReporteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $personas=DB::table('cabecera')
            ->select('nom_remitente')
            ->groupby('nom_remitente')
            ->orderby('nom_remitente','asc')
            ->get();
        $ciudades=DB::table('ciudad')->get();
        $sucursales=DB::table('sucursal as s')
        ->join('ciudad as c','s.id_ciudad','=','c.id_ciudad')
        ->select('c.descripcion')
        ->get();
        $usuarios=DB::table('users')->get();
        return view('reportes.clientes.index',['personas'=>$personas,"ciudades"=>$ciudades, "sucursales"=>$sucursales,"usuarios"=>$usuarios]);
    }

    public function reporteXfacturar1(Request $request)
    {
        //Reporte X Facturar
        $nombre=$request->get('nom_remitente');
        $fecha_inicio=$request->get('fecha_inicio');
        $fecha_final=$request->get('fecha_final');
        //dd($nombre,$fecha_inicio,$fecha_final);
        //Obtener los registros X Facturar
        $guias=DB::select('SELECT c.num_guia, c.fecha_emision, c.ciudad_origen,c.ciudad_destino, 
                        c.nom_remitente, c.nom_destinatario, SUM(d.cantidad) as cantidad,c.valor_guia
                        FROM cabecera as c
                        INNER JOIN formas_pago as f
                        ON c.id_forma_pago=f.id_formas_pago
                        INNER join detalle as d
                        on c.id_cabecera=d.id_cabecera
                        WHERE c.nom_remitente="'.$nombre.'"
                        AND date(c.fecha_emision) BETWEEN "'.$fecha_inicio.'"
                        AND "'.$fecha_final.'"
                        AND c.id_forma_pago = 3
                        GROUP by c.id_cabecera 
                        ORDER BY c.fecha_emision  ASC');
        
        $suma=DB::select('SELECT SUM(c.valor_guia) as total 
                        FROM cabecera as c 
                        WHERE c.nom_remitente ="'.$nombre.'"
                        AND c.id_forma_pago = 3
                        AND date(c.fecha_emision) BETWEEN "'.$fecha_inicio.'"
                        AND "'.$fecha_final.'"');
        $pdf = PDF::loadView('reportes.clientes.pdf.xfacturar',['guias'=>$guias,'suma'=>$suma]);
        return $pdf->download('Por-Facturar.pdf');
    }

    public function reporteXfacturar_excel(Request $request)
    {
        
        //Reporte X Facturar
            $nombre=$request->get('nom_remitente');
            $fecha_inicio=$request->get('fecha_inicio_1');
            $fecha_final=$request->get('fecha_final_1');

            //Obtener los registros X Facturar
            return Excel::download(new ClienteXFacturarExport($fecha_inicio,$fecha_final,$nombre), 'Por-Facturar.xlsx');
    }

    public function reporteXfacturarCanceladas(Request $request)
    {
        //Reporte X Facturar Canceladas
        $nombre=$request->get('nom_remitente');
        $fecha_inicio=$request->get('fecha_inicio_2');
        $fecha_final=$request->get('fecha_final_2');

        //Obtener los registros X Facturar

        $guias=DB::select('SELECT c.num_guia, c.fecha_emision, c.ciudad_origen,c.ciudad_destino, 
                        c.nom_remitente, c.nom_destinatario, SUM(d.cantidad) as cantidad,c.valor_guia
                        FROM cabecera as c
                        INNER JOIN formas_pago as f
                        ON c.id_forma_pago=f.id_formas_pago
                        INNER join detalle as d
                        on c.id_cabecera=d.id_cabecera
                        WHERE c.nom_remitente="'.$nombre.'"
                        AND c.estatus_cobro="Cancelado"
                        AND date(c.fecha_emision) BETWEEN "'.$fecha_inicio.'"
                        AND "'.$fecha_final.'"
                        AND c.id_forma_pago = 3
                        GROUP by c.id_cabecera 
                        ORDER BY c.fecha_emision  ASC');
        $suma=DB::select('SELECT SUM(c.valor_guia) as total 
                        FROM cabecera as c 
                        WHERE c.nom_remitente ="'.$nombre.'"
                        AND c.id_forma_pago = "3"
                        AND c.estatus_cobro="Cancelado"
                        AND date(c.fecha_emision) BETWEEN "'.$fecha_inicio.'"
                        AND "'.$fecha_final.'"');
        $pdf = PDF::loadView('reportes.clientes.pdf.xfacturarCanceladas',['guias'=>$guias,'suma'=>$suma]);
        return $pdf->download('Por-Facturar-Canceladas.pdf');
    }

    public function reporteXfacturarxPagar(Request $request)
    {
        //Reporte X Facturar X Pagar
        $nombre=$request->get('nom_remitente');
        $fecha_inicio=$request->get('fecha_inicio_3');
        $fecha_final=$request->get('fecha_final_3');

        //Obtener los registros X Facturar

        $guias=DB::select('SELECT c.num_guia, c.fecha_emision, c.ciudad_origen,c.ciudad_destino, 
                        c.nom_remitente, c.nom_destinatario, SUM(d.cantidad) as cantidad,c.valor_guia
                        FROM cabecera as c
                        INNER JOIN formas_pago as f
                        ON c.id_forma_pago=f.id_formas_pago
                        INNER join detalle as d
                        on c.id_cabecera=d.id_cabecera
                        WHERE c.nom_remitente="'.$nombre.'"
                        AND c.estatus_cobro="Pendiente"
                        AND date(c.fecha_emision) BETWEEN "'.$fecha_inicio.'"
                        AND "'.$fecha_final.'"
                        AND c.id_forma_pago = 3
                        GROUP by c.id_cabecera 
                        ORDER BY c.fecha_emision  ASC');
        $suma=DB::select('SELECT SUM(c.valor_guia) as total 
                        FROM cabecera as c 
                        WHERE c.nom_remitente ="'.$nombre.'"
                        AND c.id_forma_pago = 3
                        AND c.estatus_cobro="Pendiente"
                        AND date(c.fecha_emision) BETWEEN "'.$fecha_inicio.'"
                        AND "'.$fecha_final.'"');
        $pdf = PDF::loadView('reportes.clientes.pdf.xfacturarxPagar',['guias'=>$guias,'suma'=>$suma]);
        return $pdf->download('Por-Facturar-Por-Pagar.pdf');
    }

    public function reporteXfacturarxPagarTodos(Request $request)
    {
        //Reporte X Facturar X Pagar
        $fecha_inicio=$request->get('fecha_inicio_5');
        $fecha_final=$request->get('fecha_final_5');

        //Obtener los registros X Facturar

        $guias=DB::select('SELECT c.num_guia, c.fecha_emision, c.ciudad_origen,c.ciudad_destino, 
                        c.nom_remitente, c.nom_destinatario, SUM(d.cantidad) as cantidad,c.valor_guia
                        FROM cabecera as c
                        INNER JOIN formas_pago as f
                        ON c.id_forma_pago=f.id_formas_pago
                        INNER join detalle as d
                        on c.id_cabecera=d.id_cabecera
                        WHERE c.estatus_cobro="Pendiente"
                        AND date(c.fecha_emision) BETWEEN "'.$fecha_inicio.'"
                        AND "'.$fecha_final.'"
                        AND c.id_forma_pago = 3
                        GROUP by c.id_cabecera 
                        ORDER BY c.fecha_emision  ASC');
        $suma=DB::select('SELECT SUM(c.valor_guia) as total 
                        FROM cabecera as c 
                        WHERE c.id_forma_pago = 3
                        AND c.estatus_cobro="Pendiente"
                        AND date(c.fecha_emision) BETWEEN "'.$fecha_inicio.'"
                        AND "'.$fecha_final.'"');
        $pdf = PDF::loadView('reportes.clientes.pdf.xfacturarxPagarTodos',['guias'=>$guias,'suma'=>$suma]);
        return $pdf->download('Por-Facturar-Por-Pagar-Todos.pdf');
    }

    public function reporteXTodasFormasPago(Request $request)
    {
        //Reporte X Facturar X Pagar
        $nombre=$request->get('nom_remitente');
        $fecha_inicio=$request->get('fecha_inicio_4');
        $fecha_final=$request->get('fecha_final_4');

        //Obtener los registros X Facturar

        $guias=DB::select('SELECT c.num_guia, c.fecha_emision, c.ciudad_origen,c.ciudad_destino, 
                        c.nom_remitente, c.nom_destinatario, SUM(d.cantidad) as cantidad,c.valor_guia,f.descripcion,c.estatus_cobro
                        FROM cabecera as c
                        INNER JOIN formas_pago as f
                        ON c.id_forma_pago=f.id_formas_pago
                        INNER join detalle as d
                        ON c.id_cabecera=d.id_cabecera
                        WHERE c.nom_remitente="'.$nombre.'"
                        AND date(c.fecha_emision) BETWEEN "'.$fecha_inicio.'"
                        AND "'.$fecha_final.'"
                        GROUP by c.id_cabecera 
                        ORDER BY c.fecha_emision  ASC');
        $suma=DB::select('SELECT SUM(c.valor_guia) as total 
                        FROM cabecera as c 
                        WHERE c.nom_remitente ="'.$nombre.'"
                        AND date(c.fecha_emision) BETWEEN "'.$fecha_inicio.'"
                        AND "'.$fecha_final.'"');
        $pdf = PDF::loadView('reportes.clientes.pdf.xTodasFormasPago',['guias'=>$guias,'suma'=>$suma]);
        return $pdf->download('Todas-Formas-Pago.pdf');
    }
}