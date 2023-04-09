<?php
require_once("conexion.php");
$con = new DBController();
/* lista empresa documento */
$queryEmpresa = "SELECT * FROM tbl_tipo_documento_empreza";
$resultEmpresa = $conexion1->query($queryEmpresa);
if ($resultEmpresa->num_rows > 0) {
    $listEmpresa = "";
    while ($row = $resultEmpresa->fetch_array(MYSQLI_ASSOC)) {
        $listEmpresa .= " <option value='" . $row['id_tipo_documento_empreza'] . "'>" . $row['tipo_documento_empreza'] . "</option>";  //concatenamos el los options para luego ser insertado en el HTML
    }
} else {
    
}

$querySucursal = "SELECT * FROM tbl_departamento";
$resultSucursal = $conexion1->query($querySucursal);
if ($resultSucursal->num_rows > 0) {
    $listSucursal = "";
    while ($row = $resultSucursal->fetch_array(MYSQLI_ASSOC)) {
        $listSucursal .= " <option value='" . $row['id_departamento'] . "'>" . $row['departamento'] . "</option>";  //concatenamos el los options para luego ser insertado en el HTML
    }
} else {
    
}


if (!empty($_POST["idEmpleador"])) {
    $query = "SELECT 
    *
FROM
    tbl_empresas AS e
        INNER JOIN
    tbl_departamento AS d ON d.id_departamento = e.llave_departamento
        INNER JOIN
    tbl_tipo_documento_empreza AS tdo ON tdo.id_tipo_documento_empreza = e.llave_tipo_docuemtno WHERE nit='" . $_POST["idEmpleador"] . "'";

    $afiliado = mysqli_query($conexion1, $query);
    $user_count = $con->numRows($query);
    if ($user_count > 0 and $user_count < 2) {
        ?>

        <?php
        while ($afiliadoa = mysqli_fetch_array($afiliado)) {
            ?>
            <div class="col-2">
                <label>Tipo Documento</label>
                <input  readonly="" type="text"  value="<?php echo $afiliadoa['tipo_documento_empreza'] ?>"  class="form-control form-control-sm" placeholder="Tipo Documento">
            </div>
            <div class="col-6">
                <label>Razon social</label>
                <input readonly="" type="text" value="<?php echo $afiliadoa['razon_social_empleador'] ?>"  class="form-control form-control-sm" placeholder="Nombre">
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

            <input readonly=""  type="hidden" value="<?php echo $afiliadoa['id_empresa'] ?>" name="llaveEmpresaPcl" class="form-control form-control-sm" placeholder="Correo">
            <?php
        }
        ?>
        <?php
    } else if ($user_count > 1) {
        $masDeUnaPorNit = "SELECT 
    *
FROM
    tbl_empresas AS e
        INNER JOIN
    tbl_departamento AS d ON d.id_departamento = e.llave_departamento
        INNER JOIN
    tbl_tipo_documento_empreza AS tdo ON tdo.id_tipo_documento_empreza = e.llave_tipo_docuemtno WHERE nit='" . $_POST["idEmpleador"] . "'";
        ?>

        <div class="col-5">
            <label>Razon social</label>
            <select class="form-control form-control-sm "  name="txtTipoDocumento" id="nitRepetidos" onclick="comprobarNirRepetidos()">

                <?php
                $nitMAs = mysqli_query($conexion1, $masDeUnaPorNit);
                while ($nisTodos = mysqli_fetch_array($nitMAs)) {
                    ?>
                    <option value=" <?php echo $nisTodos['id_empresa'] ?>"><?php echo $nisTodos['razon_social_empleador'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>

        <script>
            $(document).ready(function () {
                $("#nitRepetidos select").ready(function () {

                    $.ajax({
                        type: "POST",
                        url: "../../../dist/js/consulta/consultaEmpresaNitRepetidos.php",
                        data: 'nitRepetidos=' + $("#nitRepetidos").val(),
                        success: function (data)
                        {
                            $("#empresasMasPorNit").html(data);
                        }
                    });
                });
            });

        </script>

        <?php
    } else {
        ?>
        <div class="col-2">
            <label>Tipo Documento</label>
            <select class="form-control form-control-sm "  name="txtTipoDocumentoEmpresa">
                <option value="">Seleccionar</option>
                <?php
                echo $listEmpresa
                ?>
            </select>
        </div>
        <div class="col-6">
            <label>Razon social</label>
            <input type="text"  name="txtRazonSocial" class="form-control form-control-sm" placeholder="Tipo Documento">

        </div>
        <div class="col-2">
            <label>Sucursal empresa</label>
            <select class="form-control form-control-sm "  name="txtSucursalEmpresa">
                <option value="">Seleccionar</option>
                <?php
                echo $listSucursal
                ?>
            </select>
        </div>
        <div class="col-4">
            <label>Direccion</label>
            <input type="text" name="txtDireccion" class="form-control form-control-sm" placeholder="Direccion">
        </div>
        <div class="col-4">
            <label>Correo</label>
            <input type="text" name="txtCorreo" class="form-control form-control-sm" placeholder="Correo">
        </div> 
        <input readonly=""  type="hidden" value="SI" name="TxtEmpresaNueva" class="form-control form-control-sm" placeholder="Correo">

        <?php
    }
}
?>