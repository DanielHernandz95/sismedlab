<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Simel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <link rel="stylesheet" href="/plugins/jqvmap/jqvmap.min.css">
        <link rel="stylesheet" href="/dist/css/adminlte.min.css">
        <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
        <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.css">
        <link href="/date/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css"/>
        <!--============================Agenda================================-->
        <link rel="stylesheet" href="/agenda/css/fullcalendar.css"/>
        <link rel="stylesheet" href="/style_personalizado/style.css"  type="text/css"/>
        <link rel="stylesheet" href="/plugins/toastr/toastr.min.css">
        <link href="/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- Navbar -->
            @include('menu.nav')
            <!-- /.navbar -->
            <!-- Menu Dinamico Base de datos -->            
            @include('menu.menu')
            <!-- /Menu Dinamico Base de datos -->            
            @yield('consulta')



            <footer class="main-footer">
                <strong>Copyright &copy; 2019 <a href="http://www.codess.org.co/">Simel</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 1.2
                </div>
            </footer>
        </div>
        <script src="/plugins/jquery/jquery.min.js"></script>
        <script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="/plugins/sweetalert2/sweetalert2.min.js" type="text/javascript"></script>
        <script src="/plugins/toastr/toastr.min.js" type="text/javascript"></script>
        <script src="/dist/js/validaciones.js" type="text/javascript"></script>
        <script src="/dist/js/empresaForm.js" type="text/javascript"></script>
        <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/plugins/chart.js/Chart.min.js"></script>
        <script src="/plugins/sparklines/sparkline.js"></script>
        <script src="/plugins/jqvmap/jquery.vmap.min.js"></script>
        <script src="/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
        <script src="/plugins/jquery-knob/jquery.knob.min.js"></script>
        <script src="/plugins/moment/moment.min.js"></script>
        <script src="/plugins/daterangepicker/daterangepicker.js"></script>
        <script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <script src="/plugins/summernote/summernote-bs4.min.js"></script>
        <script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <script src="/dist/js/adminlte.js"></script>
        <script src="/dist/js/pages/dashboard.js"></script>
        <script src="/dist/js/demo.js"></script>
        <script src="/date/js/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="/date/locales/bootstrap-datepicker.es.min.js" type="text/javascript"></script>
        <script src="/style_personalizado/fecha.js" type="text/javascript"></script>
        <script src="/style_personalizado/funcionesGerenal.js" type="text/javascript"></script>
        <!--========================================Agenda  ===================================================-->
        <script src="/agenda/js/moment.min.js" type="text/javascript"></script>
        <script src="/agenda/js/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <script src="/agenda/js/fullcalendar/fullcalendar.js" type="text/javascript"></script>
        <script src="/agenda/js/fullcalendar/locale/es.js" type="text/javascript"></script>
        <script >


            /**==========================Mostar y funsiones calendario =============================================*/
            $(document).ready(function () {
                var date = new Date();
                var yyyy = date.getFullYear().toString();
                var mm = (date.getMonth() + 1).toString().length === 1 ? "0" + (date.getMonth() + 1).toString() : (date.getMonth() + 1).toString();
                var dd = (date.getDate()).toString().length === 1 ? "0" + (date.getDate()).toString() : (date.getDate()).toString();
                $('#calendar').fullCalendar({
                    header: {
                        language: 'es',
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,basicWeek,basicDay',
                    },
                    defaultDate: yyyy + "-" + mm + "-" + dd,
                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    selectable: true,
                    selectHelper: true,
                    select: function (start, end) {

                        if (date > end) {
                            Swal.fire({
                                customClass: {
                                    confirmButton: 'btn btn-outline-success btn-sm botones_letras',
                                },
                                buttonsStyling: false,
                                title: 'Oops...',
                                type: 'warning',
                                text: 'No puedes agendar esta fecha!',
                                confirmButtonText: '<i class="fas fa-times-circle"></i> Continuar'

                            });
                            $(document).ready(function () {
                                $('#botonCrearSiniestroPcl').hide();
                            });
                        } else {
                            $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD'));
                            $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                            $('#ModalAdd').modal('show');
                        }
                    },
                    eventRender: function (event, element) {
                        element.bind('dblclick', function () {
                            $('#ModalEdit #id').val(event.id);
                            $('#ModalEdit #title').val(event.title);
                            $('#ModalEdit #color').val(event.color);
                            $('#ModalEdit #start').val(event.start);
                            $('#ModalEdit #ciudad').val(event.ciudad);
                            $('#ModalEdit #direcc').val(event.direcc);
                            $('#ModalEdit #paciente').val(event.paciente);
                            $('#ModalEdit #medico').val(event.medico);
                            $('#ModalEdit #idmedico').val(event.idmedico);

                            const creacion = new Date(event.diaCita);
                            var dia = creacion.getDate();
                            var mesC = creacion.getMonth() + 1;
                            var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                            var mes = meses[creacion.getMonth()]; //El mes en letras
                            var anio = creacion.getFullYear();
                            $('#ModalEdit #diaCita').val(anio + "-" + mesC + "-" + dia);

                            var $appendElem = $("<option value='" + event.idTipoConsulta + "'selected='selected'>" + event.tipoConsulta + "</option>");
                            $appendElem.appendTo('#tipoConsulta');


                            var $appendhora = $("<option value='" + event.idHoraCita + "'selected='selected'>" + event.horaCita + "</option>");
                            //$("#tipoConsulta > option[value='" + event.idHoraCita + "']").attr('selected', 'selected');

                            $appendhora.appendTo('#hora');

                            /**====================Mostar Informacion medico Agendas==========================*/

                            var idmedico = event.idmedico;
                            var idCale = event.id;
                            var diaCita = anio + "-" + mesC + "-" + dia;
                            console.log("idmedico = " + idmedico);
                            console.log("diaCita = " + diaCita);
                            console.log("idCale = " + idCale);
                            $.ajax({
                                type: "GET",
                                url: "../../../dist/js/consulta/consulHorasDispAgenda.php",
                                data: {"TxtIdmedico": idmedico, "TxtDiaCita": diaCita, "TxtIdCale": idCale} // la coma que habia aqui no es necesaria
                            }).done(function (data) {
                                $(".infHoraDisp").html(data);
                            });

                            /*=============Limpiar Select ==============*/
                            $("#ModalEdit").on('hidden.bs.modal', function () {
                                $appendElem.remove();
                                $appendhora.remove();
                            });
                            $('#ModalEdit').modal('show');
                        });
                    },
                    eventDrop: function (event, delta, revertFunc) { // si changement de position
                        edit(event);
                    },
                    eventResize: function (event, dayDelta, minuteDelta, revertFunc) { // si changement de longueur
                        edit(event);
                    },
                    events: [
<?php
foreach ($calendario as $event):

    $start = explode(" ", $event['diaCita']);
    $end = explode(" ", $event['finCita']);
    if ($start[1] == '00:00:00') {
        $start = $start[0];
    } else {
        $start = $event['diaCita'];
    }
    if ($end[1] == '00:00:00') {
        $end = $end[0];
    } else {
        $end = $event['finCita'];
    }
    ?>
                            {
                                id: '<?php echo $event['idcalendario']; ?>',
                                title: '<?php echo "Medico: " . $event['name'] . " - Paciente: " . $event['nombre']; ?>',
                                start: '<?php echo $start; ?>',
                                end: '<?php echo $end; ?>',
                                color: '<?php echo $event['color']; ?>',
                                ciudad: '<?php echo $event['ciudad']; ?>',
                                direcc: '<?php echo $event['direccionConsultorio']; ?>',
                                paciente: '<?php echo $event['nombre']; ?>',
                                medico: '<?php echo $event['name']; ?>',
                                diaCita: '<?php echo $event['diaCita']; ?>',
                                idHoraCita: '<?php echo $event['idHorasCitas']; ?>',
                                horaCita: '<?php echo $event['horaCita']; ?>',
                                idTipoConsulta: '<?php echo $event['idTipoConsulta']; ?>',
                                tipoConsulta: '<?php echo $event['tipoConsulta']; ?>',
                                idmedico: '<?php echo $event['id']; ?>'


                            },
<?php endforeach; ?>
                    ]
                }
                );
            });
        </script>
    </body>
</html>
