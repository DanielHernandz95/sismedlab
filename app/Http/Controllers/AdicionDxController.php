<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbl_afiliado;
use App\tbl_siniestro_pcl;
use App\tbl_seguimiento;
use App\tbl_empresa;
use App\User;
use App\tbl_califiaciones;
use App\tbl_adicionpcl;
use App\tbl_recalificacion_pcl;
use App\tbl_observacion_pcl_s;
use App\tbl_traza;

class AdicionDxController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
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

        $adicion = new tbl_adicionpcl();

        $adicion->llaveCanalEntradaAdiPcl = $request->input('llaveCanalEntradaAdiPcl');
        $adicion->LlaveQuienSoliAdiPcl = $request->input('LlaveQuienSoliAdiPcl');
        $adicion->LlavetipoSoliAdiPcl = '6';
        $adicion->llaveTipoEventoAdiPcl = $request->input('llaveTipoEventoAdiPcl');
        $adicion->fechaAsigClienteAdiconPcl = $request->input('fechaAsigClienteAdiconPcl');
        $adicion->llaveSiniestroAdicionPcl = $request->input('llaveSiniestroAdicionPcl');
        $adicion->llaveUsuarioAsigAdiPcl = $request->input('llaveUsuarioAsigAdiPcl');
        $adicion->llaveEstadoAdicion = '1';
        //$adicion->fechaEventoAdcion = $request->input('');
        $adicion->pqrAdicion = $request->input('pqrAdicion');
        $adicion->otrosAdicion = $request->input('otrosAdicion');

        $adicion->llaveUsuarioCreadorAdicion = $request->input('llaveUsuarioCreadorAdicion');


        $adicion->save();

        $idAdicion = $adicion->idAdicionPcl;


        /* ==================================================== */
        // --===================Traza empreza==================--
        /* ==================================================== */

        $traza = new tbl_traza();
        $traza->tipo = 'CREACION DE ADICION';
        $traza->llaveAdicionPclUnion = $idAdicion;
        $traza->llaveUserPcTtraza = $request->input('llaveUsuarioCreadorAdicion');
        $traza->save();

        $traza1 = new tbl_traza();
        $traza1->tipo = 'CREACION DE ADICION';
        $traza1->llaveSiniestroPclUnion = $request->input('llaveSiniestroAdicionPcl');
        ;
        $traza1->llaveUserPcTtraza = $request->input('llaveUsuarioCreadorAdicion');
        $traza1->save();

        return redirect('/Adicion/' . $idAdicion . '/edit');
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

        $entradaPcl = \DB::table('tbl_entrada')
                        ->where('procesoEntrada', 'PCL')->get();

        $tipoSolicitud = \DB::table('tbl_solicitud')
                        ->where('procesoSolicitud', 'PCL')->get();

        $tipoEvento = \DB::table('tbl_tipo_evento')
                        ->where('tipo_evento', '<>', 'PCL')->get();

        $usuarios = \DB::table('users')
                ->leftjoin('tbl_rol', 'tbl_rol.id_rol', '=', 'users.llaveRol_usuario')
                ->where('rol', '=', 'COORDINADOR')
                ->orWhere('rol', '=', 'CALIFICADOR')
                ->orWhere('rol', '=', 'PROFESIONAL')
                ->orWhere('rol', '=', 'AUXILIAR_ADMINISTRATIVO')
                ->orWhere('rol', '=', 'CALIFICADOR_ADSCRITO')
                ->orderBy('name')
                ->get();

        $medicoAsignar = \DB::table('users')
                        ->leftjoin('tbl_rol', 'tbl_rol.id_rol', '=', 'users.llaveRol_usuario')
                        ->orderBy('name')
                        ->where('rol', '=', 'CALIFICADOR')
                        ->orWhere('rol', '=', 'CALIFICADOR_ADSCRITO')
                        ->orWhere('rol', '=', 'PROFESIONAL')->get();

        $diagnosticos = \DB::table('tbl_cie_10')->get();

        $origenDiagnostico = \DB::table('tbl_origen_diagnostico_adicional')->get();

        $estados = \DB::table('tbl_estado_siniestro')
                ->leftjoin('tbl_tipo_modulo', 'tbl_tipo_modulo.id_tipo_modulo', '=', 'tbl_estado_siniestro.llave_tipo_modulo')
                ->where('modulo', 'PCL')
                ->where('filtro', 'ADICION')
                ->get();

        $estadosCali = \DB::table('tbl_estado_siniestro')
                        ->leftjoin('tbl_tipo_modulo', 'tbl_tipo_modulo.id_tipo_modulo', '=', 'tbl_estado_siniestro.llave_tipo_modulo')
                        ->where('modulo', 'PCL')
                        ->where('filtro', 'CALIFICACION')->get();

        $estadosReCali = \DB::table('tbl_estado_siniestro')
                        ->leftjoin('tbl_tipo_modulo', 'tbl_tipo_modulo.id_tipo_modulo', '=', 'tbl_estado_siniestro.llave_tipo_modulo')
                        ->where('modulo', 'PCL')
                        ->where('filtro', 'RECALIFICACION')->get();

        $infoSiniestro = tbl_adicionpcl::where('idAdicionPcl', '=', $id)
                ->leftjoin('tbl_siniestro_pcls', 'tbl_siniestro_pcls.idSiniestroPcl', '=', 'tbl_adicionpcls.llaveSiniestroAdicionPcl')
                ->leftjoin('tbl_afiliados', 'tbl_afiliados.idAfiliado', '=', 'tbl_siniestro_pcls.llaveAfiliado')
                ->leftjoin('tbl_departamento', 'tbl_departamento.id_departamento', '=', 'tbl_afiliados.llaveDepartamento')
                ->leftjoin('tbl_tipo_docuemtno', 'tbl_tipo_docuemtno.id_tipo_docuemtno', '=', 'tbl_afiliados.llaveTipoDocumento')
                ->leftjoin('tbl_empresas', 'tbl_empresas.id_empresa', '=', 'tbl_siniestro_pcls.llaveEmpresaPcl')
                ->leftjoin('tbl_entrada', 'tbl_entrada.id_entrada', '=', 'tbl_adicionpcls.llaveCanalEntradaAdiPcl')
                ->leftjoin('tbl_quien_solicita', 'tbl_quien_solicita.id_quien_solicita', '=', 'tbl_adicionpcls.LlaveQuienSoliAdiPcl')
                ->leftjoin('tbl_solicitud', 'tbl_solicitud.id_solicitud', '=', 'tbl_adicionpcls.LlavetipoSoliAdiPcl')
                ->leftjoin('tbl_tipo_evento', 'tbl_tipo_evento.id_tipo_evento', '=', 'tbl_adicionpcls.llaveTipoEventoAdiPcl')
                ->leftjoin('users as u', 'u.id', '=', 'tbl_adicionpcls.llaveUsuarioAsigAdiPcl')
                ->leftjoin('tbl_estado_siniestro as es', 'es.id_estado_siniestro', '=', 'tbl_adicionpcls.llaveEstadoAdicion')
                ->leftjoin('tbl_sub_estados as sbs', 'sbs.id_sub_estados', '=', 'tbl_adicionpcls.llaveSubEstadoAdicion')
                ->select('*', \DB::raw('tbl_adicionpcls.updated_at as fechaGestionAdicion'))
                ->firstOrFail();




        $clf = tbl_adicionpcl::where('idAdicionPcl', '=', $id)
                ->leftjoin('tbl_siniestro_pcls', 'tbl_siniestro_pcls.idSiniestroPcl', '=', 'tbl_adicionpcls.llaveSiniestroAdicionPcl')
                ->leftjoin('tbl_califiaciones as c', 'c.idCalifiacion', '=', 'tbl_adicionpcls.llaveCalificacionAdcion')
                ->leftjoin('tbl_estado_siniestro as epc', 'epc.id_estado_siniestro', '=', 'c.llaveEstadoCalificacion')
                ->leftjoin('tbl_sub_estados as sb', 'sb.id_sub_estados', '=', 'c.llaveSubEstadoCalificacion')
                ->leftjoin('users as u', 'u.id', '=', 'c.llaveCalificadorCalifiacion')
                ->select('*', \DB::raw('c.updated_at as fechaGestionCali'))
                ->firstOrFail();

        $reClf = tbl_adicionpcl::where('idAdicionPcl', '=', $id)
                ->leftjoin('tbl_siniestro_pcls', 'tbl_siniestro_pcls.idSiniestroPcl', '=', 'tbl_adicionpcls.llaveSiniestroAdicionPcl')
                ->leftjoin('tbl_recalificacion_pcls as rc', 'rc.idRecalificacionPcls', '=', 'tbl_adicionpcls.llaveReCalificacionAdicion')
                ->leftjoin('tbl_estado_siniestro as epc', 'epc.id_estado_siniestro', '=', 'rc.llaveEstadoRecalificacion')
                ->leftjoin('tbl_sub_estados as sb', 'sb.id_sub_estados', '=', 'rc.llaveSubEstadoRecalificacion')
                ->leftjoin('users as u', 'u.id', '=', 'rc.llaveCalificadorRecalificacion')
                ->leftjoin('tbl_tipo_evento as te', 'te.id_tipo_evento', '=', 'rc.llaveTipoEventoRecali')
                ->select('*', \DB::raw('rc.updated_at as fechaGestionReCali'))
                ->firstOrFail();


        $obserAdicion = \DB::table('tbl_adicionpcls as a')
                        ->leftjoin('tbl_observacion_pcl_s as o', 'o.LlaveAdicionDxPcl', '=', 'a.idAdicionPcl')
                        ->where('idAdicionPcl', $id)->get();


        $caliObser = \DB::table('tbl_adicionpcls as s')
                        ->leftjoin('tbl_califiaciones as c', 'c.idCalifiacion', '=', 's.llaveCalificacionAdcion')
                        ->leftjoin('tbl_observacion_pcl_s as o', 'o.LlaveReCalificacionPcl', '=', 'c.idCalifiacion')
                        ->where('idAdicionPcl', $id)->get();

        $obrrecali = \DB::table('tbl_adicionpcls as s')
                        ->leftjoin('tbl_recalificacion_pcls as rc', 'rc.idRecalificacionPcls', '=', 's.llaveReCalificacionAdicion')
                        ->leftjoin('tbl_observacion_pcl_s as o', 'o.LlaveReCalificacionPcl', '=', 'rc.idRecalificacionPcls')
                        ->where('idAdicionPcl', $id)->get();

        $tipoSolicitud = \DB::table('tbl_solicitud')
                        ->where('procesoSolicitud', 'PCL')->get();

        $medico = \DB::table('users')
                        ->leftjoin('tbl_rol', 'tbl_rol.id_rol', '=', 'users.llaveRol_usuario')
                        ->leftjoin('tbl_horario_atencion_medicos', 'tbl_horario_atencion_medicos.llaveMedicoHorario', '=', 'users.id')
                        ->leftjoin('tbl_ciudad', 'tbl_ciudad.id_ciudad', '=', 'tbl_horario_atencion_medicos.llaveCiudadAtencionMedico')
                        ->where('rol', '=', 'CALIFICADOR_ADSCRITO')->get();
        $entididadCalifica = \DB::table('tbl_entidad_califica')->get();

        $cartas = tbl_adicionpcl::where('idAdicionPcl', '=', $id)
                ->join('tbl_recalificacion_pcls as rc', 'rc.idRecalificacionPcls', '=', 'tbl_adicionpcls.llaveReCalificacionAdicion')
                ->join('tbl_cartas as car', 'car.llaveUnionRecalificacionCartas', '=', 'rc.idRecalificacionPcls')
                ->join('users as u', 'u.id', '=', 'car.llaveQuienCreaCarta')
                ->select('*', \DB::raw('car.created_at as fechaCreacion'))
                ->get();

        $cartasNegacion = tbl_adicionpcl::where('idAdicionPcl', '=', $id)
                ->join('tbl_recalificacion_pcls as rc', 'rc.idRecalificacionPcls', '=', 'tbl_adicionpcls.llaveReCalificacionAdicion')
                ->join('tbl_cartanegaciones  as car', 'car.llaveCartasnegacionRecalificacion', '=', 'rc.idRecalificacionPcls')
                ->join('users as u', 'u.id', '=', 'car.llaveQuienCreaCartaNega')
                ->select('*', \DB::raw('car.created_at as fechaCreacion'))
                ->get();

        return view('Adicion.gestionAdicion', compact('cartasNegacion', 'cartas', 'entididadCalifica', 'entradaPcl', 'tipoSolicitud', 'tipoEvento', 'usuarios', 'medicoAsignar'
                        , 'diagnosticos', 'origenDiagnostico', 'estados', 'estadosCali', 'estadosReCali', 'infoSiniestro', 'clf'
                        , 'reClf', 'caliObser', 'obrrecali', 'tipoSolicitud', 'medico', 'obserAdicion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $adicion = tbl_adicionpcl::where('idAdicionPcl', '=', $id)->firstOrFail();
        $estadoAdicion = $request->input('llaveEstadoAdicion');
        $pclCalificacion = $request->input('pclCalificacion');
        $AdiCalificacion = $request->input('AdiCalificacion');
        $AdiReCalificacion = $request->input('AdiReCalificacion');

        $adicion->fill($request->all());
        $adicion->save();


        /* ====================Observaciones======================= */
        $ob = $request->input('TxtObservacion');
        if ($ob != NULL) {
            $observaciones = new tbl_observacion_pcl_s();
            $observaciones->observacion = $request->input('TxtObservacion');
            $observaciones->LlaveAdicionDxPcl = $id;
            $observaciones->save();
        }

        /* ======================Cerrado======================== */
        if ($estadoAdicion == '58' && $pclCalificacion == null && $AdiCalificacion == null) {

            $adicionCalificar = new tbl_califiaciones();
            $adicionCalificar->llaveCalificadorCalifiacion = $request->input('llaveUsuarioAsigAdiPcl');
            $adicionCalificar->llaveEstadoCalificacion = '1';

            $adicionCalificar->save();
            $idAdicionCalificar = $adicionCalificar->idCalifiacion;

            /* =======================Update  adicion=========================== */
            tbl_adicionpcl::where('idAdicionPcl', '=', $id)->update(['llaveCalificacionAdcion' => $idAdicionCalificar]);
        } else if ($AdiReCalificacion == null && $estadoAdicion != '1') {
            $adicionRecClificar = new tbl_recalificacion_pcl();
            $adicionRecClificar->llaveCalificadorRecalificacion = $request->input('llaveUsuarioAsigAdiPcl');
            $adicionRecClificar->llaveEstadoRecalificacion = '1';

            $adicionRecClificar->save();
            $idAdicionRcalificar = $adicionRecClificar->idRecalificacionPcls;

            /* =======================Update  adicion=========================== */
            tbl_adicionpcl::where('idAdicionPcl', '=', $id)->update(['llaveReCalificacionAdicion' => $idAdicionRcalificar]);
        }

        /* ======================Gestionado======================== */
        if ($estadoAdicion == '59' && $AdiReCalificacion == null && $estadoAdicion != '1') {

            $adicionRecClificar = new tbl_recalificacion_pcl();
            $adicionRecClificar->llaveCalificadorRecalificacion = $request->input('llaveUsuarioAsigAdiPcl');
            $adicionRecClificar->llaveEstadoRecalificacion = '1';

            $adicionRecClificar->save();
            $idAdicionRcalificar = $adicionRecClificar->idRecalificacionPcls;

            /* =======================Update  adicion=========================== */
            tbl_adicionpcl::where('idAdicionPcl', '=', $id)->update(['llaveReCalificacionAdicion' => $idAdicionRcalificar]);
        }


        /* =========================Traza Afiliado y Siniestro============================================ */

        /* ==================================================== */
        // --Traza Update Canal entrada variables Nuevas -----
        /* ==================================================== */

        $llaveUsuarioAsigAdiPclN = $request->input('llaveUsuarioAsigAdiPcl');
        $llaveEstadoAdicionN = $request->input('llaveEstadoAdicion');
        $llaveSubEstadoAdicionN = $request->input('llaveSubEstadoAdicion');

        $LlaveQuienSoliAdiPclN = $request->input('LlaveQuienSoliAdiPclPcl');
        $llaveCanalEntradaAdiPclN = $request->input('llaveCanalEntradaAdiPcl');
        $otrosAdicionN = $request->input('otrosAdicion');
        $pqrAdicionN = $request->input('pqrAdicion');
        $fechaAsigClienteAdiconPclN = $request->input('fechaAsigClienteAdiconPcl');

        /* ==================================================== */
        // --=============Traza variables antiguas ==============--
        /* ==================================================== */

        $llaveUsuarioAsigAdiPclA = $request->input('llaveUsuarioAsigAdiPclA');
        $llaveEstadoAdicionA = $request->input('llaveEstadoAdicionA');
        $llaveSubEstadoAdicionA = $request->input('llaveSubEstadoAdicionA');

        $LlaveQuienSoliAdiPclA = $request->input('LlaveQuienSoliAdiPclPclA');
        $llaveCanalEntradaAdiPclA = $request->input('llaveCanalEntradaAdiPclA');
        $otrosAdicionA = $request->input('otrosAdicionA');
        $pqrAdicionA = $request->input('pqrAdicionA');
        $fechaAsigClienteAdiconPclA = $request->input('fechaAsigClienteAdiconPclA');

        /* ==================================================== */
        // --=============Traza variables Antiguas ==============--
        /* ==================================================== */

        if ($llaveUsuarioAsigAdiPclA != $llaveUsuarioAsigAdiPclN) {
            $traza1 = new tbl_traza();
            $traza1->tipo = 'REASIGNACION ADICION';
            $anteriorCalificadors = \DB::table('users')
                            ->where('id', $llaveUsuarioAsigAdiPclA)->get();
            foreach ($anteriorCalificadors as $anteriorCalificador) {
                $traza1->anterior = $anteriorCalificador->name;
            }
            /*   ======================================== */
            $nuevaCalificadors = \DB::table('users')
                            ->where('id', $llaveUsuarioAsigAdiPclN)->get();
            foreach ($nuevaCalificadors as $nuevaCalificador) {
                $traza1->nuevo = $nuevaCalificador->name;
            }
            $traza1->llaveAdicionPclUnion = $id;
            $traza1->llaveUserPcTtraza = $request->input('modificaAdicion');
            $traza1->save();
        }

        /* ==================================================== */
        // --===================Traza ESTADO PRECALIFICACION=============--
        /* ==================================================== */

        if ($llaveEstadoAdicionA != $llaveEstadoAdicionN) {
            $traza2 = new tbl_traza();
            $traza2->tipo = 'ESTADO ADICION';
            $anteriorEstados = \DB::table('tbl_estado_siniestro')
                            ->where('id_estado_siniestro', $llaveEstadoAdicionA)->get();
            foreach ($anteriorEstados as $anteriorEstado) {
                $traza2->anterior = $anteriorEstado->estado_siniestro;
            }
            /*   ======================================== */
            $nuevaEstados = \DB::table('tbl_estado_siniestro')
                            ->where('id_estado_siniestro', $llaveEstadoAdicionN)->get();
            foreach ($nuevaEstados as $nuevaEstado) {
                $traza2->nuevo = $nuevaEstado->estado_siniestro;
            }
            $traza2->llaveAdicionPclUnion = $id;
            $traza2->llaveUserPcTtraza = $request->input('modificaAdicion');
            $traza2->save();
        }


        /* ==================================================== */
        // --===================Traza SUBESTADO PRECALIFICACION=============--
        /* ==================================================== */

        if ($llaveSubEstadoAdicionA != $llaveSubEstadoAdicionN) {
            $traza3 = new tbl_traza();
            $traza3->tipo = 'SUBESTADO ADICION';
            $anteriorSubEstados = \DB::table('tbl_sub_estados')
                            ->where('id_sub_estados', $llaveSubEstadoAdicionA)->get();
            foreach ($anteriorSubEstados as $anteriorSubEstado) {
                $traza3->anterior = $anteriorSubEstado->sub_estados;
            }
            /*   ======================================== */
            $nuevaSubEstados = \DB::table('tbl_sub_estados')
                            ->where('id_sub_estados', $llaveSubEstadoAdicionN)->get();
            foreach ($nuevaSubEstados as $nuevaSubEstado) {
                $traza3->nuevo = $nuevaSubEstado->sub_estados;
            }
            $traza3->llaveAdicionPclUnion = $id;
            $traza3->llaveUserPcTtraza = $request->input('modificaAdicion');
            $traza3->save();
        }


        /* ==================================================== */
        // --===================Traza Canal Enrada=============--
        /* ==================================================== */

        if ($llaveCanalEntradaAdiPclA != $llaveCanalEntradaAdiPclN) {
            $traza4 = new tbl_traza();
            $traza4->tipo = 'CANAL ENTRADA';
            $anteriorEntradas = \DB::table('tbl_entrada')
                            ->where('id_entrada', $llaveCanalEntradaAdiPclA)->get();
            foreach ($anteriorEntradas as $anteriorEntrada) {
                $traza4->anterior = $anteriorEntrada->entrada;
            }
            /*   ======================================== */
            $nuevaEntradas = \DB::table('tbl_entrada')
                            ->where('id_entrada', $llaveCanalEntradaAdiPclN)->get();
            foreach ($nuevaEntradas as $nuevaEntrada) {
                $traza4->nuevo = $nuevaEntrada->entrada;
            }
            $traza4->llaveAdicionPclUnion = $id;
            $traza4->llaveUserPcTtraza = $request->input('modificaAdicion');
            $traza4->save();
        }
        /* ==================================================== */
        // --================= Traza Quien Solicita ==========--
        /* ==================================================== */

        if ($LlaveQuienSoliAdiPclA != $LlaveQuienSoliAdiPclN) {
            $traza5 = new tbl_traza();
            $traza5->tipo = 'QUIEN SOLICITA';
            $anteriorQuiens = \DB::table('tbl_quien_solicita')
                            ->where('id_quien_solicita', $LlaveQuienSoliAdiPclA)->get();
            foreach ($anteriorQuiens as $anteriorQuien) {
                $traza5->anterior = $anteriorQuien->quien_solicita;
            }
            /*   ======================================== */
            $nuevaQuiens = \DB::table('tbl_quien_solicita')
                            ->where('id_quien_solicita', $LlaveQuienSoliAdiPclN)->get();
            foreach ($nuevaQuiens as $nuevaQuien) {
                $traza5->nuevo = $nuevaQuien->quien_solicita;
            }
            $traza5->llaveAdicionPclUnion = $id;
            $traza5->llaveUserPcTtraza = $request->input('modificaAdicion');
            $traza5->save();
        }


        /* ==================================================== */
        // --================= Traza FECHA DEL EVENTO ==========--
        /* ==================================================== */

        if ($otrosAdicionA != $otrosAdicionN) {
            $traza6 = new tbl_traza();
            $traza6->tipo = 'OTROS';
            $traza6->anterior = $otrosAdicionA;
            /*   ======================================== */
            $traza6->nuevo = $otrosAdicionN;
            $traza6->llaveAdicionPclUnion = $id;
            $traza6->llaveUserPcTtraza = $request->input('modificaAdicion');
            $traza6->save();
        }

        /* ==================================================== */
        // --=============== Traza FECHA DEL EVENTO ==========--
        /* ==================================================== */

        if ($pqrAdicionA != $pqrAdicionN) {
            $traza7 = new tbl_traza();
            $traza7->tipo = 'PQR';
            $traza7->anterior = $pqrAdicionA;
            /*   ======================================== */
            $traza7->nuevo = $pqrAdicionN;
            $traza7->llaveAdicionPclUnion = $id;
            $traza7->llaveUserPcTtraza = $request->input('modificaAdicion');
            $traza7->save();
        }

        /* ==================================================== */
        // --=============== Traza Siniestro==========--
        /* ==================================================== */

        if ($fechaAsigClienteAdiconPclA != $fechaAsigClienteAdiconPclN) {
            $traza8 = new tbl_traza();
            $traza8->tipo = 'FECHA ASIGNACION CLIENTE';
            $traza8->anterior = $fechaAsigClienteAdiconPclA;
            /*   ======================================== */
            $traza8->nuevo = $fechaAsigClienteAdiconPclN;
            $traza8->llaveAdicionPclUnion = $id;
            $traza8->llaveUserPcTtraza = $request->input('modificaAdicion');
            $traza8->save();
        }

        return redirect('/Adicion/' . $id . '/edit');
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
