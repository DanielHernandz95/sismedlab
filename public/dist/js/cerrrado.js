$(document).ready(function () {
    $("#validacionRol").ready(function () {
        var rol = $("#validacionRol").val();
        /*!==!==!==!==!==!==Sub estado Calificacion!==!==!==!==!====*/
        var PreCalificacion = $("#PreCerradoMedico").val();
        var calificacion = $("#cerradoMedico").val();
        var ReCalificacion = $("#ReCerradoMedico").val();
        /*!==!==!==!==!==!==estado Calificacion!==!==!==!==!====*/
        var prEstadoCerrado = $("#prEstadoCerrado").val();
        var calEstadoCerrado = $("#calEstadoCerrado").val();
        var reEstadoCerrado = $("#ReEstadoCerrado").val();
//
        var usuarioAsignadoPrecali = $("#usuarioAsignadoPrecali").val();
        var usuarioAsignadoCali = $("#usuarioAsignadoCali").val();
        var usuarioAsignadorecaCali = $("#usuarioAsignadoRecaCali").val();

        if (rol === '12') {

            if (prEstadoCerrado !== null) {
                if (PreCalificacion !== 'LEVANTAR MASIVO' && PreCalificacion !== 'PROMOVER PCL' && PreCalificacion !== 'APERTURA DE RECALIFICACION'
                        && PreCalificacion !== 'SOLICITUD DE EXPEDIENTE' && PreCalificacion !== 'PENDIENTE ARANDA'
                        && PreCalificacion !== 'CAMBIO DE DECRETO' && PreCalificacion !== 'LEVANTAR VISADO'
                        && PreCalificacion !== 'ASIGNADO COMITE CODESS' && PreCalificacion !== 'ASIGNADO COMITE POSITIVA'
                        && PreCalificacion !== 'DEVOLUCION COMITE' && PreCalificacion !== 'CAMBIO DE DECRETO' && prEstadoCerrado !== 'ASIGNADO'
                        && PreCalificacion !== 'SOLICITUD DE ANEXOS') {

                    /*==================PreCalificacion=================*/
                    $(".permisosSelectPre").prop("disabled", "disabled");
                    $(".permisosInputPre").prop("readonly", "readonly");
                    $(".permisosSelectPreObli").prop("disabled", "disabled");
                    $(".permisosInputPreObli").prop("readonly", "readonly");
                    /*==================Botones=================*/
                    /*==================PreCalificacion=================*/
                    $("#bottonDatosPrecalificacion").css('display', 'none');
                }
            }

            if (calEstadoCerrado !== null) {
                if (calificacion !== 'LEVANTAR MASIVO' && calificacion !== 'PROMOVER PCL' && calificacion !== 'APERTURA DE RECALIFICACION'
                        && calificacion !== 'SOLICITUD DE EXPEDIENTE' && calificacion !== 'PENDIENTE ARANDA'
                        && calificacion !== 'CAMBIO DE DECRETO' && calificacion !== 'LEVANTAR VISADO'
                        && calificacion !== 'ASIGNADO COMITE CODESS' && calificacion !== 'ASIGNADO COMITE POSITIVA'
                        && calificacion !== 'DEVOLUCION COMITE' && calificacion !== 'CAMBIO DE DECRETO' && calEstadoCerrado !== 'ASIGNADO'
                        && calificacion !== 'SOLICITUD DE ANEXOS') {

                    /*!==!==!==!==!==!==Basicos!==!==!==!==!====*/
                    $(".permisosSelect").prop("disabled", "disabled");
                    $(".permisosInput").prop("readonly", "readonly");
                    /*!==!==!==!==!==!==Calificacion!==!==!==!==!====*/
                    $(".permisosSelectCaliObli").prop("disabled", "disabled");
                    $(".permisosInputCaliObli").prop("readonly", "readonly");
                    $(".permisosSelectCali").prop("disabled", "disabled");
                    $(".permisosInputCali").prop("readonly", "readonly");
                    /*==================Botones=================*/
                    /*==================Calificacion=================*/
                    $("#permisosBotonCalificacion").css('display', 'none');

                    /*ok*/

                }
            }
            if (reEstadoCerrado !== null) {
                if (ReCalificacion !== 'LEVANTAR MASIVO' && ReCalificacion !== 'PROMOVER PCL' && ReCalificacion !== 'APERTURA DE RECALIFICACION'
                        && ReCalificacion !== 'SOLICITUD DE EXPEDIENTE' && ReCalificacion !== 'PENDIENTE ARANDA'
                        && ReCalificacion !== 'CAMBIO DE DECRETO' && ReCalificacion !== 'LEVANTAR VISADO'
                        && ReCalificacion !== 'ASIGNADO COMITE CODESS' && ReCalificacion !== 'ASIGNADO COMITE POSITIVA'
                        && ReCalificacion !== 'DEVOLUCION COMITE' && ReCalificacion !== 'CAMBIO DE DECRETO' && reEstadoCerrado !== 'ASIGNADO'
                        && ReCalificacion !== 'SOLICITUD DE ANEXOS') {

                    /*==================ReCalificacion=================*/
                    $(".permisosSelectReCaliObli").prop("disabled", "disabled");
                    $(".permisosInputReCaliObli").prop("readonly", "readonly");
                    $(".permisosSelectReCali").prop("disabled", "disabled");
                    $(".permisosInputReCali").prop("readonly", "readonly");
                    /*==================Botones=================*/

                    /*==================ReCalificacion=================*/
                    $("#permisosRecalificacionBotton").css('display', 'none');

                    /*ok*/
                }
            }
        } else if (rol === '13') {

            if (prEstadoCerrado !== null) {
                if (PreCalificacion !== 'LEVANTAR MASIVO' && PreCalificacion !== 'PROMOVER PCL' && PreCalificacion !== 'APERTURA DE RECALIFICACION'
                        && PreCalificacion !== 'SOLICITUD DE EXPEDIENTE' && PreCalificacion !== 'PENDIENTE ARANDA'
                        && PreCalificacion !== 'CAMBIO DE DECRETO' && PreCalificacion !== 'LEVANTAR VISADO'
                        && PreCalificacion !== 'ASIGNADO COMITE CODESS' && PreCalificacion !== 'ASIGNADO COMITE POSITIVA'
                        && PreCalificacion !== 'DEVOLUCION COMITE' && PreCalificacion !== 'CAMBIO DE DECRETO' && prEstadoCerrado !== 'ASIGNADO'
                        && PreCalificacion !== 'SOLICITUD DE ANEXOS') {

                    /*==================PreCalificacion=================*/
                    $(".permisosSelectPre").prop("disabled", "disabled");
                    $(".permisosInputPre").prop("readonly", "readonly");
                    $(".permisosSelectPreObli").prop("disabled", "disabled");
                    $(".permisosInputPreObli").prop("readonly", "readonly");
                    /*==================Botones=================*/
                    /*==================PreCalificacion=================*/
                    $("#bottonDatosPrecalificacion").css('display', 'none');

                    /*ok*/

                }
            }

            if (calEstadoCerrado !== null) {
                if (calificacion !== 'LEVANTAR MASIVO' && calificacion !== 'PROMOVER PCL' && calificacion !== 'APERTURA DE RECALIFICACION'
                        && calificacion !== 'SOLICITUD DE EXPEDIENTE' && calificacion !== 'PENDIENTE ARANDA'
                        && calificacion !== 'CAMBIO DE DECRETO' && calificacion !== 'LEVANTAR VISADO'
                        && calificacion !== 'ASIGNADO COMITE CODESS' && calificacion !== 'ASIGNADO COMITE POSITIVA'
                        && calificacion !== 'DEVOLUCION COMITE' && calificacion !== 'CAMBIO DE DECRETO' && calEstadoCerrado !== 'ASIGNADO'
                        && calificacion !== 'SOLICITUD DE ANEXOS') {

                    /*!==!==!==!==!==!==Calificacion!==!==!==!==!====*/
                    $(".permisosSelectCaliObli").prop("disabled", "disabled");
                    $(".permisosInputCaliObli").prop("readonly", "readonly");
                    $(".permisosSelectCali").prop("disabled", "disabled");
                    $(".permisosInputCali").prop("readonly", "readonly");
                    /*==================Botones=================*/
                    /*==================Calificacion=================*/
                    $("#permisosBotonCalificacion").css('display', 'none');

                    /*ok*/

                }
            }
            if (reEstadoCerrado !== null) {
                if (ReCalificacion !== 'LEVANTAR MASIVO' && ReCalificacion !== 'PROMOVER PCL' && ReCalificacion !== 'APERTURA DE RECALIFICACION'
                        && ReCalificacion !== 'SOLICITUD DE EXPEDIENTE' && ReCalificacion !== 'PENDIENTE ARANDA'
                        && ReCalificacion !== 'CAMBIO DE DECRETO' && ReCalificacion !== 'LEVANTAR VISADO'
                        && ReCalificacion !== 'ASIGNADO COMITE CODESS' && ReCalificacion !== 'ASIGNADO COMITE POSITIVA'
                        && ReCalificacion !== 'DEVOLUCION COMITE' && ReCalificacion !== 'CAMBIO DE DECRETO' && reEstadoCerrado !== 'ASIGNADO'
                        && ReCalificacion !== 'SOLICITUD DE ANEXOS') {

                    /*==================ReCalificacion=================*/
                    $(".permisosSelectReCaliObli").prop("disabled", "disabled");
                    $(".permisosInputReCaliObli").prop("readonly", "readonly");
                    $(".permisosSelectReCali").prop("disabled", "disabled");
                    $(".permisosInputReCali").prop("readonly", "readonly");
                    /*==================Botones=================*/

                    /*==================ReCalificacion=================*/
                    $("#permisosRecalificacionBotton").css('display', 'none');

                    /*ok*/
                }
            }
        } else if (rol === '15') {


            if (prEstadoCerrado !== null) {
                if (PreCalificacion !== 'LEVANTAR MASIVO' && PreCalificacion !== 'PROMOVER PCL' && PreCalificacion !== 'APERTURA DE RECALIFICACION'
                        && PreCalificacion !== 'SOLICITUD DE EXPEDIENTE' && PreCalificacion !== 'PENDIENTE ARANDA'
                        && PreCalificacion !== 'CAMBIO DE DECRETO' && PreCalificacion !== 'LEVANTAR VISADO'
                        && PreCalificacion !== 'ASIGNADO COMITE CODESS' && PreCalificacion !== 'ASIGNADO COMITE POSITIVA'
                        && PreCalificacion !== 'DEVOLUCION COMITE' && PreCalificacion !== 'CAMBIO DE DECRETO' && prEstadoCerrado !== 'ASIGNADO'
                        && PreCalificacion !== 'SOLICITUD DE ANEXOS') {

                    /*==================PreCalificacion=================*/
                    $(".permisosSelectPre").prop("disabled", "disabled");
                    $(".permisosInputPre").prop("readonly", "readonly");
                    $(".permisosSelectPreObli").prop("disabled", "disabled");
                    $(".permisosInputPreObli").prop("readonly", "readonly");
                    /*==================Botones=================*/
                    /*==================PreCalificacion=================*/
                    $("#bottonDatosPrecalificacion").css('display', 'none');

                    /*ok*/

                }
            }

            if (calEstadoCerrado !== null) {
                if (calificacion !== 'LEVANTAR MASIVO' && calificacion !== 'PROMOVER PCL' && calificacion !== 'APERTURA DE RECALIFICACION'
                        && calificacion !== 'SOLICITUD DE EXPEDIENTE' && calificacion !== 'PENDIENTE ARANDA'
                        && calificacion !== 'CAMBIO DE DECRETO' && calificacion !== 'LEVANTAR VISADO'
                        && calificacion !== 'ASIGNADO COMITE CODESS' && calificacion !== 'ASIGNADO COMITE POSITIVA'
                        && calificacion !== 'DEVOLUCION COMITE' && calificacion !== 'CAMBIO DE DECRETO' && calEstadoCerrado !== 'ASIGNADO'
                        && calificacion !== 'SOLICITUD DE ANEXOS') {

                  
                    /*!==!==!==!==!==!==Calificacion!==!==!==!==!====*/
                    $(".permisosSelectCaliObli").prop("disabled", "disabled");
                    $(".permisosInputCaliObli").prop("readonly", "readonly");
                    $(".permisosSelectCali").prop("disabled", "disabled");
                    $(".permisosInputCali").prop("readonly", "readonly");
                    /*==================Botones=================*/
                    /*==================Calificacion=================*/
                    $("#permisosBotonCalificacion").css('display', 'none');

          
                }
            }
            if (reEstadoCerrado !== null) {
                if (ReCalificacion !== 'LEVANTAR MASIVO' && ReCalificacion !== 'PROMOVER PCL' && ReCalificacion !== 'APERTURA DE RECALIFICACION'
                        && ReCalificacion !== 'SOLICITUD DE EXPEDIENTE' && ReCalificacion !== 'PENDIENTE ARANDA'
                        && ReCalificacion !== 'CAMBIO DE DECRETO' && ReCalificacion !== 'LEVANTAR VISADO'
                        && ReCalificacion !== 'ASIGNADO COMITE CODESS' && ReCalificacion !== 'ASIGNADO COMITE POSITIVA'
                        && ReCalificacion !== 'DEVOLUCION COMITE' && ReCalificacion !== 'CAMBIO DE DECRETO' && reEstadoCerrado !== 'ASIGNADO'
                        && ReCalificacion !== 'SOLICITUD DE ANEXOS') {

                    /*==================ReCalificacion=================*/
                    $(".permisosSelectReCaliObli").prop("disabled", "disabled");
                    $(".permisosInputReCaliObli").prop("readonly", "readonly");
                    $(".permisosSelectReCali").prop("disabled", "disabled");
                    $(".permisosInputReCali").prop("readonly", "readonly");
                    /*==================Botones=================*/

                    /*==================ReCalificacion=================*/
                    $("#permisosRecalificacionBotton").css('display', 'none');
//                    /*==================Botones Dx=================*/
//                    $("#permisoAgregarDiagnostico").css('display', 'none');
//                    $("#divBtnadicx").css('display', 'none');
//                    $("#recargar2").css('display', 'none');
//                    $("#eliminar").css('display', 'none');
                    /*ok*/
                }
            }
        }
    });
});


