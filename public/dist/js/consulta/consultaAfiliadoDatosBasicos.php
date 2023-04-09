<?php
require_once("conexion.php");
$con = new DBController();

if (!empty($_POST["documento"])) {
    $query = "SELECT 
    *
FROM
    tbl_afiliados AS a
        INNER JOIN
    tbl_tipo_docuemtno AS t ON t.id_tipo_docuemtno = a.llaveTipoDocumento
        INNER JOIN
    tbl_departamento AS d ON d.id_departamento = a.llaveDepartamento  WHERE documento='" . $_POST["documento"] . "'";

    $afiliadoD = mysqli_query($conexion1, $query);
    $user_count = $con->numRows($query);
    if ($user_count > 0) {
        while ($afiliado = mysqli_fetch_array($afiliadoD)) {
            ?>
            <section class="content col-12" >
                <div class="row">
                    <div class="card col-12">
                        <div class="card-header car contornoTitulo">
                            <h3 class="card-title letraTitulo" style="height: 5px;"><b>Datos basicos afiliado</b></h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">                                   
                                    <label>Tipo Documento</label>
                                    <input type="text" name="" class="form-control form-control-sm" value="<?php echo $afiliado['tipo_documento'] ?>" readonly="">
                                </div>
                                <div class="col-2">
                                    <label>Numero Documento</label>
                                    <input type="text" name="" class="form-control form-control-sm" value="<?php echo $afiliado['documento'] ?>" readonly="">
                                </div>

                                <div class="col-3">
                                    <label>Nombre</label>
                                    <input type="text" name="txtDireccion" class="form-control form-control-sm" value="<?php echo $afiliado['nombre'] ?>" readonly="">
                                </div>
                                <div class="col-2">
                                    <label>Direccion</label>
                                    <input type="text" name="txtDireccion" class="form-control form-control-sm" value="<?php echo $afiliado['direccionResi'] ?>" readonly="">
                                </div>
                                <div class="col-2">
                                    <label>Departamento</label>
                                    <input type="text" name="txtDireccion" class="form-control form-control-sm" value="<?php echo $afiliado['departamento'] ?>" readonly="">
                                </div>
                                <div class="col-2">
                                    <label>Telefono fijo</label>
                                    <input type="text" name="txtDireccion" class="form-control form-control-sm" value="<?php echo $afiliado['telefono'] ?>" readonly="">
                                </div>
                                <div class="col-2">
                                    <label>Numero celular</label>
                                    <input type="text" name="txtDireccion" class="form-control form-control-sm" value="<?php echo $afiliado['celular'] ?>" readonly="">
                                </div>
                                <div class="col-3">
                                    <label>Correo</label>
                                    <input type="text" name="txtDireccion" class="form-control form-control-sm" value="<?php echo $afiliado['Correo'] ?>" readonly="">
                                </div> 
                                <input type="hidden" name="TxtAfiliadoYaExiste" class="form-control form-control-sm" value="SI" >
                                <input type="hidden" name="TxtIdAfiliado" id="TxtIdAfiliadoAgenda"  class="form-control form-control-sm" value="<?php echo $afiliado['idAfiliado'] ?>" >

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <script>
                $(document).ready(function () {

                    $("#crearTipoDicumento").removeAttr("required");
                    $("#crearTipoDicumento").prop("disabled", "disabled");

                    $("#CrearANombre").removeAttr("required");
                    $("#CrearANombre").prop("disabled", "disabled");


                    $("#crearDepartamento").removeAttr("required");
                    $("#crearDepartamento").prop("disabled", "disabled");

                    $("#crearGenero").removeAttr("required");
                    $("#crearGenero").prop("disabled", "disabled");


                    $("#crearCiudad").removeAttr("required");
                    $("#crearCiudad").prop("disabled", "disabled");

                    $("#crearFechaNacimiento").removeAttr("required");
                    $("#crearFechaNacimiento").prop("disabled", "disabled");


                    // $("#CrearANombre").removeAttr("required");
                    // $("#CrearANombre").prop("disabled", "disabled");

                    // $("#CrearTelefono").removeAttr("required");
                    // $("#CrearTelefono").prop("disabled", "disabled");


                    //$("#CrearANumero").removeAttr("required");
                    //$("#CrearANumero").prop("disabled", "disabled");

                    //$("#CrearACorreo").removeAttr("required");
                    //$("#CrearACorreo").prop("disabled", "disabled");

                    // $("#CrearTelefono").removeAttr("required");
                    // $("#CrearTelefono").prop("disabled", "disabled");

                });
            </script>

            <?php
        }
    } else {
        ?>
        <script>
            $(document).ready(function () {
                $("#crearTipoDicumento").removeAttr("disabled");
                $("#crearTipoDicumento").prop("required", "required");

                $("#CrearANombre").removeAttr("disabled");
                $("#CrearANombre").prop("required", "required");

                // $("#CrearADireccion").removeAttr("disabled");
                //$("#CrearADireccion").prop("required", "required");

                $("#crearDepartamento").removeAttr("disabled");
                $("#crearDepartamento").prop("required", "required");

                $("#crearGenero").removeAttr("disabled");
                $("#crearGenero").prop("required", "required");

                $("#crearCiudad").removeAttr("disabled");
                $("#crearCiudad").prop("required", "required");

                // $("#CrearANumero").removeAttr("disabled");
                // $("#CrearTelefono").prop("required", "required");


                // $("#CrearANumero").removeAttr("disabled");
                // $("#CrearANumero").prop("required", "required");

                $("#crearFechaNacimiento").removeAttr("disabled");
                $("#crearFechaNacimiento").prop("required", "required");

                // $("#CrearACorreo").removeAttr("disabled");
                // $("#CrearACorreo").prop("required", "required");

                //  $("#CrearTelefono").removeAttr("disabled");
                // $("#CrearTelefono").prop("required", "required");

                $('#formularioBasicoAfiliado').show();
                $('#formularioBasicoAfiliadoEl').show();


            }
            );
        </script>
        <?php
    }
}
?>