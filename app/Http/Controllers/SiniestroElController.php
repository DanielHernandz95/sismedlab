<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbl_el_siniestros;
use App\tbl_traza;
use App\tbl_el_calificacione;
use App\tbl_empresa;
use App\tbl_asignacion_cuida_uno;
use App\tbl_afiliado;
use App\tbl_el_observacione;
use App\tbl_ep;
use App\User;
use App\tbl_el_precalificacione;

class SiniestroElController extends Controller {

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

        $siniestroEl = new tbl_el_siniestros();
        $empresa = new tbl_empresa();
        $afiliado = new tbl_afiliado();
        $traza = new tbl_traza();
        $califiacionEl = new tbl_el_calificacione;
        $cuidaUno = new tbl_asignacion_cuida_uno();
        $precalificacionEl = new tbl_el_precalificacione();

        /* ======================Registtro en la tabla Afiliado============================== */
        $afiliadoExiste = $request->input('TxtAfiliadoYaExiste');


        if ($afiliadoExiste != 'SI') {
            $afiliado->llaveTipoDocumento = $request->input('TxtTipoDocumento');
            $afiliado->documento = $request->input('txtNumeroDocumento');
            $afiliado->nombre = $request->input('txtNombre');
            $afiliado->direccionResi = $request->input('txtDireccion');
            $afiliado->llaveDepartamento = $request->input('txtDepartamento');
            $afiliado->llaveCiudad = $request->input('llaveCiudad');
            $afiliado->celular = $request->input('txtNumeroCelular');
            $afiliado->Correo = $request->input('txtCorreo');
            $afiliado->telefono = $request->input('txtTelefonoFijo');
            $afiliado->llaveGenero = $request->input('TxtGenero');
            $afiliado->fechaNacimiento = $request->input('fechaNacimiento');
            $afiliado->save();
            $idAfiliado = $afiliado->idAfiliado;
        }

        /* ======================Registtro en la tabla Empresa============================== */
        $empresaNueva = $request->input('TxtEmpresaNueva');
        if ($empresaNueva == 'SI') {
            $empresa->nit = $request->input('TxtNitEmpresa');
            $empresa->razon_social_empleador = $request->input('txtRazonSocial');
            $empresa->llave_departamento = $request->input('txtSucursalEmpresa');
            $empresa->llave_tipo_docuemtno = $request->input('txtTipoDocumentoEmpresa');
            $empresa->correo = $request->input('txtCorreo');
            $empresa->direccion = $request->input('txtDireccion');
            $empresa->save();
            $idEmpresa = $empresa->id_empresa;
        } else {
            /* ==============Actualiza la empreza======================== */
            $idEmpresa = $request->input('txtIdedmpresa');

            $empresaUpdate = tbl_empresa::where('id_empresa', '=', $idEmpresa)->firstOrFail();
            $empresaUpdate->fill($request->all());
            $empresaUpdate->save();
        }

        $tipoSolicitud = $request->input('txtTipoSolicitud');

        if ($tipoSolicitud != 12) {
            /* ======================Registro eps============================== */
            $idEpsUpdate = $request->input('TxtEps');

            /* ==============Actualiza la eps======================== */

            $epsUpdate = tbl_ep::where('id_eps', '=', $idEpsUpdate)->firstOrFail();
            $epsUpdate->fill($request->all());
            $epsUpdate->save();
        }



        /* ======================Registtro en la tabla SiniestroEL============================== */
        $siniestroEl->llaveCanlaEntradaEl = $request->input('txtCanalEntrada');
        $siniestroEl->llaveTipoSolicitudEl = $request->input('txtTipoSolicitud');
        $siniestroEl->llaveCovid = $request->input('txtCovid');
        $siniestroEl->fechaRadicadoArlPositiva = $request->input('TxtFechaRadicacionArlPositiva');
        // $siniestroEl->fechaAsignacionPqr = $request->input('TxtFechaAsignacionPqr');
        $siniestroEl->llaveUsuarioAsignador = $request->input('TxtUsuarioQuienCrea');
        $siniestroEl->numeroRadicadoEntrada = $request->input('TxtNumeroRadicadoEntrada');
        $siniestroEl->llaveDepartramentoEl = $request->input('txtDepartamentoSiniestro');
        $siniestroEl->llaveCiudadEl = $request->input('TxtCiudadSiniestro');
        $siniestroEl->numeroSiniestro = $request->input('txtNumeroSiniestro');

        /* =============Si el afiliado es nuevo ======================== */
        if ($afiliadoExiste != 'SI') {
            $siniestroEl->llaveAfiliadoEl = $idAfiliado;
        } else {
            $siniestroEl->llaveAfiliadoEl = $request->input('TxtIdAfiliado');
        }
        /* ==============Si la empresa es nueva ======================== */
        if ($empresaNueva == 'SI') {
            /* ==============Si la empresa es nueva ======================== */
            $siniestroEl->llaveEmpresaEl = $idEmpresa;
        } else {
            /* ==============Si la empresa ya existe ======================== */
            $siniestroEl->llaveEmpresaEl = $request->input('txtIdedmpresa');
        }


        //$siniestroEl->fechaEnfermedad = $request->input('TxtFechaEnfermedad');
        $siniestroEl->llaveCobertura = $request->input('txtCobertura');
        $siniestroEl->llaveRevicionCobertura = $request->input('txtRevisionCobertura');
        $siniestroEl->raSalidaCoBerturaDevolucionEps = $request->input('txtRadicadoCoberturaDebolucion');
        $siniestroEl->definicionOrigenPrimeraOportunidadEps = $request->input('txtDefinicionOportinidadEps');
        $siniestroEl->definicionOrigenPrimeraOportunidadPositiva = $request->input('txtDefinicionOportinidadPositiva');
        $siniestroEl->origenCreacion = 'MANUAL';
        $siniestroEl->llaveEpsEl = $request->input('TxtEps');
        $siniestroEl->folioEl = $request->input('TxtFolio');

        $siniestroEl->save();
        $idSiniestroEl = $siniestroEl->id_elSiniestro;



        $marcacionCovid = $request->input('txtCovid');


        $conexion1 = mysqli_connect('localhost', 'Admin', 'T3cnolog14', 'db_spiatel', '3306');

