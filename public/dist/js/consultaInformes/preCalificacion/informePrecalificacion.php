<?php

namespace Phppot;

session_start();

class InformePreCalificacion {

    private $ds;

    function __construct() {
        require_once 'DataSource.php';
        $this->ds = new DataSource();
    }

    public function getPrecalificacion() {

        //error_reporting(0);


        $TxtCanalEntrada = "";
        $TxtQuienSolicita = "";
        $TxtTipoSolicitud = "";
        $TxtPreCalificacion = "";
        $TxtSubPreCalificacion = "";
        $TxtPreCaliName = "";
        $TxtFecha = "";



        $canalEntrada = $_SESSION['canalEntradaPre'];
        $quienSolicita = $_SESSION['quienSolicitaPre'];
        $tipoSolicitud = $_SESSION['tipoSolicitudPre'];
        $estado = $_SESSION['estadoPre'];
        $subEstado = $_SESSION['subEstadoPre'];
        $asigando = $_SESSION['asigandoPre'];
        $fechaDesde = $_SESSION['fechaDesdePre'];
        $fechaHasta = $_SESSION['fechaHastaPre'];



        if ($fechaDesde != null and $fechaHasta != null) {
            $TxtFecha = " DATE(fechaCreacionCaso) BETWEEN '$fechaDesde' AND '$fechaHasta'";
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
            $TxtPreCalificacion = " AND  epc.estado_siniestro = '$estado'";
        }

        if ($subEstado != null) {
            $TxtSubPreCalificacion = " AND  sbpcl.sub_estados = '$subEstado'";
        }
        if ($asigando != null) {
            $TxtPreCaliName = " AND upc.name = '$asigando'";
        }



        $query = "SELECT 
    idSiniestroPcl,
    entrada,
    TIMESTAMPDIFF(DAY,
        fechaCreacionCaso,
        prcli.updated_at) AS transcurridos,
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
                                            IF(sbpcl.sub_estados = 'ORIGEN COMÚN',
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
                                                                                                IF(sbpcl.sub_estados = 'CERTIFICACION AFILIACION ÚLTIMA ARL',
                                                                                                    'CERRADO TEMPORALMENTE',
                                                                                                    IF(sbpcl.sub_estados = 'PENDIENTE GARANTÍA PROVEEDOR',
                                                                                                        'CERRADO TEMPORALMENTE',
                                                                                                        IF(epc.estado_siniestro = 'ASIGNADO',
                                                                                                            'ABIERTO',
                                                                                                            'ERROR 1_DB'))))))))))))))))))))))))),
        'ERROR 2_DB') AS estadoGeneral,
    upc.name AS usuarioPreCalificacion,
    fechaAsignacionProfesionalPreCali,
    epc.estado_siniestro AS estadoPreCalificacion,
    sbpcl.sub_estados AS subEstadoPreCalificacion,
    prcli.updated_at AS getionPreCalificacion
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
    tbl_precalificaciones AS prcli ON prcli.idPrecalificacion = s.llavePrecalificacion
        LEFT JOIN
    tbl_estado_siniestro AS epc ON epc.id_estado_siniestro = prcli.llaveEstadoPrecalificacion
        LEFT JOIN
    tbl_sub_estados AS sbpcl ON sbpcl.id_sub_estados = prcli.llaveSubEstadoPrecalificacion
        LEFT JOIN
    users AS upc ON upc.id = prcli.llaveCalificador
        LEFT JOIN
    tbl_solicitud_anexos AS anexPcl ON anexPcl.llavePrecalificacionunion = prcli.idPrecalificacion
        LEFT JOIN
    tbl_cie_10_adicionados AS cipcl ON cipcl.llaveSiniestroPclDiagnostico = s.idSiniestroPcl
        LEFT JOIN
    tbl_cie_10 AS cie ON cie.id_cie_10 = cipcl.llave_cie10_union
        LEFT JOIN
    users AS upcc ON upcc.id = s.llaveUsuarioQuienCrea



WHERE

$TxtFecha


      $TxtCanalEntrada 
      $TxtQuienSolicita
      $TxtTipoSolicitud 
      $TxtPreCalificacion 
      $TxtSubPreCalificaci
      $TxtPreCaliName 
      


GROUP BY idSiniestroPcl    
";
        $result = $this->ds->select($query);

        return $result;
    }

    public function exportsiniestrosPrecalificacion($siniestros) {

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
             'idSiniestroPcl' => "Id",
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
            'fechaAsignacionProfesionalPreCali' => "FECHA DE ASIGNACION AL PROFESIONAL",
            'estadoPreCalificacion' => "ESTADO",
            'subEstadoPreCalificacion' => "SUBESTADO",
            'getionPreCalificacion' => "FECHA DE GESTION",
       
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
