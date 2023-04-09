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
        <link rel="stylesheet" href="/date/css/bootstrap-datepicker.min.css"/>
        <link rel="stylesheet" href="/plugins/toastr/toastr.min.css">
        <link rel="stylesheet" href="/plugins/sweetalert2/sweetalert2.min.css"/>
        <link rel="stylesheet" href="/agenda/css/fullcalendar.css"/>
        <link rel="stylesheet" href="/style_personalizado/style.css"/>
    </head>
    <body>

        <div style="margin-top: 0px">
            <font  face="arial" style="font-size: 13px">
            <div style="margin-left: 50px; margin-right: 31px">
                <p>
                    <b>{{$infoSiniestro->codigoCorrespondencia}}</b><br>
                    <br>
                    Señor(a)<br>
                    <b>{{$infoSiniestro->nombre}}</b><br>
                    {{$infoSiniestro->tipo_documento}}: <b>{{$infoSiniestro->documento}}</b><br>
                    <b> {{$infoSiniestro->ciudad}} - {{$infoSiniestro->departamento}}</b> <br>
                </p>
                <p align="center">  <b>ASUNTO: CERTIFICACIÓN DE AFILIACIÓN A RIESGOS LABORALES. </b></p>
                <p align="justify">
                    Al consultar nuestro sistema de información, usted registra con estado inactivo/ 
                    retirado a la afiliación que tuvo al sistema general de riesgos profesionales con ésta Aseguradora.
                </p>
                <p align="justify">
                    Teniendo en cuenta que actualmente cursa solicitud frente al proceso de Medicina Laboral en
                    _____________________________, se solicita confirmar estado actual de afiliación a riesgos laborales.
                </p>
                <p align="justify">
                    Por lo anterior favor diligenciar el formato de certificación que 
                    aparece al final del presente comunicado, siempre y cuando Positiva 
                    Compañía de Seguros S. A., sea la última entidad a la que estuvo afiliado(a) a riesgos laborales.
                </p>
                <p align="center">
                    ------------------------------------------------------------------------------------------------------------------------------
                </p>
                <p align="center">  CERTIFICACIÓN</p>
                <p align="justify">
                    Yo, ____________________________________, identificado como aparece al pie de mi firma; autorizo en forma expresa a Positiva 
                    Compañía de Seguros S. A para acceder, revisar y copiar mi historia clínica y laboral, adjuntar los apartes que corresponden a 
                    estos documentos, incluyendo todos aquellos datos que en ella se registren o lleguen a ser registrados de acuerdo a la ley 1562/12, 
                    Decreto 1352 de 2013, así como también a la historia laboral, en desarrollo del Artículo 34 de la Ley 23 de 1981 y de la resolución
                    1995 de 1999 expedida por el Ministerio de Salud.
                </p>            
                <p align="justify">
                    Así mismo, certifico que desde el momento en que mi último empleador reportó novedad de retiro al sistema general de 
                    riesgos profesionales con Positiva Compañía de Seguros S. A., Informo que la última o actual entidad de afiliación
                    a riesgos laborales es: _______________________ y no he estado afiliado a ninguna otra Administradora de riesgos 
                    laborales.
                </p>              
                <p align="justify">
                    Declaro bajo gravedad de juramento que la información consignada y la documentación aportada en la presente solicitud
                    es verídica, aceptando las consecuencias jurídicas que pueden derivarse de que la información aportada no
                    corresponda a la realidad.
                </p>             
                <p align="justify">Cordialmente</p>
                <div style="margin-left: 415px;">
                    <img style="width: 100px;margin-top: -60px; position:relative;margin-bottom:-30px" src="<?php echo $_SERVER["DOCUMENT_ROOT"] . '/imagenes/imagenesCartas/huella.png'; ?>"/>
                </div> 
                <div style="position: absolute">
                    <p align="justify">                    
                        FIRMA: ……………………………………………………
                    </p>
                    <p align="justify" > 
                        NOMBRE: ……………………………………………………………………………………………………………
                    </p>
                    <p align="justify" > 
                        C.C: ……………………………………………… EMPLEADOR: …………………………………………………
                    </p>
                    <p align="justify" > 
                        DIRECCIÓN PARA NOTIFICACIONES: ……………………………………………………………………………
                    </p>
                    <p align="justify" > 
                        BARRIO:…………………………… MUNICIPIO Y DEPARTAMENTO:…………………………………………
                    </p>
                    <p align="justify" > 
                        CORREO ELECTRÓNICO:……………………………………………………………………………………………      
                    </p>
                    <p align="justify" > 
                        TELÉFONO ACTUAL FIJO: …………………………… CELULAR: ……………………………………………
                    </p>
                    <p align="justify" > 
                        ULTIMA EPS:………………………………ULTIMA AFP:…………………………………………………………
                    </p>
                    <p align="justify" > 
                        <b>Favor hacer entrega de esta información dentro de los 2 días hábiles
                            siguientes al recibo de esta comunicación, en el punto de atención 
                            más cercano de Positiva Compañía de Seguros S.A. adjuntando fotocopia 
                            del documento de identidad, legible por las dos caras                                                  
                        </b> 
                    </p>   
                    <hr>
                </div> 
            </div> 
            </font>
        </div>
    </body>
</html>
