<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbl_recalificacion_pcl;
use App\tbl_observacion_pcl_s;
use App\tbl_traza;

class RecalificacionController extends Controller {

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

    public function contact(Request $request) {

        $correo = \DB::table('tbl_correo_alertas')
                        ->where('modulo', 'PCL')->get();


        foreach ($correo as $key) {
            $estatus = $key->correoAlerta;
        }

        $subject = "Pendiente anexos";
        $for = $estatus;
        \Mail::send('email.emailReCalificacion', $request->all(), function($msj) use($subject, $for) {
            $msj->from($for, "Simel");
            $msj->subject($subject);
            $msj->to($for);
        });
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $reCalificacion = tbl_recalificacion_pcl::where('idRecalificacionPcls', '=', $id)->firstOrFail();
        $habilitado = $request->input('correoEnvidoRecali');

        if ($habilitado != 'SI') {
            $reCalificacion->habilitaReca = null;
        }

        $reCalificacion->fill($request->all());
        $reCalificacion->save();
        $idSiniestroPcl = $request->input('idSiniestroPcl');
        $siEsAdicion = $request->input('siEsAdicion');

        $correoPteAnexcos = $request->input('llaveEstadoRecalificacion');
        $correoEnviado = $request->input('correoEnvidoRecali');



        if ($correoPteAnexcos == 53) {
            if ($correoEnviado == "SI") {
                return $this->contact($request);
            }
        }
        /* =========================Traza PreCalificacion============================================ */

        /* ==================================================== */
        // --=============Traza variables Antiguas ==============--
        /* ==================================================== */
        $llaveCalificadorRecalificacionA = $request->input('llaveCalificadorRecalificacionA');
        $llaveEstadoRecalificacionA = $request->input('llaveEstadoRecalificacionA');
        $llaveSubEstadoRecalificacionA = $request->input('llaveSubEstadoRecalificacionA');
        $llaveTipoEventoRecaliA = $request->input('llaveTipoEventoRecaliA');
        $fechaDictamenCalificacionA = $request->input('fechaDictamenCalificacionA');
        $numeroDictamenA = $request->input('numeroDictamenA');
        $entidadCalificaPclA = $request->input('entidadCalificaPcl');
        $porcentajePclRecalificacionA = $request->input('porcentajePclRecalificacionaA');
        $fechaEnvioComiteRecalificacionA = $request->input('fechaEnvioComiteRecalificacionA');
        $fechaVisadoRecalificacionA = $request->input('fechaVisadoRecalificacionA');
        $fechaDevolcionComiteRecalificacionA = $request->input('fechaDevolcionComiteRecalificacionA');
        $numeroRadicacoSalidaA = $request->input('numeroRadicacoSalidaA');
        $fechaSolicitudAnexosRecaliA = $request->input('fechaSolicitudAnexosRecaliA');
        $anexoReCalificacionA = $request->input('anexoReCalificacionA');
        $fechaRecepcionAnexosReCaliA = $request->input('fechaRecepcionAnexosReCaliA');
        $fechaSeguimientoAnexosReA = $request->input('fechaSeguimientoAnexosReA');


        /* ==================================================== */
        // --=============Traza variables nuevas ==============--
        /* ==================================================== */

        $llaveCalificadorRecalificacionN = $request->input('llaveCalificadorRecalificacion');
        $llaveEstadoRecalificacionN = $request->input('llaveEstadoRecalificacion');
        $llaveSubEstadoRecalificacionN = $request->input('llaveSubEstadoRecalificacion');
        $llaveTipoEventoRecaliN = $request->input('llaveTipoEventoRecali');
        $fechaDictamenCalificacionN = $request->input('fechaDictamenCalificacion');
        $numeroDictamenN = $request->input('numeroDictamen');
        $entidadCalificaPclN = $request->input('entidadCalificaPcl');
        $porcentajePclRecalificacionN = $request->input('porcentajePclRecalificacion');
        $fechaEnvioComiteRecalificacionN = $request->input('fechaEnvioComiteRecalificacion');
        $fechaVisadoRecalificacionN = $request->input('fechaVisadoRecalificacion');
        $fechaDevolcionComiteRecalificacionN = $request->input('fechaDevolcionComiteRecalificacion');
        $numeroRadicacoSalidaN = $request->input('numeroRadicacoSalida');
        $fechaSolicitudAnexosRecaliN = $request->input('fechaSolicitudAnexosRecali');
        $anexoReCalificacionN = $request->input('anexoReCalificacion');
        $fechaRecepcionAnexosReCaliN = $request->input('fechaRecepcionAnexosReCali');
        $fechaSeguimientoAnexosReN = $request->input('fechaSeguimientoAnexosRe');



        /* ==================================================== */
        // --=============Traza variables Antiguas ==============--
        /* ==================================================== */

        if ($llaveCalificadorRecalificacionA != $llaveCalificadorRecalificacionN) {
            $traza1 = new tbl_traza();
            $traza1->tipo = 'REASIGNACION RECALIFICACION';
            $anteriorCalificadors = \DB::table('users')
                            ->where('id', $llaveCalificadorRecalificacionA)->get();
            foreach ($anteriorCalificadors as $anteriorCalificador) {
                $traza1->anterior = $anteriorCalificador->name;
            }
            /*   ======================================== */
            $nuevaCalificadors = \DB::table('users')
                            ->where('id', $llaveCalificadorRecalificacionN)->get();
            foreach ($nuevaCalificadors as $nuevaCalificador) {
                $traza1->nuevo = $nuevaCalificador->name;
            }
            if ($siEsAdicion == 'ADICION') {
                $traza1->llaveAdicionPclUnion = $idSiniestroPcl;
            } else {
                $traza1->llaveSiniestroPclUnion = $idSiniestroPcl;
            }
            $traza1->llaveUserPcTtraza = $request->input('modificaReCaliA');
            $traza1->save();
        }

        /* ==================================================== */
        // --===================Traza ESTADO PRECALIFICACION=============--
        /* ==================================================== */

        if ($llaveEstadoRecalificacionA != $llaveEstadoRecalificacionN) {
            $traza2 = new tbl_traza();
            $traza2->tipo = 'ESTADO RECALIFICACION';
            $anteriorEstados = \DB::table('tbl_estado_siniestro')
                            ->where('id_estado_siniestro', $llaveEstadoRecalificacionA)->get();
            foreach ($anteriorEstados as $anteriorEstado) {
                $traza2->anterior = $anteriorEstado->estado_siniestro;
            }
            /*   ======================================== */
            $nuevaEstados = \DB::table('tbl_estado_siniestro')
                            ->where('id_estado_siniestro', $llaveEstadoRecalificacionN)->get();
            foreach ($nuevaEstados as $nuevaEstado) {
                $traza2->nuevo = $nuevaEstado->estado_siniestro;
            }
            if ($siEsAdicion == 'ADICION') {
                $traza2->llaveAdicionPclUnion = $idSiniestroPcl;
            } else {
                $traza2->llaveSiniestroPclUnion = $idSiniestroPcl;
            }
            $traza2->llaveUserPcTtraza = $request->input('modificaReCaliA');
            $traza2->save();
        }


        /* ==================================================== */
        // --===================Traza SUBESTADO PRECALIFICACION=============--
        /* ==================================================== */

        if ($llaveSubEstadoRecalificacionA != $llaveSubEstadoRecalificacionN) {
            $traza3 = new tbl_traza();
            $traza3->tipo = 'SUBESTADO RECALIFICACION';
            $anteriorSubEstados = \DB::table('tbl_sub_estados')
                            ->where('id_sub_estados', $llaveSubEstadoRecalificacionA)->get();
            foreach ($anteriorSubEstados as $anteriorSubEstado) {
                $traza3->anterior = $anteriorSubEstado->sub_estados;
            }
            /*   ======================================== */
            $nuevaSubEstados = \DB::table('tbl_sub_estados')
                            ->where('id_sub_estados', $llaveSubEstadoRecalificacionN)->get();
            foreach ($nuevaSubEstados as $nuevaSubEstado) {
                $traza3->nuevo = $nuevaSubEstado->sub_estados;
            }
            if ($siEsAdicion == 'ADICION') {
                $traza3->llaveAdicionPclUnion = $idSiniestroPcl;
            } else {
                $traza3->llaveSiniestroPclUnion = $idSiniestroPcl;
            }
            $traza3->llaveUserPcTtraza = $request->input('modificaReCaliA');
            $traza3->save();
        }

        if ($anexoReCalificacionA == null and $llaveEstadoRecalificacionN == '53') {

            /* ==================================================== */
            // --======Traza FECHA SOLICITUD ANEXOS PRECALIFICACION ==============--
            /* ==================================================== */
            if ($fechaSolicitudAnexosRecaliA != $fechaSolicitudAnexosRecaliN) {
                $traza4 = new tbl_traza();
                $traza4->tipo = 'FECHA SOLICITUD ANEXOS RECALIFICACION';
                $traza4->anterior = $fechaSolicitudAnexosRecaliA;
                /*   ======================================== */
                $traza4->nuevo = $fechaSolicitudAnexosRecaliN;
                if ($siEsAdicion == 'ADICION') {
                    $traza4->llaveAdicionPclUnion = $idSiniestroPcl;
                } else {
                    $traza4->llaveSiniestroPclUnion = $idSiniestroPcl;
                }
                $traza4->llaveUserPcTtraza = $request->input('modificaReCaliA');
                $traza4->save();
            }
            /* ==================================================== */
            // --======Traza SOLICITUD ANEXOS PRECALIFICACION======--
            /* ==================================================== */
            if ($anexoReCalificacionA != $anexoReCalificacionN) {
                $traza7 = new tbl_traza();
                $traza7->tipo = 'SOLICITUD ANEXOS RECALIFICACION';
                $traza7->anterior = $anexoReCalificacionA;
                /*   ======================================== */
                $traza7->nuevo = $anexoReCalificacionN;
                if ($siEsAdicion == 'ADICION') {
                    $traza7->llaveAdicionPclUnion = $idSiniestroPcl;
                } else {
                    $traza7->llaveSiniestroPclUnion = $idSiniestroPcl;
                }
                $traza7->llaveUserPcTtraza = $request->input('modificaReCaliA');
                $traza7->save();
            }
        }
        /* ==================================================== */
        // --===================Traza FECHA RECEPCION ANEXOS PRECALIFICACION==================--
        /* ==================================================== */
        if ($fechaRecepcionAnexosReCaliA != $fechaRecepcionAnexosReCaliN) {
            $traza5 = new tbl_traza();
            $traza5->tipo = 'FECHA RECEPCION ANEXOS RECALIFICACION';
            $traza5->anterior = $fechaRecepcionAnexosReCaliA;
            /*   ======================================== */
            $traza5->nuevo = $fechaRecepcionAnexosReCaliN;
            if ($siEsAdicion == 'ADICION') {
                $traza5->llaveAdicionPclUnion = $idSiniestroPcl;
            } else {
                $traza5->llaveSiniestroPclUnion = $idSiniestroPcl;
            }
            $traza5->llaveUserPcTtraza = $request->input('modificaReCaliA');
            $traza5->save();
        }


        /* ==================================================== */
        // --===================Traza FECHA SEGUIMIENTO ANEXOS PRECALIFICACION==================--
        /* ==================================================== */
        if ($fechaSeguimientoAnexosReA != $fechaSeguimientoAnexosReN) {
            $traza6 = new tbl_traza();
            $traza6->tipo = 'FECHA SEGUIMIENTO ANEXOS RECALIFICACION';
            $traza6->anterior = $fechaSeguimientoAnexosReA;
            /*   ======================================== */
            $traza6->nuevo = $fechaSeguimientoAnexosReN;
            if ($siEsAdicion == 'ADICION') {
                $traza6->llaveAdicionPclUnion = $idSiniestroPcl;
            } else {
                $traza6->llaveSiniestroPclUnion = $idSiniestroPcl;
            }
            $traza6->llaveUserPcTtraza = $request->input('modificaReCaliA');
            $traza6->save();
        }




        /* ==================================================== */
        // --======Traza envio comite   ======--
        /* ==================================================== */
        if ($fechaEnvioComiteRecalificacionA != $fechaEnvioComiteRecalificacionN) {
            $traza8 = new tbl_traza();
            $traza8->tipo = 'FECHA ENVIO COMITE RECALIFICACION';
            $traza8->anterior = $fechaEnvioComiteRecalificacionA;
            /*   ======================================== */
            $traza8->nuevo = $fechaEnvioComiteRecalificacionN;
            if ($siEsAdicion == 'ADICION') {
                $traza8->llaveAdicionPclUnion = $idSiniestroPcl;
            } else {
                $traza8->llaveSiniestroPclUnion = $idSiniestroPcl;
            }
            $traza8->llaveUserPcTtraza = $request->input('modificaReCaliA');
            $traza8->save();
        }

        /* ==================================================== */
        // --======   Traza fecha devolucion comite  ======--
        /* ==================================================== */
        if ($fechaDevolcionComiteRecalificacionA != $fechaDevolcionComiteRecalificacionN) {
            $traza10 = new tbl_traza();
            $traza10->tipo = 'FECHA DEVOLUCION COMITE RECALIFICACION';
            $traza10->anterior = $fechaDevolcionComiteRecalificacionA;
            /*   ======================================== */
            $traza10->nuevo = $fechaDevolcionComiteRecalificacionN;
            if ($siEsAdicion == 'ADICION') {
                $traza10->llaveAdicionPclUnion = $idSiniestroPcl;
            } else {
                $traza10->llaveSiniestroPclUnion = $idSiniestroPcl;
            }
            $traza10->llaveUserPcTtraza = $request->input('modificaReCaliA');
            $traza10->save();
        }

        /* ==================================================== */
        // --======Traza fecha visado   ======--
        /* ==================================================== */
        if ($fechaVisadoRecalificacionA != $fechaVisadoRecalificacionN) {
            $traza11 = new tbl_traza();
            $traza11->tipo = 'FECHA VISADO RECALIFICACION';
            $traza11->anterior = $fechaVisadoRecalificacionA;
            /*   ======================================== */
            $traza11->nuevo = $fechaVisadoRecalificacionN;
            if ($siEsAdicion == 'ADICION') {
                $traza11->llaveAdicionPclUnion = $idSiniestroPcl;
            } else {
                $traza11->llaveSiniestroPclUnion = $idSiniestroPcl;
            }
            $traza11->llaveUserPcTtraza = $request->input('modificaReCaliA');
            $traza11->save();
        }


        /* ==================================================== */
        // --======Traza FECHA DICTAMEN CALIFICACION  ======--
        /* ==================================================== */
        if ($fechaDictamenCalificacionA != $fechaDictamenCalificacionN) {
            $traza12 = new tbl_traza();
            $traza12->tipo = 'FECHA DICTAMEN CALIFICACION';
            $traza12->anterior = $fechaDictamenCalificacionA;
            /*   ======================================== */
            $traza12->nuevo = $fechaDictamenCalificacionN;
            if ($siEsAdicion == 'ADICION') {
                $traza12->llaveAdicionPclUnion = $idSiniestroPcl;
            } else {
                $traza12->llaveSiniestroPclUnion = $idSiniestroPcl;
            }
            $traza12->llaveUserPcTtraza = $request->input('modificaReCaliA');
            $traza12->save();
        }
        /* ==================================================== */
        // --======Traza fecha visado   ======--
        /* ==================================================== */
        if ($numeroDictamenA != $numeroDictamenN) {
            $traza13 = new tbl_traza();
            $traza13->tipo = 'NUMERO DICTAMEN';
            $traza13->anterior = $numeroDictamenA;
            /*   ======================================== */
            $traza13->nuevo = $numeroDictamenN;
            if ($siEsAdicion == 'ADICION') {
                $traza13->llaveAdicionPclUnion = $idSiniestroPcl;
            } else {
                $traza13->llaveSiniestroPclUnion = $idSiniestroPcl;
            }
            $traza13->llaveUserPcTtraza = $request->input('modificaReCaliA');
            $traza13->save();
        }
        /* ==================================================== */
        // --======Traza ENTIDAD QUE CALIFICA  ======--
        /* ==================================================== */
        if ($entidadCalificaPclA != $entidadCalificaPclN) {
            $traza14 = new tbl_traza();
            $traza14->tipo = 'ENTIDAD QUE CALIFICA';
            $traza14->anterior = $entidadCalificaPclA;
            /*   ======================================== */
            $traza11->nuevo = $entidadCalificaPclN;
            if ($siEsAdicion == 'ADICION') {
                $traza14->llaveAdicionPclUnion = $idSiniestroPcl;
            } else {
                $traza14->llaveSiniestroPclUnion = $idSiniestroPcl;
            }
            $traza14->llaveUserPcTtraza = $request->input('modificaReCaliA');
            $traza14->save();
        }
        /* ==================================================== */
        // --======Traza PORCENTAGE PCL RECALIFICACION   ======--
        /* ==================================================== */
        if ($porcentajePclRecalificacionA != $porcentajePclRecalificacionN) {
            $traza15 = new tbl_traza();
            $traza15->tipo = 'PORCENTAGE PCL RECALIFICACION';
            $traza15->anterior = $porcentajePclRecalificacionA;
            /*   ======================================== */
            $traza15->nuevo = $porcentajePclRecalificacionN;
            if ($siEsAdicion == 'ADICION') {
                $traza15->llaveAdicionPclUnion = $idSiniestroPcl;
            } else {
                $traza15->llaveSiniestroPclUnion = $idSiniestroPcl;
            }
            $traza15->llaveUserPcTtraza = $request->input('modificaReCaliA');
            $traza15->save();
        }
        /* ==================================================== */
        // --======Traza NUMERO RADICADO SALIDA   ======--
        /* ==================================================== */
        if ($numeroRadicacoSalidaA != $numeroRadicacoSalidaN) {
            $traza16 = new tbl_traza();
            $traza16->tipo = 'NUMERO RADICADO SALIDA';
            $traza16->anterior = $numeroRadicacoSalidaA;
            /*   ======================================== */
            $traza16->nuevo = $numeroRadicacoSalidaN;
            if ($siEsAdicion == 'ADICION') {
                $traza16->llaveAdicionPclUnion = $idSiniestroPcl;
            } else {
                $traza16->llaveSiniestroPclUnion = $idSiniestroPcl;
            }
            $traza16->llaveUserPcTtraza = $request->input('modificaReCaliA');
            $traza16->save();
        }


        /* ==================================================== */
        // --================= Traza Tipo Evento ==========--
        /* ==================================================== */

        if ($llaveTipoEventoRecaliA != $llaveTipoEventoRecaliN) {
            $traza17 = new tbl_traza();
            $traza17->tipo = 'TIPO EVENTO RECALIFICACION';
            $anteriorTipoSolicitudes = \DB::table('tbl_tipo_evento')
                            ->where('id_tipo_evento', $llaveTipoEventoRecaliA)->get();
            foreach ($anteriorTipoSolicitudes as $anteriorTipoSolicitud) {
                $traza17->anterior = $anteriorTipoSolicitud->tipo_evento;
            }
            /*   ======================================== */
            $nuevaTipoSolicitudes = \DB::table('tbl_tipo_evento')
                            ->where('id_tipo_evento', $llaveTipoEventoRecaliN)->get();
            foreach ($nuevaTipoSolicitudes as $nuevaTipoSolicitud) {
                $traza17->nuevo = $nuevaTipoSolicitud->tipo_evento;
            }
            if ($siEsAdicion == 'ADICION') {
                $traza17->llaveAdicionPclUnion = $idSiniestroPcl;
            } else {
                $traza17->llaveSiniestroPclUnion = $idSiniestroPcl;
            }
            $traza17->llaveUserPcTtraza = $request->input('modificaReCaliA');
            $traza17->save();
        }


        /* ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */


        if ($siEsAdicion == 'ADICION') {
            /* ====================Observaciones======================= */
            $ob = $request->input('TxtObservacionRecali');
            if ($ob != NULL) {
                $observaciones = new tbl_observacion_pcl_s();
                $observaciones->observacion = $request->input('TxtObservacionRecali');
                $observaciones->LlaveReCalificacionPcl = $id;
                $observaciones->save();
            }




            if ($correoPteAnexcos == 42) {
                return redirect('FormatoNegacionAdicion/' . $idSiniestroPcl . '/edit');
            } else {
                return redirect('/Adicion/' . $idSiniestroPcl . '/edit');
            }
        } else {
            /* ====================Observaciones======================= */
            $ob = $request->input('TxtObservacionRecali');
            if ($ob != NULL) {
                $observaciones = new tbl_observacion_pcl_s();
                $observaciones->observacion = $request->input('TxtObservacionRecali');
                $observaciones->LlaveReCalificacionPcl = $id;
                $observaciones->save();
            }

            if ($correoPteAnexcos == 42) {
                return redirect('FormatoNegacion/' . $idSiniestroPcl . '/edit');
            } else {
                return redirect('/Siniestro/' . $idSiniestroPcl . '/edit');
            }
        }
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
