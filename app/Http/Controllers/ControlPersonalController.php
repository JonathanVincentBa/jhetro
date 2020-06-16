<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Excel;

class ControlPersonalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        if ($request) 
        {
            $usuarios=DB::table('users')
                ->where('estado','=','1')
    			->paginate(7);
            return view('empleados.index', ["usuarios" => $usuarios]);
        }
    }
    public function todosEmpleados(Request $request)
    {
        //Reporte X Ciudad X Pagar
        $fecha_inicio = $request->get('fecha_inicio');
        $fecha_final  = $request->get('fecha_final');

        //Obtener registros X Ciudad X Pagar

        $usuarios=DB::select('SELECT users.name, acceso.ip_client, acceso.date, acceso.condicion
                            FROM acceso
                            INNER JOIN users
                            ON users.id=acceso.id_user
                            WHERE DATE(acceso.date) BETWEEN "'.$fecha_inicio.'" AND "'.$fecha_final.'"
                            ORDER BY users.name, acceso.date asc');  
        Excel::create('Reporte de asistencia del personal', function($excel) use($usuarios) 
        {
            $excel->sheet('Datos', function($sheet) use($usuarios) {
                $sheet->row(1, [
                    'Nombre de Usuario', 'Ip del computador', 'Fecha y hora', 'Condicion', 
                ]);
                $cont=2;
                foreach ($usuarios as $usu) 
                {
                    $sheet->row($cont,[
                        $usu->name, $usu->ip_client, $usu->date, $usu->condicion,
                    ]);
                    $cont++;
                }
            });
        })->export('xls');
    }

    public function porEmpleado(Request $request)
    {
        //Reporte X Ciudad X Pagar
        $fecha_inicio = $request->get('fecha_inicio_1');
        $fecha_final  = $request->get('fecha_final_1');
        $nombre = $request->get('name');

        //Obtener registros X Ciudad X Pagar

        $usuarios=DB::select('SELECT users.name, acceso.ip_client, acceso.date, acceso.condicion
                            FROM acceso
                            INNER JOIN users
                            ON users.id=acceso.id_user
                            WHERE DATE(acceso.date) BETWEEN "'.$fecha_inicio.'" AND "'.$fecha_final.'"
                            AND users.name = "'.$nombre.'"
                            ORDER BY users.name, acceso.date asc');
        Excel::create('Reporte de asistencia del personal', function($excel) use($usuarios) 
        {
            $excel->sheet('Datos', function($sheet) use($usuarios) {
                $sheet->row(1, [
                    'Nombre de Usuario', 'Ip del computador', 'Fecha y hora', 'Condicion', 
                ]);
                $cont=2;
                foreach ($usuarios as $usu) 
                {
                    $sheet->row($cont,[
                        $usu->name, $usu->ip_client, $usu->date, $usu->condicion,
                    ]);
                    $cont++;
                }
            });
        })->export('xls');
    }
}