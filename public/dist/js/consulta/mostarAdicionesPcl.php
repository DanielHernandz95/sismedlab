<?php
require_once("conexion.php");
$con = new DBController();

if (!empty($_POST["idSiniestroDxPcl"])) {
    $query = "SELECT 
    *
FROM
    tbl_cie_10_adicionados AS c
        INNER JOIN
    tbl_cie_10 AS d ON d.id_cie_10 = c.llave_cie10_union
        INNER JOIN
    tbl_origen_diagnostico_adicional as o on o.id_origen_diagnostico_adicional = c.llave_tipo_cie10 WHERE llaveSiniestroPclDiagnostico='" . $_POST["idSiniestroDxPcl"] . "'";

    $cie10 = mysqli_query($conexion1, $query);
    $user_count = $con->numRows($query);
    if ($user_count > 0) {
        ?>
        <table id="TablaPro" class="table table-stripped table-bordered">
            <thead>
                <tr>
                    <th width="150">Origen diagnóstico</th>
                    <th width="650">CIE 10</th>    
                    <th width="670">Descripción diagnóstico</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody role="row" class="odd">
                <?php
                while ($dx = mysqli_fetch_array($cie10)) {
                    ?>
                    <tr>
                        <td><?php echo $dx['origen'] ?></td>
                        <td><?php echo $dx['cie_10'] ?></td>
                        <td><?php echo $dx['descripcion'] ?></td>
                        <td>
                            <div class="" >    
                                <a href="#" id="eliminar" data-id="<?php echo $dx['id_cie10_adicionados'] ?>"  class=" btn btn-block btn-outline-danger btn-sm botones_letras "><i class="fas fa-trash-alt"></i> Eliminar </a>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <script type="text/javascript">
            $(document).on('click', '#eliminar', function () {
                var id = $(this).data('id');
                $.ajax({
                    url: "../../../dist/js/consulta/eliminarAdicionesPcl.php",
                    method: 'POST',
                    data: {id: id},
                    success: function (data) {
                        jQuery.ajax({
                            url: "../../../dist/js/consulta/mostarAdicionesPcl.php",
                            data: 'idSiniestroDxPcl=' + $("#idSiniestroDxPcl").val(),
                            type: "POST",
                            success: function (data) {
                                $("#tablaCie10SiniestroPcl").html(data);
                            },
                            error: function () {}
                        });
                    }
                });
            });
        </script>
        <?php
    }
}
?>