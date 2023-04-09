
<?php

require_once("../consulta/conexion.php");
$estado =$_GET["estado"];
$query = "SELECT 
     distinct(sub_estados)
FROM
    tbl_estado_siniestro AS u
        INNER JOIN
    tbl_sub_estados AS sb ON sb.llave_estado_sini = u.id_estado_siniestro WHERE estado_siniestro = '$estado' and llave_tipo_modulo = 3";
echo '<option value="">Seleccionar</option>';
$result = $conexion1->query($query); //usamos la conexion para dar un resultado a la variable
while (($fila = mysqli_fetch_array($result)) != NULL) {
    echo '<option value="' . $fila["sub_estados"] . '">' . $fila["sub_estados"] . '</option>';
}

// Liberar resultados
mysqli_free_result($result);

// Cerrar la conexión
mysqli_close($link);
?>
