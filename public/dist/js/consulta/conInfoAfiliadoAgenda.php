<?php
require_once("conexion.php");
$con = new DBController();

if (!empty($_GET["Txtcedula"])) {
    $query = "SELECT 
    *
FROM
    tbl_afiliados WHERE documento ='" . $_GET["Txtcedula"] . "'";

    $afiliado = mysqli_query($conexion1, $query);
    $user_count = $con->numRows($query);
    if ($user_count > 0) {
        ?>
        <?php
        while ($afiliadoInof = mysqli_fetch_array($afiliado)) {
            ?>
            <div class="row">
                <input type="text" class="form-control form-control-sm" id="idAfiliado" value="<?php echo $afiliadoInof['idAfiliado']; ?>" hidden="">
                <div class="col-6"> 
                    <label>Nombre</label>
                    <input type="text" class="form-control form-control-sm" value="<?php echo $afiliadoInof['nombre']; ?>" readonly>
                </div>
                <div class="col-6"> 
                    <label>Direccion</label>
                    <input type="text"  class="form-control form-control-sm" value="<?php echo $afiliadoInof['direccion']; ?>"  readonly>
                </div>
                <div class="col-2"> 
                    <label>Telefono</label>
                    <input type="text"  class="form-control form-control-sm" value="<?php echo $afiliadoInof['telefono']; ?>"  readonly>
                </div>
                <div class="col-2"> 
                    <label>Celular</label>
                    <input type="text"  class="form-control form-control-sm" value="<?php echo $afiliadoInof['celular']; ?>"  readonly>
                </div>
                <div class="col-4"> 
                    <label>Correo</label>
                    <input type="text"  class="form-control form-control-sm" value="<?php echo $afiliadoInof['Correo']; ?>"  readonly>
                </div>
            </div>
            <?php
        }
    }
}
?>