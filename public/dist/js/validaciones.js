$.widget.bridge('uibutton', $.ui.button);
/**--------------------------Comprobar Afiliado----------------------------------------------*/
function comprobarUsuario() {
    $("#loaderIcon").show();
    jQuery.ajax({
        url: "../../../dist/js/consulta/consultaAfiliado.php",
        data: 'documento=' + $("#documento").val(),
        type: "POST",
        success: function (data) {
            $('#registros').show();
            $("#estadousuario").html(data);
            $("#loaderIcon").hide();
            $('#formularioPcl').hide();

        },
        error: function () {
        }
    });

    jQuery.ajax({
        url: "../../../dist/js/consulta/consultaAfiliadoDatosBasicos.php",
        data: 'documento=' + $("#documento").val(),
        type: "POST",
        success: function (data) {
            $('#formularioBasicoAfiliado').hide();
            $("#formularioBasicoAfiliadoLleno").html(data);
        },
        error: function () {
        }
    });



}

function comprobarSiniestro() {
    jQuery.ajax({
        url: "../../../dist/js/consulta/siniestroExiste.php",
        data: 'siniestroExis=' + $("#siniestroExis").val(),
        type: "POST",
        success: function (data) {
            $("#existeSiniestro").html(data);

        },
        error: function () {
        }
    });
}

/**--------------------------Comprobar Empresa----------------------------------------------*/
function comprobarEmpresa() {
    jQuery.ajax({
        url: "../../../dist/js/consulta/consultaEmpresa.php",
        data: 'idEmpleador=' + $("#idEmpleador").val(),
        type: "POST",
        success: function (data) {
            $("#empresaSiExiste").html(data);
        },
        error: function () {}
    });
}
/*=============================Cargar Empresa Gestion Siniestro PCL===========================================**/
$(document).ready(function () {
    $(".idSiniestroGestion").ready(function () {
        jQuery.ajax({
            url: "../../../dist/js/consulta/consultaEmpresa.php",
            data: 'idEmpleador=' + $("#idEmpleador").val(),
            type: "POST",
            success: function (data) {
                $("#empresaSiExiste").html(data);
                $("#empresaSiExisteAdicion").html(data);
            },
            error: function () {}
        });
    });
});

$(document).ready(function () {
    $(".idSiniestroGestion").change(function () {
        jQuery.ajax({
            url: "../../../dist/js/consulta/consultaEmpresa.php",
            data: 'idEmpleador=' + $("#idEmpleador").val(),
            type: "POST",
            success: function (data) {
                $("#empresaSiExiste").html(data);
            },
            error: function () {}
        });
    });
});





/*=============================FIN Cargar Empresa Gestion Siniestro PCL===========================================**/



/**--------------------------Comprobar Empresa----------------------------------------------*/
function comprobarNirRepetidos() {
    jQuery.ajax({
        url: "../../../dist/js/consulta/consultaEmpresaNitRepetidos.php",
        data: 'nitRepetidos=' + $("#nitRepetidos").val(),
        type: "POST",
        success: function (data) {
            $("#empresasMasPorNit").html(data);
        },
        error: function () {}
    });
}

function showContent() {
    element = document.getElementById("requiValo");
    profesional = document.getElementById("requiereProfesional");
    requiereValoracion = document.getElementById("requiereValoracion");
    medico = document.getElementById("requiereMedico");
    medico.style.display = 'none';
    element.style.display = 'none';
    profesional.style.display = 'block';
    $("#medico").removeAttr("required");
    $("#medico").prop("disabled", "disabled");
    requiereValoracion.style.display = 'none';
    $("#fechaContacto").removeAttr("required");
    $("#subEstadoCita").removeAttr("required");
    $("#seguimientotext").removeAttr("required");
    $('#requiereValoracionSi').removeClass('active');
    $('#requiereValoracionNo').removeClass('active');

    $("#profesional").prop("required", "required");
    $("#profesional").removeAttr("disabled");

}
function noneContent() {
    element = document.getElementById("requiValo");
    profesional = document.getElementById("requiereProfesional");
    element.style.display = 'block';
    profesional.style.display = 'none';
    $("#medico").removeAttr("required");
    $("#profesional").removeAttr("required");
    $("#medico").prop("disabled", "disabled");
    $("#profesional").prop("disabled", "disabled");

}
/**========================editar REquiere Valoracion*/

function showEditPreCali() {
    element = document.getElementById("requiereMedicoValoracion");
    element.style.display = 'none';
    $('#requiereValoracionSi').removeClass('active');
    $('#requiereValoracionNo').removeClass('active');
}
function noneEditPreCali() {
    element = document.getElementById("requiereMedicoValoracion");
    element.style.display = 'block';
    $("#requiereValoracionSi").prop("required", "required");
    $("#requiereValoracionNo").prop("required", "required");

}



function showValoracion() {
    element2 = document.getElementById("requiereValoracion");
    medico = document.getElementById("requiereMedico");
    element2.style.display = 'block';
    medico.style.display = 'none';
    $("#fechaContacto").prop("required", "required");
    $("#subEstadoCita").prop("required", "required");
    $("#seguimientotext").prop("required", "required");
    $("#medico").removeAttr("required");
    $("#profesional").removeAttr("required");
    $("#profesional").prop("disabled", "disabled");
    $("#medico").prop("disabled", "disabled");
    $("#permisoRequiValoracion").prop("required", "required");


}
function noneValoracion() {
    element2 = document.getElementById("requiereValoracion");
    medico = document.getElementById("requiereMedico");
    element2.style.display = 'none';
    medico.style.display = 'block';
    $("#subEstadoCita").removeAttr("required");
    $("#seguimientotext").removeAttr("required");
    $("#fechaContacto").removeAttr("required");
    $("#permisoRequiValoracion").removeAttr("required");
    $("#medico").prop("required", "required");
    $("#medico").removeAttr("disabled");
    $("#profesional").removeAttr("required");
    $("#profesional").prop("disabled", "disabled");
}


/*=============================mostar opcion PreCalirficacion===========================================**/
$(document).ready(function () {
    $("#requierePreCali").ready(function () {
        var requiere = $("#requierePreCali").val();
        var profesional = document.getElementById("requierePrecalificacion");

        if (requiere === 'SI') {
            $("#requierePreCalificacionSi").addClass("active");
            profesional.style.display = 'block';
        }
        if (requiere === 'NO') {
            $("#requierePreCalificacionNo").addClass("active");
            profesional.style.display = 'block';

        }

    });
});

/*=============================activar Botones valoracion===========================================**/
$(document).ready(function () {
    $("#reValoPrese").ready(function () {
        var requiere = $("#reValoPrese").val();
        var medico = document.getElementById("requiereMedicoValoracion");

        if (requiere === 'SI') {
            $("#requiereValoracionSi").addClass("active");
            medico.style.display = 'block';
        }
        if (requiere === 'NO') {
            $("#requiereValoracionNo").addClass("active");
            medico.style.display = 'block';
        }

    });
});


/**==========================Llama la lista Quien SOlicita==============================================*/
$(document).ready(function () {
    $(".valorEntrada select").change(function () {
        var form_data1 = {
            is_ajax: 1,
            id_entrada: +$(".valorEntrada select").val()
        };
        $.ajax({
            type: "POST",
            url: "../../../../../dist/js/listarPcl/listaQuienSolicita.php",
            data: form_data1,
            success: function (response)
            {
                $('.queinSolicitaLista select').html(response).fadeIn();
            }
        });
    });

    /**==========================Llama la lista Quien SOlicita==============================================*/
    $(".valorEntrada select").ready(function () {
        $.ajax({
            url: "../../../../../dist/js/listarPcl/listaQuienSolicita.php",
            success: function (response)
            {
                $('.queinSolicitaLista select').html(response).fadeIn();
            }
        });
    });

});


/**==========================Llama la lista Tipo Solicitud==============================================*/
$(document).ready(function () {
    $(".valorEntrada select").change(function () {
        var form_data1 = {
            is_ajax: 1,
            id_entrada: +$(".valorEntrada select").val()
        };
        $.ajax({
            type: "POST",
            url: "../../../../../dist/js/listarPcl/listaTipoSolicitud.php",
            data: form_data1,
            success: function (response)
            {
                $('.tipoSolicitudLista select').html(response).fadeIn();
            }
        });
    });
    /**==========================Llama la lista Tipo Solicitud==============================================*/
    $(".valorEntrada select").ready(function () {
        $.ajax({
            url: "../../../../../dist/js/listarPcl/listaTipoSolicitud.php",
            success: function (response)
            {
                $('.tipoSolicitudLista select').html(response).fadeIn();
            }
        });
    });

});

/**==========================Llama la lista Quien SOlicita==============================================*/
$(document).ready(function () {
    $(".valorEntrada4 select").ready(function () {
        var form_data1 = {
            is_ajax: 1,
            id_entrada: +$(".valorEntrada4 select").val()
        };
        $.ajax({
            type: "POST",
            url: "../../../../../dist/js/listarPcl/listaQuienSolicita.php",
            data: form_data1,
            success: function (response)
            {
                $('.queinSolicitaLista2 select').html(response).fadeIn();
            }
        });
    });
});


/**==========================Llama la lista Subestado preCalificacion==============================================*/

$(document).ready(function () {
    $("#estadoPrecalificacio").change(function () {
        var selected = $("#estadoPrecalificacio option:selected").val();
        var selected2 = $("#subestadoSacar").val();
        console.log("selected = " + selected);
        console.log("selected2 = " + selected2);
        $.ajax({
            type: "GET",
            url: "../../../../../dist/js/listarPcl/listaEstadoPrecalifiacion.php",
            data: {"Txtestado": selected} // la coma que habia aqui no es necesaria
        }).done(function (data) {
            $(".subEstadoPreCalificacion select").html(data).fadeIn();
        });
    });
});
/**==========================Llama la lista Subestado al cargar  pagina preCalificacion==============================================*/

$(document).ready(function () {
    $("#estadoPrecalificacio").ready(function () {
        var selected = $("#estadoPrecalificacio option:selected").val();
        var selected2 = $("#subestadoSacar").val();
        console.log("selected = " + selected);
        console.log("selected2 = " + selected2);
        $.ajax({
            type: "GET",
            url: "../../../../../dist/js/listarPcl/listaEstadoPrecalifiacion.php",
            data: {"Txtestado": selected, "txtSubEstado": selected2}
        }).done(function (data) {
            $(".subEstadoPreCalificacion select").html(data).fadeIn();
        });
    });
});

/**==========================Llama la lista Subestado calificacion==============================================*/

$(document).ready(function () {
    $("#estadoCalificacion").change(function () {
        var estadoCali = $("#estadoCalificacion option:selected").val();
        var subEstadoCali = $("#subestadoMostarCali").val();
        console.log("estadoCali = " + estadoCali);
        console.log("subEstadoCali = " + subEstadoCali);
        $.ajax({
            type: "GET",
            url: "../../../../../dist/js/listarPcl/listaEstadoCalifiacion.php",
            data: {"Txtestado": estadoCali, "TxtestadoSub": subEstadoCali}
        }).done(function (data) {
            $(".subEstadoCalificacion select").html(data).fadeIn();
        });
    });
});
/**==========================Llama la lista Subestado calificacion==============================================*/

$(document).ready(function () {
    $("#estadoCalificacion").ready(function () {
        var estadoCali = $("#estadoCalificacion option:selected").val();
        var subEstadoCali = $("#subestadoMostarCali").val();
        console.log("estadoCali = " + estadoCali);
        console.log("subEstadoCali = " + subEstadoCali);
        $.ajax({
            type: "GET",
            url: "../../../../../dist/js/listarPcl/listaEstadoCalifiacion.php",
            data: {"Txtestado": estadoCali, "TxtestadoSub": subEstadoCali}
        }).done(function (data) {
            $(".subEstadoCalificacion select").html(data).fadeIn();
        });
    });
});

/**==========================Mostar Cie Pcl =============================================*/
$(document).ready(function () {
    $("#idSiniestroDxPcl").ready(function () {
        jQuery.ajax({
            url: "../../../dist/js/consulta/mostarAdicionesPcl.php",
            data: 'idSiniestroDxPcl=' + $("#idSiniestroDxPcl").val(),
            type: "POST",
            success: function (data) {
                $("#tablaCie10SiniestroPcl").html(data);
            },
            error: function () {}
        });
    });
});


/**==========================Mostar Cie Pcl Recalificacion =============================================*/

