<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table='users';

	protected $primaryKey='id';

	public $timestamps=true;
    
    protected $fillable = [
       'id_rol', 'id_persona', 'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
