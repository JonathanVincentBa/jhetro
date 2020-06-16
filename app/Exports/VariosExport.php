<?php

namespace App\Exports;

//use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;



class VariosExport implements FromView
{
    use Exportable;

    private $ciudades;
    private $fecha_inicio_ciudad;
    private $fecha_final_ciudad; // declaras la propiedad
    

    public function __construct(string $fecha_final_ciudad, string $fecha_inicio_ciudad,string $ciudades) 
    {
       
        $this->fecha_inicio_ciudad = $fecha_inicio_ciudad; // asignas el valor inyectado a la propiedad
        $this->fecha_final_ciudad = $fecha_final_ciudad; // asignas el valor inyectado a la propiedad 
        $this->ciudades = $ciudades; // asignas el valor inyectado a la propiedad
    }
   
     public function view(): View
     {
        $fecha_inicio_ciudad=$this->fecha_inicio_ciudad;
        $fecha_final_ciudad=$this->fecha_final_ciudad;
        $ciudades=$this->ciudades;
        dd($fecha_inicio_ciudad,$fecha_final_ciudad,$ciudades);
         $guiasXciudad=DB::select('SELECT c.num_guia, c.fecha_emision, c.ciudad_origen, c.ciudad_destino, 
                        c.nom_remitente, c.nom_destinatario, c.valor_guia, f.descripcion, c.estado
                        FROM cabecera as c
                        INNER JOIN formas_pago as f
                        ON f.id_formas_pago=c.id_forma_pago
                        WHERE c.ciudad_destino IN ("'.$this->ciudades.'")
                        AND date(c.fecha_emision) BETWEEN "'.$this->fecha_inicio_ciudad.'"
                        AND "'.$this->fecha_final_ciudad.'"
                        AND c.estatus_cobro= "Pendiente"
                        AND c.id_forma_pago= "2"
                        AND c.estado="1"
                        GROUP BY c.num_guia,c.ciudad_origen,c.ciudad_destino 
                        ORDER BY c.fecha_emision ASC');
        $sumaXciudad=DB::select('SELECT SUM(c.valor_guia) as total 
                        FROM cabecera as c 
                        WHERE c.ciudad_destino IN ("'.$this->ciudades.'")
                        AND date(c.fecha_emision) BETWEEN "'.$this->fecha_inicio_ciudad.'"
                        AND "'.$this->fecha_final_ciudad.'"
                        AND c.estatus_cobro= "Pendiente"
                        AND c.id_forma_pago= "2"');
        
         return view('reportes.varios.excel.varios',["guiasXciudad"=>$guiasXciudad, "sumaXciudad"=>$sumaXciudad]);
     }

    
}