        if ($marcacionCovid == 1) {

            /* ==========================Medico=============================== */
            $asignarCapacidadLimite = User::orderBy('cuantos', 'ASC')
                    ->join('tbl_el_precalificaciones', 'tbl_el_precalificaciones.llaveUsuarioPrecalificacionEl', '=', 'users.id')
                    ->where('llaveEstadoGestionEl', '=', '1')
                    ->where('llave_estado', '=', '1')
                    ->where('llaveRol_usuario', '=', '22')
                    ->where('capacidadBandejaCasos', '!=', 'SIN LIMITES')
                    ->where('capacidadBandejaCasos', '!=', 'NO APLICA')
                    ->groupBy('id')
                    ->select(\DB::raw('count(*) as cuantos,id'))
                    ->get();
            $dos = 0;
            $siDos = false;
            if (count($asignarCapacidadLimite)) {
                foreach ($asignarCapacidadLimite as $medicolimite) {
                    $dos += 1;
                    $siDos = true;
                }
            }
            /* ==========================Total limite=============================== */
            $asignarTotalLimite = User::where('llave_estado', '=', '1')
                    ->where('capacidadBandejaCasos', '!=', 'SIN LIMITES')
                    ->where('capacidadBandejaCasos', '!=', 'NO APLICA')
                    ->where('llaveRol_usuario', '=', '22')
                    ->get();
            $uno = 0;
            if (count($asignarTotalLimite)) {
                foreach ($asignarTotalLimite as $asiTotalLimite) {
                    $uno += 1;
                }
            }

            /* ==========================Sin Limite=============================== */
            $sinLimiteAsig = User::orderBy('cuantos', 'ASC')
                    ->join('tbl_el_precalificaciones', 'tbl_el_precalificaciones.llaveUsuarioPrecalificacionEl', '=', 'users.id')
                    ->where('llaveEstadoGestionEl', '=', '1')
                    ->where('capacidadBandejaCasos', '=', 'SIN LIMITES')
                    ->where('llave_estado', '=', '1')
                    ->where('llaveRol_usuario', '=', '22')
                    ->groupBy('id')
                    ->select(\DB::raw('count(*) as cuantos,id'))
                    ->get();
            $limiteCuento = 0;
            $limiteSiNo = false;
            if (count($sinLimiteAsig)) {
                foreach ($sinLimiteAsig as $sLi) {
                    $limiteCuento += 1;
                    $limiteSiNo = true;
                }
            }

            /* ==========================Total Sin limite=============================== */
            $TotalSinLimite = User::where('capacidadBandejaCasos', '!=', 'NO APLICA')
                    ->where('capacidadBandejaCasos', '=', 'SIN LIMITES')
                    ->where('llaveRol_usuario', '=', '22')
                    ->where('llave_estado', '=', '1')
                    ->get();
            $SinLimiteCuento = 0;
            if (count($TotalSinLimite)) {
                foreach ($TotalSinLimite as $tlim) {
                    $SinLimiteCuento += 1;
                }
            }
            /* =========Si los usuarios Del sistemas Son iguales
             *  a los Asigandos Asina siempre al menor ============== */
            if ($dos == $uno) {
                $sqlLimite = "SELECT 
                            COUNT(*) AS cuantos, name, capacidadBandejaCasos, id
                        FROM
                            users AS u
                                LEFT JOIN
                            tbl_el_precalificaciones AS c ON c.llaveUsuarioPrecalificacionEl = u.id
                        WHERE
                            llaveEstadoGestionEl = 1
                                AND llave_estado = 1
                                AND capacidadBandejaCasos != 'SIN LIMITES'
                                AND capacidadBandejaCasos != 'NO APLICA'    
                                 AND llaveRol_usuario = 22
                                
                        GROUP BY id
                        order by cuantos Asc";
                $lim = mysqli_query($conexion1, $sqlLimite);
                $noentra = false;
                foreach ($lim as $medicoLim) {
                    if ($medicoLim['capacidadBandejaCasos'] > $medicoLim['cuantos']) {
                        $precalificacionEl->llaveUsuarioPrecalificacionEl = $medicoLim['id'];
                        $noentra = true;
                        break;
                    }
                }
                if ($noentra == false) {

                    /* =========Si los usuarios Del sistemas Son iguales
                     *  a los Asigandos Asina siempre al menor ============== */
                    if ($limiteCuento == $SinLimiteCuento) {

                        $sqlSinLimite = "SELECT 
                            COUNT(*) AS cuantos, name, capacidadBandejaCasos, id
                        FROM
                            users AS u
                                LEFT JOIN
                            tbl_el_precalificaciones AS c ON c.llaveUsuarioPrecalificacionEl = u.id
                        WHERE
                            llaveEstadoGestionEl = 1
                                AND capacidadBandejaCasos = 'SIN LIMITES'
                                AND llave_estado = 1
                                AND llaveRol_usuario = 22
                                
                        GROUP BY id
                        order by cuantos Asc";
                        $sinLimit = mysqli_query($conexion1, $sqlSinLimite);
                        $noentra = false;
                        foreach ($sinLimit as $medicoSinln) {
                            $precalificacionEl->llaveUsuarioPrecalificacionEl = $medicoSinln['id'];
                            break;
                            $noentra = true;
                        }
                    }
                    /* ==== Si no hay calificaciones asigandas en estado asignado
                     * ========  Asigna A cualquiera que lo cumnpla ========== */
                    if ($limiteSiNo == false) {

                        $sqlSiNo = "SELECT 
                            *
                         FROM users AS u
                            left JOIN tbl_el_precalificaciones AS c ON c.llaveUsuarioPrecalificacionEl = u.id
                            where capacidadBandejaCasos = 'SIN LIMITES'
                                    AND llave_estado = 1
                                    AND llaveRol_usuario = 22
                                ";
                        $resultSiNo = mysqli_query($conexion1, $sqlSiNo);
                        while ($resultadoSiNo = mysqli_fetch_array($resultSiNo)) {
                            $precalificacionEl->llaveUsuarioPrecalificacionEl = $resultadoSiNo['id'];
                        }
                    }

                    /*  =================Asigna Casos A todos los usuarios del 
                     * sistemas inicializa en 1 =================== */

                    if ($limiteSiNo == true && $limiteCuento < $SinLimiteCuento) {
                        $asignarCapacidadDiferente = User::orderBy('cuantos', 'ASC')
                                ->join('tbl_el_precalificaciones', 'tbl_el_precalificaciones.llaveUsuarioPrecalificacionEl', '=', 'users.id')
                                ->where('llaveEstadoGestionEl', '=', '1')
                                ->where('capacidadBandejaCasos', '=', 'SIN LIMITES')
                                ->where('llave_estado', '=', '1')
                                ->where('llaveRol_usuario', '=', '22')
                                ->groupBy('id')
                                ->select(\DB::raw('count(*) as cuantos,id'))
                                ->get();
                        if (count($asignarCapacidadDiferente)) {
                            $con;
                            foreach ($asignarCapacidadDiferente as $difer) {
                                //$con = $difer->id;
                                $con = $con = "and id != '$difer->id'";
                            }
                        }
                        $busca = "SELECT 
                            *
                         FROM users AS u
                            left JOIN tbl_el_precalificaciones AS c ON c.llaveUsuarioPrecalificacionEl = u.id
                            where capacidadBandejaCasos = 'SIN LIMITES' 
                                AND llave_estado = 1
                                AND llaveRol_usuario = 22
                                ";
                        $resultBusca = mysqli_query($conexion1, $busca);
                        while ($resultadobusca = mysqli_fetch_array($resultBusca)) {
                            $precalificacionEl->llaveUsuarioPrecalificacionEl = $resultadobusca['id'];
                        }
                    }
                }
            }
            /* ==== Si no hay calificaciones asigandas en estado asignado
             * ========  Asigna A cualquiera que lo cumnpla ========== */
            if ($siDos == false) {

                $sqlASigInicio = "SELECT 
                            *
                         FROM users AS u
                            left JOIN tbl_el_precalificaciones AS c ON c.llaveUsuarioPrecalificacionEl = u.id
                            where capacidadBandejaCasos != 'SIN LIMITES' 
                                AND capacidadBandejaCasos != 'NO APLICA'
                                AND llave_estado = 1
                              AND llaveRol_usuario = 22
                                ";
                $resultInicio = mysqli_query($conexion1, $sqlASigInicio);
                while ($resultadoInicio = mysqli_fetch_array($resultInicio)) {
                    $precalificacionEl->llaveUsuarioPrecalificacionEl = $resultadoInicio['id'];
                }
            }

            /*  =================Asina Casos A todos los usuarios del 
             * sistemas inicializa en 1 =================== */
            if ($siDos == true && $dos < $uno) {

                $asignarCapacidadDiferented = User::orderBy('cuantos', 'ASC')
                        ->join('tbl_el_precalificaciones', 'tbl_el_precalificaciones.llaveUsuarioPrecalificacionEl', '=', 'users.id')
                        ->where('llaveEstadoGestionEl', '=', '1')
                        ->where('capacidadBandejaCasos', '!=', 'SIN LIMITES')
                        ->where('capacidadBandejaCasos', '!=', 'NO APLICA')
                        ->where('llaveRol_usuario', '=', '22')
                        ->where('llave_estado', '=', '1')
                        ->groupBy('id')
                        ->select(\DB::raw('count(*) as cuantos,id'))
                        ->get();
                if (count($asignarCapacidadDiferented)) {
                    $con;
                    foreach ($asignarCapacidadDiferented as $difer1) {
                        //$con = $difer->id;
                        $con = $con = "and id != '$difer1->id'";
                    }
                }
                /* consultar un arreglo */
                $sacarId = "SELECT 
                            *
                         FROM users AS u
                            left JOIN tbl_el_precalificaciones AS c ON c.llaveUsuarioPrecalificacionEl = u.id
                            where capacidadBandejaCasos != 'SIN LIMITES' 
                                 AND capacidadBandejaCasos != 'NO APLICA' 
                                 AND llave_estado = 1
                                 AND llaveRol_usuario = 22
                                ";
                $resultId = mysqli_query($conexion1, $sacarId);
                while ($resultadoId = mysqli_fetch_array($resultId)) {
                    $precalificacionEl->llaveUsuarioPrecalificacionEl = $resultadoId['id'];
                }
            }
            $precalificacionEl->llaveEstadoGestionEl = '1';
            //$califiacionEl->llaveUsuarioCalificadorEl = $request->input('TxtAsiganar');
            $precalificacionEl->save();
            $idPrecalificacionEl = $precalificacionEl->idElPrecalificacion;

            /* =======================update  Formulario 'formularios'=========================== */
            tbl_el_siniestros::where('id_elSiniestro', '=', $idSiniestroEl)->update(['llavePrecalificacionEl' => $idPrecalificacionEl]);
            /* ============== crear cuida uno Segun  coresponda tipo de canal entrada ======================== */
        } else {

            /* ==========================Medico=============================== */
            $asignarCapacidadLimite = User::orderBy('cuantos', 'ASC')
                    ->join('tbl_el_calificaciones', 'tbl_el_calificaciones.llaveUsuarioCalificadorEl', '=', 'users.id')
                    ->where('llaveEstadoElCalificacion', '=', '1')
                    ->where('llave_estado', '=', '1')
                    ->where('llaveRol_usuario', '=', '21')
                    ->where('capacidadBandejaCasos', '!=', 'SIN LIMITES')
                    ->where('capacidadBandejaCasos', '!=', 'NO APLICA')
                    ->groupBy('id')
                    ->select(\DB::raw('count(*) as cuantos,id'))
                    ->get();
            $dos = 0;
            $siDos = false;
            if (count($asignarCapacidadLimite)) {
                foreach ($asignarCapacidadLimite as $medicolimite) {
                    $dos += 1;
                    $siDos = true;
                }
            }
            /* ==========================Total limite=============================== */
            $asignarTotalLimite = User::where('llave_estado', '=', '1')
                    ->where('capacidadBandejaCasos', '!=', 'SIN LIMITES')
                    ->where('capacidadBandejaCasos', '!=', 'NO APLICA')
                    ->where('llaveRol_usuario', '=', '21')
                    ->get();
            $uno = 0;
            if (count($asignarTotalLimite)) {
                foreach ($asignarTotalLimite as $asiTotalLimite) {
                    $uno += 1;
                }
            }

            /* ==========================Sin Limite=============================== */
            $sinLimiteAsig = User::orderBy('cuantos', 'ASC')
                    ->join('tbl_el_calificaciones', 'tbl_el_calificaciones.llaveUsuarioCalificadorEl', '=', 'users.id')
                    ->where('llaveEstadoElCalificacion', '=', '1')
                    ->where('capacidadBandejaCasos', '=', 'SIN LIMITES')
                    ->where('llave_estado', '=', '1')
                    ->where('llaveRol_usuario', '=', '21')
                    ->groupBy('id')
                    ->select(\DB::raw('count(*) as cuantos,id'))
                    ->get();
            $limiteCuento = 0;
            $limiteSiNo = false;
            if (count($sinLimiteAsig)) {
                foreach ($sinLimiteAsig as $sLi) {
                    $limiteCuento += 1;
                    $limiteSiNo = true;
                }
            }

            /* ==========================Total Sin limite=============================== */
            $TotalSinLimite = User::where('capacidadBandejaCasos', '!=', 'NO APLICA')
                    ->where('capacidadBandejaCasos', '=', 'SIN LIMITES')
                    ->where('llaveRol_usuario', '=', '21')
                    ->where('llave_estado', '=', '1')
                    ->get();
            $SinLimiteCuento = 0;
            if (count($TotalSinLimite)) {
                foreach ($TotalSinLimite as $tlim) {
                    $SinLimiteCuento += 1;
                }
            }
            /* =========Si los usuarios Del sistemas Son iguales
             *  a los Asigandos Asina siempre al menor ============== */
            if ($dos == $uno) {
                $sqlLimite = "SELECT 
                            COUNT(*) AS cuantos, name, capacidadBandejaCasos, id
                        FROM
                            users AS u
                                LEFT JOIN
                            tbl_el_calificaciones AS c ON c.llaveUsuarioCalificadorEl = u.id
                        WHERE
                            llaveEstadoElCalificacion = 1
                                AND llave_estado = 1
                                AND capacidadBandejaCasos != 'SIN LIMITES'
                                AND capacidadBandejaCasos != 'NO APLICA'    
                                 AND llaveRol_usuario = 21
                                
                        GROUP BY id
                        order by cuantos Asc";
                $lim = mysqli_query($conexion1, $sqlLimite);
                $noentra = false;
                foreach ($lim as $medicoLim) {
                    if ($medicoLim['capacidadBandejaCasos'] > $medicoLim['cuantos']) {
                        $califiacionEl->llaveUsuarioCalificadorEl = $medicoLim['id'];
                        $noentra = true;
                        break;
                    }
                }
                if ($noentra == false) {

                    /* =========Si los usuarios Del sistemas Son iguales
                     *  a los Asigandos Asina siempre al menor ============== */
                    if ($limiteCuento == $SinLimiteCuento) {

                        $sqlSinLimite = "SELECT 
                            COUNT(*) AS cuantos, name, capacidadBandejaCasos, id
                        FROM
                            users AS u
                                LEFT JOIN
                            tbl_el_calificaciones AS c ON c.llaveUsuarioCalificadorEl = u.id
                        WHERE
                            llaveEstadoElCalificacion = 1
                                AND capacidadBandejaCasos = 'SIN LIMITES'
                                AND llave_estado = 1
                                AND llaveRol_usuario = 21
                                
                        GROUP BY id
                        order by cuantos Asc";
                        $sinLimit = mysqli_query($conexion1, $sqlSinLimite);
                        $noentra = false;
                        foreach ($sinLimit as $medicoSinln) {
                            $califiacionEl->llaveUsuarioCalificadorEl = $medicoSinln['id'];
                            break;
                            $noentra = true;
                        }
                    }
                    /* ==== Si no hay calificaciones asigandas en estado asignado
                     * ========  Asigna A cualquiera que lo cumnpla ========== */
                    if ($limiteSiNo == false) {

                        $sqlSiNo = "SELECT 
                            *
                         FROM users AS u
                            left JOIN tbl_el_calificaciones AS c ON c.llaveUsuarioCalificadorEl = u.id
                            where capacidadBandejaCasos = 'SIN LIMITES'
                                    AND llave_estado = 1
                                    AND llaveRol_usuario = 21
                                ";
                        $resultSiNo = mysqli_query($conexion1, $sqlSiNo);
                        while ($resultadoSiNo = mysqli_fetch_array($resultSiNo)) {
                            $califiacionEl->llaveUsuarioCalificadorEl = $resultadoSiNo['id'];
                        }
                    }

                    /*  =================Asigna Casos A todos los usuarios del 
                     * sistemas inicializa en 1 =================== */

                    if ($limiteSiNo == true && $limiteCuento < $SinLimiteCuento) {
                        $asignarCapacidadDiferente = User::orderBy('cuantos', 'ASC')
                                ->join('tbl_el_calificaciones', 'tbl_el_calificaciones.llaveUsuarioCalificadorEl', '=', 'users.id')
                                ->where('llaveEstadoElCalificacion', '=', '1')
                                ->where('capacidadBandejaCasos', '=', 'SIN LIMITES')
                                ->where('llave_estado', '=', '1')
                                ->where('llaveRol_usuario', '=', '21')
                                ->groupBy('id')
                                ->select(\DB::raw('count(*) as cuantos,id'))
                                ->get();
                        if (count($asignarCapacidadDiferente)) {
                            $con;
                            foreach ($asignarCapacidadDiferente as $difer) {
                                //$con = $difer->id;
                                $con = $con = "and id != '$difer->id'";
                            }
                        }
                        $busca = "SELECT 
                            *
                         FROM users AS u
                            left JOIN tbl_el_calificaciones AS c ON c.llaveUsuarioCalificadorEl = u.id
                            where capacidadBandejaCasos = 'SIN LIMITES' 
                                AND llave_estado = 1
                                AND llaveRol_usuario = 21
                                ";
                        $resultBusca = mysqli_query($conexion1, $busca);
                        while ($resultadobusca = mysqli_fetch_array($resultBusca)) {
                            $califiacionEl->llaveUsuarioCalificadorEl = $resultadobusca['id'];
                        }
                    }
                }
            }
            /* ==== Si no hay calificaciones asigandas en estado asignado
             * ========  Asigna A cualquiera que lo cumnpla ========== */
            if ($siDos == false) {

                $sqlASigInicio = "SELECT 
                            *
                         FROM users AS u
                            left JOIN tbl_el_calificaciones AS c ON c.llaveUsuarioCalificadorEl = u.id
                            where capacidadBandejaCasos != 'SIN LIMITES' 
                                AND capacidadBandejaCasos != 'NO APLICA'
                                AND llave_estado = 1
                              AND llaveRol_usuario = 21
                                ";
                $resultInicio = mysqli_query($conexion1, $sqlASigInicio);
                while ($resultadoInicio = mysqli_fetch_array($resultInicio)) {
                    $califiacionEl->llaveUsuarioCalificadorEl = $resultadoInicio['id'];
                }
            }

            /*  =================Asina Casos A todos los usuarios del 
             * sistemas inicializa en 1 =================== */
            if ($siDos == true && $dos < $uno) {

                $asignarCapacidadDiferented = User::orderBy('cuantos', 'ASC')
                        ->join('tbl_el_calificaciones', 'tbl_el_calificaciones.llaveUsuarioCalificadorEl', '=', 'users.id')
                        ->where('llaveEstadoElCalificacion', '=', '1')
                        ->where('capacidadBandejaCasos', '!=', 'SIN LIMITES')
                        ->where('capacidadBandejaCasos', '!=', 'NO APLICA')
                        ->where('llaveRol_usuario', '=', '21')
                        ->where('llave_estado', '=', '1')
                        ->groupBy('id')
                        ->select(\DB::raw('count(*) as cuantos,id'))
                        ->get();
                if (count($asignarCapacidadDiferented)) {
                    $con;
                    foreach ($asignarCapacidadDiferented as $difer1) {
                        //$con = $difer->id;
                        $con = $con = "and id != '$difer1->id'";
                    }
                }
                /* consultar un arreglo */
                $sacarId = "SELECT 
                            *
                         FROM users AS u
                            left JOIN tbl_el_calificaciones AS c ON c.llaveUsuarioCalificadorEl = u.id
                            where capacidadBandejaCasos != 'SIN LIMITES' 
                                 AND capacidadBandejaCasos != 'NO APLICA' 
                                 AND llave_estado = 1
                                 AND llaveRol_usuario = 21
                                ";
                $resultId = mysqli_query($conexion1, $sacarId);
                while ($resultadoId = mysqli_fetch_array($resultId)) {
                    $califiacionEl->llaveUsuarioCalificadorEl = $resultadoId['id'];
                }
            }
            $califiacionEl->llaveEstadoElCalificacion = '1';
            //$califiacionEl->llaveUsuarioCalificadorEl = $request->input('TxtAsiganar');
            $califiacionEl->save();
            $idCalificacionEl = $califiacionEl->idElCalificaciones;

            /* =======================update  Formulario 'formularios'=========================== */
            tbl_el_siniestros::where('id_elSiniestro', '=', $idSiniestroEl)->update(['llaveCalificacionEl' => $idCalificacionEl]);
            /* ============== crear cuida uno Segun  coresponda tipo de canal entrada ======================== */
        }





