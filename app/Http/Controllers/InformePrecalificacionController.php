<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformePrecalificacionController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $entradaPcl = \DB::table('tbl_entrada')
                        ->where('procesoEntrada', 'PCL')->get();
        $tipoSolicitud = \DB::table('tbl_solicitud')
                        ->where('procesoSolicitud', 'PCL')->get();
        $estados = \DB::table('tbl_estado_siniestro')
                ->join('tbl_tipo_modulo', 'tbl_tipo_modulo.id_tipo_modulo', '=', 'tbl_estado_siniestro.llave_tipo_modulo')
                ->distinct()
                ->where('modulo', 'PCL')
                ->where('filtro', 'PRECALIFICACION')
                ->get(['estado_siniestro']);

        $usuarios = \DB::table('users')
                ->leftjoin('tbl_rol', 'tbl_rol.id_rol', '=', 'users.llaveRol_usuario')
                ->Where('rol', '=', 'PROFESIONAL')
                ->orderBy('name')
                ->get();

        return view('reportes.informePreCalificacion', compact('tipoSolicitud', 'entradaPcl', 'estados', 'usuarios'));
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
