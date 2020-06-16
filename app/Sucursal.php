<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
	protected $table='sucursal';

	protected $primaryKey='id_sucursal';

	public $timestamps=true;

	protected $fillable=[
		'id_empresa',
		'id_ciudad',
		'direccion',
		'telefono',
		'email'
	];

    protected $guarded =[

    ];
}