$(document).ready(function () {
    $(".idSiniestroDxPcl").ready(function () {
        jQuery.ajax({
            url: "../../../dist/js/consulta/mostarDxPcl.php",
            data: 'idSiniestroDxPcl=' + $("#idSiniestroDxPcl").val(),
            type: "POST",
            success: function (data) {
                $("#tablaCie10reca").html(data);
            },
            error: function () {}
        });
    });
});

$(document).ready(function () {
    $("#botondxReca").click(function () {
        var dx = $(".TxtIdDiagnosticoRec").val();
        var idSiniestro = $("#idSiniestDx").val();
        var descripcionDiagnostico = $("#descripcionDiagnostico").val();
        console.log("dx = " + dx);
        console.log("idSiniestro = " + idSiniestro);
        console.log("descripcionDiagnostico = " + descripcionDiagnostico);

        $.ajax({
            type: "GET",
            url: "../../../dist/js/dxCie10/adicionatCie10Reca.php",
            data: {"dx": dx, "idSiniestro": idSiniestro, "descripcionDiagnostico": descripcionDiagnostico}
        }).done(function (data) {
            /**==========================Mostar Cie Pcl Recalificacion =============================================*/
            document.getElementById('dxRecalifi').value = "";
            document.getElementById('descripcionDiagnostico').value = "";
            $("#botondxReca").prop("disabled", true);
            $("#descripcionDiagnostico").prop("disabled", true);
            jQuery.ajax({
                url: "../../../dist/js/consulta/mostarDxPcl.php",
                data: 'idSiniestroDxPcl=' + $("#idSiniestroDxPcl").val(),
                type: "POST",
                success: function (data) {
                    $("#tablaCie10reca").html(data);
                },
                error: function () {}
            });
        });
    });
});





/**==========================Mostar Cie Pcl Recalificacion  Adicion =============================================*/

$(document).ready(function () {
    $(".idAdicionPcl").ready(function () {
        jQuery.ajax({
            url: "../../../dist/js/consulta/mostarDxPclAdicion.php",
            data: 'idAdicionPcl=' + $("#idAdicionPcl").val(),
            type: "POST",
            success: function (data) {
                $("#tablaCieRecaliAdicioon").html(data);
            },
            error: function () {}
        });
    });
});


$(document).ready(function () {
    $("#botondxRecaAdicion").click(function () {
        var dx = $(".TxtIdDiagnosticoRec").val();
        var idSiniestro = $("#idAdicionPcl").val();
        var descripcionDiagnostico = $("#descripcionDiagnostico").val();
        console.log("dx = " + dx);
        console.log("idSiniestro = " + idSiniestro);
        console.log("descripcionDiagnostico = " + descripcionDiagnostico);
        $.ajax({
            type: "GET",
            url: "../../../dist/js/dxCie10/adicionatCie10RecaAdi.php",
            data: {"dx": dx, "idSiniestro": idSiniestro, "descripcionDiagnostico": descripcionDiagnostico}
        }).done(function (data) {
            /**==========================Mostar Cie Pcl Recalificacion Adicion =============================================*/
            document.getElementById('dxRecalifi').value = "";
            document.getElementById('descripcionDiagnostico').value = "";
            $("#botondxRecaAdicion").prop("disabled", true);
            $("#descripcionDiagnostico").prop("disabled", true);
            jQuery.ajax({
                url: "../../../dist/js/consulta/mostarDxPclAdicion.php",
                data: 'idAdicionPcl=' + $("#idAdicionPcl").val(),
                type: "POST",
                success: function (data) {
                    $("#tablaCieRecaliAdicioon").html(data);
                },
                error: function () {}
            });
        });
    });
});



/**==========================Mostar Cie Pcl adicion =============================================*/
$(document).ready(function () {
    $(".idAdicionPcl").ready(function () {
        jQuery.ajax({
            url: "../../../dist/js/consulta/mostarAdicionesAdicion.php",
            data: 'idAdicionPcl=' + $("#idAdicionPcl").val(),
            type: "POST",
            success: function (data) {
                $("#tablaCie10SiniestroPclAdicines").html(data);
            },
            error: function () {}
        });
    });
});

/**==========================Mostar Informacion agenda medico =============================================*/
$(document).ready(function () {
    $("#Txtmedico").change(function () {
        var selected = $("#Txtmedico option:selected").val();
        var selected2 = $("#start").val();
        console.log("selected = " + selected);
        console.log("selected2 = " + selected2);
        $.ajax({
            type: "GET",
            url: "../../../dist/js/consulta/consultaInfoMedico.php",
            data: {"Txtmedico": selected, "prueba": selected2} // la coma que habia aqui no es necesaria
        }).done(function (data) {
            $("#infoMedico").html(data);
        });
    });
});

/*=============Limpiar Select Medico Modal ==============*/
$("#ModalAdd").on('hidden.bs.modal', function () {
    document.getElementById("prueba").reset();
    document.getElementById('ocu').style.display = 'none';
});

/**==============================Mostar Formulario seguimiento================================================*/
$(document).ready(function () {
    $("#prueba").click(function () {

        $("#boton").prop("disabled", false);
    });
});
function Seguimiento() {
    if ($('#CerrarDivSeguimiento').is(':hidden')) {
        document.getElementById('CerrarDivSeguimiento').style.display = 'block';
    } else {
        document.getElementById('CerrarDivSeguimiento').style.display = 'none';
    }
}
/**==========================Agendar Medico =============================================*/
$(document).ready(function () {
    $("#btnGuardarAgenda").click(function () {
        var medico = $("#Txtmedico option:selected").val();
        var start = $("#start").val();
        var siniestroPcl = $("#TxtSiniestroPcl").val();
        var horaCita = $("#TxtHoraCita option:selected").val();

        console.log("medico = " + medico);
        console.log("start = " + start);
        console.log("siniestroPcl = " + siniestroPcl);
        console.log("horaCita = " + horaCita);

        $.ajax({
            type: "GET",
            url: "../../../dist/js/agendaCrud/addEvent.php",
            data: {"Txtmedico": medico, "TxtDiaCita": start, "TxtSiniestroPcl": siniestroPcl, "TxtHoraCita": horaCita} // la coma que habia aqui no es necesaria
        }).done(function (data) {
            Swal.fire({
                type: 'success',
                title: 'Cita Agendada con éxito'
            });
            $(document).ready(function () {
                $('#botonCrearSiniestroPcl').hide();
            });
        });
        $(document).ready(function () {
            jQuery.ajax({
                url: "../../../dist/js/consulta/seguimientosPcl.php",
                data: 'TxtSiniestroPcl=' + $("#TxtSiniestroPcl").val(),
                type: "POST",
                success: function (data) {
                    $("#mostarSeguimientos").html(data);
                },
                error: function () {}
            });
        });
    });
});
/**=======================================Seguientos================================*/


$(document).ready(function () {
    $("#TxtSiniestroPcl").ready(function () {
        jQuery.ajax({
            url: "../../../dist/js/consulta/seguimientosPcl.php",
            data: 'TxtSiniestroPcl=' + $("#TxtSiniestroPcl").val(),
            type: "POST",
            success: function (data) {
                $("#mostarSeguimientos").html(data);
            },
            error: function () {}
        });
    });
});

/**==========================seguimiento Siniestro =============================================*/



$(document).ready(function () {
    $("#TxtSiniestroPclSe").ready(function () {
        jQuery.ajax({
            url: "../../../dist/js/seguimiento/contadorSeguimiento.php",
            data: 'TxtSiniestroPclSe=' + $("#TxtSiniestroPclSe").val(),
            type: "POST",
            success: function (data) {
                $("#recargar2").html(data);
            },
            error: function () {}
        });
    });
});

$(document).ready(function () {
    $("#btnGuardarSeguimiento").click(function () {

        var subEstado = $("#TxtSubEstado option:selected").val();
        var fechaContacto = $("#TxtFechaContactoAfiliado").val();
        var seguimiento = $("#TxtSeguimiento").val();
        var idSiniestroPclSe = $("#TxtSiniestroPclSe").val();
        var revisadoPor = $("#TxtRevisadoPor").val();
        var tipoSeguimiento = $("#TxtTipoSeguimiento").val();


        console.log("subEstado = " + subEstado);
        console.log("fechaContacto = " + fechaContacto);
        console.log("seguimiento = " + seguimiento);
        console.log("idSiniestroPclSe = " + idSiniestroPclSe);
        console.log("revisadoPor = " + revisadoPor);
        console.log("tipoSeguimiento = " + tipoSeguimiento);
        solicitudAnexos = document.getElementById("CerrarDivSeguimiento");

        $.ajax({
            type: "GET",
            url: "../../../dist/js/seguimiento/addSeguimiento.php",
            data: {"TxtTipoSeguimiento": tipoSeguimiento, "TxtSubEstado": subEstado, "TxtFechaContactoAfiliado": fechaContacto, "TxtSeguimiento": seguimiento, "TxtSiniestroPclSe": idSiniestroPclSe, "TxtRevisadoPor": revisadoPor} // la coma que habia aqui no es necesaria
        }).done(function (data) {

            document.getElementById('TxtSubEstado').value = "";
            document.getElementById('TxtSeguimiento').value = "";
            solicitudAnexos.style.display = 'none';



        });

        $(document).ready(function () {
            jQuery.ajax({
                url: "../../../dist/js/consulta/seguimientosPcl.php",
                data: 'TxtSiniestroPcl=' + $("#TxtSiniestroPcl").val(),
                type: "POST",
                success: function (data) {
                    $("#mostarSeguimientos").html(data);

                },
                error: function () {}
            });
        });

        $(document).ready(function () {
            $("#TxtSiniestroPclSe").ready(function () {
                jQuery.ajax({
                    url: "../../../dist/js/seguimiento/contadorSeguimiento.php",
                    data: 'TxtSiniestroPclSe=' + $("#TxtSiniestroPclSe").val(),
                    type: "POST",
                    success: function (data) {
                        $("#recargar2").html(data);
                    },
                    error: function () {}
                });
            });
        });
    });
});


/*============================Validaciones PreCalificacion==========================================**/
$(document).ready(function () {
    $("#estadoPrecalificacio").change(function () {
        var estado = $("#estadoPrecalificacio option:selected").val();
        var solicitudAnexos = document.getElementById("solicitudAnexosDiv");
        var fechaAnexos = document.getElementById("fechaAnexosDiv");
        var subEstado = document.getElementById("mostarSubEstadPre");
        var puedoCalificar = document.getElementById("PuedoCalificar");
        var mostarSubEstadPre = document.getElementById("mostarSubEstadPre");

        if (estado === '45') {

            /*==============Solicitud de anexos=========================*/
            solicitudAnexos.style.display = 'none';
            fechaAnexos.style.display = 'none';
            $("#TxtFechaAnexosId").removeAttr("required");
            $("#TxtSolicitudAnexosId").removeAttr("required");
            /*==============Fin Solicitud de anexos=========================*/

            /*==============Puedo calificar=========================*/
            puedoCalificar.style.display = 'block';
            $("#TxtPuedoCalificarSi").prop("required", "required");
            $("#TxtPuedoCalificarNo").prop("required", "required");
            /*==============Puedo calificar=========================*/
            /*==============SuBEstado=========================*/
            subEstado.style.display = 'block';
            $("#TxtSubEstadoId").prop("required", "required");
            /*==============Fin SuBEstado=========================*/


        } else if (estado === '38' || estado === '40' || estado === '41') {
            /*==============Solicitud de anexos=========================*/
            solicitudAnexos.style.display = 'none';
            fechaAnexos.style.display = 'none';
            $("#TxtFechaAnexosId").removeAttr("required");
            $("#TxtSolicitudAnexosId").removeAttr("required");
            /*==============Fin Solicitud de anexos=========================*/

            /*==============SuBEstado=========================*/
            subEstado.style.display = 'block';
            $("#TxtSubEstadoId").prop("required", "required");
            /*==============Fin SuBEstado=========================*/

        } else if (estado === '39') {
            fechaAnexos.style.display = 'block';
            /*==============Solicitud de anexos=========================*/
            solicitudAnexos.style.display = 'block';

            $("#TxtFechaAnexosId").prop("required", "required");
            $("#TxtSolicitudAnexosId").prop("required", "required");
            /*==============Fin Solicitud de anexos=========================*/

            /*==============SuBEstado=========================*/
            subEstado.style.display = 'block';
            $("#TxtSubEstadoId").prop("required", "required");
            /*==============Fin SuBEstado=========================*/
        } else {
            /*==============Solicitud de anexos=========================*/
            solicitudAnexos.style.display = 'none';
            fechaAnexos.style.display = 'none';
            $("#TxtFechaAnexosId").removeAttr("required");
            $("#TxtSolicitudAnexosId").removeAttr("required");
            /*==============Fin Solicitud de anexos=========================*/

            /*==============SuBEstado=========================*/
            subEstado.style.display = 'none';
            $("#TxtSubEstadoId").removeAttr("required");
            /*==============Fin SuBEstado=========================*/

            /*==============Puedo calificar=========================*/
            puedoCalificar.style.display = 'none';
            $("#TxtPuedoCalificarSi").removeAttr("required");
            $("#TxtPuedoCalificarNo").removeAttr("required");
            /*==============Fin Puedo calificar=========================*/

        }
    });
});

