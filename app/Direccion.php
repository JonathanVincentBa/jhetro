<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $table='direccion';

    protected $primaryKey='id_direccion';

    public $timestamps=true;

    protected $fillable =[
    	'id_ciudad',
    	'id_persona',
    	'descripcion'
    ];

    protected $guarded =[

    ];
}