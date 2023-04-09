
<div class="card-body">
    <div id="asignadoVrsASIGNADO"></div>
</div>
<script>

<?php
$conexion1 = mysqli_connect("localhost", "Admin", "T3cnolog14", "db_spiatel", "3306");
?>
    Highcharts.chart('asignadoVrsASIGNADO', {
    chart: {
    type: 'bar'
    },
            colors:['#FF9800', '#8BC34A'],
            title: {
            text: 'Asignando Vrs Avalado por mes'
            },
            subtitle: {
            text: 'SIMEl'
            },
            xAxis: {
            categories: [


<?php
$sqlEstado = "SELECT 
    MONTH(fechaCreacionCaso) AS Mes
FROM
    db_spiatel.tbl_siniestro_pcls
GROUP BY Mes";
$meses = ["ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE"];

$resultEstado = mysqli_query($conexion1, $sqlEstado);
while ($resultadoEstado = mysqli_fetch_array($resultEstado)) {
    ?>
                '<b><?php echo $meses[$resultadoEstado["Mes"]-1] ?></b>',
    <?php
}
?>
            ],
                    title: {
                    text: null
                    }
            },
            yAxis: {
            min: 0,
                    title: {
                    text: 'Siniestros',
                            align: 'high'
                    },
                    labels: {
                    overflow: 'justify'
                    }
            },
            tooltip: {
            valueSuffix: ' millions'
            },
            plotOptions: {

            series: {
            pointWidth: 30,
                    dataLabels: {
                    color: ['#161616'],
                            textTransform: 'uppercase',
                            enabled: true,
                            style: {
                            fontSize: '20px',
                                    fontWeight: 'bold',
                                    fontFamily: 'Dosis, monospace  ',
                                    color: '#161616'

                            },
                            format: '{y}',
                            allowOverlap: true
                    }
            }
            },
            credits: {
            enabled: false
            },
            series: [{
            name: 'ASIGNADO',
                    data: [<?php
$sql = "SELECT 
    MONTH(fechaCreacionCaso) AS Mes
FROM
    db_spiatel.tbl_siniestro_pcls
GROUP BY Mes";
$result = mysqli_query($conexion1, $sql);

while ($resultado = mysqli_fetch_array($result)) {


    $estado = $resultado["Mes"];
    /* ============================Calificacion Siniestro================================== */

    $sqlCa = "SELECT 
    COUNT(*) AS cuantosCali
FROM
    tbl_siniestro_pcls AS s
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
   MONTH(fechaCreacionCaso) = $estado
";
    $cuantosCali = 0;
    $resultCa = mysqli_query($conexion1, $sqlCa);
    while ($resultadoCa = mysqli_fetch_array($resultCa)) {
        $cuantosCali = $resultadoCa["cuantosCali"];
    }
    /* ============================Recalificacion Siniestro================================== */

    $sqlReca = "SELECT 
    COUNT(*) AS cuantosReCali
FROM
    tbl_siniestro_pcls AS s
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
    MONTH(fechaCreacionCaso) = $estado
";
    $resultReca = mysqli_query($conexion1, $sqlReca);
    $cuantosReCali = 0;
    while ($resultadoReca = mysqli_fetch_array($resultReca)) {
        $cuantosReCali = $resultadoReca["cuantosReCali"];
    }

    /* =============================PreCalificacion Siniestro================================== */
    $sqlPreca = "SELECT 
    COUNT(*) AS cuantosPreCali
FROM
    tbl_siniestro_pcls AS s
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
     MONTH(fechaCreacionCaso) = $estado
";
    $resultPreca = mysqli_query($conexion1, $sqlPreca);
    $cuantosPrecaRe = 0;
    while ($resultadoPreca = mysqli_fetch_array($resultPreca)) {
        $cuantosPrecaRe = $resultadoPreca["cuantosPreCali"];
    }



    /* =============================Adicion Siniestro================================== */
    $sqlAdi = "SELECT 
    COUNT(*) AS cuantosAdi
FROM
   tbl_adicionpcls AS ad
        LEFT JOIN
    tbl_siniestro_pcls AS s ON ad.llaveSiniestroAdicionPcl = s.idSiniestroPcl
        LEFT JOIN
    tbl_estado_siniestro AS edc ON edc.id_estado_siniestro = ad.llaveEstadoAdicion
        LEFT JOIN
    tbl_sub_estados AS sbstadc ON sbstadc.id_sub_estados = ad.llaveSubEstadoAdicion
        LEFT JOIN
    users AS ucl ON ucl.id = ad.llaveUsuarioAsigAdiPcl
WHERE
 MONTH(fechaCreacionCaso) = $estado
";
    $resultAdi = mysqli_query($conexion1, $sqlAdi);
    $cuantosAdiSolo= 0;
    while ($resultadoAdi = mysqli_fetch_array($resultAdi)) {
        $cuantosAdiSolo = $resultadoAdi["cuantosAdi"];
    }



    /* =============================Adicion  Calificacion Siniestro================================== */
    $sqlAdiCa = "SELECT 
    COUNT(*) AS cuantosAdiCa
FROM
   tbl_adicionpcls AS ad
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
   MONTH(fechaCreacionCaso) = $estado
";
    $resultAdiCa = mysqli_query($conexion1, $sqlAdiCa);
    $cuantosAdiCa = 0;
    while ($resultadoAdiCa = mysqli_fetch_array($resultAdiCa)) {
        $cuantosAdiCa = $resultadoAdiCa["cuantosAdiCa"];
    }

    /* =============================Adicion  ReCalificacion Siniestro================================== */
    $sqlAdiRe = "SELECT 
    COUNT(*) AS cuantosAdiRe
FROM
   tbl_adicionpcls AS ad
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
    MONTH(fechaCreacionCaso) = $estado
";
    $resultAdiRe = mysqli_query($conexion1, $sqlAdiRe);
    $cuantosAdi = 0;
    while ($resultadoAdiRe = mysqli_fetch_array($resultAdiRe)) {
        $cuantosAdi = $resultadoAdiRe["cuantosAdiRe"];
    }

    echo $cuantosCali + $cuantosReCali + $cuantosAdi + $cuantosAdiCa + $cuantosAdiSolo + $cuantosPrecaRe
    ?>,
    <?php
}
?>]
            }, {
            name: 'AVALADO',
                    data: [<?php
$sql = "SELECT 
    MONTH(fechaCreacionCaso) AS Mes
FROM
    db_spiatel.tbl_siniestro_pcls
GROUP BY Mes";
$result = mysqli_query($conexion1, $sql);

while ($resultado = mysqli_fetch_array($result)) {


    $estado = $resultado["Mes"];
    /* ============================Calificacion Siniestro================================== */

    $sqlCa = "SELECT 
    COUNT(*) AS cuantosCali
FROM
    tbl_siniestro_pcls AS s
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
    sbc.sub_estados = 'AVALADO' 

and  MONTH(fechaCreacionCaso) = $estado
";
    $cuantosCali = 0;
    $resultCa = mysqli_query($conexion1, $sqlCa);
    while ($resultadoCa = mysqli_fetch_array($resultCa)) {
        $cuantosCali = $resultadoCa["cuantosCali"];
    }
    /* ============================Recalificacion Siniestro================================== */

    $sqlReca = "SELECT 
    COUNT(*) AS cuantosReCali
FROM
    tbl_siniestro_pcls AS s
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
    sbrcl.sub_estados = 'AVALADO' 

and  MONTH(fechaCreacionCaso) = $estado
";
    $resultReca = mysqli_query($conexion1, $sqlReca);
    $cuantosReCali = 0;
    while ($resultadoReca = mysqli_fetch_array($resultReca)) {
        $cuantosReCali = $resultadoReca["cuantosReCali"];
    }

    /* =============================PreCalificacion Siniestro================================== */
    $sqlPreca = "SELECT 
    COUNT(*) AS cuantosPreCali
FROM
    tbl_siniestro_pcls AS s
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
    sbpcl.sub_estados = 'AVALADO' 

and  MONTH(fechaCreacionCaso) = $estado
";
    $resultPreca = mysqli_query($conexion1, $sqlPreca);
    $cuantosPrecaRe = 0;
    while ($resultadoPreca = mysqli_fetch_array($resultPreca)) {
        $cuantosPrecaRe = $resultadoPreca["cuantosPreCali"];
    }



    /* =============================Adicion Siniestro================================== */
    $sqlAdi = "SELECT 
    COUNT(*) AS cuantosAdi
FROM
   tbl_adicionpcls AS ad
        LEFT JOIN
    tbl_siniestro_pcls AS s ON ad.llaveSiniestroAdicionPcl = s.idSiniestroPcl
        LEFT JOIN
    tbl_estado_siniestro AS edc ON edc.id_estado_siniestro = ad.llaveEstadoAdicion
        LEFT JOIN
    tbl_sub_estados AS sbstadc ON sbstadc.id_sub_estados = ad.llaveSubEstadoAdicion
        LEFT JOIN
    users AS ucl ON ucl.id = ad.llaveUsuarioAsigAdiPcl
WHERE
    sbstadc.sub_estados = 'AVALADO' 

and  MONTH(fechaCreacionCaso) = $estado
";
    $resultAdi = mysqli_query($conexion1, $sqlAdi);
    $cuantosAdiSolo = 0;
    while ($resultadoAdi = mysqli_fetch_array($resultAdi)) {
        $cuantosAdiSolo = $resultadoAdi["cuantosAdi"];
    }



    /* =============================Adicion  Calificacion Siniestro================================== */
    $sqlAdiCa = "SELECT 
    COUNT(*) AS cuantosAdiCa
FROM
   tbl_adicionpcls AS ad
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
    sbc.sub_estados = 'AVALADO' 

and  MONTH(fechaCreacionCaso) = $estado
";
    $resultAdiCa = mysqli_query($conexion1, $sqlAdiCa);
    $cuantosAdiCa = 0;
    while ($resultadoAdiCa = mysqli_fetch_array($resultAdiCa)) {
        $cuantosAdiCa = $resultadoAdiCa["cuantosAdiCa"];
    }

    /* =============================Adicion  ReCalificacion Siniestro================================== */
    $sqlAdiRe = "SELECT 
    COUNT(*) AS cuantosAdiRe
FROM
   tbl_adicionpcls AS ad
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
    sbrcl.sub_estados = 'AVALADO' 

and  MONTH(fechaCreacionCaso) = $estado
";
    $resultAdiRe = mysqli_query($conexion1, $sqlAdiRe);
    $cuantosAdi = 0;
    while ($resultadoAdiRe = mysqli_fetch_array($resultAdiRe)) {
        $cuantosAdi = $resultadoAdiRe["cuantosAdiRe"];
    }

    echo $cuantosCali + $cuantosReCali + $cuantosAdi + $cuantosAdiCa +  $cuantosAdiSolo + $cuantosPrecaRe
    ?>,
    <?php
}
?>]
            }],
            exporting: {
            filename: 'Asignando Vrs los casos con estado Avalado por mes',
                    sourceWidth: 800,
                    sourceHeight: 600,
                    // scale: 2 (default)
                    chartOptions: {
                    subtitle: null
                    }
            }
    });

</script>



