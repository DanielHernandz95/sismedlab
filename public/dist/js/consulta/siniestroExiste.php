<?php

require_once("conexion.php");
$con = new DBController();

if (!empty($_POST["siniestroExis"])) {

    $query = "SELECT 
    *
FROM
   tbl_siniestro_pcls WHERE idSiniestro='" . $_POST["siniestroExis"] . "'";

    $afiliado = mysqli_query($conexion1, $query);
    $user_count = $con->numRows($query);

    if ($user_count > 0) {
        ?>
        <script>
            Swal.fire({
                title: 'Oops...',
                type: 'warning',
                text: 'El siniestro ya se encuentra registrado en el sistema!'
            });
            $(document).ready(function () {
                $('#botonCrearSiniestroPcl').hide();
            });
        </script>
        <?php

    } else {
        ?>
        <script>
            $(document).ready(function () {
                $('#botonCrearSiniestroPcl').show();
            });
        </script>
        <?php

    }
}
?>