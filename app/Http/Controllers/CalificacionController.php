<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbl_afiliado;
use App\tbl_siniestro_pcl;
use App\tbl_seguimiento;
use App\tbl_emsa;
use App\User;
use App\tbl_observacion_pcl_s;
use App\tbl_califiaciones;
use App\tbl_solicitud_anexos;
use App\tbl_traza;

class CalificacionController extends Controller {

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
        \Mail::send('email.emailCalificacion', $request->all(), function($msj) use($subject, $for) {
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

        $calificacion = tbl_califiaciones::where('idCalifiacion', '=', $id)->firstOrFail();
        $habilitado = $request->input('habilitado');
        if ($habilitado != 'SI') {
            $calificacion->habilitado = null;
        }
        $calificacion->fill($request->all());
        $calificacion->save();


        $correoPteAnexcos = $request->input('llaveSubEstadoCalificacion');
        $correoEnviado = $request->input('correoEnvidoCali');


        /*
          $sisolicitud = $request->input('TxtSolicitudAnexos');
          if ($sisolicitud != NULL) {
          $solicitud = new tbl_solicitud_anexos();
          $solicitud->anexo = $request->input('TxtSolicitudAnexos');
          $solicitud->fechaSolicitudAnexos = $request->input('fechaSolicitudAnexos');
          $solicitud->llaveCalificacion = $id;
          $solicitud->save();
          } */

        /* ====================Observaciones======================= */
        $ob = $request->input('TxtObservacion');
        if ($ob != NULL) {
            $observaciones = new tbl_observacion_pcl_s();
            $observaciones->observacion = $request->input('TxtObservacion');
            $observaciones->LlaveCalificacionPcl = $id;
            $observaciones->save();
        }
        $idSiniestroPcl = $request->input('idSiniestroPcl');

        if ($correoPteAnexcos == 127) {
            if ($correoEnviado == "SI") {
                return $this->contact($request);
            }
        }

        $caliSiniestro = $request->input('caliSiniestro');





        /* =========================Traza PreCalificacion============================================ */


        /* ==================================================== */
        // --=============Traza variables Antiguas ==============--
        /* ==================================================== */
        $llaveCalificadorCalifiacionA = $request->input('llaveCalificadorCalifiacionA');
        $llaveEstadoCalificacionA = $request->input('llaveEstadoCalificacionA');
        $llaveSubEstadoCalificacionA = $request->input('llaveSubEstadoCalificacionA');
        $procentajePclA = $request->input('procentajePclA');
        $fechaEnvioComiteA = $request->input('fechaEnvioComiteA');
        $fechaDevolucionComiteA = $request->input('fechaDevolucionComiteA');
        $fechaVisadoA = $request->input('fechaVisadoA');
        $fechaSolicitudAnexosCaliA = $request->input('fechaSolicitudAnexosCaliA');
        $anexoCalificacionA = $request->input('anexoCalificacionA');
        $fechaSeguimientoAnexosCalA = $request->input('fechaSeguimientoAnexosCalA');
        $fechaRecepcionAnexosCalA = $request->input('fechaRecepcionAnexosCalA');

        /* ==================================================== */
        // --=============Traza variables nuevas ==============--
        /* ==================================================== */

        $llaveCalificadorCalifiacionN = $request->input('llaveCalificadorCalifiacion');
        $llaveEstadoCalificacionN = $request->input('llaveEstadoCalificacion');
        $llaveSubEstadoCalificacionN = $request->input('llaveSubEstadoCalificacion');
        $procentajePclN = $request->input('procentajePcl');
        $fechaEnvioComiteN = $request->input('fechaEnvioComite');
        $fechaDevolucionComiteN = $request->input('fechaDevolucionComite');
        $fechaVisadoN = $request->input('fechaVisadoA');
        $fechaSolicitudAnexosCaliN = $request->input('fechaSolicitudAnexosCali');
        $anexoCalificacionN = $request->input('anexoCalificacion');
        $fechaSeguimientoAnexosCalN = $request->input('fechaSeguimientoAnexosCal');
        $fechaRecepcionAnexosCalN = $request->input('fechaRecepcionAnexosCal');


        /* ==================================================== */
        // --=============Traza variables Antiguas ==============--
        /* ==================================================== */

        if ($llaveCalificadorCalifiacionA != $llaveCalificadorCalifiacionN) {
            $traza1 = new tbl_traza();
            $traza1->tipo = 'REASIGNACION CALIFICACION';
            $anteriorCalificadors = \DB::table('users')
                            ->where('id', $llaveCalificadorCalifiacionA)->get();
            foreach ($anteriorCalificadors as $anteriorCalificador) {
                $traza1->anterior = $anteriorCalificador->name;
            }
            /*   ======================================== */
            $nuevaCalificadors = \DB::table('users')
                            ->where('id', $llaveCalificadorCalifiacionN)->get();
            foreach ($nuevaCalificadors as $nuevaCalificador) {
                $traza1->nuevo = $nuevaCalificador->name;
            }
            if ($caliSiniestro == 'Siniestro') {
                $traza1->llaveSiniestroPclUnion = $idSiniestroPcl;
            } else {
                $traza1->llaveAdicionPclUnion = $idSiniestroPcl;
            }
            $traza1->llaveUserPcTtraza = $request->input('modificaCaliACaliA');
            $traza1->save();
        }

        /* ==================================================== */
        // --===================Traza ESTADO PRECALIFICACION=============--
        /* ==================================================== */

        if ($llaveEstadoCalificacionA != $llaveEstadoCalificacionN) {
            $traza2 = new tbl_traza();
            $traza2->tipo = 'ESTADO CALIFICACION';
            $anteriorEstados = \DB::table('tbl_estado_siniestro')
                            ->where('id_estado_siniestro', $llaveEstadoCalificacionA)->get();
            foreach ($anteriorEstados as $anteriorEstado) {
                $traza2->anterior = $anteriorEstado->estado_siniestro;
            }
            /*   ======================================== */
            $nuevaEstados = \DB::table('tbl_estado_siniestro')
                            ->where('id_estado_siniestro', $llaveEstadoCalificacionN)->get();
            foreach ($nuevaEstados as $nuevaEstado) {
                $traza2->nuevo = $nuevaEstado->estado_siniestro;
            }
            if ($caliSiniestro == 'Siniestro') {
                $traza2->llaveSiniestroPclUnion = $idSiniestroPcl;
            } else {
                $traza2->llaveAdicionPclUnion = $idSiniestroPcl;
            }
            $traza2->llaveUserPcTtraza = $request->input('modificaCaliA');
            $traza2->save();
        }


        /* ==================================================== */
        // --===================Traza SUBESTADO PRECALIFICACION=============--
        /* ==================================================== */

        if ($llaveSubEstadoCalificacionA != $llaveSubEstadoCalificacionN) {
            $traza3 = new tbl_traza();
            $traza3->tipo = 'SUBESTADO CALIFICACION';
            $anteriorSubEstados = \DB::table('tbl_sub_estados')
                            ->where('id_sub_estados', $llaveSubEstadoCalificacionA)->get();
            foreach ($anteriorSubEstados as $anteriorSubEstado) {
                $traza3->anterior = $anteriorSubEstado->sub_estados;
            }
            /*   ======================================== */
            $nuevaSubEstados = \DB::table('tbl_sub_estados')
                            ->where('id_sub_estados', $llaveSubEstadoCalificacionN)->get();
            foreach ($nuevaSubEstados as $nuevaSubEstado) {
                $traza3->nuevo = $nuevaSubEstado->sub_estados;
            }
            if ($caliSiniestro == 'Siniestro') {
                $traza3->llaveSiniestroPclUnion = $idSiniestroPcl;
            } else {
                $traza3->llaveAdicionPclUnion = $idSiniestroPcl;
            }
            $traza3->llaveUserPcTtraza = $request->input('modificaCaliA');
            $traza3->save();
        }




        /* ==================================================== */
        // --===================Traza FECHA RECEPCION ANEXOS PRECALIFICACION==================--
        /* ==================================================== */
        if ($fechaRecepcionAnexosCalA != $fechaRecepcionAnexosCalN) {
            $traza5 = new tbl_traza();
            $traza5->tipo = 'FECHA RECEPCION ANEXOS CALIFICACION';
            $traza5->anterior = $fechaRecepcionAnexosCalA;
            /*   ======================================== */
            $traza5->nuevo = $fechaRecepcionAnexosCalN;
            if ($caliSiniestro == 'Siniestro') {
                $traza5->llaveSiniestroPclUnion = $idSiniestroPcl;
            } else {
                $traza5->llaveAdicionPclUnion = $idSiniestroPcl;
            }
            $traza5->llaveUserPcTtraza = $request->input('modificaCaliA');
            $traza5->save();
        }


        /* ==================================================== */
        // --===================Traza FECHA SEGUIMIENTO ANEXOS PRECALIFICACION==================--
        /* ==================================================== */
        if ($fechaSeguimientoAnexosCalA != $fechaSeguimientoAnexosCalN) {
            $traza6 = new tbl_traza();
            $traza6->tipo = 'FECHA SEGUIMIENTO ANEXOS CALIFICACION';
            $traza6->anterior = $fechaSeguimientoAnexosCalA;
            /*   ======================================== */
            $traza6->nuevo = $fechaSeguimientoAnexosCalN;
            if ($caliSiniestro == 'Siniestro') {
                $traza6->llaveSiniestroPclUnion = $idSiniestroPcl;
            } else {
                $traza6->llaveAdicionPclUnion = $idSiniestroPcl;
            }
            $traza6->llaveUserPcTtraza = $request->input('modificaCaliA');
            $traza6->save();
        }



        if ($anexoCalificacionA == null and $llaveEstadoCalificacionN == '49') {

            /* ==================================================== */
            // --======Traza SOLICITUD ANEXOS PRECALIFICACION======--
            /* ==================================================== */
            if ($anexoCalificacionA != $anexoCalificacionN) {
                $traza7 = new tbl_traza();
                $traza7->tipo = 'SOLICITUD ANEXOS CALIFICACION';
                $traza7->anterior = $anexoCalificacionA;
                /*   ======================================== */
                $traza7->nuevo = $anexoCalificacionN;
                if ($caliSiniestro == 'Siniestro') {
                    $traza7->llaveSiniestroPclUnion = $idSiniestroPcl;
                } else {
                    $traza7->llaveAdicionPclUnion = $idSiniestroPcl;
                }
                $traza7->llaveUserPcTtraza = $request->input('modificaCaliA');
                $traza7->save();
            }

            /* ==================================================== */
            // --======Traza FECHA SOLICITUD ANEXOS PRECALIFICACION ==============--
            /* ==================================================== */
            if ($fechaSolicitudAnexosCaliA != $fechaSolicitudAnexosCaliN) {
                $traza4 = new tbl_traza();
                $traza4->tipo = 'FECHA SOLICITUD ANEXOS CALIFICACION';
                $traza4->anterior = $fechaSolicitudAnexosCaliA;
                /*   ======================================== */
                $traza4->nuevo = $fechaSolicitudAnexosCaliN;
                if ($caliSiniestro == 'Siniestro') {
                    $traza4->llaveSiniestroPclUnion = $idSiniestroPcl;
                } else {
                    $traza4->llaveAdicionPclUnion = $idSiniestroPcl;
                }
                $traza4->llaveUserPcTtraza = $request->input('modificaCaliA');
                $traza4->save();
            }
        }



        /* ==================================================== */
        // --======Traza envio comite   ======--
        /* ==================================================== */
        if ($fechaEnvioComiteA != $fechaEnvioComiteN) {
            $traza8 = new tbl_traza();
            $traza8->tipo = 'FECHA ENVIO COMITE CALIFICACION';
            $traza8->anterior = $fechaEnvioComiteA;
            /*   ======================================== */
            $traza8->nuevo = $fechaEnvioComiteN;
            if ($caliSiniestro == 'Siniestro') {
                $traza8->llaveSiniestroPclUnion = $idSiniestroPcl;
            } else {
                $traza8->llaveAdicionPclUnion = $idSiniestroPcl;
            }
            $traza8->llaveUserPcTtraza = $request->input('modificaCaliA');
            $traza8->save();
        }


        /* ==================================================== */
        // --======   Traza fecha devolucion comite  ======--
        /* ==================================================== */
        if ($fechaDevolucionComiteA != $fechaDevolucionComiteN) {
            $traza10 = new tbl_traza();
            $traza10->tipo = 'FECHA DEVOLUCION COMITE CALIFICACION';
            $traza10->anterior = $fechaDevolucionComiteA;
            /*   ======================================== */
            $traza10->nuevo = $fechaDevolucionComiteN;
            if ($caliSiniestro == 'Siniestro') {
                $traza10->llaveSiniestroPclUnion = $idSiniestroPcl;
            } else {
                $traza10->llaveAdicionPclUnion = $idSiniestroPcl;
            }
            $traza10->llaveUserPcTtraza = $request->input('modificaCaliA');
            $traza10->save();
        }


        /* ==================================================== */
        // --======Traza fecha visado   ======--
        /* ==================================================== */
        if ($fechaVisadoA != $fechaVisadoN) {
            $traza11 = new tbl_traza();
            $traza11->tipo = 'FECHA VISADO CALIFICACION';
            $traza11->anterior = $fechaVisadoA;
            /*   ======================================== */
            $traza11->nuevo = $fechaVisadoN;

            if ($caliSiniestro == 'Siniestro') {
                $traza11->llaveSiniestroPclUnion = $idSiniestroPcl;
            } else {
                $traza11->llaveAdicionPclUnion = $idSiniestroPcl;
            }


            $traza11->llaveUserPcTtraza = $request->input('modificaCaliA');
            $traza11->save();
        }
        //////adicion

        if ($caliSiniestro == 'Siniestro') {
            return redirect('/Siniestro/' . $idSiniestroPcl . '/edit');
        } else {
            return redirect('/Adicion/' . $idSiniestroPcl . '/edit');
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
