<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\tbl_horas_citas;
use App\tbl_horario_atencion_medico;
use App\tbl_union_horas_citas;

class GestionMediocoController extends Controller {

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



        $infoMedicoAgendas = \DB::table('users as u')
                ->join('tbl_horario_atencion_medicos as h', 'h.llaveMedicoHorario', '=', 'u.id')
                ->where('llaveRol_usuario', '=', '15')
                ->orwhere('llaveRol_usuario', '=', '12')
                ->where('llave_estado', '=', '1')
                ->paginate('10');

        return view('gestionMedico.gestionMedico', compact('infoMedicoAgendas'));
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


        $medicoInfo = User::where('id', '=', $id)
                ->join('tbl_rol', 'tbl_rol.id_rol', '=', 'users.llaveRol_usuario')
                ->join('tbl_horario_atencion_medicos', 'tbl_horario_atencion_medicos.llaveMedicoHorario', '=', 'users.id')
                ->join('tbl_ciudad', 'tbl_ciudad.id_ciudad', '=', 'tbl_horario_atencion_medicos.llaveCiudadAtencionMedico')
                ->firstOrFail();

        $horario = tbl_horas_citas::where('idHorasCitas', '=', function($query) use ($id) {
                    $query
                            ->select(\DB::raw("min(idHorasCitas) as idHorasCitas"))
                            ->from('users')
                            ->join('tbl_rol', 'tbl_rol.id_rol', '=', 'users.llaveRol_usuario')
                            ->join('tbl_union_horas_citas', 'tbl_union_horas_citas.llaveMedicoHoras', '=', 'users.id')
                            ->join('tbl_horas_citas', 'tbl_horas_citas.idHorasCitas', '=', 'tbl_union_horas_citas.llaveHorasTrabajo')
                            ->where('id', '=', $id);
                })->first();

        $horarioMax = tbl_horas_citas::where('idHorasCitas', '=', function($query) use ($id) {
                    $query
                            ->select(\DB::raw("max(idHorasCitas) as idHorasCitas"))
                            ->from('users')
                            ->join('tbl_rol', 'tbl_rol.id_rol', '=', 'users.llaveRol_usuario')
                            ->join('tbl_union_horas_citas', 'tbl_union_horas_citas.llaveMedicoHoras', '=', 'users.id')
                            ->join('tbl_horas_citas', 'tbl_horas_citas.idHorasCitas', '=', 'tbl_union_horas_citas.llaveHorasTrabajo')
                            ->where('id', '=', $id);
                })->first();

        $horas = \DB::table('tbl_horas_citas')->get();

        return view('gestionMedico.medico', compact('medicoInfo', 'horas', 'horario', 'horarioMax'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $medicoHorarrio = tbl_horario_atencion_medico::where('llaveMedicoHorario', '=', $id)->firstOrFail();
        $medicoHorarrio->fill($request->all());
        $medicoHorarrio->save();

        /* ====================Variables===================== */
        $desde = $request->input('TxtdesdeBase');
        $hasta = $request->input('TxtHastaBase');
        $desdeInsert = $request->input('TxtDesde');
        $hastaInsert = $request->input('Txthasta');


        if ($desde != $desdeInsert or $hasta != $hastaInsert) {
            /* =======================Consulta tipo de formulario=========================== */
            $consulUnion = \DB::table('tbl_union_horas_citas')->where('llaveMedicoHoras', $id)->pluck('llaveMedicoHoras');
            foreach ($consulUnion as $key => $tipoforma) {
                $tipoforma;
            }
            if ($tipoforma != NULL) {
                $peli = tbl_union_horas_citas::where('llaveMedicoHoras', '=', $id)->first();
                $peli->delete();
            }
            /* =======================Insert hora cita=========================== */

            $prueba = \DB::table('tbl_horas_citas')
                            ->whereBetween('idHorasCitas', array($desdeInsert, $hastaInsert))->get();

            $union = new tbl_union_horas_citas();
            foreach ($prueba as $v) {
                echo $v->idHorasCitas;
                $inserted = \DB::table('tbl_union_horas_citas')
                        ->insert([
                    'llaveHorasTrabajo' => $v->idHorasCitas,
                    'llaveMedicoHoras' => $id
                ]);
            }
        }
        return redirect('/GestionMedico/' . $id . '/edit');
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
