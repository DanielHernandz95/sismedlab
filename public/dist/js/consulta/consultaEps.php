<?php
require_once("conexion.php");
$con = new DBController();
/* lista empresa documento */
if (!empty($_POST["idEps"])) {
    $query = "SELECT 
    *
FROM
    tbl_eps AS e
        left JOIN
    tbl_departamento AS d ON d.id_departamento = e.llaveDepartamentoEps
        left  JOIN
    tbl_ciudad AS c ON c.id_ciudad = e.llaveCiudadEps WHERE id_eps ='" . $_POST["idEps"] . "'";

    $afiliado = mysqli_query($conexion1, $query);
    $user_count = $con->numRows($query);
    if ($user_count > 0) {
        ?>

        <?php
        while ($afiliadoa = mysqli_fetch_array($afiliado)) {
            ?>
            <!--            <div class="col-2">
                            <label>EPS</label>
                            <input  name="" type="text"  value="<?php echo $afiliadoa['eps'] ?>"  class="form-control form-control-sm" placeholder="Tipo Documento">
                        </div>-->
            <div class="col-4">
                <label>Nit</label>
                <input readonly="" type="text" value="<?php echo $afiliadoa['nitEps'] ?>" class="form-control form-control-sm" placeholder="Ciudad">
            </div>
            <div class="col-4">
                <label>Departamento</label>
                <input readonly="" type="text" value="<?php echo $afiliadoa['departamento'] ?>"  class="form-control form-control-sm" placeholder="Departamento">
            </div>
            <div class="col-4">
                <label>Ciudad</label>
                <input readonly="" type="text" value="<?php echo $afiliadoa['ciudad'] ?>" class="form-control form-control-sm" placeholder="Ciudad">
            </div> 
            <div class="col-6">
                <label>Dirección</label>
                <input name="direccionEps" type="text" value="<?php echo $afiliadoa['direccionEps'] ?>"  class="form-control form-control-sm" placeholder="Dirección">
            </div>
            <div class="col-2">
                <label>Telefono</label>
                <input name="telefonoEps" type="text" value="<?php echo $afiliadoa['telefonoEps'] ?>"  class="form-control form-control-sm" placeholder="Telefono">
            </div>
            <div class="col-4">
                <label>Correo</label>
                <input name="correoEps" type="text" value="<?php echo $afiliadoa['correoEps'] ?>" class="form-control form-control-sm" placeholder="Ciudad">
            </div>



            <?php
        }
    }
}
?>