/*============================Validaciones PreCalificacion==========================================**/
$(document).ready(function () {
    $("#estadoPrecalificacio").ready(function () {
        var estado = $("#estadoPrecalificacio option:selected").val();
        var solicitudAnexos = document.getElementById("solicitudAnexosDiv");
        var fechaAnexos = document.getElementById("fechaAnexosDiv");
        var subEstado = document.getElementById("mostarSubEstadPre");
        var puedoCalificar = document.getElementById("PuedoCalificar");

        if (estado === '45') {
            /*==============SuBEstado=========================*/
            subEstado.style.display = 'block';
            $("#TxtSubEstadoId").prop("required", "required");
            /*==============Fin SuBEstado=========================*/
            /*==============Solicitud de anexos=========================*/
            solicitudAnexos.style.display = 'none';
            fechaAnexos.style.display = 'none';
            $("#TxtFechaAnexosId").removeAttr("required");
            $("#TxtSolicitudAnexosId").removeAttr("required");
            /*==============Fin Solicitud de anexos=========================*/

            /*==============Puedo calificar=========================*/
            puedoCalificar.style.display = 'block';
            $("#TxtPuedoCalificarSi").prop("required", "required");
            $("#TxtPuedoCalificarNo").prop("required", "required");
            /*==============Puedo calificar=========================*/

        } else if (estado === '38' || estado === '40' || estado === '41') {
            /*==============Solicitud de anexos=========================*/
            solicitudAnexos.style.display = 'none';
            fechaAnexos.style.display = 'none';
            $("#TxtFechaAnexosId").removeAttr("required");
            $("#TxtSolicitudAnexosId").removeAttr("required");
            /*==============Fin Solicitud de anexos=========================*/

            /*==============SuBEstado=========================*/
            subEstado.style.display = 'block';
            $("#TxtSubEstadoId").prop("required", "required");
            /*==============Fin SuBEstado=========================*/

        } else if (estado === '39') {
            /*==============Solicitud de anexos=========================*/
            fechaAnexos.style.display = 'block';
            solicitudAnexos.style.display = 'block';

            $("#TxtFechaAnexosId").prop("required", "required");
            $("#TxtSolicitudAnexosId").prop("required", "required");
            /*==============Fin Solicitud de anexos=========================*/

            /*==============SuBEstado=========================*/
            subEstado.style.display = 'block';
            $("#TxtSubEstadoId").prop("required", "required");
            /*==============Fin SuBEstado=========================*/
        } else {
            /*==============Solicitud de anexos=========================*/
            solicitudAnexos.style.display = 'none';
            fechaAnexos.style.display = 'none';
            $("#TxtFechaAnexosId").removeAttr("required");
            $("#TxtSolicitudAnexosId").removeAttr("required");
            /*==============Fin Solicitud de anexos=========================*/

            /*==============SuBEstado=========================*/
            subEstado.style.display = 'none';
            $("#TxtSubEstadoId").removeAttr("required");
            /*==============Fin SuBEstado=========================*/

            /*==============Puedo calificar=========================*/
            puedoCalificar.style.display = 'none';
            $("#TxtPuedoCalificarSi").removeAttr("required");
            $("#TxtPuedoCalificarNo").removeAttr("required");
            /*==============Fin Puedo calificar=========================*/

        }
    });
});

/*============================Validaciones Calificacion==========================================**/
$(document).ready(function () {
    $("#estadoCalificacion").ready(function () {
        const  estadoCali = $("#estadoCalificacion option:selected").val();
        const  solicitudAnexosCali = document.getElementById("divSolicitudAnexosCali");
        const   fechaAnexosCali = document.getElementById("fechaAnexoCalifiDiv");
        const  subEstadoCali = document.getElementById("SubestadoDiv");
        const  puedoCalificarCali = document.getElementById("PuedoCalificar");
        const  DivSubEstadoCalificacion = document.getElementById("DivSubEstadoCalificacion");

        if (estadoCali === '49') {

            /*==============Solicitud de anexos=========================*/
            //fechaAnexosCali.style.display = 'block';
            solicitudAnexosCali.style.display = 'block';
            $("#TxtFechaAnexosCali").prop("required", "required");
            $("#TxtSolicitudAnexoCali").prop("required", "required");
            /*==============Fin Solicitud de anexos=========================*/
            DivSubEstadoCalificacion.style.display = 'block';
            $("#subEstadoCalificacion").prop("required", "required");

        } else if (estadoCali === '1') {

            /*==============Solicitud de anexos=========================*/
            DivSubEstadoCalificacion.style.display = 'none';
            $("#subEstadoCalificacion").removeAttr("required");
            /*==============Solicitud de anexos=========================*/
            fechaAnexosCali.style.display = 'none';
            solicitudAnexosCali.style.display = 'none';
            $("#TxtFechaAnexosCali").removeAttr("required");
            $("#TxtSolicitudAnexoCali").removeAttr("required");
            /*==============Fin Solicitud de anexos=========================*/

        } else {

            /*==============Solicitud de anexos=========================*/
            fechaAnexosCali.style.display = 'none';
            solicitudAnexosCali.style.display = 'none';
            $("#TxtFechaAnexosCali").removeAttr("required");
            $("#TxtSolicitudAnexoCali").removeAttr("required");
            /*==============Fin Solicitud de anexos=========================*/
            DivSubEstadoCalificacion.style.display = 'block';
            $("#subEstadoCalificacion").prop("required", "required");

        }
    });
});

$(document).ready(function () {
    $("#estadoCalificacion").change(function () {
        const estadoCali = $("#estadoCalificacion option:selected").val();
        const solicitudAnexosCali = document.getElementById("divSolicitudAnexosCali");
        const fechaAnexosCali = document.getElementById("fechaAnexoCalifiDiv");
        const  subEstadoCali = document.getElementById("SubestadoDiv");
        const  puedoCalificarCali = document.getElementById("PuedoCalificar");
        const   DivSubEstadoCalificacion = document.getElementById("DivSubEstadoCalificacion");

        if (estadoCali === '49') {
            /*==============Solicitud de anexos=========================*/
            //fechaAnexosCali.style.display = 'block';
            solicitudAnexosCali.style.display = 'block';
            $("#TxtFechaAnexosCali").prop("required", "required");
            $("#TxtSolicitudAnexoCali").prop("required", "required");
            /*==============Fin Solicitud de anexos=========================*/
            DivSubEstadoCalificacion.style.display = 'block';
            $("#subEstadoCalificacion").prop("required", "required");

        } else if (estadoCali === '1') {

            /*==============Solicitud de anexos=========================*/
            DivSubEstadoCalificacion.style.display = 'none';
            $("#subEstadoCalificacion").removeAttr("required");
            /*==============Solicitud de anexos=========================*/
            fechaAnexosCali.style.display = 'none';
            solicitudAnexosCali.style.display = 'none';
            $("#TxtFechaAnexosCali").removeAttr("required");
            $("#TxtSolicitudAnexoCali").removeAttr("required");
            /*==============Fin Solicitud de anexos=========================*/

        } else {
            DivSubEstadoCalificacion.style.display = 'block';
            $("#subEstadoCalificacion").prop("required", "required");
            /*==============Solicitud de anexos=========================*/
            fechaAnexosCali.style.display = 'none';
            solicitudAnexosCali.style.display = 'none';
            $("#TxtFechaAnexosCali").removeAttr("required");
            $("#TxtSolicitudAnexoCali").removeAttr("required");
            /*==============Fin Solicitud de anexos=========================*/


        }
    });
});


/*============================Validaciones Calificacion SubEstado==========================================**/
$(document).ready(function () {
    $("#subEstadoCalificacion").change(function () {
        subEstadoCali = $("#subEstadoCalificacion option:selected").val();
        fechaEnvioComiteDiv = document.getElementById("fechaEnvioComiteDiv");
        fechaDevolucionComiteDiv = document.getElementById("fechaDevolucionComiteDiv");
        fechavisadoDiv = document.getElementById("fechavisadoDiv");

        if (subEstadoCali === '101') {
            fechaEnvioComiteDiv.style.display = 'block';
            $("#TxtFechaEnvioComite").prop("required", "required");
            $("#TxtFechaEnvioComite").removeAttr("disabled");
            fechavisadoDiv.style.display = 'none';
            $("#TxtFechavisado").removeAttr("required");
            $("#TxtFechavisado").prop("disabled", "disabled");
            fechaDevolucionComiteDiv.style.display = 'none';
            $("#TxtFechaDevolucionComite").removeAttr("required");
            $("#TxtFechaDevolucionComite").prop("disabled", "disabled");

        } else if (subEstadoCali === '103') {
            fechaDevolucionComiteDiv.style.display = 'block';
            $("#TxtFechaDevolucionComite").prop("required", "required");
            $("#TxtFechaDevolucionComite").removeAttr("disabled");
            fechaEnvioComiteDiv.style.display = 'none';
            $("#TxtFechaEnvioComite").removeAttr("required");
            $("#TxtFechaEnvioComite").prop("disabled", "disabled");
            fechavisadoDiv.style.display = 'none';
            $("#TxtFechavisado").removeAttr("required");
            $("#TxtFechavisado").prop("disabled", "disabled");

        } else if (subEstadoCali === '104') {
            fechavisadoDiv.style.display = 'block';
            $("#TxtFechavisado").prop("required", "required");
            $("#TxtFechavisado").removeAttr("disabled");
            fechaEnvioComiteDiv.style.display = 'none';
            $("#TxtFechaEnvioComite").removeAttr("required");
            $("#TxtFechaEnvioComite").prop("disabled", "disabled");
            fechaDevolucionComiteDiv.style.display = 'none';
            $("#TxtFechaDevolucionComite").removeAttr("required");
            $("#TxtFechaDevolucionComite").prop("disabled", "disabled");
        } else {
            fechaEnvioComiteDiv.style.display = 'none';
            $("#TxtFechaEnvioComite").removeAttr("required");
            $("#TxtFechaEnvioComite").prop("disabled", "disabled");
            fechavisadoDiv.style.display = 'none';
            $("#TxtFechavisado").removeAttr("required");
            $("#TxtFechavisado").prop("disabled", "disabled");
            fechaDevolucionComiteDiv.style.display = 'none';
            $("#TxtFechaDevolucionComite").removeAttr("required");
            $("#TxtFechaDevolucionComite").prop("disabled", "disabled");

        }
    });
});

$(document).ready(function () {
    $("#subestadoMostarCali").ready(function () {
        subEstadoCali = $("#subestadoMostarCali").val();
        fechaEnvioComiteDiv = document.getElementById("fechaEnvioComiteDiv");
        fechaDevolucionComiteDiv = document.getElementById("fechaDevolucionComiteDiv");
        fechavisadoDiv = document.getElementById("fechavisadoDiv");

        if (subEstadoCali === '101') {
            fechaEnvioComiteDiv.style.display = 'block';
            $("#TxtFechaEnvioComite").prop("required", "required");
            $("#TxtFechaEnvioComite").removeAttr("disabled");
            fechavisadoDiv.style.display = 'none';
            $("#TxtFechavisado").removeAttr("required");
            $("#TxtFechavisado").prop("disabled", "disabled");
            fechaDevolucionComiteDiv.style.display = 'none';
            $("#TxtFechaDevolucionComite").removeAttr("required");
            $("#TxtFechaDevolucionComite").prop("disabled", "disabled");

        } else if (subEstadoCali === '103') {
            fechaDevolucionComiteDiv.style.display = 'block';
            $("#TxtFechaDevolucionComite").prop("required", "required");
            $("#TxtFechaDevolucionComite").removeAttr("disabled");
            fechaEnvioComiteDiv.style.display = 'none';
            $("#TxtFechaEnvioComite").removeAttr("required");
            $("#TxtFechaEnvioComite").prop("disabled", "disabled");
            fechavisadoDiv.style.display = 'none';
            $("#TxtFechavisado").removeAttr("required");
            $("#TxtFechavisado").prop("disabled", "disabled");

        } else if (subEstadoCali === '104') {
            fechavisadoDiv.style.display = 'block';
            $("#TxtFechavisado").prop("required", "required");
            $("#TxtFechavisado").removeAttr("disabled");
            fechaEnvioComiteDiv.style.display = 'none';
            $("#TxtFechaEnvioComite").removeAttr("required");
            $("#TxtFechaEnvioComite").prop("disabled", "disabled");
            fechaDevolucionComiteDiv.style.display = 'none';
            $("#TxtFechaDevolucionComite").removeAttr("required");
            $("#TxtFechaDevolucionComite").prop("disabled", "disabled");
        } else {
            fechaEnvioComiteDiv.style.display = 'none';
            $("#TxtFechaEnvioComite").removeAttr("required");
            $("#TxtFechaEnvioComite").prop("disabled", "disabled");
            fechavisadoDiv.style.display = 'none';
            $("#TxtFechavisado").removeAttr("required");
            $("#TxtFechavisado").prop("disabled", "disabled");
            fechaDevolucionComiteDiv.style.display = 'none';
            $("#TxtFechaDevolucionComite").removeAttr("required");
            $("#TxtFechaDevolucionComite").prop("disabled", "disabled");

        }
    });
});

