<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Sucursal;
use App\Acceso;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Session;
use Carbon\Carbon;

class PrincipalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sucursales = DB::table('sucursal as s')
            ->join('ciudad as c','s.id_ciudad',"=",'c.id_ciudad')
            ->select('s.id_sucursal', DB::raw('c.descripcion as ciudad'),'c.descripcion as ciu')
            ->where('s.estado', '=', '1')
            ->ORDERBY('s.id_sucursal','asc') 
            ->get();
        return view('principal.index', ["sucursales" => $sucursales]);
    }

    public function store(Request $request)
    {
        session(['key' => $request->get('sucursal')]);
        session(['sucursal'=>$request->get('select')]);
        
	    $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
	    $clientIP = request()->ip();
        $nombre = Auth::user()->name;
        $rol=Auth::user()->id;
        $ip = request()->getClientIp();
        $ip = DB::connection()->getPdo()->quote($ip); // the escaping part
        $post = DB::raw("inet_aton($ip)");
        //$post->save();
        $acceso=new Acceso;
        $acceso->id_user=$rol;
        $acceso->ip_client=$clientIP;
        $acceso->date=$date;
        $acceso->condicion="Ingreso";
        $acceso->save();
        //dd($post,$date,$nombre,$rol);
        return redirect('/admin');
        
    }
}