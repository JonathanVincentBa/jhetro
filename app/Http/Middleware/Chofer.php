<?php

namespace App\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;

use Closure;

class Chofer
{
     protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        if($this->auth->user()->id_rol == 1 || $this->auth->user()->id_rol == 2||$this->auth->user()->id_rol == 3)
        {
            return $next($request); 
        }
        else
        {
            return redirect()->to('401');
        }
    }
}
