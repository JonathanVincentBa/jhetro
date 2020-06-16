<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade as PDF;

class PdfController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexfacturar()
    {
        return view('pdf.xfacturar.indexfacturar');
    }

   

   

    public function reporteGuia($id)
    {
        //Obtengo los datos

        $cabecera=DB::table('cabecera as c')
            ->select('c.fecha_emision','c.guia_rem_cliente','c.factura_cliente','c.ciudad_origen','c.ciudad_destino','c.id_motivo_traslado','c.nom_remitente','c.nom_destinatario','c.direccion_remitente','c.direccion_destinatario','c.fono_remitente','c.dni_remitente','c.fono_destinatario','c.dni_remitente','c.flete','c.prima','c.valor_guia','c.id_forma_pago')
            ->where('c.id_cabecera','=',$id)
            ->first();
        $detalles=DB::table('detalle as d')
            ->select('d.cantidad','d.descripcion','d.v_unitario','d.v_parcial')
            ->where('d.id_cabecera','=',$id)
            ->get();
        
            $pdf = new Fpdf('L', 'mm', 'A4');
            $pdf::AddPage();
            $pdf::SetFont('Arial','B',10);
            //Inicio del reporte
            $pdf::SetXY(35,44);
            $pdf::cell(0,0,utf8_decode($cabecera->fecha_emision));
            $pdf::SetFont('Arial','B',10);
            $pdf::SetXY(35,56);
            $pdf::cell(0,0,utf8_decode($cabecera->guia_rem_cliente));
            $pdf::SetFont('Arial','B',10);
            $pdf::SetXY(48,56);
            $pdf::cell(0,0,utf8_decode($cabecera->factura_cliente));
            $pdf::SetFont('Arial','B',10);
            $pdf::SetXY(64,56);
            $pdf::cell(0,0,utf8_decode($cabecera->ciudad_origen));
            $pdf::SetFont('Arial','B',10);
            $pdf::SetXY(88,56);
            $pdf::cell(0,0,utf8_decode($cabecera->ciudad_destino));
            if($cabecera->id_motivo_traslado==1)
            {
                $pdf::SetFont('Arial','B',10);
                $pdf::SetXY(162,50);
                $pdf::cell(0,0,utf8_decode("X"));
            }
            if($cabecera->id_motivo_traslado==2)
            {
                $pdf::SetFont('Arial','B',10);
                $pdf::SetXY(184,50);
                $pdf::cell(0,0,utf8_decode("X"));
            }
            if($cabecera->id_motivo_traslado==3)
            {
                $pdf::SetFont('Arial','B',10);
                $pdf::SetXY(202,50);
                $pdf::cell(0,0,utf8_decode("X"));
            }
            if($cabecera->id_motivo_traslado==4)
            {
                $pdf::SetFont('Arial','B',10);
                $pdf::SetXY(184,58);
                $pdf::cell(0,0,utf8_decode("X"));
            }
            if($cabecera->id_motivo_traslado==5)
            {
                $pdf::SetFont('Arial','B',10);
                $pdf::SetXY(202,58);
                $pdf::cell(0,0,utf8_decode("X"));
            }
            $pdf::SetFont('Arial','B',10);
            $pdf::SetXY(30,62);
            $pdf::cell(0,0,utf8_decode($cabecera->nom_remitente));
            $pdf::SetFont('Arial','B',10);
            $pdf::SetXY(132,62);
            $pdf::cell(0,0,utf8_decode($cabecera->nom_destinatario));
            $pdf::SetFont('Arial','B',10);
            $pdf::SetXY(32,73);
            $pdf::cell(0,0,utf8_decode($cabecera->direccion_remitente));
            $pdf::SetFont('Arial','B',10);
            $pdf::SetXY(130,69);
            $pdf::cell(0,0,utf8_decode($cabecera->direccion_destinatario));
            $pdf::SetFont('Arial','B',10);
            $pdf::SetXY(30,80);
            $pdf::cell(0,0,utf8_decode($cabecera->fono_remitente));
            $pdf::SetFont('Arial','B',10);
            $pdf::SetXY(72,80);
            $pdf::cell(0,0,utf8_decode($cabecera->dni_remitente));
            $pdf::SetFont('Arial','B',10);
            $pdf::SetXY(130,80);
            $pdf::cell(0,0,utf8_decode($cabecera->fono_destinatario));
            $pdf::SetFont('Arial','B',10);
            $pdf::SetXY(170,80);
            $pdf::cell(0,0,utf8_decode($cabecera->dni_remitente));
            $pdf::SetFont('Arial','B',10);
            $pdf::SetXY(192,119);
            $pdf::cell(0,0,utf8_decode($cabecera->flete));
            $pdf::SetFont('Arial','B',10);
            $pdf::SetXY(192,125);
            $pdf::cell(0,0,utf8_decode($cabecera->valor_guia));
            $pdf::SetFont('Arial','B',10);
            $pdf::SetXY(192,130);
            $pdf::cell(0,0,utf8_decode($cabecera->prima));
            if($cabecera->id_forma_pago==1)
            {
                $pdf::SetFont('Arial','B',10);
                $pdf::SetXY(164,124);
                $pdf::cell(0,0,utf8_decode("X"));
            }
            if($cabecera->id_forma_pago==2)
            {
                $pdf::SetFont('Arial','B',10);
                $pdf::SetXY(164,128);
                $pdf::cell(0,0,utf8_decode("X"));
            }
            if($cabecera->id_forma_pago==3)
            {
                $pdf::SetFont('Arial','B',10);
                $pdf::SetXY(164,132);
                $pdf::cell(0,0,utf8_decode("X"));
            }
            //Mostrar detalles
            $y=90;
            foreach ($detalles as $det) 
            {
                $pdf::SetXY(15,$y);
                $pdf::cell(0,0,utf8_decode($det->cantidad));
                $pdf::SetXY(30,$y);
                $pdf::cell(0,0,utf8_decode($det->descripcion));
                $pdf::SetXY(172,$y);
                $pdf::cell(0,0,utf8_decode($det->v_unitario));
                $pdf::SetXY(192,$y);
                $pdf::cell(0,0,utf8_decode($det->v_parcial));
                $y=$y+5;
            }
            $pdf::Output();
            exit;
    }
}
