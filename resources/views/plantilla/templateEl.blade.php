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
        <script src="/dist/js/funsionInsertCie10El.js" type="text/javascript"></script>
        <script src="/plugins/datatables/jquery.dataTables.js"></script>
        <script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
        <!--========================================Agenda  ===================================================-->
        <script src="/agenda/js/moment.min.js" type="text/javascript"></script>
        <script src="/agenda/js/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <script src="/agenda/js/fullcalendar/fullcalendar.js" type="text/javascript"></script>
        <script src="/agenda/js/fullcalendar/locale/es.js" type="text/javascript"></script>
        <script src="/dist/js/validacionesEl.js" type="text/javascript"></script>
        <script src="/js_personalizado/funcionTablaCargue.js" type="text/javascript"></script>
        <script src="/dist/js/toastFunsiones.js" type="text/javascript"></script>
        <script src="/js_personalizado/funcionMiBandeja.js" type="text/javascript"></script>

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
                    ajax: "{{Route('Bandeja_El.getSiniestro')}}",
                    columns: [
                        {data: 'id_elSiniestro', name: 'id_elSiniestro'},
                        {data: 'numeroSiniestro', name: 'numeroSiniestro'},
                        {data: 'entrada', name: 'entrada'},
                        {data: 'covid', name: 'covid'},
                        {data: 'fecha', name: 'fecha'},
                        {data: 'documento', name: 'documento'},
                        {data: 'solicitud', name: 'solicitud'},
                        {data: 'estado_siniestro', name: 'estado_siniestro'},
                        {data: 'tc', name: 'tc'},
                        {data: 'dias', name: 'dias'},
                        {data: 'name', name: 'name'},
                        {data: 'fechaRadicadoArlPositiva', name: 'fechaRadicadoArlPositiva'}

                    ],
                    columnDefs: [{
                            targets: 11,
                            render: function (url2, type, data) {
                                return '<a  class="btn btn-block btn-outline-success btn-sm botones_letras" href="/Siniestro_El/' + data['id_elSiniestro'] + '/edit"><i class="fas fa-edit fa-lg" aria-hidden="true"></i></a>';
                            }
                        }
                    ],
                    "rowCallback": function (row, data) {



                        if (data['entrada'] === "EDESK-GESTOR DOCUMENTAL" && data['covid'] === "SECTOR SALUD - COVID")
                        {
                            /***********se covierte las fechas a numeros ****************/
                            const dateTime1 = Date.now();
                            const timestamp1 = Math.floor(dateTime1 / 1000);
                            /*===============fecha del siniestro===================*/
                            const creacion1 = new Date(data['fechaRadicadoArlPositiva']);
                            const fecha_creacion1 = Math.floor(creacion1 / 1000);
                            /*===============Rango de fechas===================*/
                            var primerRango1 = fecha_creacion1 + 72200; //22 horas
                            var segundoRango1 = fecha_creacion1 + 165600; // 23 horas
                            var tercerRango1 = fecha_creacion1 + 169200; //47 dias habiles

                            /*==========Validacion Rangos ===========*/

                            if (timestamp1 < primerRango1)
                            {
                                $('td:eq(2)', row).css('background-color', '#66BB6A');
                            }
                            if (timestamp1 > primerRango1 && timestamp1 < segundoRango1)
                            {
                                $('td:eq(2)', row).css('background-color', '#FFCA28');
                            }
                            if (timestamp1 > tercerRango1)
                            {
                                $('td:eq(2)', row).css('background-color', '#EF5350');
                            }

                        }//ok

                        if (data['entrada'] === "EDESK-GESTOR DOCUMENTAL" && data['covid'] === "SECTOR SALUD - OTRO")
                        {
                            /***********se covierte las fechas a numeros ****************/
                            const dateTime2 = Date.now();
                            const timestamp2 = Math.floor(dateTime2 / 1000);
                            /*===============fecha del siniestro===================*/
                            const creacion2 = new Date(data['fechaRadicadoArlPositiva']);
                            const fecha_creacion2 = Math.floor(creacion2 / 1000);
                            /*===============Rango de fechas===================*/
                            var primerRango2 = fecha_creacion2 + 172800; //2 dias habiles
                            var segundoRango2 = fecha_creacion2 + 259200; // 3 dias habiles
                            var tercerRango2 = fecha_creacion2 + 345600; //4 dias habiles

                            /*==========Validacion Rangos ===========*/

                            if (timestamp2 < primerRango2)
                            {
                                $('td:eq(2)', row).css('background-color', '#66BB6A');
                            }
                            if (timestamp2 > primerRango2 && timestamp2 < segundoRango2)
                            {
                                $('td:eq(2)', row).css('background-color', '#FFCA28');
                            }
                            if (timestamp2 > tercerRango2)
                            {
                                $('td:eq(2)', row).css('background-color', '#EF5350');
                            }

                        }//ok


                        if (data['entrada'] === "EDESK-GESTOR DOCUMENTAL" && data['covid'] === "OTRO")
                        {
                            /***********se covierte las fechas a numeros ****************/
                            const dateTime3 = Date.now();
                            const timestamp3 = Math.floor(dateTime3 / 1000);
                            /*===============fecha del siniestro===================*/
                            const creacion3 = new Date(data['fechaRadicadoArlPositiva']);
                            const fecha_creacion3 = Math.floor(creacion3 / 1000);
                            /*===============Rango de fechas===================*/
                            var primerRango3 = fecha_creacion3 + 172800; //2 dias habiles
                            var segundoRango3 = fecha_creacion3 + 259200; // 3 dias habiles
                            var tercerRango3 = fecha_creacion3 + 345600; //4 dias habiles

                            /*==========Validacion Rangos ===========*/

                            if (timestamp3 < primerRango3)
                            {
                                $('td:eq(2)', row).css('background-color', '#66BB6A');
                            }
                            if (timestamp3 > primerRango3 && timestamp3 < segundoRango3)
                            {
                                $('td:eq(2)', row).css('background-color', '#FFCA28');
                            }
                            if (timestamp3 > tercerRango3)
                            {
                                $('td:eq(2)', row).css('background-color', '#EF5350');
                            }

                        }//ok




                        if (data['entrada'] === "CORREO" && data['covid'] === "SECTOR SALUD - COVID")
                        {
                            /***********se covierte las fechas a numeros ****************/
                            const dateTime4 = Date.now();
                            const timestamp4 = Math.floor(dateTime4 / 1000);
                            /*===============fecha del siniestro===================*/
                            const creacion4 = new Date(data['fechaRadicadoArlPositiva']);
                            const fecha_creacion4 = Math.floor(creacion4 / 1000);
                            /*===============Rango de fechas===================*/
                            var primerRango4 = fecha_creacion4 + 79200; //22 horas
                            var segundoRango4 = fecha_creacion4 + 259200; // 46 horas
                            var tercerRango4 = fecha_creacion4 + 345600; //47 horas

                            /*==========Validacion Rangos ===========*/

                            if (timestamp4 < primerRango4)
                            {
                                $('td:eq(2)', row).css('background-color', '#66BB6A');
                            }
                            if (timestamp4 > primerRango4 && timestamp4 < segundoRango4)
                            {
                                $('td:eq(2)', row).css('background-color', '#FFCA28');
                            }
                            if (timestamp4 > tercerRango4)
                            {
                                $('td:eq(2)', row).css('background-color', '#EF5350');
                            }

                        }//ok

                        if (data['entrada'] === "CORREO" && data['covid'] === "SECTOR SALUD - OTRO")
                        {
                            /***********se covierte las fechas a numeros ****************/
                            const dateTime5 = Date.now();
                            const timestamp5 = Math.floor(dateTime5 / 1000);
                            /*===============fecha del siniestro===================*/
                            const creacion5 = new Date(data['fechaRadicadoArlPositiva']);
                            const fecha_creacion5 = Math.floor(creacion5 / 1000);
                            /*===============Rango de fechas===================*/
                            var primerRango5 = fecha_creacion5 + 1296000; //15 dias 
                            var segundoRango5 = fecha_creacion5 + 1987200; // 23 dias 
                            var tercerRango5 = fecha_creacion5 + 2073600; //24 dias habiles

                            /*==========Validacion Rangos ===========*/

                            if (timestamp5 < primerRango5)
                            {
                                $('td:eq(2)', row).css('background-color', '#66BB6A');
                            }
                            if (timestamp5 > primerRango5 && timestamp5 < segundoRango5)
                            {
                                $('td:eq(2)', row).css('background-color', '#FFCA28');
                            }
                            if (timestamp5 > tercerRango5)
                            {
                                $('td:eq(2)', row).css('background-color', '#EF5350');
                            }

                        }//ok

                        if (data['entrada'] === "CORREO" && data['covid'] === "OTRO")
                        {
                            /***********se covierte las fechas a numeros ****************/
                            const dateTime6 = Date.now();
                            const timestamp6 = Math.floor(dateTime6 / 1000);
                            /*===============fecha del siniestro===================*/
                            const creacion6 = new Date(data['fechaRadicadoArlPositiva']);
                            const fecha_creacion6 = Math.floor(creacion6 / 1000);
                            /*===============Rango de fechas===================*/
                            var primerRango6 = fecha_creacion6 + 1296000; //15 dias 
                            var segundoRango6 = fecha_creacion6 + 1987200; // 23 dias 
                            var tercerRango6 = fecha_creacion6 + 2073600; //24 dias habiles

                            /*==========Validacion Rangos ===========*/

                            if (timestamp6 < primerRango6)
                            {
                                $('td:eq(2)', row).css('background-color', '#66BB6A');
                            }
                            if (timestamp6 > primerRango6 && timestamp6 < segundoRango6)
                            {
                                $('td:eq(2)', row).css('background-color', '#FFCA28');
                            }
                            if (timestamp6 > tercerRango6)
                            {
                                $('td:eq(2)', row).css('background-color', '#EF5350');
                            }

                        }//ok



                        if (data['estado_siniestro'] === "SOLICITUD DE PRUEBAS")
                        {
                            /***********se covierte las fechas a numeros ****************/
                            const dateTime7 = Date.now();
                            const timestamp7 = Math.floor(dateTime7 / 1000);
                            /*===============fecha del siniestro===================*/
                            const creacion7 = new Date(data['fechaRadicadoArlPositiva']);
                            const fecha_creacion7 = Math.floor(creacion7 / 1000);
                            /*===============Rango de fechas===================*/
                            var primerRango7 = fecha_creacion7 + 1296000; //15 dias 
                            var segundoRango7 = fecha_creacion7 + 2419200; // 16 dias 
                            var tercerRango7 = fecha_creacion7 + 2505600; //29 dias habiles

                            /*========== Validacion Rangos ===========*/

                            if (timestamp7 < primerRango7)
                            {
                                $('td:eq(7)', row).css('background-color', '#66BB6A');
                            }
                            if (timestamp7 > primerRango7 && timestamp7 < segundoRango7)
                            {
                                $('td:eq(7)', row).css('background-color', '#FFCA28');
                            }
                            if (timestamp7 > tercerRango7)
                            {
                                $('td:eq(7)', row).css('background-color', '#EF5350');
                            }

                        }//ok
                        //ok
                        if (data['estado_siniestro'] === "COMUN ADMINISTRATIVO")
                        {
                            /***********se covierte las fechas a numeros ****************/
                            const dateTime8 = Date.now();
                            const timestamp8 = Math.floor(dateTime8 / 1000);
                            /*===============fecha del siniestro===================*/
                            const creacion8 = new Date(data['fechaRadicadoArlPositiva']);
                            const fecha_creacion8 = Math.floor(creacion8 / 1000);
                            /*===============Rango de fechas===================*/
                            var primerRango8 = fecha_creacion8 + 3888000; //45 dias 
                            var segundoRango8 = fecha_creacion8 + 7603200; // 88 dias 
                            var tercerRango8 = fecha_creacion8 + 7689600; //89 dias habiles

                            /*========== Validacion Rangos ===========*/

                            if (timestamp8 < primerRango8)
                            {
                                $('td:eq(7)', row).css('background-color', '#66BB6A');
                            }
                            if (timestamp8 > primerRango8 && timestamp8 < segundoRango8)
                            {
                                $('td:eq(7)', row).css('background-color', '#FFCA28');
                            }
                            if (timestamp8 > tercerRango8)
                            {
                                $('td:eq(7)', row).css('background-color', '#EF5350');
                            }

                        }//ok
                        if (data['estado_siniestro'] === "COMUN ARTICULO 12")
                        {
                            /***********se covierte las fechas a numeros ****************/
                            const dateTime9 = Date.now();
                            const timestamp9 = Math.floor(dateTime9 / 1000);
                            /*===============fecha del siniestro===================*/
                            const creacion9 = new Date(data['fechaRadicadoArlPositiva']);
                            const fecha_creacion9 = Math.floor(creacion9 / 1000);
                            /*===============Rango de fechas===================*/
                            var primerRango9 = fecha_creacion9 + 1296000; //15 dias 
                            var segundoRango9 = fecha_creacion9 + 1987200; // 16 dias 
                            var tercerRango9 = fecha_creacion9 + 2073600; //29 dias habiles

                            /*========== Validacion Rangos ===========*/

                            if (timestamp9 < primerRango9)
                            {
                                $('td:eq(7)', row).css('background-color', '#66BB6A');
                            }
                            if (timestamp9 > primerRango9 && timestamp9 < segundoRango9)
                            {
                                $('td:eq(7)', row).css('background-color', '#FFCA28');
                            }
                            if (timestamp9 > tercerRango9)
                            {
                                $('td:eq(7)', row).css('background-color', '#EF5350');
                            }

                        }

                    }
                }
                );
            });

            /*==========================Pruebas============================*/
            $(document).ready(function () {
                $('#pruebas').DataTable({
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
                    ajax: "{{Route('Pruebas.getPrueba')}}",
                    columns: [
                        {data: 'id_elSiniestro', name: 'id_elSiniestro'},
                        {data: 'numeroSiniestro', name: 'numeroSiniestro'},
                        {data: 'entrada', name: 'entrada'},
                        {data: 'covid', name: 'covid'},
                        {data: 'fecha', name: 'fecha'},
                        {data: 'documento', name: 'documento'},
                        {data: 'solicitud', name: 'solicitud'},
                        {data: 'estado_siniestro', name: 'estado_siniestro'},
                        {data: 'name', name: 'name'},
                        {data: 'fechaRadicadoArlPositiva', name: 'fechaRadicadoArlPositiva'}

                    ],
                    columnDefs: [{
                            targets: 9,
                            render: function (url2, type, data) {
                                return '<a  class="btn btn-block btn-outline-success btn-sm botones_letras" href="/Siniestro_El/' + data['id_elSiniestro'] + '/edit"><i class="fas fa-edit fa-lg" aria-hidden="true"></i></a>';
                            }
                        }
                    ],
                    "rowCallback": function (row, data) {


                        if (data['estado_siniestro'] === "SOLICITUD DE PRUEBAS")
                        {
                            /***********se covierte las fechas a numeros ****************/
                            const dateTime = Date.now();
                            const timestamp = Math.floor(dateTime / 1000);
                            /*===============fecha del siniestro===================*/
                            const creacion = new Date(data['fechaRadicadoArlPositiva']);
                            const fecha_creacion = Math.floor(creacion / 1000);
                            /*===============Rango de fechas===================*/
                            var primerRango = fecha_creacion + 1296000; //15 dias 
                            var segundoRango = fecha_creacion + 1382400; // 16 dias 
                            var tercerRango = fecha_creacion + 2505600; //29 dias habiles

                            /*========== Validacion Rangos ===========*/

                            if (timestamp < primerRango)
                            {
                                $('td:eq(7)', row).css('background-color', '#66BB6A');
                            }
                            if (timestamp > primerRango && timestamp < segundoRango)
                            {
                                $('td:eq(7)', row).css('background-color', '#FFCA28');
                            }
                            if (timestamp > tercerRango)
                            {
                                $('td:eq(7)', row).css('background-color', '#EF5350');
                            }

                        }//ok

                        if (data['estado_siniestro'] === "COMUN ARTICULO 12")
                        {
                            /***********se covierte las fechas a numeros ****************/
                            const dateTime = Date.now();
                            const timestamp = Math.floor(dateTime / 1000);
                            /*===============fecha del siniestro===================*/
                            const creacion = new Date(data['fechaRadicadoArlPositiva']);
                            const fecha_creacion = Math.floor(creacion / 1000);
                            /*===============Rango de fechas===================*/
                            var primerRango = fecha_creacion + 3888000; //45 dias 
                            var segundoRango = fecha_creacion + 3974400; // 46 dias 
                            var tercerRango = fecha_creacion + 7689600; //89 dias habiles

                            /*========== Validacion Rangos ===========*/

                            if (timestamp < primerRango)
                            {
                                $('td:eq(7)', row).css('background-color', '#66BB6A');
                            }
                            if (timestamp > primerRango && timestamp < segundoRango)
                            {
                                $('td:eq(7)', row).css('background-color', '#FFCA28');
                            }
                            if (timestamp > tercerRango)
                            {
                                $('td:eq(7)', row).css('background-color', '#EF5350');
                            }

                        }//ok
                    }
                }
                );
            });

            /*==========================Cuida============================*/
            $(document).ready(function () {
                $('#cuida').DataTable({
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
                    ajax: "{{Route('BandejaCuida.getCuidaUno')}}",
                    columns: [
                        {data: 'id_elSiniestro', name: 'id_elSiniestro'},
                        {data: 'numeroSiniestro', name: 'numeroSiniestro'},
                        {data: 'entrada', name: 'entrada'},
                        {data: 'covid', name: 'covid'},
                        {data: 'fecha', name: 'fecha'},
                        {data: 'documento', name: 'documento'},
                        {data: 'solicitud', name: 'solicitud'},
                        {data: 'fechaRadicadoArlPositiva', name: 'fechaRadicadoArlPositiva'}

                    ],
                    columnDefs: [{
                            targets: 7,
                            render: function (url2, type, data) {
                                return '<a  class="btn btn-block btn-outline-success btn-sm botones_letras" href="/Siniestro_El/' + data['id_elSiniestro'] + '/edit"><i class="fas fa-edit fa-lg" aria-hidden="true"></i></a>';
                            }
                        }
                    ],
                
                }
                );
            });




        </script>
    </body>
</html>
