
<div class="card-body">
    <div id="empresas"></div>
</div>
<script>

<?php
$conexion1 = mysqli_connect("localhost", "Admin", "T3cnolog14", "db_spiatel", "3306");
$desde = $_GET['fechaDesdeAdi'];
$hasta = $_GET['fechaHastaAdi'];
?>
    Highcharts.chart('empresas', {
        chart: {
            type: 'column'
        },
        colors: ['#C8E6C9', '#FFE0B2 ', '#A5D6A7', '#FFB74D', '#C8E6C9'],
        title: {
            text: 'Las 10 empresas más representativas que solicitan calificación'
        },
        subtitle: {
            text: 'SIMEL'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        credits: {
            enabled: false
        },

        plotOptions: {
            series: {
                pointWidth: 30,
                colorByPoint: true,
                stacking: 'normal',
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
        yAxis: {
            min: 0,
            title: {
                text: 'Siniestros'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Siniestros: <b>{point.y}</b>'
        },
        series: [{
                name: 'Population',
                data: [

<?php
$sqlEstado = "SELECT 
    COUNT(*) AS empre, razon_social_empleador
FROM
    tbl_siniestro_pcls AS s
        INNER JOIN
    tbl_empresas AS em ON em.id_empresa = s.llaveEmpresaPcl
    WHERE
    DATE(fechaCreacionCaso) BETWEEN '$desde' AND '$hasta'
GROUP BY llaveEmpresaPcl
ORDER BY empre DESC
LIMIT 10;";
$resultEstado = mysqli_query($conexion1, $sqlEstado);
while ($resultadoEstado = mysqli_fetch_array($resultEstado)) {
    ?>
                        [ '<?php echo $resultadoEstado['razon_social_empleador'] ?>',
    <?php echo $resultadoEstado['empre'] ?>],
    <?php
}
?>


                ],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#000',
                    align: 'right',
                    format: '{y}', // one decimal
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }],
        exporting: {
            filename: 'Las 10 empresas más representativas que solicitan calificación.',
            sourceWidth: 800,
            sourceHeight: 600,
            // scale: 2 (default)
            chartOptions: {
                subtitle: null
            }
        }
    });

</script>



