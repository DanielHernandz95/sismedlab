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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('crearPcl', 'CrearPclController');
Route::resource('Siniestro', 'CrearPclController');
Route::resource('PreCalificacion', 'PrecalificacionController');
Route::resource('Calificacion', 'CalificacionController');
Route::get('Bandeja', 'BandejaController@index')->name('Bandeja');
Route::resource('Agendas', 'AgendaController');
Route::resource('MiAgenda', 'MiAgendaController');
Route::resource('Cargue', 'CargueController');
Route::resource('GestionMedico', 'GestionMediocoController');
Route::resource('Informe', 'InformeController');
Route::post('Informe', 'InformeController@index')->name('Informe');
Route::resource('ReCalificacion', 'RecalificacionController');
Route::post('Cargue', 'CargueController@index')->name('Cargue');
Route::get('Bandeja/getSiniestro', 'BandejaController@getSiniestro')->name('Bandeja.getSiniestro');
Route::resource('InformeReCalificacion', 'InformeReCalificacionController');
Route::post('InformeReCalificacion', 'InformeReCalificacionController@index')->name('InformeReCalificacion');
Route::resource('InformeCalificacion', 'InformeCalificacionController');
Route::post('InformeCalificacion', 'InformeCalificacionController@index')->name('InformeCalificacion');
Route::resource('InformePreCalificacion', 'InformePrecalificacionController');
Route::post('InformePreCalificacion', 'InformePrecalificacionController@index')->name('InformePreCalificacion');
Route::resource('InformeDias', 'InformeDiasController');
Route::post('InformeDias', 'InformeDiasController@index')->name('InformeDias');
Route::resource('InformeAdicion', 'InformeAdicionController');
Route::post('InformeAdicion', 'InformeAdicionController@index')->name('InformeAdicion');
Route::get('SolicitudDocumentos', 'CartasController@index')->name('SolicitudDocumentos');
Route::get('SolicitudDocumentos/getCartas', 'CartasController@getCartas')->name('SolicitudDocumentos.getCartas');
Route::get('TramiteAdministrativo', 'TramiteAdministrativoController@index')->name('TramiteAdministrativo');
Route::get('TramiteAdministrativo/getTramite', 'TramiteAdministrativoController@getTramite')->name('TramiteAdministrativo.getTramite');
Route::get('/test', 'EmailSendController@index')->name('test');
Route::get('contactar', 'EmailSendController@contact')->name('contact');
Route::resource('crearAdicion', 'AdicionDxController');
Route::resource('Adicion', 'AdicionDxController');
Route::resource('UltimaArl', 'UltimaArlController');
Route::resource('CartaNegacion', 'CartaNegacionController');
Route::resource('FormatoNegacion', 'FormatoNegacionController');
Route::resource('GestionUsuarios', 'UsuariosController');
Route::resource('FormatoNegacionAdicion', 'FormatoNegacionAdicionController');
Route::resource('CartaNegacionAdicion', 'CartaNegacionAdicionController');
Route::resource('/Graficas', 'GraficasController');
Route::post('Graficas', 'GraficasController@index')->name('Graficas');
/* =====================================Rutas EL ================================== */
Route::resource('CrearEl', 'SiniestroElController');
Route::resource('Siniestro_El', 'SiniestroElController');
Route::resource('Calificacion_El', 'CalificacionElController');
Route::resource('PreCalificacion_El', 'PrecalificacionElController');
Route::get('Bandeja_El', 'BandejaElController@index')->name('Bandeja_El');
Route::get('Bandeja_El/getSiniestro', 'BandejaElController@getSiniestro')->name('Bandeja_El.getSiniestro');
Route::resource('Cargue_El', 'CargueElController');
Route::post('Cargue_El', 'CargueElController@index')->name('Cargue_El');
Route::get('Pruebas', 'PruebasElController@index')->name('Pruebas');
Route::get('Pruebas/getPrueba', 'PruebasElController@getPrueba')->name('Pruebas.getPrueba');
Route::resource('CargueCuida', 'CargueCuidaController');
Route::post('CargueCuida', 'CargueCuidaController@index')->name('CargueCuida');
Route::get('BandejaCuida', 'CuidaUnoElController@index')->name('BandejaCuida');
Route::get('BandejaCuida/getCuidaUno', 'CuidaUnoElController@getCuidaUno')->name('BandejaCuida.getCuidaUno');