        $tipoCanalEntrada = $request->input('txtCanalEntrada');
        if ($tipoCanalEntrada == 26) {
            $cuidaUno->fechaRevicion = $request->input('TxtFechaRevision');
            $cuidaUno->llaveAfiliacion = $request->input('TxtAfiliacion');
            $cuidaUno->llaveCreado = $request->input('TxtCreado');
            $cuidaUno->fechaCreacion = $request->input('TxtFechaCreacion');
            $cuidaUno->llaveUsuarioResponsable = $request->input('TxtUsuarioQuienCrea');
            $cuidaUno->llaveEstadoInicial = $request->input('TxtEstadoInicial');
            $cuidaUno->llaveGestionRealizada = $request->input('TxtGestionRealizar');
            $cuidaUno->llaveEstadoTramite = $request->input('TxtEstadoTramite');
            $cuidaUno->llaveEstadoFinal = $request->input('TxtEstadoFinal');
            $cuidaUno->save();
            $idCuidadUno = $cuidaUno->idAsignacionCuidaUno;
            /* =======================update  Formulario 'formularios'=========================== */
            tbl_el_siniestros::where('id_elSiniestro', '=', $idSiniestroEl)->update(['llaveUnionCasosCuida' => $idCuidadUno]);
            /* ====================Observaciones======================= */
            $ob = $request->input('TxtObservacionElCuida');
            if ($ob != NULL) {
                $observaciones = new tbl_el_observacione();
                $observaciones->observacion = $request->input('TxtObservacionElCuida');
                $observaciones->llaveCuidaEl = $idCuidadUno;
                $observaciones->save();
            }
        }


        /* ==================================================== */
        // --===================Traza empreza==================--
        /* ==================================================== */

        $traza->tipo = 'CREACION DEL SINIESTRO';
        $traza->llaveSiniestroEL = $idSiniestroEl;
        $traza->llaveUserPcTtraza = $request->input('TxtUsuarioQuienCrea');
        $traza->save();





        return redirect('/Siniestro_El/' . $idSiniestroEl . '/edit');

        //return $idSiniestroEl;
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


        /* ===================================Listas El ========================================= */

        $entradaPclEl = \DB::table('tbl_entrada')->where('procesoEntrada', 'El')
                        ->where('id_entrada', '!=', function($query) use ($id) {
                            $query
                            ->select(\DB::raw("llaveCanlaEntradaEl"))
                            ->from('tbl_el_siniestros')
                            ->where('id_elSiniestro', '=', $id);
                        })->get();

        $tipoSolicitudEl = \DB::table('tbl_solicitud')->where('procesoSolicitud', 'El')
                        ->where('id_solicitud', '!=', function($query) use ($id) {
                            $query
                            ->select(\DB::raw("llaveTipoSolicitudEl"))
                            ->from('tbl_el_siniestros')
                            ->where('id_elSiniestro', '=', $id);
                        })->get();

        $covid = \DB::table('tbl_covid')->get();


        $departamento = \DB::table('tbl_departamento')->get();

        $departamentoAdiliado = \DB::table('tbl_departamento')->get();

