<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbl_el_calificacione;
use App\tbl_el_observacione;
use App\tbl_traza;

class CalificacionElController extends Controller {

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $calificacion = tbl_el_calificacione::where('idElCalificaciones', '=', $id)->firstOrFail();
        $calificacion->fill($request->all());
        $calificacion->save();

        /* ====================Observaciones======================= */
        $ob = $request->input('TxtObservacionElCali');
        if ($ob != NULL) {
            $observaciones = new tbl_el_observacione();
            $observaciones->observacion = $request->input('TxtObservacionElCali');
            $observaciones->llaveCalificacionElOb = $id;
            $observaciones->save();
        }

        $idsiniestro = $request->input('idRetornar');





        /* =========================Traza Afiliado y Siniestro============================================ */

        /* ==================================================== */
        // --Traza Update Canal entrada variables Nuevas -----
        /* ==================================================== */

        $llaveEstadoElCalificacionN = $request->input('llaveEstadoElCalificacion');
        $llaveUsuarioCalificadorElN = $request->input('llaveUsuarioCalificadorEl');
        $fechaGestionMedicoN = $request->input('fechaGestionMedico');
        $fechaSolicitudPruebasN = $request->input('fechaSolicitudPruebas');
        $fechaEnvioComiteCodessN = $request->input('fechaEnvioComiteCodess');
        $fechaAvalComiteCodessN = $request->input('fechaAvalComiteCodess');
        $fechaRadicadoSalidaN = $request->input('fechaRadicadoSalida');
        $numeroRadicadoSalidaN = $request->input('numeroRadicadoSalida');
        $llaveIngresoRehabilitacionN = $request->input('llaveIngresoRehabilitacion');
        $llaveCanalEntradaPruebasN = $request->input('llaveCanalEntradaPruebas');
        $radicadoEntradaPruebasN = $request->input('radicadoEntradaPruebas');
        $fechaIngresoPruebasN = $request->input('fechaIngresoPruebas');
        $llaveOrigenOportunidadEpsN = $request->input('llaveOrigenOportunidadEps');
        $llaveOrigenOportunidadPositivaN = $request->input('llaveOrigenOportunidadPositiva');
        $llaveCoberturaN = $request->input('llaveCobertura');
        $raSalidaCoverturaDevolucionEpsN = $request->input('raSalidaCoverturaDevolucionEps');
        $llaveRevicionCoberturaN = $request->input('llaveRevicionCobertura');



        /* ==================================================== */
        // --Traza Update Canal entrada variables Antigual -----
        /* ==================================================== */

        $llaveEstadoElCalificacionA = $request->input('llaveEstadoElCalificacionA');
        $llaveUsuarioCalificadorElA = $request->input('llaveUsuarioCalificadorElA');
        $fechaGestionMedicoA = $request->input('fechaGestionMedicoA');
        $fechaSolicitudPruebasA = $request->input('fechaSolicitudPruebasA');
        $fechaEnvioComiteCodessA = $request->input('fechaEnvioComiteCodessA');
        $fechaAvalComiteCodessA = $request->input('fechaAvalComiteCodessA');
        $fechaRadicadoSalidaA = $request->input('fechaRadicadoSalidaA');
        $numeroRadicadoSalidaA = $request->input('numeroRadicadoSalidaA');
        $llaveIngresoRehabilitacionA = $request->input('llaveIngresoRehabilitacionA');
        $llaveCanalEntradaPruebasA = $request->input('llaveCanalEntradaPruebasA');
        $radicadoEntradaPruebasA = $request->input('radicadoEntradaPruebasA');
        $fechaIngresoPruebasA = $request->input('fechaIngresoPruebasA');
        $llaveOrigenOportunidadEpsA = $request->input('llaveOrigenOportunidadEpsA');
        $llaveOrigenOportunidadPositivaA = $request->input('llaveOrigenOportunidadPositivaA');
        $llaveCoberturaA = $request->input('llaveCoberturaA');
        $raSalidaCoverturaDevolucionEpsA = $request->input('raSalidaCoverturaDevolucionEpsA');
        $llaveRevicionCoberturaA = $request->input('llaveRevicionCoberturaA');





