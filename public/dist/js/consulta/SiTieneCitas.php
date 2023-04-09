<?php
require_once("conexion.php");
$con = new DBController();

if (!empty($_GET["TxtDia"])) {
    $fechaEntera = strtotime($_GET["TxtDia"]);
    $mes = date("n", $fechaEntera);
    $meses = Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $mesActual = $meses[$mes - 1];
    $query = "SELECT 
    idAfiliado, documento, idcalendario, diaCita
FROM
    tbl_afiliados AS a
        INNER JOIN
    tbl_calendarios AS c ON c.llaveAfiliadoAgenda = a.idAfiliado
WHERE
    MONTH(diaCita) = MONTH('" . $_GET["TxtDia"] . "')
        AND YEAR(diaCita) = YEAR('" . $_GET["TxtDia"] . "') and documento = " . $_GET["TxtCedula"] . " ";
    $afiliado = mysqli_query($conexion1, $query);
    $user_count = $con->numRows($query);

    if ($user_count > 0) {
        ?>
        <script>
            Swal.fire({
                title: 'Oops...',
                type: 'warning',
                text: 'El afiliado ya cuenta con una cita para el mes de <?php echo $mesActual ?>'
            });
            $(document).ready(function () {
                $('#botonCrearSiniestroPcl').hide();
            });
        </script>
        <?php
    } else {
        ?>
        <script>
            var hora = $("#TxtHoraCita option:selected").val();
            var dia = $("#start").val();
            var tipoConsulta = $("#tipoConsult5a option:selected").val();
            var medico = $("#Txtmedico option:selected").val();
            var agenda = document.getElementById("divAgendarCita");
            console.log("hora = " + hora);
            console.log("dia = " + dia);
            console.log("tipoConsulta = " + tipoConsulta);
            console.log("medico = " + medico);
            $.ajax({
                type: "GET",
                url: "../../../dist/js/agendaInicio/agendaCrearInicio.php",
                data: {"TxtHora": hora, "TxtDia": dia, "TxtTipoConsulta": tipoConsulta, "Txtmedico": medico}
            }).done(function (data) {
                agenda.style.display = 'none';
                $("#agendaTraer").html(data).fadeIn();
                $('#agenda').modal('hide');

                document.getElementById("TxtHoraCita").value = "";
                document.getElementById("start").value = "";
                document.getElementById("tipoConsult5a").value = "";
                document.getElementById("Txtmedico").value = "";

            });
        </script>
        <?php
    }
}
?>