/*==============================Ocultar boton cargue ==========================================*/
$(document).ready(function () {
    $("#OcultarBotnArchivo").ready(function () {
        carguePrecalificacion = $("#OcultarBotnArchivo").val();
        ocultarCar = document.getElementById("seOcultaCarga");

        if (carguePrecalificacion === '1') {
            ocultarCar.style.display = 'none';

        }
    });
});

/*======================Show alert=================================*/
$(document).ready(function () {
    $("#cargueEntrada").ready(function () {
        cargueEnt = $("#cargueEntrada").val();
        ocultarEntr = document.getElementById("callout-1");
        botonImportar = document.getElementById("botonImportar");
        alertasDiv = document.getElementById("alertasDiv");

        if (cargueEnt === '1') {
            ocultarEntr.style.display = 'block';
            botonImportar.style.display = 'none';
            alertasDiv.style.display = 'block';

            Swal.fire({
                title: 'Error de celdas...',
                type: 'error',
                text: 'No se reconoce la información cargada en alguno de las celdas'
            });

        }
    });
});
$(document).ready(function () {
    $("#carguePrecalificacion").ready(function () {
        carguePrecalificacion = $("#carguePrecalificacion").val();
        callout3 = document.getElementById("callout-3");
        botonImportar = document.getElementById("botonImportar");
        alertasDiv = document.getElementById("alertasDiv");

        if (carguePrecalificacion === '1') {
            callout3.style.display = 'block';
            alertasDiv.style.display = 'block';
            botonImportar.style.display = 'none';
            Swal.fire({
                title: 'Error de celdas...',
                type: 'error',
                text: 'No se reconoce la información cargada en alguno de las celdas'
            });
        }
    });
});
$(document).ready(function () {
    $("#cargueValoracion").ready(function () {
        cargueValoracion = $("#cargueValoracion").val();
        callout4 = document.getElementById("callout-4");
        botonImportar = document.getElementById("botonImportar");
        alertasDiv = document.getElementById("alertasDiv");

        if (cargueValoracion === '1') {
            callout4.style.display = 'block';
            alertasDiv.style.display = 'block';
            botonImportar.style.display = 'none';
            Swal.fire({
                title: 'Error de celdas...',
                type: 'error',
                text: 'No se reconoce la información cargada en alguno de las celdas'
            });
        }
    });
});
$(document).ready(function () {
    $("#cargueQuien").ready(function () {
        cargueQuien = $("#cargueQuien").val();
        callout5 = document.getElementById("callout-5");
        botonImportar = document.getElementById("botonImportar");
        alertasDiv = document.getElementById("alertasDiv");

        if (cargueQuien === '1') {
            callout5.style.display = 'block';
            alertasDiv.style.display = 'block';
            botonImportar.style.display = 'none';
            Swal.fire({
                title: 'Error de celdas...',
                type: 'error',
                text: 'No se reconoce la información cargada en alguno de las celdas'
            });
        }
    });
});
$(document).ready(function () {
    $("#cargueSiniestro").ready(function () {
        cargueSiniestro = $("#cargueSiniestro").val();
        callout8 = document.getElementById("callout-8");
        botonImportar = document.getElementById("botonImportar");
        alertasDiv = document.getElementById("alertasDiv");

        if (cargueSiniestro === '1') {
            callout8.style.display = 'block';
            alertasDiv.style.display = 'block';
            botonImportar.style.display = 'none';
            Swal.fire({
                title: 'Error de celdas...',
                type: 'error',
                text: 'No se reconoce la información cargada en alguno de las celdas'
            });
        }
    });
});
$(document).ready(function () {
    $("#CargueEvento").ready(function () {
        CargueEvento = $("#CargueEvento").val();
        callout10 = document.getElementById("callout-10");
        botonImportar = document.getElementById("botonImportar");
        alertasDiv = document.getElementById("alertasDiv");

        if (CargueEvento === '1') {
            callout10.style.display = 'block';
            alertasDiv.style.display = 'block';
            botonImportar.style.display = 'none';
            Swal.fire({
                title: 'Error de celdas...',
                type: 'error',
                text: 'No se reconoce la información cargada en alguno de las celdas'
            });
        }
    });
});
$(document).ready(function () {
    $("#cargueSolicitud").ready(function () {
        cargueSolicitud = $("#cargueSolicitud").val();
        callout11 = document.getElementById("callout-11");
        botonImportar = document.getElementById("botonImportar");
        alertasDiv = document.getElementById("alertasDiv");

        if (cargueSolicitud === '1') {
            callout11.style.display = 'block';
            alertasDiv.style.display = 'block';
            botonImportar.style.display = 'none';
            Swal.fire({
                title: 'Error de celdas...',
                type: 'error',
                text: 'No se reconoce la información cargada en alguno de las celdas'
            });
        }
    });
});
$(document).ready(function () {
    $("#cargueAsignar").ready(function () {
        cargueAsignar = $("#cargueAsignar").val();
        callout12 = document.getElementById("callout-12");
        botonImportar = document.getElementById("botonImportar");
        alertasDiv = document.getElementById("alertasDiv");

        if (cargueAsignar === '1') {
            callout12.style.display = 'block';
            alertasDiv.style.display = 'block';
            botonImportar.style.display = 'none';
            Swal.fire({
                title: 'Error de celdas...',
                type: 'error',
                text: 'No se reconoce la información cargada en alguno de las celdas'
            });
        }
    });
});

$(document).ready(function () {
    $("#cargueSucursal").ready(function () {
        cargueSucursal = $("#cargueSucursal").val();
        callout13 = document.getElementById("callout-13");
        botonImportar = document.getElementById("botonImportar");
        alertasDiv = document.getElementById("alertasDiv");
        if (cargueSucursal === '1') {
            callout13.style.display = 'block';
            alertasDiv.style.display = 'block';
            botonImportar.style.display = 'none';
            Swal.fire({
                title: 'Error de celdas...',
                type: 'error',
                text: 'No se reconoce la información cargada en alguno de las celdas'
            });
        }
    });
});

/**==========================Llama la lista Quien SOlicita==============================================*/



$(document).ready(function () {
    $("#hor").change(function () {
        var selected = $("#hor option:selected").val();
        console.log("selected = " + selected);
        $.ajax({
            type: "GET",
            url: "../../../../../dist/js/horario/listahorario.php",
            data: {"Txtestado": selected}
        }).done(function (data) {
            $(".horaHasta select").html(data).fadeIn();
        });
    });
});
$(document).ready(function () {
    $("#TxtIdHOra").ready(function () {
        var idhora = $("#TxtIdHOra").val();
        var hora = $("#TxtHoraCita").val();
        console.log("idhora = " + idhora);
        console.log("hora = " + hora);
        $.ajax({
            type: "GET",
            url: "../../../../../dist/js/horario/listahorario.php",
            data: {"TxIdHora": idhora, "TxtHora": hora}
        }).done(function (data) {
            $(".horaHasta select").html(data).fadeIn();
        });
    });
});
/*================================Dias de la semana========================================*/

$(document).ready(function () {
    $("#TxtLunes").ready(function () {
        lunes = $("#TxtLunes").val();
        if (lunes === 'SI') {
            $("#lunes").prop("checked", "checked");
            document.getElementById('lunesTxt').value = "SI";
            //  $("#TxtFechaDevolucionComite").removeAttr("disabled");
        }
    });
});
$(document).ready(function () {
    $("#TxtMartes").ready(function () {
        martes = $("#TxtMartes").val();
        if (martes === 'SI') {
            $("#martes").prop("checked", "checked");
            document.getElementById('martesTxt').value = "SI";

            //  $("#TxtFechaDevolucionComite").removeAttr("disabled");
        }
    });
});
$(document).ready(function () {
    $("#Txtmiercoles").ready(function () {
        miercoles = $("#Txtmiercoles").val();
        if (miercoles === 'SI') {
            $("#miercoles").prop("checked", "checked");
            document.getElementById('miercolesTxt').value = "SI";

            //  $("#TxtFechaDevolucionComite").removeAttr("disabled");
        }
    });
});
$(document).ready(function () {
    $("#TxtJueves").ready(function () {
        jueves = $("#TxtJueves").val();
        if (jueves === 'SI') {
            $("#jueves").prop("checked", "checked");
            document.getElementById('juevesTxt').value = "SI";

            //  $("#TxtFechaDevolucionComite").removeAttr("disabled");
        }
    });
});
$(document).ready(function () {
    $("#TxtViernes").ready(function () {
        viernes = $("#TxtViernes").val();
        if (viernes === 'SI') {
            $("#viernes").prop("checked", "checked");
            document.getElementById('viernesTxt').value = "SI";

            //  $("#TxtFechaDevolucionComite").removeAttr("disabled");
        }
    });
});
$(document).ready(function () {
    $("#TxtSabado").ready(function () {
        sabado = $("#TxtSabado").val();
        if (sabado === 'SI') {
            $("#sabado").prop("checked", "checked");
            document.getElementById('sabadoTxt').value = "SI";

            //  $("#TxtFechaDevolucionComite").removeAttr("disabled");
        }
    });
});


/*==============================Enviar valor ===========================================*/
$(document).ready(function () {
    $("#lunes").click(function () {
        if ($(this).is(":checked")) {
            document.getElementById('lunesTxt').value = "SI";

        } else {

            document.getElementById('lunesTxt').value = "NO";
        }
    });
});
$(document).ready(function () {
    $("#martes").click(function () {
        if ($(this).is(":checked")) {
            document.getElementById('martesTxt').value = "SI";
        } else {
            document.getElementById('martesTxt').value = "NO";
        }
    });
});
$(document).ready(function () {
    $("#miercoles").click(function () {
        if ($(this).is(":checked")) {
            document.getElementById('miercolesTxt').value = "SI";
        } else {
            document.getElementById('miercolesTxt').value = "NO";
        }
    });
});
$(document).ready(function () {
    $("#jueves").click(function () {
        if ($(this).is(":checked")) {
            document.getElementById('juevesTxt').value = "SI";
        } else {
            document.getElementById('juevesTxt').value = "NO";
        }
    });
});
$(document).ready(function () {
    $("#viernes").click(function () {
        if ($(this).is(":checked")) {
            document.getElementById('viernesTxt').value = "SI";
        } else {
            document.getElementById('viernesTxt').value = "NO";
        }
    });
});
$(document).ready(function () {
    $("#sabado").click(function () {
        if ($(this).is(":checked")) {
            document.getElementById('sabadoTxt').value = "SI";
        } else {
            document.getElementById('sabadoTxt').value = "NO";
        }
    });
});

/*=======================Pagina Agenda doctor===============================*/
$('#AgendaDoc').click(function () {
    doctor = $("#doctor option:selected").val();

    if (doctor !== '0') {
        location.href = "/Agendas/" + doctor + "/edit";
        document.getElementById('doctor').value = "0";

    }
});



