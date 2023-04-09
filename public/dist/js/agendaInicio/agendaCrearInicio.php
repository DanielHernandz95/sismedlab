

<?php
require_once("../consulta/conexion.php");
$con = new DBController();

if (!empty($_GET["TxtDia"])) {
    ?>


    <div class="col-md-12" style="margin-top: 1%">
        <!-- DIRECT CHAT -->
        <div class="card direct-chat direct-chat-warning" style="border: 1px solid #000">
            <div class="card-header" style="height:  50%" style="border-bottom: 1px solid #000">
                <h3 class="card-title"><b>Informacion Cita</b></h3>
                <div class="card-tools">
                    <button type="button" id="btnLimiarAgenda" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body col-11">
                <div class="row container">
                    <div class="col-2">
                        <label>Dia cita</label>
                        <input type="text" readonly="" id="InicioAgendaDia" name="TxtDiaCita" value="<?php echo $_GET["TxtDia"] ?>" id="" class="form-control form-control-sm ">
                    </div> 

                    <?php
                    $hora = "SELECT
                            *
                             FROM
                            tbl_horas_citas  WHERE idHorasCitas =" . $_GET["TxtHora"] . "";
                    $horar = mysqli_query($conexion1, $hora);
                    $CountHora = $con->numRows($hora);
                    if ($CountHora > 0) {
                        while ($rHora = mysqli_fetch_array($horar)) {
                            ?>
                            <div class="col-2">
                                <label>Hora</label>
                                <input type="text" readonly="" id="InicioAgendaHoraId"  hidden="" name="TxtHoraCitaAgenda" value="<?php echo $rHora["idHorasCitas"] ?>"  class="form-control form-control-sm ">
                                <input type="text" readonly="" id="InicioAgendaHora"  value="<?php echo $rHora["horaCita"] ?>" id="diaAgregado" class="form-control form-control-sm ">
                            </div>
                            <?php
                        }
                    }

                    $tipoConsulta = "SELECT
                                    *
                                      FROM
                                    tbl_tipo_consulta  WHERE idTipoConsulta =" . $_GET["TxtTipoConsulta"] . "";
                    $consulta = mysqli_query($conexion1, $tipoConsulta);
                    $CountConsulta = $con->numRows($tipoConsulta);
                    if ($CountConsulta > 0) {
                        while ($tcon = mysqli_fetch_array($consulta)) {
                            ?>
                            <div class="col-2">
                                <label>Tipo consulta</label>
                                <input type="text" readonly="" id="InicioAgendaConsulta" value="<?php echo $tcon['tipoConsulta'] ?>" class="form-control form-control-sm ">
                                <input type="text" readonly="" id="InicioAgendaIdConsulta" hidden="" name="TxtTipoConsultaAgenda" value="<?php echo $tcon['idTipoConsulta'] ?>" class="form-control form-control-sm ">
                            </div> 
                            <?php
                        }
                    }
                    $medico = "SELECT 
                                    *
                                FROM
                                    users AS u
                                        LEFT JOIN
                                    tbl_horario_atencion_medicos AS h ON h.llaveMedicoHorario = u.id
                                    inner join
                                    tbl_ciudad as c on c.id_ciudad = h.llaveCiudadAtencionMedico
                                 WHERE id =" . $_GET["Txtmedico"] . "";
                    $consultM = mysqli_query($conexion1, $medico);
                    $CountConsultaM = $con->numRows($medico);
                    if ($CountConsultaM > 0) {
                        while ($medi = mysqli_fetch_array($consultM)) {
                            ?>
                            <div class="col-2">
                                <label>Medico</label>
                                <input type="text" readonly="" id="InicioAgendaMedicoId" name="TxtMedicoAgenda" value="<?php echo $medi['id'] ?>"  hidden="" class="form-control form-control-sm ">
                                <input type="text" readonly="" id="InicioAgendaMedico"  value="<?php echo $medi['name'] ?>" class="form-control form-control-sm ">
                            </div>  
                            <div class="col-2"> 
                                <label>Ciudad</label>
                                <input type="text" readonly="" id="InicioAgendaCiudad" value="<?php echo $medi['ciudad'] ?>" class="form-control form-control-sm ">

                            </div>
                            <div class="col-8"> 
                                <label>Direccion</label>
                                <input type="text" readonly="" id="InicioAgendaDireccion" value="<?php echo $medi['direccionConsultorio'] ?>" class="form-control form-control-sm ">
                            </div>
                            <?php
                        }
                    }
                    ?>

                </div>
                <br>
            </div>
        </div>
        <!--/.direct-chat -->
    </div>
    <script>
        $(document).ready(function () {
            var agenda = document.getElementById("divAgendarCita");
            $("#btnLimiarAgenda").on("click", function () {
                agenda.style.display = 'block';
                document.getElementById("InicioAgendaDia").value = "";
                document.getElementById("InicioAgendaHoraId").value = "";
                document.getElementById("InicioAgendaHora").value = "";
                document.getElementById("InicioAgendaConsulta").value = "";
                document.getElementById("InicioAgendaIdConsulta").value = "";
                document.getElementById("InicioAgendaMedicoId").value = "";
                document.getElementById("InicioAgendaMedico").value = "";
                document.getElementById("InicioAgendaCiudad").value = "";
                document.getElementById("InicioAgendaDireccion").value = "";
                $.ajax({
                    type: "GET",
                    url: "../../../dist/js/consulta/consultaInfoMedico.php",
                }).done(function (data) {
                    $("#infoMedico").html(data);
                });
            });
        });
    </script>
    <?php
}
?>