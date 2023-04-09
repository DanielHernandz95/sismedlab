<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PruebasElController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('moduloEl.admin.bandejas.pruebas');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    
       public function getPrueba() {

        $usuarioId = auth()->user()->id;
        $usuarioRol = auth()->user()->llaveRol_usuario;

        $bandejaEstadoDos = \DB::table('tbl_el_siniestros as s')
                ->select(['id_elSiniestro', 'numeroSiniestro', 'entrada', 'fechaCreacionSiiestroEl AS fecha', 'documento', 'solicitud', 'estado_siniestro', 'name', 'fechaRadicadoArlPositiva', 'covid'])
                ->leftjoin('tbl_afiliados as af', 'af.idAfiliado', '=', 's.llaveAfiliadoEl')
                ->leftjoin('tbl_solicitud as so', 'so.id_solicitud', '=', 's.llaveTipoSolicitudEl')
                ->leftjoin('tbl_entrada as en', 'en.id_entrada', '=', 's.llaveCanlaEntradaEl')
                ->leftjoin('tbl_covid as co', 'co.idCovid', '=', 's.llaveCovid')
                ->leftjoin('tbl_el_calificaciones as c', 'c.idElCalificaciones', '=', 's.llaveCalificacionEl')
                ->leftjoin('tbl_estado_siniestro as e', 'e.id_estado_siniestro', '=', 'c.llaveEstadoElCalificacion')
                ->leftjoin('users as up', 'up.id', '=', 'c.llaveUsuarioCalificadorEl');

  



        if ($usuarioRol == 19) {
            $query = \DB::table(\DB::raw("({$bandejaEstadoDos->toSql()}) as x"))
                    ->select(['id_elSiniestro', 'numeroSiniestro', 'entrada', 'fecha', 'documento', 'solicitud', 'estado_siniestro', 'name', 'fechaRadicadoArlPositiva', 'covid'])
                    ->where(function ($query) {
                $query->Where('estado_siniestro', '=', 'SOLICITUD DE PRUEBAS');
            });
        } else {
            $query = \DB::table(\DB::raw("({$bandejaEstadoDos->toSql()}) as x"))
                            ->select(['id_elSiniestro', 'numeroSiniestro', 'entrada', 'fecha', 'documento', 'solicitud', 'estado_siniestro', 'name', 'fechaRadicadoArlPositiva', 'covid'])
                            ->where(function ($query) {
                                $query->Where('estado_siniestro', '=', 'SOLICITUD DE PRUEBAS');
                            })->Where('id', '=', $usuarioId);
        }

        return Datatables()->of($query)->toJson();
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