/**==========================Editrar agenda Medico =============================================*/
$(document).ready(function () {
    $("#editAgendaMedico").click(function () {
        var tipoConsulta = $("#tipoConsulta option:selected").val();
        var hora = $("#hora option:selected").val();
        var idCalendario = $("#id").val();

        console.log("tipoConsulta = " + tipoConsulta);
        console.log("hora = " + hora);
        console.log("idCalendario = " + idCalendario);

        $.ajax({
            type: "GET",
            url: "../../../dist/js/agendaCrud/editEventDate.php",
            data: {"TxtTipoConsulta": tipoConsulta, "TxtHora": hora, "TxtCalendario": idCalendario} // la coma que habia aqui no es necesaria
        }).done(function (data) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-outline-success btn-sm botones_letras',
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                type: 'success',
                confirmButton: 'btn btn-success',
                html: '<b>Cambios realizados con éxito</b>',
                confirmButtonText: '<a href="/Agendas" class="swn"><i class="fa fa-thumbs-up"></i> Continuar</a>'
            });
        });
    });
});
/**==========================Eliminar agenda Medico =============================================*/
$(document).ready(function () {
    $("#destroyCalendar").click(function () {
        var idCalendario = $("#id").val();
        console.log("idCalendario = " + idCalendario);
        $.ajax({
            type: "GET",
            url: "../../../dist/js/agendaCrud/eliminarCale.php",
            data: {"TxtCalendario": idCalendario} // la coma que habia aqui no es necesaria
        }).done(function (data) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-outline-success btn-sm botones_letras',
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                type: 'success',
                confirmButton: 'btn btn-success',
                html: '<b>Cita Eliminada con éxito</b>',
                confirmButtonText: '<a href="/Agendas" class="swn"><i class="fa fa-thumbs-up"></i> Continuar</a>'
            });
        });
    });
});

/**====================Mostar Informacion medico Agendas==========================*/
$(document).ready(function () {
    $("#cedulaAfilido").change(function () {
        var cedula = $("#cedulaAfilido").val();
        console.log("cedula = " + cedula);
        $.ajax({
            type: "GET",
            url: "../../../dist/js/consulta/conInfoAfiliadoAgenda.php",
            data: {"Txtcedula": cedula} // la coma que habia aqui no es necesaria
        }).done(function (data) {
            $("#infoPaciente").html(data);
        });
    });
});


/**==========================Agendar Medico =============================================*/
$(document).ready(function () {
    $("#btnGuardarAgen").click(function () {
        var medico = $("#Txtmedico option:selected").val();
        var diaCita = $("#start").val();
        var idAfiliado = $("#idAfiliado").val();
        var horaCita = $("#TxtHoraCita option:selected").val();
        var tipoConsulta = $("#tipoConsult5a option:selected").val();

        console.log("medico = " + medico);
        console.log("diaCita = " + diaCita);
        console.log("idAfiliado = " + idAfiliado);
        console.log("horaCita = " + horaCita);
        console.log("tipoConsulta = " + tipoConsulta);

        $.ajax({
            type: "GET",
            url: "../../../dist/js/agendaCrud/insertAgenda.php",
            data: {"TxtTipoConsulta": tipoConsulta, "Txtmedico": medico, "TxtDiaCita": diaCita, "TxtIdAfiliado": idAfiliado, "TxtHoraCita": horaCita} // la coma que habia aqui no es necesaria
        }).done(function (data) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-outline-success btn-sm botones_letras',
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                type: 'success',
                confirmButton: 'btn btn-success',
                html: '<b>Cita agendada con éxito</b>',
                confirmButtonText: '<a href="/Agendas" class="swn"><i class="fa fa-thumbs-up"></i> Continuar</a>'
            });

        });
    });
});

/**==========================Llama la lista Subestado Recalificacion==============================================*/



$(document).ready(function () {
    $("#EstadoRecalificacion").change(function () {
        var estadoReCali = $("#EstadoRecalificacion option:selected").val();
        var subEstadoRECali = $("#subestadoMostarReCali").val();
        console.log("estadoReCali = " + estadoReCali);
        console.log("subEstadoRECali = " + subEstadoRECali);
        $.ajax({
            type: "GET",
            url: "../../../../../dist/js/listarPcl/listaEstadoReCalifiacion.php",
            data: {"Txtestado": estadoReCali, "TxtestadoSub": subEstadoRECali}
        }).done(function (data) {
            $(".subEstadoReCalificacion select").html(data).fadeIn();
        });
    });
});

$(document).ready(function () {
    $("#EstadoRecalificacion").ready(function () {
        var estadoReCali = $("#EstadoRecalificacion option:selected").val();
        var subEstadoRECali = $("#subestadoMostarReCali").val();
        console.log("estadoReCali = " + estadoReCali);
        console.log("subEstadoRECali = " + subEstadoRECali);
        $.ajax({
            type: "GET",
            url: "../../../../../dist/js/listarPcl/listaEstadoReCalifiacion.php",
            data: {"Txtestado": estadoReCali, "TxtestadoSub": subEstadoRECali}
        }).done(function (data) {
            $(".subEstadoReCalificacion select").html(data).fadeIn();
        });
    });
});

/*============================Validaciones RECalificacion==========================================**/
$(document).ready(function () {
    $("#EstadoRecalificacion").change(function () {
        estadoReCali = $("#EstadoRecalificacion option:selected").val();
        solicitudAnexosReCali = document.getElementById("divSolicitudAnexosReCali");
        fechaAnexosReCali = document.getElementById("divFechaAnexosReCali");

        if (estadoReCali === '53') {
            solicitudAnexosReCali.style.display = 'block';
            /*==============Solicitud de anexos=========================*/
            fechaAnexosReCali.style.display = 'block';
            $("#TxtFechaAnexosReCali").prop("required", "required");
            $("#TxtSolicitudAnexoCali").prop("required", "required");
            $("#TxtdevolucionComiteRecali").removeAttr("disabled");

            /*==============Fin Solicitud de anexos=========================*/
        } else {
            solicitudAnexosReCali.style.display = 'none';
            /*==============Solicitud de anexos=========================*/
            fechaAnexosReCali.style.display = 'none';
            $("#TxtFechaAnexosReCali").removeAttr("required");
            $("#TxtSolicitudAnexoCali").removeAttr("required");
            $("#TxtdevolucionComiteRecali").prop("disabled", "disabled");

            /*==============Fin Solicitud de anexos=========================*/
        }
    });
});

/*============================Validaciones ReCalificacion==========================================**/
$(document).ready(function () {
    $("#subEstadoReCalificacion").change(function () {
        var estadoSubReCali = $("#subEstadoReCalificacion option:selected").val();
        var fechaEnvioCimiteReca = document.getElementById("divEnvioComiteRecai");
        var divDevolucionComiteRecali = document.getElementById("divDevolucionComiteRecali");
        var divfechavisadoRecali = document.getElementById("divfechavisadoRecali");

        if (estadoSubReCali === '146') {
            /*==============Solicitud de anexos=========================*/
            fechaEnvioCimiteReca.style.display = 'block';
            $("#TxtFechaEnvioComiteRecali").prop("required", "required");

            /*==============Fin Solicitud de anexos=========================*/
            divDevolucionComiteRecali.style.display = 'none';
            divfechavisadoRecali.style.display = 'none';
            $("#TxtdevolucionComiteRecali").remove("required");
            $("#TxtfechavisadoRecali").remove("required");
            $("#TxtdevolucionComiteRecali").prop("disabled", "disabled");
            $("#TxtfechavisadoRecali").prop("disabled", "disabled");

        } else if (estadoSubReCali === '148') {
            /*==============Solicitud de anexos=========================*/
            divDevolucionComiteRecali.style.display = 'block';
            $("#TxtdevolucionComiteRecali").prop("required", "required");
            /*==============Fin Solicitud de anexos=========================*/
            divfechavisadoRecali.style.display = 'none';
            fechaEnvioCimiteReca.style.display = 'none';
            $("#TxtFechaEnvioComiteRecali").remove("required");
            $("#TxtfechavisadoRecali").remove("required");
            $("#TxtFechaEnvioComiteRecali").prop("disabled", "disabled");
            $("#TxtfechavisadoRecali").prop("disabled", "disabled");
        } else if (estadoSubReCali === '149') {
            /*==============Solicitud de anexos=========================*/
            divfechavisadoRecali.style.display = 'block';
            $("#TxtfechavisadoRecali").prop("required", "required");
            /*==============Fin Solicitud de anexos=========================*/
            fechaEnvioCimiteReca.style.display = 'none';
            divDevolucionComiteRecali.style.display = 'none';
            $("#TxtdevolucionComiteRecali").remove("required");
            $("#TxtFechaEnvioComiteRecali").remove("required");
            $("#TxtdevolucionComiteRecali").prop("disabled", "disabled");
            $("#TxtFechaEnvioComiteRecali").prop("disabled", "disabled");
        } else {
            /*==============Solicitud de anexos=========================*/
            $("#TxtFechaEnvioComiteRecali").prop("disabled", "disabled");
            fechaEnvioCimiteReca.style.display = 'none';
            divDevolucionComiteRecali.style.display = 'none';
            divfechavisadoRecali.style.display = 'none';
            $("#TxtFechaEnvioComiteRecali").removeAttr("required");
            $("#TxtdevolucionComiteRecali").remove("required");
            $("#TxtfechavisadoRecali").remove("required");

            $("#TxtdevolucionComiteRecali").prop("disabled", "disabled");
            $("#TxtfechavisadoRecali").prop("disabled", "disabled");
            /*==============Fin Solicitud de anexos=========================*/
        }
    });
});
/*============================Validaciones ReCalificacion==========================================**/
$(document).ready(function () {
    $("#subEstadoReCalificacion").ready(function () {
        var estadoSubReCali = $("#subEstadoReCalificacion option:selected").val();
        var fechaEnvioCimiteReca = document.getElementById("divEnvioComiteRecai");
        var divDevolucionComiteRecali = document.getElementById("divDevolucionComiteRecali");
        var divfechavisadoRecali = document.getElementById("divfechavisadoRecali");

        if (estadoSubReCali === '146') {
            /*==============Solicitud de anexos=========================*/
            fechaEnvioCimiteReca.style.display = 'block';
            $("#TxtFechaEnvioComiteRecali").prop("required", "required");

            /*==============Fin Solicitud de anexos=========================*/
            divDevolucionComiteRecali.style.display = 'none';
            divfechavisadoRecali.style.display = 'none';
            $("#TxtdevolucionComiteRecali").remove("required");
            $("#TxtfechavisadoRecali").remove("required");
            $("#TxtdevolucionComiteRecali").prop("disabled", "disabled");
            $("#TxtfechavisadoRecali").prop("disabled", "disabled");

        } else if (estadoSubReCali === '148') {
            /*==============Solicitud de anexos=========================*/
            divDevolucionComiteRecali.style.display = 'block';
            $("#TxtdevolucionComiteRecali").prop("required", "required");
            /*==============Fin Solicitud de anexos=========================*/
            divfechavisadoRecali.style.display = 'none';
            fechaEnvioCimiteReca.style.display = 'none';
            $("#TxtFechaEnvioComiteRecali").remove("required");
            $("#TxtfechavisadoRecali").remove("required");
            $("#TxtFechaEnvioComiteRecali").prop("disabled", "disabled");
            $("#TxtfechavisadoRecali").prop("disabled", "disabled");
        } else if (estadoSubReCali === '149') {
            /*==============Solicitud de anexos=========================*/
            divfechavisadoRecali.style.display = 'block';
            $("#TxtfechavisadoRecali").prop("required", "required");
            /*==============Fin Solicitud de anexos=========================*/
            fechaEnvioCimiteReca.style.display = 'none';
            divDevolucionComiteRecali.style.display = 'none';
            $("#TxtdevolucionComiteRecali").remove("required");
            $("#TxtFechaEnvioComiteRecali").remove("required");
            $("#TxtdevolucionComiteRecali").prop("disabled", "disabled");
            $("#TxtFechaEnvioComiteRecali").prop("disabled", "disabled");
        } else {
            /*==============Solicitud de anexos=========================*/
            fechaEnvioCimiteReca.style.display = 'none';
            divDevolucionComiteRecali.style.display = 'none';
            divfechavisadoRecali.style.display = 'none';
            $("#TxtFechaEnvioComiteRecali").removeAttr("required");
            $("#TxtdevolucionComiteRecali").remove("required");
            $("#TxtfechavisadoRecali").remove("required");
            $("#TxtFechaEnvioComiteRecali").prop("disabled", "disabled");
            $("#TxtdevolucionComiteRecali").prop("disabled", "disabled");
            $("#TxtfechavisadoRecali").prop("disabled", "disabled");
            /*==============Fin Solicitud de anexos=========================*/
        }
    });
});




/*===================================*/
$("#ocultarAdicion").on("click", function () {
    $('#ocultarTablaAdicion').hide(); //muestro mediante id
    $('#formularioPclAdicion').show(); //muestro mediante clase
});
$("#mostarAdicion").on("click", function () {
    $('#ocultarTablaAdicion').show(); //muestro mediante id
    $('#formularioPclAdicion').hide(); //muestro mediante clase
});