        /* ==================================================== */
        // --================= Traza COBERTURA ==========--
        /* ==================================================== */

        if ($llaveCoberturaA != $llaveCoberturaN) {
            $trazaCobertura = new tbl_traza();
            $trazaCobertura->tipo = 'COBERTURA';
            $anteriorCoberturas = \DB::table('tbl_cobertura')
                            ->where('idCobertura', $llaveCoberturaA)->get();
            foreach ($anteriorCoberturas as $anteriorCobertura) {
                $trazaCobertura->anterior = $anteriorCobertura->cobertura;
            }
            /*   ======================================== */
            $nuevaCoberturas = \DB::table('tbl_cobertura')
                            ->where('idCobertura', $llaveCoberturaN)->get();
            foreach ($nuevaCoberturas as $nuevaCobertura) {
                $trazaCobertura->nuevo = $nuevaCobertura->cobertura;
            }
            $trazaCobertura->llaveSiniestroEL = $idsiniestro;
            $trazaCobertura->llaveUserPcTtraza = $request->input('modifica');
            $trazaCobertura->save();
        }

        /* ==================================================== */
        // --================= Traza Revicion covertura ==========--
        /* ==================================================== */

        if ($llaveRevicionCoberturaA != $llaveRevicionCoberturaN) {
            $trazaReCobertura = new tbl_traza();
            $trazaReCobertura->tipo = 'REVISION COBERTURA';
            $anteriorReCoberturas = \DB::table('tbl_revision_cobertura')
                            ->where('idRevisionCobertura', $llaveRevicionCoberturaA)->get();
            foreach ($anteriorReCoberturas as $anteriorReCobertura) {
                $trazaReCobertura->anterior = $anteriorReCobertura->revisionCobertura;
            }
            /*   ======================================== */
            $nuevaReCoberturas = \DB::table('tbl_revision_cobertura')
                            ->where('idRevisionCobertura', $llaveRevicionCoberturaN)->get();
            foreach ($nuevaReCoberturas as $nuevaReCobertura) {
                $trazaReCobertura->nuevo = $nuevaReCobertura->revisionCobertura;
            }
            $trazaReCobertura->llaveSiniestroEL = $idsiniestro;
            $trazaReCobertura->llaveUserPcTtraza = $request->input('modifica');
            $trazaReCobertura->save();
        }


        /* ==================================================== */
        // --================= Traza RADICADO COBERTURA O DEVOLUCION EPS==========--
        /* ==================================================== */

        if ($raSalidaCoverturaDevolucionEpsA != $raSalidaCoverturaDevolucionEpsN) {
            $trazarRaSaCoEps = new tbl_traza();
            $trazarRaSaCoEps->tipo = 'RADICADO COBERTURA O DEVOLUCION EPS';
            $trazarRaSaCoEps->anterior = $raSalidaCoverturaDevolucionEpsA;
            /*   ======================================== */
            $trazarRaSaCoEps->nuevo = $raSalidaCoverturaDevolucionEpsN;
            $trazarRaSaCoEps->llaveSiniestroEL = $idsiniestro;
            $trazarRaSaCoEps->llaveUserPcTtraza = $request->input('modifica');
            $trazarRaSaCoEps->save();
        }

        /* ==================================================== */
        // --================= Traza Estado ==========--
        /* ==================================================== */

        if ($llaveEstadoElCalificacionA != $llaveEstadoElCalificacionN) {
            $trazaEstado = new tbl_traza();
            $trazaEstado->tipo = 'ESTADO';
            $anteriorEstados = \DB::table('tbl_estado_siniestro')
                            ->where('id_estado_siniestro', $llaveEstadoElCalificacionA)->get();
            foreach ($anteriorEstados as $anteriorEstado) {
                $trazaEstado->anterior = $anteriorEstado->estado_siniestro;
            }
            /*   ======================================== */
            $nuevaEstados = \DB::table('tbl_estado_siniestro')
                            ->where('id_estado_siniestro', $llaveEstadoElCalificacionN)->get();
            foreach ($nuevaEstados as $nuevaEstado) {
                $trazaEstado->nuevo = $nuevaEstado->estado_siniestro;
            }
            $trazaEstado->llaveSiniestroEL = $idsiniestro;
            $trazaEstado->llaveUserPcTtraza = $request->input('modifica');
            $trazaEstado->save();
        }
        /* ==================================================== */
        // --================= Traza Usuario Asigando ==========--
        /* ==================================================== */

