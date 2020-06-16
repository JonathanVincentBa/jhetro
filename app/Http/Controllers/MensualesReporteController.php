<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MensualXEnvioExport;
use App\Exports\MensualXCiudadExport;
use Barryvdh\DomPDF\Facade as PDF;

class MensualesReporteController extends Controller
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
        return view('reportes.mensual.index',['personas'=>$personas,"ciudades"=>$ciudades, "sucursales"=>$sucursales,"usuarios"=>$usuarios]);
    }

    public function reporteXenvioExcel(Request $request)
    {
        //Reporte X Ciudades X Destinos
        //$ciudad_origen= $request->get('ciudad_origen');
        $ciudades = $request->input('ciudad_destino');
        $ciudades = implode('","',$ciudades);
        $fecha_inicio_envio = $request->get('fecha_inicio_3');
        $fecha_final_envio  = $request->get('fecha_final_3');
        

        //Obtener registros X Ciudad X envio
        return Excel::download(new MensualXEnvioExport($fecha_inicio_envio,$fecha_final_envio,$ciudades), 'Mensual-Por-Envio.xlsx');        
    }
    
    public function reporteXciudadExcel(Request $request)
    {
        //Reporte X Ciudad X Pagar Excel
        $fecha_inicio_ciudad = $request->get('fecha_inicio_2');
        $fecha_final_ciudad  = $request->get('fecha_final_2');
        $ciudad_origen= $request->get('ciudad');
        //dd($ciudad_origen,$fecha_inicio_ciudad,$fecha_final_ciudad);

        //Obtener registros X Ciudad X Pagar
        return Excel::download(new MensualXCiudadExport($fecha_inicio_ciudad,$fecha_final_ciudad,$ciudad_origen), 'Mensual-Por-Envio.xlsx');        
        
    }

    public function reporteGuiasAnuladas(Request $request)
    {
        $fecha_inicio = $request->get('fecha_inicio_4');
        $fecha_final  = $request->get('fecha_final_4');
        $guiasAnuladas=DB::select(' SELECT c.num_guia, c.fecha_emision, ciudad_origen, ciudad_destino, u.name,c.valor_guia, c.nota
                                    FROM cabecera as c
                                    INNER JOIN users as u
                                    ON c.id_users=u.id
                                    WHERE c.estado="0"
                                    AND date(c.fecha_emision) BETWEEN "'.$fecha_inicio.'"
                                    AND "'.$fecha_final.'"');
        $pdf = PDF::loadView('reportes.mensual.pdf.anuladas',['guiasAnuladas'=>$guiasAnuladas]);
        return $pdf->download('GuiasAnuladas.pdf');
    }
}
