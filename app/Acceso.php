<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acceso extends Model
{
    protected $table='acceso';

    protected $primaryKey='id_acceso';

    public $timestamps=false;

    protected $fillable=[
        'id_user',
        'ip_client',
        'date',
        'condicion'
    ];

    protected $guarded=[

    ];
}
