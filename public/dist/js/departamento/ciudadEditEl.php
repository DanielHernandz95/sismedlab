<?php

require_once("../consulta/conexion.php");
$con = new DBController();


$elSubEstado = "SELECT 
    *
FROM
   
    tbl_ciudad WHERE id_ciudad = " . $_GET["ciudad"] . "";
$sub = mysqli_query($conexion1, $elSubEstado);
$user_count1 = $con->numRows($elSubEstado);
if ($user_count1 > 0) {
    while ($resultadoSub = mysqli_fetch_array($sub)) {
        echo '<option value="' . $resultadoSub["id_ciudad"] . '">' . $resultadoSub["ciudad"] . '</option>';
    }
} else {
    echo '<option value="">Seleccionar</option>';
}



$query = "SELECT 
    *
FROM
    tbl_departamento AS d
        INNER JOIN
    tbl_ciudad AS c ON c.llave_departamento = d.id_departamento WHERE llave_departamento = " . $_GET["departamento"];

$listaEstado = mysqli_query($conexion1, $query);
$user_count = $con->numRows($query);
if ($user_count > 0) {

    while ($mostarlista = mysqli_fetch_array($listaEstado)) {
        echo '<option value="' . $mostarlista["id_ciudad"] . '">' . $mostarlista["ciudad"] . '</option>';
    }
}
?>