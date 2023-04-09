<?php

namespace Phppot;

$consul_infor = new InformeGeneralCalificacion();
$siniestros = $consul_infor->getAllSiniestroCalificacion();
$consul_infor->exportSiniestrosCalificacion($siniestros);

class InformeGeneralCalificacion {

    private $ds;

    function __construct() {
        require_once '../DataSource.php';
        $this->ds = new DataSource();
    }

    public function getAllSiniestroCalificacion() {
        $query = "SELECT 
    idAdicionPcl as idSiniestroPclg,
    entrada,
    TIMESTAMPDIFF(DAY,
        fechaCreacioonAdicin,
        ca.updated_at) AS transcurridos,
    solicitud,
    DATE_FORMAT(fechaCreacioonAdicin, '%d %M %Y') AS fechaAsignacion,
    upcc.name AS quienCrea,
    fechaAsigClienteAdiconPcl,
    DATE_FORMAT(fechaCreacioonAdicin, '%H:%I:%S') AS hora,
    llaveListaPrecalificacion,
    tipo_documento,
    documento,
    idSiniestro,
    ad.updated_at AS fechaUltimaSiniestro,
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
                                                IF(sbc.sub_estados = 'ORIGEN COMÚN',
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
                                                                                                IF(sbc.sub_estados = 'CERTIFICACION AFILIACION ÚLTIMA ARL',
                                                                                                    'CERRADO TEMPORALMENTE',
                                                                                                    IF(sbc.sub_estados = 'PENDIENTE GARANTÍA PROVEEDOR',
                                                                                                        'CERRADO TEMPORALMENTE',
                                                                                                        IF(ec.estado_siniestro = 'ASIGNADO',
                                                                                                            'ABIERTO',
                                                                                                            'ERROR 1_DB'))))))))))))))))))))))))),
        'ERROR 2_DB') AS estadoGeneral,
    ucl.name AS usuarioPreCalificacion,
    fechaAsignacionProfesionalCali,
    ec.estado_siniestro AS estadoPreCalificacion,
    sbc.sub_estados AS subEstadoPreCalificacion,
    ca.updated_at AS getionPreCalificacion,
    fechaDevolucionComite,
    fechaVisado
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
    tbl_califiaciones AS ca ON ca.idCalifiacion = ad.llaveCalificacionAdcion
        LEFT JOIN
    tbl_estado_siniestro AS ec ON ec.id_estado_siniestro = ca.llaveEstadoCalificacion
        LEFT JOIN
    tbl_sub_estados AS sbc ON sbc.id_sub_estados = ca.llaveSubEstadoCalificacion
        LEFT JOIN
    users AS ucl ON ucl.id = ca.llaveCalificadorCalifiacion
        LEFT JOIN
    tbl_cie_10_adicionados AS cipcl ON cipcl.llaveAdicionPcl = ad.idAdicionPcl
        LEFT JOIN
    tbl_cie_10 AS cie ON cie.id_cie_10 = cipcl.llave_cie10_union
        LEFT JOIN
    users AS upcc ON upcc.id = ad.llaveUsuarioCreadorAdicion
GROUP BY idAdicionPcl 
UNION SELECT 
    idSiniestroPcl as idSiniestroPclg,
    entrada,
    TIMESTAMPDIFF(DAY,
        fechaCreacionCaso,
        ca.updated_at) AS transcurridos,
    solicitud,
    DATE_FORMAT(fechaCreacionCaso, '%d %M %Y') AS fechaAsignacion,
    upcc.name AS quienCrea,
    fechaAsignacionDelCliente,
    DATE_FORMAT(fechaCreacionCaso, '%H:%I:%S') AS hora,
    llaveListaPrecalificacion,
    tipo_documento,
    documento,
    idSiniestro,
    s.updated_at AS fechaUltimaSiniestro,
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
                                                IF(sbc.sub_estados = 'ORIGEN COMÚN',
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
                                                                                                IF(sbc.sub_estados = 'CERTIFICACION AFILIACION ÚLTIMA ARL',
                                                                                                    'CERRADO TEMPORALMENTE',
                                                                                                    IF(sbc.sub_estados = 'PENDIENTE GARANTÍA PROVEEDOR',
                                                                                                        'CERRADO TEMPORALMENTE',
                                                                                                        IF(ec.estado_siniestro = 'ASIGNADO',
                                                                                                            'ABIERTO',
                                                                                                            'ERROR 1_DB'))))))))))))))))))))))))),
        'ERROR 2_DB') AS estadoGeneral,
    ucl.name AS usuarioPreCalificacion,
    fechaAsignacionProfesionalCali,
    ec.estado_siniestro AS estadoPreCalificacion,
    sbc.sub_estados AS subEstadoPreCalificacion,
    ca.updated_at AS getionPreCalificacion,
    fechaDevolucionComite,
    fechaVisado
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
    tbl_califiaciones AS ca ON ca.idCalifiacion = s.llaveCalificacion
        LEFT JOIN
    tbl_estado_siniestro AS ec ON ec.id_estado_siniestro = ca.llaveEstadoCalificacion
        LEFT JOIN
    tbl_sub_estados AS sbc ON sbc.id_sub_estados = ca.llaveSubEstadoCalificacion
        LEFT JOIN
    users AS ucl ON ucl.id = ca.llaveCalificadorCalifiacion
        LEFT JOIN
    tbl_solicitud_anexos AS anexC ON anexC.llaveCalificacion = ca.idCalifiacion
        LEFT JOIN
    tbl_cie_10_adicionados AS cipcl ON cipcl.llaveSiniestroPclDiagnostico = s.idSiniestroPcl
        LEFT JOIN
    tbl_cie_10 AS cie ON cie.id_cie_10 = cipcl.llave_cie10_union
        LEFT JOIN
    users AS upcc ON upcc.id = s.llaveUsuarioQuienCrea
GROUP BY idSiniestroPcl

    
";

        $result = $this->ds->select($query);

        return $result;
    }

    public function exportSiniestrosCalificacion($siniestros) {

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
