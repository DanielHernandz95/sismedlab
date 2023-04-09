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
        
        WHERE llaveSiniestroPclDiagnostico='" . $_POST["idSiniestroDxPcl"] . "' and  moduloDeDx = 'RECALIFICACION'";

    $cie10 = mysqli_query($conexion1, $query);
    $user_count = $con->numRows($query);
    if ($user_count > 0) {
        ?>
        <h5 style="margin-left: 45%"><b>Diagnósticos</b></h5>
        <table id="TablaPro" class="table table-stripped table-bordered">
            <thead>
                <tr>
                    <th width="50">CIE 10</th>  
                    <th width="600">Diagnóstico</th> 
                    <th width="600">Descripción diagnóstico</th> 
                    <th width="100">Acción</th>
                </tr>
            </thead>
            <tbody role="row" class="odd">
                <?php
                while ($dx = mysqli_fetch_array($cie10)) {
                    ?>
                    <tr>
                        <td><?php echo $dx['id_ident'] ?></td>
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

            $(document).ready(function () {
                $("#dxRecalifi").removeAttr("required");
            });

            $(document).on('click', '#eliminar', function () {
                var id = $(this).data('id');
                $.ajax({
                    url: "../../../dist/js/consulta/eliminarAdicionesPcl.php",
                    method: 'POST',
                    data: {id: id},
                    success: function (data) {
                        jQuery.ajax({
                            url: "../../../dist/js/consulta/mostarDxPcl.php",
                            data: 'idSiniestroDxPcl=' + $("#idSiniestroDxPcl").val(),
                            type: "POST",
                            success: function (data) {
                                $("#tablaCie10reca").html(data);
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