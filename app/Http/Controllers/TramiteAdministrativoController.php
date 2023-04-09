<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbl_calendarios;
use App\tbl_siniestro_pcl;

class TramiteAdministrativoController extends Controller {

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
        $a = auth()->user()->id;

        $infoSiniestro = tbl_siniestro_pcl::orderBy('idSiniestroPcl', 'DESC')
                ->join('tbl_afiliados', 'tbl_afiliados.idAfiliado', '=', 'tbl_siniestro_pcls.llaveAfiliado')
                ->leftjoin('tbl_empresas', 'tbl_empresas.id_empresa', '=', 'tbl_siniestro_pcls.llaveEmpresaPcl')
                ->join('tbl_entrada', 'tbl_entrada.id_entrada', '=', 'tbl_siniestro_pcls.llaveCanalEntrada')
                ->join('tbl_quien_solicita', 'tbl_quien_solicita.id_quien_solicita', '=', 'tbl_siniestro_pcls.llaveQuienSolicita')
                ->leftjoin('tbl_solicitud', 'tbl_solicitud.id_solicitud', '=', 'tbl_siniestro_pcls.llaveTipoSolicitud')
                ->join('tbl_tipo_evento', 'tbl_tipo_evento.id_tipo_evento', '=', 'tbl_siniestro_pcls.llaveTipoEvento')
                ->paginate('10');
        return view('tramiteAdministrativo.tramiteAdministrativo', compact('infoSiniestro'));
    }

    public function getTramite() {

        $usuarioId = auth()->user()->id;
        $usuarioRol = auth()->user()->llaveRol_usuario;

        $preCali = \DB::table('tbl_siniestro_pcls')
                ->select(['idSiniestroPcl', 'idSiniestro', 'entrada', 'fechaAsignacionProfesionalPreCali AS fecha', 'documento', 'solicitud', 'tipo_evento', 'estado_siniestro', 'sub_estados', 'name', 'id', 'tipoGestionPreca AS  p'])
                ->join('tbl_afiliados', 'tbl_afiliados.idAfiliado', '=', 'tbl_siniestro_pcls.llaveAfiliado')
                ->join('tbl_entrada', 'tbl_entrada.id_entrada', '=', 'tbl_siniestro_pcls.llaveCanalEntrada')
                ->join('tbl_quien_solicita', 'tbl_quien_solicita.id_quien_solicita', '=', 'tbl_siniestro_pcls.llaveQuienSolicita')
                ->join('tbl_solicitud', 'tbl_solicitud.id_solicitud', '=', 'tbl_siniestro_pcls.llaveTipoSolicitud')
                ->join('tbl_tipo_evento', 'tbl_tipo_evento.id_tipo_evento', '=', 'tbl_siniestro_pcls.llaveTipoEvento')
                ->join('tbl_precalificaciones', 'tbl_precalificaciones.idPrecalificacion', '=', 'tbl_siniestro_pcls.llavePrecalificacion')
                ->join('tbl_estado_siniestro as epc', 'epc.id_estado_siniestro', '=', 'tbl_precalificaciones.llaveEstadoPrecalificacion')
                ->leftjoin('tbl_sub_estados as sb', 'sb.id_sub_estados', '=', 'tbl_precalificaciones.llaveSubEstadoPrecalificacion')
                ->join('users as up', 'up.id', '=', 'tbl_precalificaciones.llaveCalificador');

        $reca = \DB::table('tbl_siniestro_pcls')
                ->select(['idSiniestroPcl', 'idSiniestro', 'entrada', 'fechaAsigProfesionalRecali AS fecha', 'documento', 'solicitud', 'tipo_evento', 'estado_siniestro', 'sub_estados', 'name', 'id', 'TipoGestionReCalificacion AS  p'])
                ->join('tbl_afiliados', 'tbl_afiliados.idAfiliado', '=', 'tbl_siniestro_pcls.llaveAfiliado')
                ->join('tbl_entrada', 'tbl_entrada.id_entrada', '=', 'tbl_siniestro_pcls.llaveCanalEntrada')
                ->join('tbl_quien_solicita', 'tbl_quien_solicita.id_quien_solicita', '=', 'tbl_siniestro_pcls.llaveQuienSolicita')
                ->join('tbl_solicitud', 'tbl_solicitud.id_solicitud', '=', 'tbl_siniestro_pcls.llaveTipoSolicitud')
                ->join('tbl_tipo_evento', 'tbl_tipo_evento.id_tipo_evento', '=', 'tbl_siniestro_pcls.llaveTipoEvento')
                ->join('tbl_recalificacion_pcls as rc', 'rc.idRecalificacionPcls', '=', 'tbl_siniestro_pcls.llaveRecalificacion')
                ->join('tbl_estado_siniestro as epc', 'epc.id_estado_siniestro', '=', 'rc.llaveEstadoRecalificacion')
                ->leftjoin('tbl_sub_estados as sb', 'sb.id_sub_estados', '=', 'rc.llaveSubEstadoRecalificacion')
                ->join('users as ur', 'ur.id', '=', 'rc.llaveCalificadorRecalificacion');

        $union = \DB::table('tbl_siniestro_pcls as s')
                ->select(['idSiniestroPcl', 'idSiniestro', 'entrada', 'fechaAsignacionProfesionalCali AS fecha', 'documento', 'solicitud', 'tipo_evento', 'estado_siniestro', 'sub_estados', 'name', 'id', 'tipoGestionCalificacion AS  p'])
                ->join('tbl_afiliados', 'tbl_afiliados.idAfiliado', '=', 's.llaveAfiliado')
                ->join('tbl_entrada', 'tbl_entrada.id_entrada', '=', 's.llaveCanalEntrada')
                ->join('tbl_quien_solicita', 'tbl_quien_solicita.id_quien_solicita', '=', 's.llaveQuienSolicita')
                ->join('tbl_solicitud', 'tbl_solicitud.id_solicitud', '=', 's.llaveTipoSolicitud')
                ->join('tbl_tipo_evento', 'tbl_tipo_evento.id_tipo_evento', '=', 's.llaveTipoEvento')
                ->join('tbl_califiaciones as c', 'c.idCalifiacion', '=', 's.llaveCalificacion')
                ->join('tbl_estado_siniestro as epc', 'epc.id_estado_siniestro', '=', 'c.llaveEstadoCalificacion')
                ->leftjoin('tbl_sub_estados as sb', 'sb.id_sub_estados', '=', 'c.llaveSubEstadoCalificacion')
                ->join('users as uc', 'uc.id', '=', 'c.llaveCalificadorCalifiacion')
                ->unionAll($preCali)
                ->unionAll($reca);


        if ($usuarioRol == 11 || $usuarioRol == 14 || $usuarioRol == 17) {
            $query = \DB::table(\DB::raw("({$union->toSql()}) as x"))
                    ->select(['idSiniestroPcl', 'idSiniestro', 'entrada', 'fecha', 'documento', 'solicitud', 'tipo_evento', 'estado_siniestro', 'sub_estados', 'name', 'id', 'p'])
                    ->where(function ($query) {
                $query->where('estado_siniestro', '=', 'TRAMITE ADMINISTRATIVO');
            });
        } else {
            $query = \DB::table(\DB::raw("({$union->toSql()}) as x"))
                            ->select(['idSiniestroPcl', 'idSiniestro', 'entrada', 'fecha', 'documento', 'solicitud', 'tipo_evento', 'estado_siniestro', 'sub_estados', 'name', 'id', 'p'])
                            ->where(function ($query) {
                                $query->where('estado_siniestro', '=', 'TRAMITE ADMINISTRATIVO');
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
