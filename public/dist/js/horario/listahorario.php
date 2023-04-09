<?php

require_once("../consulta/conexion.php");


if (!empty($_GET["TxIdHora"])) {
?>
  <option value="<?php echo $_GET["TxIdHora"] ?>"><?php echo $_GET["TxtHora"] ?></option>'

<?php
}

if (!empty($_GET["Txtestado"])) {
    $query = "SELECT 
    *
FROM
    tbl_horas_citas  WHERE idHorasCitas >" . $_GET["Txtestado"] . "";
    $result = $conexion1->query($query); //usamos la conexion para dar un resultado a la variable
    echo '<option value="">Seleccionar</option>';
    while (($fila = mysqli_fetch_array($result)) != NULL) {
        echo '<option value="' . $fila["idHorasCitas"] . '">' . $fila["horaCita"] . '</option>';
    }
// Liberar resultados
    mysqli_free_result($result);

// Cerrar la conexión
    mysqli_close($link);
}
?>
  
