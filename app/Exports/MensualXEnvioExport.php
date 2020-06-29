<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use DateTime;

class MensualXEnvioExport implements  FromView
{
    use Exportable;

    private $ciudades;
    private $fecha_inicio_envio;
    private $fecha_final_envio; // declaras la propiedad
    

    public function __construct(string $fecha_final_envio, string $fecha_inicio_envio,string $ciudades) 
    {
       
        $this->fecha_inicio_envio = $fecha_inicio_envio; // asignas el valor inyectado a la propiedad
        $this->fecha_final_envio = $fecha_final_envio; // asignas el valor inyectado a la propiedad 
        $this->ciudades = $ciudades; // asignas el valor inyectado a la propiedad
    }
   
    public function view(): View
    {
        $this->fecha_inicio_envio=new DateTime($this->fecha_inicio_envio);
        $this->fecha_inicio_envio=$this->fecha_inicio_envio->format('Y-m-d H:i:s');
        
        $this->fecha_final_envio=new DateTime($this->fecha_final_envio);
        $this->fecha_final_envio=$this->fecha_final_envio->format('Y-m-d H:i:s');
        //dd($this->fecha_inicio_envio,$this->fecha_final_envio,$this->ciudades);
        $guiasXenvio=DB::select('SELECT c.id_cabecera, c.num_guia, c.num_guia_trans, SUM(d.cantidad) as cantidad, c.fecha_emision, c.ciudad_origen, c.ciudad_destino, c.nom_remitente, c.nom_destinatario, c.valor_guia, f.descripcion
                        FROM cabecera as c
                        INNER JOIN formas_pago as f
                        ON f.id_formas_pago=c.id_forma_pago
                        INNER join detalle as d
                        on c.id_cabecera=d.id_cabecera
                        WHERE c.ciudad_destino IN ("'.$this->ciudades.'")
                        AND date(c.fecha_emision) BETWEEN "'.$this->fecha_final_envio.'"
                        AND "'.$this->fecha_inicio_envio.'"
                        GROUP by c.id_cabecera');
        return view('reportes.mensual.excel.envio',["guiasXenvio"=>$guiasXenvio]);
    }
}
