

<?php

require_once("../consulta/conexion.php");
$con = new DBController();

if (!empty($_GET["Txtestado"])) {
    $Txtestado = $_GET["Txtestado"];
    $subEs = $_GET["TxtestadoSub"];

    $elSubEstado = "SELECT 
    *
FROM
        tbl_sub_estados  WHERE id_sub_estados =" . $subEs . "";
    $sub = mysqli_query($conexion1, $elSubEstado);
    $user_count1 = $con->numRows($elSubEstado);
    if ($user_count1 > 0) {
        while ($resultadoSub = mysqli_fetch_array($sub)) {
            echo '<option value="' . $resultadoSub["id_sub_estados"] . '">' . $resultadoSub["sub_estados"] . '</option>';
        }
    } else {
        echo '<option value="">Seleccionar</option>';
    }



    $query = "SELECT 
    *
FROM
    tbl_estado_siniestro AS u
        INNER JOIN
    tbl_sub_estados AS sb ON sb.llave_estado_sini = u.id_estado_siniestro WHERE id_estado_siniestro=" . $Txtestado . "";

    $listaEstado = mysqli_query($conexion1, $query);
    $user_count = $con->numRows($query);
    if ($user_count > 0) {

        while ($mostarlista = mysqli_fetch_array($listaEstado)) {
            echo '<option value="' . $mostarlista["id_sub_estados"] . '">' . $mostarlista["sub_estados"] . '</option>';
        }
    }
}
?>