        $cobertura = \DB::table('tbl_cobertura')
                ->get();

        $revicionCoberturas = \DB::table('tbl_revision_cobertura')
                ->get();


        $usuariosEl = \DB::table('users')
                ->leftjoin('tbl_rol', 'tbl_rol.id_rol', '=', 'users.llaveRol_usuario')
                ->where('rol', '=', 'CALIFICADOR_EL')
                ->orderBy('name')
                ->get();

        $afiliado = \DB::table('tbl_afiliacion')
                        ->where('idAfiliacion', '!=', function($query) use ($id) {
                            $query
                            ->select(\DB::raw("llaveAfiliacion"))
                            ->from('tbl_el_siniestros as s')
                            ->leftjoin('tbl_asignacion_cuida_unos as re', 're.idAsignacionCuidaUno', '=', 's.llaveUnionCasosCuida')
                            ->where('id_elSiniestro', '=', $id);
                        })->get();

        $creado = \DB::table('tbl_creado')
                        ->where('idCreado', '!=', function($query) use ($id) {
                            $query
                            ->select(\DB::raw("llaveCreado"))
                            ->from('tbl_el_siniestros as s')
                            ->leftjoin('tbl_asignacion_cuida_unos as re', 're.idAsignacionCuidaUno', '=', 's.llaveUnionCasosCuida')
                            ->where('id_elSiniestro', '=', $id);
                        })->get();

        $estadoIniciail = \DB::table('tbl_estado_siniestro')
                        ->where('filtro', 'INICIAL_EL')
                        ->where('id_estado_siniestro', '!=', function($query) use ($id) {
                            $query
                            ->select(\DB::raw("llaveEstadoInicial"))
                            ->from('tbl_el_siniestros as s')
                            ->leftjoin('tbl_asignacion_cuida_unos as re', 're.idAsignacionCuidaUno', '=', 's.llaveUnionCasosCuida')
                            ->where('id_elSiniestro', '=', $id);
                        })->get();
        $estadoTramite = \DB::table('tbl_estado_siniestro')
                        ->where('filtro', 'TRAMITEL_EL')
                        ->where('id_estado_siniestro', '!=', function($query) use ($id) {
                            $query
                            ->select(\DB::raw("llaveEstadoTramite"))
                            ->from('tbl_el_siniestros as s')
                            ->leftjoin('tbl_asignacion_cuida_unos as re', 're.idAsignacionCuidaUno', '=', 's.llaveUnionCasosCuida')
                            ->where('id_elSiniestro', '=', $id);
                        })->get();
        $estadoFinal = \DB::table('tbl_estado_siniestro')
                        ->where('filtro', 'FINAL_EL')
                        ->where('id_estado_siniestro', '!=', function($query) use ($id) {
                            $query
                            ->select(\DB::raw("llaveEstadoFinal"))
                            ->from('tbl_el_siniestros as s')
                            ->leftjoin('tbl_asignacion_cuida_unos as re', 're.idAsignacionCuidaUno', '=', 's.llaveUnionCasosCuida')
                            ->where('id_elSiniestro', '=', $id);
                        })->get();
        $gestionRealizar = \DB::table('tbl_gestion_realizar')
                        ->where('idGestionRealizar', '!=', function($query) use ($id) {
                            $query
                            ->select(\DB::raw("llaveGestionRealizada"))
                            ->from('tbl_el_siniestros as s')
                            ->leftjoin('tbl_asignacion_cuida_unos as re', 're.idAsignacionCuidaUno', '=', 's.llaveUnionCasosCuida')
                            ->where('id_elSiniestro', '=', $id);
                        })->get();


        $tipoDocumentoAfiliado = \DB::table('tbl_tipo_docuemtno')->get();


        $cuidaUnoInfo = tbl_el_siniestros::where('id_elSiniestro', '=', $id)
                ->leftjoin('tbl_asignacion_cuida_unos as re', 're.idAsignacionCuidaUno', '=', 'tbl_el_siniestros.llaveUnionCasosCuida')
                ->leftjoin('tbl_afiliacion as af', 'af.idAfiliacion', '=', 're.llaveAfiliacion')
                ->leftjoin('tbl_creado as cre', 'cre.idCreado', '=', 're.llaveCreado')
                ->leftjoin('users as u', 'u.id', '=', 're.llaveUsuarioResponsable')
                ->leftjoin('tbl_estado_siniestro as inicial', 'inicial.id_estado_siniestro', '=', 're.llaveEstadoInicial')
                ->leftjoin('tbl_gestion_realizar as ge', 'ge.idGestionRealizar', '=', 're.llaveGestionRealizada')
                ->leftjoin('tbl_estado_siniestro as trami', 'trami.id_estado_siniestro', '=', 're.llaveEstadoTramite')
                ->leftjoin('tbl_estado_siniestro as fin', 'fin.id_estado_siniestro', '=', 're.llaveEstadoFinal')
                ->select('llaveAfiliacion', 'llaveCreado', 'fechaCreacion', 'llaveEstadoInicial', 'llaveGestionRealizada', 'llaveEstadoTramite', 'llaveEstadoFinal', 'inicial.estado_siniestro as inicial', 'inicial.id_estado_siniestro as iDinicial', 'trami.estado_siniestro as tramite', 'trami.id_estado_siniestro as iDtrami', 'fin.estado_siniestro as final', 'fin.id_estado_siniestro as iDfin', 'fechaRevicion', 'fechaCreacion', 'fechaCreacionCasoCuida', 'id', 'name', 'idAfiliacion', 'afiliacion', 'idCreado', 'creado', 'idGestionRealizar', 'gestionArealizar')
                ->firstOrFail();

        $infoSiniestroEl = tbl_el_siniestros::where('id_elSiniestro', '=', $id)
                ->leftjoin('tbl_afiliados', 'tbl_afiliados.idAfiliado', '=', 'tbl_el_siniestros.llaveAfiliadoEl')
                ->leftjoin('tbl_genero', 'tbl_genero.idGenero', '=', 'tbl_afiliados.llaveGenero')
                ->leftjoin('tbl_tipo_docuemtno', 'tbl_tipo_docuemtno.id_tipo_docuemtno', '=', 'tbl_afiliados.llaveTipoDocumento')
                ->leftjoin('tbl_empresas', 'tbl_empresas.id_empresa', '=', 'tbl_el_siniestros.llaveEmpresaEl')
                ->leftjoin('tbl_entrada', 'tbl_entrada.id_entrada', '=', 'tbl_el_siniestros.llaveCanlaEntradaEl')
                ->leftjoin('tbl_solicitud', 'tbl_solicitud.id_solicitud', '=', 'tbl_el_siniestros.llaveTipoSolicitudEl')
                ->leftjoin('tbl_covid', 'tbl_covid.idCovid', '=', 'tbl_el_siniestros.llaveCovid')
                ->leftjoin('tbl_departamento AS dps', 'dps.id_departamento', '=', 'tbl_el_siniestros.llaveDepartramentoEl')
                ->leftjoin('tbl_ciudad as cus', 'cus.id_ciudad', '=', 'tbl_el_siniestros.llaveCiudadEl')
                ->firstOrFail();

        $residenciaAdfilidos = tbl_el_siniestros::where('id_elSiniestro', '=', $id)
                ->leftjoin('tbl_afiliados', 'tbl_afiliados.idAfiliado', '=', 'tbl_el_siniestros.llaveAfiliadoEl')
                ->leftjoin('tbl_departamento AS dpa', 'dpa.id_departamento', '=', 'tbl_afiliados.llaveDepartamento')
                ->leftjoin('tbl_ciudad as cuAf', 'cuAf.id_ciudad', '=', 'tbl_afiliados.llaveCiudad')
                ->firstOrFail();


        $clfEl = tbl_el_siniestros::where('id_elSiniestro', '=', $id)
                ->leftjoin('tbl_el_calificaciones as c', 'c.idElCalificaciones', '=', 'tbl_el_siniestros.llaveCalificacionEl')
                ->leftjoin('tbl_estado_siniestro as eArl', 'eArl.id_estado_siniestro', '=', 'c.llaveEstadoElCalificacion')
                ->leftjoin('tbl_entrada_pruebas as epru', 'epru.id_entrada_pruebas', '=', 'c.llaveCanalEntradaPruebas')
                ->leftjoin('tbl_origen_definicion as o', 'o.id_origen_definicion', '=', 'c.llaveOrigenOportunidadEps')
                ->leftjoin('users as u', 'u.id', '=', 'c.llaveUsuarioCalificadorEl')
                ->leftjoin('tbl_cobertura as co', 'co.idCobertura', '=', 'tbl_el_siniestros.llaveCobertura')
                ->leftjoin('tbl_revision_cobertura as rv', 'rv.idRevisionCobertura', '=', 'tbl_el_siniestros.llaveRevicionCobertura')
                ->select('*', \DB::raw('c.updated_at as fechaGestionCali'))
                ->firstOrFail();

        $preClfEl = tbl_el_siniestros::where('id_elSiniestro', '=', $id)
                ->leftjoin('tbl_el_precalificaciones as p', 'p.idElPrecalificacion', '=', 'tbl_el_siniestros.llavePrecalificacionEl')
                ->leftjoin('tbl_estado_siniestro as e', 'e.id_estado_siniestro', '=', 'p.llaveEstadoGestionEl')
                ->leftjoin('tbl_sector as c', 'c.idSector', '=', 'p.llaveSectorEl')
                ->leftjoin('tbl_tipo_evento as t', 't.id_tipo_evento', '=', 'p.llaveTipoEventoReportadoEl')
                ->leftjoin('tbl_concepto_afiliacion as co', 'co.idConceptoAfiliacion', '=', 'p.llaveConceptoAfiliacionesEl')
                ->leftjoin('tbl_solicitud_prueba as so', 'so.idSolicitudPrueba', '=', 'p.llaveSolicitudPruebasEl')
                ->leftjoin('tbl_canal_envio as ca', 'ca.idCanalEnvio', '=', 'p.llaveCanalEnvio')
                ->leftjoin('tbl_reiteracion_pruebas as re', 're.idReiteracionPruebas', '=', 'p.llaveReinteracionPruebasEl')
                ->leftjoin('tbl_canal_reiteracion as can', 'can.idCanalReiteracion', '=', 'p.llaveCanalReinteracionPruebasEl')
                ->leftjoin('tbl_alto_costo_uci_mortal as al', 'al.idAltoCostoUciMortal', '=', 'p.llaveAltoCostoUciMortalEL')
                ->leftjoin('tbl_marcacion_isar_decreto as m', 'm.idMarcacionIsarDecreto', '=', 'p.llaveMarcacionIsarlEl')
                ->leftjoin('tbl_sector as sec', 'sec.idSector', '=', 'p.llaveSectorEl')
                ->leftjoin('tbl_eps as ep', 'ep.id_eps', '=', 'p.llaveCalificacionPrimeraOportunidadEpsArl')
                ->leftjoin('users as u', 'u.id', '=', 'p.llaveUsuarioPrecalificacionEl')
                ->select('*', \DB::raw('p.updated_at as fechaGestionCali'))
                ->firstOrFail();

