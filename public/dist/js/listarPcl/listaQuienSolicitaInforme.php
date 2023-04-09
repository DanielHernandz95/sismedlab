<?php

require_once("../consulta/conexion.php");
$query = "SELECT 
    *
FROM
    tbl_quien_solicita AS q
        INNER JOIN
    tbl_entrada AS e ON e.id_entrada = q.llaveEntrada WHERE entrada = '" . $_GET["canalEntrada"] . "'";
$result = $conexion1->query($query); //usamos la conexion para dar un resultado a la variable
echo '<option value="">Seleccionar</option>';
while (($fila = mysqli_fetch_array($result)) != NULL) {
    echo '<option value="' . $fila["quien_solicita"] . '">' . $fila["quien_solicita"] . '</option>';
}
// Liberar resultados
mysqli_free_result($result);

// Cerrar la conexión
mysqli_close($link);
?>
