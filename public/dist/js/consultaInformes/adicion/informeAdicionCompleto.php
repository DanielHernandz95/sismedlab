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
    idSiniestroPcl,
    entrada,
    TIMESTAMPDIFF(DAY,
        fechaCreacioonAdicin,
        ad.updated_at) AS transcurridos,
    solicitud,
    DATE_FORMAT(fechaCreacioonAdicin, '%d %M %Y') AS fechaAsignacion,
    upcc.name AS quienCrea,
    fechaAsigClienteAdiconPcl,
    DATE_FORMAT(fechaCreacioonAdicin, '%H:%I:%S') AS hora,
    llaveListaPrecalificacion,
    tipo_documento,
    documento,
    idSiniestro,
    s.updated_at AS fechaUltimaSiniestro,
    IF(s.llavePrecalificacion IS NOT NULL,
        IF(sbpcl.sub_estados = 'ADICION EFECTIVA',
            'CERRADO',
            IF(sbpcl.sub_estados = 'ADICION NO EFECTIVA (caso en juntas)',
                'CERRADO TEMPORALMENTE',
                IF(sbpcl.sub_estados = 'ADICION NO EFECTIVA (sin cobertura) ',
                    'CERRADO TEMPORALMENTE',
                    IF(sbpcl.sub_estados = 'ADICION NO EFECTIVA (no derivado del evento) ',
                        'CERRADO TEMPORALMENTE',
                        IF(epc.estado_siniestro = 'ASIGNADO',
                            'ABIERTO',
                            'ERROR 1_DB'))))),
        'ERROR 2_DB') AS estadoGeneral,
    upc.name AS usuarioPreCalificacion,
    fechaCreacioonAdicin,
    epc.estado_siniestro AS estadoPreCalificacion,
    sbpcl.sub_estados AS subEstadoPreCalificacion,
    ad.updated_at AS getionPreCalificacion,
    GROUP_CONCAT(DISTINCT cie.id_ident
        SEPARATOR ' | ') AS id_ident,
    GROUP_CONCAT(DISTINCT cie.cie_10
        SEPARATOR ' | ') AS cie10,
    GROUP_CONCAT(DISTINCT cipcl.descripcion
        SEPARATOR ' | ') AS descripcionCie10,
    GROUP_CONCAT(DISTINCT ore.origen
        SEPARATOR ' | ') AS origenes
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
    tbl_empresas AS em ON em.id_empresa = s.llaveEmpresaPcl
        LEFT JOIN
    tbl_tipo_documento_empreza AS tdm ON tdm.id_tipo_documento_empreza = em.llave_tipo_docuemtno
        LEFT JOIN
    tbl_departamento AS dpem ON dpem.id_departamento = em.llave_departamento
        INNER JOIN
    tbl_adicionpcls AS ad ON ad.llaveSiniestroAdicionPcl = s.idSiniestroPcl
        LEFT JOIN
    tbl_quien_solicita AS q ON q.id_quien_solicita = ad.LlaveQuienSoliAdiPcl
        LEFT JOIN
    tbl_solicitud AS so ON so.id_solicitud = ad.LlavetipoSoliAdiPcl
        LEFT JOIN
    tbl_tipo_evento AS te ON te.id_tipo_evento = s.llaveTipoEvento
        LEFT JOIN
    tbl_entrada AS e ON e.id_entrada = ad.llaveCanalEntradaAdiPcl
        LEFT JOIN
    tbl_estado_siniestro AS epc ON epc.id_estado_siniestro = ad.llaveEstadoAdicion
        LEFT JOIN
    tbl_sub_estados AS sbpcl ON sbpcl.id_sub_estados = ad.llaveSubEstadoAdicion
        LEFT JOIN
    users AS upc ON upc.id = ad.llaveUsuarioAsigAdiPcl
        LEFT JOIN
    tbl_cie_10_adicionados AS cipcl ON cipcl.llaveAdicionPcl = ad.idAdicionPcl
        LEFT JOIN
    tbl_origen_diagnostico_adicional AS ore ON ore.id_origen_diagnostico_adicional = cipcl.llave_tipo_cie10
        LEFT JOIN
    tbl_cie_10 AS cie ON cie.id_cie_10 = cipcl.llave_cie10_union
        LEFT JOIN
    users AS upcc ON upcc.id = ad.llaveUsuarioCreadorAdicion
GROUP BY idAdicionPcl
    
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
            'idSiniestroPcl' => "Id",
            'entrada' => "CANAL DE ENTRADA",
            'transcurridos' => "DIAS TRANSCURRIDOS DESDE LA FECHA DE ASIGNACION DEL CLIENTE",
            'solicitud' => "TIPO DE SOLICITUD",
            'quienCrea' => "USUARIO QUE CREA EL SINIESTRO",
            'fechaAsignacion' => "FECHA CREACION CASO",
            'fechaAsigClienteAdiconPcl' => "FECHA ASIGNACION DEL CLIENTE",
            'hora' => "HORA CREACION CASO",
            'llaveListaPrecalificacion' => "PRECALIFICACION",
            'tipo_documento' => "TIPO DOCUMENTO",
            'documento' => "DOCUMENTO",
            'idSiniestro' => "ID SINIESTRO",
            'fechaUltimaSiniestro' => "FECHA GESTION ",
            'estadoGeneral' => "ESTADO GENERAL ACTUAL DEL CASO",
            'usuarioPreCalificacion' => "ASIGNADO",
            'fechaCreacioonAdicin' => "FECHA DE ASIGNACION AL PROFESIONAL",
            'estadoPreCalificacion' => "ESTADO",
            'subEstadoPreCalificacion' => "SUBESTADO",
            'id_ident' => "CIE 10",
            'cie10' => "DIAGNOSTICO",
            'origenes' => "ORIGEN DIAGNOSTICO ADICIONADO",
            'descripcion' => "DESCRIPCION DIAGNOSTICO",
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