        $clfElDos = tbl_el_siniestros::where('id_elSiniestro', '=', $id)
                ->leftjoin('tbl_el_calificaciones as c', 'c.idElCalificaciones', '=', 'tbl_el_siniestros.llaveCalificacionEl')
                ->leftjoin('tbl_origen_definicion as o', 'o.id_origen_definicion', '=', 'c.llaveOrigenOportunidadPositiva')
                ->select('id_origen_definicion', 'origen_definicion')
                ->firstOrFail();

        $epsMostar = tbl_el_siniestros::where('id_elSiniestro', '=', $id)
                ->leftjoin('tbl_eps as e', 'e.id_eps', '=', 'tbl_el_siniestros.llaveEpsEl')
                ->leftjoin('tbl_departamento AS dpa', 'dpa.id_departamento', '=', 'e.llaveDepartamentoEps')
                ->leftjoin('tbl_ciudad as cuAf', 'cuAf.id_ciudad', '=', 'e.llaveCiudadEps')
                ->select('id_eps', 'eps', 'direccionEps', 'telefonoEps', 'correoEps', 'departamento', 'ciudad', 'folioEl')
                ->firstOrFail();

        $eps = \DB::table('tbl_eps')
                        ->where('id_eps', '!=', function($query) use ($id) {
                            $query
                            ->select(\DB::raw("llaveEpsEl"))
                            ->from('tbl_el_siniestros')
                            ->where('id_elSiniestro', '=', $id);
                        })->get();
        $epsSinInfo = \DB::table('tbl_eps')->get();

        $diagnosticos = \DB::table('tbl_cie_10')->get();

        $origenDiagnostico = \DB::table('tbl_origen_diagnostico_adicional')->get();

        $estadoEps = \DB::table('tbl_estado_siniestro')
                        ->where('filtro', 'ESTADO_EL_EPS')
                        ->where('id_estado_siniestro', '!=', function($query) use ($id) {
                            $query
                            ->select(\DB::raw("llaveEstadoElCalificacion"))
                            ->from('tbl_el_siniestros as s')
                            ->leftjoin('tbl_el_calificaciones as c', 'c.idElCalificaciones', '=', 's.llaveCalificacionEl')
                            ->where('id_elSiniestro', '=', $id);
                        })->get();

        $estadoArl = \DB::table('tbl_estado_siniestro')
                        ->where('filtro', 'ESTADO_EL_ARL')
                        ->where('id_estado_siniestro', '!=', function($query) use ($id) {
                            $query
                            ->select(\DB::raw("llaveEstadoElCalificacion"))
                            ->from('tbl_el_siniestros as s')
                            ->leftjoin('tbl_el_calificaciones as c', 'c.idElCalificaciones', '=', 's.llaveCalificacionEl')
                            ->where('id_elSiniestro', '=', $id);
                        })->get();

        $estadoPre = \DB::table('tbl_estado_siniestro')
                        ->where('filtro', 'PRECALIFICACIONEL')
                        ->where('id_estado_siniestro', '!=', function($query) use ($id) {
                            $query
                            ->select(\DB::raw("llaveEstadoGestionEl"))
                            ->from('tbl_el_siniestros as s')
                            ->leftjoin('tbl_el_precalificaciones as p', 'p.idElPrecalificacion', '=', 's.llavePrecalificacionEl')
                            ->where('id_elSiniestro', '=', $id);
                        })->get();

        $origenEps = \DB::table('tbl_origen_definicion')
                        ->join('tbl_solicitud', 'tbl_solicitud.id_solicitud', '=', 'tbl_origen_definicion.llaveTipoSolicitudOrigen')
                        ->select('id_origen_definicion', 'origen_definicion')
                        ->where('solicitud', "DETERMINACION DE ORIGEN POR EPS")->get();

        $origenoportinidades = \DB::table('tbl_origen_definicion')
                        ->join('tbl_solicitud', 'tbl_solicitud.id_solicitud', '=', 'tbl_origen_definicion.llaveTipoSolicitudOrigen')
                        ->select('id_origen_definicion', 'origen_definicion')
                        ->where('solicitud', "DETERMINACION DE ORIGEN POR EPS")->get();

        $entradaPruebas = \DB::table('tbl_entrada_pruebas')
                ->where('moduloEntradaPruebas', "EL")
                ->get();

        $ingresoRe = \DB::table('tbl_ingreso_rehabilitacion')
                ->get();

        $genero = \DB::table('tbl_genero')
                ->get();

        $observacionCalificacion = \DB::table('tbl_el_siniestros as s')
                        ->leftjoin('tbl_el_calificaciones as c', 'c.idElCalificaciones', '=', 's.llaveCalificacionEl')
                        ->leftjoin('tbl_el_observaciones as o', 'o.llaveCalificacionElOb', '=', 'c.idElCalificaciones')
                        ->select('idElObservaciones', 'observacion')
                        ->where('id_elSiniestro', $id)->get();

        $tipoEvento = \DB::table('tbl_tipo_evento')
                        ->where('tipo_evento', '<>', 'PCL')->get();

        $conceptos = \DB::table('tbl_concepto_afiliacion')
                        ->where('modulo', '=', 'EL')->get();

        $solicitudPruebas = \DB::table('tbl_solicitud_prueba')
                        ->where('modulo', '=', 'EL')->get();

        $canalEnvios = \DB::table('tbl_canal_envio')
                        ->where('modulo', '=', 'EL')->get();

        $reiteracionPruebas = \DB::table('tbl_reiteracion_pruebas')
                        ->where('modulo', '=', 'EL')->get();

        $canalReiteraciones = \DB::table('tbl_canal_reiteracion')
                        ->where('modulo', '=', 'EL')->get();

        $altoCostouciMortales = \DB::table('tbl_alto_costo_uci_mortal')
                        ->where('modulo', '=', 'EL')->get();

        $marcacionIsarDecretos = \DB::table('tbl_marcacion_isar_decreto')
                        ->where('modulo', '=', 'EL')->get();

        $sectores = \DB::table('tbl_sector')
                        ->where('modulo', '=', 'EL')->get();

