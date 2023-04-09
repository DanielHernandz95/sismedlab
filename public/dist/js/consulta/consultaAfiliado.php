<?php
require_once("conexion.php");
$con = new DBController();

if (!empty($_POST["documento"])) {
    $query = "SELECT 
*
FROM
    tbl_afiliados AS a
        INNER JOIN
    tbl_siniestro_pcls AS s ON s.llaveAfiliado = a.idAfiliado
        INNER JOIN
    tbl_entrada AS e on e.id_entrada = s.llaveCanalEntrada
        INNER JOIN
    tbl_quien_solicita as q On q.id_quien_solicita = s.llaveQuienSolicita
        LEFT JOIN
    tbl_solicitud As so on so.id_solicitud = s.llaveTipoSolicitud
        INNER JOIN
    tbl_tipo_evento AS ev ON ev.id_tipo_evento = s.llaveTipoEvento
         WHERE documento ='" . $_POST["documento"] . "'";

    $afiliado = mysqli_query($conexion1, $query);
    $user_count = $con->numRows($query);
    if ($user_count > 0) {
        ?>
        <div class="card">
            <div class="card-body table-responsive pad">
                <div class="form-group col-sm-8 input-group-sm row" style="margin-left:34%;" id="permisocrearSinie">
                    <div class="col-md-3 col-sm-3 col-xs-12">    
                        <button type="button" class="btn btn-block btn-outline-success btn-sm botones_letras " id="ocultar" >Crear Siniestro</button>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">   
                        <button class="btn btn-block btn-outline-warning botones_letras btn-sm" id="mostar">Ver Siniestros</button>
                    </div>
                </div>  
                <div class="col-sm-12 col-md-12" id="ocultarTabla">
                    <h5 style="margin-left: 45%"><b>Siniestros</b></h5>
                    <table class="table table-bordered" role="grid" aria-describedby="example1_info">
                        <thead>
                            <tr role="row">
                                <th >Id</th>
                                <th>Id Siniestro</th>
                                <th>Canal entrada</th>
                                <th>Quien solicita</th>
                                <th>Tipo de solicitud</th>
                                <th>Tipo evento</th>                                                 
                                <!--<th>Estado</th>
                                <th>Asignado a</th>-->
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($afiliadoa = mysqli_fetch_array($afiliado)) {
                                ?>
                                <tr role="row" class="odd">
                                    <td><?php echo $afiliadoa['idSiniestroPcl']; ?></td>
                                    <td><?php echo $afiliadoa['idSiniestro']; ?></td>
                                    <td><?php echo $afiliadoa['entrada']; ?></td>
                                    <td><?php echo $afiliadoa['quien_solicita']; ?></td>
                                    <td><?php echo $afiliadoa['solicitud']; ?></td>
                                    <td><?php echo $afiliadoa['tipo_evento']; ?></td>
                                    <!--  <td><?php echo $afiliadoa['estado_siniestro']; ?></td>
                                    <td><?php echo $afiliadoa['name']; ?></td>-->
                                    <td>
                                        <div class="" >    
                                            <a type="button" href="/Siniestro/<?php echo $afiliadoa['idSiniestroPcl']; ?>/edit" class="btn btn-block btn-outline-success btn-sm botones_letras "><i class="fas fa-edit"></i> Ver</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>                
            </div>
            <!-- /.card-body -->
        </div>
        <script>
            $(document).ready(function () {
                $("#rolUsuarioLoginActualinicio").ready(function () {
                    rol = $("#rolUsuarioLoginActualinicio").val();
                    siniestros = document.getElementById("permisocrearSinie");
                    if (rol === '12') {
                        siniestros.style.display = 'none';
                    } else {
                        siniestros.style.display = 'show';
                        $("#ocultar").on("click", function () {
                            $('#ocultarTabla').hide(); //muestro mediante id
                            $('#formularioPcl').show(); //muestro mediante clase
                        });
                        $("#mostar").on("click", function () {
                            $('#ocultarTabla').show(); //muestro mediante id
                            $('#formularioPcl').hide(); //muestro mediante clase
                        });
                    }
                });
            });
        </script>
        <?php
    } else {
        ?>
        <script>
            $(document).ready(function () {
                $("#rolUsuarioLoginActualinicio").ready(function () {
                    rol = $("#rolUsuarioLoginActualinicio").val();
                    siniestros = document.getElementById("formularioPcl");

                    if (rol === '12' || rol === '15') {
                        Swal.fire({
                            title: 'Oops...',
                            type: 'warning',
                            text: 'No existen siniestros relacionados con el número de documento'
                        });
                        $(document).ready(function () {
                            $('#botonCrearSiniestroPcl').hide();
                        });
                        $('#formularioPcl').hide()();


                    } else {
                        $('#formularioPcl').show();
                    }
                });
            });
        </script>
        <?php
    }
}
?>