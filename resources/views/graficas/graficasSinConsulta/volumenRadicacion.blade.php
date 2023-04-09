
<div class="card-body">
    <div id="volumenRadicacion"></div>
</div>
<script>
<?php
$conexion1 = mysqli_connect("localhost", "Admin", "T3cnolog14", "db_spiatel", "3306");
?>
    Highcharts.chart('volumenRadicacion', {
        colors: ['#F5CBA7', '#F7DC6F', '#FFA500', '#9ACD32'],

        chart: {
            type: 'bar',

        },

        title: {
            text: 'Casos radicados por canal de entrada POR MES'
        },

        xAxis: {
            categories: [<?php
$sqlEstado = "SELECT 
    MONTH(fechaCreacionCaso) AS Mes
FROM
    db_spiatel.tbl_siniestro_pcls
GROUP BY Mes";
$meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

$resultEstado = mysqli_query($conexion1, $sqlEstado);
while ($resultadoEstado = mysqli_fetch_array($resultEstado)) {
    ?>
                '<?php echo $meses[$resultadoEstado["Mes"] - 1] ?>',
    <?php
}
?>]
        },
        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'SIMEL'
            }
        },

        plotOptions: {
            series: {
                stacking: 'normal',
                dataLabels: {
                    color: ['#161616'],
                    textTransform: 'uppercase',
                    enabled: true,
                    style: {
                        fontSize: '18px',
                        fontWeight: 'bold',
                        fontFamily: 'Dosis, monospace  ',
                        color: '#161616'

                    },
                    format: '{point.y:1f}'

                }
            }
        },

        credits: {
            enabled: false
        },
        series: [{
                name: 'ANS',
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
    count(*) as porcanal
FROM
    tbl_siniestro_pcls AS s
        INNER JOIN
    tbl_entrada AS e ON e.id_entrada = s.llaveCanalEntrada
    where  entrada = 'ANS' and  MONTH(fechaCreacionCaso) = '$estado'";

    $resultCa = mysqli_query($conexion1, $sqlCa);
    while ($resultadoCa = mysqli_fetch_array($resultCa)) {
        echo $resultadoCa["porcanal"] . ',';
    }
}
?>

                ]
            }, {
                name: 'CORREO',
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
    count(*) as porcanal
FROM
    tbl_siniestro_pcls AS s
        INNER JOIN
    tbl_entrada AS e ON e.id_entrada = s.llaveCanalEntrada
    where  entrada = 'CORREO' and  MONTH(fechaCreacionCaso) = '$estado'";

    $resultCa = mysqli_query($conexion1, $sqlCa);
    while ($resultadoCa = mysqli_fetch_array($resultCa)) {
        echo $resultadoCa["porcanal"] . ',';
    }
}
?>
                ]
            }, {
                name: 'PQR',
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
    count(*) as porcanal
FROM
    tbl_siniestro_pcls AS s
        INNER JOIN
    tbl_entrada AS e ON e.id_entrada = s.llaveCanalEntrada
    where  entrada = 'PQR' and  MONTH(fechaCreacionCaso) = '$estado'";

    $resultCa = mysqli_query($conexion1, $sqlCa);
    while ($resultadoCa = mysqli_fetch_array($resultCa)) {
        echo $resultadoCa["porcanal"] . ',';
    }
}
?>

                ]
            }, {
                name: 'PROYECTO INNOVACION DE PCL',
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
    count(*) as porcanal
FROM
    tbl_siniestro_pcls AS s
        INNER JOIN
    tbl_entrada AS e ON e.id_entrada = s.llaveCanalEntrada
    where  entrada = 'PROYECTO INNOVACION DE PCL' and  MONTH(fechaCreacionCaso) = '$estado'";

    $resultCa = mysqli_query($conexion1, $sqlCa);
    while ($resultadoCa = mysqli_fetch_array($resultCa)) {
        echo $resultadoCa["porcanal"] . ',';
    }
}
?>

                ]
            }],
        exporting: {
            filename: 'Volúmenes de radicación por canal de entrada',
            sourceWidth: 800,
            sourceHeight: 600,
            // scale: 2 (default)
            chartOptions: {
                subtitle: null
            }
        }


    });
</script>



