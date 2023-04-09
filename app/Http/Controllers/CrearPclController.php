<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbl_afiliado;
use App\tbl_siniestro_pcl;
use App\tbl_seguimiento;
use App\tbl_empresa;
use App\User;
use App\tbl_califiaciones;
use App\tbl_calendarios;
use App\tbl_adicionpcl;
use App\tbl_precalificaciones;
use App\tbl_recalificacion_pcl;
use App\tbl_traza;

class CrearPclController extends Controller {

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
        $afiliado = new tbl_afiliado();
        $siniestroPcl = new tbl_siniestro_pcl();
        $seguimiento = new tbl_seguimiento();
        $empresa = new tbl_empresa();
        $agenda = new tbl_calendarios();

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
            $afiliado->save();
            $idAfiliado = $afiliado->idAfiliado;
        }


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
        }

        /* ======================Registtro en la tabla SiniestroPcl============================== */
        $siniestroPcl->llaveCanalEntrada = $request->input('txtCanalEntrada');
        $siniestroPcl->llaveQuienSolicita = $request->input('txtQuienSolicita');
        $siniestroPcl->llaveTipoSolicitud = $request->input('txtTipoSolicitud');
        $siniestroPcl->llaveTipoEvento = $request->input('txtTipoEvento');
        $siniestroPcl->fechaEvento = $request->input('TxtFechaEvento');
        $siniestroPcl->fechaAsignacionDelCliente = $request->input('TxtFechaAsignacionCliente');
        $siniestroPcl->idSiniestro = $request->input('txtIdSiniestro');
        $siniestroPcl->otros = $request->input('txtOtros');
        $siniestroPcl->pqr = $request->input('txtPqr');


        if ($afiliadoExiste != 'SI') {
            $siniestroPcl->llaveAfiliado = $idAfiliado;
        } else {
            $siniestroPcl->llaveAfiliado = $request->input('TxtIdAfiliado');
            $idAfiliado = $request->input('TxtIdAfiliado');
        }


        $siniestroPcl->requiereValoracionPresencial = $request->input('TxtRequiereVal');
        $siniestroPcl->llaveUsuarioQuienCrea = $request->input('TxtUsuarioQuienCrea');


        if ($empresaNueva == 'SI') {
            /* ==============Si la empresa es nueva ======================== */
            $siniestroPcl->llaveEmpresaPcl = $idEmpresa;
        } else {
            /* ==============Si la empresa ya existe ======================== */
            $siniestroPcl->llaveEmpresaPcl = $request->input('txtIdedmpresa');
        }

        // $siniestroPcl->llaveUsuarioAsigando = $request->input('TxtAsignarA');

        $requiereVal = $request->input('TxtRequiereVal');
        $preCalifiacion = $request->input('TxtRPrecalifiacion');

        if ($preCalifiacion == 'Si') {
            $siniestroPcl->llaveListaPrecalificacion = 'SI';
        } else {
            $siniestroPcl->llaveListaPrecalificacion = 'NO';
        }

        if ($requiereVal == 'Si') {
            $siniestroPcl->requiereValoracionPresencial = 'SI';
        } else {
            $siniestroPcl->requiereValoracionPresencial = 'NO';
        }

        $siniestroPcl->save();
        $idSiniestroPcl = $siniestroPcl->idSiniestroPcl;


        if ($preCalifiacion == 'Si') {

            $precClificar = new tbl_precalificaciones();
            $precClificar->llaveCalificador = $request->input('TxtAsignarA');
            $precClificar->llaveEstadoPrecalificacion = '1';

            $precClificar->save();
            $idPrecalificar = $precClificar->idPrecalificacion;

            /* =======================update  Formulario 'formularios'=========================== */
            tbl_siniestro_pcl::where('idSiniestroPcl', '=', $idSiniestroPcl)->update(['llavePrecalificacion' => $idPrecalificar]);
        }

        if ($requiereVal == 'No' && $preCalifiacion == 'No') {

            $calificar = new tbl_califiaciones();
            $calificar->llaveCalificadorCalifiacion = $request->input('TxtAsignarA');
            $calificar->llaveEstadoCalificacion = "1";
            $calificar->save();
            $idCalificacion = $calificar->idCalifiacion;

            /* =======================update  Formulario 'formularios'=========================== */
            tbl_siniestro_pcl::where('idSiniestroPcl', '=', $idSiniestroPcl)->update(['llaveCalificacion' => $idCalificacion]);
        }

        $agendarCita = $request->input('TxtDiaCita');
        $medicoAgenda = $request->input('TxtMedicoAgenda');


        if ($requiereVal == 'Si') {
            $seguimiento->tipoSeguimiento = 'primer';
            $seguimiento->fechaSeguimiento = $request->input('TxtFechaContactoAfiliado');
            $seguimiento->seguimiento = $request->input('TxtSeguimiento');
            $seguimiento->llaveSubEstado = $request->input('TxtSubEstado');
            $seguimiento->llaveRevisadoPor = $request->input('TxtRevisadoPor');
            $seguimiento->llaveSiniestroPcl = $idSiniestroPcl;
            $seguimiento->save();


            if ($agendarCita != NULL && $medicoAgenda != NULL) {

                $agenda->llaveMedico = $request->input('TxtMedicoAgenda');
                $agenda->llaveAfiliadoAgenda = $idAfiliado;
                $agenda->diaCita = $request->input('TxtDiaCita');
                $agenda->finCita = $request->input('TxtDiaCita');
                $agenda->llaveHoraCita = $request->input('TxtHoraCitaAgenda');
                $agenda->llaveTipoConsulta = $request->input('TxtTipoConsultaAgenda');
                $agenda->EstadoCita = 'ABIERTA';
                $agenda->save();

                $calificar = new tbl_califiaciones();
                $calificar->llaveCalificadorCalifiacion = $request->input('TxtMedicoAgenda');
                $calificar->llaveEstadoCalificacion = "1";
                $calificar->save();
                $idCalificacion = $calificar->idCalifiacion;
                /* =======================update  Formulario 'formularios'=========================== */
                tbl_siniestro_pcl::where('idSiniestroPcl', '=', $idSiniestroPcl)->update(['llaveCalificacion' => $idCalificacion]);
            }
        }



        /* ==================================================== */
        // --===================Traza empreza==================--
        /* ==================================================== */

        $traza = new tbl_traza();
        $traza->tipo = 'CREACION DEL SINIESTRO';
        $traza->llaveSiniestroPclUnion = $idSiniestroPcl;
        $traza->llaveUserPcTtraza = $request->input('TxtUsuarioQuienCrea');
        $traza->save();


        return redirect('/Siniestro/' . $idSiniestroPcl . '/edit');

        /* $siniestroPcl->llavePrecalificacion = $request->input('');
          $siniestroPcl->llaveCalificacion = $request->input('');
          $siniestroPcl->llaveRecalificacion = $request->input(''); */
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

        $tipoDocumentoAfiliado = \DB::table('tbl_tipo_docuemtno')->get();

        $departamento = \DB::table('tbl_departamento')->get();

        $ciudades = \DB::table('tbl_ciudad')->get();

        $entididadCalifica = \DB::table('tbl_entidad_califica')->get();

        $subEstadoSeguimiento = \DB::table('tbl_sub_estado_seguimientos')->get();

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

        $valorPcl = \DB::table('tbl_valor_pcl')->get();

        $medico = \DB::table('users')
                        ->leftjoin('tbl_rol', 'tbl_rol.id_rol', '=', 'users.llaveRol_usuario')
                        ->leftjoin('tbl_horario_atencion_medicos', 'tbl_horario_atencion_medicos.llaveMedicoHorario', '=', 'users.id')
                        ->leftjoin('tbl_ciudad', 'tbl_ciudad.id_ciudad', '=', 'tbl_horario_atencion_medicos.llaveCiudadAtencionMedico')
                        ->where('rol', '=', 'CALIFICADOR_ADSCRITO')->get();

        $medicoInfo = User::where('rol', '=', 'CALIFICADOR_ADSCRITO')
                ->leftjoin('tbl_rol', 'tbl_rol.id_rol', '=', 'users.llaveRol_usuario')
                ->leftjoin('tbl_horario_atencion_medicos', 'tbl_horario_atencion_medicos.llaveMedicoHorario', '=', 'users.id')
                ->leftjoin('tbl_ciudad', 'tbl_ciudad.id_ciudad', '=', 'tbl_horario_atencion_medicos.llaveCiudadAtencionMedico')
                ->firstOrFail();

        $estados = \DB::table('tbl_estado_siniestro')
                        ->leftjoin('tbl_tipo_modulo', 'tbl_tipo_modulo.id_tipo_modulo', '=', 'tbl_estado_siniestro.llave_tipo_modulo')
                        ->where('modulo', 'PCL')->get();

        $estadospre = \DB::table('tbl_estado_siniestro')
                        ->leftjoin('tbl_tipo_modulo', 'tbl_tipo_modulo.id_tipo_modulo', '=', 'tbl_estado_siniestro.llave_tipo_modulo')
                        ->where('modulo', 'PCL')
                        ->where('filtro', 'PRECALIFICACION')->get();

        $estadosCali = \DB::table('tbl_estado_siniestro')
                        ->leftjoin('tbl_tipo_modulo', 'tbl_tipo_modulo.id_tipo_modulo', '=', 'tbl_estado_siniestro.llave_tipo_modulo')
                        ->where('modulo', 'PCL')
                        ->where('filtro', 'CALIFICACION')->get();

        $estadosReCali = \DB::table('tbl_estado_siniestro')
                        ->leftjoin('tbl_tipo_modulo', 'tbl_tipo_modulo.id_tipo_modulo', '=', 'tbl_estado_siniestro.llave_tipo_modulo')
                        ->where('modulo', 'PCL')
                        ->where('filtro', 'RECALIFICACION')->get();

        $seguimiento = \DB::table('tbl_siniestro_pcls')
                        ->leftjoin('tbl_seguimientos', 'tbl_seguimientos.llaveSiniestroPcl', '=', 'tbl_siniestro_pcls.idSiniestroPcl')
                        ->leftjoin('users', 'users.id', '=', 'tbl_seguimientos.llaveRevisadoPor')
                        ->leftjoin('tbl_sub_estado_seguimientos', 'tbl_sub_estado_seguimientos.idSub_estado_seguimientos', '=', 'tbl_seguimientos.llaveSubEstado')
                        ->where('idSiniestroPcl', $id)->get();

        $infoSiniestro = tbl_siniestro_pcl::where('idSiniestroPcl', '=', $id)
                ->leftjoin('tbl_afiliados', 'tbl_afiliados.idAfiliado', '=', 'tbl_siniestro_pcls.llaveAfiliado')
                ->leftjoin('tbl_departamento', 'tbl_departamento.id_departamento', '=', 'tbl_afiliados.llaveDepartamento')
                ->leftjoin('tbl_ciudad', 'tbl_ciudad.id_ciudad', '=', 'tbl_afiliados.llaveCiudad')
                ->leftjoin('tbl_tipo_docuemtno', 'tbl_tipo_docuemtno.id_tipo_docuemtno', '=', 'tbl_afiliados.llaveTipoDocumento')
                ->leftjoin('tbl_empresas', 'tbl_empresas.id_empresa', '=', 'tbl_siniestro_pcls.llaveEmpresaPcl')
                ->leftjoin('tbl_entrada', 'tbl_entrada.id_entrada', '=', 'tbl_siniestro_pcls.llaveCanalEntrada')
                ->leftjoin('tbl_quien_solicita', 'tbl_quien_solicita.id_quien_solicita', '=', 'tbl_siniestro_pcls.llaveQuienSolicita')
                ->leftjoin('tbl_solicitud', 'tbl_solicitud.id_solicitud', '=', 'tbl_siniestro_pcls.llaveTipoSolicitud')
                ->leftjoin('tbl_tipo_evento', 'tbl_tipo_evento.id_tipo_evento', '=', 'tbl_siniestro_pcls.llaveTipoEvento')
                ->leftjoin('tbl_seguimientos', 'tbl_seguimientos.llaveSiniestroPcl', '=', 'tbl_siniestro_pcls.idSiniestroPcl')
                ->firstOrFail();

        $pre = tbl_siniestro_pcl::where('idSiniestroPcl', '=', $id)
                ->leftjoin('tbl_precalificaciones', 'tbl_precalificaciones.idPrecalificacion', '=', 'tbl_siniestro_pcls.llavePrecalificacion')
                ->leftjoin('tbl_estado_siniestro as epc', 'epc.id_estado_siniestro', '=', 'tbl_precalificaciones.llaveEstadoPrecalificacion')
                ->leftjoin('users', 'users.id', '=', 'tbl_precalificaciones.llaveCalificador')
                ->select('*', \DB::raw('tbl_precalificaciones.updated_at as fechagestion'))
                ->firstOrFail();

        $preAnalisis = \DB::table('tbl_siniestro_pcls')
                        ->leftjoin('tbl_precalificaciones', 'tbl_precalificaciones.idPrecalificacion', '=', 'tbl_siniestro_pcls.llavePrecalificacion')
                        ->leftjoin('tbl_analisis_casos', 'tbl_analisis_casos.llave_unionPrecalificacionAnalisis', '=', 'tbl_precalificaciones.idPrecalificacion')
                        ->where('idSiniestroPcl', $id)->get();

        $preSolicitud = \DB::table('tbl_siniestro_pcls')
                        ->leftjoin('tbl_precalificaciones', 'tbl_precalificaciones.idPrecalificacion', '=', 'tbl_siniestro_pcls.llavePrecalificacion')
                        ->leftjoin('tbl_solicitud_anexos', 'tbl_solicitud_anexos.llavePrecalificacionunion', '=', 'tbl_precalificaciones.idPrecalificacion')
                        ->where('idSiniestroPcl', $id)->get();

        $cali = tbl_siniestro_pcl::where('idSiniestroPcl', '=', $id)
                ->leftjoin('tbl_califiaciones', 'tbl_califiaciones.idCalifiacion', '=', 'tbl_siniestro_pcls.llaveCalificacion')
                ->leftjoin('tbl_estado_siniestro as epc', 'epc.id_estado_siniestro', '=', 'tbl_califiaciones.llaveEstadoCalificacion')
                ->firstOrFail();

        $profesionalAsignar = \DB::table('users')
                        ->leftjoin('tbl_rol', 'tbl_rol.id_rol', '=', 'users.llaveRol_usuario')
                        ->orderBy('name')
                        ->where('rol', '=', 'PROFESIONAL')->get();



        $clf = tbl_siniestro_pcl::where('idSiniestroPcl', '=', $id)
                ->leftjoin('tbl_califiaciones as c', 'c.idCalifiacion', '=', 'tbl_siniestro_pcls.llaveCalificacion')
                ->leftjoin('tbl_estado_siniestro as epc', 'epc.id_estado_siniestro', '=', 'c.llaveEstadoCalificacion')
                ->leftjoin('tbl_sub_estados as sb', 'sb.id_sub_estados', '=', 'c.llaveSubEstadoCalificacion')
                ->leftjoin('users as u', 'u.id', '=', 'c.llaveCalificadorCalifiacion')
                ->select('*', \DB::raw('c.updated_at as fechaGestionCali'))
                ->firstOrFail();

        $reClf = tbl_siniestro_pcl::where('idSiniestroPcl', '=', $id)
                ->leftjoin('tbl_recalificacion_pcls as rc', 'rc.idRecalificacionPcls', '=', 'tbl_siniestro_pcls.llaveRecalificacion')
                ->leftjoin('tbl_estado_siniestro as epc', 'epc.id_estado_siniestro', '=', 'rc.llaveEstadoRecalificacion')
                ->leftjoin('tbl_sub_estados as sb', 'sb.id_sub_estados', '=', 'rc.llaveSubEstadoRecalificacion')
                ->leftjoin('users as u', 'u.id', '=', 'rc.llaveCalificadorRecalificacion')
                ->leftjoin('tbl_tipo_evento as te', 'te.id_tipo_evento', '=', 'rc.llaveTipoEventoRecali')
                ->select('*', \DB::raw('rc.updated_at as fechaGestionReCali'))
                ->firstOrFail();

        $adiciones = tbl_siniestro_pcl::where('idSiniestroPcl', '=', $id)
                ->leftjoin('tbl_adicionpcls', 'tbl_adicionpcls.llaveSiniestroAdicionPcl', '=', 'tbl_siniestro_pcls.idSiniestroPcl')
                ->leftjoin('tbl_afiliados', 'tbl_afiliados.idAfiliado', '=', 'tbl_siniestro_pcls.llaveAfiliado')
                ->leftjoin('tbl_tipo_docuemtno', 'tbl_tipo_docuemtno.id_tipo_docuemtno', '=', 'tbl_afiliados.llaveTipoDocumento')
                ->leftjoin('tbl_entrada', 'tbl_entrada.id_entrada', '=', 'tbl_adicionpcls.llaveCanalEntradaAdiPcl')
                ->leftjoin('tbl_quien_solicita', 'tbl_quien_solicita.id_quien_solicita', '=', 'tbl_adicionpcls.LlaveQuienSoliAdiPcl')
                ->leftjoin('tbl_solicitud', 'tbl_solicitud.id_solicitud', '=', 'tbl_adicionpcls.LlavetipoSoliAdiPcl')
                ->leftjoin('tbl_tipo_evento', 'tbl_tipo_evento.id_tipo_evento', '=', 'tbl_adicionpcls.llaveTipoEventoAdiPcl')
                ->leftjoin('users as u', 'u.id', '=', 'tbl_adicionpcls.llaveUsuarioAsigAdiPcl')
                ->leftjoin('tbl_estado_siniestro as es', 'es.id_estado_siniestro', '=', 'tbl_adicionpcls.llaveEstadoAdicion')
                ->leftjoin('tbl_sub_estados as sbs', 'sbs.id_sub_estados', '=', 'tbl_adicionpcls.llaveSubEstadoAdicion')
                ->get();

        $caliAnexos = \DB::table('tbl_siniestro_pcls as s')
                        ->leftjoin('tbl_califiaciones as c', 'c.idCalifiacion', '=', 's.llaveCalificacion')
                        ->leftjoin('tbl_solicitud_anexos as so', 'so.llaveCalificacion', '=', 'c.idCalifiacion')
                        ->where('idSiniestroPcl', $id)->get();

        $caliObser = \DB::table('tbl_siniestro_pcls as s')
                        ->leftjoin('tbl_califiaciones as c', 'c.idCalifiacion', '=', 's.llaveCalificacion')
                        ->leftjoin('tbl_observacion_pcl_s as o', 'o.LlaveCalificacionPcl', '=', 'c.idCalifiacion')
                        ->where('idSiniestroPcl', $id)->get();

        $obrrecali = \DB::table('tbl_siniestro_pcls as s')
                        ->leftjoin('tbl_recalificacion_pcls as rc', 'rc.idRecalificacionPcls', '=', 's.llaveRecalificacion')
                        ->leftjoin('tbl_observacion_pcl_s as o', 'o.LlaveReCalificacionPcl', '=', 'rc.idRecalificacionPcls')
                        ->where('idSiniestroPcl', $id)->get();

        $tipoSolicitud = \DB::table('tbl_solicitud')
                        ->where('procesoSolicitud', 'PCL')->get();


        $cartas = tbl_siniestro_pcl::where('idSiniestroPcl', '=', $id)
                ->leftjoin('tbl_recalificacion_pcls as rc', 'rc.idRecalificacionPcls', '=', 'tbl_siniestro_pcls.llaveRecalificacion')
                ->leftjoin('tbl_cartas as car', 'car.llaveUnionRecalificacionCartas', '=', 'rc.idRecalificacionPcls')
                ->leftjoin('users as u', 'u.id', '=', 'car.llaveQuienCreaCarta')
                ->select('*', \DB::raw('car.created_at as fechaCreacion'))
                ->get();

        $cartasNegacion = tbl_siniestro_pcl::where('idSiniestroPcl', '=', $id)
                ->leftjoin('tbl_recalificacion_pcls as rc', 'rc.idRecalificacionPcls', '=', 'tbl_siniestro_pcls.llaveRecalificacion')
                ->leftjoin('tbl_cartanegaciones  as car', 'car.llaveCartasnegacionRecalificacion', '=', 'rc.idRecalificacionPcls')
                ->leftjoin('users as u', 'u.id', '=', 'car.llaveQuienCreaCartaNega')
                ->select('*', \DB::raw('car.created_at as fechaCreacion'))
                ->get();
        //\View::share('prueba', 'klfsdghdksfgh');

        return view('siniestroPcl.gestionPcl', compact('entididadCalifica', 'cartasNegacion', 'cartas', 'obrrecali', 'tipoSolicitud', 'adiciones', 'reClf', 'estadosReCali', 'caliObser', 'caliAnexos', 'valorPcl', 'clf', 'cali', 'estadospre', 'estadosCali', 'preSolicitud', 'preAnalisis', 'pre', 'profesionalAsignar', 'medicoAsignar', 'seguimiento', 'estados', 'medicoInfo', 'medico', 'infoSiniestro', 'origenDiagnostico', 'diagnosticos', 'entradaPcl', 'tipoEvento', 'tipoDocumentoAfiliado', 'departamento', 'subEstadoSeguimiento', 'usuarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $datosBasicoSiniestro = tbl_siniestro_pcl::where('idSiniestroPcl', '=', $id)->firstOrFail();
        $datosBasicoSiniestro->fill($request->all());
        $datosBasicoSiniestro->save();
        $idAfiliado = $request->input('idAfiliado');


        $datosBasicoAfiliado = tbl_afiliado::where('idAfiliado', '=', $idAfiliado)->firstOrFail();
        $datosBasicoAfiliado->fill($request->all());
        $datosBasicoAfiliado->save();


        $recalificacion = $request->input('llaveTipoSolicitud');
        $asignarA = $request->input('TxtAsignarARecaifi');

        if ($recalificacion == '5' && $asignarA != null) {

            $recali = new tbl_recalificacion_pcl();
            $recali->llaveCalificadorRecalificacion = $request->input('TxtAsignarARecaifi');
            $recali->llaveEstadoRecalificacion = '1';

            $recali->save();
            $idrecalificacion = $recali->idRecalificacionPcls;
            /* =======================update  Formulario 'llave unnion Calificacion'=========================== */
            tbl_siniestro_pcl::where('idSiniestroPcl', '=', $id)->update(['llaveRecalificacion' => $idrecalificacion]);
        }



        /* =========================Traza Afiliado y Siniestro============================================ */

        /* ==================================================== */
        // --Traza Update Canal entrada variables Nuevas -----
        /* ==================================================== */
        $canalentradaN = $request->input('llaveCanalEntrada');
        $quienSolicitaN = $request->input('llaveQuienSolicita');
        $tipoSolicitudN = $request->input('llaveTipoSolicitud');
        $tipoEventoN = $request->input('llaveTipoEvento');
        $FechaEventoN = $request->input('fechaEvento');
        $fechasAsiClienteN = $request->input('fechaAsignacionDelCliente');
        $siniestroN = $request->input('idSiniestro');
        $otrosN = $request->input('otros');
        $pqrN = $request->input('pqr');

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
        $canalentradaA = $request->input('canalentradaA');
        $quienSolicitaA = $request->input('quienSolicitaA');
        $tipoSolicitudA = $request->input('tipoSolicitudA');
        $tipoEventoA = $request->input('tipoEventoA');
        $FechaEventoA = $request->input('FechaEventoA');
        $fechasAsiClienteA = $request->input('fechasAsiClienteA');
        $siniestroA = $request->input('siniestroA');
        $otrosA = $request->input('trosA');
        $pqrA = $request->input('pqrA');

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
            $traza->llaveSiniestroPclUnion = $id;
            $traza->llaveUserPcTtraza = $request->input('modifica');
            $traza->save();
        }
        /* ==================================================== */
        // --===================Traza Canal Enrada=============--
        /* ==================================================== */

        if ($canalentradaA != $canalentradaN) {
            $traza3 = new tbl_traza();
            $traza3->tipo = 'CANAL ENTRADA';
            $anteriorEntradas = \DB::table('tbl_entrada')
                            ->where('id_entrada', $canalentradaA)->get();
            foreach ($anteriorEntradas as $anteriorEntrada) {
                $traza3->anterior = $anteriorEntrada->entrada;
            }
            /*   ======================================== */
            $nuevaEntradas = \DB::table('tbl_entrada')
                            ->where('id_entrada', $canalentradaN)->get();
            foreach ($nuevaEntradas as $nuevaEntrada) {
                $traza3->nuevo = $nuevaEntrada->entrada;
            }
            $traza3->llaveSiniestroPclUnion = $id;
            $traza3->llaveUserPcTtraza = $request->input('modifica');
            $traza3->save();
        }
        /* ==================================================== */
        // --================= Traza Quien Solicita ==========--
        /* ==================================================== */

        if ($quienSolicitaA != $quienSolicitaN) {
            $traza2 = new tbl_traza();
            $traza2->tipo = 'QUIEN SOLICITA';
            $anteriorQuiens = \DB::table('tbl_quien_solicita')
                            ->where('id_quien_solicita', $quienSolicitaA)->get();
            foreach ($anteriorQuiens as $anteriorQuien) {
                $traza2->anterior = $anteriorQuien->quien_solicita;
            }
            /*   ======================================== */
            $nuevaQuiens = \DB::table('tbl_quien_solicita')
                            ->where('id_quien_solicita', $quienSolicitaN)->get();
            foreach ($nuevaQuiens as $nuevaQuien) {
                $traza2->nuevo = $nuevaQuien->quien_solicita;
            }
            $traza2->llaveSiniestroPclUnion = $id;
            $traza2->llaveUserPcTtraza = $request->input('modifica');
            $traza2->save();
        }

        /* ==================================================== */
        // --================= Traza Tipo Solicitud ==========--
        /* ==================================================== */

        if ($tipoSolicitudA != $tipoSolicitudN) {
            $traza4 = new tbl_traza();
            $traza4->tipo = 'TIPO SOLICITUD';
            $anteriorTipoSolicitudes = \DB::table('tbl_solicitud')
                            ->where('id_solicitud', $tipoSolicitudA)->get();
            foreach ($anteriorTipoSolicitudes as $anteriorTipoSolicitud) {
                $traza4->anterior = $anteriorTipoSolicitud->solicitud;
            }
            /*   ======================================== */
            $nuevaTipoSolicitudes = \DB::table('tbl_solicitud')
                            ->where('id_solicitud', $tipoSolicitudN)->get();
            foreach ($nuevaTipoSolicitudes as $nuevaTipoSolicitud) {
                $traza4->nuevo = $nuevaTipoSolicitud->solicitud;
            }
            $traza4->llaveSiniestroPclUnion = $id;
            $traza4->llaveUserPcTtraza = $request->input('modifica');
            $traza4->save();
        }

        /* ==================================================== */
        // --================= Traza Tipo Evento ==========--
        /* ==================================================== */

        if ($tipoEventoA != $tipoEventoN) {
            $traza5 = new tbl_traza();
            $traza5->tipo = 'TIPO EVENTO';
            $anteriorTipoSolicitudes = \DB::table('tbl_tipo_evento')
                            ->where('id_tipo_evento', $tipoEventoA)->get();
            foreach ($anteriorTipoSolicitudes as $anteriorTipoSolicitud) {
                $traza5->anterior = $anteriorTipoSolicitud->tipo_evento;
            }
            /*   ======================================== */
            $nuevaTipoSolicitudes = \DB::table('tbl_tipo_evento')
                            ->where('id_tipo_evento', $tipoEventoN)->get();
            foreach ($nuevaTipoSolicitudes as $nuevaTipoSolicitud) {
                $traza5->nuevo = $nuevaTipoSolicitud->tipo_evento;
            }
            $traza5->llaveSiniestroPclUnion = $id;
            $traza5->llaveUserPcTtraza = $request->input('modifica');
            $traza5->save();
        }


        /* ==================================================== */
        // --================= Traza FECHA DEL EVENTO ==========--
        /* ==================================================== */

        if ($FechaEventoA != $FechaEventoN) {
            $traza6 = new tbl_traza();
            $traza6->tipo = 'FECHA DEL EVENTO';
            $traza6->anterior = $FechaEventoA;
            /*   ======================================== */
            $traza6->nuevo = $FechaEventoN;
            $traza6->llaveSiniestroPclUnion = $id;
            $traza6->llaveUserPcTtraza = $request->input('modifica');
            $traza6->save();
        }

        /* ==================================================== */
        // --=============== Traza FECHA DEL EVENTO ==========--
        /* ==================================================== */

        if ($fechasAsiClienteA != $fechasAsiClienteN) {
            $traza7 = new tbl_traza();
            $traza7->tipo = 'FECHA ASIGNACION CLIENTE';
            $traza7->anterior = $fechasAsiClienteA;
            /*   ======================================== */
            $traza7->nuevo = $fechasAsiClienteN;
            $traza7->llaveSiniestroPclUnion = $id;
            $traza7->llaveUserPcTtraza = $request->input('modifica');
            $traza7->save();
        }

        /* ==================================================== */
        // --=============== Traza Siniestro==========--
        /* ==================================================== */

        if ($siniestroA != $siniestroN) {
            $traza8 = new tbl_traza();
            $traza8->tipo = 'SINIESTRO';
            $traza8->anterior = $siniestroA;
            /*   ======================================== */
            $traza8->nuevo = $siniestroN;
            $traza8->llaveSiniestroPclUnion = $id;
            $traza8->llaveUserPcTtraza = $request->input('modifica');
            $traza8->save();
        }

        /* ==================================================== */
        // --=============== Traza OTRO    ==========--
        /* ==================================================== */

        if ($otrosA != $otrosN) {
            $traza9 = new tbl_traza();
            $traza9->tipo = 'OTRO';
            $traza9->anterior = $otrosA;
            /*   ======================================== */
            $traza9->nuevo = $otrosN;
            $traza9->llaveSiniestroPclUnion = $id;
            $traza9->llaveUserPcTtraza = $request->input('modifica');
            $traza9->save();
        }

        /* ==================================================== */
        // --=============== Traza PQR      ==========--
        /* ==================================================== */

        if ($pqrA != $pqrN) {
            $traza10 = new tbl_traza();
            $traza10->tipo = 'PQR';
            $traza10->anterior = $pqrA;
            /*   ======================================== */
            $traza10->nuevo = $pqrN;
            $traza10->llaveSiniestroPclUnion = $id;
            $traza10->llaveUserPcTtraza = $request->input('modifica');
            $traza10->save();
        }


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
            $traza01->llaveSiniestroPclUnion = $id;
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
            $traza02->llaveSiniestroPclUnion = $id;
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
            $traza03->llaveSiniestroPclUnion = $id;
            $traza03->llaveUserPcTtraza = $request->input('modifica');
            $traza03->save();
        }
        /* ==================================================== */
        // --=============== Traza PQR      ==========--
        /* ==================================================== */

        if ($direccionA != $direccionN) {
            $traza04 = new tbl_traza();
            $traza04->tipo = 'DIRECCION';
            $traza04->anterior = $direccionA;
            /*   ======================================== */
            $traza04->nuevo = $direccionN;
            $traza04->llaveSiniestroPclUnion = $id;
            $traza04->llaveUserPcTtraza = $request->input('modifica');
            $traza04->save();
        }
        /* ==================================================== */
        // --================= Traza Departamento ==========--
        /* ==================================================== */

        if ($departamentoA != $departamentoN) {
            $traza05 = new tbl_traza();
            $traza05->tipo = 'DEPARTAMENTO';
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
            $traza05->llaveSiniestroPclUnion = $id;
            $traza05->llaveUserPcTtraza = $request->input('modifica');
            $traza05->save();
        }

        /* ==================================================== */
        // --================= Traza Ciudad ==========--
        /* ==================================================== */

        if ($ciudadA != $ciudadN) {
            $traza06 = new tbl_traza();
            $traza06->tipo = 'CIUDAD';
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
            $traza06->llaveSiniestroPclUnion = $id;
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
            $traza07->llaveSiniestroPclUnion = $id;
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
            $traza08->llaveSiniestroPclUnion = $id;
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
            $traza09->llaveSiniestroPclUnion = $id;
            $traza09->llaveUserPcTtraza = $request->input('modifica');
            $traza09->save();
        }


        return redirect('/Siniestro/' . $id . '/edit');
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
