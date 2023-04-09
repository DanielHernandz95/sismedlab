<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbl_calendarios;
use App\User;

class AgendaController extends Controller {

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


        $calendario = tbl_calendarios::orderBy('idcalendario', 'DESC')
                ->leftjoin('users', 'users.id', '=', 'tbl_calendarios.llaveMedico')
                ->leftjoin('tbl_horas_citas', 'tbl_horas_citas.idHorasCitas', '=', 'tbl_calendarios.llaveHoraCita')
                ->leftjoin('tbl_afiliados', 'tbl_afiliados.idAfiliado', '=', 'tbl_calendarios.llaveAfiliadoAgenda')
                ->leftjoin('tbl_horario_atencion_medicos', 'tbl_horario_atencion_medicos.llaveMedicoHorario', '=', 'users.id')
                ->leftjoin('tbl_ciudad', 'tbl_ciudad.id_ciudad', '=', 'tbl_horario_atencion_medicos.llaveCiudadAtencionMedico')
                ->leftjoin('tbl_tipo_consulta', 'tbl_tipo_consulta.idTipoConsulta', '=', 'tbl_calendarios.llaveTipoConsulta')
                ->get();

        $medico = \DB::table('users')
                        ->leftjoin('tbl_rol', 'tbl_rol.id_rol', '=', 'users.llaveRol_usuario')
                        ->join('tbl_horario_atencion_medicos', 'tbl_horario_atencion_medicos.llaveMedicoHorario', '=', 'users.id')
                        ->leftjoin('tbl_ciudad', 'tbl_ciudad.id_ciudad', '=', 'tbl_horario_atencion_medicos.llaveCiudadAtencionMedico')
                        ->where('rol', '=', 'CALIFICADOR_ADSCRITO')
                        ->orwhere('rol', '=', 'CALIFICADOR')->get();

        $tipoConsultas = \DB::table('tbl_tipo_consulta')->get();


        return view('agendas.agenda', compact('calendario', 'medico', 'tipoConsultas'));
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
        $calendario = tbl_calendarios::where('id', '=', $id)
                ->leftjoin('users', 'users.id', '=', 'tbl_calendarios.llaveMedico')
                ->leftjoin('tbl_horas_citas', 'tbl_horas_citas.idHorasCitas', '=', 'tbl_calendarios.llaveHoraCita')
                ->leftjoin('tbl_afiliados', 'tbl_afiliados.idAfiliado', '=', 'tbl_calendarios.llaveAfiliadoAgenda')
                ->leftjoin('tbl_horario_atencion_medicos', 'tbl_horario_atencion_medicos.llaveMedicoHorario', '=', 'users.id')
                ->leftjoin('tbl_ciudad', 'tbl_ciudad.id_ciudad', '=', 'tbl_horario_atencion_medicos.llaveCiudadAtencionMedico')
                ->leftjoin('tbl_tipo_consulta', 'tbl_tipo_consulta.idTipoConsulta', '=', 'tbl_calendarios.llaveTipoConsulta')
                ->get();

        $medico = \DB::table('users')
                        ->leftjoin('tbl_rol', 'tbl_rol.id_rol', '=', 'users.llaveRol_usuario')
                        ->leftjoin('tbl_horario_atencion_medicos', 'tbl_horario_atencion_medicos.llaveMedicoHorario', '=', 'users.id')
                        ->leftjoin('tbl_ciudad', 'tbl_ciudad.id_ciudad', '=', 'tbl_horario_atencion_medicos.llaveCiudadAtencionMedico')
                        ->where('rol', '=', 'CALIFICADOR_ADSCRITO')
                        ->orwhere('rol', '=', 'CALIFICADOR')->get();


        $nombre = User::where('id', '=', $id)
                ->firstOrFail();


        $tipoConsultas = \DB::table('tbl_tipo_consulta')->get();

        return view('agendas.agendaMedico', compact('calendario', 'medico', 'tipoConsultas', 'nombre'));
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
