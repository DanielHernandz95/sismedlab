<?php

$link = mysqli_connect("localhost", "Admin", "T3cnolog14", "db_consentido", "3306");

$query2 = ( "SELECT * FROM departamentos;");
$result2 = $link->query($query2); //usamos la conexion para dar un resultado a la variable
echo '<option value="">Seleccionar</option>';

while (($fila = mysqli_fetch_array($result2)) != NULL) {
    echo '<option value="' . $fila["idDespartamento"] . '">' . utf8_encode($fila["despartamento"]) . '</option>';
}
// Liberar resultados
mysqli_free_result($result2);

// Cerrar la conexión
mysqli_close($link);