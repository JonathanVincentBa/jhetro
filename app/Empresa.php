<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table='empresa';

    protected $primaryKey='id_empresa';

    public $timestamps=true;

    protected $fillable =[
    	'razon_social',
    	'ruc',
    	'direccion',
    	'telefono',
    	'email',
    	'representante',
    	'logo'
    ];

    protected $guarded =[

    ];
}
