<?php

require_once("../consulta/conexion.php");
$query = "SELECT 
    *
FROM
    tbl_solicitud AS s
        INNER JOIN
    tbl_entrada AS e ON e.id_entrada = s.llaveEntradaSolicitud  WHERE llaveEntradaSolicitud=" . $_REQUEST["id_entrada"] . "";
$result = $conexion1->query($query); //usamos la conexion para dar un resultado a la variable
echo '<option value="">Seleccionar</option>';
while (($fila = mysqli_fetch_array($result)) != NULL) {
    echo '<option value="' . $fila["id_solicitud"] . '">' . $fila["solicitud"] . '</option>';
}
// Liberar resultados
mysqli_free_result($result);

// Cerrar la conexión
mysqli_close($link);
?>
