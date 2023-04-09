<?php
require_once("conexion.php");
$con = new DBController();

if (!empty($_POST["nitRepetidos"])) {
    $query = "SELECT 
    *
FROM
    tbl_empresas AS e
        INNER JOIN
    tbl_departamento AS d ON d.id_departamento = e.llave_departamento
        INNER JOIN
    tbl_tipo_documento_empreza AS tdo ON tdo.id_tipo_documento_empreza = e.llave_tipo_docuemtno WHERE id_empresa='" . $_POST["nitRepetidos"] . "'";

    $afiliado = mysqli_query($conexion1, $query);
    $user_count = $con->numRows($query);
    if ($user_count > 0) {
        ?>

        <?php
        while ($afiliadoa = mysqli_fetch_array($afiliado)) {
            ?>
            <div class="col-2">
                <label>Tipo Documento</label>
                <input  readonly="" type="text"  value="<?php echo $afiliadoa['tipo_documento_empreza'] ?>"  class="form-control form-control-sm" placeholder="Tipo Documento">
            </div>

            <div class="col-2">
                <label>Sucursal empresa</label>
                <input readonly="" type="text" value="<?php echo $afiliadoa['departamento'] ?>"  class="form-control form-control-sm" placeholder="Id Siniestro">
            </div>
            <div class="col-4">
                <label>Direccion</label>
                <input  name="direcciontEmpresa"  type="text" value="<?php echo $afiliadoa['direcciontEmpresa'] ?>"  class="form-control form-control-sm" placeholder="Direccion">
            </div>
            <div class="col-4">
                <label>Correo</label>
                <input name="correotEmpresa" type="text" value="<?php echo $afiliadoa['correotEmpresa'] ?>" class="form-control form-control-sm" placeholder="Correo">
            </div> 
            <input readonly=""  type="hidden" value="<?php echo $afiliadoa['id_empresa'] ?>" name="txtIdedmpresa" class="form-control form-control-sm" placeholder="Correo">

            <?php
        }
        ?>
        <?php
    }
}
?>