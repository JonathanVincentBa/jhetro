<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    protected $table='detalle';

    protected $primaryKey='id_detalle';

    public $timestamps=true;

    protected $fillable=[
        'id_cabecera',
        'cantidad',
        'descripcion',
        'v_unitario',
        'v_parcial'
    ];
    protected $guarded =[

    ];
}