/*==========================Crear CasoPqr input====================================*/
$(document).ready(function () {
    $("#canalEntradaCrear").change(function () {
        var entra = $("#canalEntradaCrear option:selected").val();
        var divPqr = document.getElementById("divPqr");

        if (entra === '17') {
            divPqr.style.display = 'block';
            $("#Pqr").prop("required", "required");
            $("#Pqr").removeAttr("disabled");

        } else {
            divPqr.style.display = 'none';
            $("#Pqr").removeAttr("required");
            $("#Pqr").val();
            $("#Pqr").prop("disabled", "disabled");
        }
    });
});

$(document).ready(function () {
    $("#canalEntradaCrearAdicion").change(function () {
        var entra = $("#canalEntradaCrearAdicion option:selected").val();
        var divPqr = document.getElementById("divPqrAdicion");

        if (entra === '17') {
            divPqr.style.display = 'block';
            $("#PqrAdicion").prop("required", "required");
            $("#PqrAdicion").removeAttr("disabled");

        } else {
            divPqr.style.display = 'none';
            $("#PqrAdicion").removeAttr("required");
            $("#PqrAdicion").val();
            $("#PqrAdicion").prop("disabled", "disabled");
        }
    });
});

/*==========================Crear Caso Tipo Solicitud====================================*/
$(document).ready(function () {
    $("#quinSolicitaCrear").change(function () {
        var quinSolicita = $("#quinSolicitaCrear option:selected").val();
        var divOtro = document.getElementById("divOtro");

        if (quinSolicita === '14') {
            divOtro.style.display = 'block';
            $("#otros").removeAttr("disabled");
            $("#otros").prop("required", "required");

        } else {
            divOtro.style.display = 'none';
            $("#otros").removeAttr("required");
            $("#otros").prop("disabled", "disabled");
        }
    });

});

/*==========================Crear Caso Tipo Solicitud====================================*/
$(document).ready(function () {
    $("#quinSolicitaCrear").change(function () {
        var quinSolicita = $("#quinSolicitaCrear option:selected").val();
        var divOtro = document.getElementById("divOtro");

        if (quinSolicita === '14') {
            divOtro.style.display = 'block';
            $("#otros").removeAttr("disabled");
            $("#otros").prop("required", "required");

        } else {
            divOtro.style.display = 'none';
            $("#otros").removeAttr("required");
            $("#otros").prop("disabled", "disabled");
        }
    });

});

/*==========================Crear Caso Tipo Solicitud====================================*/
$(document).ready(function () {
    $("#quinSolicitaCrearAdicion").change(function () {
        var quinSolicita = $("#quinSolicitaCrearAdicion option:selected").val();
        var divOtro = document.getElementById("divOtroAdicion");

        if (quinSolicita === '14') {
            divOtro.style.display = 'block';
            $("#otrosAdicion").removeAttr("disabled");
            $("#otrosAdicion").prop("required", "required");

        } else {
            divOtro.style.display = 'none';
            $("#otrosAdicion").removeAttr("required");
            $("#otrosAdicion").prop("disabled", "disabled");
        }
    });

});


/*==========================Crear Caso Tipo Solicitud====================================*/
$(document).ready(function () {
    $("#permisosQuienSolicita").change(function () {
        var quinSolicita = $("#permisosQuienSolicita option:selected").val();
        var divOtro = document.getElementById("divOtroAdicion");

        if (quinSolicita === '14') {
            divOtro.style.display = 'block';
            $("#otrosAdicion").removeAttr("disabled");
            $("#otrosAdicion").prop("required", "required");

        } else {
            divOtro.style.display = 'none';
            $("#otrosAdicion").removeAttr("required");
            $("#otrosAdicion").prop("disabled", "disabled");
        }
    });

});
$(document).ready(function () {
    $("#permisosQuienSolicita").ready(function () {
        var quinSolicita = $("#permisosQuienSolicita option:selected").val();
        var divOtro = document.getElementById("divOtroAdicion");

        if (quinSolicita === '14') {
            divOtro.style.display = 'block';
            $("#otrosAdicion").removeAttr("disabled");
            $("#otrosAdicion").prop("required", "required");

        } else {
            divOtro.style.display = 'none';
            $("#otrosAdicion").removeAttr("required");
            $("#otrosAdicion").prop("disabled", "disabled");
        }
    });

});





/*==========================Crear Caso Tipo Solicitud====================================*/
$(document).ready(function () {
    $("#llaveQuienSolicita").ready(function () {
        var quinSolicita = $("#llaveQuienSolicita ").val();
        var divOtro = document.getElementById("divOtro");

        if (quinSolicita === '14') {
            divOtro.style.display = 'block';
            $("#otros").removeAttr("disabled");
            $("#otros").prop("required", "required");

        } else {
            divOtro.style.display = 'none';
            $("#otros").removeAttr("required");
            $("#otros").prop("disabled", "disabled");
        }
    });

});


/*==========================Crear Caso Tipo Solicitud====================================*/
$(document).ready(function () {
    $("#btnPasardatos").on("click", function () {
        var cedulaFiliado = $("#afiliadoAgendaComprobar").val();
        var dia = $("#start").val();
        console.log("cedulaFiliado = " + cedulaFiliado);
        console.log("dia = " + dia);
        $.ajax({
            type: "GET",
            url: "../../../dist/js/consulta/SiTieneCitas.php",
            data: {"TxtDia": dia, "TxtCedula": cedulaFiliado}
        }).done(function (data) {
            $("#siTieneCita").html(data).fadeIn();
        });
    });
});

/*==========================Crear Caso Tipo Solicitud====================================*/


/*==========================Mostar quien solicita edit====================================*/
$(document).ready(function () {
    $(".valorEntradaEdit select").change(function () {
        var valorEntradaEdit = $(".valorEntradaEdit option:selected").val();
        var llaveQuienSolicita = $(".llaveQuienSolicita").val();
        console.log("valorEntradaEdit = " + valorEntradaEdit);
        console.log("llaveQuienSolicita = " + llaveQuienSolicita);
        /*=======================Validar Tipo Solicitud Editar===================================*/
        var divpqr = document.getElementById("divPqr");
        if (valorEntradaEdit === '17') {
            $("#Pqr").prop("required", "required");
            divpqr.style.display = 'block';
            $("#Pqr").removeAttr("disabled");
        } else {
            $("#Pqr").removeAttr("divTipoSolicitudEdit");
            $("#Pqr").prop("disabled", "disabled");
            divpqr.style.display = 'none';
        }

        $.ajax({
            type: "GET",
            url: "../../../../../dist/js/listarPcl/listaQuienSolicitaEdit.php",
            data: {"TxtEntrada": valorEntradaEdit, "txtQuienSolicita": llaveQuienSolicita}
        }).done(function (data) {
            $(".editQuienSolicita select").html(data).fadeIn();
        });
    });
});


$(document).ready(function () {
    $(".valorEntradaEdit select").ready(function () {
        var valorEntradaEdit = $(".valorEntradaEdit option:selected").val();
        var llaveTipoSolicitud = $(".llaveTipoSolicitud").val();
        var llaveQuienSolicita = $(".llaveQuienSolicita").val();

        console.log("llaveQuienSolicita = " + llaveQuienSolicita);
        console.log("valorEntradaEdit = " + valorEntradaEdit);
        console.log("llaveQuienSolicita = " + llaveTipoSolicitud);
        /*=======================Validar Tipo Solicitud Editar===================================*/
        var divpqr = document.getElementById("divPqr");
        if (valorEntradaEdit === '17') {
            divpqr.style.display = 'block';
            $("#Pqr").prop("required", "required");
        } else {
            $("#Pqr").removeAttr("divTipoSolicitudEdit");
            $("#Pqr").prop("disabled", "disabled");
            divpqr.style.display = 'none';
        }

        $.ajax({
            type: "GET",
            url: "../../../../../dist/js/listarPcl/listaQuienSolicitaEdit.php",
            data: {"TxtEntrada": valorEntradaEdit, "txtQuienSolicita": llaveQuienSolicita}
        }).done(function (data) {
            $(".editQuienSolicita select").html(data).fadeIn();
        });

        $.ajax({
            type: "GET",
            url: "../../../../../dist/js/listarPcl/listaTipoSolicitudEdit.php",
            data: {"txtTipoSolicitud": llaveTipoSolicitud}
        }).done(function (data) {
            $(".tipoSolicitudLista select").html(data).fadeIn();
        });
    });
});
/*==========================Mostar quien solicita edit====================================*/
$(document).ready(function () {
    $(".valorEntradaEditAdicion").change(function () {
        var valorEntradaEdit = $(".valorEntradaEditAdicion option:selected").val();
        var llaveQuienSolicita = $(".llaveQuienSolicita").val();
        console.log("valorEntradaEdit = " + valorEntradaEdit);
        console.log("llaveQuienSolicita = " + llaveQuienSolicita);
        /*=======================Validar Tipo Solicitud Editar===================================*/

        $.ajax({
            type: "GET",
            url: "../../../../../dist/js/listarPcl/listaQuienSolicitaEdit.php",
            data: {"TxtEntrada": valorEntradaEdit, "txtQuienSolicita": llaveQuienSolicita}
        }).done(function (data) {
            $(".editQuienSolicita select").html(data).fadeIn();
        });
    });
});
$(document).ready(function () {
    $(".valorEntradaEditAdicion").ready(function () {
        var valorEntradaEdit = $(".valorEntradaEditAdicion option:selected").val();
        var llaveQuienSolicita = $(".llaveQuienSolicita").val();
        console.log("valorEntradaEdit = " + valorEntradaEdit);
        console.log("llaveQuienSolicita = " + llaveQuienSolicita);
        /*=======================Validar Tipo Solicitud Editar===================================*/

        $.ajax({
            type: "GET",
            url: "../../../../../dist/js/listarPcl/listaQuienSolicitaEdit.php",
            data: {"TxtEntrada": valorEntradaEdit, "txtQuienSolicita": llaveQuienSolicita}
        }).done(function (data) {
            $(".editQuienSolicita select").html(data).fadeIn();
        });
    });
});



function comprobarUsuarioAtras() {

    location.href = "/home";


    var product = $("#idprueva").val();
    $("#documento").val(product);
    alert(product);

    jQuery.ajax({
        url: "../../../dist/js/consulta/consultaAfiliado.php",
        data: 'documento=' + $("#idprueva").val(),
        type: "POST",
        success: function (data) {
            $('#registros').show();
            $("#estadousuario").html(data);
            $("#loaderIcon").hide();
            $('#formularioPcl').hide();
        },
        error: function () {
        }
    });

    jQuery.ajax({
        url: "../../../dist/js/consulta/consultaAfiliadoDatosBasicos.php",
        data: 'documento=' + $("#idprueva").val(),
        type: "POST",
        success: function (data) {
            $('#formularioBasicoAfiliado').hide();
            $("#formularioBasicoAfiliadoLleno").html(data);
        },
        error: function () {
        }
    });
}

/**==========================Llama la lista Quien SOlicita informe==============================================*/

$(document).ready(function () {
    $("#valorEntradaInforme select").change(function () {
        var canalEntrada = $("#canalEntrada option:selected").val();
        console.log("canalEntrada = " + canalEntrada);
        $.ajax({
            type: "GET",
            url: "../../../../../dist/js/listarPcl/listaQuienSolicitaInforme.php",
            data: {"canalEntrada": canalEntrada},
            success: function (response)
            {
                $('#QuienSolicitainforme select').html(response).fadeIn();
            }
        });
    });
});

/**==========================Llama la lista Quien SOlicita informe==============================================*/
/*$(document).ready(function () {
 $("#estadoInforme select").change(function () {
 var form_data1 = {
 is_ajax: 1,
 estado_siniestro: +$("#estadoInforme select").val()
 };
 $.ajax({
 type: "POST",
 url: "../../../../../dist/js/listarPcl/listaEstadoCalifiacioninforme.php",
 data: form_data1,
 success: function (response)
 {
 $('#subEstadoInforme select').html(response).fadeIn();
 }
 });
 });
 });*/


$(document).ready(function () {
    $("#estadoInformeMostar select").change(function () {
        var estado = $("#estadoInformeMostar option:selected").val();
        console.log("estado = " + estado);
        $.ajax({
            type: "GET",
            url: "../../../../../dist/js/listarPcl/listaEstadoCalifiacioninforme.php",
            data: {"estado": estado},
            success: function (response)
            {
                $('#subEstadoInforme select').html(response).fadeIn();
            }
        });
    });
});