        if ($llaveUsuarioCalificadorElA != $llaveUsuarioCalificadorElN) {
            $trazaUsuario = new tbl_traza();
            $trazaUsuario->tipo = 'MEDICO CALIFICADOR';
            $anteriorUsuarios = \DB::table('users')
                            ->where('id', $llaveUsuarioCalificadorElA)->get();
            foreach ($anteriorUsuarios as $anteriorUsuario) {
                $trazaUsuario->anterior = $anteriorUsuario->name;
            }
            /*   ======================================== */
            $nuevaUsuarios = \DB::table('users')
                            ->where('id', $llaveUsuarioCalificadorElN)->get();
            foreach ($nuevaUsuarios as $nuevaUsuario) {
                $trazaUsuario->nuevo = $nuevaUsuario->name;
            }
            $trazaUsuario->llaveSiniestroEL = $idsiniestro;
            $trazaUsuario->llaveUserPcTtraza = $request->input('modifica');
            $trazaUsuario->save();
        }


        /* ==================================================== */
        // --================= Traza Ingreso Rehabilitacion=========--
        /* ==================================================== */

        if ($llaveIngresoRehabilitacionA != $llaveIngresoRehabilitacionN) {
            $trazaIngrReha = new tbl_traza();
            $trazaIngrReha->tipo = 'INGRESO REHABILITACION';
            $anteriorIngrRehas = \DB::table('tbl_ingreso_rehabilitacion')
                            ->where('idIngresoRehabilitacion', $llaveIngresoRehabilitacionA)->get();
            foreach ($anteriorIngrRehas as $anteriorIngrReha) {
                $trazaIngrReha->anterior = $anteriorIngrReha->ingresoRehabilitacion;
            }
            /*   ======================================== */
            $nuevaIngrRehas = \DB::table('tbl_ingreso_rehabilitacion')
                            ->where('idIngresoRehabilitacion', $llaveIngresoRehabilitacionN)->get();
            foreach ($nuevaIngrRehas as $nuevaIngrReha) {
                $trazaIngrReha->nuevo = $nuevaIngrReha->ingresoRehabilitacion;
            }
            $trazaIngrReha->llaveSiniestroEL = $idsiniestro;
            $trazaIngrReha->llaveUserPcTtraza = $request->input('modifica');
            $trazaIngrReha->save();
        }


        /* ==================================================== */
        // --================= Traza canal pruebas=========--
        /* ==================================================== */

        if ($llaveCanalEntradaPruebasA != $llaveCanalEntradaPruebasN) {
            $trazaCanalPrieba = new tbl_traza();
            $trazaCanalPrieba->tipo = 'CANAL ENTRADA PRUEBAS';
            $anteriorCanalPriebas = \DB::table('tbl_entrada_pruebas')
                            ->where('id_entrada_pruebas', $llaveCanalEntradaPruebasA)->get();
            foreach ($anteriorCanalPriebas as $anteriorCanalPrieba) {
                $trazaCanalPrieba->anterior = $anteriorCanalPrieba->entrada_prueba;
            }
            /*   ======================================== */
            $nuevaCanalPriebas = \DB::table('tbl_entrada_pruebas')
                            ->where('id_entrada_pruebas', $llaveCanalEntradaPruebasN)->get();
            foreach ($nuevaCanalPriebas as $nuevaCanalPrieba) {
                $trazaCanalPrieba->nuevo = $nuevaCanalPrieba->entrada_prueba;
            }
            $trazaCanalPrieba->llaveSiniestroEL = $idsiniestro;
            $trazaCanalPrieba->llaveUserPcTtraza = $request->input('modifica');
            $trazaCanalPrieba->save();
        }

        /* ==================================================== */
        // --================= Traza Origen primera oportunidad eps=========--
        /* ==================================================== */

