<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbl_calendarios;
use App\User;

class MiAgendaController extends Controller {

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
        $id = auth()->user()->id;
        $calendario = tbl_calendarios::where('id', '=', $id)
                ->join('users', 'users.id', '=', 'tbl_calendarios.llaveMedico')
                ->join('tbl_horas_citas', 'tbl_horas_citas.idHorasCitas', '=', 'tbl_calendarios.llaveHoraCita')
                ->join('tbl_afiliados', 'tbl_afiliados.idAfiliado', '=', 'tbl_calendarios.llaveAfiliadoAgenda')
                ->join('tbl_horario_atencion_medicos', 'tbl_horario_atencion_medicos.llaveMedicoHorario', '=', 'users.id')
                ->join('tbl_ciudad', 'tbl_ciudad.id_ciudad', '=', 'tbl_horario_atencion_medicos.llaveCiudadAtencionMedico')
                ->join('tbl_tipo_consulta', 'tbl_tipo_consulta.idTipoConsulta', '=', 'tbl_calendarios.llaveTipoConsulta')
                ->get();
        return view('agendas.miAgenda', compact('calendario'));
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
