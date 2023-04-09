
<div class="card-body">
    <div id="volumenTipoSolicitud"></div>
</div>
<script>
<?php
$conexion1 = mysqli_connect("localhost", "Admin", "T3cnolog14", "db_spiatel", "3306");
$desde = $_GET['fechaDesdeAdi'];
$hasta = $_GET['fechaHastaAdi'];
$tipo = $_GET['tipoSolicitudse'];
?>
    Highcharts.chart('volumenTipoSolicitud', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Casos radicados por tipo de solicitud ( <?php echo $_GET['tipoSolicitudse'];?> ) POR MES'
        },

        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {y}'
                }
            }
        },
        series: [{
                name: 'Siniestros',
                colorByPoint: true,
                data: [

<?php
$sql = "SELECT DISTINCT
    (estado_siniestro)
FROM
    db_spiatel.tbl_estado_siniestro
WHERE
    llave_tipo_modulo = 3";
$result = mysqli_query($conexion1, $sql);

while ($resultado = mysqli_fetch_array($result)) {


    $estado = $resultado["estado_siniestro"];
    /* ============================Calificacion Siniestro================================== */

    $sqlCa = "SELECT 
    COUNT(*) AS cuantosCali, name, id
FROM
    tbl_siniestro_pcls AS s
       INNER JOIN
tbl_solicitud AS ts ON ts.id_solicitud = s.llaveTipoSolicitud
        LEFT JOIN
    tbl_afiliados AS a ON a.idAfiliado = s.llaveAfiliado
        LEFT JOIN
    tbl_califiaciones AS ca ON ca.idCalifiacion = s.llaveCalificacion
        LEFT JOIN
    tbl_estado_siniestro AS ec ON ec.id_estado_siniestro = ca.llaveEstadoCalificacion
        LEFT JOIN
    tbl_sub_estados AS sbc ON sbc.id_sub_estados = ca.llaveSubEstadoCalificacion
        LEFT JOIN
    users AS ucl ON ucl.id = ca.llaveCalificadorCalifiacion
WHERE
    ec.estado_siniestro = '$estado'   and date(fechaCreacionCaso) between  '$desde' and '$hasta' and solicitud = '$tipo'
GROUP BY id";
    $cuantosCali = 0;
    $resultCa = mysqli_query($conexion1, $sqlCa);
    while ($resultadoCa = mysqli_fetch_array($resultCa)) {
        $cuantosCali = $resultadoCa["cuantosCali"];
    }
    /* ============================Recalificacion Siniestro================================== */

    $sqlReca = "SELECT 
    COUNT(*) AS cuantosReCali, name, id
FROM
    tbl_siniestro_pcls AS s
       INNER JOIN
tbl_solicitud AS ts ON ts.id_solicitud = s.llaveTipoSolicitud
        LEFT JOIN
    tbl_afiliados AS a ON a.idAfiliado = s.llaveAfiliado
        LEFT JOIN
    tbl_recalificacion_pcls AS rc ON rc.idRecalificacionPcls = s.llaveRecalificacion
        LEFT JOIN
    tbl_estado_siniestro AS ercl ON ercl.id_estado_siniestro = rc.llaveEstadoRecalificacion
        LEFT JOIN
    tbl_sub_estados AS sbrcl ON sbrcl.id_sub_estados = rc.llaveSubEstadoRecalificacion
        LEFT JOIN
    users AS urc ON urc.id = rc.llaveCalificadorRecalificacion

WHERE
    ercl.estado_siniestro = '$estado' and date(fechaCreacionCaso) between  '$desde' and '$hasta' and solicitud = '$tipo'
GROUP BY id ";
    $resultReca = mysqli_query($conexion1, $sqlReca);
    $cuantosReCali = 0;
    while ($resultadoReca = mysqli_fetch_array($resultReca)) {
        $cuantosReCali = $resultadoReca["cuantosReCali"];
    }

    /* =============================PreCalificacion Siniestro================================== */
    $sqlPreca = "SELECT 
    COUNT(*) AS cuantosPreCali, name, id
FROM
    tbl_siniestro_pcls AS s
       INNER JOIN
tbl_solicitud AS ts ON ts.id_solicitud = s.llaveTipoSolicitud
        LEFT JOIN
    tbl_afiliados AS a ON a.idAfiliado = s.llaveAfiliado
          LEFT JOIN
  tbl_precalificaciones AS prcli ON prcli.idPrecalificacion = s.llavePrecalificacion
        LEFT JOIN
    tbl_estado_siniestro AS epc ON epc.id_estado_siniestro = prcli.llaveEstadoPrecalificacion
        LEFT JOIN
    tbl_sub_estados AS sbpcl ON sbpcl.id_sub_estados = prcli.llaveSubEstadoPrecalificacion
        LEFT JOIN
    users AS upc ON upc.id = prcli.llaveCalificador

WHERE
    epc.estado_siniestro = '$estado' and date(fechaCreacionCaso) between  '$desde' and '$hasta' and solicitud = '$tipo'
GROUP BY id ";
    $resultPreca = mysqli_query($conexion1, $sqlPreca);
    $cuantosPrecaRe = 0;
    while ($resultadoPreca = mysqli_fetch_array($resultPreca)) {
        $cuantosPrecaRe = $resultadoPreca["cuantosPreCali"];
    }



    /* =============================Adicion Siniestro================================== */
    $sqlAdi = "SELECT 
    COUNT(*) AS cuantosAdi, name, id
FROM
   tbl_adicionpcls AS ad
   INNER JOIN
   tbl_solicitud AS ts ON ts.id_solicitud = ad.LlavetipoSoliAdiPcl
        LEFT JOIN
    tbl_siniestro_pcls AS s ON ad.llaveSiniestroAdicionPcl = s.idSiniestroPcl
        LEFT JOIN
    tbl_estado_siniestro AS edc ON edc.id_estado_siniestro = ad.llaveEstadoAdicion
        LEFT JOIN
    tbl_sub_estados AS sbstadc ON sbstadc.id_sub_estados = ad.llaveSubEstadoAdicion
        LEFT JOIN
    users AS ucl ON ucl.id = ad.llaveUsuarioAsigAdiPcl
WHERE
    edc.estado_siniestro = '$estado' and date(fechaCreacioonAdicin) between  '$desde' and '$hasta' and solicitud = '$tipo'
GROUP BY id ";
    $resultAdi = mysqli_query($conexion1, $sqlAdi);
    $cuantosAdi = 0;
    while ($resultadoAdi = mysqli_fetch_array($resultAdi)) {
        $cuantosAdi = $resultadoAdi["cuantosAdi"];
    }



    /* =============================Adicion  Calificacion Siniestro================================== */
    $sqlAdiCa = "SELECT 
    COUNT(*) AS cuantosAdiCa, name, id
FROM
   tbl_adicionpcls AS ad
   INNER JOIN
tbl_solicitud AS ts ON ts.id_solicitud = ad.LlavetipoSoliAdiPcl
        LEFT JOIN
    tbl_siniestro_pcls AS s ON ad.llaveSiniestroAdicionPcl = s.idSiniestroPcl
              LEFT JOIN
    tbl_califiaciones AS ca ON ca.idCalifiacion = ad.llaveCalificacionAdcion
        LEFT JOIN
    tbl_estado_siniestro AS ec ON ec.id_estado_siniestro = ca.llaveEstadoCalificacion
        LEFT JOIN
    tbl_sub_estados AS sbc ON sbc.id_sub_estados = ca.llaveSubEstadoCalificacion
        LEFT JOIN
    users AS ucl ON ucl.id = ca.llaveCalificadorCalifiacion
WHERE
    ec.estado_siniestro = '$estado'  and date(fechaCreacioonAdicin) between  '$desde' and '$hasta' and solicitud = '$tipo'
GROUP BY id ";
    $resultAdiCa = mysqli_query($conexion1, $sqlAdiCa);
    $cuantosAdiCa = 0;
    while ($resultadoAdiCa = mysqli_fetch_array($resultAdiCa)) {
        $cuantosAdiCa = $resultadoAdiCa["cuantosAdiCa"];
    }

    /* =============================Adicion  ReCalificacion Siniestro================================== */
    $sqlAdiRe = "SELECT 
    COUNT(*) AS cuantosAdiRe, name, id
FROM
   tbl_adicionpcls AS ad
   INNER JOIN
    tbl_solicitud AS ts ON ts.id_solicitud = ad.LlavetipoSoliAdiPcl
        LEFT JOIN
    tbl_siniestro_pcls AS s ON ad.llaveSiniestroAdicionPcl = s.idSiniestroPcl
        LEFT JOIN
    tbl_recalificacion_pcls AS rc ON rc.idRecalificacionPcls = ad.llaveReCalificacionAdicion
        LEFT JOIN
    tbl_estado_siniestro AS ercl ON ercl.id_estado_siniestro = rc.llaveEstadoRecalificacion
        LEFT JOIN
    tbl_sub_estados AS sbrcl ON sbrcl.id_sub_estados = rc.llaveSubEstadoRecalificacion
        LEFT JOIN
    users AS urc ON urc.id = rc.llaveCalificadorRecalificacion
WHERE
    ercl.estado_siniestro = '$estado'  and date(fechaCreacioonAdicin) between  '$desde' and '$hasta' and solicitud = '$tipo'
GROUP BY id ";
    $resultAdiRe = mysqli_query($conexion1, $sqlAdiRe);
    $cuantosAdi = 0;
    while ($resultadoAdiRe = mysqli_fetch_array($resultAdiRe)) {
        $cuantosAdi = $resultadoAdiRe["cuantosAdiRe"];
    }
    if (($cuantosCali + $cuantosReCali + $cuantosAdi + $cuantosAdiCa  + $cuantosPrecaRe) > 0) {
        ?>

                            {

                                name: '<?php echo $estado ?>',
                                y: <?php echo $cuantosCali + $cuantosReCali + $cuantosAdi + $cuantosAdiCa + $cuantosPrecaRe ?>
                            },
        <?php
    }
}
?>

                ]
            }],                    exporting: {
            filename: 'Volúmenes de radicación por Tipo solicitud',
            sourceWidth: 800,
            sourceHeight: 600,
            // scale: 2 (default)
            chartOptions: {
                subtitle: null
            }
        }
    });
</script>