        if ($llaveOrigenOportunidadEpsA != $llaveOrigenOportunidadEpsN) {
            $trazaOpEps = new tbl_traza();
            $trazaOpEps->tipo = 'ORIGEN PRIMER OPORTUNIDAD EPS';
            $anteriorOpEpss = \DB::table('tbl_origen_definicion')
                            ->where('id_origen_definicion', $llaveOrigenOportunidadEpsA)->get();
            foreach ($anteriorOpEpss as $anteriorOpEps) {
                $trazaOpEps->anterior = $anteriorOpEps->origen_definicion;
            }
            /*   ======================================== */
            $nuevaOpEpss = \DB::table('tbl_origen_definicion')
                            ->where('id_origen_definicion', $llaveOrigenOportunidadEpsN)->get();
            foreach ($nuevaOpEpss as $nuevaOpEps) {
                $trazaOpEps->nuevo = $nuevaOpEps->origen_definicion;
            }
            $trazaOpEps->llaveSiniestroEL = $idsiniestro;
            $trazaOpEps->llaveUserPcTtraza = $request->input('modifica');
            $trazaOpEps->save();
        }

        /* ==================================================== */
        // --================= Traza Origen primera oportunidad positiva=========--
        /* ==================================================== */

        if ($llaveOrigenOportunidadPositivaA != $llaveOrigenOportunidadPositivaN) {
            $trazaOpPo = new tbl_traza();
            $trazaOpPo->tipo = 'ORIGEN PRIMER OPORTUNIDAD POSITIVA';
            $anteriorOpPos = \DB::table('tbl_origen_definicion')
                            ->where('id_origen_definicion', $llaveOrigenOportunidadPositivaA)->get();
            foreach ($anteriorOpPos as $anteriorOpPo) {
                $trazaOpPo->anterior = $anteriorOpPo->origen_definicion;
            }
            /*   ======================================== */
            $nuevaOpPos = \DB::table('tbl_origen_definicion')
                            ->where('id_origen_definicion', $llaveOrigenOportunidadPositivaN)->get();
            foreach ($nuevaOpPos as $nuevaOpPo) {
                $trazaOpPo->nuevo = $nuevaOpPo->origen_definicion;
            }
            $trazaOpPo->llaveSiniestroEL = $idsiniestro;
            $trazaOpPo->llaveUserPcTtraza = $request->input('modifica');
            $trazaOpPo->save();
        }


        /* ==================================================== */
        // --================= Traza FECHA GESTION MEDICO==========--
        /* ==================================================== */

        if ($fechaGestionMedicoA != $fechaGestionMedicoN) {
            $trazarFechaGes = new tbl_traza();
            $trazarFechaGes->tipo = 'FECHA GESTION MEDICO';
            $trazarFechaGes->anterior = $fechaGestionMedicoA;
            /*   ======================================== */
            $trazarFechaGes->nuevo = $fechaGestionMedicoN;
            $trazarFechaGes->llaveSiniestroEL = $idsiniestro;
            $trazarFechaGes->llaveUserPcTtraza = $request->input('modifica');
            $trazarFechaGes->save();
        }
        /* ==================================================== */
        // --================= Traza FECHA SOLICITUD DE PRUEBAS==========--
        /* ==================================================== */

        if ($fechaSolicitudPruebasA != $fechaSolicitudPruebasN) {
            $trazarFechaSoli = new tbl_traza();
            $trazarFechaSoli->tipo = 'FECHA SOLICITUD DE PRUEBAS';
            $trazarFechaSoli->anterior = $fechaSolicitudPruebasA;
            /*   ======================================== */
            $trazarFechaSoli->nuevo = $fechaSolicitudPruebasN;
            $trazarFechaSoli->llaveSiniestroEL = $idsiniestro;
            $trazarFechaSoli->llaveUserPcTtraza = $request->input('modifica');
            $trazarFechaSoli->save();
        }

        /* ==================================================== */
        // --================= Traza FECHA SOLICITUD COMIT CODESS==========--
        /* ==================================================== */

