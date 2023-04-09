<?php
require_once("conexion.php");
$con = new DBController();

if (!empty($_POST["idSiniestroDxEL"])) {
    $query = "SELECT 
    *
FROM
    tbl_cie_10_adicionados AS c
        INNER JOIN
    tbl_cie_10 AS d ON d.id_cie_10 = c.llave_cie10_union
        INNER JOIN
    tbl_origen_diagnostico_adicional as o on o.id_origen_diagnostico_adicional = c.llave_tipo_cie10
        
        WHERE llaveSiniestroEl='" . $_POST["idSiniestroDxEL"] . "'";

    $cie10 = mysqli_query($conexion1, $query);
    $user_count = $con->numRows($query);
    if ($user_count > 0) {
        ?>
        <h5 style="margin-left: 45%"><b>Diagnósticos</b></h5>
        <table id="TablaPro" class="table table-stripped table-bordered">
            <thead>
                <tr>
                    <th width="40">Origen diagnostico</th> 
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
                        <td><?php echo $dx['origen'] ?></td>
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
            $(document).on('click', '#eliminar', function () {
                var id = $(this).data('id');
                $.ajax({
                    url: "../../../dist/js/consulta/eliminarAdicionesPcl.php",
                    method: 'POST',
                    data: {id: id},
                    success: function (data) {
                        jQuery.ajax({
                            url: "../../../dist/js/consulta/mostarDxEl.php",
                            data: 'idSiniestroDxEL=' + $("#idSiniestroDxEL").val(),
                            type: "POST",
                            success: function (data) {
                                $("#tablaCie10SiniestroEl").html(data);
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