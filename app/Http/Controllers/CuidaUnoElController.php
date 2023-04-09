<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CuidaUnoElController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('moduloEl.admin.bandejas.cuidaUno');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function getCuidaUno() {

        $usuarioId = auth()->user()->id;
        $usuarioRol = auth()->user()->llaveRol_usuario;

        $bandejaEstadoDos = \DB::table('tbl_el_siniestros as s')
                ->select(['id_elSiniestro', 'numeroSiniestro', 'entrada', 'fechaCreacionSiiestroEl AS fecha', 'documento', 'solicitud',  'fechaRadicadoArlPositiva', 'covid',  'llaveUnionCasosCuida','llaveCalificacionEl','llavePrecalificacionEl'])
                ->selectRaw('datediff(now() , fechaRadicadoArlPositiva)  as dias')
                ->leftjoin('tbl_afiliados as af', 'af.idAfiliado', '=', 's.llaveAfiliadoEl')
                ->leftjoin('tbl_solicitud as so', 'so.id_solicitud', '=', 's.llaveTipoSolicitudEl')
                ->leftjoin('tbl_entrada as en', 'en.id_entrada', '=', 's.llaveCanlaEntradaEl')
                ->leftjoin('tbl_covid as co', 'co.idCovid', '=', 's.llaveCovid');
              




        if ($usuarioRol == 19) {
            $query = \DB::table(\DB::raw("({$bandejaEstadoDos->toSql()}) as x"))
                            ->select(['id_elSiniestro', 'numeroSiniestro', 'entrada', 'fecha', 'documento', 'solicitud', 'fechaRadicadoArlPositiva', 'covid',  'dias', 'llaveUnionCasosCuida','llaveCalificacionEl','llavePrecalificacionEl'])
                            ->where(function ($query) {
                                $query->Where('llaveCalificacionEl', '=', NULL)
                                ->Where('llavePrecalificacionEl', '=', NULL);
                            })->Where('entrada', '=', 'BANDEJA CUIDA 1');
        } else {
            $query = \DB::table(\DB::raw("({$bandejaEstadoDos->toSql()}) as x"))
                            ->select(['id_elSiniestro', 'numeroSiniestro', 'entrada', 'fecha', 'documento', 'solicitud', 'estado_siniestro', 'name', 'fechaRadicadoArlPositiva', 'covid',  'dias','llaveCalificacionEl','llavePrecalificacionEl'])
                            ->where(function ($query) {
                                $query->Where('llavePrecalificacionEl', '=', NULL)
                                ->Where('llaveCalificacionEl', '=', NULL);
                            })->Where('entrada', '=', 'BANDEJA CUIDA 1')->Where('id', '=', $usuarioId);
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
