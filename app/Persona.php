<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table='persona';

    protected $primaryKey='id_persona';

    public $timestamps=true;

    protected $fillable =[
    	'id_empresa',
    	'id_cargo',
    	'tipo_persona',
    	'nombre',
		'direccion',
    	'tipo_dni',
    	'num_dni',
    	'telefono',
    	
    	'estado'
    ];

    protected $guarded =[

    ];
}
