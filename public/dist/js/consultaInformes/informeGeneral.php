<?php

namespace Phppot;

session_start();

class InformeGeneral {

    private $ds;

    function __construct() {
        require_once 'DataSource.php';
        $this->ds = new DataSource();
    }

    public function getAllSiniestro() {

        //error_reporting(0);


        $TxtCanalEntrada = "";
        $TxtQuienSolicita = "";
        $TxtTipoSolicitud = "";
        $TxtPreCalificacion = "";
        $TxtCalificacion = "";
        $TxtReCalificacion = "";
        $TxtSubPreCalificacion = "";
        $TxtSubCalificacion = "";
        $TxtSubReCalificacion = "";
        $Txtestado = "";
        $TxtSubEstado = "";
        $TxtPreCaliName = "";
        $TxtCaliName = "";
        $TxtReCaliName = "";
        $TxtFecha = "";



        $canalEntrada = $_SESSION['canalEntrada'];
        $quienSolicita = $_SESSION['quienSolicita'];
        $tipoSolicitud = $_SESSION['tipoSolicitud'];
        $estado = $_SESSION['estado'];
        $subEstado = $_SESSION['subEstado'];
        $asigando = $_SESSION['asigando'];
        $fechaDesde = $_SESSION['fechaDesde'];
        $fechaHasta = $_SESSION['fechaHasta'];



        if ($fechaDesde != null and $fechaHasta != null) {
            $TxtFecha = " DATE(fechaCreacionCaso) BETWEEN '$fechaDesde' AND '$fechaHasta'";
        }

        if ($fechaDesde != null and $fechaHasta != null) {
            $TxtFechaAdicio = " DATE(fechaCreacioonAdicin) BETWEEN '$fechaDesde' AND '$fechaHasta'";
        }

        if ($canalEntrada != null) {
            $TxtCanalEntrada = " AND entrada = '$canalEntrada' ";
        }
        if ($quienSolicita != null) {
            $TxtQuienSolicita = " AND quien_solicita = '$quienSolicita'";
        }
        if ($tipoSolicitud != null) {
            $TxtTipoSolicitud = " AND solicitud = '$tipoSolicitud'";
        }
        if ($estado != null) {
            // $TxtPreCalificacion = " and  ec.estado_siniestro = '$estado'";
            $TxtCalificacion = " AND  ec.estado_siniestro = '$estado'";
            $TxtReCalificacion = " OR  ercl.estado_siniestro = '$estado'";
        }

        if ($subEstado != null) {
            // $TxtSubPreCalificacion = " OR  sbpcl.sub_estados = '$subEstado'";
            $TxtSubCalificacion = " AND  sbc.sub_estados = '$subEstado'";
            $TxtSubReCalificacion = " OR  sbrcl.sub_estados = '$subEstado'";
        }
        if ($asigando != null) {
            ///$TxtPreCaliName = " OR upc.name = '$asigando'";
            $TxtCaliName = " OR ucl.name = '$asigando'";
            $TxtReCaliName = " OR urc.name = '$asigando'";
        }



        $query = "
      SELECT 
    idSiniestroPcl AS id,
    entrada,
    quien_solicita,
    solicitud,
    tipo_evento,
    fechaEvento,
    fechaCreacionCaso,
    fechaAsignacionDelCliente,
    tipo_documento,
    documento,
    nombre,
    idSiniestro,
    dp.departamento AS depar,
    razon_social_empleador,
    nit,
    fechaSolicitudAnexosCali,
    anexoCalificacion,
    fechaSeguimientoAnexosCal,
    fechaRecepcionAnexosCal,
    ec.estado_siniestro AS estadoCalificacion,
    sbc.sub_estados AS subEstadoCalificacion,
    ucl.name AS usuarioCalificacion,
    procentajePcl,
    fechaEnvioComite,
    fechaDevolucionComite,
    fechaVisado,
    ca.updated_at AS gestionCalificacion,
    ercl.estado_siniestro AS estadoRecalificacion,
    urc.name AS usuarioRecalificacion,
    porcentajePclRecalificacion,
    fechaEnvioComiteRecalificacion,
    fechaDevolcionComiteRecalificacion,
    fechaVisadoRecalificacion,
    rc.updated_at AS getionRecalificacion,
    GROUP_CONCAT(DISTINCT cie.id_ident
        SEPARATOR ' | ') AS id_ident,
    GROUP_CONCAT(DISTINCT cie.cie_10
        SEPARATOR ' | ') AS cie10,
    GROUP_CONCAT(DISTINCT cipcl.descripcion
        SEPARATOR ' | ') AS descripcionCie10,
    requiereValoracionPresencial,
    IF(s.llaveRecalificacion IS NULL,
        IF(s.llaveCalificacion IS NULL,
            IF(s.llavePrecalificacion IS NOT NULL,
                prcli.updated_at,
                ''),
            ca.updated_at),
        rc.updated_at) AS fechaGestionAutomatica,
    IF(s.llaveRecalificacion IS NOT NULL,
        IF(sbrcl.sub_estados = 'ASIGNADO COMITE CODESS',
            'ABIERTO',
            IF(sbrcl.sub_estados = 'ASIGNADO COMITE POSITIVA ',
                'ABIERTO',
                IF(sbrcl.sub_estados = 'DEVOLUCION COMITE',
                    'ABIERTO',
                    IF(sbrcl.sub_estados = 'AVALADO',
                        'CERRADO',
                        IF(sbrcl.sub_estados = 'ASIGNADO A COMITE CODESS NEGACION REC',
                            'ABIERTO',
                            IF(sbrcl.sub_estados = 'PENDIENTE ANEXOS',
                                'CERRADO TEMPORALMENTE',
                                IF(sbrcl.sub_estados = 'EN CONTROVERSIA CAL 1RA OPORTUNIDAD',
                                    'ABIERTO',
                                    IF(sbrcl.sub_estados = 'PENDIENTE ACTA EJECUTORIA',
                                        'CERRADO TEMPORALMENTE',
                                        IF(sbrcl.sub_estados = 'PCL SIN NOTIFICAR',
                                            'CERRADO TEMPORALMENTE',
                                            IF(sbrcl.sub_estados = 'SIN DOCUMENTOS SUFICIENTES',
                                                'CERRADO TEMPORALMENTE',
                                                IF(sbrcl.sub_estados = 'EVENTO MORTAL',
                                                    'CERRADO',
                                                    IF(sbrcl.sub_estados = 'CALIFICACION A CARGO DE OTRO PROVEEDOR',
                                                        'CERRADO',
                                                        IF(sbrcl.sub_estados = 'LEVANTAR MASIVO',
                                                            'ABIERTO',
                                                            IF(sbrcl.sub_estados = 'APERTURA DE RECALIFICACION',
                                                                'ABIERTO',
                                                                IF(sbrcl.sub_estados = 'SOLICITUD DE EXPEDIENTE',
                                                                    'ABIERTO',
                                                                    IF(sbrcl.sub_estados = 'PENDIENTE ARANDA',
                                                                        'ABIERTO',
                                                                        IF(sbrcl.sub_estados = 'CAMBIO DE DECRETO',
                                                                            'ABIERTO',
                                                                            IF(sbrcl.sub_estados = 'CERTIFICACION AFILIACION ULTIMA ARL ',
                                                                                'CERRADO',
                                                                                IF(sbrcl.sub_estados = 'PENDIENTE FIRMAS',
                                                                                    'ABIERTO',
                                                                                    IF(sbrcl.sub_estados = 'CERRADO CON RADICADOS',
                                                                                        'ABIERTO',
                                                                                        IF(ercl.estado_siniestro = 'ASIGNADO',
                                                                                            'ABIERTO',
                                                                                            'ERROR 1_DB'))))))))))))))))))))),
        IF(s.llaveCalificacion IS NOT NULL,
            IF(sbc.sub_estados = 'ASIGNADO COMITE CODESS',
                'ABIERTO',
                IF(sbc.sub_estados = 'ASIGNADO COMITE POSITIVA ',
                    'ABIERTO',
                    IF(sbc.sub_estados = 'DEVOLUCION COMITE',
                        'ABIERTO',
                        IF(sbc.sub_estados = 'AVALADO',
                            'CERRADO',
                            IF(sbc.sub_estados = 'PENDIENTE ANEXOS',
                                'CERRADO TEMPORALMENTE',
                                IF(sbc.sub_estados = 'EN CONTROVERSIA CAL 1RA OPORTUNIDAD',
                                    'CERRADO TEMPORALMENTE',
                                    IF(sbc.sub_estados = 'PENDIENTE ACTA EJECUTORIA',
                                        'CERRADO TEMPORALMENTE',
                                        IF(sbc.sub_estados = 'SIN ALTA DE ESPECIALISTA',
                                            'CERRADO TEMPORALMENTE',
                                            IF(sbc.sub_estados = 'PCL SIN NOTIFICAR',
                                                'CERRADO TEMPORALMENTE',
                                                IF(sbc.sub_estados = 'ORIGEN SIN NOTIFICAR',
                                                    'CERRADO TEMPORALMENTE',
                                                    IF(sbc.sub_estados = 'ORIGEN COMUN',
                                                        'CERRADO',
                                                        IF(sbc.sub_estados = 'SIN DOCUMENTOS SUFICIENTES',
                                                            'CERRADO TEMPORALMENTE',
                                                            IF(sbc.sub_estados = 'SIN COBERTURA DESDE EL ORIGEN',
                                                                'CERRADO',
                                                                IF(sbc.sub_estados = 'EVENTO MORTAL',
                                                                    'CERRADO',
                                                                    IF(sbc.sub_estados = 'SIN CIERRE DE RHB',
                                                                        'CERRADO TEMPORALMENTE',
                                                                        IF(sbc.sub_estados = 'CALIFICACION A CARGO DE OTRO PROVEEDOR',
                                                                            'CERRADO',
                                                                            IF(sbc.sub_estados = 'LEVANTAR MASIVO',
                                                                                'ABIERTO',
                                                                                IF(sbc.sub_estados = 'PROMOVER PCL',
                                                                                    'ABIERTO',
                                                                                    IF(sbc.sub_estados = 'APERTURA DE RECALIFICACION',
                                                                                        'ABIERTO',
                                                                                        IF(sbc.sub_estados = 'SOLICITUD DE EXPEDIENTE',
                                                                                            'ABIERTO',
                                                                                            IF(sbc.sub_estados = 'PENDIENTE ARANDA',
                                                                                                'ABIERTO',
                                                                                                IF(sbc.sub_estados = 'CAMBIO DE DECRETO',
                                                                                                    'ABIERTO',
                                                                                                    IF(sbc.sub_estados = 'CERTIFICACION AFILIACION ULTIMA ARL',
                                                                                                        'CERRADO TEMPORALMENTE',
                                                                                                        IF(sbc.sub_estados = 'PENDIENTE GARANTÃA PROVEEDOR',
                                                                                                            'CERRADO TEMPORALMENTE',
                                                                                                            IF(ec.estado_siniestro = 'ASIGNADO',
                                                                                                                'ABIERTO',
                                                                                                                'ERROR 1_DB'))))))))))))))))))))))))),
            IF(s.llavePrecalificacion IS NOT NULL,
                IF(sbpcl.sub_estados = 'ASIGNAR A MEDICO',
                    'ABIERTO',
                    IF(sbpcl.sub_estados = 'ASIGNAR A JEFE',
                        'ABIERTO',
                        IF(sbpcl.sub_estados = 'PENDIENTE ANEXOS',
                            'CERRADO TEMPORALMENTE',
                            IF(sbpcl.sub_estados = 'EN CONTROVERSIA CAL 1RA OPORTUNIDAD',
                                'CERRADO TEMPORALMENTE',
                                IF(sbpcl.sub_estados = 'PENDIENTE ACTA EJECUTORIA',
                                    'CERRADO TEMPORALMENTE',
                                    IF(sbpcl.sub_estados = 'EN CONTROVERSIA CAL 1ER INSTANCIA',
                                        'CERRADO TEMPORALMENTE',
                                        IF(sbpcl.sub_estados = 'SIN ALTA DE ESPECIALISTA',
                                            'CERRADO TEMPORALMENTE',
                                            IF(sbpcl.sub_estados = 'PCL SIN NOTIFICAR',
                                                'CERRADO TEMPORALMENTE',
                                                IF(sbpcl.sub_estados = 'ORIGEN SIN NOTIFICAR',
                                                    'CERRADO TEMPORALMENTE',
                                                    IF(sbpcl.sub_estados = 'ORIGEN COMUN',
                                                        'CERRADO',
                                                        IF(sbpcl.sub_estados = 'SIN DOCUMENTOS SUFICIENTES',
                                                            'CERRADO TEMPORALMENTE',
                                                            IF(sbpcl.sub_estados = 'SIN COBERTURA DESDE EL ORIGEN',
                                                                'CERRADO',
                                                                IF(sbpcl.sub_estados = 'EVENTO MORTAL',
                                                                    'CERRADO',
                                                                    IF(sbpcl.sub_estados = 'SIN CIERRE DE RHB',
                                                                        'CERRADO TEMPORALMENTE',
                                                                        IF(sbpcl.sub_estados = 'CALIFICACION A CARGO DE OTRO PROVEEDOR',
                                                                            'CERRADO',
                                                                            IF(sbpcl.sub_estados = 'LEVANTAR MASIVO',
                                                                                'ABIERTO',
                                                                                IF(sbpcl.sub_estados = 'PROMOVER PCL',
                                                                                    'ABIERTO',
                                                                                    IF(sbpcl.sub_estados = 'APERTURA DE RECALIFICACION',
                                                                                        'ABIERTO',
                                                                                        IF(sbpcl.sub_estados = 'SOLICITUD DE EXPEDIENTE',
                                                                                            'ABIERTO',
                                                                                            IF(sbpcl.sub_estados = 'PENDIENTE ARANDA',
                                                                                                'ABIERTO',
                                                                                                IF(sbpcl.sub_estados = 'CAMBIO DE DECRETO',
                                                                                                    'ABIERTO',
                                                                                                    IF(sbpcl.sub_estados = 'LEVANTAR VISADO',
                                                                                                        'ABIERTO',
                                                                                                        IF(sbpcl.sub_estados = 'CERTIFICACION AFILIACION ULTIMA ARL',
                                                                                                            'CERRADO TEMPORALMENTE',
                                                                                                            IF(sbpcl.sub_estados = 'PENDIENTE GARANTÃA PROVEEDOR',
                                                                                                                'CERRADO TEMPORALMENTE',
                                                                                                                IF(epc.estado_siniestro = 'ASIGNADO',
                                                                                                                    'ABIERTO',
                                                                                                                    'ERROR 1_DB'))))))))))))))))))))))))),
                'ERROR 2_DB'))) AS estadoGeneral
FROM
    tbl_siniestro_pcls AS s
        LEFT JOIN
    tbl_afiliados AS a ON a.idAfiliado = s.llaveAfiliado
        LEFT JOIN
    tbl_tipo_docuemtno AS d ON d.id_tipo_docuemtno = a.llaveTipoDocumento
        LEFT JOIN
    tbl_departamento AS dp ON dp.id_departamento = a.llaveDepartamento
        LEFT JOIN
    tbl_ciudad AS c ON c.id_ciudad = a.llaveCiudad
        LEFT JOIN
    tbl_entrada AS e ON e.id_entrada = s.llaveCanalEntrada
        LEFT JOIN
    tbl_quien_solicita AS q ON q.id_quien_solicita = s.llaveQuienSolicita
        LEFT JOIN
    tbl_solicitud AS so ON so.id_solicitud = s.llaveTipoSolicitud
        LEFT JOIN
    tbl_tipo_evento AS te ON te.id_tipo_evento = s.llaveTipoEvento
        LEFT JOIN
    tbl_empresas AS em ON em.id_empresa = s.llaveEmpresaPcl
        LEFT JOIN
    tbl_tipo_documento_empreza AS tdm ON tdm.id_tipo_documento_empreza = em.llave_tipo_docuemtno
        LEFT JOIN
    tbl_departamento AS dpem ON dpem.id_departamento = em.llave_departamento
        LEFT JOIN
    tbl_califiaciones AS ca ON ca.idCalifiacion = s.llaveCalificacion
        LEFT JOIN
    tbl_estado_siniestro AS ec ON ec.id_estado_siniestro = ca.llaveEstadoCalificacion
        LEFT JOIN
    tbl_sub_estados AS sbc ON sbc.id_sub_estados = ca.llaveSubEstadoCalificacion
        LEFT JOIN
    users AS ucl ON ucl.id = ca.llaveCalificadorCalifiacion
        LEFT JOIN
    tbl_recalificacion_pcls AS rc ON rc.idRecalificacionPcls = s.llaveRecalificacion
        LEFT JOIN
    tbl_estado_siniestro AS ercl ON ercl.id_estado_siniestro = rc.llaveEstadoRecalificacion
        LEFT JOIN
    tbl_sub_estados AS sbrcl ON sbrcl.id_sub_estados = rc.llaveSubEstadoRecalificacion
        LEFT JOIN
    users AS urc ON urc.id = rc.llaveCalificadorRecalificacion
        LEFT JOIN
    tbl_precalificaciones AS prcli ON prcli.idPrecalificacion = s.llavePrecalificacion
        LEFT JOIN
    tbl_estado_siniestro AS epc ON epc.id_estado_siniestro = prcli.llaveEstadoPrecalificacion
        LEFT JOIN
    tbl_sub_estados AS sbpcl ON sbpcl.id_sub_estados = prcli.llaveSubEstadoPrecalificacion
        LEFT JOIN
    users AS upc ON upc.id = prcli.llaveCalificador
        LEFT JOIN
    tbl_cie_10_adicionados AS cipcl ON cipcl.llaveSiniestroPclDiagnostico = s.idSiniestroPcl
        LEFT JOIN
    tbl_cie_10 AS cie ON cie.id_cie_10 = cipcl.llave_cie10_union


where 
$TxtFecha
      $TxtCanalEntrada 
      $TxtQuienSolicita
      $TxtTipoSolicitud 
      $TxtCalificacion 
      $TxtReCalificacion 
      $TxtSubCalificacion 
      $Txtestado 
      $TxtSubEstado
      $TxtCaliName
      $TxtReCaliName


GROUP BY idSiniestroPcl        
union

SELECT 
    idAdicionPcl AS id,
    entrada,
    quien_solicita,
    solicitud,
    tipo_evento,
    fechaEvento,
    fechaCreacioonAdicin,
    fechaAsigClienteAdiconPcl,
    tipo_documento,
    documento,
    nombre,
    idSiniestro,
    dp.departamento AS depar,
    razon_social_empleador,
    nit,
    fechaSolicitudAnexosCali,
    anexoCalificacion,
    fechaSeguimientoAnexosCal,
    fechaRecepcionAnexosCal,
    ec.estado_siniestro AS estadoCalificacion,
    sbc.sub_estados AS subEstadoCalificacion,
    ucl.name AS usuarioCalificacion,
    procentajePcl,
    fechaEnvioComite,
    fechaDevolucionComite,
    fechaVisado,
    ca.updated_at AS gestionCalificacion,
    ercl.estado_siniestro AS estadoRecalificacion,
    urc.name AS usuarioRecalificacion,
    porcentajePclRecalificacion,
    fechaEnvioComiteRecalificacion,
    fechaDevolcionComiteRecalificacion,
    fechaVisadoRecalificacion,
    rc.updated_at AS getionRecalificacion,
    GROUP_CONCAT(DISTINCT cie.id_ident
        SEPARATOR ' | ') AS id_ident,
    GROUP_CONCAT(DISTINCT cie.cie_10
        SEPARATOR ' | ') AS cie10,
    GROUP_CONCAT(DISTINCT cipcl.descripcion
        SEPARATOR ' | ') AS descripcionCie10,
    requiereValoracionPresencial,
    IF(ad.llaveReCalificacionAdicion IS NULL,
        IF(ad.llaveCalificacionAdcion IS NULL,
            IF(llaveSubEstadoAdicion IS NOT NULL,
                ad.updated_at,
                ''),
            ca.updated_at),
        rc.updated_at) AS fechaGestionAutomatica,
    IF(ad.llaveReCalificacionAdicion IS NOT NULL,
        IF(sbrcl.sub_estados = 'ASIGNADO COMITE CODESS',
            'ABIERTO',
            IF(sbrcl.sub_estados = 'ASIGNADO COMITE POSITIVA ',
                'ABIERTO',
                IF(sbrcl.sub_estados = 'DEVOLUCION COMITE',
                    'ABIERTO',
                    IF(sbrcl.sub_estados = 'AVALADO',
                        'CERRADO',
                        IF(sbrcl.sub_estados = 'ASIGNADO A COMITE CODESS NEGACION REC',
                            'ABIERTO',
                            IF(sbrcl.sub_estados = 'PENDIENTE ANEXOS',
                                'CERRADO TEMPORALMENTE',
                                IF(sbrcl.sub_estados = 'EN CONTROVERSIA CAL 1RA OPORTUNIDAD',
                                    'ABIERTO',
                                    IF(sbrcl.sub_estados = 'PENDIENTE ACTA EJECUTORIA',
                                        'CERRADO TEMPORALMENTE',
                                        IF(sbrcl.sub_estados = 'PCL SIN NOTIFICAR',
                                            'CERRADO TEMPORALMENTE',
                                            IF(sbrcl.sub_estados = 'SIN DOCUMENTOS SUFICIENTES',
                                                'CERRADO TEMPORALMENTE',
                                                IF(sbrcl.sub_estados = 'EVENTO MORTAL',
                                                    'CERRADO',
                                                    IF(sbrcl.sub_estados = 'CALIFICACION A CARGO DE OTRO PROVEEDOR',
                                                        'CERRADO',
                                                        IF(sbrcl.sub_estados = 'LEVANTAR MASIVO',
                                                            'ABIERTO',
                                                            IF(sbrcl.sub_estados = 'APERTURA DE RECALIFICACION',
                                                                'ABIERTO',
                                                                IF(sbrcl.sub_estados = 'SOLICITUD DE EXPEDIENTE',
                                                                    'ABIERTO',
                                                                    IF(sbrcl.sub_estados = 'PENDIENTE ARANDA',
                                                                        'ABIERTO',
                                                                        IF(sbrcl.sub_estados = 'CAMBIO DE DECRETO',
                                                                            'ABIERTO',
                                                                            IF(sbrcl.sub_estados = 'CERTIFICACION AFILIACION ULTIMA ARL ',
                                                                                'CERRADO',
                                                                                IF(sbrcl.sub_estados = 'PENDIENTE FIRMAS',
                                                                                    'ABIERTO',
                                                                                    IF(sbrcl.sub_estados = 'CERRADO CON RADICADOS',
                                                                                        'ABIERTO',
                                                                                        IF(ercl.estado_siniestro = 'ASIGNADO',
                                                                                            'ABIERTO',
                                                                                            'ERROR 1_DB_R'))))))))))))))))))))),
        IF(ad.llaveCalificacionAdcion IS NOT NULL,
            IF(sbc.sub_estados = 'ASIGNADO COMITE CODESS',
                'ABIERTO',
                IF(sbc.sub_estados = 'ASIGNADO COMITE POSITIVA ',
                    'ABIERTO',
                    IF(sbc.sub_estados = 'DEVOLUCION COMITE',
                        'ABIERTO',
                        IF(sbc.sub_estados = 'AVALADO',
                            'CERRADO',
                            IF(sbc.sub_estados = 'PENDIENTE ANEXOS',
                                'CERRADO TEMPORALMENTE',
                                IF(sbc.sub_estados = 'EN CONTROVERSIA CAL 1RA OPORTUNIDAD',
                                    'CERRADO TEMPORALMENTE',
                                    IF(sbc.sub_estados = 'PENDIENTE ACTA EJECUTORIA',
                                        'CERRADO TEMPORALMENTE',
                                        IF(sbc.sub_estados = 'SIN ALTA DE ESPECIALISTA',
                                            'CERRADO TEMPORALMENTE',
                                            IF(sbc.sub_estados = 'PCL SIN NOTIFICAR',
                                                'CERRADO TEMPORALMENTE',
                                                IF(sbc.sub_estados = 'ORIGEN SIN NOTIFICAR',
                                                    'CERRADO TEMPORALMENTE',
                                                    IF(sbc.sub_estados = 'ORIGEN COMUN',
                                                        'CERRADO',
                                                        IF(sbc.sub_estados = 'SIN DOCUMENTOS SUFICIENTES',
                                                            'CERRADO TEMPORALMENTE',
                                                            IF(sbc.sub_estados = 'SIN COBERTURA DESDE EL ORIGEN',
                                                                'CERRADO',
                                                                IF(sbc.sub_estados = 'EVENTO MORTAL',
                                                                    'CERRADO',
                                                                    IF(sbc.sub_estados = 'SIN CIERRE DE RHB',
                                                                        'CERRADO TEMPORALMENTE',
                                                                        IF(sbc.sub_estados = 'CALIFICACION A CARGO DE OTRO PROVEEDOR',
                                                                            'CERRADO',
                                                                            IF(sbc.sub_estados = 'LEVANTAR MASIVO',
                                                                                'ABIERTO',
                                                                                IF(sbc.sub_estados = 'PROMOVER PCL',
                                                                                    'ABIERTO',
                                                                                    IF(sbc.sub_estados = 'APERTURA DE RECALIFICACIEN',
                                                                                        'ABIERTO',
                                                                                        IF(sbc.sub_estados = 'SOLICITUD DE EXPEDIENTE',
                                                                                            'ABIERTO',
                                                                                            IF(sbc.sub_estados = 'PENDIENTE ARANDA',
                                                                                                'ABIERTO',
                                                                                                IF(sbc.sub_estados = 'CAMBIO DE DECRETO',
                                                                                                    'ABIERTO',
                                                                                                    IF(sbc.sub_estados = 'CERTIFICACION AFILIACION ULTIMA ARL',
                                                                                                        'CERRADO TEMPORALMENTE',
                                                                                                        IF(sbc.sub_estados = 'PENDIENTE GARANTIA PROVEEDOR',
                                                                                                            'CERRADO TEMPORALMENTE',
                                                                                                            IF(ec.estado_siniestro = 'ASIGNADO',
                                                                                                                'ABIERTO',
                                                                                                                'ERROR 1_DB_C'))))))))))))))))))))))))),
            IF(llaveSubEstadoAdicion IS NOT NULL,
                IF(sbstadc.sub_estados = 'ADICION EFECTIVA',
                    'CERRADO',
                    IF(sbstadc.sub_estados = 'ADICION NO EFECTIVA (caso en juntas)',
                        'CERRADO TEMPORALMENTE',
                        IF(sbstadc.sub_estados = 'ADICION NO EFECTIVA (sin cobertura) ',
                            'CERRADO TEMPORALMENTE',
                            IF(sbstadc.sub_estados = 'ADICION NO EFECTIVA (no derivado del evento) ',
                                'CERRADO TEMPORALMENTE',
                                IF(edc.estado_siniestro = 'ASIGNADO',
                                    'ABIERTO',
                                    'ERROR 1_DB_A'))))),
                'ABIERTO'))) AS estadoGeneral
FROM
    tbl_adicionpcls AS ad
        LEFT JOIN
    tbl_siniestro_pcls AS s ON ad.llaveSiniestroAdicionPcl = s.idSiniestroPcl
        LEFT JOIN
    tbl_afiliados AS a ON a.idAfiliado = s.llaveAfiliado
        LEFT JOIN
    tbl_tipo_docuemtno AS d ON d.id_tipo_docuemtno = a.llaveTipoDocumento
        LEFT JOIN
    tbl_departamento AS dp ON dp.id_departamento = a.llaveDepartamento
        LEFT JOIN
    tbl_ciudad AS c ON c.id_ciudad = a.llaveCiudad
        LEFT JOIN
    tbl_quien_solicita AS q ON q.id_quien_solicita = ad.LlaveQuienSoliAdiPcl
        LEFT JOIN
    tbl_solicitud AS so ON so.id_solicitud = ad.LlavetipoSoliAdiPcl
        LEFT JOIN
    tbl_entrada AS e ON e.id_entrada = ad.llaveCanalEntradaAdiPcl
        LEFT JOIN
    tbl_tipo_evento AS te ON te.id_tipo_evento = s.llaveTipoEvento
        LEFT JOIN
    tbl_empresas AS em ON em.id_empresa = s.llaveEmpresaPcl
        LEFT JOIN
    tbl_tipo_documento_empreza AS tdm ON tdm.id_tipo_documento_empreza = em.llave_tipo_docuemtno
        LEFT JOIN
    tbl_departamento AS dpem ON dpem.id_departamento = em.llave_departamento
        LEFT JOIN
    tbl_estado_siniestro AS edc ON edc.id_estado_siniestro = ad.llaveEstadoAdicion
        LEFT JOIN
    tbl_sub_estados AS sbstadc ON sbstadc.id_sub_estados = ad.llaveSubEstadoAdicion
        LEFT JOIN
    tbl_califiaciones AS ca ON ca.idCalifiacion = ad.llaveCalificacionAdcion
        LEFT JOIN
    tbl_estado_siniestro AS ec ON ec.id_estado_siniestro = ca.llaveEstadoCalificacion
        LEFT JOIN
    tbl_sub_estados AS sbc ON sbc.id_sub_estados = ca.llaveSubEstadoCalificacion
        LEFT JOIN
    users AS ucl ON ucl.id = ca.llaveCalificadorCalifiacion
        LEFT JOIN
    tbl_recalificacion_pcls AS rc ON rc.idRecalificacionPcls = ad.llaveReCalificacionAdicion
        LEFT JOIN
    tbl_estado_siniestro AS ercl ON ercl.id_estado_siniestro = rc.llaveEstadoRecalificacion
        LEFT JOIN
    tbl_sub_estados AS sbrcl ON sbrcl.id_sub_estados = rc.llaveSubEstadoRecalificacion
        LEFT JOIN
    users AS urc ON urc.id = rc.llaveCalificadorRecalificacion
        LEFT JOIN
    tbl_cie_10_adicionados AS cipcl ON cipcl.llaveAdicionPcl = ad.idAdicionPcl
        LEFT JOIN
    tbl_cie_10 AS cie ON cie.id_cie_10 = cipcl.llave_cie10_union
    
        where 
$TxtFechaAdicio
      $TxtCanalEntrada 
      $TxtQuienSolicita
      $TxtTipoSolicitud        
      $TxtCalificacion 
      $TxtReCalificacion 
      $TxtSubCalificacion 
      $TxtSubReCalificacio
      $Txtestado 
      $TxtSubEstado
      $TxtCaliName
      $TxtReCaliName
  
GROUP BY idAdicionPcl 
   
";
        $result = $this->ds->select($query);

        return $result;
    }

