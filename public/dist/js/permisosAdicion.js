$(document).ready(function () {
    $("#validacionRol").ready(function () {
        var rol = $("#validacionRol").val();
        var usuarioLogiado = $("#usuarioLoginActual").val();
        var usuarioCreador = $("#usuarioCreador").val();
        var usuarioAsignadoPrecali = $("#usuarioAsignadoPrecali").val();
        var usuarioAsignadoCali = $("#usuarioAsignadoCali").val();
        var usuarioAsignadorecaCali = $("#usuarioAsignadoRecaCali").val();





        if (rol === '12' || rol === '15' && usuarioLogiado !== usuarioAsignadoCali && usuarioLogiado !== usuarioAsignadorecaCali) {

            /*==================Basicos=================*/
            $(".permisosAdiSelect").prop("disabled", "disabled");
            $(".permisosAdiInput").prop("readonly", "readonly");
            /*==================PreCalificacion=================*/
            $(".permisosAdiSelectPre").prop("disabled", "disabled");
            $(".permisosAdiInputPre").prop("readonly", "readonly");
            $(".permisosAdiSelectPreObli").prop("disabled", "disabled");
            $(".permisosAdiInputPreObli").prop("readonly", "readonly");
            /*==================Calificacion=================*/
            $(".permisosAdiSelectCaliObli").prop("disabled", "disabled");
            $(".permisosAdiInputCaliObli").prop("readonly", "readonly");
            $(".permisosAdiSelectCali").prop("disabled", "disabled");
            $(".permisosAdiInputCali").prop("readonly", "readonly");
            /*==================ReCalificacion=================*/
            $(".permisosAdiSelectReCaliObli").prop("disabled", "disabled");
            $(".permisosAdiInputReCaliObli").prop("readonly", "readonly");
            $(".permisosAdiSelectReCali").prop("disabled", "disabled");
            $(".permisosAdiInputReCali").prop("readonly", "readonly");



            /*==================Botones=================*/
            /*==================PreCalificacion=================*/
            $("#btnAdicionDx").css('display', 'none');
            /*==================Calificacion=================*/
            $("#permisosAdiBotonCalificacion").css('display', 'none');
            /*==================ReCalificacion=================*/
            $("#permisosAdiRecalificacionBotton").css('display', 'none');

            /*==================Adicion=================*/
            $("#ocultarCrearAdicion").css('display', 'none');
            /*==================deatos Basicos=================*/
            $("#bottonDatosBasicosSiniestro").css('display', 'none');
            $("#divdatosBasicosAdi").css('display', 'none');
            /*==================Botones Dx=================*/
            $("#permisoAgregarDiagnosticoAdici").css('display', 'none');
            $("#recargar").css('display', 'none');
            $("#eliminar").css('display', 'none');
            /*==================Botones habilitar=================*/
            $("#permisosAdiHabilitar").css('display', 'none');
            $("#permisosAdiHabilitarPreca").css('display', 'none');

            /*ok*/


        } else if (rol === '12' || rol === '15' && usuarioLogiado === usuarioAsignadoCali && usuarioLogiado === usuarioAsignadorecaCali) {
            /*==================Basicos=================*/
            $(".permisosAdiSelect").prop("disabled", "disabled");
            $(".permisosAdiInput").prop("readonly", "readonly");
            /*==================PreCalificacion=================*/
            $(".permisosAdiSelectPre").prop("disabled", "disabled");
            $(".permisosAdiInputPre").prop("readonly", "readonly");
            $(".permisosAdiSelectPreObli").prop("disabled", "disabled");
            $(".permisosAdiInputPreObli").prop("readonly", "readonly");
            /*==================Calificacion=================*/
            $(".permisosAdiSelectCaliObli").prop("disabled", "disabled");
            $(".permisosAdiInputCaliObli").prop("readonly", "readonly");
            //$(".permisosAdiSelectCali").prop("disabled", "disabled");
            // $(".permisosAdiInputCali").prop("readonly", "readonly");
            /*==================ReCalificacion=================*/
            $(".permisosAdiSelectReCaliObli").prop("disabled", "disabled");
            $(".permisosAdiInputReCaliObli").prop("readonly", "readonly");
            //  $(".permisosAdiSelectReCali").prop("disabled", "disabled");
            //  $(".permisosAdiInputReCali").prop("readonly", "readonly");


            /*==================Botones=================*/
            /*==================PreCalificacion=================*/
            $("#btnAdicionDx").css('display', 'none');
            /*==================Calificacion=================*/
            //$("#permisosAdiBotonCalificacion").css('display', 'none');
            /*==================ReCalificacion=================*/
            //$("#permisosAdiRecalificacionBotton").css('display', 'none');

            /*==================Adicion=================*/
            $("#ocultarCrearAdicion").css('display', 'none');
            /*==================deatos Basicos=================*/
            $("#bottonDatosBasicosSiniestro").css('display', 'none');
            $("#divdatosBasicosAdi").css('display', 'none');
            /*==================Botones Dx=================*/
            //$("#permisoAgregarDiagnosticoAdici").css('display', 'none');
            //           //$("#recargar").css('display', 'none');
            //$("#eliminar").css('display', 'none');
            /*==================Botones habilitar=================*/
            $("#permisosAdiHabilitar").css('display', 'none');
            $("#permisosAdiHabilitarPreca").css('display', 'none');


        } else if (rol === '12' || rol === '15' && usuarioLogiado === usuarioAsignadoCali) {
            /*==================Basicos=================*/
            $(".permisosAdiSelect").prop("disabled", "disabled");
            $(".permisosAdiInput").prop("readonly", "readonly");
            /*==================PreCalificacion=================*/
            $(".permisosAdiSelectPre").prop("disabled", "disabled");
            $(".permisosAdiInputPre").prop("readonly", "readonly");
            $(".permisosAdiSelectPreObli").prop("disabled", "disabled");
            $(".permisosAdiInputPreObli").prop("readonly", "readonly");
            /*==================Calificacion=================*/
            $(".permisosAdiSelectCaliObli").prop("disabled", "disabled");
            $(".permisosAdiInputCaliObli").prop("readonly", "readonly");
            // $(".permisosAdiSelectCali").prop("disabled", "disabled");
            // $(".permisosAdiInputCali").prop("readonly", "readonly");
            /*==================ReCalificacion=================*/
            $(".permisosAdiSelectReCaliObli").prop("disabled", "disabled");
            $(".permisosAdiInputReCaliObli").prop("readonly", "readonly");
            $(".permisosAdiSelectReCali").prop("disabled", "disabled");
            $(".permisosAdiInputReCali").prop("readonly", "readonly");


            /*==================Botones=================*/
            /*==================PreCalificacion=================*/
            $("#btnAdicionDx").css('display', 'none');
            /*==================Calificacion=================*/
            //$("#permisosAdiBotonCalificacion").css('display', 'none');
            /*==================ReCalificacion=================*/
            $("#permisosAdiRecalificacionBotton").css('display', 'none');
            /*==================Adicion=================*/
            $("#ocultarCrearAdicion").css('display', 'none');
            /*==================deatos Basicos=================*/
            $("#bottonDatosBasicosSiniestro").css('display', 'none');
            $("#divdatosBasicosAdi").css('display', 'none');
            /*==================Botones Dx=================*/
            //$("#permisoAgregarDiagnosticoAdici").css('display', 'none');
            //           //$("#recargar").css('display', 'none');
            //$("#eliminar").css('display', 'none');
            /*==================Botones habilitar=================*/
            $("#permisosAdiHabilitar").css('display', 'none');
            $("#permisosAdiHabilitarPreca").css('display', 'none');

            /*ok*/
        } else if (rol === '12' || rol === '15' && usuarioLogiado === usuarioAsignadorecaCali) {
            /*==================Basicos=================*/
            $(".permisosAdiSelect").prop("disabled", "disabled");
            $(".permisosAdiInput").prop("readonly", "readonly");
            /*==================PreCalificacion=================*/
            $(".permisosAdiSelectPre").prop("disabled", "disabled");
            $(".permisosAdiInputPre").prop("readonly", "readonly");
            $(".permisosAdiSelectPreObli").prop("disabled", "disabled");
            $(".permisosAdiInputPreObli").prop("readonly", "readonly");
            /*==================Calificacion=================*/
            $(".permisosAdiSelectCaliObli").prop("disabled", "disabled");
            $(".permisosAdiInputCaliObli").prop("readonly", "readonly");
            $(".permisosAdiSelectCali").prop("disabled", "disabled");
            $(".permisosAdiInputCali").prop("readonly", "readonly");
            /*==================ReCalificacion=================*/
            $(".permisosAdiSelectReCaliObli").prop("disabled", "disabled");
            $(".permisosAdiInputReCaliObli").prop("readonly", "readonly");
            $(".permisosAdiSelectReCali").prop("disabled", "disabled");
            $(".permisosAdiInputReCali").prop("readonly", "readonly");


            /*==================Botones=================*/
            /*==================PreCalificacion=================*/
            $("#btnAdicionDx").css('display', 'none');
            /*==================Calificacion=================*/
            $("#permisosAdiBotonCalificacion").css('display', 'none');
            /*==================ReCalificacion=================*/
            //$("#permisosAdiRecalificacionBotton").css('display', 'none');
            /*==================Adicion=================*/
            $("#ocultarCrearAdicion").css('display', 'none');
            /*==================deatos Basicos=================*/
            $("#bottonDatosBasicosSiniestro").css('display', 'none');
            $("#divdatosBasicosAdi").css('display', 'none');
            /*==================Botones Dx=================*/
            //$("#permisoAgregarDiagnosticoAdici").css('display', 'none');
            //           //$("#recargar").css('display', 'none');
            //$("#eliminar").css('display', 'none');
            /*==================Botones habilitar=================*/
            $("#permisosAdiHabilitar").css('display', 'none');
            $("#permisosAdiHabilitarPreca").css('display', 'none');

            /*ok*/


        } else if (rol === '13' && usuarioLogiado !== usuarioCreador && usuarioLogiado !== usuarioAsignadoPrecali && (usuarioLogiado !== usuarioAsignadoCali) && (usuarioLogiado !== usuarioAsignadorecaCali)) {

            /*==================Basicos=================*/
            $(".permisosAdiSelect").prop("disabled", "disabled");
            $(".permisosAdiInput").prop("readonly", "readonly");
            /*==================PreCalificacion=================*/
            $(".permisosAdiSelectPre").prop("disabled", "disabled");
            $(".permisosAdiInputPre").prop("readonly", "readonly");
            //$(".permisosAdiSelectPreObli").prop("disabled", "disabled");
            $(".permisosAdiInputPreObli").prop("readonly", "readonly");
            /*==================Calificacion=================*/
            //$(".permisosAdiSelectCaliObli").prop("disabled", "disabled");
            $(".permisosAdiInputCaliObli").prop("readonly", "readonly");
            $(".permisosAdiSelectCali").prop("disabled", "disabled");
            $(".permisosAdiInputCali").prop("readonly", "readonly");
            /*==================ReCalificacion=================*/
            // $(".permisosAdiSelectReCaliObli").prop("disabled", "disabled");
            $(".permisosAdiInputReCaliObli").prop("readonly", "readonly");
            $(".permisosAdiSelectReCali").prop("disabled", "disabled");
            $(".permisosAdiInputReCali").prop("readonly", "readonly");


            /*==================Botones=================*/
            /*==================PreCalificacion=================*/
            //$("#btnAdicionDx").css('display', 'none');
            /*==================Calificacion=================*/
            // $("#permisosAdiBotonCalificacion").css('display', 'none');
            /*==================ReCalificacion=================*/
            //$("#permisosAdiRecalificacionBotton").css('display', 'none');
            /*==================Adicion=================*/
            $("#ocultarCrearAdicion").css('display', 'none');
            /*==================deatos Basicos=================*/
            $("#bottonDatosBasicosSiniestro").css('display', 'none');
            $("#divdatosBasicosAdi").css('display', 'none');
            /*==================Botones Dx=================*/
            $("#permisoAgregarDiagnosticoAdici").css('display', 'none');
            $("#recargar").css('display', 'none');
            $("#eliminar").css('display', 'none');
            /*==================Botones habilitar=================*/
            $("#permisosAdiHabilitar").css('display', 'none');
            $("#permisosAdiHabilitarPreca").css('display', 'none');

            /*ok*/
        } else if ((rol === '13') && (usuarioLogiado === usuarioCreador) && (usuarioLogiado === usuarioAsignadoPrecali) && (usuarioLogiado !== usuarioAsignadoCali) && (usuarioLogiado !== usuarioAsignadorecaCali)) {

            /*==================Basicos=================*/
            //  $(".permisosAdiSelect").prop("disabled", "disabled");
            // $(".permisosAdiInput").prop("readonly", "readonly");
            /*==================PreCalificacion=================*/
            // $(".permisosAdiSelectPre").prop("disabled", "disabled");
            //$(".permisosAdiInputPre").prop("readonly", "readonly");
            //$(".permisosAdiSelectPreObli").prop("disabled", "disabled");
            $(".permisosAdiInputPreObli").prop("readonly", "readonly");
            /*==================Calificacion=================*/
            //$(".permisosAdiSelectCaliObli").prop("disabled", "disabled");
            $(".permisosAdiInputCaliObli").prop("readonly", "readonly");
            $(".permisosAdiSelectCali").prop("disabled", "disabled");
            $(".permisosAdiInputCali").prop("readonly", "readonly");
            /*==================ReCalificacion=================*/
            //$(".permisosAdiSelectReCaliObli").prop("disabled", "disabled");
            $(".permisosAdiInputReCaliObli").prop("readonly", "readonly");
            $(".permisosAdiSelectReCali").prop("disabled", "disabled");
            $(".permisosAdiInputReCali").prop("readonly", "readonly");


            /*==================Botones=================*/
            /*==================PreCalificacion=================*/
            //$("#btnAdicionDx").css('display', 'none');
            /*==================Calificacion=================*/
            //$("#permisosAdiBotonCalificacion").css('display', 'none');
            /*==================ReCalificacion=================*/
            // $("#permisosAdiRecalificacionBotton").css('display', 'none');
            /*==================Adicion=================*/
            $("#ocultarCrearAdicion").css('display', 'none');
            /*==================deatos Basicos=================*/
            //$("#bottonDatosBasicosSiniestro").css('display', 'none');
            //$("#btnDatosAdi").css('display', 'none');
            /*==================Botones Dx=================*/
            //$("#permisoAgregarDiagnosticoAdici").css('display', 'none');
            //$("#recargar").css('display', 'none');
            //$("#eliminar").css('display', 'none');
            /*==================Botones habilitar=================*/
            $("#permisosAdiHabilitar").css('display', 'none');
            $("#permisosAdiHabilitarPreca").css('display', 'none');



        } else if ((rol === '13') && (usuarioLogiado === usuarioCreador) && (usuarioLogiado === usuarioAsignadoPrecali) && (usuarioLogiado === usuarioAsignadoCali) && (usuarioLogiado === usuarioAsignadorecaCali)) {

            /*==================Basicos=================*/
            //$(".permisosAdiSelect").prop("disabled", "disabled");
            // $(".permisosAdiInput").prop("readonly", "readonly");

            /*==================PreCalificacion=================*/
            $(".permisosAdiSelectPre").prop("disabled", "disabled");
            $(".permisosAdiInputPre").prop("readonly", "readonly");
            //$(".permisosAdiSelectPreObli").prop("disabled", "disabled");
            //$(".permisosAdiInputPreObli").prop("readonly", "readonly");
            /*==================Calificacion=================*/
            $(".permisosAdiSelectCaliObli").prop("disabled", "disabled");
            $(".permisosAdiInputCaliObli").prop("readonly", "readonly");
            // $(".permisosAdiSelectCali").prop("disabled", "disabled");
            //$(".permisosAdiInputCali").prop("readonly", "readonly");
            /*==================ReCalificacion=================*/
            //$(".permisosAdiSelectReCaliObli").prop("disabled", "disabled");
            $(".permisosAdiInputReCaliObli").prop("readonly", "readonly");
            // $(".permisosAdiSelectReCali").prop("disabled", "disabled");
            // $(".permisosAdiInputReCali").prop("readonly", "readonly");


            /*==================Botones=================*/
            /*==================PreCalificacion=================*/
            //$("#btnAdicionDx").css('display', 'none');
            /*==================Calificacion=================*/
            // $("#permisosAdiBotonCalificacion").css('display', 'none');
            /*==================ReCalificacion=================*/
            //$("#permisosAdiRecalificacionBotton").css('display', 'none');
            /*==================Adicion=================*/
            // $("#ocultarCrearAdicion").css('display', 'none');
            /*==================deatos Basicos=================*/
            // $("#bottonDatosBasicosSiniestro").css('display', 'none');
            // $("#divdatosBasicosAdi").css('display', 'none');
            /*==================Botones Dx=================*/
            // $("#permisoAgregarDiagnosticoAdici").css('display', 'none');
            //           // $("#recargar").css('display', 'none');
            // $("#eliminar").css('display', 'none');
            /*==================Botones habilitar=================*/
            $("#permisosAdiHabilitar").css('display', 'none');
            $("#permisosAdiHabilitarPreca").css('display', 'none');

            /*ok*/

        } else if ((rol === '13') && (usuarioLogiado !== usuarioCreador) && (usuarioLogiado === usuarioAsignadoPrecali) && (usuarioLogiado === usuarioAsignadoCali) && (usuarioLogiado === usuarioAsignadorecaCali)) {
            /*==================Basicos=================*/
            $(".permisosAdiSelect").prop("disabled", "disabled");
            $(".permisosAdiInput").prop("readonly", "readonly");
            /*==================PreCalificacion=================*/
            // $(".permisosAdiSelectPre").prop("disabled", "disabled");
            //$(".permisosAdiInputPre").prop("readonly", "readonly");
            //$(".permisosAdiSelectPreObli").prop("disabled", "disabled");
            $(".permisosAdiInputPreObli").prop("readonly", "readonly");
            /*==================Calificacion=================*/
            //$(".permisosAdiSelectCaliObli").prop("disabled", "disabled");
            $(".permisosAdiInputCaliObli").prop("readonly", "readonly");
            // $(".permisosAdiSelectCali").prop("disabled", "disabled");
            // $(".permisosAdiInputCali").prop("readonly", "readonly");
            /*==================ReCalificacion=================*/
            //$(".permisosAdiSelectReCaliObli").prop("disabled", "disabled");
            $(".permisosAdiInputReCaliObli").prop("readonly", "readonly");
            // $(".permisosAdiSelectReCali").prop("disabled", "disabled");
            //$(".permisosAdiInputReCali").prop("readonly", "readonly");

            /*==================Botones=================*/
            /*==================PreCalificacion=================*/
            //$("#btnAdicionDx").css('display', 'none');
            /*==================Calificacion=================*/
            // $("#permisosAdiBotonCalificacion").css('display', 'none');
            /*==================ReCalificacion=================*/
            //$("#permisosAdiRecalificacionBotton").css('display', 'none');
            /*==================Adicion=================*/
            //$("#ocultarCrearAdicion").css('display', 'none');
            /*==================deatos Basicos=================*/
            $("#bottonDatosBasicosSiniestro").css('display', 'none');
            $("#divdatosBasicosAdi").css('display', 'none');
            /*==================Botones Dx=================*/
            //$("#permisoAgregarDiagnosticoAdici").css('display', 'none');
            //             // $("#recargar").css('display', 'none');
            // $("#eliminar").css('display', 'none');
            /*==================Botones habilitar=================*/
            $("#permisosAdiHabilitar").css('display', 'none');
            $("#permisosAdiHabilitarPreca").css('display', 'none');

            /*ok*/

        } else if ((rol === '13') && (usuarioLogiado !== usuarioCreador) && (usuarioLogiado !== usuarioAsignadoPrecali) && (usuarioLogiado === usuarioAsignadoCali) && (usuarioLogiado !== usuarioAsignadorecaCali)) {
            /*==================Basicos=================*/
            $(".permisosAdiSelect").prop("disabled", "disabled");
            $(".permisosAdiInput").prop("readonly", "readonly");
            /*==================PreCalificacion=================*/
            $(".permisosAdiSelectPre").prop("disabled", "disabled");
            $(".permisosAdiInputPre").prop("readonly", "readonly");
            //$(".permisosAdiSelectPreObli").prop("disabled", "disabled");
            $(".permisosAdiInputPreObli").prop("readonly", "readonly");
            /*==================Calificacion=================*/
            //$(".permisosAdiSelectCaliObli").prop("disabled", "disabled");
            $(".permisosAdiInputCaliObli").prop("readonly", "readonly");
            // $(".permisosAdiSelectCali").prop("disabled", "disabled");
            //$(".permisosAdiInputCali").prop("readonly", "readonly");
            /*==================ReCalificacion=================*/
            //$(".permisosAdiSelectReCaliObli").prop("disabled", "disabled");
            $(".permisosAdiInputReCaliObli").prop("readonly", "readonly");
            $(".permisosAdiSelectReCali").prop("disabled", "disabled");
            $(".permisosAdiInputReCali").prop("readonly", "readonly");

            /*==================Botones=================*/
            /*==================PreCalificacion=================*/
            //$("#btnAdicionDx").css('display', 'none');
            /*==================Calificacion=================*/
            // $("#permisosAdiBotonCalificacion").css('display', 'none');
            /*==================ReCalificacion=================*/
            //$("#permisosAdiRecalificacionBotton").css('display', 'none');
            /*==================Adicion=================*/
            //$("#ocultarCrearAdicion").css('display', 'none');
            /*==================deatos Basicos=================*/
            $("#bottonDatosBasicosSiniestro").css('display', 'none');
            $("#divdatosBasicosAdi").css('display', 'none');
            /*==================Botones Dx=================*/
            //$("#permisoAgregarDiagnosticoAdici").css('display', 'none');
            //             // $("#recargar").css('display', 'none');
            // $("#eliminar").css('display', 'none');
            /*==================Botones habilitar=================*/
            $("#permisosAdiHabilitar").css('display', 'none');
            $("#permisosAdiHabilitarPreca").css('display', 'none');


        } else if ((rol === '13') && (usuarioLogiado === usuarioCreador) && (usuarioLogiado !== usuarioAsignadoPrecali) && (usuarioLogiado !== usuarioAsignadoCali) && (usuarioLogiado !== usuarioAsignadorecaCali)) {
            /*==================Basicos=================*/
            // $(".permisosAdiSelect").prop("disabled", "disabled");
            // $(".permisosAdiInput").prop("readonly", "readonly");
            /*==================PreCalificacion=================*/
            $(".permisosAdiSelectPre").prop("disabled", "disabled");
            $(".permisosAdiInputPre").prop("readonly", "readonly");
            //$(".permisosAdiSelectPreObli").prop("disabled", "disabled");
            $(".permisosAdiInputPreObli").prop("readonly", "readonly");
            /*==================Calificacion=================*/
            //$(".permisosAdiSelectCaliObli").prop("disabled", "disabled");
            $(".permisosAdiInputCaliObli").prop("readonly", "readonly");
            $(".permisosAdiSelectCali").prop("disabled", "disabled");
            $(".permisosAdiInputCali").prop("readonly", "readonly");
            /*==================ReCalificacion=================*/
            // $(".permisosAdiSelectReCaliObli").prop("disabled", "disabled");
            $(".permisosAdiInputReCaliObli").prop("readonly", "readonly");
            $(".permisosAdiSelectReCali").prop("disabled", "disabled");
            $(".permisosAdiInputReCali").prop("readonly", "readonly");

            /*==================Botones=================*/
            /*==================PreCalificacion=================*/
            //$("#btnAdicionDx").css('display', 'none');
            /*==================Calificacion=================*/
            // $("#permisosAdiBotonCalificacion").css('display', 'none');
            /*==================ReCalificacion=================*/
            //$("#permisosAdiRecalificacionBotton").css('display', 'none');
            /*==================Adicion=================*/
            //$("#ocultarCrearAdicion").css('display', 'none');
            /*==================deatos Basicos=================*/
            //$("#bottonDatosBasicosSiniestro").css('display', 'none');
            // $("#divdatosBasicosAdi").css('display', 'none');
            /*==================Botones Dx=================*/
            // $("#permisoAgregarDiagnosticoAdici").css('display', 'none');
            // $("#recargar").css('display', 'none');
            // $("#eliminar").css('display', 'none');
            /*==================Botones habilitar=================*/
            $("#permisosAdiHabilitar").css('display', 'none');
            $("#permisosAdiHabilitarPreca").css('display', 'none');

            /*ok*/
        } else if ((rol === '13') && (usuarioLogiado === usuarioCreador) && (usuarioLogiado !== usuarioAsignadoPrecali) && (usuarioLogiado !== usuarioAsignadoCali) && (usuarioLogiado === usuarioAsignadorecaCali)) {
            /*==================Basicos=================*/
            // $(".permisosAdiSelect").prop("disabled", "disabled");
            // $(".permisosAdiInput").prop("readonly", "readonly");
            /*==================PreCalificacion=================*/
            $(".permisosAdiSelectPre").prop("disabled", "disabled");
            $(".permisosAdiInputPre").prop("readonly", "readonly");
            //$(".permisosAdiSelectPreObli").prop("disabled", "disabled");
            $(".permisosAdiInputPreObli").prop("readonly", "readonly");
            /*==================Calificacion=================*/
            // $(".permisosAdiSelectCaliObli").prop("disabled", "disabled");
            $(".permisosAdiInputCaliObli").prop("readonly", "readonly");
            $(".permisosAdiSelectCali").prop("disabled", "disabled");
            $(".permisosAdiInputCali").prop("readonly", "readonly");
            /*==================ReCalificacion=================*/
            // $(".permisosAdiSelectReCaliObli").prop("disabled", "disabled");
            // $(".permisosAdiInputReCaliObli").prop("readonly", "readonly");
            // $(".permisosAdiSelectReCali").prop("disabled", "disabled");
            // $(".permisosAdiInputReCali").prop("readonly", "readonly");

            /*==================Botones=================*/
            /*==================PreCalificacion=================*/
            //$("#btnAdicionDx").css('display', 'none');
            /*==================Calificacion=================*/
            // $("#permisosAdiBotonCalificacion").css('display', 'none');
            /*==================ReCalificacion=================*/
            // $("#permisosAdiRecalificacionBotton").css('display', 'none');
            /*==================Adicion=================*/
            //$("#ocultarCrearAdicion").css('display', 'none');
            /*==================deatos Basicos=================*/
            //$("#bottonDatosBasicosSiniestro").css('display', 'none');
            $("#divdatosBasicosAdi").css('display', 'none');
            /*==================Botones Dx=================*/
            // $("#permisoAgregarDiagnosticoAdici").css('display', 'none');
            //  $("#recargar").css('display', 'none');
            //  $("#eliminar").css('display', 'none');
            /*==================Botones habilitar=================*/
            $("#permisosAdiHabilitar").css('display', 'none');
            $("#permisosAdiHabilitarPreca").css('display', 'none');


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