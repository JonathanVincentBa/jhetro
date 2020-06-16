<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleManifiesto extends Model
{
    protected $table='detalle_manifiesto';

    protected $primaryKey='id_det_man';

    public $timestamps=true;

    protected $fillable =[
        'id_manifiesto',
        'id_cabecera'
    ];

    protected $guarded =[

    ];
}