    public function exportsiniestros($siniestros) {

        function cleanData(&$str) {
            $str = preg_replace("/\t/", "", $str);
            $str = preg_replace("/\r?\n/", "", $str);
            if (strstr($str, '"'))
                $str = '"' . str_replace('"', '""', $str) . '"';
        }

        $timestamp = date("d-m-Y");
        $filename = 'base ' . $timestamp . '.xls';

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: no-cache");
        header("Expires: 0");
        $colnames = [
            'id' => "Id",
            'entrada' => "CANAL DE ENTRADA",
            'quien_solicita' => "QUIEN SOLICITA",
            'solicitud' => "TIPO DE SOLICITUD",
            'tipo_evento' => "TIPO EVENTO",
            'fechaEvento' => "FECHA DEL EVENTO",
            'fechaCreacionCaso' => "FECHA CREACION CASO",
            'fechaAsignacionDelCliente' => "FECHA ASIGNACION DEL CLIENTE",
            'tipo_documento' => "TIPO DOCUMENTO",
            'documento' => "DOCUMENTO",
            'nombre' => "AFILIADO",
            'idSiniestro' => "ID SINIESTRO",
            'depar' => "DEPARTAMENTO",
            'razon_social_empleador' => "RAZON SOCIAL",
            'nit' => "NIT EMPLEADOR",
            'fechaSolicitudAnexosCali' => "FECHA DE SOLICITUD ANEXOS",
            'anexoCalificacion' => "ANEXOS",
            'fechaSeguimientoAnexosCal' => "FECHA SEGUIMIENTO ANEXOS",
            'fechaRecepcionAnexosCal' => "FECHA RECEPCION ANEXOS",
            'estadoCalificacion' => "ESTADO CALIFICACION",
            'subEstadoCalificacion' => "SUBESTADO CALIFICACION",
            'usuarioCalificacion' => "ASIGANDO A",
            'procentajePcl' => "PORCENTAJE PCL",
            'fechaEnvioComite' => "FECHA DE ENVIO COMITE",
            'fechaDevolucionComite' => "FECHA DEVOLUCION COMITE",
            'fechaVisado' => "FECHA VISADO",
            'gestionCalificacion' => "FECHA GESTION",
            'estadoRecalificacion' => "ESTADO RECALIFICACION",
            'usuarioRecalificacion' => "ASIGANDO A",
            'procentajePcl' => "PORCENTAJE PCL",
            'porcentajePclRecalificacion' => "PORCENTAJE PCL RECALIFICACION ",
            'fechaEnvioComiteRecalificacion' => "FECHA DE ENVIO COMITE",
            'fechaDevolcionComiteRecalificacion' => "FECHA DEVOLUCIÓN COMITE",
            'fechaVisadoRecalificacion' => "FECHA VISADO",
            'getionRecalificacion' => "FECHA GESTION",
            'id_ident' => "CIE10",
            'cie10' => "DIAGNOSTICOS",
            'descripcionCie10' => "DESCRIPCION",
            'requiereValoracionPresencial' => "REQUIERE VALORACION PRESENCIAL",
            'fechaGestionAutomatica' => "FECHA GESTION AUTOMATICA",
            'estadoGeneral' => "ESTADO GENERAL ACTUAL DEL CASO"
        ];
        $isPrintHeader = false;
        foreach ($siniestros as $row) {
            if (!$isPrintHeader) {
                echo implode("\t", ($colnames)) . "\r";
                $isPrintHeader = true;
            }
            array_walk($row, __NAMESPACE__ . '\cleanData');
            echo implode("\t", array_values($row)) . "\r\n";
        }


        exit();
    }

}

?>
