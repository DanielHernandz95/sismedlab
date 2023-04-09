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

        <script src="/dist/js/validacionesEl.js" type="text/javascript"></script>
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

    </body>
</html>
