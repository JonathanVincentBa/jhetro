<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table='cargo';

    protected $primaryKey='id_cargo';

    public $timestamps=true;

    protected $fillable =[
    	'descripcion',
    	'estado'
    ];

    protected $guarded =[

    ];
}
