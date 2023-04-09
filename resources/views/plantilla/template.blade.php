<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate"><!--Elimina el cache-->

        <title>Simel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <link rel="stylesheet" href="/plugins/jqvmap/jqvmap.min.css">
        <link rel="stylesheet" href="/dist/css/adminlte.min.css">
        <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
        <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.css">
        <link rel="stylesheet" href="/date/css/bootstrap-datepicker.min.css"/>
        <link rel="stylesheet" href="/plugins/toastr/toastr.min.css">
        <link rel="stylesheet" href="/plugins/sweetalert2/sweetalert2.min.css"/>
        <link rel="stylesheet" href="/agenda/css/fullcalendar.css"/>
        <link rel="stylesheet" href="/style_personalizado/style.css"/>
        <script src="/plugins/sweetalert2/sweetalert2.min.js" type="text/javascript"></script>
        <script src="/plugins/toastr/toastr.min.js" type="text/javascript"></script>


        <script src="/Highcharts-7.2.0/code/highcharts.js" type="text/javascript"></script>
        <script src="/Highcharts-7.2.0/code/modules/series-label.js" type="text/javascript"></script>
        <script src="/Highcharts-7.2.0/code/modules/exporting.js" type="text/javascript"></script>
        <script src="/Highcharts-7.2.0/code/highcharts-3d.js" type="text/javascript"></script>
        <script src="/Highcharts-7.2.0/code/modules/cylinder.js" type="text/javascript"></script>
        <script src="/Highcharts-7.2.0/code/modules/accessibility.js" type="text/javascript"></script>
        <script src="/Highcharts-7.2.0/code/modules/export-data.js" type="text/javascript"></script>
        <script src="/Highcharts-7.2.0/code/highcharts-more.js" type="text/javascript"></script>

        <script src="/Highcharts-7.2.0/es-modules/themes/grid-light.js" type="text/javascript"></script>

        <script src="/Highcharts-7.2.0/themes/grid-light.js" type="text/javascript"></script>
        <script src="/Highcharts-7.2.0/code/themes/grid-light.src.js" type="text/javascript"></script>

    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">


            <!-- Navbar -->
            @include('menu.nav')
            <!-- /.navbar -->

            <!-- Menu Dinamico Base de datos -->            
            @include('menu.menu')
            <!-- /Menu Dinamico Base de datos -->            
            @yield('formulario')
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
        <script src="/js_personalizado/jquery-ui.min.js" type="text/javascript"></script>
        <script src="/js_personalizado/funcion_dx.js" type="text/javascript"></script>
        <script src="/dist/js/funsionInsertCie10.js" type="text/javascript"></script>
        <script src="/plugins/datatables/jquery.dataTables.js"></script>
        <script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
        <!--========================================Agenda  ===================================================-->
        <script src="/agenda/js/moment.min.js" type="text/javascript"></script>
        <script src="/agenda/js/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <script src="/agenda/js/fullcalendar/fullcalendar.js" type="text/javascript"></script>
        <script src="/agenda/js/fullcalendar/locale/es.js" type="text/javascript"></script>
        <script src="/dist/js/validaciones.js" type="text/javascript"></script>
        <script src="/js_personalizado/funcionTablaCargue.js" type="text/javascript"></script>
        <script src="/dist/js/toastFunsiones.js" type="text/javascript"></script>
        <script src="/dist/js/permisos.js" type="text/javascript"></script>
        <script src="/dist/js/permisosAdicion.js" type="text/javascript"></script>
        <script src="/js_personalizado/funcionMiBandeja.js" type="text/javascript"></script>
        <script src="/dist/js/cerrrado.js" type="text/javascript"></script>

        <script>
            $(document).ready(function () {
                $('#example').DataTable({
                    serverSide: true,
                    processing: true,
                    language: {
                        "sProcessing": "Procesando...",
                        "sLengthMenu": "Mostrar _MENU_ registros",
                        "sZeroRecords": "No se encontraron resultados",
                        "sEmptyTable": "Ningun dato disponible en esta tabla",
                        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sSearch": "Buscar:",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "Ultimo",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortA v  scending": ": Activar para ordenar la columna de manera ascendente",
                            "sSortDesce nding": ": Activar para ordenar la columna de manera descendente"
                        }
                    },
                    ajax: "{{Route('Bandeja.getSiniestro')}}",
                    columns: [
                        {data: 'idSiniestroPcl', name: 'idSiniestroPcl'},
                        {data: 'idSiniestro', name: 'idSiniestro'},
                        {data: 'entrada', name: 'entrada'},
                        {data: 'quien_solicita', name: 'quien_solicita'},
                        {data: 'fecha', name: 'fecha'},
                        {data: 'documento', name: 'documento'},
                        {data: 'solicitud', name: 'solicitud'},
                        {data: 'tipo_evento', name: 'tipo_evento'},
                        {data: 'estado_siniestro', name: 'estado_siniestro'},
                        {data: 'sub_estados', name: 'sub_estados'},
                        {data: 'p', name: 'p'},
                        {data: 'name', name: 'name'},
                        {data: 'id', name: 'id'}

                    ],
                    columnDefs: [{
                            targets: 12,
                            render: function (url2, type, data) {
                                return '<a  class="btn btn-block btn-outline-success btn-sm botones_letras" href="/Siniestro/' + data['idSiniestroPcl'] + '/edit"><i class="fas fa-edit fa-lg" aria-hidden="true"></i></a>';
                            }
                        }
                    ],
                    "rowCallback": function (row, data) {



                        if (data['entrada'] === "ANS")
                        {
                            /***********se covierte las fechas a numeros ****************/
                            const dateTime = Date.now();
                            const timestamp = Math.floor(dateTime / 1000);
                            /*===============fecha del siniestro===================*/
                            const creacion = new Date(data['fecha']);
                            const fecha_creacion = Math.floor(creacion / 1000);
                            /*===============Rango de fechas===================*/
                            var primerRango = fecha_creacion + 1900800; //16 dias habiles
                            var segundoRango = fecha_creacion + 2678400; //23 dias habiles
                            var tercerRango = fecha_creacion + 2764800; //23 dias habiles

                            /*==========Validacion Rangos ===========*/

                            if (primerRango > timestamp)
                            {
                                $('td:eq(2)', row).css('background-color', '#66BB6A');
                            }
                            if (timestamp > primerRango && timestamp < segundoRango)
                            {
                                $('td:eq(2)', row).css('background-color', '#FFCA28');
                            }
                            if (timestamp > tercerRango)
                            {
                                $('td:eq(2)', row).css('background-color', '#EF5350');
                            }

                        }//ok
                        if (data['entrada'] === "CORREO" && data['quien_solicita'] === "ADICION DX" || data['quien_solicita'] === "INCAPACIDADES")
                        {
                            /***********se covierte las fechas a numeros ****************/
                            const dateTimeCorreo = Date.now();
                            const timestampCorreo = Math.floor(dateTimeCorreo / 1000);
                            /*===============fecha del siniestro===================*/
                            const creacionCorreo = new Date(data['fecha']);
                            const fecha_creacionCorreo = Math.floor(creacionCorreo / 1000);
                            /*===============Rango de fechas===================*/
                            var primerRangoCorreo = fecha_creacionCorreo + 54000; //15 horas Habiles
                            var segundoRangoCorreo = fecha_creacionCorreo + 79200; //22 horas Habiles
                            var tercerRangoCorreo = fecha_creacionCorreo + 82800; //23 horas Habiles

                            /*==========Validacion Rangos ===========*/

                            if (primerRangoCorreo > timestampCorreo)
                            {
                                $('td:eq(2)', row).css('background-color', '#66BB6A');
                            }
                            if (timestampCorreo > primerRangoCorreo && timestampCorreo < segundoRangoCorreo)
                            {
                                $('td:eq(2)', row).css('background-color', '#FFCA28');
                            }
                            if (timestampCorreo > tercerRangoCorreo)
                            {
                                $('td:eq(2)', row).css('background-color', '#EF5350');
                            }

                        }
                        if (data['entrada'] === "CORREO" && data['quien_solicita'] === "RQPERA" || data['quien_solicita'] === "SUCURSALES" || data['quien_solicita'] === "DIGITEX" || data['quien_solicita'] === "PROVEEDORES" || data['quien_solicita'] === "OTROS")
                        {
                            /***********se covierte las fechas a numeros ****************/
                            const dateTimeCorreo1 = Date.now();
                            const timestampCorreo1 = Math.floor(dateTimeCorreo1 / 1000);
                            /*===============fecha del siniestro===================*/
                            const creacionCorreo1 = new Date(data['fecha']);
                            const fecha_creacionCorreo1 = Math.floor(creacionCorreo1 / 1000);
                            /*===============Rango de fechas===================*/
                            var primerRangoCorreo1 = fecha_creacionCorreo1 + 1814400; //15 dias Habiles
                            var segundoRangoCorreo1 = fecha_creacionCorreo1 + 3283200; //28 dias Habiles
                            var tercerRangoCorreo1 = fecha_creacionCorreo1 + 3369600; //29 dias Habiles

                            /*==========Validacion Rangos ===========*/

                            if (primerRangoCorreo1 > timestampCorreo1)
                            {
                                $('td:eq(2)', row).css('background-color', '#66BB6A');
                            }
                            if (timestampCorreo1 > primerRangoCorreo1 && timestampCorreo1 < segundoRangoCorreo1)
                            {
                                $('td:eq(2)', row).css('background-color', '#FFCA28');
                            }
                            if (timestampCorreo1 > tercerRangoCorreo1)
                            {
                                $('td:eq(2)', row).css('background-color', '#EF5350');
                            }

                        }
                        if (data['entrada'] === "PQR")
                        {
                            /***********se covierte las fechas a numeros ****************/
                            const dateTimePqr = Date.now();
                            const timestampPqr = Math.floor(dateTimePqr / 1000);
                            /*===============fecha del siniestro===================*/
                            const creacionPqr = new Date(data['fecha']);
                            const fecha_creacionPqr = Math.floor(creacionPqr / 1000);
                            /*===============Rango de fechas===================*/
                            var primerRangoPqr = fecha_creacionPqr + 86400; //1 dias Habiles
                            var segundoRangoPqr = fecha_creacionPqr + 172800; //2 dias Habiles
                            var tercerRangoPqr = fecha_creacionPqr + 259200; //3 dias Habiles

                            /*==========Validacion Rangos ===========*/

                            if (primerRangoPqr > timestampPqr)
                            {
                                $('td:eq(2)', row).css('background-color', '#66BB6A');
                            }
                            if (timestampPqr > primerRangoPqr && timestampPqr < segundoRangoPqr)
                            {
                                $('td:eq(2)', row).css('background-color', '#FFCA28');
                            }
                            if (timestampPqr > tercerRangoPqr)
                            {
                                $('td:eq(2)', row).css('background-color', '#EF5350');
                            }

                        }//ok
                        if (data['entrada'] === "PROYECTO INNOVACION DE PCL" && data['quien_solicita'] === "CASA MATRIZ - CASOS LEVES")
                        {
                            /***********se covierte las fechas a numeros ****************/
                            const dateTimeProyec = Date.now();
                            const timestampProyec = Math.floor(dateTimeProyec / 1000);
                            /*===============fecha del siniestro===================*/
                            const creacionProyec = new Date(data['fecha']);
                            const fecha_creacionProyec = Math.floor(creacionProyec / 1000);
                            /*===============Rango de fechas===================*/
                            var primerRangoProyec = fecha_creacionProyec + 1900800; //16 dias Habiles
                            var segundoRangoProyec = fecha_creacionProyec + 2678400; //23 dias Habiles
                            var tercerRangoProyec = fecha_creacionProyec + 2764800; //24 dias Habiles

                            /*==========Validacion Rangos ===========*/

                            if (primerRangoProyec > timestampProyec)
                            {
                                $('td:eq(2)', row).css('background-color', '#66BB6A');
                            }
                            if (timestampProyec > primerRangoProyec && timestampProyec < segundoRangoProyec)
                            {
                                $('td:eq(2)', row).css('background-color', '#FFCA28');
                            }
                            if (timestampProyec > tercerRangoProyec)
                            {
                                $('td:eq(2)', row).css('background-color', '#EF5350');
                            }

                        }//ok

                        if (data['entrada'] === "PROYECTO INNOVACION DE PCL" && data['quien_solicita'] === "CASA MATRIZ - CASOS SEVEROS Y GRAVES")
                        {
                            /***********se covierte las fechas a numeros ****************/
                            const dateTimeProyec = Date.now();
                            const timestampProyec = Math.floor(dateTimeProyec / 1000);
                            /*===============fecha del siniestro===================*/
                            const creacionProyec = new Date(data['fecha']);
                            const fecha_creacionProyec = Math.floor(creacionProyec / 1000);
                            /*===============Rango de fechas===================*/
                            var primerRangoProyec = fecha_creacionProyec + 43200; //5 dias Habiles
                            var segundoRangoProyec = fecha_creacionProyec + 1296000; //13 dias Habiles
                            var tercerRangoProyec = fecha_creacionProyec + 2160000; //14 dias Habiles

                            /*==========Validacion Rangos ===========*/

                            if (primerRangoProyec > timestampProyec)
                            {
                                $('td:eq(2)', row).css('background-color', '#66BB6A');
                            }
                            if (timestampProyec > primerRangoProyec && timestampProyec < segundoRangoProyec)
                            {
                                $('td:eq(2)', row).css('background-color', '#FFCA28');
                            }
                            if (timestampProyec > tercerRangoProyec)
                            {
                                $('td:eq(2)', row).css('background-color', '#EF5350');
                            }

                        }//ok

                    }


                }
                );
            });












            $(document).ready(function () {
                $('#Cartas').DataTable({
                    serverSide: true,
                    processing: true,
                    language: {
                        "sProcessing": "Procesando...",
                        "sLengthMenu": "Mostrar _MENU_ registros",
                        "sZeroRecords": "No se encontraron resultados",
                        "sEmptyTable": "Ningun dato disponible en esta tabla",
                        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sSearch": "Buscar:",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "Ultimo",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortA v  scending": ": Activar para ordenar la columna de manera ascendente",
                            "sSortDesce nding": ": Activar para ordenar la columna de manera descendente"
                        }
                    },
                    ajax: "{{Route('SolicitudDocumentos.getCartas')}}",
                    columns: [
                        {data: 'idSiniestroPcl', name: 'idSiniestroPcl'},
                        {data: 'idSiniestro', name: 'idSiniestro'},
                        {data: 'entrada', name: 'entrada'},
                        {data: 'fecha', name: 'fecha'},
                        {data: 'documento', name: 'documento'},
                        {data: 'solicitud', name: 'solicitud'},
                        {data: 'tipo_evento', name: 'tipo_evento'},
                        {data: 'estado_siniestro', name: 'estado_siniestro'},
                        {data: 'sub_estados', name: 'sub_estados'},
                        {data: 'p', name: 'p'},
                        {data: 'name', name: 'name'},
                        {data: 'id', name: 'id'}

                    ],
                    columnDefs: [{
                            targets: 11,
                            render: function (url2, type, data) {
                                return '<a  class="btn btn-block btn-outline-success btn-sm botones_letras" href="/Siniestro/' + data['idSiniestroPcl'] + '/edit"><i class="fas fa-edit fa-lg" aria-hidden="true"></i></a>';
                            }
                        },
                        {
                            targets: 12,
                            render: function (url2, type, data) {
                                if (data['estado_siniestro'] === 'NEGACION DE RECALIFICACION') {
                                    return '<a target="_blank" class="btn btn-block btn-outline-danger btn-sm botones_letras" href="/CartaNegacion/' + data['idSiniestroPcl'] + '/edit"><i class="fas fa-file-pdf fa-lg" aria-hidden="true"></i></a>';
                                } else if (data['estado_siniestro'] === 'TRAMITE ADMINISTRATIVO' && data['sub_estados'] === 'CERTIFICACION AFILIACION ULTIMA ARL') {
                                    return '<a target="_blank" class="btn btn-block btn-outline-danger btn-sm botones_letras" href="/UltimaArl/' + data['idSiniestroPcl'] + '/edit"><i class="fas fa-file-pdf fa-lg" aria-hidden="true"></i></a>';
                                } else {
                                    return '';

                                }
                            }
                        }

                    ]
                });
            });
            $(document).ready(function () {
                $('#tramiteAdmin').DataTable({
                    serverSide: true,
                    processing: true,
                    language: {
                        "sProcessing": "Procesando...",
                        "sLengthMenu": "Mostrar _MENU_ registros",
                        "sZeroRecords": "No se encontraron resultados",
                        "sEmptyTable": "Ningun dato disponible en esta tabla",
                        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sSearch": "Buscar:",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "Ultimo",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortA v  scending": ": Activar para ordenar la columna de manera ascendente",
                            "sSortDesce nding": ": Activar para ordenar la columna de manera descendente"
                        }
                    },
                    ajax: "{{Route('TramiteAdministrativo.getTramite')}}",
                    columns: [
                        {data: 'idSiniestroPcl', name: 'idSiniestroPcl'},
                        {data: 'idSiniestro', name: 'idSiniestro'},
                        {data: 'entrada', name: 'entrada'},
                        {data: 'fecha', name: 'fecha'},
                        {data: 'documento', name: 'documento'},
                        {data: 'solicitud', name: 'solicitud'},
                        {data: 'tipo_evento', name: 'tipo_evento'},
                        {data: 'estado_siniestro', name: 'estado_siniestro'},
                        {data: 'sub_estados', name: 'sub_estados'},
                        {data: 'p', name: 'p'},
                        {data: 'name', name: 'name'},
                        {data: 'id', name: 'id'}

                    ],
                    columnDefs: [{
                            targets: 11,
                            render: function (url2, type, data) {
                                return '<a  class="btn btn-block btn-outline-success btn-sm botones_letras" href="/Siniestro/' + data['idSiniestroPcl'] + '/edit"><i class="fas fa-edit fa-lg" aria-hidden="true"></i></a>';
                            }
                        }
                    ]
                });
            });

        </script>


    </body>
</html>
