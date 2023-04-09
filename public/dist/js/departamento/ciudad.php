<?php

require_once("../consulta/conexion.php");
$con = new DBController();





$query = "SELECT 
    *
FROM
    tbl_departamento AS d
        INNER JOIN
    tbl_ciudad AS c ON c.llave_departamento = d.id_departamento WHERE llave_departamento = " . $_REQUEST["idDespartamento"];

$listaEstado = mysqli_query($conexion1, $query);
$user_count = $con->numRows($query);
if ($user_count > 0) {

    while ($mostarlista = mysqli_fetch_array($listaEstado)) {
        echo '<option value="' . $mostarlista["id_ciudad"] . '">' . $mostarlista["ciudad"] . '</option>';
    }
}
// Liberar resultados
mysqli_free_result($result);

// Cerrar la conexiÃ³n
mysqli_close($link);
?>

