<?php

require_once("../consulta/conexion.php");
$query = "SELECT 
    *
FROM
    tbl_quien_solicita  WHERE id_quien_solicita = " . $_GET["txtQuienSolicita"] . "";
$result = $conexion1->query($query); //usamos la conexion para dar un resultado a la variable
while (($fila = mysqli_fetch_array($result)) != NULL) {
    echo '<option value="' . $fila["id_quien_solicita"] . '">' . $fila["quien_solicita"] . '</option>';
}


$query = "SELECT 
    *
FROM
    tbl_quien_solicita AS q
        INNER JOIN
    tbl_entrada AS e ON e.id_entrada = q.llaveEntrada WHERE llaveEntrada = " . $_GET["TxtEntrada"] . " and id_quien_solicita != " . $_GET["txtQuienSolicita"] . "";
$result = $conexion1->query($query); //usamos la conexion para dar un resultado a la variable
while (($fila = mysqli_fetch_array($result)) != NULL) {
    echo '<option value="' . $fila["id_quien_solicita"] . '">' . $fila["quien_solicita"] . '</option>';
}

// Liberar resultados
mysqli_free_result($result);

// Cerrar la conexión
mysqli_close($link);
?>
