<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbl_precalificaciones;
use App\tbl_solicitud_anexos;
use App\tbl_analisis_casos;
use App\tbl_siniestro_pcl;
use App\tbl_califiaciones;
use App\User;
use App\Http\Controllers\EmailSendController;
use App\tbl_traza;

class PrecalificacionController extends Controller {

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
    public function contact(Request $request) {

        $correo = \DB::table('tbl_correo_alertas')
                        ->where('modulo', 'PCL')->get();


        foreach ($correo as $key) {
            $estatus = $key->correoAlerta;
        }

        $subject = "Pendiente anexos";
        $for = $estatus;
        \Mail::send('email.email', $request->all(), function($msj) use($subject, $for) {
            $msj->from($for, "Simel");
            $msj->subject($subject);
            $msj->to($for);
        });
        return redirect()->back();
    }

    public function update(Request $request, $id) {
        $precalificacion = tbl_precalificaciones::where('idPrecalificacion', '=', $id)->firstOrFail();
        $quienAsigno = $request->input('llaveSubEstadoPrecalificacion');
        $habilitado = $request->input('habilitaPre');
        if ($habilitado != 'SI') {
            $precalificacion->habilitaPre = null;
        }
        $precalificacion->fill($request->all());
        $precalificacion->save();
        $idSiniestroPcl = $request->input('idSiniestroPcl');


        $correoPteAnexcos = $request->input('llaveEstadoPrecalificacion');
        $correoEnviado = $request->input('correoEnvido');


        /* =========================================== */
        $siAnalisis = $request->input('TxtAnalisisCaso');
        if ($siAnalisis != NULL) {
            $analisis = new tbl_analisis_casos();
            $analisis->analisis = $request->input('TxtAnalisisCaso');
            $analisis->llave_unionPrecalificacionAnalisis = $id;
            $analisis->save();
        }



        /*
          $sisolicitud = $request->input('TxtSolicitudAnexos');
          if ($sisolicitud != NULL) {
          $solicitud = new tbl_solicitud_anexos();
          $solicitud->anexo = $request->input('TxtSolicitudAnexos');
          $solicitud->llavePrecalificacionunion = $id;
          $solicitud->save();
          }
         */
        /* ==========================Se creas la calificacion se asiga segun Corresponda =========================== */

        /* ==========================Jefe=============================== */
        if ($quienAsigno == '79') {

            $calificar = new tbl_califiaciones();
            $calificar->llaveCalificadorCalifiacion = $request->input('llaveCalificador');
            $calificar->llaveEstadoCalificacion = '1';

            $calificar->save();
            $idCalificacion = $calificar->idCalifiacion;
            /* =======================update  Formulario 'llave unnion Calificacion'=========================== */
            tbl_siniestro_pcl::where('idSiniestroPcl', '=', $idSiniestroPcl)->update(['llaveCalificacion' => $idCalificacion]);
        }
        /* ==========================Medico=============================== */
        if ($quienAsigno == '78') {
            $conexion1 = mysqli_connect('localhost', 'Admin', 'T3cnolog14', 'db_spiatel', '3306');

            $calificar = new tbl_califiaciones();
            /* ==========================limite=============================== */

            $asignarCapacidadLimite = User::orderBy('cuantos', 'ASC')
                    ->join('tbl_califiaciones', 'tbl_califiaciones.llaveCalificadorCalifiacion', '=', 'users.id')
                    ->where('llaveEstadoCalificacion', '=', '1')
                    ->where('llave_estado', '=', '1')
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
                    ->get();
            $uno = 0;
            if (count($asignarTotalLimite)) {
                foreach ($asignarTotalLimite as $asiTotalLimite) {
                    $uno += 1;
                }
            }

            /* ==========================Sin Limite=============================== */
            $sinLimiteAsig = User::orderBy('cuantos', 'ASC')
                    ->join('tbl_califiaciones', 'tbl_califiaciones.llaveCalificadorCalifiacion', '=', 'users.id')
                    ->where('llaveEstadoCalificacion', '=', '1')
                    ->where('capacidadBandejaCasos', '=', 'SIN LIMITES')
                    ->where('llave_estado', '=', '1')
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
                            tbl_califiaciones AS c ON c.llaveCalificadorCalifiacion = u.id
                        WHERE
                            llaveEstadoCalificacion = 1
                                AND llave_estado = 1
                                AND capacidadBandejaCasos != 'SIN LIMITES'
                                AND capacidadBandejaCasos != 'NO APLICA'                                
                        GROUP BY id
                        order by cuantos Asc";
                $lim = mysqli_query($conexion1, $sqlLimite);
                $noentra = false;
                foreach ($lim as $medicoLim) {
                    if ($medicoLim['capacidadBandejaCasos'] > $medicoLim['cuantos']) {
                        $calificar->llaveCalificadorCalifiacion = $medicoLim['id'];
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
                            tbl_califiaciones AS c ON c.llaveCalificadorCalifiacion = u.id
                        WHERE
                            llaveEstadoCalificacion = 1
                                AND capacidadBandejaCasos = 'SIN LIMITES'
                                AND llave_estado = 1
                        GROUP BY id
                        order by cuantos Asc";
                        $sinLimit = mysqli_query($conexion1, $sqlSinLimite);
                        $noentra = false;
                        foreach ($sinLimit as $medicoSinln) {
                            $calificar->llaveCalificadorCalifiacion = $medicoSinln['id'];
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
                            left JOIN tbl_califiaciones AS c ON c.llaveCalificadorCalifiacion = u.id
                            where capacidadBandejaCasos = 'SIN LIMITES'
                                    AND llave_estado = 1";
                        $resultSiNo = mysqli_query($conexion1, $sqlSiNo);
                        while ($resultadoSiNo = mysqli_fetch_array($resultSiNo)) {
                            $calificar->llaveCalificadorCalifiacion = $resultadoSiNo['id'];
                        }
                    }

                    /*  =================Asina Casos A todos los usuarios del 
                     * sistemas inicializa en 1 =================== */

                    if ($limiteSiNo == true && $limiteCuento < $SinLimiteCuento) {
                        $asignarCapacidadDiferente = User::orderBy('cuantos', 'ASC')
                                ->join('tbl_califiaciones', 'tbl_califiaciones.llaveCalificadorCalifiacion', '=', 'users.id')
                                ->where('llaveEstadoCalificacion', '=', '1')
                                ->where('capacidadBandejaCasos', '=', 'SIN LIMITES')
                                ->where('llave_estado', '=', '1')
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
                            left JOIN tbl_califiaciones AS c ON c.llaveCalificadorCalifiacion = u.id
                            where capacidadBandejaCasos = 'SIN LIMITES' 
                                AND llave_estado = 1 $con";
                        $resultBusca = mysqli_query($conexion1, $busca);
                        while ($resultadobusca = mysqli_fetch_array($resultBusca)) {
                            $calificar->llaveCalificadorCalifiacion = $resultadobusca['id'];
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
                            left JOIN tbl_califiaciones AS c ON c.llaveCalificadorCalifiacion = u.id
                            where capacidadBandejaCasos != 'SIN LIMITES' 
                                AND capacidadBandejaCasos != 'NO APLICA'
                                AND llave_estado = 1";
                $resultInicio = mysqli_query($conexion1, $sqlASigInicio);
                while ($resultadoInicio = mysqli_fetch_array($resultInicio)) {
                    $calificar->llaveCalificadorCalifiacion = $resultadoInicio['id'];
                }
            }

            /*  =================Asina Casos A todos los usuarios del 
             * sistemas inicializa en 1 =================== */
            if ($siDos == true && $dos < $uno) {

                $asignarCapacidadDiferented = User::orderBy('cuantos', 'ASC')
                        ->join('tbl_califiaciones', 'tbl_califiaciones.llaveCalificadorCalifiacion', '=', 'users.id')
                        ->where('llaveEstadoCalificacion', '=', '1')
                        ->where('capacidadBandejaCasos', '!=', 'SIN LIMITES')
                        ->where('capacidadBandejaCasos', '!=', 'NO APLICA')
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
                            left JOIN tbl_califiaciones AS c ON c.llaveCalificadorCalifiacion = u.id
                            where capacidadBandejaCasos != 'SIN LIMITES' 
                                 AND capacidadBandejaCasos != 'NO APLICA' 
                                 AND llave_estado = 1 $con";
                $resultId = mysqli_query($conexion1, $sacarId);
                while ($resultadoId = mysqli_fetch_array($resultId)) {
                    $calificar->llaveCalificadorCalifiacion = $resultadoId['id'];
                }
            }
            $calificar->llaveEstadoCalificacion = '1';

            $calificar->save();
            $idCalificacion = $calificar->idCalifiacion;
            /* =======================update  Formulario 'formularios'=========================== */

            tbl_siniestro_pcl::where('idSiniestroPcl', '=', $idSiniestroPcl)->update(['llaveCalificacion' => $idCalificacion]);
        }
        if ($correoPteAnexcos == 39) {
            if ($correoEnviado == "SI") {
                return $this->contact($request);
            }
        }

        /* =========================Traza PreCalificacion============================================ */

        /* ==================================================== */
        // --=============Traza variables Nuevas ==============--
        /* ==================================================== */
        $llaveCalificadorN = $request->input('llaveCalificador');
        $llaveEstadoPrecalificacionN = $request->input('llaveEstadoPrecalificacion');
        $llaveSubEstadoPrecalificacionN = $request->input('llaveSubEstadoPrecalificacion');
        $fechaSolicitudAnexosN = $request->input('fechaSolicitudAnexos');
        $fechaSeguimientoAnexosPreN = $request->input('fechaSeguimientoAnexosPre');
        $fechaRecepcionAnexosPreN = $request->input('fechaRecepcionAnexosPre');
        $anexoPreCalificacionN = $request->input('anexoPreCalificacion');


        /* ==================================================== */
        // --=============Traza variables Antiguas ==============--
        /* ==================================================== */
        $llaveCalificadorA = $request->input('asigandoA');
        $llaveEstadoPrecalificacionA = $request->input('estadoA');
        $llaveSubEstadoPrecalificacionA = $request->input('subEstado');
        $fechaSolicitudAnexosA = $request->input('fechaAnexos');
        $fechaSeguimientoAnexosPreA = $request->input('fechaSeguimiento');
        $fechaRecepcionAnexosPreA = $request->input('fechaRecep');
        $anexoPreCalificacionA = $request->input('anexosA');

        /* ==================================================== */
        // --=======Taza REASIGNACION PRECALIFICACION'==========--
        /* ==================================================== */

        if ($llaveCalificadorA != $llaveCalificadorN) {
            $traza1 = new tbl_traza();
            $traza1->tipo = 'REASIGNACION PRECALIFICACION';
            $anteriorCalificadors = \DB::table('users')
                            ->where('id', $llaveCalificadorA)->get();
            foreach ($anteriorCalificadors as $anteriorCalificador) {
                $traza1->anterior = $anteriorCalificador->name;
            }
            /*   ======================================== */
            $nuevaCalificadors = \DB::table('users')
                            ->where('id', $llaveCalificadorN)->get();
            foreach ($nuevaCalificadors as $nuevaCalificador) {
                $traza1->nuevo = $nuevaCalificador->name;
            }
            $traza1->llaveSiniestroPclUnion = $idSiniestroPcl;
            $traza1->llaveUserPcTtraza = $request->input('modifica');
            $traza1->save();
        }

        /* ==================================================== */
        // --===================Traza ESTADO PRECALIFICACION=============--
        /* ==================================================== */

        if ($llaveEstadoPrecalificacionA != $llaveEstadoPrecalificacionN) {
            $traza2 = new tbl_traza();
            $traza2->tipo = 'ESTADO PRECALIFICACION';

            $anteriorEstados = \DB::table('tbl_estado_siniestro')
                            ->where('id_estado_siniestro', $llaveEstadoPrecalificacionA)->get();
            foreach ($anteriorEstados as $anteriorEstado) {
                $traza2->anterior = $anteriorEstado->estado_siniestro;
            }
            /*   ======================================== */
            $nuevaEstados = \DB::table('tbl_estado_siniestro')
                            ->where('id_estado_siniestro', $llaveEstadoPrecalificacionN)->get();
            foreach ($nuevaEstados as $nuevaEstado) {
                $traza2->nuevo = $nuevaEstado->estado_siniestro;
            }
            $traza2->llaveSiniestroPclUnion = $idSiniestroPcl;
            $traza2->llaveUserPcTtraza = $request->input('modifica');
            $traza2->save();
        }


        /* ==================================================== */
        // --===================Traza SUBESTADO PRECALIFICACION=============--
        /* ==================================================== */

        if ($llaveSubEstadoPrecalificacionA != $llaveSubEstadoPrecalificacionN) {
            $traza3 = new tbl_traza();
            $traza3->tipo = 'SUBESTADO PRECALIFICACION';
            $anteriorSubEstados = \DB::table('tbl_sub_estados')
                            ->where('id_sub_estados', $llaveSubEstadoPrecalificacionA)->get();
            foreach ($anteriorSubEstados as $anteriorSubEstado) {
                $traza3->anterior = $anteriorSubEstado->sub_estados;
            }
            /*   ======================================== */
            $nuevaSubEstados = \DB::table('tbl_sub_estados')
                            ->where('id_sub_estados', $llaveSubEstadoPrecalificacionN)->get();
            foreach ($nuevaSubEstados as $nuevaSubEstado) {
                $traza3->nuevo = $nuevaSubEstado->sub_estados;
            }
            $traza3->llaveSiniestroPclUnion = $idSiniestroPcl;
            $traza3->llaveUserPcTtraza = $request->input('modifica');
            $traza3->save();
        }

        if ($anexoPreCalificacionA == null and $llaveEstadoPrecalificacionN == '39') {
            /* ==================================================== */
            // --======Traza FECHA SOLICITUD ANEXOS PRECALIFICACION ==============--
            /* ==================================================== */
            if ($fechaSolicitudAnexosA != $fechaSolicitudAnexosN) {
                $traza4 = new tbl_traza();
                $traza4->tipo = 'FECHA SOLICITUD ANEXOS PRECALIFICACION';
                $traza4->anterior = $fechaSolicitudAnexosA;
                /*   ======================================== */
                $traza4->nuevo = $fechaSolicitudAnexosN;
                $traza4->llaveSiniestroPclUnion = $idSiniestroPcl;
                $traza4->llaveUserPcTtraza = $request->input('modifica');
                $traza4->save();
            }

            /* ==================================================== */
            // --===================Traza SOLICITUD ANEXOS PRECALIFICACION==================--
            /* ==================================================== */
            if ($anexoPreCalificacionA != $anexoPreCalificacionN) {
                $traza6 = new tbl_traza();
                $traza6->tipo = 'SOLICITUD ANEXOS PRECALIFICACION';
                $traza6->anterior = $anexoPreCalificacionA;
                /*   ======================================== */
                $traza6->nuevo = $anexoPreCalificacionN;
                $traza6->llaveSiniestroPclUnion = $idSiniestroPcl;
                $traza6->llaveUserPcTtraza = $request->input('modifica');
                $traza6->save();
            }
        }

        /* ==================================================== */
        // --===================Traza FECHA RECEPCION ANEXOS PRECALIFICACION==================--
        /* ==================================================== */
        if ($fechaRecepcionAnexosPreA != $fechaRecepcionAnexosPreN) {
            $traza5 = new tbl_traza();
            $traza5->tipo = 'FECHA RECEPCION ANEXOS PRECALIFICACION';
            $traza5->anterior = $fechaRecepcionAnexosPreA;
            /*   ======================================== */
            $traza5->nuevo = $fechaRecepcionAnexosPreN;
            $traza5->llaveSiniestroPclUnion = $idSiniestroPcl;
            $traza5->llaveUserPcTtraza = $request->input('modifica');
            $traza5->save();
        }









        return redirect('/Siniestro/' . $idSiniestroPcl . '/edit');
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
