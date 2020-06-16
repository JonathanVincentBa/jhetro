<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabecera extends Model
{
    protected $table='cabecera';

    protected $primaryKey='id_cabecera';

    public $timestamps=true;

    protected $fillable =[
        'id_cabecera',
        'id_motivo_traslado',
        'id_forma_pago',
        'id_persona',
        'ciudad_origen',
        'ciudad_destino',
        'nom_remitente',
        'dni_remitente',
        'direccion_remitente',
        'fono_remitente',
        'nom_destinatario',
        'dni_destinatario',
        'direccion_destinatario',
        'fono_destinatario',
        'num_guia',
        'num_guia_trans',
        'fecha_emision',
        'fecha_recepcion',
        'guia_rem_cliente',
        'factura_cliente',
        'flete',
        'recargo',
        'valor_guia',
        'prima',
        'nombre_recibe',
        'dni_recibe',
        'estatus_entrega',
        'estatus_cobro',
        'estado'
    ];

    protected $dates =[
        'fecha_emision',
        'fecha_recepcion',
    ];
    protected $guarded =[

    ];

}
