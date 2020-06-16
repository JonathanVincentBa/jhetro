<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VariosExport;

class VariosReporteController extends Controller
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
        return view('reportes.varios.index',['personas'=>$personas,"ciudades"=>$ciudades, "sucursales"=>$sucursales,"usuarios"=>$usuarios]);
    }

    public function reporteXenvio(Request $request)
    {
        //Reporte X Ciudades X Destinos
        //$ciudad_origen= $request->get('ciudad_origen');
        $ciudades = $request->input('ciudad_destino');
        $ciudades = implode('","',$ciudades);
        $fecha_inicio_envio = $request->get('fecha_inicio_3');
        $fecha_final_envio  = $request->get('fecha_final_3');
        

        //Obtener registros X Ciudad X envio
        $guiasXenvio=DB::select('SELECT c.id_cabecera, c.num_guia, SUM(d.cantidad) as cantidad, c.fecha_emision, c.ciudad_origen, c.ciudad_destino, c.nom_remitente, c.nom_destinatario, c.valor_guia, f.descripcion, c.estado
                        FROM cabecera as c
                        INNER JOIN formas_pago as f
                        ON f.id_formas_pago=c.id_forma_pago
                        INNER join detalle as d
                        on c.id_cabecera=d.id_cabecera
                        WHERE c.ciudad_destino IN ("'.$ciudades.'")
                        AND date(c.fecha_emision) BETWEEN "'.$fecha_inicio_envio.'"
                        AND "'.$fecha_final_envio.'"
                        AND c.estado="1"
                        GROUP by c.id_cabecera');

        $sumaXciudad=DB::select('SELECT SUM(c.valor_guia) as total 
                        FROM cabecera as c 
                        WHERE c.ciudad_destino IN ("'.$ciudades.'")
                        AND date(c.fecha_emision) BETWEEN "'.$fecha_inicio_envio.'"
                        AND "'.$fecha_final_envio.'"');

        $contarXciudad=DB::select('SELECT c.num_guia, c.ciudad_origen, c.ciudad_destino, SUM(d.cantidad) as total
                        FROM cabecera as c
                        INNER JOIN detalle as d
                        ON c.id_cabecera=d.id_cabecera
                        WHERE c.ciudad_destino IN ("'.$ciudades.'")
                        AND date(c.fecha_emision) BETWEEN "'.$fecha_inicio_envio.'"
                        AND "'.$fecha_final_envio.'"
                        GROUP BY c.ciudad_origen, c.ciudad_destino');
        $pdf = PDF::loadView('reportes.varios.pdf.xenvio',['guiasXenvio'=>$guiasXenvio,'contarXciudad'=>$contarXciudad,"sumaXciudad"=>$sumaXciudad]);
        return $pdf->download('ManifiestoXciudadesDestino.pdf');
    }
    
    public function reporteXciudad(Request $request)
    {
        //Reporte X Ciudad X Pagar
        $fecha_inicio_ciudad = $request->get('fecha_inicio_2');
        $fecha_final_ciudad  = $request->get('fecha_final_2');
        $ciudad_origen= $request->get('ciudad');
        //dd($ciudad_origen,$fecha_inicio_ciudad,$fecha_final_ciudad);

        //Obtener registros X Ciudad X Pagar
        
        $guiasXciudad=DB::select('SELECT c.id_cabecera, c.num_guia, SUM(d.cantidad) as cantidad, c.fecha_emision, c.ciudad_origen, c.ciudad_destino, 
                                c.nom_remitente, c.nom_destinatario, c.valor_guia, f.descripcion, c.estado
                                FROM cabecera as c
                                INNER JOIN formas_pago as f
                                ON f.id_formas_pago=c.id_forma_pago
                                INNER join detalle as d
                                on c.id_cabecera=d.id_cabecera
                                WHERE c.ciudad_origen = "'.$ciudad_origen.'"
                                AND date(c.fecha_emision) BETWEEN "'.$fecha_inicio_ciudad.'"	
                                AND "'.$fecha_final_ciudad.'" 
                                AND c.estado="1"
                                GROUP BY c.id_cabecera');
                
        $sumaXciudad=DB::select('SELECT SUM(c.valor_guia) as total 
                                FROM cabecera as c 
                                WHERE c.ciudad_origen = "'.$ciudad_origen.'"
                                AND date(c.fecha_emision) BETWEEN "'.$fecha_inicio_ciudad.'"
                                AND "'.$fecha_final_ciudad.'"');
        
        $contarXciudad=DB::select('SELECT c.num_guia, c.ciudad_origen, c.ciudad_destino, SUM(d.cantidad) as total
                                FROM cabecera as c
                                INNER JOIN detalle as d
                                ON c.id_cabecera=d.id_cabecera
                                WHERE c.ciudad_origen = "'.$ciudad_origen.'"
                                AND date(c.fecha_emision) BETWEEN "'.$fecha_inicio_ciudad.'"
                                AND "'.$fecha_final_ciudad.'"
                                GROUP BY c.ciudad_origen, c.ciudad_destino');

        $pdf = PDF::loadView('reportes.varios.pdf.xciudad',['guiasXciudad'=>$guiasXciudad,'sumaXciudad'=>$sumaXciudad,'contarXciudad'=>$contarXciudad]);
        return $pdf->download('ManifiestoXciudadesOrigen.pdf');
    }

    public function reporteXpagar(Request $request)
    {
        //Reporte X Ciudad X Pagar
        $fecha_inicio_ciudad = $request->get('fecha_inicio_4');
        $fecha_final_ciudad  = $request->get('fecha_final_4');
        $ciudades = $request->input('ciudad_destino');
        $ciudades = implode('","',$ciudades);
        //dd($ciudad_origen,$fecha_inicio_ciudad,$fecha_final_ciudad);

        //Obtener registros X Ciudad X Pagar
        $guiasXciudad=DB::select('SELECT c.num_guia, c.fecha_emision, c.ciudad_origen, c.ciudad_destino, c.nom_remitente, c.nom_destinatario, c.valor_guia, f.descripcion, c.estado
                        FROM cabecera as c
                        INNER JOIN formas_pago as f
                        ON f.id_formas_pago=c.id_forma_pago
                        WHERE c.ciudad_destino IN ("'.$ciudades.'")
                        AND date(c.fecha_emision) BETWEEN "'.$fecha_inicio_ciudad.'"
                        AND "'.$fecha_final_ciudad.'"
                        AND c.estatus_cobro= "Pendiente"
                        AND c.id_forma_pago= "2"
                        AND c.estado="1"
                        GROUP BY c.num_guia,c.ciudad_origen,c.ciudad_destino 
                        ORDER BY c.fecha_emision ASC');

        $sumaXciudad=DB::select('SELECT SUM(c.valor_guia) as total 
                        FROM cabecera as c 
                        WHERE c.ciudad_destino IN ("'.$ciudades.'")
                        AND date(c.fecha_emision) BETWEEN "'.$fecha_inicio_ciudad.'"
                        AND "'.$fecha_final_ciudad.'"
                        AND c.estatus_cobro= "Pendiente"
                        AND c.id_forma_pago= "2"');
        
        
        $pdf = PDF::loadView('reportes.varios.pdf.xpagar',['guiasXciudad'=>$guiasXciudad,'sumaXciudad'=>$sumaXciudad]);
        return $pdf->download('ManifiestoXpagarAlCobro.pdf');
    }

    public function reporteXpagarExcel(Request $request)
    {
        //Reporte X Ciudad X Pagar
        $fecha_inicio_ciudad = $request->get('fecha_inicio_9');
        $fecha_final_ciudad  = $request->get('fecha_final_9');
        $ciudades = $request->input('ciudad_destino');
        $ciudades = implode('","',$ciudades);

        return Excel::download(new VariosExport($fecha_inicio_ciudad,$fecha_final_ciudad,$ciudades), 'Por-Pagar.xlsx');        
    }

    public function reportePagado(Request $request)
    {
        //Reporte X Ciudad X Pagar
        $fecha_inicio_ciudad = $request->get('fecha_inicio_5');
        $fecha_final_ciudad  = $request->get('fecha_final_5');
        $ciudades = $request->input('ciudad_destino');
        $ciudades = implode('","',$ciudades);
        //dd($ciudad_origen,$fecha_inicio_ciudad,$fecha_final_ciudad);

        //Obtener registros X Ciudad X Pagar
        $guiasXciudad=DB::select('SELECT c.num_guia, c.fecha_emision, c.ciudad_origen, c.ciudad_destino, 
        c.nom_remitente, c.nom_destinatario, c.valor_guia, f.descripcion, c.estado
                        FROM cabecera as c
                        INNER JOIN formas_pago as f
                        ON f.id_formas_pago=c.id_forma_pago
                        WHERE c.ciudad_destino IN ("'.$ciudades.'")
                        AND date(c.fecha_emision) BETWEEN "'.$fecha_inicio_ciudad.'"
                        AND "'.$fecha_final_ciudad.'"
                        AND c.estatus_cobro= "Cancelado"
                        AND c.id_forma_pago= "2"
                        AND c.estado="1"
                        GROUP BY c.num_guia,c.ciudad_origen,c.ciudad_destino 
                        ORDER BY c.fecha_emision ASC');

        $sumaXciudad=DB::select('SELECT SUM(c.valor_guia) as total 
                        FROM cabecera as c 
                        WHERE c.ciudad_destino IN ("'.$ciudades.'")
                        AND date(c.fecha_emision) BETWEEN "'.$fecha_inicio_ciudad.'"
                        AND "'.$fecha_final_ciudad.'"
                        AND c.estatus_cobro= "Cancelado"
                        AND c.id_forma_pago= "2"');

        $pdf = PDF::loadView('reportes.varios.pdf.pagado',['guiasXciudad'=>$guiasXciudad,'sumaXciudad'=>$sumaXciudad]);
        return $pdf->download('ManifiestoPagadoAlCobro.pdf');
    }

    public function reporteCierresDiarios(Request $request)
    {
        //Reporte X Ciudad X Pagar
        $fecha_inicio_ciudad = $request->get('fecha_inicio_6');
        $fecha_final_ciudad  = $request->get('fecha_final_6');
        $usuario = $request->get('id_users');
        

        //Obtener registros X Usuario-Pagadas
        $guiasXciudad=DB::select('SELECT c.num_guia, c.fecha_emision, c.ciudad_origen, c.ciudad_destino, 
        c.nom_remitente, c.nom_destinatario, c.valor_guia, f.descripcion, c.estado
                        FROM cabecera as c
                        INNER JOIN formas_pago as f
                        ON f.id_formas_pago=c.id_forma_pago
                        WHERE c.id_users = "'.$usuario.'"
                        AND date(c.fecha_emision) BETWEEN "'.$fecha_inicio_ciudad.'"
                        AND "'.$fecha_final_ciudad.'"
                        AND c.id_forma_pago= "1"
                        AND c.estado="1"
                        GROUP BY c.num_guia,c.ciudad_origen,c.ciudad_destino 
                        ORDER BY c.fecha_emision ASC');

        $sumaXciudad=DB::select('SELECT SUM(c.valor_guia) as total 
                        FROM cabecera as c 
                        WHERE c.id_users = "'.$usuario.'"
                        AND date(c.fecha_emision) BETWEEN "'.$fecha_inicio_ciudad.'"
                        AND "'.$fecha_final_ciudad.'"
                        AND c.id_forma_pago= "1"');

        $pdf = PDF::loadView('reportes.varios.pdf.cierreDiarios',['guiasXciudad'=>$guiasXciudad,'sumaXciudad'=>$sumaXciudad]);
        return $pdf->download('CierresDiarios.pdf');
    }

    public function reporteXfacturarCanceladas(Request $request)
    {
        //Reporte X Facturar Canceladas
        $ciudad_origen= $request->get('ciudad');
        $fecha_inicio=$request->get('fecha_inicio_7');
        $fecha_final=$request->get('fecha_final_7');
        //dd($nombre,$fecha_inicio,$fecha_final);
        
        

        //Obtener los registros X Facturar
        $guias=DB::select('SELECT c.num_guia, c.fecha_emision, c.ciudad_origen,c.ciudad_destino, 
        c.nom_remitente, c.nom_destinatario, SUM(d.cantidad) as cantidad,c.valor_guia, c.estado
        FROM cabecera as c
        INNER JOIN formas_pago as f
        ON c.id_forma_pago=f.id_formas_pago
        INNER join detalle as d
        on c.id_cabecera=d.id_cabecera
        WHERE c.ciudad_origen = "'.$ciudad_origen.'"
        AND c.estatus_cobro="Cancelado"
        AND date(c.fecha_emision) BETWEEN "'.$fecha_inicio.'"
        AND "'.$fecha_final.'"
        AND c.id_forma_pago = 3
        AND c.estado="1"
        GROUP by c.id_cabecera 
        ORDER BY c.fecha_emision  ASC');

        $suma=DB::select('SELECT SUM(c.valor_guia) as total 
                        FROM cabecera as c 
                        WHERE c.ciudad_origen = "'.$ciudad_origen.'"
                        AND c.id_forma_pago = "3"
                        AND c.estatus_cobro="Cancelado"
                        AND date(c.fecha_emision) BETWEEN "'.$fecha_inicio.'"
                        AND "'.$fecha_final.'"');

        $pdf = PDF::loadView('reportes.varios.pdf.xfacturarCanceladas',['guias'=>$guias,'suma'=>$suma]);
        return $pdf->download('XFacturarCanceladas.pdf');
    }

    public function reporteXfacturarxPagar(Request $request)
    {
        //Reporte X Facturar X Pagar
        $ciudad_origen= $request->get('ciudad');
        $fecha_inicio=$request->get('fecha_inicio_8');
        $fecha_final=$request->get('fecha_final_8');
        //dd($nombre,$fecha_inicio,$fecha_final);
        
        

        //Obtener los registros X Facturar
        $guias=DB::select('SELECT c.num_guia, c.fecha_emision, c.ciudad_origen,c.ciudad_destino, 
                        c.nom_remitente, c.nom_destinatario, SUM(d.cantidad) as cantidad,c.valor_guia, c.estado
                        FROM cabecera as c
                        INNER JOIN formas_pago as f
                        ON c.id_forma_pago=f.id_formas_pago
                        INNER join detalle as d
                        on c.id_cabecera=d.id_cabecera
                        WHERE c.ciudad_origen = "'.$ciudad_origen.'"
                        AND c.estatus_cobro="Pendiente"
                        AND date(c.fecha_emision) BETWEEN "'.$fecha_inicio.'"
                        AND "'.$fecha_final.'"
                        AND c.id_forma_pago = 3
                        AND c.estado="1"
                        GROUP by c.id_cabecera 
                        ORDER BY c.fecha_emision  ASC');

        $suma=DB::select('SELECT SUM(c.valor_guia) as total 
                        FROM cabecera as c 
                        WHERE c.ciudad_origen = "'.$ciudad_origen.'"
                        AND c.id_forma_pago = 3
                        AND c.estatus_cobro="Pendiente"
                        AND date(c.fecha_emision) BETWEEN "'.$fecha_inicio.'"
                        AND "'.$fecha_final.'"');

        $pdf = PDF::loadView('reportes.varios.pdf.xfacturarxPagar',['guias'=>$guias,'suma'=>$suma]);
        return $pdf->download('XFacturarxPagar.pdf');
    }

    public function usuario(Request $request)
    {
        //Obtener los registros
        $users = DB::table('users')->get();
        $usu= Auth::user()->id;
        $date= date("Y-m-d");
        $guias = DB::select('SELECT * FROM `cabecera` 
        WHERE date(updated_at)="'.$date.'"
        AND id_users_update="'.$usu.'"');
        $suma=DB::select('SELECT SUM(c.valor_guia) as total
        FROM cabecera as c
        WHERE date(c.updated_at)="'.$date.'"
        AND c.id_users_update="'.$usu.'"');
        
        $pdf = PDF::loadView('caja.reportes.usuario',['users' => $users,"guias" => $guias,"suma"=>$suma]);
        return $pdf->download('CajaUsuario.pdf');
    }
}
