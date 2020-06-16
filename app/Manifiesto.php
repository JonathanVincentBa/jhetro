<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manifiesto extends Model
{
    protected $table='manifiesto';

    protected $primaryKey='id_manifiesto';

    public $timestamps=true;

    protected $fillable =[
        'id_vehiculo',
        'id_user',
        'valor',
    ];

    protected $guarded =[

    ];
}
