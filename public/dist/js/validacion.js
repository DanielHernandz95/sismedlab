/*=======================Cargue Archivo masivo===============================*/
document.getElementById('fake-file-button-browse').addEventListener('click', function () {
    document.getElementById('files-input-upload').click();
});

document.getElementById('files-input-upload').addEventListener('change', function () {
    document.getElementById('fake-file-input-name').value = this.value;
    document.getElementById('fake-file-button-upload').removeAttribute('disabled');
});
/*=======================Fin Cargue Archivo masivo===============================*/
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
    requiereValoracion.style.display = 'none';
    $("#fechaContacto").removeAttr("required");
    $("#subEstadoCita").removeAttr("required");
    $("#seguimientotext").removeAttr("required");
    $('#requiereValoracionSi').removeClass('active');
    $('#requiereValoracionNo').removeClass('active');
    $("#medico").removeAttr("required");
    $("#profesional").prop("required", "required");

}

//        $("#TxtSubEstadol").removeAttr("required");
//        $("#origen").prop("required", "required");

function noneContent() {
    element = document.getElementById("requiValo");
    profesional = document.getElementById("requiereProfesional");
    element.style.display = 'block';
    profesional.style.display = 'none';
    $("#medico").removeAttr("required");
    $("#profesional").removeAttr("required");

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

}
function noneValoracion() {
    element2 = document.getElementById("requiereValoracion");
    medico = document.getElementById("requiereMedico");
    element2.style.display = 'none';
    medico.style.display = 'block';
    $("#fechaContacto").removeAttr("required");
    $("#subEstadoCita").removeAttr("required");
    $("#seguimientotext").removeAttr("required");
    $("#medico").prop("required", "required");
    $("#profesional").removeAttr("required");

}


/*=============================Cargar Empresa Gestion Siniestro PCL===========================================**/
$(document).ready(function () {
    $("#requiereValoracionPresen").ready(function () {
        requiere = $("#requiereValoracionPresen").val();
        profesional = document.getElementById("requiereProfesional");
        medico = document.getElementById("requiereMedico");

        if (requiere === 'SI') {
            $("#requierePreCalificacionSi").addClass("active");
            profesional.style.display = 'block';
        }
        if (requiere === 'NO') {
            $("#requierePreCalificacionNo").addClass("active");
            medico.style.display = 'block';
        }

        /* element = document.getElementById("requiValo");
         profesional = document.getElementById("requiereProfesional");
         element.style.display = 'block';
         profesional.style.display = 'none';
         $("#medico").removeAttr("required");
         $("#profesional").removeAttr("required");*/
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
    $(".idSiniestroDxPcl").ready(function () {
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

/**==============================Mostar Formulario seguimiento================================================*/
$(document).ready(function () {
    $("#prueba").click(function () {
        $("#boton").prop("disabled", false);
    });
});
function Seguimiento() {
    if ($('#seguimientoDiv').is(':hidden')) {
        document.getElementById('seguimientoDiv').style.display = 'block';
    } else {
        document.getElementById('seguimientoDiv').style.display = 'none';
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
                $("#recargar").html(data);
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

        $.ajax({
            type: "GET",
            url: "../../../dist/js/seguimiento/addSeguimiento.php",
            data: {"TxtTipoSeguimiento": tipoSeguimiento, "TxtSubEstado": subEstado, "TxtFechaContactoAfiliado": fechaContacto, "TxtSeguimiento": seguimiento, "TxtSiniestroPclSe": idSiniestroPclSe, "TxtRevisadoPor": revisadoPor} // la coma que habia aqui no es necesaria
        }).done(function (data) {
            Swal.fire({
                title: 'Oops...',
                type: ' warning',
                text: 'El siniestro ya se encuentra registrado en el sistema!'
            });
            document.getElementById('TxtFechaContactoAfiliado').value = "";
            document.getElementById('TxtSubEstado').value = "";
            document.getElementById('TxtSeguimiento').value = "";
            $("#seguimientoDiv").hide();

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
                        $("#recargar").html(data);
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
        estado = $("#estadoPrecalificacio option:selected").val();
        solicitudAnexos = document.getElementById("solicitudAnexosDiv");
        fechaAnexos = document.getElementById("fechaAnexosDiv");
        subEstado = document.getElementById("SubestadoDiv");
        puedoCalificar = document.getElementById("PuedoCalificar");

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
            /*==============Solicitud de anexos=========================*/
            solicitudAnexos.style.display = 'block';
            fechaAnexos.style.display = 'block';
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
        estado = $("#estadoPrecalificacio option:selected").val();
        solicitudAnexos = document.getElementById("solicitudAnexosDiv");
        fechaAnexos = document.getElementById("fechaAnexosDiv");
        subEstado = document.getElementById("SubestadoDiv");
        puedoCalificar = document.getElementById("PuedoCalificar");

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
            /*==============Solicitud de anexos=========================*/
            solicitudAnexos.style.display = 'block';
            fechaAnexos.style.display = 'block';
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
    $("#estadoCalificacion").change(function () {
        estadoCali = $("#estadoCalificacion option:selected").val();
        solicitudAnexosCali = document.getElementById("solicitudAnexosCalifiDiv");
        fechaAnexosCali = document.getElementById("fechaAnexoCalifiDiv");
        subEstadoCali = document.getElementById("SubestadoDiv");
        puedoCalificarCali = document.getElementById("PuedoCalificar");

        if (estadoCali === '49') {
            /*==============Solicitud de anexos=========================*/
            fechaAnexosCali.style.display = 'block';
            solicitudAnexosCali.style.display = 'block';
            $("#TxtFechaAnexosCali").prop("required", "required");
            $("#TxtSolicitudAnexoCali").prop("required", "required");
            /*==============Fin Solicitud de anexos=========================*/

        } else {
            /*==============Solicitud de anexos=========================*/
            fechaAnexosCali.style.display = 'none';
            solicitudAnexosCali.style.display = 'none';
            $("#TxtFechaAnexosCali").removeAttr("required");
            $("#TxtSolicitudAnexoCali").removeAttr("required");
            /*==============Fin Solicitud de anexos=========================*/
        }
    });
});
$(document).ready(function () {
    $("#estadoCalificacion").ready(function () {
        estadoCali = $("#estadoCalificacion option:selected").val();
        solicitudAnexosCali = document.getElementById("solicitudAnexosCalifiDiv");
        fechaAnexosCali = document.getElementById("fechaAnexoCalifiDiv");
        subEstadoCali = document.getElementById("SubestadoDiv");
        puedoCalificarCali = document.getElementById("PuedoCalificar");

        if (estadoCali === '49') {
            /*==============Solicitud de anexos=========================*/
            fechaAnexosCali.style.display = 'block';
            solicitudAnexosCali.style.display = 'block';
            $("#TxtFechaAnexosCali").prop("required", "required");
            $("#TxtSolicitudAnexoCali").prop("required", "required");
            /*==============Fin Solicitud de anexos=========================*/

        } else {
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