/*==========================Mostar quien solicita edit====================================*/
$(document).ready(function () {
    $("#estadoInforme select").change(function () {
        var entradaInforme = $("#estadoInforme option:selected").val();
        console.log("entradaInforme = " + entradaInforme);

        $.ajax({
            type: "GET",
            url: "../../../../../dist/js/listarPcl/listaEstadoCalifiacioninforme.php",
            data: {"TxInforme": entradaInforme}
        }).done(function (data) {
            $("#subEstadoInforme select").html(data).fadeIn();
        });
    });
});



/*==========================Generar Informe====================================*/
$(document).ready(function () {
    $("#btnInformegeneral").on("click", function () {
        // alert('sdfgdf');
        var canalEntrada = $("#canalEntrada option:selected").val();
        var quienSolicita = $("#quienSolicita option:selected").val();
        var tipoSolicitud = $("#tipoSolicitud option:selected").val();
        var estado = $("#estado option:selected").val();
        var subEstado = $("#subEstado option:selected").val();
        var asigando = $("#asigando option:selected").val();
        var fechaDesde = $("#fechaDesde").val();
        var fechaHasta = $("#fechaHasta").val();

        console.log("canalEntrada = " + canalEntrada);
        console.log("quienSolicita = " + quienSolicita);
        console.log("tipoSolicitud = " + tipoSolicitud);
        console.log("estado = " + estado);
        console.log("subEstado = " + subEstado);
        console.log("asigando = " + asigando);
        console.log("fechaDesde = " + fechaDesde);
        console.log("fechaHasta = " + fechaHasta);
        $.ajax({
            type: "GET",
            url: "../../../../../dist/js/consultaInformes/generalInformes.php",
            data: {"canalEntrada": canalEntrada, "quienSolicita": quienSolicita,
                "tipoSolicitud": tipoSolicitud, "estado": estado, "subEstado": subEstado,
                "asigando": asigando, "fechaDesde": fechaDesde, "fechaHasta": fechaHasta}
        }).done(function (data) {
            //window.location.replace("../../../../../dist/js/consultaInformes/generalInformes.php");
            //$("#exportGeneralFiltro").html(data).fadeIn();
            $('#exportGeneralFiltro').show();
        });
    });
});


/*==========================Generar Informe Completo ====================================*/
$(document).ready(function () {
    $("#btnInformeGeneralCompleto").on("click", function () {
        window.location.replace("../../../../../dist/js/consultaInformes/informeGeneralCompleto.php");

    });
});




/*==========================Generar Informe Calificacion====================================*/
$(document).ready(function () {
    $("#btnBuscarInformeCalificacion").on("click", function () {
        // alert('sdfgdf');
        var canalEntrada = $("#canalEntrada option:selected").val();
        var quienSolicita = $("#quienSolicita option:selected").val();
        var tipoSolicitud = $("#tipoSolicitud option:selected").val();
        var estado = $("#estado option:selected").val();
        var subEstado = $("#subEstado option:selected").val();
        var asigando = $("#asigando option:selected").val();
        var fechaDesde = $("#fechaDesde").val();
        var fechaHasta = $("#fechaHasta").val();

        console.log("canalEntrada = " + canalEntrada);
        console.log("quienSolicita = " + quienSolicita);
        console.log("tipoSolicitud = " + tipoSolicitud);
        console.log("estado = " + estado);
        console.log("subEstado = " + subEstado);
        console.log("asigando = " + asigando);
        console.log("fechaDesde = " + fechaDesde);
        console.log("fechaHasta = " + fechaHasta);
        $.ajax({
            type: "GET",
            url: "../../../../../dist/js/consultaInformes/calificacion/informeCalificacionVariables.php",
            data: {"canalEntradaCa": canalEntrada, "quienSolicitaCa": quienSolicita,
                "tipoSolicitudCa": tipoSolicitud, "estadoCa": estado, "subEstadoCa": subEstado,
                "asigandoCa": asigando, "fechaDesdeCa": fechaDesde, "fechaHastaCa": fechaHasta}
        }).done(function (data) {
            //window.location.replace("../../../../../dist/js/consultaInformes/generalInformes.php");
            //$("#exportGeneralFiltro").html(data).fadeIn();
            $('#exportGeneralFiltro').show();
        });
    });
});


/*==========================Generar Informe Completo Calificacion====================================*/
$(document).ready(function () {
    $("#btnInformeGeneralCompletoCalificacion").on("click", function () {
        window.location.replace("../../../../../dist/js/consultaInformes/calificacion/informeCalificacionCompleto.php");

    });
});


/*==========================Generar Informe ReCalificacion====================================*/
$(document).ready(function () {
    $("#btnBuscarReCalificacion").on("click", function () {
        // alert('sdfgdf');
        var canalEntrada = $("#canalEntrada option:selected").val();
        var quienSolicita = $("#quienSolicita option:selected").val();
        var tipoSolicitud = $("#tipoSolicitud option:selected").val();
        var estado = $("#estado option:selected").val();
        var subEstado = $("#subEstado option:selected").val();
        var asigando = $("#asigando option:selected").val();
        var fechaDesde = $("#fechaDesde").val();
        var fechaHasta = $("#fechaHasta").val();

        console.log("canalEntrada = " + canalEntrada);
        console.log("quienSolicita = " + quienSolicita);
        console.log("tipoSolicitud = " + tipoSolicitud);
        console.log("estado = " + estado);
        console.log("subEstado = " + subEstado);
        console.log("asigando = " + asigando);
        console.log("fechaDesde = " + fechaDesde);
        console.log("fechaHasta = " + fechaHasta);
        $.ajax({
            type: "GET",
            url: "../../../../../dist/js/consultaInformes/reCalificacion/informeReCalificacionVariables.php",
            data: {"canalEntradaRe": canalEntrada, "quienSolicitaRe": quienSolicita,
                "tipoSolicitudRe": tipoSolicitud, "estadoRe": estado, "subEstadoRe": subEstado,
                "asigandoRe": asigando, "fechaDesdeRe": fechaDesde, "fechaHastaRe": fechaHasta}
        }).done(function (data) {
            //window.location.replace("../../../../../dist/js/consultaInformes/generalInformes.php");
            //$("#exportGeneralFiltro").html(data).fadeIn();
            $('#exportGeneralFiltro').show();
        });
    });
});




/*==========================Generar Informe ReCalificacion====================================*/
$(document).ready(function () {
    $("#btbPrePalificacion").on("click", function () {

        var canalEntrada = $("#canalEntrada option:selected").val();
        var quienSolicita = $("#quienSolicita option:selected").val();
        var tipoSolicitud = $("#tipoSolicitud option:selected").val();
        var estado = $("#estado option:selected").val();
        var subEstado = $("#subEstado option:selected").val();
        var asigando = $("#asigando option:selected").val();
        var fechaDesde = $("#fechaDesde").val();
        var fechaHasta = $("#fechaHasta").val();

        console.log("canalEntrada = " + canalEntrada);
        console.log("quienSolicita = " + quienSolicita);
        console.log("tipoSolicitud = " + tipoSolicitud);
        console.log("estado = " + estado);
        console.log("subEstado = " + subEstado);
        console.log("asigando = " + asigando);
        console.log("fechaDesde = " + fechaDesde);
        console.log("fechaHasta = " + fechaHasta);
        //alert(fechaHasta);
        $.ajax({
            type: "GET",
            url: "../../../../../dist/js/consultaInformes/preCalificacion/informePrecalificacionVariables.php",
            data: {"canalEntradaPre": canalEntrada, "quienSolicitaPre": quienSolicita,
                "tipoSolicitudPre": tipoSolicitud, "estadoPre": estado, "subEstadoPre": subEstado,
                "asigandoPre": asigando, "fechaDesdePre": fechaDesde, "fechaHastaPre": fechaHasta}
        }).done(function (data) {
            //window.location.replace("../../../../../dist/js/consultaInformes/generalInformes.php");
            //$("#exportGeneralFiltro").html(data).fadeIn();
            $('#exportGeneralFiltro').show();
        });
    });
});



/*==========================Generar Informe ReCalificacion====================================*/
$(document).ready(function () {
    $("#btnAdicion").on("click", function () {

        var canalEntrada = $("#canalEntrada option:selected").val();
        var quienSolicita = $("#quienSolicita option:selected").val();
        var tipoSolicitud = $("#tipoSolicitud option:selected").val();
        var estado = $("#estado option:selected").val();
        var subEstado = $("#subEstado option:selected").val();
        var asigando = $("#asigando option:selected").val();
        var fechaDesde = $("#fechaDesde").val();
        var fechaHasta = $("#fechaHasta").val();

        console.log("canalEntrada = " + canalEntrada);
        console.log("quienSolicita = " + quienSolicita);
        console.log("tipoSolicitud = " + tipoSolicitud);
        console.log("estado = " + estado);
        console.log("subEstado = " + subEstado);
        console.log("asigando = " + asigando);
        console.log("fechaDesde = " + fechaDesde);
        console.log("fechaHasta = " + fechaHasta);
        //alert(fechaHasta);
        $.ajax({
            type: "GET",
            url: "../../../../../dist/js/consultaInformes/adicion/informeAdicionVariables.php",
            data: {"canalEntradaAdi": canalEntrada, "quienSolicitaAdi": quienSolicita,
                "tipoSolicitudAdi": tipoSolicitud, "estadoAdi": estado, "subEstadoAdi": subEstado,
                "asigandoAdi": asigando, "fechaDesdeAdi": fechaDesde, "fechaHastaAdi": fechaHasta}
        }).done(function (data) {
            //window.location.replace("../../../../../dist/js/consultaInformes/generalInformes.php");
            //$("#exportGeneralFiltro").html(data).fadeIn();
            $('#exportGeneralFiltro').show();
        });
    });
});

/*==========================Generar Informe Completo ReCalificacion====================================*/
$(document).ready(function () {
    $("#btnInformePrePalificacionGeneralCompleto").on("click", function () {
        window.location.replace("../../../../../dist/js/consultaInformes/preCalificacion/informePrecalificacionCompleto.php");

    });
});

/*==========================Generar Informe Completo ReCalificacion====================================*/
$(document).ready(function () {
    $("#btnInformeGeneralCompletoRecalificacion").on("click", function () {
        window.location.replace("../../../../../dist/js/consultaInformes/reCalificacion/informeReCalificacionCompleto.php");

    });
});
/*==========================Generar Informe Completo Adicion====================================*/
$(document).ready(function () {
    $("#btnAdicionCompleto").on("click", function () {
        window.location.replace("../../../../../dist/js/consultaInformes/adicion/informeAdicionCompleto.php");

    });
});


/*==========================validar Campo PCL ====================================*/

$(".PclValidacion").keypress(function (e) {
    var value = $(".PclValidacion").val() + String.fromCharCode(e.which);
    var splits = value.split(",");

    if (splits.length > 1) {
        value = splits[splits.length - 1];
    }
    var finalValue = "";
    var a = 0;

    for (var i = 0; i < value.length; i++) {
        if (a === 0) {
            if (i % 2 === 0 && i !== 0) {
                a = 2;
                finalValue = finalValue + ',';
            }
        }
        finalValue = finalValue + value.charAt(i);
    }

    if (splits.length > 1) {
        splits.splice(splits.length - 1);
        var concat = splits.concat(finalValue);
        finalValue = concat.join();
        this.value = this.value.slice(0, 5);
    }
    if (this.value.length < 4) {
        this.value = this.value.slice(0, 4);
        $(".PclValidacion").val(finalValue.substring(0, finalValue.length - 1));
    }
});



