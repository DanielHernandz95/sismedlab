
<div class="card-body">
    <div id="otro"></div>
</div>
<script>

<?php
$conexion1 = mysqli_connect("localhost", "Admin", "T3cnolog14", "db_spiatel", "3306");
 $desde = $_GET['fechaDesdeAdi'];
$hasta = $_GET['fechaHastaAdi'];
?>
    Highcharts.chart('otro', {
    chart: {
    type: 'column'
    },
            colors:['#FF9800', '#8BC34A'],
            title: {
            text: 'Medición de la productividad (profesionales de planta) entre casos con estado Gestionado Vrs No penitente'
            },
            subtitle: {
            text: ''
            },
            xAxis: {
            categories: [



<?php
$sql = "SELECT 
    *
FROM
    users
WHERE
    llaveRol_usuario = 12  OR llaveRol_usuario = 13";
$result = mysqli_query($conexion1, $sql);
while ($resultado = mysqli_fetch_array($result)) {
    ?>

                '<b><?php echo $resultado["name"] ?></b>',
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
                    },
                    labels: {
                    overflow: 'justify'
                    }
            },
            tooltip: {
            valueSuffix: ' Casos'
            },
            plotOptions: {
            bar: {
            dataLabels: {
            enabled: true
            }
            }
            },
            credits: {
            enabled: false
            },
            series: [{
            name: 'GESTIONADO',
                    data: [



<?php
$sql = "SELECT 
    *
FROM
    users
WHERE
    llaveRol_usuario = 12  OR llaveRol_usuario = 13";
$result = mysqli_query($conexion1, $sql);
while ($resultado = mysqli_fetch_array($result)) {


    $id = $resultado["id"];
    /* ============================Calificacion Siniestro================================== */

    $sqlCa = "SELECT 
    COUNT(*) AS cuantosCali, name, id
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
    ec.estado_siniestro = 'GESTIONADO'   and id = $id and date(fechaCreacionCaso) between  '$desde' and '$hasta'
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
    ercl.estado_siniestro = 'GESTIONADO' and id = $id and date(fechaCreacionCaso) between  '$desde' and '$hasta'
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
    epc.estado_siniestro = 'GESTIONADO' and id = $id and date(fechaCreacionCaso) between  '$desde' and '$hasta'
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
        LEFT JOIN
    tbl_siniestro_pcls AS s ON ad.llaveSiniestroAdicionPcl = s.idSiniestroPcl
        LEFT JOIN
    tbl_estado_siniestro AS edc ON edc.id_estado_siniestro = ad.llaveEstadoAdicion
        LEFT JOIN
    tbl_sub_estados AS sbstadc ON sbstadc.id_sub_estados = ad.llaveSubEstadoAdicion
        LEFT JOIN
    users AS ucl ON ucl.id = ad.llaveUsuarioAsigAdiPcl
WHERE
    edc.estado_siniestro = 'GESTIONADO' and id = $id and date(fechaCreacioonAdicin) between  '$desde' and '$hasta'
GROUP BY id ";
    $resultAdi = mysqli_query($conexion1, $sqlAdi);
    $cuantosAdiSolo = 0;
    while ($resultadoAdi = mysqli_fetch_array($resultAdi)) {
        $cuantosAdiSolo = $resultadoAdi["cuantosAdi"];
    }



    /* =============================Adicion  Calificacion Siniestro================================== */
    $sqlAdiCa = "SELECT 
    COUNT(*) AS cuantosAdiCa, name, id
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
    ec.estado_siniestro = 'GESTIONADO' and id = $id and date(fechaCreacioonAdicin) between  '$desde' and '$hasta'
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
    ercl.estado_siniestro = 'GESTIONADO' and id = $id and date(fechaCreacioonAdicin) between  '$desde' and '$hasta'
GROUP BY id ";
    $resultAdiRe = mysqli_query($conexion1, $sqlAdiRe);
    $cuantosAdi = 0;
    while ($resultadoAdiRe = mysqli_fetch_array($resultAdiRe)) {
        $cuantosAdi = $resultadoAdiRe["cuantosAdiRe"];
    }

    echo $cuantosCali + $cuantosReCali + $cuantosAdi + $cuantosAdiCa + $cuantosAdiSolo + $cuantosPrecaRe
    ?>,
    <?php
}
?>

                    ]
            }, {
            name: 'NO PERTINENTE',
                    data: [


<?php
$sql = "SELECT 
    *
FROM
    users
WHERE
    llaveRol_usuario = 12  OR llaveRol_usuario = 13";
$result = mysqli_query($conexion1, $sql);
while ($resultado = mysqli_fetch_array($result)) {


    $id = $resultado["id"];
    /* ============================Calificacion Siniestro================================== */

    $sqlCa = "SELECT 
    COUNT(*) AS cuantosCali, name, id
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
    ec.estado_siniestro = 'NO PERTINENTE'   and id = $id and date(fechaCreacionCaso) between  '$desde' and '$hasta'
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
    ercl.estado_siniestro = 'NO PERTINENTE' and id = $id and date(fechaCreacionCaso) between  '$desde' and '$hasta'
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
    epc.estado_siniestro = 'NO PERTINENTE' and id = $id and date(fechaCreacionCaso) between  '$desde' and '$hasta'
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
        LEFT JOIN
    tbl_siniestro_pcls AS s ON ad.llaveSiniestroAdicionPcl = s.idSiniestroPcl
        LEFT JOIN
    tbl_estado_siniestro AS edc ON edc.id_estado_siniestro = ad.llaveEstadoAdicion
        LEFT JOIN
    tbl_sub_estados AS sbstadc ON sbstadc.id_sub_estados = ad.llaveSubEstadoAdicion
        LEFT JOIN
    users AS ucl ON ucl.id = ad.llaveUsuarioAsigAdiPcl
WHERE
    edc.estado_siniestro = 'NO PERTINENTE' and id = $id and date(fechaCreacioonAdicin) between  '$desde' and '$hasta'
GROUP BY id ";
    $resultAdi = mysqli_query($conexion1, $sqlAdi);
    $cuantosAdiSolo = 0;
    while ($resultadoAdi = mysqli_fetch_array($resultAdi)) {
        $cuantosAdiSolo = $resultadoAdi["cuantosAdi"];
    }



    /* =============================Adicion  Calificacion Siniestro================================== */
    $sqlAdiCa = "SELECT 
    COUNT(*) AS cuantosAdiCa, name, id
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
    ec.estado_siniestro = 'NO PERTINENTE' and id = $id and date(fechaCreacioonAdicin) between  '$desde' and '$hasta'
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
    ercl.estado_siniestro = 'NO PERTINENTE' and id = $id and date(fechaCreacioonAdicin) between  '$desde' and '$hasta'
GROUP BY id ";
    $resultAdiRe = mysqli_query($conexion1, $sqlAdiRe);
    $cuantosAdi = 0;
    while ($resultadoAdiRe = mysqli_fetch_array($resultAdiRe)) {
        $cuantosAdi = $resultadoAdiRe["cuantosAdiRe"];
    }

    echo $cuantosCali + $cuantosReCali + $cuantosAdi + $cuantosAdiCa + $cuantosAdiSolo + $cuantosPrecaRe
    ?>,
    <?php
}
?>

                    ]
            }],
                exporting: {
            filename: 'Gestionado Vrs No penitente',
            sourceWidth: 800,
            sourceHeight: 600,
            // scale: 2 (default)
            chartOptions: {
                subtitle: null
            }
        }
    });

</script>



