<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Cabecera;
use App\Detalle;
use App\User;
use\Illuminate\Support\Facades\Redirect;
use\App\Http\Requests\GuiaFormRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;

class CajaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        if ($request) 
        {
            $query = trim($request->get('searchText'));
            $guias = DB::table('cabecera as c')
                ->join('users as u','c.id_users','=','u.id')
                ->select('id_cabecera','c.id_users_update','c.num_guia','c.ciudad_origen','c.ciudad_destino','c.nom_remitente','c.created_at','c.valor_guia','u.name as name','c.estado','c.estatus_cobro')
                ->where([
                        ['c.num_guia', 'LIKE', '%' . $query . '%'],
                        ['c.estado','=','1'],
                        ['c.id_users_update','=','0']])
                ->orwhere([
                            ['c.nom_remitente', 'LIKE', '%' . $query . '%'],
                            ['c.estado','=','1'],
                            ['c.id_users_update','=','0']])
                ->orwhere([
                            ['c.nom_destinatario', 'LIKE', '%' . $query . '%'],
                            ['c.estado','=','1'],
                            ['c.id_users_update','=','0']])
                ->orderBy('c.created_at', 'asc')
                ->paginate(7);
            return view('caja.index', ["guias" => $guias, "searchText" => $query]);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usu= Auth::user()->id;
        $date= date("Y-m-d");
        $guias = DB::select('SELECT * FROM `cabecera` 
        WHERE date(fecha_cancelacion)="'.$date.'"
        AND id_users_update="'.$usu.'"');
        $suma=DB::select('SELECT SUM(c.valor_guia) as total
        FROM cabecera as c
        WHERE date(c.fecha_cancelacion)="'.$date.'"
        AND c.id_users_update="'.$usu.'"');
        return view('caja.create', ["guias" => $guias,"suma"=>$suma]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }
    public function admin(Request $request)
    {
        //Obtener los registros
        $usu = $request->get('usuario');
        $date = $request->get('fecha');
        $users = DB::table('users')
        ->where('id','=',$usu)
        ->get();

        $guias = DB::select('SELECT * FROM `cabecera` 
        WHERE date(fecha_cancelacion)="'.$date.'"
        AND id_users_update="'.$usu.'"');
        
        $suma=DB::select('SELECT SUM(c.valor_guia) as total
        FROM cabecera as c
        WHERE date(c.fecha_cancelacion)="'.$date.'"
        AND c.id_users_update="'.$usu.'"');
        
        $pdf = PDF::loadView('caja.reportes.admin',['users'=> $users,"guias"=> $guias,"suma"=>$suma, "date"=>$date]);
        return $pdf->download('CajaUsuario.pdf');
    }
    public function usuario(Request $request)
    {
        //Obtener los registros
        $users = DB::table('users')->get();
        $usu= Auth::user()->id;
        $date= date("Y-m-d");
        $guias = DB::select('SELECT * FROM `cabecera` 
        WHERE date(fecha_cancelacion)="'.$date.'"
        AND id_users_update="'.$usu.'"');
        $suma=DB::select('SELECT SUM(c.valor_guia) as total
        FROM cabecera as c
        WHERE date(c.fecha_cancelacion)="'.$date.'"
        AND c.id_users_update="'.$usu.'"');
        $pdf = PDF::loadView('caja.reportes.usuario',['users'=> $users,"guias"=> $guias,"suma"=>$suma]);
        return $pdf->download('CajaUsuario.pdf');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users=DB::table('users')
        ->where('id_rol', '=', 1)
        ->orWhere('id_rol','=', 2)
        ->get();
        return view('caja.show', ["users"=>$users]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detalles=DB::table('detalle')
            ->where('id_cabecera','=',$id)
            ->get();
        $forma_pago=DB::table('formas_pago')->get();
        $ciudades=DB::table('ciudad')->get();
        $sucursales=DB::table('sucursal as s')
        ->join('ciudad as c','c.id_ciudad','=','s.id_ciudad')
        ->select('c.descripcion')
        ->get();
        
        $personas=DB::table('persona')->get();
        //dd($cliente);
        return view("caja.edit",["cabecera"=>Cabecera::findOrFail($id),
                                 "detalles"=>$detalles,
                                 "forma_pago"=>$forma_pago,
                                 "ciudades"=>$ciudades,
                                 "sucursales"=>$sucursales,
                                 "personas"=>$personas
                                 ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try
        {
            DB::beginTransaction();
            $cabecera=Cabecera::findOrFail($id);
            $cabecera->recargo=$request->get('recargo');
            $cabecera->id_forma_pago=$request->get('id_formas_pago');
            $cabecera->id_persona=$request->get('id_persona');
            $cabecera->ciudad_origen=$request->get('ciudad_origen');
            $cabecera->ciudad_destino=$request->get('ciudad_destino');
            $cabecera->nota=$request->get('nota');
            $cabecera->num_guia=$request->get('num_guia');
            $cabecera->flete=$request->get('flete');
            $cabecera->prima=$request->get('prima');
            $cabecera->valor_guia=$request->get('valor_guia');
	    if ($request->get('id_formas_pago')==1) {
                $cabecera->estatus_cobro='Cancelado';
            }
            else
            {
                $cabecera->estatus_cobro='Pendiente';
            }
            $cabecera->update();
            $id_detalle= $request->get('id_detalle');
            $descripcion = $request->get('descripcion');
            $cantidad = $request->get('cantidad');
            $v_unitario = $request->get('v_unitario');
            $v_parcial = $request->get('v_parcial');
            $cont = 0;
            while ($cont < count($descripcion)) {
                $detalle = Detalle::findOrFail($id_detalle[$cont]);
                $detalle->descripcion = $descripcion[$cont];
                $detalle->cantidad = $cantidad[$cont];
                $detalle->v_unitario = $v_unitario[$cont];
                $detalle->v_parcial = $v_parcial[$cont];
                $detalle->update();
                $cont = $cont + 1;
            }
            DB::commit();
            Alert::success('Registro actualizado', '');
        }
        catch (Exception $e) {
            DB::rollBack();
            Alert::success('No se pudo guardar el registro', '');
        }
        return Redirect::to('caja');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cabecera=Cabecera::findOrFail($id);
        $cabecera->id_users_update = Auth::user()->id;
        $cabecera->estatus_cobro='Cancelado';
        $mytime = Carbon::now('America/Guayaquil');
        $cabecera->fecha_cancelacion = $mytime->toDateTimeString();
        $cabecera->update();
        Alert::success('Registro cancelado', '');
        return Redirect::to('caja');
    }
}