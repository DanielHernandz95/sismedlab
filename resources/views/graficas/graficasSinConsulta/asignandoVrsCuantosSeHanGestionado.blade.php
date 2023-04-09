
<div class="card-body">
    <div id="graficaLine"></div>
</div>
<script>
<?php
$conexion1 = mysqli_connect("localhost", "Admin", "T3cnolog14", "db_spiatel", "3306");
?>
    Highcharts.chart('graficaLine', {
    chart: {
    type: 'line'
    },
            title: {
            text: 'Casos  asignando Vrs cuantos se han gestionado por mes'
            },
            subtitle: {
            text: 'Simel'
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
            ]
            },
            yAxis: {
            title: {
            text: 'SINIESTROS'
            }
            },
            plotOptions: {
            line: {
            dataLabels: {
            enabled: true
            },
                    enableMouseTracking: false
            }
            },
            series: [
            {
            name: 'ASIGNADOS',
                    data: [
<?php
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
    sbc.sub_estados != 'AVALADO' 
AND sbc.sub_estados != 'PENDIENTE ANEXOS'
AND sbc.sub_estados != 'PENDIENTE ACTA EJECUTORIA'
AND sbc.sub_estados != 'PCL SIN NOTIFICAR'
AND sbc.sub_estados != 'SIN DOCUMENTOS SUFICIENTES'
AND sbc.sub_estados != 'EVENTO MORTAL'
AND sbc.sub_estados != 'CALIFICACION A CARGO DE OTRO PROVEEDOR'
AND sbc.sub_estados != 'CERTIFICACION AFILIACION ULTIMA ARL'
AND sbc.sub_estados != 'EN CONTROVERSIA CAL 1RA OPORTUNIDAD'
AND sbc.sub_estados != 'SIN ALTA DE ESPECIALISTA'
AND sbc.sub_estados != 'ORIGEN SIN NOTIFICAR'
AND sbc.sub_estados != 'ORIGEN COMÃšN'
AND sbc.sub_estados != 'SIN COBERTURA DESDE EL ORIGEN'
AND sbc.sub_estados != 'EVENTO MORTAL'
AND sbc.sub_estados != 'PENDIENTE GARANTÃA PROVEEDOR'
AND sbc.sub_estados != 'ADICION EFECTIVA'
AND sbc.sub_estados != 'ADICION NO EFECTIVA (caso en juntas'
AND sbc.sub_estados != 'ADICION NO EFECTIVA (sin cobertura)'
AND sbc.sub_estados != 'ADICION NO EFECTIVA (no derivado del evento)'
AND sbc.sub_estados != 'EN CONTROVERSIA CAL 1RA OPORTUNIDAD'
AND sbc.sub_estados != 'EN CONTROVERSIA CAL 1ER INSTANCIA'
AND sbc.sub_estados != 'EVENTO MORTAL'
AND sbc.sub_estados != 'SIN CIERRE DE RHB'
AND sbc.sub_estados != 'ORIGEN COMUN'
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
    sbrcl.sub_estados != 'AVALADO' 
AND sbrcl.sub_estados != 'PENDIENTE ANEXOS'
AND sbrcl.sub_estados != 'PENDIENTE ACTA EJECUTORIA'
AND sbrcl.sub_estados != 'PCL SIN NOTIFICAR'
AND sbrcl.sub_estados != 'SIN DOCUMENTOS SUFICIENTES'
AND sbrcl.sub_estados != 'EVENTO MORTAL'
AND sbrcl.sub_estados != 'CALIFICACION A CARGO DE OTRO PROVEEDOR'
AND sbrcl.sub_estados != 'CERTIFICACION AFILIACION ULTIMA ARL'
AND sbrcl.sub_estados != 'EN CONTROVERSIA CAL 1RA OPORTUNIDAD'
AND sbrcl.sub_estados != 'SIN ALTA DE ESPECIALISTA'
AND sbrcl.sub_estados != 'ORIGEN SIN NOTIFICAR'
AND sbrcl.sub_estados != 'ORIGEN COMÃšN'
AND sbrcl.sub_estados != 'SIN COBERTURA DESDE EL ORIGEN'
AND sbrcl.sub_estados != 'EVENTO MORTAL'
AND sbrcl.sub_estados != 'PENDIENTE GARANTÃA PROVEEDOR'
AND sbrcl.sub_estados != 'ADICION EFECTIVA'
AND sbrcl.sub_estados != 'ADICION NO EFECTIVA (caso en juntas'
AND sbrcl.sub_estados != 'ADICION NO EFECTIVA (sin cobertura)'
AND sbrcl.sub_estados != 'ADICION NO EFECTIVA (no derivado del evento)'
AND sbrcl.sub_estados != 'EN CONTROVERSIA CAL 1RA OPORTUNIDAD'
AND sbrcl.sub_estados != 'EN CONTROVERSIA CAL 1ER INSTANCIA'
AND sbrcl.sub_estados != 'EVENTO MORTAL'
AND sbrcl.sub_estados != 'SIN CIERRE DE RHB'
AND sbrcl.sub_estados != 'ORIGEN COMÃšN'
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
    sbpcl.sub_estados != 'AVALADO' 
AND sbpcl.sub_estados != 'PENDIENTE ANEXOS'
AND sbpcl.sub_estados != 'PENDIENTE ACTA EJECUTORIA'
AND sbpcl.sub_estados != 'PCL SIN NOTIFICAR'
AND sbpcl.sub_estados != 'SIN DOCUMENTOS SUFICIENTES'
AND sbpcl.sub_estados != 'EVENTO MORTAL'
AND sbpcl.sub_estados != 'CALIFICACION A CARGO DE OTRO PROVEEDOR'
AND sbpcl.sub_estados != 'CERTIFICACION AFILIACION ULTIMA ARL'
AND sbpcl.sub_estados != 'EN CONTROVERSIA CAL 1RA OPORTUNIDAD'
AND sbpcl.sub_estados != 'SIN ALTA DE ESPECIALISTA'
AND sbpcl.sub_estados != 'ORIGEN SIN NOTIFICAR'
AND sbpcl.sub_estados != 'ORIGEN COMÃšN'
AND sbpcl.sub_estados != 'SIN COBERTURA DESDE EL ORIGEN'
AND sbpcl.sub_estados != 'EVENTO MORTAL'
AND sbpcl.sub_estados != 'PENDIENTE GARANTÃA PROVEEDOR'
AND sbpcl.sub_estados != 'ADICION EFECTIVA'
AND sbpcl.sub_estados != 'ADICION NO EFECTIVA (caso en juntas'
AND sbpcl.sub_estados != 'ADICION NO EFECTIVA (sin cobertura)'
AND sbpcl.sub_estados != 'ADICION NO EFECTIVA (no derivado del evento)'
AND sbpcl.sub_estados != 'EN CONTROVERSIA CAL 1RA OPORTUNIDAD'
AND sbpcl.sub_estados != 'EN CONTROVERSIA CAL 1ER INSTANCIA'
AND sbpcl.sub_estados != 'EVENTO MORTAL'
AND sbpcl.sub_estados != 'SIN CIERRE DE RHB'
AND sbpcl.sub_estados != 'ORIGEN COMÃšN'
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
    sbstadc.sub_estados != 'AVALADO' 
AND sbstadc.sub_estados != 'PENDIENTE ANEXOS'
AND sbstadc.sub_estados != 'PENDIENTE ACTA EJECUTORIA'
AND sbstadc.sub_estados != 'PCL SIN NOTIFICAR'
AND sbstadc.sub_estados != 'SIN DOCUMENTOS SUFICIENTES'
AND sbstadc.sub_estados != 'EVENTO MORTAL'
AND sbstadc.sub_estados != 'CALIFICACION A CARGO DE OTRO PROVEEDOR'
AND sbstadc.sub_estados != 'CERTIFICACION AFILIACION ULTIMA ARL'
AND sbstadc.sub_estados != 'EN CONTROVERSIA CAL 1RA OPORTUNIDAD'
AND sbstadc.sub_estados != 'SIN ALTA DE ESPECIALISTA'
AND sbstadc.sub_estados != 'ORIGEN SIN NOTIFICAR'
AND sbstadc.sub_estados != 'ORIGEN COMÃšN'
AND sbstadc.sub_estados != 'SIN COBERTURA DESDE EL ORIGEN'
AND sbstadc.sub_estados != 'EVENTO MORTAL'
AND sbstadc.sub_estados != 'PENDIENTE GARANTÃA PROVEEDOR'
AND sbstadc.sub_estados != 'ADICION EFECTIVA'
AND sbstadc.sub_estados != 'ADICION NO EFECTIVA (caso en juntas'
AND sbstadc.sub_estados != 'ADICION NO EFECTIVA (sin cobertura)'
AND sbstadc.sub_estados != 'ADICION NO EFECTIVA (no derivado del evento)'
AND sbstadc.sub_estados != 'EN CONTROVERSIA CAL 1RA OPORTUNIDAD'
AND sbstadc.sub_estados != 'EN CONTROVERSIA CAL 1ER INSTANCIA'
AND sbstadc.sub_estados != 'EVENTO MORTAL'
AND sbstadc.sub_estados != 'SIN CIERRE DE RHB'
AND sbstadc.sub_estados != 'ORIGEN COMÃšN'
and  MONTH(fechaCreacionCaso) = $estado
";
    $resultAdi = mysqli_query($conexion1, $sqlAdi);
    $cuantosAdi = 0;
    while ($resultadoAdi = mysqli_fetch_array($resultAdi)) {
        $cuantosAdi = $resultadoAdi["cuantosAdi"];
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
    sbc.sub_estados != 'AVALADO' 
AND sbc.sub_estados != 'PENDIENTE ANEXOS'
AND sbc.sub_estados != 'PENDIENTE ACTA EJECUTORIA'
AND sbc.sub_estados != 'PCL SIN NOTIFICAR'
AND sbc.sub_estados != 'SIN DOCUMENTOS SUFICIENTES'
AND sbc.sub_estados != 'EVENTO MORTAL'
AND sbc.sub_estados != 'CALIFICACION A CARGO DE OTRO PROVEEDOR'
AND sbc.sub_estados != 'CERTIFICACION AFILIACION ULTIMA ARL'
AND sbc.sub_estados != 'EN CONTROVERSIA CAL 1RA OPORTUNIDAD'
AND sbc.sub_estados != 'SIN ALTA DE ESPECIALISTA'
AND sbc.sub_estados != 'ORIGEN SIN NOTIFICAR'
AND sbc.sub_estados != 'ORIGEN COMÃšN'
AND sbc.sub_estados != 'SIN COBERTURA DESDE EL ORIGEN'
AND sbc.sub_estados != 'EVENTO MORTAL'
AND sbc.sub_estados != 'PENDIENTE GARANTÃA PROVEEDOR'
AND sbc.sub_estados != 'ADICION EFECTIVA'
AND sbc.sub_estados != 'ADICION NO EFECTIVA (caso en juntas'
AND sbc.sub_estados != 'ADICION NO EFECTIVA (sin cobertura)'
AND sbc.sub_estados != 'ADICION NO EFECTIVA (no derivado del evento)'
AND sbc.sub_estados != 'EN CONTROVERSIA CAL 1RA OPORTUNIDAD'
AND sbc.sub_estados != 'EN CONTROVERSIA CAL 1ER INSTANCIA'
AND sbc.sub_estados != 'EVENTO MORTAL'
AND sbc.sub_estados != 'SIN CIERRE DE RHB'
AND sbc.sub_estados != 'ORIGEN COMÃšN'
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
    sbrcl.sub_estados != 'AVALADO' 
AND sbrcl.sub_estados != 'PENDIENTE ANEXOS'
AND sbrcl.sub_estados != 'PENDIENTE ACTA EJECUTORIA'
AND sbrcl.sub_estados != 'PCL SIN NOTIFICAR'
AND sbrcl.sub_estados != 'SIN DOCUMENTOS SUFICIENTES'
AND sbrcl.sub_estados != 'EVENTO MORTAL'
AND sbrcl.sub_estados != 'CALIFICACION A CARGO DE OTRO PROVEEDOR'
AND sbrcl.sub_estados != 'CERTIFICACION AFILIACION ULTIMA ARL'
AND sbrcl.sub_estados != 'EN CONTROVERSIA CAL 1RA OPORTUNIDAD'
AND sbrcl.sub_estados != 'SIN ALTA DE ESPECIALISTA'
AND sbrcl.sub_estados != 'ORIGEN SIN NOTIFICAR'
AND sbrcl.sub_estados != 'ORIGEN COMÃšN'
AND sbrcl.sub_estados != 'SIN COBERTURA DESDE EL ORIGEN'
AND sbrcl.sub_estados != 'EVENTO MORTAL'
AND sbrcl.sub_estados != 'PENDIENTE GARANTÃA PROVEEDOR'
AND sbrcl.sub_estados != 'ADICION EFECTIVA'
AND sbrcl.sub_estados != 'ADICION NO EFECTIVA (caso en juntas'
AND sbrcl.sub_estados != 'ADICION NO EFECTIVA (sin cobertura)'
AND sbrcl.sub_estados != 'ADICION NO EFECTIVA (no derivado del evento)'
AND sbrcl.sub_estados != 'EN CONTROVERSIA CAL 1RA OPORTUNIDAD'
AND sbrcl.sub_estados != 'EN CONTROVERSIA CAL 1ER INSTANCIA'
AND sbrcl.sub_estados != 'EVENTO MORTAL'
AND sbrcl.sub_estados != 'SIN CIERRE DE RHB'
AND sbrcl.sub_estados != 'ORIGEN COMÃšN'
and  MONTH(fechaCreacionCaso) = $estado
";
    $resultAdiRe = mysqli_query($conexion1, $sqlAdiRe);
    $cuantosAdi = 0;
    while ($resultadoAdiRe = mysqli_fetch_array($resultAdiRe)) {
        $cuantosAdi = $resultadoAdiRe["cuantosAdiRe"];
    }

    echo $cuantosCali + $cuantosReCali + $cuantosAdi + $cuantosAdiCa  + $cuantosPrecaRe
    ?>,
    <?php
}
?>
                    ]
            }, {
            name: 'GESTIONADOS',
                    data: [
<?php
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
OR sbc.sub_estados = 'PENDIENTE ANEXOS'
OR sbc.sub_estados = 'PENDIENTE ACTA EJECUTORIA'
OR sbc.sub_estados = 'PCL SIN NOTIFICAR'
OR sbc.sub_estados = 'SIN DOCUMENTOS SUFICIENTES'
OR sbc.sub_estados = 'EVENTO MORTAL'
OR sbc.sub_estados = 'CALIFICACION A CARGO DE OTRO PROVEEDOR'
OR sbc.sub_estados = 'CERTIFICACION AFILIACION ULTIMA ARL'
OR sbc.sub_estados = 'EN CONTROVERSIA CAL 1RA OPORTUNIDAD'
OR sbc.sub_estados = 'SIN ALTA DE ESPECIALISTA'
OR sbc.sub_estados = 'ORIGEN SIN NOTIFICAR'
OR sbc.sub_estados = 'ORIGEN COMÃšN'
OR sbc.sub_estados = 'SIN COBERTURA DESDE EL ORIGEN'
OR sbc.sub_estados = 'EVENTO MORTAL'
OR sbc.sub_estados = 'PENDIENTE GARANTÃA PROVEEDOR'
OR sbc.sub_estados = 'ADICION EFECTIVA'
OR sbc.sub_estados = 'ADICION NO EFECTIVA (caso en juntas'
OR sbc.sub_estados = 'ADICION NO EFECTIVA (sin cobertura)'
OR sbc.sub_estados = 'ADICION NO EFECTIVA (no derivado del evento)'
OR sbc.sub_estados = 'EN CONTROVERSIA CAL 1RA OPORTUNIDAD'
OR sbc.sub_estados = 'EN CONTROVERSIA CAL 1ER INSTANCIA'
OR sbc.sub_estados = 'EVENTO MORTAL'
OR sbc.sub_estados = 'SIN CIERRE DE RHB'
OR sbc.sub_estados = 'ORIGEN COMÃšN'
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
OR sbrcl.sub_estados = 'PENDIENTE ANEXOS'
OR sbrcl.sub_estados = 'PENDIENTE ACTA EJECUTORIA'
OR sbrcl.sub_estados = 'PCL SIN NOTIFICAR'
OR sbrcl.sub_estados = 'SIN DOCUMENTOS SUFICIENTES'
OR sbrcl.sub_estados = 'EVENTO MORTAL'
OR sbrcl.sub_estados = 'CALIFICACION A CARGO DE OTRO PROVEEDOR'
OR sbrcl.sub_estados = 'CERTIFICACION AFILIACION ULTIMA ARL'
OR sbrcl.sub_estados = 'EN CONTROVERSIA CAL 1RA OPORTUNIDAD'
OR sbrcl.sub_estados = 'SIN ALTA DE ESPECIALISTA'
OR sbrcl.sub_estados = 'ORIGEN SIN NOTIFICAR'
OR sbrcl.sub_estados = 'ORIGEN COMÃšN'
OR sbrcl.sub_estados = 'SIN COBERTURA DESDE EL ORIGEN'
OR sbrcl.sub_estados = 'EVENTO MORTAL'
OR sbrcl.sub_estados = 'PENDIENTE GARANTÃA PROVEEDOR'
OR sbrcl.sub_estados = 'ADICION EFECTIVA'
OR sbrcl.sub_estados = 'ADICION NO EFECTIVA (caso en juntas'
OR sbrcl.sub_estados = 'ADICION NO EFECTIVA (sin cobertura)'
OR sbrcl.sub_estados = 'ADICION NO EFECTIVA (no derivado del evento)'
OR sbrcl.sub_estados = 'EN CONTROVERSIA CAL 1RA OPORTUNIDAD'
OR sbrcl.sub_estados = 'EN CONTROVERSIA CAL 1ER INSTANCIA'
OR sbrcl.sub_estados = 'EVENTO MORTAL'
OR sbrcl.sub_estados = 'SIN CIERRE DE RHB'
OR sbrcl.sub_estados = 'ORIGEN COMUN'
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
OR sbpcl.sub_estados = 'PENDIENTE ANEXOS'
OR sbpcl.sub_estados = 'PENDIENTE ACTA EJECUTORIA'
OR sbpcl.sub_estados = 'PCL SIN NOTIFICAR'
OR sbpcl.sub_estados = 'SIN DOCUMENTOS SUFICIENTES'
OR sbpcl.sub_estados = 'EVENTO MORTAL'
OR sbpcl.sub_estados = 'CALIFICACION A CARGO DE OTRO PROVEEDOR'
OR sbpcl.sub_estados = 'CERTIFICACION AFILIACION ULTIMA ARL'
OR sbpcl.sub_estados = 'EN CONTROVERSIA CAL 1RA OPORTUNIDAD'
OR sbpcl.sub_estados = 'SIN ALTA DE ESPECIALISTA'
OR sbpcl.sub_estados = 'ORIGEN SIN NOTIFICAR'
OR sbpcl.sub_estados = 'ORIGEN COMÃšN'
OR sbpcl.sub_estados = 'SIN COBERTURA DESDE EL ORIGEN'
OR sbpcl.sub_estados = 'EVENTO MORTAL'
OR sbpcl.sub_estados = 'PENDIENTE GARANTÃA PROVEEDOR'
OR sbpcl.sub_estados = 'ADICION EFECTIVA'
OR sbpcl.sub_estados = 'ADICION NO EFECTIVA (caso en juntas'
OR sbpcl.sub_estados = 'ADICION NO EFECTIVA (sin cobertura)'
OR sbpcl.sub_estados = 'ADICION NO EFECTIVA (no derivado del evento)'
OR sbpcl.sub_estados = 'EN CONTROVERSIA CAL 1RA OPORTUNIDAD'
OR sbpcl.sub_estados = 'EN CONTROVERSIA CAL 1ER INSTANCIA'
OR sbpcl.sub_estados = 'EVENTO MORTAL'
OR sbpcl.sub_estados = 'SIN CIERRE DE RHB'
OR sbpcl.sub_estados = 'ORIGEN COMÃšN'
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
OR sbstadc.sub_estados = 'PENDIENTE ANEXOS'
OR sbstadc.sub_estados = 'PENDIENTE ACTA EJECUTORIA'
OR sbstadc.sub_estados = 'PCL SIN NOTIFICAR'
OR sbstadc.sub_estados = 'SIN DOCUMENTOS SUFICIENTES'
OR sbstadc.sub_estados = 'EVENTO MORTAL'
OR sbstadc.sub_estados = 'CALIFICACION A CARGO DE OTRO PROVEEDOR'
OR sbstadc.sub_estados = 'CERTIFICACION AFILIACION ULTIMA ARL'
OR sbstadc.sub_estados = 'EN CONTROVERSIA CAL 1RA OPORTUNIDAD'
OR sbstadc.sub_estados = 'SIN ALTA DE ESPECIALISTA'
OR sbstadc.sub_estados = 'ORIGEN SIN NOTIFICAR'
OR sbstadc.sub_estados = 'ORIGEN COMÃšN'
OR sbstadc.sub_estados = 'SIN COBERTURA DESDE EL ORIGEN'
OR sbstadc.sub_estados = 'EVENTO MORTAL'
OR sbstadc.sub_estados = 'PENDIENTE GARANTÃA PROVEEDOR'
OR sbstadc.sub_estados = 'ADICION EFECTIVA'
OR sbstadc.sub_estados = 'ADICION NO EFECTIVA (caso en juntas'
OR sbstadc.sub_estados = 'ADICION NO EFECTIVA (sin cobertura)'
OR sbstadc.sub_estados = 'ADICION NO EFECTIVA (no derivado del evento)'
OR sbstadc.sub_estados = 'EN CONTROVERSIA CAL 1RA OPORTUNIDAD'
OR sbstadc.sub_estados = 'EN CONTROVERSIA CAL 1ER INSTANCIA'
OR sbstadc.sub_estados = 'EVENTO MORTAL'
OR sbstadc.sub_estados = 'SIN CIERRE DE RHB'
OR sbstadc.sub_estados = 'ORIGEN COMÃšN'
and  MONTH(fechaCreacionCaso) = $estado
";
    $resultAdi = mysqli_query($conexion1, $sqlAdi);
    $cuantosAdi = 0;
    while ($resultadoAdi = mysqli_fetch_array($resultAdi)) {
        $cuantosAdi = $resultadoAdi["cuantosAdi"];
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
OR sbc.sub_estados = 'PENDIENTE ANEXOS'
OR sbc.sub_estados = 'PENDIENTE ACTA EJECUTORIA'
OR sbc.sub_estados = 'PCL SIN NOTIFICAR'
OR sbc.sub_estados = 'SIN DOCUMENTOS SUFICIENTES'
OR sbc.sub_estados = 'EVENTO MORTAL'
OR sbc.sub_estados = 'CALIFICACION A CARGO DE OTRO PROVEEDOR'
OR sbc.sub_estados = 'CERTIFICACION AFILIACION ULTIMA ARL'
OR sbc.sub_estados = 'EN CONTROVERSIA CAL 1RA OPORTUNIDAD'
OR sbc.sub_estados = 'SIN ALTA DE ESPECIALISTA'
OR sbc.sub_estados = 'ORIGEN SIN NOTIFICAR'
OR sbc.sub_estados = 'ORIGEN COMÃšN'
OR sbc.sub_estados = 'SIN COBERTURA DESDE EL ORIGEN'
OR sbc.sub_estados = 'EVENTO MORTAL'
OR sbc.sub_estados = 'PENDIENTE GARANTÃA PROVEEDOR'
OR sbc.sub_estados = 'ADICION EFECTIVA'
OR sbc.sub_estados = 'ADICION NO EFECTIVA (caso en juntas'
OR sbc.sub_estados = 'ADICION NO EFECTIVA (sin cobertura)'
OR sbc.sub_estados = 'ADICION NO EFECTIVA (no derivado del evento)'
OR sbc.sub_estados = 'EN CONTROVERSIA CAL 1RA OPORTUNIDAD'
OR sbc.sub_estados = 'EN CONTROVERSIA CAL 1ER INSTANCIA'
OR sbc.sub_estados = 'EVENTO MORTAL'
OR sbc.sub_estados = 'SIN CIERRE DE RHB'
OR sbc.sub_estados = 'ORIGEN COMÃšN'
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
OR sbrcl.sub_estados = 'PENDIENTE ANEXOS'
OR sbrcl.sub_estados = 'PENDIENTE ACTA EJECUTORIA'
OR sbrcl.sub_estados = 'PCL SIN NOTIFICAR'
OR sbrcl.sub_estados = 'SIN DOCUMENTOS SUFICIENTES'
OR sbrcl.sub_estados = 'EVENTO MORTAL'
OR sbrcl.sub_estados = 'CALIFICACION A CARGO DE OTRO PROVEEDOR'
OR sbrcl.sub_estados = 'CERTIFICACION AFILIACION ULTIMA ARL'
OR sbrcl.sub_estados = 'EN CONTROVERSIA CAL 1RA OPORTUNIDAD'
OR sbrcl.sub_estados = 'SIN ALTA DE ESPECIALISTA'
OR sbrcl.sub_estados = 'ORIGEN SIN NOTIFICAR'
OR sbrcl.sub_estados = 'ORIGEN COMÃšN'
OR sbrcl.sub_estados = 'SIN COBERTURA DESDE EL ORIGEN'
OR sbrcl.sub_estados = 'EVENTO MORTAL'
OR sbrcl.sub_estados = 'PENDIENTE GARANTÃA PROVEEDOR'
OR sbrcl.sub_estados = 'ADICION EFECTIVA'
OR sbrcl.sub_estados = 'ADICION NO EFECTIVA (caso en juntas'
OR sbrcl.sub_estados = 'ADICION NO EFECTIVA (sin cobertura)'
OR sbrcl.sub_estados = 'ADICION NO EFECTIVA (no derivado del evento)'
OR sbrcl.sub_estados = 'EN CONTROVERSIA CAL 1RA OPORTUNIDAD'
OR sbrcl.sub_estados = 'EN CONTROVERSIA CAL 1ER INSTANCIA'
OR sbrcl.sub_estados = 'EVENTO MORTAL'
OR sbrcl.sub_estados = 'SIN CIERRE DE RHB'
OR sbrcl.sub_estados = 'ORIGEN COMÃšN'
and  MONTH(fechaCreacionCaso) = $estado
";
    $resultAdiRe = mysqli_query($conexion1, $sqlAdiRe);
    $cuantosAdi = 0;
    while ($resultadoAdiRe = mysqli_fetch_array($resultAdiRe)) {
        $cuantosAdi = $resultadoAdiRe["cuantosAdiRe"];
    }

    echo $cuantosCali + $cuantosReCali + $cuantosAdi + $cuantosAdiCa  + $cuantosPrecaRe
    ?>,
    <?php
}
?>
                    ]
            }],
            exporting: {
            filename: 'Casos  asignando Vrs cuantos se han gestionado por mes',
                    sourceWidth: 800,
                    sourceHeight: 600,
                    // scale: 2 (default)
                    chartOptions: {
                    subtitle: null
                    }
            }
    });
</script>



