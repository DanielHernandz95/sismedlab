<?php

namespace Phppot;

$consul_infor = new InformeGeneralReCalificacion();
$siniestros = $consul_infor->getAllSiniestroReCalificacion();
$consul_infor->exportSiniestrosReCalificacion($siniestros);

class InformeGeneralReCalificacion {

    private $ds;

    function __construct() {
        require_once '../DataSource.php';
        $this->ds = new DataSource();
    }

    public function getAllSiniestroReCalificacion() {
        $query = "SELECT 
    idSiniestroPcl asidSiniestroPclg,
    entrada,
    TIMESTAMPDIFF(DAY,
        fechaCreacionCaso,
        rc.updated_at) AS transcurridos,
    solicitud,
    upcc.name AS quienCrea,
    DATE_FORMAT(fechaCreacionCaso, '%d %M %Y') AS fechaAsignacion,
    fechaAsignacionDelCliente,
    DATE_FORMAT(fechaCreacionCaso, '%H:%I:%S') AS hora,
    llaveListaPrecalificacion,
    tipo_documento,
    documento,
    idSiniestro,
    s.updated_at AS fechaUltimaSiniestro,
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
        'ERROR 2_DB') AS estadoGeneral,
    urc.name AS usuarioPreCalificacion,
    fechaAsigProfesionalRecali,
    ercl.estado_siniestro AS estadoPreCalificacion,
    sbrcl.sub_estados AS subEstadoPreCalificacion,
    rc.updated_at AS getionPreCalificacion,
    fechaDevolcionComiteRecalificacion,
    fechaVisadoRecalificacion,
    numeroRadicacoSalida
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
        INNER JOIN
    tbl_recalificacion_pcls AS rc ON rc.idRecalificacionPcls = s.llaveRecalificacion
        LEFT JOIN
    tbl_estado_siniestro AS ercl ON ercl.id_estado_siniestro = rc.llaveEstadoRecalificacion
        LEFT JOIN
    tbl_sub_estados AS sbrcl ON sbrcl.id_sub_estados = rc.llaveSubEstadoRecalificacion
        LEFT JOIN
    users AS urc ON urc.id = rc.llaveCalificadorRecalificacion
        LEFT JOIN
    users AS upcc ON upcc.id = s.llaveUsuarioQuienCrea
GROUP BY idSiniestroPcl 
UNION SELECT 
    idAdicionPcl as idSiniestroPclg,
    entrada,
    TIMESTAMPDIFF(DAY,
        fechaCreacioonAdicin,
        rc.updated_at) AS transcurridos,
    solicitud,
    upcc.name AS quienCrea,
    DATE_FORMAT(fechaCreacioonAdicin, '%d %M %Y') AS fechaAsignacion,
    fechaAsignacionDelCliente,
    DATE_FORMAT(fechaCreacioonAdicin, '%H:%I:%S') AS hora,
    llaveListaPrecalificacion,
    tipo_documento,
    documento,
    idSiniestro,
    ad.updated_at AS fechaUltimaSiniestro,
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
                                                                                            'ERROR 1_DB'))))))))))))))))))))),
        'ERROR 2_DB') AS estadoGeneral,
    urc.name AS usuarioPreCalificacion,
    fechaAsigProfesionalRecali,
    ercl.estado_siniestro AS estadoPreCalificacion,
    sbrcl.sub_estados AS subEstadoPreCalificacion,
    rc.updated_at AS getionPreCalificacion,
    fechaDevolcionComiteRecalificacion,
    fechaVisadoRecalificacion,
    numeroRadicacoSalida
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
        INNER JOIN
    tbl_recalificacion_pcls AS rc ON rc.idRecalificacionPcls = ad.llaveReCalificacionAdicion
        LEFT JOIN
    tbl_estado_siniestro AS ercl ON ercl.id_estado_siniestro = rc.llaveEstadoRecalificacion
        LEFT JOIN
    tbl_sub_estados AS sbrcl ON sbrcl.id_sub_estados = rc.llaveSubEstadoRecalificacion
        LEFT JOIN
    users AS urc ON urc.id = rc.llaveCalificadorRecalificacion
        LEFT JOIN
    users AS upcc ON upcc.id = s.llaveUsuarioQuienCrea
GROUP BY idAdicionPcl";

        $result = $this->ds->select($query);

        return $result;
    }

    public function exportSiniestrosReCalificacion($siniestros) {

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
            'idSiniestroPclg' => "Id",
            'entrada' => "CANAL DE ENTRADA",
            'transcurridos' => "DIAS TRANSCURRIDOS DESDE LA FECHA DE ASIGNACION DEL CLIENTE",
            'solicitud' => "TIPO DE SOLICITUD",
            'quienCrea' => "USUARIO QUE CREA EL SINIESTRO",
            'fechaAsignacion' => "FECHA CREACION CASO",
            'fechaAsignacionDelCliente' => "FECHA ASIGNACION DEL CLIENTE",
            'hora' => "HORA CREACION CASO",
            'llaveListaPrecalificacion' => "PRECALIFICACION",
            'tipo_documento' => "TIPO DOCUMENTO",
            'documento' => "DOCUMENTO",
            'idSiniestro' => "ID SINIESTRO",
            'fechaUltimaSiniestro' => "FECHA GESTION ",
            'estadoGeneral' => "ESTADO GENERAL ACTUAL DEL CASO",
            'usuarioPreCalificacion' => "ASIGNADO",
            'fechaAsignacionProfesionalCali' => "FECHA DE ASIGNACION AL PROFESIONAL",
            'estadoPreCalificacion' => "ESTADO",
            'subEstadoPreCalificacion' => "SUBESTADO",
            'getionPreCalificacion' => "FECHA DE GESTION",
            'fechaDevolucionComite' => "FECHA DEVOLUCION COMITE",
            'fechaVisado' => "FECHA VISADO",
            'numeroRadicacoSalida' => "NUMERO DE RADICADO DE SALIDA",
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