function filterFloat(evt, input) {
    var key = window.Event ? evt.which : evt.keyCode;
    var chark = String.fromCharCode(key);
    var tempValue = input.value + chark;

    if (key >= 48 && key <= 57) {
        if (filter(tempValue) === false) {
            return false;

        } else {
            return true;

        }
    } else {
        if (key === 8 || key === 13 || key === 0) {
            return true;
        } else if (key === 46) {
            if (filter(tempValue) === false) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
}
function filter(__val__) {
    var preg = /^([0-9]{1,2}\,?[0-9]{0,2})$/;
    if (preg.test(__val__) === true) {
        return true;
    } else {
        return false;
    }

}


/*==========================validar Campo PCL Recalificacion====================================*/

$(".PclValidacionRecali").keypress(function (e) {
    var value = $(".PclValidacionRecali").val() + String.fromCharCode(e.which);
    var splits = value.split(",");

    if (splits.length > 1) {
        value = splits[splits.length - 1];
    }
    var finalValue = "";
    var a = 0;

    for (var i = 0; i < value.length; i++) {
        if (a === 0) {
            if (i % 2 === 0 && i !== 0) {
                a = 2;
                finalValue = finalValue + ',';
            }
        }
        finalValue = finalValue + value.charAt(i);
    }

    if (splits.length > 1) {
        splits.splice(splits.length - 1);
        var concat = splits.concat(finalValue);
        finalValue = concat.join();
        this.value = this.value.slice(0, 5);
    }
    if (this.value.length < 4) {
        this.value = this.value.slice(0, 4);
        $(".PclValidacionRecali").val(finalValue.substring(0, finalValue.length - 1));
    }
});



function filterFloatRecali(evt, input) {
    var key = window.Event ? evt.which : evt.keyCode;
    var chark = String.fromCharCode(key);
    var tempValue = input.value + chark;

    if (key >= 48 && key <= 57) {
        if (filterRecali(tempValue) === false) {
            return false;

        } else {
            return true;

        }
    } else {
        if (key === 8 || key === 13 || key === 0) {
            return true;
        } else if (key === 46) {
            if (filterRecali(tempValue) === false) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
}
function filterRecali(__val__) {
    var preg = /^([0-9]{1,2}\,?[0-9]{0,2})$/;
    if (preg.test(__val__) === true) {
        return true;
    } else {
        return false;
    }

}



$(document).ready(function () {
    $("#permisosTTSolicitud").change(function () {
        var permisosTTSolicitud = $("#permisosTTSolicitud option:selected").val();

        var medicoRecalificacion = document.getElementById("medicoRecalificacion");

//mediRecalifi
        if (permisosTTSolicitud === '5') {
            medicoRecalificacion.style.display = 'block';
            $("#mediRecalifi").prop("required", "required");
        } else {
            $("#mediRecalifi").prop("disabled", "disabled");
            medicoRecalificacion.style.display = 'none';
        }
    });
});


/**==========================ciudad==============================================*/
$(document).ready(function () {
    $(".departa select").change(function () {
        var form_data1 = {
            is_ajax: 1,
            idDespartamento: +$(".departa select").val()
        };
        $.ajax({
            type: "POST",
            url: "../../../dist/js/departamento/ciudad.php",
            data: form_data1,
            success: function (response)
            {
                $('.ciuidadM select').html(response).fadeIn();
            }
        });
    });
});
/**==========================ciudad==============================================*/
$(document).ready(function () {
    $(".departaEdit").change(function () {
        var departa = $(".departaEdit   option:selected").val();
        var ciudad = $("#ciuidadEdit").val();
        console.log("departa = " + departa);
        console.log("ciudad = " + ciudad);
        /*=======================Validar Tipo Solicitud Editar===================================*/

        $.ajax({
            type: "GET",
            url: "../../../dist/js/departamento/ciudadEdit.php",
            data: {"departamento": departa, "ciudad": ciudad}
        }).done(function (data) {
            $(".ciuidadMostar select").html(data).fadeIn();
        });
    });
});

$(document).ready(function () {
    $(".departaEdit").ready(function () {
        var departa = $(".departaEdit   option:selected").val();
        var ciudad = $("#ciuidadEdit").val();
        console.log("departa = " + departa);
        console.log("ciudad = " + ciudad);
        /*=======================Validar Tipo Solicitud Editar===================================*/

        $.ajax({
            type: "GET",
            url: "../../../dist/js/departamento/ciudadEdit.php",
            data: {"departamento": departa, "ciudad": ciudad}
        }).done(function (data) {
            $(".ciuidadMostar select").html(data).fadeIn();
        });
    });
});




function Comprobar(formulario)
{
    var folio = document.getElementById('folio').value;
    var id = $("#idSiniestro").val();

    if (folio.length !== 0)
    {
        setTimeout(redirigir, 2000);
        function redirigir() {
            window.location = "/Siniestro/" + id + "/edit";
        }
    }
}
function Comprobar4(formulario)
{
    var folio = document.getElementById('folio').value;
    var id = $("#idSiniestro").val();

    if (folio.length !== 0)
    {
        setTimeout(redirigir, 2000);
        function redirigir() {
            window.location = "/Adicion/" + id + "/edit";
        }
    }
}

function Comprobar2(formulario)
{
    var id = $("#idSiniestro").val();

    var TxtFecha = $("#TxtFecha").val();
    var TxtGenero = $("#TxtGenero").val();
    var TxtNombreEmpresa = $("#TxtNombreEmpresa").val();
    var TxtCargo = $("#TxtCargo").val();
    var TxtAntiguedadEmpresa = $("#TxtAntiguedadEmpresa").val();
    var TxtHistoriaClinica = $("#TxtHistoriaClinica").val();
    var TxtEstudios = $("#TxtEstudios").val();
    var TxtResumen = $("#TxtResumen").val();
    var TxtultimoResultado = $("#TxtultimoResultado").val();
    var TxtTipoExamen = $("#TxtTipoExamen").val();
    var TxtId = $("#TxtId").val();
    var TxtConclusion = $("#TxtConclusion").val();

    var radio1 = $("#radio1").val();
    var radio2 = $("#radio2").val();
    var radio3 = $("#radio3").val();
    var radio4 = $("#radio4").val();
    var radio5 = $("#radio5").val();
    var radio6 = $("#radio6").val();
    var radio7 = $("#radio7").val();
    var radio8 = $("#radio8").val();
    var radio9 = $("#radio9").val();
    var radio0 = $("#radio0").val();
    var medicoRecalificacion = document.getElementById("bottonFormato");

    if (radio6.length !== 0 || radio7.length !== 0 || radio8.length !== 0 || radio9.length !== 0 || radio0.length !== 0) {
        if (radio1.length !== 0 || radio2.length !== 0 || radio3.length !== 0 || radio4.length !== 0 || radio5.length !== 0) {
            if (TxtAntiguedadEmpresa.length !== 0 && TxtCargo.length !== 0 && TxtNombreEmpresa.length !== 0 && TxtGenero.length !== 0 && TxtFecha.length !== 0) {
                if (TxtConclusion.length !== 0 && TxtId.length !== 0 && TxtTipoExamen.length !== 0 && TxtultimoResultado.length !== 0 && TxtResumen.length !== 0 && TxtEstudios.length !== 0 && TxtHistoriaClinica.length !== 0) {
                    setTimeout(redirigir, 2000);
                    function redirigir() {
                        window.location = "/CartaNegacion/" + id + "/edit";
                    }

                }
            }
        }
    }
}





function Comprobar3(formulario)
{
    var id = $("#idSiniestro").val();

    var TxtFecha = $("#TxtFecha").val();
    var TxtGenero = $("#TxtGenero").val();
    var TxtNombreEmpresa = $("#TxtNombreEmpresa").val();
    var TxtCargo = $("#TxtCargo").val();
    var TxtAntiguedadEmpresa = $("#TxtAntiguedadEmpresa").val();
    var TxtHistoriaClinica = $("#TxtHistoriaClinica").val();
    var TxtEstudios = $("#TxtEstudios").val();
    var TxtResumen = $("#TxtResumen").val();
    var TxtultimoResultado = $("#TxtultimoResultado").val();
    var TxtTipoExamen = $("#TxtTipoExamen").val();
    var TxtId = $("#TxtId").val();
    var TxtConclusion = $("#TxtConclusion").val();

    var radio1 = $("#radio1").val();
    var radio2 = $("#radio2").val();
    var radio3 = $("#radio3").val();
    var radio4 = $("#radio4").val();
    var radio5 = $("#radio5").val();
    var radio6 = $("#radio6").val();
    var radio7 = $("#radio7").val();
    var radio8 = $("#radio8").val();
    var radio9 = $("#radio9").val();
    var radio0 = $("#radio0").val();
    var medicoRecalificacion = document.getElementById("bottonFormato");

    if (radio6.length !== 0 || radio7.length !== 0 || radio8.length !== 0 || radio9.length !== 0 || radio0.length !== 0) {
        if (radio1.length !== 0 || radio2.length !== 0 || radio3.length !== 0 || radio4.length !== 0 || radio5.length !== 0) {
            if (TxtAntiguedadEmpresa.length !== 0 && TxtCargo.length !== 0 && TxtNombreEmpresa.length !== 0 && TxtGenero.length !== 0 && TxtFecha.length !== 0) {
                if (TxtConclusion.length !== 0 && TxtId.length !== 0 && TxtTipoExamen.length !== 0 && TxtultimoResultado.length !== 0 && TxtResumen.length !== 0 && TxtEstudios.length !== 0 && TxtHistoriaClinica.length !== 0) {
                    setTimeout(redirigir, 2000);
                    function redirigir() {
                        window.location = "/CartaNegacionAdicion/" + id + "/edit";
                    }

                }
            }
        }
    }
}
function finestraSecundaria(url) {
    window.open(url, "Simel", "width=900, height=900")
}


/*==========================Graficas por mes PCL====================================*/
$(document).ready(function () {
    $("#btnFiltroPorMas").on("click", function () {
        var fechaDesde = $("#fechaDesdePorMes").val();
        var fechaHasta = $("#fechaHastaPorMes").val();

        console.log("fechaDesde = " + fechaDesde);
        console.log("fechaHasta = " + fechaHasta);
        //alert(fechaHasta);
        $.ajax({
            type: "GET",
            url: "../../../dist/js/graficas/asignadosVrsGestionados.blade.php",
            data: {"fechaDesdeAdi": fechaDesde, "fechaHastaAdi": fechaHasta}
        }).done(function (data) {

            $("#porMesUno").html(data);
        });
        //alert(fechaHasta);
        $.ajax({
            type: "GET",
            url: "../../../dist/js/graficas/GestionadoVrsNoPenitente.blade.php",
            data: {"fechaDesdeAdi": fechaDesde, "fechaHastaAdi": fechaHasta}
        }).done(function (data) {

            $("#porMesDos").html(data);
        });
        $.ajax({
            type: "GET",
            url: "../../../dist/js/graficas/empresas.blade.php",
            data: {"fechaDesdeAdi": fechaDesde, "fechaHastaAdi": fechaHasta}
        }).done(function (data) {

            $("#porMesEmpresas").html(data);
        });
        $.ajax({
            type: "GET",
            url: "../../../dist/js/graficas/datosMensual.blade.php",
            data: {"fechaDesdeAdi": fechaDesde, "fechaHastaAdi": fechaHasta}
        }).done(function (data) {

            $("#indicadorMensual").html(data);
        });

    });
});


/*==========================Graficas Quien Solicita====================================*/
$(document).ready(function () {
    $("#btnFiltroQuienSolicita").on("click", function () {
        var fechaDesde = $("#fechaDesdeQuien").val();
        var fechaHasta = $("#fechaHastaQuien").val();
        var quienSolicita = $("#quienSolicita option:selected").val();


        console.log("fechaDesde = " + fechaDesde);
        console.log("fechaHasta = " + fechaHasta);
        console.log("quienSolicita = " + quienSolicita);

        $.ajax({
            type: "GET",
            url: "../../../dist/js/graficas/volumenQuienSolicita.blade.php",
            data: {"fechaDesdeAdi": fechaDesde, "fechaHastaAdi": fechaHasta, "quienSolicita": quienSolicita}
        }).done(function (data) {

            $("#quienSoliMostrar").html(data);
        });
    });
});

/*==========================Graficas Quien Solicita====================================*/
$(document).ready(function () {
    $("#BtnFiltroTipoSolicitud").on("click", function () {
        var fechaDesde = $("#fechaDesdeTipo").val();
        var fechaHasta = $("#fechaHastaTipo").val();
        var tipoSolicitudse = $("#tipoSolicitudse option:selected").val();


        console.log("fechaDesde = " + fechaDesde);
        console.log("fechaHasta = " + fechaHasta);
        console.log("tipoSolicitudse = " + tipoSolicitudse);

        $.ajax({
            type: "GET",
            url: "../../../dist/js/graficas/volumenTipoSolicitud.blade.php",
            data: {"fechaDesdeAdi": fechaDesde, "fechaHastaAdi": fechaHasta, "tipoSolicitudse": tipoSolicitudse}
        }).done(function (data) {

            $("#tipoSolicitudMostr").html(data);
        });
    });
});

/*=======================Cargue Archivo masivo===============================*/
document.getElementById('fake-file-button-browse').addEventListener('click', function () {
    document.getElementById('files-input-upload').click();
});

document.getElementById('files-input-upload').addEventListener('change', function () {
    document.getElementById('fake-file-input-name').value = this.value;
    document.getElementById('fake-file-button-upload').removeAttribute('disabled');
});
/*=======================Fin Cargue Archivo masivo===============================*/

