<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="UTF-8">
        <title>Simel</title>
        <link href="/login_style/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="/login_style/css/style.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="/font/css/all.css">

    </head>
    <body>
        <div class="fonto"></div>
        <div style="margin-top: 1%;">
            <img src="/imagenes/piezas/bar-02.png"  class="piezas"/>
        </div>
        <a href="http://www.codess.org.co" target="_blank"><img src="/imagenes/piezas/logo3.png" class="codess" /></a>
        <div id="app">
            <main class="py-4">
                @yield('content')
            </main>
        </div>
        <div style="margin-top: -8%;">
            <a target="_blank" href="https://www.facebook.com/Codessco"><img src="/imagenes/piezas/redes sociales-03.png" alt=""  class="sociales"/></a>
            <a target="_blank" href="https://twitter.com/codessco"><img src="/imagenes/piezas/redes sociales-04.png" alt=""  class="redes" /></a>
            <a target="_blank" href="https://www.linkedin.com/in/codess/"><img src="/imagenes/piezas/redes sociales-05.png" alt=""  class="redes"/></a>
            <a target="_blank" href="https://www.instagram.com/codesscorp/"><img src="/imagenes/piezas/redes sociales-06.png" alt=""  class="redes"/></a>
        </div>

        <script src="resources/jquery/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="resources/login/js/index.js" type="text/javascript"></script>
        <script src="resources/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  
       
    </body>
</html>
