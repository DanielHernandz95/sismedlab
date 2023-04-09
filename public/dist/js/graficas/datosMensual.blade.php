
<div class="card-body">
    <div id="datosMensuales"></div>
</div>
<script>

<?php
$conexion1 = mysqli_connect("localhost", "Admin", "T3cnolog14", "db_spiatel", "3306");
$desde = $_GET['fechaDesdeAdi'];
$hasta = $_GET['fechaHastaAdi'];
?>
    Highcharts.chart('datosMensuales', {
    chart: {

    plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false
    },
            colors:['#FFEB3B', '#FF9800', '#7CB342', '#F44336'],
            subtitle: {
            text: 'MEDICIÓN DE INDICADOR (27 DÍAS CALENDARIO DESDE LA FECHA DE ASIGNACIÓN DEL CLIENTE HASTA AVAL DE COMITÉ).',
                    style: {
                    fontSize: '20px',
                            fontWeight: 'bold',
                            fontFamily: 'Dosis, monospace  ',
                            color: '#161616'
                    },
            },
            tooltip: {
            pointFormat: '{series.name}: {point.y}<br/>'
            },
<?php
/* ============================Calificacion Siniestro================================== */

$sqlCa = "SELECT 
    count(*) as tatalUno
FROM
    (SELECT 
        idSiniestroPcl,
            DATEDIFF(fechaVisado, fechaAsignacionDelCliente) AS dias
    FROM
        (SELECT 
        idSiniestroPcl,
            name,
            id,
            fechaAsignacionDelCliente,
            fechaVisado,
            fechaCreacionCaso
    FROM
        tbl_siniestro_pcls AS s
    LEFT JOIN tbl_afiliados AS a ON a.idAfiliado = s.llaveAfiliado
    INNER JOIN tbl_califiaciones AS ca ON ca.idCalifiacion = s.llaveCalificacion
    LEFT JOIN tbl_estado_siniestro AS ec ON ec.id_estado_siniestro = ca.llaveEstadoCalificacion
    LEFT JOIN tbl_sub_estados AS sbc ON sbc.id_sub_estados = ca.llaveSubEstadoCalificacion
    LEFT JOIN users AS ucl ON ucl.id = ca.llaveCalificadorCalifiacion) AS asd  WHERE
        fechaVisado IS NOT NULL and date(fechaCreacionCaso) between  '$desde' and '$hasta' ) AS ad
";
$cuantosCali = 0;
$resultCa = mysqli_query($conexion1, $sqlCa);
while ($resultadoCa = mysqli_fetch_array($resultCa)) {
    $cuantosCali = $resultadoCa["tatalUno"];
}
/* ============================Recalificacion Siniestro================================== */

$sqlReca = "SELECT 
    COUNT(*) AS tatalUno
FROM
    (SELECT 
        idSiniestroPcl,
            DATEDIFF(fechaVisadoRecalificacion, fechaAsignacionDelCliente) AS dias
    FROM
        (SELECT 
        idSiniestroPcl,
            name,
            id,
            fechaAsignacionDelCliente,
            fechaVisadoRecalificacion,
            fechaCreacionCaso
    FROM
        tbl_siniestro_pcls AS s
    LEFT JOIN tbl_afiliados AS a ON a.idAfiliado = s.llaveAfiliado
    INNER JOIN tbl_recalificacion_pcls AS rc ON rc.idRecalificacionPcls = s.llaveRecalificacion
    LEFT JOIN tbl_estado_siniestro AS ercl ON ercl.id_estado_siniestro = rc.llaveEstadoRecalificacion
    LEFT JOIN tbl_sub_estados AS sbrcl ON sbrcl.id_sub_estados = rc.llaveSubEstadoRecalificacion
    LEFT JOIN users AS urc ON urc.id = rc.llaveCalificadorRecalificacion) AS asd  WHERE
        fechaVisadoRecalificacion IS NOT NULL and date(fechaCreacionCaso) between  '$desde' and '$hasta') AS ad
";
$resultReca = mysqli_query($conexion1, $sqlReca);
$cuantosReCali = 0;
while ($resultadoReca = mysqli_fetch_array($resultReca)) {
    $cuantosReCali = $resultadoReca["tatalUno"];
}


/* =============================Adicion  Calificacion Siniestro================================== */
$sqlAdiCa = "SELECT 
    COUNT(*) AS tatalUno
FROM
    (SELECT 
        idSiniestroPcl,
            DATEDIFF(fechaVisado, fechaAsigClienteAdiconPcl) AS dias
    FROM
        (SELECT 
        idSiniestroPcl,
            name,
            id,
            fechaAsigClienteAdiconPcl,
            fechaVisado,
            fechaCreacioonAdicin
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
    users AS ucl ON ucl.id = ca.llaveCalificadorCalifiacion ) AS asd  WHERE
        fechaVisado IS NOT NULL and date(fechaCreacioonAdicin) between  '$desde' and '$hasta') AS ad
 ";
$resultAdiCa = mysqli_query($conexion1, $sqlAdiCa);
$cuantosAdiCa = 0;
while ($resultadoAdiCa = mysqli_fetch_array($resultAdiCa)) {
    $cuantosAdiCa = $resultadoAdiCa["tatalUno"];
}

/* =============================Adicion  ReCalificacion Siniestro================================== */
$sqlAdiRe = "SELECT 
    COUNT(*) AS tatalUno
FROM
    (SELECT 
        idSiniestroPcl,
            DATEDIFF(fechaVisadoRecalificacion, fechaAsigClienteAdiconPcl) AS dias
    FROM
        (SELECT 
        idSiniestroPcl,
            name,
            id,
            fechaAsigClienteAdiconPcl,
            fechaVisadoRecalificacion,
            fechaCreacioonAdicin
    FROM
        tbl_adicionpcls AS ad
    LEFT JOIN tbl_siniestro_pcls AS s ON ad.llaveSiniestroAdicionPcl = s.idSiniestroPcl
    INNER JOIN tbl_recalificacion_pcls AS rc ON rc.idRecalificacionPcls = ad.llaveReCalificacionAdicion
    LEFT JOIN tbl_estado_siniestro AS ercl ON ercl.id_estado_siniestro = rc.llaveEstadoRecalificacion
    LEFT JOIN tbl_sub_estados AS sbrcl ON sbrcl.id_sub_estados = rc.llaveSubEstadoRecalificacion
    LEFT JOIN users AS urc ON urc.id = rc.llaveCalificadorRecalificacion) AS asd  WHERE
        fechaVisadoRecalificacion IS NOT NULL and date(fechaCreacioonAdicin) between  '$desde' and '$hasta') AS ad

";
$resultAdiRe = mysqli_query($conexion1, $sqlAdiRe);
$cuantosAdi = 0;
while ($resultadoAdiRe = mysqli_fetch_array($resultAdiRe)) {
    $cuantosAdi = $resultadoAdiRe["tatalUno"];
}
?>
<?php $aaa = $cuantosCali + $cuantosReCali + $cuantosAdi + $cuantosAdiCa ?>

<?php ?>

    title: {
    text: 'Total Siniestros <?php echo $aaa ?>',
            align: 'center',
            verticalAlign: 'middle',
            y: 0
    },
            plotOptions: {
            pie: {
            allowPointSelect: true,
                    dataLabels: {
                    enabled: true,
                            distance: - 20,
                            style: {
                            fontSize: '20px',
                                    fontWeight: 'bold',
                                    fontFamily: 'Dosis, monospace  ',
                                    color: '#161616'
                            },
                            format: ' {point.y}'

                    },
                    allowOverlap: true,
                    startAngle: - 150,
                    endAngle: 150,
                    center: ['50%', '50%'],
                    size: '95%'
            }
            },
            series: [{
            type: 'pie',
                    innerSize: '90%',
                    data: [
                    [
<?php
/* ============================Calificacion Siniestro================================== */

$sqlCa = "SELECT 
    count(*) as tatalUno
FROM
    (SELECT 
        idSiniestroPcl,
            DATEDIFF(fechaVisado, fechaAsignacionDelCliente) AS dias
    FROM
        (SELECT 
        idSiniestroPcl,
            name,
            id,
            fechaAsignacionDelCliente,
            fechaVisado,
            fechaCreacionCaso
    FROM
        tbl_siniestro_pcls AS s
    LEFT JOIN tbl_afiliados AS a ON a.idAfiliado = s.llaveAfiliado
    INNER JOIN tbl_califiaciones AS ca ON ca.idCalifiacion = s.llaveCalificacion
    LEFT JOIN tbl_estado_siniestro AS ec ON ec.id_estado_siniestro = ca.llaveEstadoCalificacion
    LEFT JOIN tbl_sub_estados AS sbc ON sbc.id_sub_estados = ca.llaveSubEstadoCalificacion
    LEFT JOIN users AS ucl ON ucl.id = ca.llaveCalificadorCalifiacion) AS asd  WHERE
        fechaVisado IS NOT NULL and date(fechaCreacionCaso) between  '$desde' and '$hasta') AS ad
WHERE
    dias < 15";
$cuantosCali = 0;
$resultCa = mysqli_query($conexion1, $sqlCa);
while ($resultadoCa = mysqli_fetch_array($resultCa)) {
    $cuantosCali = $resultadoCa["tatalUno"];
}
/* ============================Recalificacion Siniestro================================== */

$sqlReca = "SELECT 
    COUNT(*) AS tatalUno
FROM
    (SELECT 
        idSiniestroPcl,
            DATEDIFF(fechaVisadoRecalificacion, fechaAsignacionDelCliente) AS dias
    FROM
        (SELECT 
        idSiniestroPcl,
            name,
            id,
            fechaAsignacionDelCliente,
            fechaVisadoRecalificacion,
            fechaCreacionCaso
    FROM
        tbl_siniestro_pcls AS s
    LEFT JOIN tbl_afiliados AS a ON a.idAfiliado = s.llaveAfiliado
    INNER JOIN tbl_recalificacion_pcls AS rc ON rc.idRecalificacionPcls = s.llaveRecalificacion
    LEFT JOIN tbl_estado_siniestro AS ercl ON ercl.id_estado_siniestro = rc.llaveEstadoRecalificacion
    LEFT JOIN tbl_sub_estados AS sbrcl ON sbrcl.id_sub_estados = rc.llaveSubEstadoRecalificacion
    LEFT JOIN users AS urc ON urc.id = rc.llaveCalificadorRecalificacion) AS asd  WHERE
        fechaVisadoRecalificacion IS NOT NULL and date(fechaCreacionCaso) between  '$desde' and '$hasta') AS ad
WHERE
    dias < 15 ";
$resultReca = mysqli_query($conexion1, $sqlReca);
$cuantosReCali = 0;
while ($resultadoReca = mysqli_fetch_array($resultReca)) {
    $cuantosReCali = $resultadoReca["tatalUno"];
}


/* =============================Adicion  Calificacion Siniestro================================== */
$sqlAdiCa = "SELECT 
    COUNT(*) AS tatalUno
FROM
    (SELECT 
        idSiniestroPcl,
            DATEDIFF(fechaVisado, fechaAsigClienteAdiconPcl) AS dias
    FROM
        (SELECT 
        idSiniestroPcl,
            name,
            id,
            fechaAsigClienteAdiconPcl,
            fechaVisado,
            fechaCreacioonAdicin
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
    users AS ucl ON ucl.id = ca.llaveCalificadorCalifiacion ) AS asd  WHERE
        fechaVisado IS NOT NULL and date(fechaCreacioonAdicin) between  '$desde' and '$hasta') AS ad
WHERE
    dias < 15 ";
$resultAdiCa = mysqli_query($conexion1, $sqlAdiCa);
$cuantosAdiCa = 0;
while ($resultadoAdiCa = mysqli_fetch_array($resultAdiCa)) {
    $cuantosAdiCa = $resultadoAdiCa["tatalUno"];
}

/* =============================Adicion  ReCalificacion Siniestro================================== */
$sqlAdiRe = "SELECT 
    COUNT(*) AS tatalUno
FROM
    (SELECT 
        idSiniestroPcl,
            DATEDIFF(fechaVisadoRecalificacion, fechaAsigClienteAdiconPcl) AS dias
    FROM
        (SELECT 
        idSiniestroPcl,
            name,
            id,
            fechaAsigClienteAdiconPcl,
            fechaVisadoRecalificacion,
            fechaCreacioonAdicin
    FROM
        tbl_adicionpcls AS ad
    LEFT JOIN tbl_siniestro_pcls AS s ON ad.llaveSiniestroAdicionPcl = s.idSiniestroPcl
    INNER JOIN tbl_recalificacion_pcls AS rc ON rc.idRecalificacionPcls = ad.llaveReCalificacionAdicion
    LEFT JOIN tbl_estado_siniestro AS ercl ON ercl.id_estado_siniestro = rc.llaveEstadoRecalificacion
    LEFT JOIN tbl_sub_estados AS sbrcl ON sbrcl.id_sub_estados = rc.llaveSubEstadoRecalificacion
    LEFT JOIN users AS urc ON urc.id = rc.llaveCalificadorRecalificacion) AS asd  WHERE
        fechaVisadoRecalificacion IS NOT NULL and date(fechaCreacioonAdicin) between  '$desde' and '$hasta') AS ad
WHERE
    dias < 15
";
$resultAdiRe = mysqli_query($conexion1, $sqlAdiRe);
$cuantosAdi = 0;
while ($resultadoAdiRe = mysqli_fetch_array($resultAdiRe)) {
    $cuantosAdi = $resultadoAdiRe["tatalUno"];
}
?>
<?php echo $cuantosCali + $cuantosReCali + $cuantosAdi + $cuantosAdiCa ?>,
<?php ?>

                    ],
                    [                    <?php
/* ============================Calificacion Siniestro================================== */

$sqlCa = "SELECT 
    count(*) as tataDos
FROM
    (SELECT 
        idSiniestroPcl,
            DATEDIFF(fechaVisado, fechaAsignacionDelCliente) AS dias
    FROM
        (SELECT 
        idSiniestroPcl,
            name,
            id,
            fechaAsignacionDelCliente,
            fechaVisado,
            fechaCreacionCaso
    FROM
        tbl_siniestro_pcls AS s
    LEFT JOIN tbl_afiliados AS a ON a.idAfiliado = s.llaveAfiliado
    INNER JOIN tbl_califiaciones AS ca ON ca.idCalifiacion = s.llaveCalificacion
    LEFT JOIN tbl_estado_siniestro AS ec ON ec.id_estado_siniestro = ca.llaveEstadoCalificacion
    LEFT JOIN tbl_sub_estados AS sbc ON sbc.id_sub_estados = ca.llaveSubEstadoCalificacion
    LEFT JOIN users AS ucl ON ucl.id = ca.llaveCalificadorCalifiacion) AS asd  WHERE
        fechaVisado IS NOT NULL and date(fechaCreacionCaso) between  '$desde' and '$hasta') AS ad
WHERE
    dias between 15 and 20";
$cuantosCali = 0;
$resultCa = mysqli_query($conexion1, $sqlCa);
while ($resultadoCa = mysqli_fetch_array($resultCa)) {
    $cuantosCali = $resultadoCa["tataDos"];
}
/* ============================Recalificacion Siniestro================================== */

$sqlReca = "SELECT 
    COUNT(*) AS tataDos
FROM
    (SELECT 
        idSiniestroPcl,
            DATEDIFF(fechaVisadoRecalificacion, fechaAsignacionDelCliente) AS dias
    FROM
        (SELECT 
        idSiniestroPcl,
            name,
            id,
            fechaAsignacionDelCliente,
            fechaVisadoRecalificacion,
            fechaCreacionCaso
    FROM
        tbl_siniestro_pcls AS s
    LEFT JOIN tbl_afiliados AS a ON a.idAfiliado = s.llaveAfiliado
    INNER JOIN tbl_recalificacion_pcls AS rc ON rc.idRecalificacionPcls = s.llaveRecalificacion
    LEFT JOIN tbl_estado_siniestro AS ercl ON ercl.id_estado_siniestro = rc.llaveEstadoRecalificacion
    LEFT JOIN tbl_sub_estados AS sbrcl ON sbrcl.id_sub_estados = rc.llaveSubEstadoRecalificacion
    LEFT JOIN users AS urc ON urc.id = rc.llaveCalificadorRecalificacion) AS asd  WHERE
        fechaVisadoRecalificacion IS NOT NULL and date(fechaCreacionCaso) between  '$desde' and '$hasta') AS ad
WHERE
    dias between 15 and 20 ";
$resultReca = mysqli_query($conexion1, $sqlReca);
$cuantosReCali = 0;
while ($resultadoReca = mysqli_fetch_array($resultReca)) {
    $cuantosReCali = $resultadoReca["tataDos"];
}


/* =============================Adicion  Calificacion Siniestro================================== */
$sqlAdiCa = "SELECT 
    COUNT(*) AS tataDos
FROM
    (SELECT 
        idSiniestroPcl,
            DATEDIFF(fechaVisado, fechaAsigClienteAdiconPcl) AS dias
    FROM
        (SELECT 
        idSiniestroPcl,
            name,
            id,
            fechaAsigClienteAdiconPcl,
            fechaVisado,
            fechaCreacioonAdicin
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
    users AS ucl ON ucl.id = ca.llaveCalificadorCalifiacion ) AS asd  WHERE
        fechaVisado IS NOT NULL and date(fechaCreacioonAdicin) between  '$desde' and '$hasta') AS ad
WHERE
    dias between 15 and 20 ";
$resultAdiCa = mysqli_query($conexion1, $sqlAdiCa);
$cuantosAdiCa = 0;
while ($resultadoAdiCa = mysqli_fetch_array($resultAdiCa)) {
    $cuantosAdiCa = $resultadoAdiCa["tataDos"];
}

/* =============================Adicion  ReCalificacion Siniestro================================== */
$sqlAdiRe = "SELECT 
    COUNT(*) AS tataDos
FROM
    (SELECT 
        idSiniestroPcl,
            DATEDIFF(fechaVisadoRecalificacion, fechaAsigClienteAdiconPcl) AS dias
    FROM
        (SELECT 
        idSiniestroPcl,
            name,
            id,
            fechaAsigClienteAdiconPcl,
            fechaVisadoRecalificacion,
            fechaCreacioonAdicin
    FROM
        tbl_adicionpcls AS ad
    LEFT JOIN tbl_siniestro_pcls AS s ON ad.llaveSiniestroAdicionPcl = s.idSiniestroPcl
    INNER JOIN tbl_recalificacion_pcls AS rc ON rc.idRecalificacionPcls = ad.llaveReCalificacionAdicion
    LEFT JOIN tbl_estado_siniestro AS ercl ON ercl.id_estado_siniestro = rc.llaveEstadoRecalificacion
    LEFT JOIN tbl_sub_estados AS sbrcl ON sbrcl.id_sub_estados = rc.llaveSubEstadoRecalificacion
    LEFT JOIN users AS urc ON urc.id = rc.llaveCalificadorRecalificacion) AS asd  WHERE
        fechaVisadoRecalificacion IS NOT NULL and date(fechaCreacioonAdicin) between  '$desde' and '$hasta') AS ad
WHERE
    dias between 15 and 20
";
$resultAdiRe = mysqli_query($conexion1, $sqlAdiRe);
$cuantosAdi = 0;
while ($resultadoAdiRe = mysqli_fetch_array($resultAdiRe)) {
    $cuantosAdi = $resultadoAdiRe["tataDos"];
}
?>
<?php echo $cuantosCali + $cuantosReCali + $cuantosAdi + $cuantosAdiCa ?>,
<?php ?>],
                    [
<?php
/* ============================Calificacion Siniestro================================== */

$sqlCa = "SELECT 
    count(*) as tataltres
FROM
    (SELECT 
        idSiniestroPcl,
            DATEDIFF(fechaVisado, fechaAsignacionDelCliente) AS dias
    FROM
        (SELECT 
        idSiniestroPcl,
            name,
            id,
            fechaAsignacionDelCliente,
            fechaVisado,
            fechaCreacionCaso
    FROM
        tbl_siniestro_pcls AS s
    LEFT JOIN tbl_afiliados AS a ON a.idAfiliado = s.llaveAfiliado
    INNER JOIN tbl_califiaciones AS ca ON ca.idCalifiacion = s.llaveCalificacion
    LEFT JOIN tbl_estado_siniestro AS ec ON ec.id_estado_siniestro = ca.llaveEstadoCalificacion
    LEFT JOIN tbl_sub_estados AS sbc ON sbc.id_sub_estados = ca.llaveSubEstadoCalificacion
    LEFT JOIN users AS ucl ON ucl.id = ca.llaveCalificadorCalifiacion) AS asd  WHERE
        fechaVisado IS NOT NULL and date(fechaCreacionCaso) between  '$desde' and '$hasta') AS ad
WHERE
    dias between 21 and 27";
$cuantosCali = 0;
$resultCa = mysqli_query($conexion1, $sqlCa);
while ($resultadoCa = mysqli_fetch_array($resultCa)) {
    $cuantosCali = $resultadoCa["tataltres"];
}
/* ============================Recalificacion Siniestro================================== */

$sqlReca = "SELECT 
    COUNT(*) AS tataltres
FROM
    (SELECT 
        idSiniestroPcl,
            DATEDIFF(fechaVisadoRecalificacion, fechaAsignacionDelCliente) AS dias
    FROM
        (SELECT 
        idSiniestroPcl,
            name,
            id,
            fechaAsignacionDelCliente,
            fechaVisadoRecalificacion,
            fechaCreacionCaso
    FROM
        tbl_siniestro_pcls AS s
    LEFT JOIN tbl_afiliados AS a ON a.idAfiliado = s.llaveAfiliado
    INNER JOIN tbl_recalificacion_pcls AS rc ON rc.idRecalificacionPcls = s.llaveRecalificacion
    LEFT JOIN tbl_estado_siniestro AS ercl ON ercl.id_estado_siniestro = rc.llaveEstadoRecalificacion
    LEFT JOIN tbl_sub_estados AS sbrcl ON sbrcl.id_sub_estados = rc.llaveSubEstadoRecalificacion
    LEFT JOIN users AS urc ON urc.id = rc.llaveCalificadorRecalificacion) AS asd  WHERE
        fechaVisadoRecalificacion IS NOT NULL and date(fechaCreacionCaso) between  '$desde' and '$hasta') AS ad
WHERE
    dias between 21 and 27 ";
$resultReca = mysqli_query($conexion1, $sqlReca);
$cuantosReCali = 0;
while ($resultadoReca = mysqli_fetch_array($resultReca)) {
    $cuantosReCali = $resultadoReca["tataltres"];
}


/* =============================Adicion  Calificacion Siniestro================================== */
$sqlAdiCa = "SELECT 
    COUNT(*) AS tataltres
FROM
    (SELECT 
        idSiniestroPcl,
            DATEDIFF(fechaVisado, fechaAsigClienteAdiconPcl) AS dias
    FROM
        (SELECT 
        idSiniestroPcl,
            name,
            id,
            fechaAsigClienteAdiconPcl,
            fechaVisado,
            fechaCreacioonAdicin
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
    users AS ucl ON ucl.id = ca.llaveCalificadorCalifiacion ) AS asd  WHERE
        fechaVisado IS NOT NULL and date(fechaCreacioonAdicin) between  '$desde' and '$hasta') AS ad
WHERE
    dias between 21 and 27 ";
$resultAdiCa = mysqli_query($conexion1, $sqlAdiCa);
$cuantosAdiCa = 0;
while ($resultadoAdiCa = mysqli_fetch_array($resultAdiCa)) {
    $cuantosAdiCa = $resultadoAdiCa["tataltres"];
}

/* =============================Adicion  ReCalificacion Siniestro================================== */
$sqlAdiRe = "SELECT 
    COUNT(*) AS tataltres
FROM
    (SELECT 
        idSiniestroPcl,
            DATEDIFF(fechaVisadoRecalificacion, fechaAsigClienteAdiconPcl) AS dias
    FROM
        (SELECT 
        idSiniestroPcl,
            name,
            id,
            fechaAsigClienteAdiconPcl,
            fechaVisadoRecalificacion,
            fechaCreacioonAdicin
    FROM
        tbl_adicionpcls AS ad
    LEFT JOIN tbl_siniestro_pcls AS s ON ad.llaveSiniestroAdicionPcl = s.idSiniestroPcl
    INNER JOIN tbl_recalificacion_pcls AS rc ON rc.idRecalificacionPcls = ad.llaveReCalificacionAdicion
    LEFT JOIN tbl_estado_siniestro AS ercl ON ercl.id_estado_siniestro = rc.llaveEstadoRecalificacion
    LEFT JOIN tbl_sub_estados AS sbrcl ON sbrcl.id_sub_estados = rc.llaveSubEstadoRecalificacion
    LEFT JOIN users AS urc ON urc.id = rc.llaveCalificadorRecalificacion) AS asd  WHERE
        fechaVisadoRecalificacion IS NOT NULL and date(fechaCreacioonAdicin) between  '$desde' and '$hasta') AS ad
WHERE
    dias between 21 and 27
";
$resultAdiRe = mysqli_query($conexion1, $sqlAdiRe);
$cuantosAdi = 0;
while ($resultadoAdiRe = mysqli_fetch_array($resultAdiRe)) {
    $cuantosAdi = $resultadoAdiRe["tataltres"];
}
?>
<?php echo $cuantosCali + $cuantosReCali + $cuantosAdi + $cuantosAdiCa ?>,
<?php ?>
                    ],
                    [

<?php
/* ============================Calificacion Siniestro================================== */

$sqlCa = "SELECT 
    count(*) as tatalCuatro
FROM
    (SELECT 
        idSiniestroPcl,
            DATEDIFF(fechaVisado, fechaAsignacionDelCliente) AS dias
    FROM
        (SELECT 
        idSiniestroPcl,
            name,
            id,
            fechaAsignacionDelCliente,
            fechaVisado,
            fechaCreacionCaso
    FROM
        tbl_siniestro_pcls AS s
    LEFT JOIN tbl_afiliados AS a ON a.idAfiliado = s.llaveAfiliado
    INNER JOIN tbl_califiaciones AS ca ON ca.idCalifiacion = s.llaveCalificacion
    LEFT JOIN tbl_estado_siniestro AS ec ON ec.id_estado_siniestro = ca.llaveEstadoCalificacion
    LEFT JOIN tbl_sub_estados AS sbc ON sbc.id_sub_estados = ca.llaveSubEstadoCalificacion
    LEFT JOIN users AS ucl ON ucl.id = ca.llaveCalificadorCalifiacion) AS asd  WHERE
        fechaVisado IS NOT NULL and date(fechaCreacionCaso) between  '$desde' and '$hasta') AS ad
WHERE
    dias > 27";
$cuantosCali = 0;
$resultCa = mysqli_query($conexion1, $sqlCa);
while ($resultadoCa = mysqli_fetch_array($resultCa)) {
    $cuantosCali = $resultadoCa["tatalCuatro"];
}
/* ============================Recalificacion Siniestro================================== */

$sqlReca = "SELECT 
    COUNT(*) AS tatalCuatro
FROM
    (SELECT 
        idSiniestroPcl,
            DATEDIFF(fechaVisadoRecalificacion, fechaAsignacionDelCliente) AS dias
    FROM
        (SELECT 
        idSiniestroPcl,
            name,
            id,
            fechaAsignacionDelCliente,
            fechaVisadoRecalificacion,
            fechaCreacionCaso
    FROM
        tbl_siniestro_pcls AS s
    LEFT JOIN tbl_afiliados AS a ON a.idAfiliado = s.llaveAfiliado
    INNER JOIN tbl_recalificacion_pcls AS rc ON rc.idRecalificacionPcls = s.llaveRecalificacion
    LEFT JOIN tbl_estado_siniestro AS ercl ON ercl.id_estado_siniestro = rc.llaveEstadoRecalificacion
    LEFT JOIN tbl_sub_estados AS sbrcl ON sbrcl.id_sub_estados = rc.llaveSubEstadoRecalificacion
    LEFT JOIN users AS urc ON urc.id = rc.llaveCalificadorRecalificacion) AS asd  WHERE
        fechaVisadoRecalificacion IS NOT NULL and date(fechaCreacionCaso) between  '$desde' and '$hasta') AS ad
WHERE
    dias > 27 ";
$resultReca = mysqli_query($conexion1, $sqlReca);
$cuantosReCali = 0;
while ($resultadoReca = mysqli_fetch_array($resultReca)) {
    $cuantosReCali = $resultadoReca["tatalCuatro"];
}


/* =============================Adicion  Calificacion Siniestro================================== */
$sqlAdiCa = "SELECT 
    COUNT(*) AS tatalCuatro
FROM
    (SELECT 
        idSiniestroPcl,
            DATEDIFF(fechaVisado, fechaAsigClienteAdiconPcl) AS dias
    FROM
        (SELECT 
        idSiniestroPcl,
            name,
            id,
            fechaAsigClienteAdiconPcl,
            fechaVisado,
            fechaCreacioonAdicin
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
    users AS ucl ON ucl.id = ca.llaveCalificadorCalifiacion ) AS asd  WHERE
        fechaVisado IS NOT NULL and date(fechaCreacioonAdicin) between  '$desde' and '$hasta') AS ad
WHERE
    dias > 27 ";
$resultAdiCa = mysqli_query($conexion1, $sqlAdiCa);
$cuantosAdiCa = 0;
while ($resultadoAdiCa = mysqli_fetch_array($resultAdiCa)) {
    $cuantosAdiCa = $resultadoAdiCa["tatalCuatro"];
}

/* =============================Adicion  ReCalificacion Siniestro================================== */
$sqlAdiRe = "SELECT 
    COUNT(*) AS tatalCuatro
FROM
    (SELECT 
        idSiniestroPcl,
            DATEDIFF(fechaVisadoRecalificacion, fechaAsigClienteAdiconPcl) AS dias
    FROM
        (SELECT 
        idSiniestroPcl,
            name,
            id,
            fechaAsigClienteAdiconPcl,
            fechaVisadoRecalificacion,
            fechaCreacioonAdicin
    FROM
        tbl_adicionpcls AS ad
    LEFT JOIN tbl_siniestro_pcls AS s ON ad.llaveSiniestroAdicionPcl = s.idSiniestroPcl
    INNER JOIN tbl_recalificacion_pcls AS rc ON rc.idRecalificacionPcls = ad.llaveReCalificacionAdicion
    LEFT JOIN tbl_estado_siniestro AS ercl ON ercl.id_estado_siniestro = rc.llaveEstadoRecalificacion
    LEFT JOIN tbl_sub_estados AS sbrcl ON sbrcl.id_sub_estados = rc.llaveSubEstadoRecalificacion
    LEFT JOIN users AS urc ON urc.id = rc.llaveCalificadorRecalificacion) AS asd  WHERE
        fechaVisadoRecalificacion IS NOT NULL and date(fechaCreacioonAdicin) between  '$desde' and '$hasta') AS ad
WHERE
    dias > 27
";
$resultAdiRe = mysqli_query($conexion1, $sqlAdiRe);
$cuantosAdi = 0;
while ($resultadoAdiRe = mysqli_fetch_array($resultAdiRe)) {
    $cuantosAdi = $resultadoAdiRe["tatalCuatro"];
}
?>
<?php echo $cuantosCali + $cuantosReCali + $cuantosAdi + $cuantosAdiCa ?>,
<?php ?>
                    ]

                    ]

            }],
               exporting: {
            filename: 'Medición de indicador 27 días calendario',
            sourceWidth: 800,
            sourceHeight: 600,
            // scale: 2 (default)
            chartOptions: {
                subtitle: null
            }
        }
    });


</script>



