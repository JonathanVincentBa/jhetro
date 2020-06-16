<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motivo_Traslado extends Model
{
    protected $table='motivo_traslado';

    protected $primaryKey='id_motivo_traslado';

    public $timestamps=true;

    protected $fillable =[
    	'descripcion',
    	'estado'
    ];

    protected $guarded =[

    ];
}