        if ($fechaEnvioComiteCodessA != $fechaEnvioComiteCodessN) {
            $trazarFechaEnvi = new tbl_traza();
            $trazarFechaEnvi->tipo = 'FECHA ENVIO COMITE CODESS';
            $trazarFechaEnvi->anterior = $fechaEnvioComiteCodessA;
            /*   ======================================== */
            $trazarFechaEnvi->nuevo = $fechaEnvioComiteCodessN;
            $trazarFechaEnvi->llaveSiniestroEL = $idsiniestro;
            $trazarFechaEnvi->llaveUserPcTtraza = $request->input('modifica');
            $trazarFechaEnvi->save();
        }


        /* ==================================================== */
        // --================= Traza FECHA AVAL COMITE==========--
        /* ==================================================== */

        if ($fechaAvalComiteCodessA != $fechaAvalComiteCodessN) {
            $trazarFechaAva = new tbl_traza();
            $trazarFechaAva->tipo = 'FECHA  AVAL COMITE';
            $trazarFechaAva->anterior = $fechaAvalComiteCodessA;
            /*   ======================================== */
            $trazarFechaAva->nuevo = $fechaAvalComiteCodessN;
            $trazarFechaAva->llaveSiniestroEL = $idsiniestro;
            $trazarFechaAva->llaveUserPcTtraza = $request->input('modifica');
            $trazarFechaAva->save();
        }


        /* ==================================================== */
        // --================= Traza FECHA RADICADO SALIDA==========--
        /* ==================================================== */

        if ($fechaRadicadoSalidaA != $fechaRadicadoSalidaN) {
            $trazarFechaRa = new tbl_traza();
            $trazarFechaRa->tipo = 'FECHA  RADICADO SALIDA';
            $trazarFechaRa->anterior = $fechaRadicadoSalidaA;
            /*   ======================================== */
            $trazarFechaRa->nuevo = $fechaRadicadoSalidaN;
            $trazarFechaRa->llaveSiniestroEL = $idsiniestro;
            $trazarFechaRa->llaveUserPcTtraza = $request->input('modifica');
            $trazarFechaRa->save();
        }

        /* ==================================================== */
        // --================= Traza FECHA RADICADO SALIDA==========--
        /* ==================================================== */

        if ($fechaIngresoPruebasA != $fechaIngresoPruebasN) {
            $trazarFechaIngr = new tbl_traza();
            $trazarFechaIngr->tipo = 'FECHA  INGRESO PRUEBAS';
            $trazarFechaIngr->anterior = $fechaIngresoPruebasA;
            /*   ======================================== */
            $trazarFechaIngr->nuevo = $fechaIngresoPruebasN;
            $trazarFechaIngr->llaveSiniestroEL = $idsiniestro;
            $trazarFechaIngr->llaveUserPcTtraza = $request->input('modifica');
            $trazarFechaIngr->save();
        }

        /* ==================================================== */
        // --================= Traza numero Radicado SalidaA=========--
        /* ==================================================== */

        if ($numeroRadicadoSalidaA != $numeroRadicadoSalidaN) {
            $trazarNumeroRad = new tbl_traza();
            $trazarNumeroRad->tipo = 'NUMERO RADICADO SALIDA';
            $trazarNumeroRad->anterior = $numeroRadicadoSalidaA;
            /*   ======================================== */
            $trazarNumeroRad->nuevo = $numeroRadicadoSalidaN;
            $trazarNumeroRad->llaveSiniestroEL = $idsiniestro;
            $trazarNumeroRad->llaveUserPcTtraza = $request->input('modifica');
            $trazarNumeroRad->save();
        }

        /* ==================================================== */
        // --================= Traza numero Radicado SalidaA=========--
        /* ==================================================== */

        if ($radicadoEntradaPruebasA != $radicadoEntradaPruebasN) {
            $trazarRadicadoEn = new tbl_traza();
            $trazarRadicadoEn->tipo = 'RADICADO ENTRADA PRUEBAS';
            $trazarRadicadoEn->anterior = $radicadoEntradaPruebasA;
            /*   ======================================== */
            $trazarRadicadoEn->nuevo = $radicadoEntradaPruebasN;
            $trazarRadicadoEn->llaveSiniestroEL = $idsiniestro;
            $trazarRadicadoEn->llaveUserPcTtraza = $request->input('modifica');
            $trazarRadicadoEn->save();
        }

        return redirect('/Siniestro_El/' . $idsiniestro . '/edit');
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
