<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use DateTime;

class MensualXCiudadExport implements  FromView
{
    use Exportable;

    private $ciudad_origen;
    private $fecha_inicio_ciudad;
    private $fecha_final_ciudad; // declaras la propiedad
    

    public function __construct(string $fecha_final_ciudad, string $fecha_inicio_ciudad,string $ciudad_origen) 
    {
       
        $this->fecha_inicio_ciudad = $fecha_inicio_ciudad; // asignas el valor inyectado a la propiedad
        $this->fecha_final_ciudad = $fecha_final_ciudad; // asignas el valor inyectado a la propiedad 
        $this->ciudad_origen = $ciudad_origen; // asignas el valor inyectado a la propiedad
    }
   
     public function view(): View
     {
         $this->fecha_inicio_ciudad=new DateTime($this->fecha_inicio_ciudad);
        $this->fecha_inicio_ciudad=$this->fecha_inicio_ciudad->format('Y-m-d H:i:s');
        
        $this->fecha_final_ciudad=new DateTime($this->fecha_final_ciudad);
        $this->fecha_final_ciudad=$this->fecha_final_ciudad->format('Y-m-d H:i:s');
         //dd($this->fecha_inicio_ciudad,$this->fecha_final_ciudad,$this->ciudades);
         $guiasXciudad=DB::select('SELECT c.id_cabecera, c.num_guia, SUM(d.cantidad) as cantidad, c.fecha_emision, c.ciudad_origen, c.ciudad_destino, 
		                    c.nom_remitente, c.nom_destinatario, c.valor_guia, f.descripcion
                            FROM cabecera as c
                            INNER JOIN formas_pago as f
                            ON f.id_formas_pago=c.id_forma_pago
                            INNER join detalle as d
                            on c.id_cabecera=d.id_cabecera
                            WHERE c.ciudad_origen = "'.$this->ciudad_origen.'"
                            AND date(c.fecha_emision) BETWEEN "'.$this->fecha_final_ciudad.'"	
                            AND "'.$this->fecha_inicio_ciudad.'" 
                            GROUP BY c.id_cabecera');
        return view('reportes.mensual.excel.ciudad',["guiasXciudad"=>$guiasXciudad]);
     }
}
