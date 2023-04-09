$(document).ready(function () {
    $("#validacionRol").ready(function () {
        var rol = $("#validacionRol").val();
        var usuarioLogiado = $("#usuarioLoginActual").val();
        var usuarioCreador = $("#usuarioCreador").val();
        var usuarioAsignadoPrecali = $("#usuarioAsignadoPrecali").val();
        var usuarioAsignadoCali = $("#usuarioAsignadoCali").val();
        var usuarioAsignadorecaCali = $("#usuarioAsignadoRecaCali").val();


        var bottonDatosBasicosSiniestro = document.getElementById("bottonDatosBasicosSiniestro");
        var bottonAgregarDiag = document.getElementById("permisoAgregarDiagnostico");
        var bottonAgregarSeguimiento = document.getElementById("recargar2");
        var bottonAliminarCie = document.getElementById("eliminar");
        var bottonDatosPrecalificacion = document.getElementById("bottonDatosPrecalificacion");
        var permisosHabilitar = document.getElementById("permisosHabilitar");
        var permisosHabilitarPre = document.getElementById("permisosHabilitarPreca");
        var permisosRecalificacionBotton = document.getElementById("permisosRecalificacionBotton");
        var ocultarCrearAdicion = document.getElementById("ocultarCrearAdicion");
        var divBtnBaAdi = document.getElementById("divdatosBasicosAdi");
        var divBtnadicx = document.getElementById("divBtnadicx");


      if (rol === '12'  && usuarioLogiado !== usuarioAsignadoCali && usuarioLogiado !== usuarioAsignadorecaCali) {

            /*==================Basicos=================*/
            $(".permisosSelect").prop("disabled", "disabled");
            $(".permisosInput").prop("readonly", "readonly");
            /*==================PreCalificacion=================*/
            $(".permisosSelectPre").prop("disabled", "disabled");
            $(".permisosInputPre").prop("readonly", "readonly");
            $(".permisosSelectPreObli").prop("disabled", "disabled");
            $(".permisosInputPreObli").prop("readonly", "readonly");
            /*==================Calificacion=================*/
            $(".permisosSelectCaliObli").prop("disabled", "disabled");
            $(".permisosInputCaliObli").prop("readonly", "readonly");
            $(".permisosSelectCali").prop("disabled", "disabled");
            $(".permisosInputCali").prop("readonly", "readonly");
            /*==================ReCalificacion=================*/
            $(".permisosSelectReCaliObli").prop("disabled", "disabled");
            $(".permisosInputReCaliObli").prop("readonly", "readonly");
            $(".permisosSelectReCali").prop("disabled", "disabled");
            $(".permisosInputReCali").prop("readonly", "readonly");



            /*==================Botones=================*/
            /*==================PreCalificacion=================*/
            $("#bottonDatosPrecalificacion").css('display', 'none');
            /*==================Calificacion=================*/
            $("#permisosBotonCalificacion").css('display', 'none');
            /*==================ReCalificacion=================*/
            $("#permisosRecalificacionBotton").css('display', 'none');

            /*==================Adicion=================*/
            $("#ocultarCrearAdicion").css('display', 'none');
            /*==================deatos Basicos=================*/
            $("#bottonDatosBasicosSiniestro").css('display', 'none');
            $("#divdatosBasicosAdi").css('display', 'none');
            /*==================Botones Dx=================*/
            $("#permisoAgregarDiagnostico").css('display', 'none');
            $("#divBtnadicx").css('display', 'none');
            $("#recargar2").css('display', 'none');
            $("#eliminar").css('display', 'none');
            /*==================Botones habilitar=================*/
            $("#permisosHabilitar").css('display', 'none');
            $("#permisosHabilitarPreca").css('display', 'none');

            /*ok*/


        } else if (rol === '12'  && usuarioLogiado === usuarioAsignadoCali && usuarioLogiado === usuarioAsignadorecaCali) {
            /*==================Basicos=================*/
            $(".permisosSelect").prop("disabled", "disabled");
            $(".permisosInput").prop("readonly", "readonly");
            /*==================PreCalificacion=================*/
            $(".permisosSelectPre").prop("disabled", "disabled");
            $(".permisosInputPre").prop("readonly", "readonly");
            $(".permisosSelectPreObli").prop("disabled", "disabled");
            $(".permisosInputPreObli").prop("readonly", "readonly");
            /*==================Calificacion=================*/
            $(".permisosSelectCaliObli").prop("disabled", "disabled");
            $(".permisosInputCaliObli").prop("readonly", "readonly");
            //$(".permisosSelectCali").prop("disabled", "disabled");
            // $(".permisosInputCali").prop("readonly", "readonly");
            /*==================ReCalificacion=================*/
            $(".permisosSelectReCaliObli").prop("disabled", "disabled");
            $(".permisosInputReCaliObli").prop("readonly", "readonly");
            //  $(".permisosSelectReCali").prop("disabled", "disabled");
            //  $(".permisosInputReCali").prop("readonly", "readonly");


            /*==================Botones=================*/
            /*==================PreCalificacion=================*/
            $("#bottonDatosPrecalificacion").css('display', 'none');
            /*==================Calificacion=================*/
            //$("#permisosBotonCalificacion").css('display', 'none');
            /*==================ReCalificacion=================*/
            //$("#permisosRecalificacionBotton").css('display', 'none');

            /*==================Adicion=================*/
            $("#ocultarCrearAdicion").css('display', 'none');
            /*==================deatos Basicos=================*/
            $("#bottonDatosBasicosSiniestro").css('display', 'none');
            $("#divdatosBasicosAdi").css('display', 'none');
            /*==================Botones Dx=================*/
            //$("#permisoAgregarDiagnostico").css('display', 'none');
            //$("#divBtnadicx").css('display', 'none');
            //$("#recargar2").css('display', 'none');
            //$("#eliminar").css('display', 'none');
            /*==================Botones habilitar=================*/
            $("#permisosHabilitar").css('display', 'none');
            $("#permisosHabilitarPreca").css('display', 'none');


        } else if (rol === '12'  && usuarioLogiado === usuarioAsignadoCali && usuarioLogiado !== usuarioAsignadorecaCali) {
            /*==================Basicos=================*/
            $(".permisosSelect").prop("disabled", "disabled");
            $(".permisosInput").prop("readonly", "readonly");
            /*==================PreCalificacion=================*/
            $(".permisosSelectPre").prop("disabled", "disabled");
            $(".permisosInputPre").prop("readonly", "readonly");
            $(".permisosSelectPreObli").prop("disabled", "disabled");
            $(".permisosInputPreObli").prop("readonly", "readonly");
            /*==================Calificacion=================*/
            $(".permisosSelectCaliObli").prop("disabled", "disabled");
            $(".permisosInputCaliObli").prop("readonly", "readonly");
            // $(".permisosSelectCali").prop("disabled", "disabled");
            // $(".permisosInputCali").prop("readonly", "readonly");
            /*==================ReCalificacion=================*/
            $(".permisosSelectReCaliObli").prop("disabled", "disabled");
            $(".permisosInputReCaliObli").prop("readonly", "readonly");
            $(".permisosSelectReCali").prop("disabled", "disabled");
            $(".permisosInputReCali").prop("readonly", "readonly");


            /*==================Botones=================*/
            /*==================PreCalificacion=================*/
            $("#bottonDatosPrecalificacion").css('display', 'none');
            /*==================Calificacion=================*/
            //$("#permisosBotonCalificacion").css('display', 'none');
            /*==================ReCalificacion=================*/
            $("#permisosRecalificacionBotton").css('display', 'none');
            /*==================Adicion=================*/
            $("#ocultarCrearAdicion").css('display', 'none');
            /*==================deatos Basicos=================*/
            $("#bottonDatosBasicosSiniestro").css('display', 'none');
            $("#divdatosBasicosAdi").css('display', 'none');
            /*==================Botones Dx=================*/
            //$("#permisoAgregarDiagnostico").css('display', 'none');
            //$("#divBtnadicx").css('display', 'none');
            //$("#recargar2").css('display', 'none');
            //$("#eliminar").css('display', 'none');
            /*==================Botones habilitar=================*/
            $("#permisosHabilitar").css('display', 'none');
            $("#permisosHabilitarPreca").css('display', 'none');

            /*ok*/
        } else if (rol === '12'  && usuarioLogiado !== usuarioAsignadoCali && usuarioLogiado === usuarioAsignadorecaCali) {
            /*==================Basicos=================*/
            $(".permisosSelect").prop("disabled", "disabled");
            $(".permisosInput").prop("readonly", "readonly");
            /*==================PreCalificacion=================*/
            $(".permisosSelectPre").prop("disabled", "disabled");
            $(".permisosInputPre").prop("readonly", "readonly");
            $(".permisosSelectPreObli").prop("disabled", "disabled");
            $(".permisosInputPreObli").prop("readonly", "readonly");
            /*==================Calificacion=================*/
            $(".permisosSelectCaliObli").prop("disabled", "disabled");
            $(".permisosInputCaliObli").prop("readonly", "readonly");
            $(".permisosSelectCali").prop("disabled", "disabled");
            $(".permisosInputCali").prop("readonly", "readonly");
            /*==================ReCalificacion=================*/
            $(".permisosSelectReCaliObli").prop("disabled", "disabled");
          $(".permisosInputReCaliObli").prop("readonly", "readonly");
            //$(".permisosSelectReCali").prop("disabled", "disabled");
            //$(".permisosInputReCali").prop("readonly", "readonly");


            /*==================Botones=================*/
            /*==================PreCalificacion=================*/
            $("#bottonDatosPrecalificacion").css('display', 'none');
            /*==================Calificacion=================*/
            $("#permisosBotonCalificacion").css('display', 'none');
            /*==================ReCalificacion=================*/
            //$("#permisosRecalificacionBotton").css('display', 'none');
            /*==================Adicion=================*/
            $("#ocultarCrearAdicion").css('display', 'none');
            /*==================deatos Basicos=================*/
            $("#bottonDatosBasicosSiniestro").css('display', 'none');
            $("#divdatosBasicosAdi").css('display', 'none');
            /*==================Botones Dx=================*/
            //$("#permisoAgregarDiagnostico").css('display', 'none');
            //$("#divBtnadicx").css('display', 'none');
            //$("#recargar2").css('display', 'none');
            //$("#eliminar").css('display', 'none');
            /*==================Botones habilitar=================*/
            $("#permisosHabilitar").css('display', 'none');
            $("#permisosHabilitarPreca").css('display', 'none');

            /*ok*/
        }else if (rol === '12' && usuarioLogiado !== usuarioAsignadorecaCali && usuarioLogiado === usuarioAsignadorecaCali) {
            /*==================Basicos=================*/
            $(".permisosSelect").prop("disabled", "disabled");
            $(".permisosInput").prop("readonly", "readonly");
            /*==================PreCalificacion=================*/
            $(".permisosSelectPre").prop("disabled", "disabled");
            $(".permisosInputPre").prop("readonly", "readonly");
            $(".permisosSelectPreObli").prop("disabled", "disabled");
            $(".permisosInputPreObli").prop("readonly", "readonly");
            /*==================Calificacion=================*/
            $(".permisosSelectCaliObli").prop("disabled", "disabled");
            $(".permisosInputCaliObli").prop("readonly", "readonly");
            $(".permisosSelectCali").prop("disabled", "disabled");
            $(".permisosInputCali").prop("readonly", "readonly");
            /*==================ReCalificacion=================*/
            $(".permisosSelectReCaliObli").prop("disabled", "disabled");
            $(".permisosInputReCaliObli").prop("readonly", "readonly");
            $(".permisosSelectReCali").prop("disabled", "disabled");
            $(".permisosInputReCali").prop("readonly", "readonly");


            /*==================Botones=================*/
            /*==================PreCalificacion=================*/
            $("#bottonDatosPrecalificacion").css('display', 'none');
            /*==================Calificacion=================*/
            $("#permisosBotonCalificacion").css('display', 'none');
            /*==================ReCalificacion=================*/
            //$("#permisosRecalificacionBotton").css('display', 'none');
            /*==================Adicion=================*/
            $("#ocultarCrearAdicion").css('display', 'none');
            /*==================deatos Basicos=================*/
            $("#bottonDatosBasicosSiniestro").css('display', 'none');
            $("#divdatosBasicosAdi").css('display', 'none');
            /*==================Botones Dx=================*/
            //$("#permisoAgregarDiagnostico").css('display', 'none');
            //$("#divBtnadicx").css('display', 'none');
            //$("#recargar2").css('display', 'none');
            //$("#eliminar").css('display', 'none');
            /*==================Botones habilitar=================*/
            $("#permisosHabilitar").css('display', 'none');
            $("#permisosHabilitarPreca").css('display', 'none');

            /*ok*/


        }


        if (rol === '15' && usuarioLogiado !== usuarioAsignadoCali && usuarioLogiado !== usuarioAsignadorecaCali) {

            /*==================Basicos=================*/
            $(".permisosSelect").prop("disabled", "disabled");
            $(".permisosInput").prop("readonly", "readonly");
            /*==================PreCalificacion=================*/
            $(".permisosSelectPre").prop("disabled", "disabled");
            $(".permisosInputPre").prop("readonly", "readonly");
            $(".permisosSelectPreObli").prop("disabled", "disabled");
            $(".permisosInputPreObli").prop("readonly", "readonly");
            /*==================Calificacion=================*/
            $(".permisosSelectCaliObli").prop("disabled", "disabled");
            $(".permisosInputCaliObli").prop("readonly", "readonly");
            $(".permisosSelectCali").prop("disabled", "disabled");
            $(".permisosInputCali").prop("readonly", "readonly");
            /*==================ReCalificacion=================*/
            $(".permisosSelectReCaliObli").prop("disabled", "disabled");
            $(".permisosInputReCaliObli").prop("readonly", "readonly");
            $(".permisosSelectReCali").prop("disabled", "disabled");
            $(".permisosInputReCali").prop("readonly", "readonly");



            /*==================Botones=================*/
            /*==================PreCalificacion=================*/
            $("#bottonDatosPrecalificacion").css('display', 'none');
            /*==================Calificacion=================*/
            $("#permisosBotonCalificacion").css('display', 'none');
            /*==================ReCalificacion=================*/
            $("#permisosRecalificacionBotton").css('display', 'none');

            /*==================Adicion=================*/
            $("#ocultarCrearAdicion").css('display', 'none');
            /*==================deatos Basicos=================*/
            $("#bottonDatosBasicosSiniestro").css('display', 'none');
            $("#divdatosBasicosAdi").css('display', 'none');
            /*==================Botones Dx=================*/
            $("#permisoAgregarDiagnostico").css('display', 'none');
            $("#divBtnadicx").css('display', 'none');
            $("#recargar2").css('display', 'none');
            $("#eliminar").css('display', 'none');
            /*==================Botones habilitar=================*/
            $("#permisosHabilitar").css('display', 'none');
            $("#permisosHabilitarPreca").css('display', 'none');

            /*ok*/


        } else if (rol === '15' && usuarioLogiado === usuarioAsignadoCali && usuarioLogiado === usuarioAsignadorecaCali) {
            /*==================Basicos=================*/
            $(".permisosSelect").prop("disabled", "disabled");
            $(".permisosInput").prop("readonly", "readonly");
            /*==================PreCalificacion=================*/
            $(".permisosSelectPre").prop("disabled", "disabled");
            $(".permisosInputPre").prop("readonly", "readonly");
            $(".permisosSelectPreObli").prop("disabled", "disabled");
            $(".permisosInputPreObli").prop("readonly", "readonly");
            /*==================Calificacion=================*/
            $(".permisosSelectCaliObli").prop("disabled", "disabled");
            $(".permisosInputCaliObli").prop("readonly", "readonly");
            //$(".permisosSelectCali").prop("disabled", "disabled");
            // $(".permisosInputCali").prop("readonly", "readonly");
            /*==================ReCalificacion=================*/
            $(".permisosSelectReCaliObli").prop("disabled", "disabled");
            $(".permisosInputReCaliObli").prop("readonly", "readonly");
            //  $(".permisosSelectReCali").prop("disabled", "disabled");
            //  $(".permisosInputReCali").prop("readonly", "readonly");


            /*==================Botones=================*/
            /*==================PreCalificacion=================*/
            $("#bottonDatosPrecalificacion").css('display', 'none');
            /*==================Calificacion=================*/
            //$("#permisosBotonCalificacion").css('display', 'none');
            /*==================ReCalificacion=================*/
            //$("#permisosRecalificacionBotton").css('display', 'none');

            /*==================Adicion=================*/
            $("#ocultarCrearAdicion").css('display', 'none');
            /*==================deatos Basicos=================*/
            $("#bottonDatosBasicosSiniestro").css('display', 'none');
            $("#divdatosBasicosAdi").css('display', 'none');
            /*==================Botones Dx=================*/
            //$("#permisoAgregarDiagnostico").css('display', 'none');
            //$("#divBtnadicx").css('display', 'none');
            //$("#recargar2").css('display', 'none');
            //$("#eliminar").css('display', 'none');
            /*==================Botones habilitar=================*/
            $("#permisosHabilitar").css('display', 'none');
            $("#permisosHabilitarPreca").css('display', 'none');


        } else if ( rol === '15' && usuarioLogiado === usuarioAsignadoCali && usuarioLogiado !== usuarioAsignadorecaCali) {
            /*==================Basicos=================*/
            $(".permisosSelect").prop("disabled", "disabled");
            $(".permisosInput").prop("readonly", "readonly");
            /*==================PreCalificacion=================*/
            $(".permisosSelectPre").prop("disabled", "disabled");
            $(".permisosInputPre").prop("readonly", "readonly");
            $(".permisosSelectPreObli").prop("disabled", "disabled");
            $(".permisosInputPreObli").prop("readonly", "readonly");
            /*==================Calificacion=================*/
            $(".permisosSelectCaliObli").prop("disabled", "disabled");
            $(".permisosInputCaliObli").prop("readonly", "readonly");
            // $(".permisosSelectCali").prop("disabled", "disabled");
            // $(".permisosInputCali").prop("readonly", "readonly");
            /*==================ReCalificacion=================*/
            $(".permisosSelectReCaliObli").prop("disabled", "disabled");
            $(".permisosInputReCaliObli").prop("readonly", "readonly");
            $(".permisosSelectReCali").prop("disabled", "disabled");
            $(".permisosInputReCali").prop("readonly", "readonly");


            /*==================Botones=================*/
            /*==================PreCalificacion=================*/
            $("#bottonDatosPrecalificacion").css('display', 'none');
            /*==================Calificacion=================*/
            //$("#permisosBotonCalificacion").css('display', 'none');
            /*==================ReCalificacion=================*/
            $("#permisosRecalificacionBotton").css('display', 'none');
            /*==================Adicion=================*/
            $("#ocultarCrearAdicion").css('display', 'none');
            /*==================deatos Basicos=================*/
            $("#bottonDatosBasicosSiniestro").css('display', 'none');
            $("#divdatosBasicosAdi").css('display', 'none');
            /*==================Botones Dx=================*/
            //$("#permisoAgregarDiagnostico").css('display', 'none');
            //$("#divBtnadicx").css('display', 'none');
            //$("#recargar2").css('display', 'none');
            //$("#eliminar").css('display', 'none');
            /*==================Botones habilitar=================*/
            $("#permisosHabilitar").css('display', 'none');
            $("#permisosHabilitarPreca").css('display', 'none');

            /*ok*/
        } else if (rol === '15' && usuarioLogiado !== usuarioAsignadoCali && usuarioLogiado === usuarioAsignadorecaCali) {
            /*==================Basicos=================*/
            $(".permisosSelect").prop("disabled", "disabled");
            $(".permisosInput").prop("readonly", "readonly");
            /*==================PreCalificacion=================*/
            $(".permisosSelectPre").prop("disabled", "disabled");
            $(".permisosInputPre").prop("readonly", "readonly");
            $(".permisosSelectPreObli").prop("disabled", "disabled");
            $(".permisosInputPreObli").prop("readonly", "readonly");
            /*==================Calificacion=================*/
            $(".permisosSelectCaliObli").prop("disabled", "disabled");
            $(".permisosInputCaliObli").prop("readonly", "readonly");
            $(".permisosSelectCali").prop("disabled", "disabled");
            $(".permisosInputCali").prop("readonly", "readonly");
            /*==================ReCalificacion=================*/
            $(".permisosSelectReCaliObli").prop("disabled", "disabled");
          $(".permisosInputReCaliObli").prop("readonly", "readonly");
            //$(".permisosSelectReCali").prop("disabled", "disabled");
            //$(".permisosInputReCali").prop("readonly", "readonly");


            /*==================Botones=================*/
            /*==================PreCalificacion=================*/
            $("#bottonDatosPrecalificacion").css('display', 'none');
            /*==================Calificacion=================*/
            $("#permisosBotonCalificacion").css('display', 'none');
            /*==================ReCalificacion=================*/
            //$("#permisosRecalificacionBotton").css('display', 'none');
            /*==================Adicion=================*/
            $("#ocultarCrearAdicion").css('display', 'none');
            /*==================deatos Basicos=================*/
            $("#bottonDatosBasicosSiniestro").css('display', 'none');
            $("#divdatosBasicosAdi").css('display', 'none');
            /*==================Botones Dx=================*/
            //$("#permisoAgregarDiagnostico").css('display', 'none');
            //$("#divBtnadicx").css('display', 'none');
            //$("#recargar2").css('display', 'none');
            //$("#eliminar").css('display', 'none');
            /*==================Botones habilitar=================*/
            $("#permisosHabilitar").css('display', 'none');
            $("#permisosHabilitarPreca").css('display', 'none');

            /*ok*/
        }else if (rol === '15' && usuarioLogiado !== usuarioAsignadorecaCali && usuarioLogiado === usuarioAsignadorecaCali) {
            /*==================Basicos=================*/
            $(".permisosSelect").prop("disabled", "disabled");
            $(".permisosInput").prop("readonly", "readonly");
            /*==================PreCalificacion=================*/
            $(".permisosSelectPre").prop("disabled", "disabled");
            $(".permisosInputPre").prop("readonly", "readonly");
            $(".permisosSelectPreObli").prop("disabled", "disabled");
            $(".permisosInputPreObli").prop("readonly", "readonly");
            /*==================Calificacion=================*/
            $(".permisosSelectCaliObli").prop("disabled", "disabled");
            $(".permisosInputCaliObli").prop("readonly", "readonly");
            $(".permisosSelectCali").prop("disabled", "disabled");
            $(".permisosInputCali").prop("readonly", "readonly");
            /*==================ReCalificacion=================*/
            $(".permisosSelectReCaliObli").prop("disabled", "disabled");
            $(".permisosInputReCaliObli").prop("readonly", "readonly");
            $(".permisosSelectReCali").prop("disabled", "disabled");
            $(".permisosInputReCali").prop("readonly", "readonly");


            /*==================Botones=================*/
            /*==================PreCalificacion=================*/
            $("#bottonDatosPrecalificacion").css('display', 'none');
            /*==================Calificacion=================*/
            $("#permisosBotonCalificacion").css('display', 'none');
            /*==================ReCalificacion=================*/
            //$("#permisosRecalificacionBotton").css('display', 'none');
            /*==================Adicion=================*/
            $("#ocultarCrearAdicion").css('display', 'none');
            /*==================deatos Basicos=================*/
            $("#bottonDatosBasicosSiniestro").css('display', 'none');
            $("#divdatosBasicosAdi").css('display', 'none');
            /*==================Botones Dx=================*/
            //$("#permisoAgregarDiagnostico").css('display', 'none');
            //$("#divBtnadicx").css('display', 'none');
            //$("#recargar2").css('display', 'none');
            //$("#eliminar").css('display', 'none');
            /*==================Botones habilitar=================*/
            $("#permisosHabilitar").css('display', 'none');
            $("#permisosHabilitarPreca").css('display', 'none');

            /*ok*/


        } else if (rol === '13' && usuarioLogiado !== usuarioCreador && usuarioLogiado !== usuarioAsignadoPrecali && (usuarioLogiado !== usuarioAsignadoCali)) {

            /*==================Basicos=================*/
            $(".permisosSelect").prop("disabled", "disabled");
            $(".permisosInput").prop("readonly", "readonly");
            /*==================PreCalificacion=================*/
            $(".permisosSelectPre").prop("disabled", "disabled");
            $(".permisosInputPre").prop("readonly", "readonly");
            //$(".permisosSelectPreObli").prop("disabled", "disabled");
            $(".permisosInputPreObli").prop("readonly", "readonly");
            /*==================Calificacion=================*/
            // $(".permisosSelectCaliObli").prop("disabled", "disabled");
            $(".permisosInputCaliObli").prop("readonly", "readonly");
            $(".permisosSelectCali").prop("disabled", "disabled");
            $(".permisosInputCali").prop("readonly", "readonly");
            /*==================ReCalificacion=================*/
            // $(".permisosSelectReCaliObli").prop("disabled", "disabled");
            $(".permisosInputReCaliObli").prop("readonly", "readonly");
            $(".permisosSelectReCali").prop("disabled", "disabled");
            $(".permisosInputReCali").prop("readonly", "readonly");


            /*==================Botones=================*/
            /*==================PreCalificacion=================*/
            // $("#bottonDatosPrecalificacion").css('display', 'none');
            /*==================Calificacion=================*/
            // $("#permisosBotonCalificacion").css('display', 'none');
            /*==================ReCalificacion=================*/
            // $("#permisosRecalificacionBotton").css('display', 'none');
            /*==================Adicion=================*/
            $("#ocultarCrearAdicion").css('display', 'none');
            /*==================deatos Basicos=================*/
            $("#bottonDatosBasicosSiniestro").css('display', 'none');
            $("#divdatosBasicosAdi").css('display', 'none');
            /*==================Botones Dx=================*/
            $("#permisoAgregarDiagnostico").css('display', 'none');
            $("#divBtnadicx").css('display', 'none');
            $("#recargar2").css('display', 'none');
            $("#eliminar").css('display', 'none');
            /*==================Botones habilitar=================*/
            $("#permisosHabilitar").css('display', 'none');
            $("#permisosHabilitarPreca").css('display', 'none');

            /*ok*/
        } else if ((rol === '13') && (usuarioLogiado === usuarioCreador) && (usuarioLogiado === usuarioAsignadoPrecali) && (usuarioLogiado !== usuarioAsignadoCali)) {

            /*==================Basicos=================*/
            $(".permisosSelect").prop("disabled", "disabled");
            $(".permisosInput").prop("readonly", "readonly");
            /*==================PreCalificacion=================*/
            $(".permisosSelectPre").prop("disabled", "disabled");
            $(".permisosInputPre").prop("readonly", "readonly");
            //  $(".permisosSelectPreObli").prop("disabled", "disabled");
            $(".permisosInputPreObli").prop("readonly", "readonly");
            /*==================Calificacion=================*/
            //$(".permisosSelectCaliObli").prop("disabled", "disabled");
            $(".permisosInputCaliObli").prop("readonly", "readonly");
            $(".permisosSelectCali").prop("disabled", "disabled");
            $(".permisosInputCali").prop("readonly", "readonly");
            /*==================ReCalificacion=================*/
            // $(".permisosSelectReCaliObli").prop("disabled", "disabled");
            $(".permisosInputReCaliObli").prop("readonly", "readonly");
            $(".permisosSelectReCali").prop("disabled", "disabled");
            $(".permisosInputReCali").prop("readonly", "readonly");


            /*==================Botones=================*/
            /*==================PreCalificacion=================*/
            // $("#bottonDatosPrecalificacion").css('display', 'none');
            /*==================Calificacion=================*/
            //  $("#permisosBotonCalificacion").css('display', 'none');
            /*==================ReCalificacion=================*/
            //   $("#permisosRecalificacionBotton").css('display', 'none');
            /*==================Adicion=================*/
            $("#ocultarCrearAdicion").css('display', 'none');
            /*==================deatos Basicos=================*/
            $("#bottonDatosBasicosSiniestro").css('display', 'none');
            $("#divdatosBasicosAdi").css('display', 'none');
            /*==================Botones Dx=================*/
            $("#permisoAgregarDiagnostico").css('display', 'none');
            $("#divBtnadicx").css('display', 'none');
            $("#recargar2").css('display', 'none');
            $("#eliminar").css('display', 'none');
            /*==================Botones habilitar=================*/
            $("#permisosHabilitar").css('display', 'none');
            $("#permisosHabilitarPreca").css('display', 'none');



        } else if ((rol === '13') && (usuarioLogiado === usuarioCreador) && (usuarioLogiado === usuarioAsignadoPrecali) && (usuarioLogiado === usuarioAsignadoCali)) {

            /*==================Basicos=================*/
            //$(".permisosSelect").prop("disabled", "disabled");
            // $(".permisosInput").prop("readonly", "readonly");

            /*==================PreCalificacion=================*/
            $(".permisosSelectPre").prop("disabled", "disabled");
            $(".permisosInputPre").prop("readonly", "readonly");
            //$(".permisosSelectPreObli").prop("disabled", "disabled");
            //$(".permisosInputPreObli").prop("readonly", "readonly");
            /*==================Calificacion=================*/
            // $(".permisosSelectCaliObli").prop("disabled", "disabled");
            $(".permisosInputCaliObli").prop("readonly", "readonly");
            // $(".permisosSelectCali").prop("disabled", "disabled");
            //$(".permisosInputCali").prop("readonly", "readonly");
            /*==================ReCalificacion=================*/
            // $(".permisosSelectReCaliObli").prop("disabled", "disabled");
            $(".permisosInputReCaliObli").prop("readonly", "readonly");
            $(".permisosSelectReCali").prop("disabled", "disabled");
            $(".permisosInputReCali").prop("readonly", "readonly");


            /*==================Botones=================*/
            /*==================PreCalificacion=================*/
            //$("#bottonDatosPrecalificacion").css('display', 'none');
            /*==================Calificacion=================*/
            // $("#permisosBotonCalificacion").css('display', 'none');
            /*==================ReCalificacion=================*/
            // $("#permisosRecalificacionBotton").css('display', 'none');
            /*==================Adicion=================*/
            // $("#ocultarCrearAdicion").css('display', 'none');
            /*==================deatos Basicos=================*/
            // $("#bottonDatosBasicosSiniestro").css('display', 'none');
            // $("#divdatosBasicosAdi").css('display', 'none');
            /*==================Botones Dx=================*/
            // $("#permisoAgregarDiagnostico").css('display', 'none');
            //$("#divBtnadicx").css('display', 'none');
            // $("#recargar2").css('display', 'none');
            // $("#eliminar").css('display', 'none');
            /*==================Botones habilitar=================*/
            $("#permisosHabilitar").css('display', 'none');
            $("#permisosHabilitarPreca").css('display', 'none');

            /*ok*/

        } else if ((rol === '13') && (usuarioLogiado !== usuarioCreador) && (usuarioLogiado === usuarioAsignadoPrecali) && (usuarioLogiado === usuarioAsignadoCali)) {
            /*==================Basicos=================*/
            $(".permisosSelect").prop("disabled", "disabled");
            $(".permisosInput").prop("readonly", "readonly");
            /*==================PreCalificacion=================*/
            // $(".permisosSelectPre").prop("disabled", "disabled");
            //$(".permisosInputPre").prop("readonly", "readonly");
            //$(".permisosSelectPreObli").prop("disabled", "disabled");
            $(".permisosInputPreObli").prop("readonly", "readonly");
            /*==================Calificacion=================*/
            //$(".permisosSelectCaliObli").prop("disabled", "disabled");
            $(".permisosInputCaliObli").prop("readonly", "readonly");
            // $(".permisosSelectCali").prop("disabled", "disabled");
            // $(".permisosInputCali").prop("readonly", "readonly");
            /*==================ReCalificacion=================*/
            //  $(".permisosSelectReCaliObli").prop("disabled", "disabled");
            $(".permisosInputReCaliObli").prop("readonly", "readonly");
            $(".permisosSelectReCali").prop("disabled", "disabled");
            $(".permisosInputReCali").prop("readonly", "readonly");

            /*==================Botones=================*/
            /*==================PreCalificacion=================*/
            //$("#bottonDatosPrecalificacion").css('display', 'none');
            /*==================Calificacion=================*/
            // $("#permisosBotonCalificacion").css('display', 'none');
            /*==================ReCalificacion=================*/
            // $("#permisosRecalificacionBotton").css('display', 'none');
            /*==================Adicion=================*/
            //$("#ocultarCrearAdicion").css('display', 'none');
            /*==================deatos Basicos=================*/
            $("#bottonDatosBasicosSiniestro").css('display', 'none');
            $("#divdatosBasicosAdi").css('display', 'none');
            /*==================Botones Dx=================*/
            //$("#permisoAgregarDiagnostico").css('display', 'none');
            //  $("#divBtnadicx").css('display', 'none');
            // $("#recargar2").css('display', 'none');
            // $("#eliminar").css('display', 'none');
            /*==================Botones habilitar=================*/
            $("#permisosHabilitar").css('display', 'none');
            $("#permisosHabilitarPreca").css('display', 'none');

            /*ok*/

        } else if ((rol === '13') && (usuarioLogiado !== usuarioCreador) && (usuarioLogiado !== usuarioAsignadoPrecali) && (usuarioLogiado === usuarioAsignadoCali)) {
            /*==================Basicos=================*/
            $(".permisosSelect").prop("disabled", "disabled");
            $(".permisosInput").prop("readonly", "readonly");
            /*==================PreCalificacion=================*/
            $(".permisosSelectPre").prop("disabled", "disabled");
            $(".permisosInputPre").prop("readonly", "readonly");
            //$(".permisosSelectPreObli").prop("disabled", "disabled");
            $(".permisosInputPreObli").prop("readonly", "readonly");
            /*==================Calificacion=================*/
            //$(".permisosSelectCaliObli").prop("disabled", "disabled");
            $(".permisosInputCaliObli").prop("readonly", "readonly");
            // $(".permisosSelectCali").prop("disabled", "disabled");
            //$(".permisosInputCali").prop("readonly", "readonly");
            /*==================ReCalificacion=================*/
            // $(".permisosSelectReCaliObli").prop("disabled", "disabled");
            $(".permisosInputReCaliObli").prop("readonly", "readonly");
            $(".permisosSelectReCali").prop("disabled", "disabled");
            $(".permisosInputReCali").prop("readonly", "readonly");

            /*==================Botones=================*/
            /*==================PreCalificacion=================*/
            //$("#bottonDatosPrecalificacion").css('display', 'none');
            /*==================Calificacion=================*/
            // $("#permisosBotonCalificacion").css('display', 'none');
            /*==================ReCalificacion=================*/
            //$("#permisosRecalificacionBotton").css('display', 'none');
            /*==================Adicion=================*/
            //$("#ocultarCrearAdicion").css('display', 'none');
            /*==================deatos Basicos=================*/
            $("#bottonDatosBasicosSiniestro").css('display', 'none');
            $("#divdatosBasicosAdi").css('display', 'none');
            /*==================Botones Dx=================*/
            //$("#permisoAgregarDiagnostico").css('display', 'none');
            //  $("#divBtnadicx").css('display', 'none');
            // $("#recargar2").css('display', 'none');
            // $("#eliminar").css('display', 'none');
            /*==================Botones habilitar=================*/
            $("#permisosHabilitar").css('display', 'none');
            $("#permisosHabilitarPreca").css('display', 'none');


        } else if ((rol === '13') && (usuarioLogiado === usuarioCreador) && (usuarioLogiado !== usuarioAsignadoPrecali) && (usuarioLogiado !== usuarioAsignadoCali)) {
            /*==================Basicos=================*/
            //  $(".permisosSelect").prop("disabled", "disabled");
            // $(".permisosInput").prop("readonly", "readonly");
            /*==================PreCalificacion=================*/
            $(".permisosSelectPre").prop("disabled", "disabled");
            $(".permisosInputPre").prop("readonly", "readonly");
            //$(".permisosSelectPreObli").prop("disabled", "disabled");
            $(".permisosInputPreObli").prop("readonly", "readonly");
            /*==================Calificacion=================*/
            //  $(".permisosSelectCaliObli").prop("disabled", "disabled");
            $(".permisosInputCaliObli").prop("readonly", "readonly");
            $(".permisosSelectCali").prop("disabled", "disabled");
            $(".permisosInputCali").prop("readonly", "readonly");
            /*==================ReCalificacion=================*/
            //  $(".permisosSelectReCaliObli").prop("disabled", "disabled");
            $(".permisosInputReCaliObli").prop("readonly", "readonly");
            $(".permisosSelectReCali").prop("disabled", "disabled");
            $(".permisosInputReCali").prop("readonly", "readonly");

            /*==================Botones=================*/
            /*==================PreCalificacion=================*/
            //$("#bottonDatosPrecalificacion").css('display', 'none');
            /*==================Calificacion=================*/
            // $("#permisosBotonCalificacion").css('display', 'none');
            /*==================ReCalificacion=================*/
            //   $("#permisosRecalificacionBotton").css('display', 'none');
            /*==================Adicion=================*/
            //$("#ocultarCrearAdicion").css('display', 'none');
            /*==================deatos Basicos=================*/
            //$("#bottonDatosBasicosSiniestro").css('display', 'none');
            $("#divdatosBasicosAdi").css('display', 'none');
            /*==================Botones Dx=================*/
            $("#permisoAgregarDiagnostico").css('display', 'none');
            $("#divBtnadicx").css('display', 'none');
            $("#recargar2").css('display', 'none');
            $("#eliminar").css('display', 'none');
            /*==================Botones habilitar=================*/
            $("#permisosHabilitar").css('display', 'none');
            $("#permisosHabilitarPreca").css('display', 'none');

            /*ok*/
        }

    });
});



$(document).ready(function () {
    $("#rolUsuarioLoginActualinicio").ready(function () {
        rol = $("#rolUsuarioLoginActualinicio").val();
        siniestros = document.getElementById("formularioPcl");

        if (rol === '12') {
            siniestros.style.display = 'none';
        }
    });
});