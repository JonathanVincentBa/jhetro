<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use DateTime;

class ClienteXFacturarExport implements FromView
{
    use Exportable;

    private $nombre;
    private $fecha_inicio;
    private $fecha_final; // declaras la propiedad

    public function __construct(string $fecha_final, string $fecha_inicio,string $nombre) 
    {
        
        $this->nombre = $nombre; // asignas el valor inyectado a la propiedad
        $this->fecha_inicio = $fecha_inicio; // asignas el valor inyectado a la propiedad
        $this->fecha_final = $fecha_final; // asignas el valor inyectado a la propiedad 
        
    }
   
     public function view(): View
     {
         $this->fecha_inicio=new DateTime($this->fecha_inicio);
        $this->fecha_inicio=$this->fecha_inicio->format('Y-m-d H:i:s');
        
        $this->fecha_final=new DateTime($this->fecha_final);
        $this->fecha_final=$this->fecha_final->format('Y-m-d H:i:s');
        //dd($this->fecha_inicio,$this->fecha_final,$this->nombre);
        $guias=DB::select('SELECT c.num_guia, num_guia_trans, c.fecha_emision, c.ciudad_origen, c.ciudad_destino, 
                            c.nom_remitente, c.nom_destinatario,  SUM(d.cantidad) as cantidad,c.valor_guia
                            FROM cabecera as c
                            INNER JOIN formas_pago as f
                            ON c.id_forma_pago=f.id_formas_pago
                            INNER join detalle as d
                            on c.id_cabecera=d.id_cabecera
                            WHERE c.nom_remitente="'.$this->nombre.'"
                            AND date(c.fecha_emision) BETWEEN "'.$this->fecha_final.'"
                            AND "'.$this->fecha_inicio.'"
                            AND c.id_forma_pago = 3
                            GROUP by c.id_cabecera 
                            ORDER BY c.fecha_emision  ASC');
            $suma=DB::select('SELECT SUM(c.valor_guia) as total 
                            FROM cabecera as c 
                            WHERE c.nom_remitente ="'.$this->nombre.'"
                            AND c.id_forma_pago = 3
                            AND date(c.fecha_emision) BETWEEN "'.$this->fecha_final.'"
                            AND "'.$this->fecha_inicio.'"');
        return view('reportes.clientes.excel.xfacturar',["guias"=>$guias, "suma"=>$suma]);
     }
}
