<?php



Auth::routes();

Route::group(['middleware' => ['guest']], function () {
    Route::get('/', function () {
    	return view('auth.login');
	});
});

Route::group(['middleware' => ['auth']], function () {

	Route::resource('/principal', 'PrincipalController');
	Route::get('/admin', 'AdminController@index');

	Route::resource('/home', 'HomeController');

	Route::get('/401', function () {
    	return view('errors/401');
	});

	Route::get('/404', function () {
    	return view('errors/401');
	});

	Route::group(['middleware' => ['Administrador']], function () {
		

		Route::resource('mantenimiento/empresa','EmpresaController');
		Route::resource('mantenimiento/sucursal','SucursalController');
		Route::resource('mantenimiento/ciudad','CiudadController');
		Route::resource('mantenimiento/cargo','CargoController');
		Route::resource('mantenimiento/motivo_traslado','Motivo_TrasladoController');
		Route::resource('mantenimiento/formas_pago','Formas_PagoController');

		
		Route::resource('seguridad/empleado','EmpleadoController');
		Route::resource('seguridad/usuario','UsuarioController');

		Route::post('caja/reportes/admin','CajaController@admin');
	});

	Route::group(['middleware' => ['Chofer']], function () {
		
		Route::resource('bodega/entrega','EntregaController');
		
	});

	Route::group(['middleware' => ['Cliente']], function () {
		Route::resource('buscar_guia/cliente','BuscarGuiaController');
	});

	Route::group(['middleware' => ['Secretaria']], function () {

		Route::resource('personas/cliente','ClienteController');
		Route::get('reporteclientes','ClienteController@reporte');
		

		Route::get('ventas/guia/create/{id}/cliente','ClienteController@byCiudad');
		Route::resource('ventas/guia','GuiaController');

		Route::resource('editar_guia/recargo','EditarGuiaController');
		Route::resource('editar_guia/editarCliente','EditarGuiaClienteController');

		

		Route::get('reporteguia/{id}', 'PdfController@reporteGuia');
		
		Route::get('reporteguia/{id}', 'PdfController@reporteGuia');

		Route::get('reporteempleados','EmpleadoController@reporteEmpleados');
		

		Route::get('controlpersonal','ControlPersonalController@index');
		Route::post('controlpersonal/todosEmpleados','ControlPersonalController@todosEmpleados');
		Route::post('controlpersonal/porEmpleado','ControlPersonalController@porEmpleado');

		Route::resource('reportes/clientes', 'ClientesReporteController');
		Route::post('reportes/clientes/xfacturar1','ClientesReporteController@reporteXfacturar1');
		Route::post('reportes/clientes/xfacturar_excel','ClientesReporteController@reporteXfacturar_excel');
		Route::post('reportes/clientes/xfacturarCanceladas','ClientesReporteController@reporteXfacturarCanceladas');
		Route::post('reportes/clientes/xfacturarxPagar','ClientesReporteController@reporteXfacturarxPagar');
		Route::post('reportes/clientes/xfacturarxPagarTodos','ClientesReporteController@reporteXfacturarxPagarTodos');
		Route::post('reportes/clientes/xTodasFormasPago','ClientesReporteController@reporteXTodasFormasPago');

		Route::resource('reportes/mensual', 'MensualesReporteController');
		Route::post('reportes/mensual/xciudadExcel','MensualesReporteController@reporteXciudadExcel');
		Route::post('reportes/mensual/xenvioExcel','MensualesReporteController@reporteXenvioExcel');
		Route::post('reportes/mensual/guiasAnuladas','MensualesReporteController@reporteGuiasAnuladas');

		Route::resource('reportes/varios', 'VariosReporteController');
		Route::post('reportes/varios/xenvio','VariosReporteController@reporteXenvio');
		Route::post('reportes/varios/xciudad','VariosReporteController@reporteXciudad');
		Route::post('reportes/varios/xpagar','VariosReporteController@reporteXpagar');
		Route::post('reportes/varios/xpagarExcel','VariosReporteController@reporteXpagarExcel');
		Route::post('reportes/varios/pagado','VariosReporteController@reportePagado');
		Route::post('reportes/varios/cierreDiarios','VariosReporteController@reporteCierresDiarios');
		Route::post('reportes/varios/xfacturarCancelada','VariosReporteController@reporteXfacturarCanceladas');
		Route::post('reportes/varios/xfacturarxPagar','VariosReporteController@reporteXfacturarxPagar');

		Route::resource('caja','CajaController');
		Route::post('caja/reportes/usuario','CajaController@usuario');
	});



    

});




	