        return view('moduloEl.admin.siniestroEl.gestionEl', compact('sectores', 'marcacionIsarDecretos', 'altoCostouciMortales', 'canalReiteraciones', 'reiteracionPruebas', 'canalEnvios', 'solicitudPruebas', 'conceptos', 'estadoPre', 'tipoEvento', 'epsSinInfo', 'preClfEl', 'cobertura', 'genero', 'observacionCalificacion', 'ingresoRe', 'origenoportinidades', 'origenEps', 'entradaPruebas', 'estadoArl', 'estadoEps', 'clfElDos', 'eps', 'epsMostar', 'origenDiagnostico', 'diagnosticos', 'cuidaUnoInfo', 'departamentoAdiliado', 'residenciaAdfilidos', 'clfEl', 'infoSiniestroEl', 'gestionRealizar', 'revicionCoberturas', 'estadoIniciail', 'estadoTramite', 'estadoFinal', 'creado', 'tipoDocumentoAfiliado', 'entradaPclEl', 'tipoSolicitudEl', 'covid', 'departamento', 'usuariosEl', 'cobertura', 'afiliado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $datosBasicos = tbl_el_siniestros::where('id_elSiniestro', '=', $id)->firstOrFail();
        $datosBasicos->fill($request->all());
        $datosBasicos->save();

        /* ==============Actualiza la empreza======================== */
        $idEmpresa = $request->input('txtIdedmpresa');

        $empresaUpdate = tbl_empresa::where('id_empresa', '=', $idEmpresa)->firstOrFail();
        $empresaUpdate->fill($request->all());
        $empresaUpdate->save();

        /* ==============Actualiza la eps======================== */
        $idEpsUpdate = $request->input('llaveEpsEl');
        $epsUpdate = tbl_ep::where('id_eps', '=', $idEpsUpdate)->firstOrFail();
        $epsUpdate->fill($request->all());
        $epsUpdate->save();

        /* ============== crear calificacion Segun  coresponda tipo de solicitud ======================== */
        $idCalificacion = $request->input('TxtllaveCalificacion');
        $tipoSolicitud = $request->input('llaveTipoSolicitudEl');
        $tipoSolicitudAntigua = $request->input('txtTipoSoli');

        if ($tipoSolicitud != $tipoSolicitudAntigua) {
            $llaveEstadoElCalificacion = '1';
            /* =======================update  Formulario 'formularios'=========================== */
        }
        tbl_el_calificacione::where('idElCalificaciones', '=', $idCalificacion)->update(['llaveEstadoElCalificacion' => $llaveEstadoElCalificacion]);




        $idCuidaUno = $request->input('llaveUnionCasosCuida');
        if ($idCuidaUno != null) {
            $datosCuida = tbl_asignacion_cuida_uno::where('idAsignacionCuidaUno', '=', $idCuidaUno)->firstOrFail();
            $datosCuida->fill($request->all());
            $datosCuida->save();

            /* ====================Observaciones======================= */
            $ob = $request->input('TxtObservacionElCuida');
            if ($ob != NULL) {
                $observaciones = new tbl_el_observacione();
                $observaciones->observacion = $request->input('TxtObservacionElCali');
                $observaciones->llaveCuidaEl = $idCuidaUno;
                $observaciones->save();
                return;
            }
        }




        $idAfiliado = $request->input('idAfiliado');
        $datosBasicoAfiliado = tbl_afiliado::where('idAfiliado', '=', $idAfiliado)->firstOrFail();
        $datosBasicoAfiliado->fill($request->all());
        $datosBasicoAfiliado->save();







        /* =========================Traza Afiliado y Siniestro============================================ */

        /* ==================================================== */
        // --Traza Update Canal entrada variables Nuevas -----
        /* ==================================================== */
        $llaveCanlaEntradaElN = $request->input('llaveCanlaEntradaEl');
        $llaveTipoSolicitudElN = $request->input('llaveTipoSolicitudEl');
        $llaveCovidN = $request->input('llaveCovid');
        $fechaRadicadoArlPositivaN = $request->input('fechaRadicadoArlPositiva');
        $fechaAsignacionPqrN = $request->input('fechaAsignacionPqr');
        $numeroRadicadoEntradaN = $request->input('numeroRadicadoEntrada');
        $llaveDepartramentoElN = $request->input('llaveDepartramentoEl');
        $llaveCiudadElN = $request->input('llaveCiudadEl');
        $numeroSiniestroN = $request->input('numeroSiniestro');
        $llaveEmpresaElN = $request->input('llaveEmpresaEl');
        $fechaEnfermedadN = $request->input('fechaEnfermedad');
        $llaveCoberturaN = $request->input('llaveCobertura');
        $llaveRevicionCoberturaN = $request->input('llaveRevicionCobertura');
        $raSalidaCoverturaDevolucionEpsN = $request->input('raSalidaCoverturaDevolucionEps');
        $definicionOrigenPrimeraOportunidadEpsN = $request->input('definicionOrigenPrimeraOportunidadEps');
        $definicionOrigenPrimeraOportunidadPositivaN = $request->input('definicionOrigenPrimeraOportunidadPositiva');
        $fechaCreacionSiiestroElN = $request->input('fechaCreacionSiiestroEl');
        $llaveEpsElN = $request->input('llaveEpsEl');
        $folioElN = $request->input('folioEl');


        $llaveAfiliacionN = $request->input('llaveAfiliacion');
        $llaveCreadoN = $request->input('llaveCreado');
        $fechaCreacionN = $request->input('fechaCreacion');
        $llaveEstadoInicialN = $request->input('llaveEstadoInicial');
        $llaveGestionRealizadaN = $request->input('llaveGestionRealizada');
        $llaveEstadoTramiteN = $request->input('llaveEstadoTramite');
        $llaveEstadoFinalN = $request->input('llaveEstadoFinal');



        $tipoDocumentoN = $request->input('llaveTipoDocumento');
        $numeroDocuentoN = $request->input('documento');
        $nombreN = $request->input('nombre');
        $direccionN = $request->input('direccionResi');
        $departamentoN = $request->input('llaveDepartamento');
        $ciudadN = $request->input('llaveCiudad');
        $telefonoN = $request->input('telefono');
        $numeroCelularN = $request->input('celular');
        $correoN = $request->input('Correo');

        $empresaN = $request->input('nit');


        /* ==================================================== */
        // --Traza Update Canal entrada variables Antigual -----
        /* ==================================================== */

        $llaveCanlaEntradaElA = $request->input('llaveCanlaEntradaElA');
        $llaveTipoSolicitudElA = $request->input('llaveTipoSolicitudElA');
        $llaveCovidNA = $request->input('llaveCovidA');
        $fechaRadicadoArlPositivaA = $request->input('fechaRadicadoArlPositivaA');
        $fechaAsignacionPqrA = $request->input('fechaAsignacionPqrA');
        $numeroRadicadoEntradaA = $request->input('numeroRadicadoEntradaA');
        $llaveDepartramentoElA = $request->input('llaveDepartramentoElA');
        $llaveCiudadElA = $request->input('llaveCiudadElA');
        $numeroSiniestroA = $request->input('numeroSiniestroA');
        $llaveEmpresaElA = $request->input('llaveEmpresaElA');
        $fechaEnfermedadA = $request->input('fechaEnfermedadA');
        $llaveCoberturaA = $request->input('llaveCoberturaA');
        $llaveRevicionCoberturaA = $request->input('llaveRevicionCoberturaA');
        $raSalidaCoverturaDevolucionEpsA = $request->input('raSalidaCoverturaDevolucionEpsA');
        $definicionOrigenPrimeraOportunidadEpsA = $request->input('definicionOrigenPrimeraOportunidadEpsA');
        $definicionOrigenPrimeraOportunidadPositivaA = $request->input('definicionOrigenPrimeraOportunidadPositivaA');
        $fechaCreacionSiiestroElA = $request->input('fechaCreacionSiiestroElA');
        $llaveEpsElA = $request->input('llaveEpsElA');
        $folioElA = $request->input('folioElA');

        $llaveAfiliacionA = $request->input('llaveAfiliacionA');
        $llaveCreadoA = $request->input('llaveCreadoA');
        $fechaCreacionA = $request->input('fechaCreacionA');
        $llaveEstadoInicialA = $request->input('llaveEstadoInicialA');
        $llaveGestionRealizadaA = $request->input('llaveGestionRealizadaA');
        $llaveEstadoTramiteA = $request->input('llaveEstadoTramiteA');
        $llaveEstadoFinalA = $request->input('llaveEstadoFinalA');


        $tipoDocumentoA = $request->input('tipoDocumentoA');
        $numeroDocuentoA = $request->input('numeroDocuentoA');
        $nombreA = $request->input('nombreA');
        $direccionA = $request->input('direccionA');
        $departamentoA = $request->input('departamentoA');
        $ciudadA = $request->input('ciudadA');
        $telefonoA = $request->input('telefonoA');
        $numeroCelularA = $request->input('numeroCelularA');
        $correoA = $request->input('correoA');

        $empresaA = $request->input('empresaA');


        /* ==================================================== */
        // --===================Traza empreza==================--
        /* ==================================================== */
        if ($empresaN != $empresaA) {
            $traza = new tbl_traza();
            $traza->tipo = 'EMPRESA';
            $traza->anterior = $empresaA;
            /*   ======================================== */
            $traza->nuevo = $empresaN;
            $traza->llaveSiniestroEL = $id;
            $traza->llaveUserPcTtraza = $request->input('modifica');
            $traza->save();
        }

        /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */
        /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */
        /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */

        /* ==================================================== */
        // --================= Traza Tipo Documento ==========--
        /* ==================================================== */

        if ($tipoDocumentoA != $tipoDocumentoN) {
            $traza01 = new tbl_traza();
            $traza01->tipo = 'TIPO DOCUMENTO AFILIADO';
            $anteriortipoDocumentos = \DB::table('tbl_tipo_docuemtno')
                            ->where('id_tipo_docuemtno', $tipoDocumentoA)->get();
            foreach ($anteriortipoDocumentos as $anteriortipoDocumento) {
                $traza01->anterior = $anteriortipoDocumento->tipo_documento;
            }
            /*   ======================================== */
            $nuevatipoDocumentos = \DB::table('tbl_tipo_docuemtno')
                            ->where('id_tipo_docuemtno', $tipoDocumentoN)->get();
            foreach ($nuevatipoDocumentos as $nuevatipoDocumento) {
                $traza01->nuevo = $nuevatipoDocumento->tipo_documento;
            }
            $traza01->llaveSiniestroEL = $id;
            $traza01->llaveUserPcTtraza = $request->input('modifica');
            $traza01->save();
        }

        /* ==================================================== */
        // --=============== Traza NUMERO DOCUMENTO  ==========--
        /* ==================================================== */

        if ($numeroDocuentoA != $numeroDocuentoN) {
            $traza02 = new tbl_traza();
            $traza02->tipo = 'NUMERO DOCUMENTO';
            $traza02->anterior = $numeroDocuentoA;
            /*   ======================================== */
            $traza02->nuevo = $numeroDocuentoN;
            $traza02->llaveSiniestroEL = $id;
            $traza02->llaveUserPcTtraza = $request->input('modifica');
            $traza02->save();
        }
        /* ==================================================== */
        // --=============== Traza Nombre Afiliado   ==========--
        /* ==================================================== */

        if ($nombreA != $nombreN) {
            $traza03 = new tbl_traza();
            $traza03->tipo = 'NOMBRE AFILIADO';
            $traza03->anterior = $nombreA;
            /*   ======================================== */
            $traza03->nuevo = $nombreN;
            $traza03->llaveSiniestroEL = $id;
            $traza03->llaveUserPcTtraza = $request->input('modifica');
            $traza03->save();
        }
        /* ==================================================== */
        // --=============== Traza DIRECCION      ==========--
        /* ==================================================== */

        if ($direccionA != $direccionN) {
            $traza04 = new tbl_traza();
            $traza04->tipo = 'DIRECCION';
            $traza04->anterior = $direccionA;
            /*   ======================================== */
            $traza04->nuevo = $direccionN;
            $traza04->llaveSiniestroEL = $id;
            $traza04->llaveUserPcTtraza = $request->input('modifica');
            $traza04->save();
        }
        /* ==================================================== */
        // --================= Traza Departamento ==========--
        /* ==================================================== */

        if ($departamentoA != $departamentoN) {
            $traza05 = new tbl_traza();
            $traza05->tipo = 'DEPARTAMENTO AFILIADO';
            $anteriorDepartamentos = \DB::table('tbl_departamento')
                            ->where('id_departamento', $departamentoA)->get();
            foreach ($anteriorDepartamentos as $anteriorDepartamento) {
                $traza05->anterior = $anteriorDepartamento->departamento;
            }
            /*   ======================================== */
            $nuevaDepartamentos = \DB::table('tbl_departamento')
                            ->where('id_departamento', $departamentoN)->get();
            foreach ($nuevaDepartamentos as $nuevaDepartamento) {
                $traza05->nuevo = $nuevaDepartamento->departamento;
            }
            $traza05->llaveSiniestroEL = $id;
            $traza05->llaveUserPcTtraza = $request->input('modifica');
            $traza05->save();
        }

        /* ==================================================== */
        // --================= Traza Ciudad ==========--
        /* ==================================================== */

        if ($ciudadA != $ciudadN) {
            $traza06 = new tbl_traza();
            $traza06->tipo = 'CIUDAD AFILIADO';
            $anteriorCiudades = \DB::table('tbl_ciudad')
                            ->where('id_ciudad', $ciudadA)->get();
            foreach ($anteriorCiudades as $anteriorCiudad) {
                $traza06->anterior = $anteriorCiudad->ciudad;
            }
            /*   ======================================== */
            $nuevaCiudades = \DB::table('tbl_ciudad')
                            ->where('id_ciudad', $ciudadN)->get();
            foreach ($nuevaCiudades as $nuevaCiudad) {
                $traza06->nuevo = $nuevaCiudad->ciudad;
            }
            $traza06->llaveSiniestroEL = $id;
            $traza06->llaveUserPcTtraza = $request->input('modifica');
            $traza06->save();
        }
        /* ==================================================== */
        // --=============== Traza Telefono      ==========--
        /* ==================================================== */

        if ($telefonoA != $telefonoN) {
            $traza07 = new tbl_traza();
            $traza07->tipo = 'TELEFONO';
            $traza07->anterior = $telefonoA;
            /*   ======================================== */
            $traza07->nuevo = $telefonoN;
            $traza07->llaveSiniestroEL = $id;
            $traza07->llaveUserPcTtraza = $request->input('modifica');
            $traza07->save();
        }

        /* ==================================================== */
        // --=============== Traza Celular      ==========--
        /* ==================================================== */

        if ($numeroCelularA != $numeroCelularN) {
            $traza08 = new tbl_traza();
            $traza08->tipo = 'CELULAR';
            $traza08->anterior = $numeroCelularA;
            /*   ======================================== */
            $traza08->nuevo = $numeroCelularN;
            $traza08->llaveSiniestroEL = $id;
            $traza08->llaveUserPcTtraza = $request->input('modifica');
            $traza08->save();
        }

        /* ==================================================== */
        // --=============== Traza Correo      ==========--
        /* ==================================================== */

        if ($correoA != $correoN) {
            $traza09 = new tbl_traza();
            $traza09->tipo = 'CORREO';
            $traza09->anterior = $correoA;
            /*   ======================================== */
            $traza09->nuevo = $correoN;
            $traza09->llaveSiniestroEL = $id;
            $traza09->llaveUserPcTtraza = $request->input('modifica');
            $traza09->save();
        }

        /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */
        /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */
        /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */

        //
        /* ==================================================== */
        // --===================Traza Canal Enrada=============--
        /* ==================================================== */

        if ($llaveCanlaEntradaElA != $llaveCanlaEntradaElN) {
            $traza3 = new tbl_traza();
            $traza3->tipo = 'CANAL ENTRADA';
            $anteriorEntradas = \DB::table('tbl_entrada')
                            ->where('id_entrada', $llaveCanlaEntradaElA)->get();
            foreach ($anteriorEntradas as $anteriorEntrada) {
                $traza3->anterior = $anteriorEntrada->entrada;
            }
            /*   ======================================== */
            $nuevaEntradas = \DB::table('tbl_entrada')
                            ->where('id_entrada', $llaveCanlaEntradaElN)->get();
            foreach ($nuevaEntradas as $nuevaEntrada) {
                $traza3->nuevo = $nuevaEntrada->entrada;
            }
            $traza3->llaveSiniestroEL = $id;
            $traza3->llaveUserPcTtraza = $request->input('modifica');
            $traza3->save();
        }
        /* ==================================================== */
        // --================= Traza Tipo Solicitud ==========--
        /* ==================================================== */

        if ($llaveTipoSolicitudElA != $llaveTipoSolicitudElN) {
            $traza4 = new tbl_traza();
            $traza4->tipo = 'TIPO SOLICITUD';
            $anteriorTipoSolicitudes = \DB::table('tbl_solicitud')
                            ->where('id_solicitud', $llaveTipoSolicitudElA)->get();
            foreach ($anteriorTipoSolicitudes as $anteriorTipoSolicitud) {
                $traza4->anterior = $anteriorTipoSolicitud->solicitud;
            }
            /*   ======================================== */
            $nuevaTipoSolicitudes = \DB::table('tbl_solicitud')
                            ->where('id_solicitud', $llaveTipoSolicitudElN)->get();
            foreach ($nuevaTipoSolicitudes as $nuevaTipoSolicitud) {
                $traza4->nuevo = $nuevaTipoSolicitud->solicitud;
            }
            $traza4->llaveSiniestroEL = $id;
            $traza4->llaveUserPcTtraza = $request->input('modifica');
            $traza4->save();
        }
        /* ==================================================== */
        // --================= Traza covid ==========--
        /* ==================================================== */

        if ($llaveCovidNA != $llaveCovidN) {
            $trazaCovid = new tbl_traza();
            $trazaCovid->tipo = 'MARCACION COVID';
            $anteriorCovids = \DB::table('tbl_covid')
                            ->where('idCovid', $llaveCovidNA)->get();
            foreach ($anteriorCovids as $anteriorCovid) {
                $trazaCovid->anterior = $anteriorCovid->covid;
            }
            /*   ======================================== */
            $nuevaCovids = \DB::table('tbl_covid')
                            ->where('idCovid', $llaveCovidN)->get();
            foreach ($nuevaCovids as $nuevaCovid) {
                $trazaCovid->nuevo = $nuevaCovid->covid;
            }
            $trazaCovid->llaveSiniestroEL = $id;
            $trazaCovid->llaveUserPcTtraza = $request->input('modifica');
            $trazaCovid->save();
        }

        /* ==================================================== */
        // --================= Traza Departamento ==========--
        /* ==================================================== */

        if ($llaveDepartramentoElA != $llaveDepartramentoElN) {
            $trazaDepartamento = new tbl_traza();
            $trazaDepartamento->tipo = 'DEPARTAMENTO SINIESTRO';
            $anteriorDepartamentos = \DB::table('tbl_departamento')
                            ->where('id_departamento', $llaveDepartramentoElA)->get();
            foreach ($anteriorDepartamentos as $anteriorDepartamento) {
                $trazaDepartamento->anterior = $anteriorDepartamento->departamento;
            }
            /*   ======================================== */
            $nuevaDepartamentos = \DB::table('tbl_departamento')
                            ->where('id_departamento', $llaveDepartramentoElN)->get();
            foreach ($nuevaDepartamentos as $nuevaDepartamento) {
                $trazaDepartamento->nuevo = $nuevaDepartamento->departamento;
            }
            $trazaDepartamento->llaveSiniestroEL = $id;
            $trazaDepartamento->llaveUserPcTtraza = $request->input('modifica');
            $trazaDepartamento->save();
        }

        /* ==================================================== */
        // --================= Traza Ciudad ==========--
        /* ==================================================== */

        if ($llaveCiudadElA != $llaveCiudadElN) {
            $trazaCiudad = new tbl_traza();
            $trazaCiudad->tipo = 'CIUDAD SINIESTRO';
            $anteriorCiudades = \DB::table('tbl_ciudad')
                            ->where('id_ciudad', $llaveCiudadElA)->get();
            foreach ($anteriorCiudades as $anteriorCiudad) {
                $trazaCiudad->anterior = $anteriorCiudad->ciudad;
            }
            /*   ======================================== */
            $nuevaCiudades = \DB::table('tbl_ciudad')
                            ->where('id_ciudad', $llaveCiudadElN)->get();
            foreach ($nuevaCiudades as $nuevaCiudad) {
                $trazaCiudad->nuevo = $nuevaCiudad->ciudad;
            }
            $trazaCiudad->llaveSiniestroEL = $id;
            $trazaCiudad->llaveUserPcTtraza = $request->input('modifica');
            $trazaCiudad->save();
        }







        /* ==================================================== */
        // --================= Traza Revicion covertura ==========--
        /* ==================================================== */

        if ($llaveEpsElA != $llaveEpsElN) {
            $trazaEps = new tbl_traza();
            $trazaEps->tipo = 'EPS';
            $anteriorEpss = \DB::table('tbl_eps')
                            ->where('id_eps', $llaveEpsElA)->get();
            foreach ($anteriorEpss as $anteriorEps) {
                $trazaEps->anterior = $anteriorEps->eps;
            }
            /*   ======================================== */
            $nuevaEpss = \DB::table('tbl_eps')
                            ->where('id_eps', $llaveEpsElN)->get();
            foreach ($nuevaEpss as $nuevaEps) {
                $trazaEps->nuevo = $nuevaEps->eps;
            }
            $trazaEps->llaveSiniestroEL = $id;
            $trazaEps->llaveUserPcTtraza = $request->input('modifica');
            $trazaEps->save();
        }

        /* ==================================================== */
        // --================= Traza FECHA RADICACION ARL POSITIVA ==========--
        /* ==================================================== */

        if ($fechaRadicadoArlPositivaA != $fechaRadicadoArlPositivaN) {
            $trazafechaRadicadoArlPositiva = new tbl_traza();
            $trazafechaRadicadoArlPositiva->tipo = 'FECHA RADICACION ARL POSITIVA';
            $trazafechaRadicadoArlPositiva->anterior = $fechaRadicadoArlPositivaA;
            /*   ======================================== */
            $trazafechaRadicadoArlPositiva->nuevo = $fechaRadicadoArlPositivaN;
            $trazafechaRadicadoArlPositiva->llaveSiniestroEL = $id;
            $trazafechaRadicadoArlPositiva->llaveUserPcTtraza = $request->input('modifica');
            $trazafechaRadicadoArlPositiva->save();
        }
        /* ==================================================== */
        // --================= Traza FECHA ASIGNACION PQR==========--
        /* ==================================================== */

        if ($fechaAsignacionPqrA != $fechaAsignacionPqrN) {
            $trazafechaRadicadoArlPositiva = new tbl_traza();
            $trazafechaRadicadoArlPositiva->tipo = 'FECHA ASIGNACION PQR';
            $trazafechaRadicadoArlPositiva->anterior = $fechaAsignacionPqrA;
            /*   ======================================== */
            $trazafechaRadicadoArlPositiva->nuevo = $fechaAsignacionPqrN;
            $trazafechaRadicadoArlPositiva->llaveSiniestroEL = $id;
            $trazafechaRadicadoArlPositiva->llaveUserPcTtraza = $request->input('modifica');
            $trazafechaRadicadoArlPositiva->save();
        }

        /* ==================================================== */
        // --================= Traza NUMERO RADICADO ENTRADA==========--
        /* ==================================================== */

        if ($numeroRadicadoEntradaA != $numeroRadicadoEntradaN) {
            $trazaNumeroRadicadoEntrada = new tbl_traza();
            $trazaNumeroRadicadoEntrada->tipo = 'NUMERO RADICADO ENTRADA';
            $trazaNumeroRadicadoEntrada->anterior = $numeroRadicadoEntradaA;
            /*   ======================================== */
            $trazaNumeroRadicadoEntrada->nuevo = $numeroRadicadoEntradaN;
            $trazaNumeroRadicadoEntrada->llaveSiniestroEL = $id;
            $trazaNumeroRadicadoEntrada->llaveUserPcTtraza = $request->input('modifica');
            $trazaNumeroRadicadoEntrada->save();
        }

        /* ==================================================== */
        // --================= Traza FECHA ENFERMEDAD==========--
        /* ==================================================== */

        if ($fechaEnfermedadA != $fechaEnfermedadN) {
            $trazaFechaEnfermedad = new tbl_traza();
            $trazaFechaEnfermedad->tipo = 'FECHA ENFERMEDAD';
            $trazaFechaEnfermedad->anterior = $fechaEnfermedadA;
            /*   ======================================== */
            $trazaFechaEnfermedad->nuevo = $fechaEnfermedadN;
            $trazaFechaEnfermedad->llaveSiniestroEL = $id;
            $trazaFechaEnfermedad->llaveUserPcTtraza = $request->input('modifica');
            $trazaFechaEnfermedad->save();
        }


        /* ==================================================== */
        // --================= Traza SINIESTRO==========--
        /* ==================================================== */

        if ($numeroSiniestroA != $numeroSiniestroN) {
            $trazaSiniestro = new tbl_traza();
            $trazaSiniestro->tipo = 'NUMERO SINIESTRO';
            $trazaSiniestro->anterior = $numeroSiniestroA;
            /*   ======================================== */
            $trazaSiniestro->nuevo = $numeroSiniestroN;
            $trazaSiniestro->llaveSiniestroEL = $id;
            $trazaSiniestro->llaveUserPcTtraza = $request->input('modifica');
            $trazaSiniestro->save();
        }
        /* ==================================================== */
        // --================= Traza FOLIO==========--
        /* ==================================================== */

        if ($folioElA != $folioElN) {
            $trazaFolio = new tbl_traza();
            $trazaFolio->tipo = 'FOLIO';
            $trazaFolio->anterior = $folioElA;
            /*   ======================================== */
            $trazaFolio->nuevo = $folioElN;
            $trazaFolio->llaveSiniestroEL = $id;
            $trazaFolio->llaveUserPcTtraza = $request->input('modifica');
            $trazaFolio->save();
        }
        /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */
        /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */
        /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */
        /* ==================================================== */
        // --================= Traza Fecha CREACION  ==========--
        /* ==================================================== */

        if ($fechaCreacionA != $fechaCreacionN) {
            $trazaFechaCreacion = new tbl_traza();
            $trazaFechaCreacion->tipo = 'FECHA CREACION';
            $trazaFechaCreacion->anterior = $fechaCreacionA;
            /*   ======================================== */
            $trazaFechaCreacion->nuevo = $fechaCreacionN;
            $trazaFechaCreacion->llaveSiniestroEL = $id;
            $trazaFechaCreacion->llaveUserPcTtraza = $request->input('modifica');
            $trazaFechaCreacion->save();
        }
        /* ==================================================== */
        // --================= Traza afiliacion  ==========--
        /* ==================================================== */

        if ($llaveAfiliacionA != $llaveAfiliacionN) {
            $trazaAfiliacion = new tbl_traza();
            $trazaAfiliacion->tipo = 'AFILIACION CUIDA 1';
            $anteriorAfiliacions = \DB::table('tbl_afiliacion')
                            ->where('idAfiliacion', $llaveAfiliacionA)->get();
            foreach ($anteriorAfiliacions as $anteriorAfiliacion) {
                $trazaAfiliacion->anterior = $anteriorAfiliacion->afiliacion;
            }
            /*   ======================================== */
            $nuevaAfiliacions = \DB::table('tbl_afiliacion')
                            ->where('idAfiliacion', $llaveAfiliacionN)->get();
            foreach ($nuevaAfiliacions as $nuevaAfiliacion) {
                $trazaAfiliacion->nuevo = $nuevaAfiliacion->afiliacion;
            }
            $trazaAfiliacion->llaveSiniestroEL = $id;
            $trazaAfiliacion->llaveUserPcTtraza = $request->input('modifica');
            $trazaAfiliacion->save();
        }

        /* ==================================================== */
        // --================= Traza creado  ==========--
        /* ==================================================== */

        if ($llaveCreadoA != $llaveCreadoN) {
            $trazaCreado = new tbl_traza();
            $trazaCreado->tipo = 'CREADO CUIDA 1';
            $anteriorCreados = \DB::table('tbl_creado')
                            ->where('idCreado', $llaveCreadoA)->get();
            foreach ($anteriorCreados as $anteriorCreado) {
                $trazaCreado->anterior = $anteriorCreado->creado;
            }
            /*   ======================================== */
            $nuevaCreados = \DB::table('tbl_creado')
                            ->where('idCreado', $llaveCreadoN)->get();
            foreach ($nuevaCreados as $nuevaCreado) {
                $trazaCreado->nuevo = $nuevaCreado->creado;
            }
            $trazaCreado->llaveSiniestroEL = $id;
            $trazaCreado->llaveUserPcTtraza = $request->input('modifica');
            $trazaCreado->save();
        }
        /* ==================================================== */
        // --================= Traza estado inicial  ==========--
        /* ==================================================== */

        if ($llaveEstadoInicialA != $llaveEstadoInicialN) {
            $trazaEstado = new tbl_traza();
            $trazaEstado->tipo = 'ESTADO INICIAL CUIDA 1';
            $anteriorEstados = \DB::table('tbl_estado_siniestro')
                            ->where('id_estado_siniestro', $llaveEstadoInicialA)->get();
            foreach ($anteriorEstados as $anteriorEstado) {
                $trazaEstado->anterior = $anteriorEstado->estado_siniestro;
            }
            /*   ======================================== */
            $nuevaEstados = \DB::table('tbl_estado_siniestro')
                            ->where('id_estado_siniestro', $llaveEstadoInicialN)->get();
            foreach ($nuevaEstados as $nuevaEstado) {
                $trazaEstado->nuevo = $nuevaEstado->estado_siniestro;
            }
            $trazaEstado->llaveSiniestroEL = $id;
            $trazaEstado->llaveUserPcTtraza = $request->input('modifica');
            $trazaEstado->save();
        }


        /* ==================================================== */
        // --================= Traza estado tramite ==========--
        /* ==================================================== */

        if ($llaveEstadoTramiteA != $llaveEstadoTramiteN) {
            $trazaEstadoTramite = new tbl_traza();
            $trazaEstadoTramite->tipo = 'ESTADO TRAMITE CUIDA 1';
            $anteriorEstadoTramites = \DB::table('tbl_estado_siniestro')
                            ->where('id_estado_siniestro', $llaveEstadoTramiteA)->get();
            foreach ($anteriorEstadoTramites as $anteriorEstadoTramite) {
                $trazaEstadoTramite->anterior = $anteriorEstadoTramite->estado_siniestro;
            }
            /*   ======================================== */
            $nuevaEstadoTramites = \DB::table('tbl_estado_siniestro')
                            ->where('id_estado_siniestro', $llaveEstadoTramiteN)->get();
            foreach ($nuevaEstadoTramites as $nuevaEstadoTramite) {
                $trazaEstadoTramite->nuevo = $nuevaEstadoTramite->estado_siniestro;
            }
            $trazaEstadoTramite->llaveSiniestroEL = $id;
            $trazaEstadoTramite->llaveUserPcTtraza = $request->input('modifica');
            $trazaEstadoTramite->save();
        }

        /* ==================================================== */
        // --================= Traza estado FINAl  ==========--
        /* ==================================================== */

        if ($llaveEstadoFinalA != $llaveEstadoFinalN) {
            $trazaEstadoFinal = new tbl_traza();
            $trazaEstadoFinal->tipo = 'ESTADO FINAL CUIDA 1';
            $anteriorEstadoFinals = \DB::table('tbl_estado_siniestro')
                            ->where('id_estado_siniestro', $llaveEstadoFinalA)->get();
            foreach ($anteriorEstadoFinals as $anteriorEstadoFinal) {
                $trazaEstadoFinal->anterior = $anteriorEstadoFinal->estado_siniestro;
            }
            /*   ======================================== */
            $nuevaEstadoFinals = \DB::table('tbl_estado_siniestro')
                            ->where('id_estado_siniestro', $llaveEstadoFinalN)->get();
            foreach ($nuevaEstadoFinals as $nuevaEstadoFinal) {
                $trazaEstadoFinal->nuevo = $nuevaEstadoFinal->estado_siniestro;
            }
            $trazaEstadoFinal->llaveSiniestroEL = $id;
            $trazaEstadoFinal->llaveUserPcTtraza = $request->input('modifica');
            $trazaEstadoFinal->save();
        }

        /* ==================================================== */
        // --================= Traza estado FINAl  ==========--
        /* ==================================================== */

        if ($llaveGestionRealizadaA != $llaveGestionRealizadaN) {
            $trazaGestion = new tbl_traza();
            $trazaGestion->tipo = 'GESTION A REALIZAR CUIDA 1';
            $anteriorGestions = \DB::table('tbl_gestion_realizar')
                            ->where('idGestionRealizar', $llaveGestionRealizadaA)->get();
            foreach ($anteriorGestions as $anteriorGestion) {
                $trazaGestion->anterior = $anteriorGestion->gestionArealizar;
            }
            /*   ======================================== */
            $nuevaGestions = \DB::table('tbl_gestion_realizar')
                            ->where('idGestionRealizar', $llaveGestionRealizadaN)->get();
            foreach ($nuevaGestions as $nuevaGestion) {
                $trazaGestion->nuevo = $nuevaGestion->gestionArealizar;
            }
            $trazaGestion->llaveSiniestroEL = $id;
            $trazaGestion->llaveUserPcTtraza = $request->input('modifica');
            $trazaGestion->save();
        }

        return redirect('/Siniestro_El/' . $id . '/edit');
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
