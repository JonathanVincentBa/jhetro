<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formas_Pago extends Model
{
    protected $table='formas_pago';

    protected $primaryKey='id_formas_pago';

    public $timestamps=true;

    protected $fillable =[
    	'descripcion',
    	'estado'
    ];

    protected $guarded =[

    ];
}
