<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// ::::::::::::::
// 1. creo las rutas
 Route::get('/main', function () {
     return view('contenido/contenido');
 })->name('main');
route::get('plantilla', function () {
    return view('plantilla');
});


Route::get('/','Auth\LoginController@mostrarlogin');
Route::post('/login','Auth\LoginController@login')->name('login');
Route::post('/logout','Auth\LoginController@logout')->name('logout');

////////////////// TABLAS MAESTRAS ////////////////////////

////////////////////////////////////////////////(CLIENTES)
Route::get('clientes','ClienteControlles@index');
Route::get('getcli','ClienteControlles@getCli');
Route::post('/clientes/registrar','ClienteControlles@store');
Route::put('/clientes/actualizar','ClienteControlles@update');
Route::post('/clientes/eliminar','ClienteControlles@destroy');


////////////////////////////////////////////////(PRODUCTOS)
Route::get('productos','ProductoController@index');
////////////////////////////////////////////////////
Route::get('producto','ProductoController@index2');
Route::get('getproduc','ProductoController@getProduc');
/////////////////////////////////////////////////////
Route::post('/productos/registrar','ProductoController@store');
Route::put('/productos/actualizar','ProductoController@update');
Route::post('/productos/eliminar','ProductoController@destroy');


////////////////////////////////////////////////(CARGOS)
Route::get('cargos','CargoController@index');
Route::get('getcar','CargoController@getCar');
Route::post('/cargos/registrar','CargoController@store');
Route::put('/cargos/actualizar','CargoController@update');
Route::post('/cargos/eliminar','CargoController@destroy');

////////////////////////////////////////////////(TIPO INSUMOS)
Route::get('tipoinsumo','TipoInsumoController@index');
Route::get('gettip','TipoInsumoController@getTip');
Route::post('/tipoinsumo/registrar','TipoInsumoController@store');
Route::put('/tipoinsumo/actualizar','TipoInsumoController@update');
Route::post('/tipoinsumo/eliminar','TipoInsumoController@destroy');

////////////////////////////////////////////////(ENTRADA INVENTARIO)
Route::get('entradainventario','EntradaInventarioController@index');
Route::post('/entradainventario/registrar','EntradaInventarioController@store');
Route::put('/entradainventario/actualizar','EntradaInventarioController@update');
Route::post('/entradainventario/eliminar','EntradaInventarioController@destroy');

////////////////// TABLAS FORANEAS (1) ////////////////////////

////////////////////////////////////////////////(INSUMOS)
Route::get('insumos','InsumoController@index');
Route::post('/insumos/registrar','InsumoController@store');
Route::put('/insumos/actualizar','InsumoController@update');
Route::post('/insumos/eliminar','InsumoController@destroy');

////////////////////////////////////////////////(EMPLEADOS)

Route::get('empleados','EmpleadoController@index');
Route::get('getemp','EmpleadoController@getEmp');
Route::post('/empleados/registrar','EmpleadoController@store');
Route::put('/empleados/actualizar','EmpleadoController@update');
Route::post('/empleados/eliminar','EmpleadoController@destroy');


/////////////////////////////////////////////////////(PEDIDOS)
Route::get('pedidos','PedidoController@index2');
Route::get('getpedi','PedidoController@getPedi');
/////////////////////////////////////////////////////
Route::get('pedido','PedidoController@index');
Route::post('/pedido/registrar','PedidoController@store');

/////////////////////////////////////////////////////////(DETALLES PEDIDOS)
Route::get('detpedido','DetallePedidosController@index');

/////////////////////////////////////////////////////(FACTURAS)
Route::get('factura','FacturaController@index');
Route::post('/factura/registrar','FacturaController@store');

/////////////////////////////////////////////////////////(DETALLES PEDIDOS)
Route::get('detfactura','DetalleFacturasController@index');





