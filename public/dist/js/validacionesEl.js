
$.widget.bridge('uibutton', $.ui.button);
/**--------------------------Comprobar Afiliado----------------------------------------------*/
function comprobarUsuarioEl() {
    $("#loaderIcon").show();
    jQuery.ajax({
        url: "../../../dist/js/consulta/consultasEl/consultaAfiliadoEl.php",
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
            $('#formularioBasicoAfiliadoEl').hide();
            $("#formularioBasicoAfiliadoLlenoEl").html(data);
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
/**--------------------------Comprobar Eps----------------------------------------------*/
function eps() {
    jQuery.ajax({
        url: "../../../dist/js/consulta/consultaEps.php",
        data: 'idEps=' + $("#idEps").val(),
        type: "POST",
        success: function (data) {
            $("#epsExiste").html(data);
        },
        error: function () {}
    });
}
/**--------------------------cargar Eps----------------------------------------------*/
$(document).ready(function () {
    $("#idEps select").ready(function () {

        $.ajax({
            type: "POST",
            url: "../../../dist/js/consulta/consultaEps.php",
            data: 'idEps=' + $("#idEps").val(),
            success: function (data)
            {
                $("#epsExiste").html(data);
            }
        });
    });
});


/**--------------------------Comprobar Siniestro----------------------------------------------*/

function comprobarSiniestro() {
    jQuery.ajax({
        url: "../../../dist/js/consulta/consultasEl/siniestroExisteEl.php",
        data: 'siniestroExis=' + $("#siniestroExis").val(),
        type: "POST",
        success: function (data) {
            $("#existeSiniestro").html(data);

        },
        error: function () {
        }
    });
}

/**==========================ciudad siniestro==============================================*/
$(document).ready(function () {
    $(".departaSiniestro select").change(function () {
        var diudadConsulta = {
            is_ajax: 1,
            idDespartamento: +$(".departaSiniestro select").val()
        };
        $.ajax({
            type: "POST",
            url: "../../../dist/js/departamento/ciudadEl.php",
            data: diudadConsulta,
            success: function (response)
            {
                $('.ciuidadMSiniestro select').html(response).fadeIn();
            }
        });
    });
});

$(document).ready(function () {
    $(".departaSiniestro").ready(function () {
        const departa = $(".departaSiniestro   option:selected").val();
        const ciudad = $("#ciuidadEditEl").val();
        console.log("departa = " + departa);
        console.log("ciudad = " + ciudad);
        $.ajax({
            type: "GET",
            url: "../../../dist/js/departamento/ciudadEditEl.php",
            data: {"departamento": departa, "ciudad": ciudad}
        }).done(function (data) {
            $(".ciuidadMSiniestro select").html(data).fadeIn();
        });
    });
});

/**==========================ciudad Afilido=============================================*/
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

$(document).ready(function () {
    $(".departaEdit").ready(function () {
        const departaAfi = $(".departaEdit   option:selected").val();
        const ciudadAfi = $("#ciuidadEditAfiliado").val();
        console.log("departa = " + departaAfi);
        console.log("ciudad = " + ciudadAfi);
        /*=======================Validar Tipo Solicitud Editar===================================*/

        $.ajax({
            type: "GET",
            url: "../../../dist/js/departamento/ciudadEdit.php",
            data: {"departamento": departaAfi, "ciudad": ciudadAfi}
        }).done(function (data) {
            $(".ciuidadM select").html(data).fadeIn();
        });
    });
});



/**==========================Cuidad Uno tipo entrada==============================================*/
$(document).ready(function () {
    $("#canalEntradaEl").change(function () {
        var SlsCanal = document.getElementById("canalEntradaEl");//seleccionamos el texto del origen
        var canalEntradaEl = SlsCanal.options[SlsCanal.selectedIndex].text;//asignamos a la variable  el texto del origen
        const cuida = document.getElementById("CuidaUno");

        if (canalEntradaEl === 'BANDEJA CUIDA 1') {
            cuida.style.display = 'block';
            $("#TxtFechaRevision").prop("required", "required");
            $("#TxtAfiliacion").prop("required", "required");
            $("#TxtCreado").prop("required", "required");
            $("#TxtFechaCreacion").prop("required", "required");
            $("#TxtEstadoInicial").prop("required", "required");
            $("#TxtGestionRealizar").prop("required", "required");
            $("#TxtEstadoTramite").prop("required", "required");
            $("#TxtEstadoFinal").prop("required", "required");

        } else {
            cuida.style.display = 'none';
            $("#TxtFechaRevision").removeAttr("required");
            $("#TxtAfiliacion").removeAttr("required");
            $("#TxtCreado").removeAttr("required");
            $("#TxtFechaCreacion").removeAttr("required");
            $("#TxtEstadoInicial").removeAttr("required");
            $("#TxtGestionRealizar").removeAttr("required");
            $("#TxtEstadoTramite").removeAttr("required");
            $("#TxtEstadoFinal").removeAttr("required");

        }
    });
});

/**==========================Cuidad Uno tipo entrada==============================================*/
$(document).ready(function () {
    $("#SlsCrearSiniestroTipoSoli").change(function () {
        var SlsTipoSolicitud = document.getElementById("SlsCrearSiniestroTipoSoli");//seleccionamos el texto del origen
        var tipoSolicitud = SlsTipoSolicitud.options[SlsTipoSolicitud.selectedIndex].text;//asignamos a la variable  el texto del origen
        const DivNumeroRadicado = document.getElementById("DivNumeroRadicado");
        const divInfoEps = document.getElementById("divInfoEps");

        if (tipoSolicitud === 'DETERMINACION DE ORIGEN POR EPS') {
            DivNumeroRadicado.style.display = 'block';
            $("#TxtNumeroRadicado").prop("required", "required");
            divInfoEps.style.display = 'block';
            $("#idEps").prop("required", "required");
            $("#TxtFolio").prop("required", "required");

        } else if (tipoSolicitud === 'DETERMINACION DE ORIGEN PRIMERA OPORTUNIDAD') {
            divInfoEps.style.display = 'none';
            DivNumeroRadicado.style.display = 'none';
            $("#TxtNumeroRadicado").removeAttr("required");
            $("#idEps").removeAttr("required");
            $("#TxtFolio").removeAttr("required");

        } else {
            DivNumeroRadicado.style.display = 'none';
            divInfoEps.style.display = 'block';
            $("#idEps").prop("required", "required");
            $("#TxtNumeroRadicado").removeAttr("required");
            $("#TxtFolio").prop("required", "required");

        }
    });
});


/**==========================Cuidad Uno tipo entrada==============================================*/
$(document).ready(function () {
    $("#cuidadUnoDato").ready(function () {
        const  canalEntradaElEdit = $("#cuidadUnoDato").val();
        const cuidaEdit = document.getElementById("cuidaUnoEdit");

        if (canalEntradaElEdit !== '') {
            cuidaEdit.style.display = 'block';
            $("#TxtFechaRevision").prop("required", "required");
            $("#TxtAfiliacion").prop("required", "required");
            $("#TxtCreado").prop("required", "required");
            $("#TxtFechaCreacion").prop("required", "required");
            $("#TxtEstadoInicial").prop("required", "required");
            $("#TxtGestionRealizar").prop("required", "required");
            $("#TxtEstadoTramite").prop("required", "required");
            $("#TxtEstadoFinal").prop("required", "required");
        }
    });
});
/*=============================Cargar Empresa Gestion Siniestro EL===========================================**/
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

/**==========================Mostar Cie EL =============================================*/
$(document).ready(function () {
    $("#idSiniestroDxEL").ready(function () {
        jQuery.ajax({
            url: "../../../dist/js/consulta/mostarDxEl.php",
            data: 'idSiniestroDxEL=' + $("#idSiniestroDxEL").val(),
            type: "POST",
            success: function (data) {
                $("#tablaCie10SiniestroEl").html(data);
            },
            error: function () {}
        });
    });
});

/**==========================Tipo de solicituis habilita estado y definicion==============================================*/
$(document).ready(function () {
    $("#Txtsolicitud").ready(function () {
        const solicitud = $("#Txtsolicitud").val();
        const oportunidadEps = document.getElementById("oportunidadEps");
        const oportunidadPositiva = document.getElementById("oportunidadPositiva");
        const estadoEps = document.getElementById("EstadoEps");
        const estadoArl = document.getElementById("EstadoArl");
        const EstadoSolo = document.getElementById("EstadoSolo");

        const divSustentacionMedico = document.getElementById("divSustentacionMedico");

        const DivFechaIngresoPruebas = document.getElementById("DivFechaIngresoPruebas");
        const DivCanalEntradaPruebas = document.getElementById("DivCanalEntradaPruebas");
        const DivNumeroRadicadoSalida = document.getElementById("DivNumeroRadicadoSalida");
        const DivRadicadoSalida = document.getElementById("DivRadicadoSalida");


        if (solicitud === 'DETERMINACION DE ORIGEN POR EPS') {

            oportunidadPositiva.style.display = 'none';
            estadoArl.style.display = 'none';
            $("#SlsEstadoArl").removeAttr("required");
            $("#TxtAfiliacion").removeAttr("required");

            oportunidadEps.style.display = 'block';
            estadoEps.style.display = 'block';
            $("#SlsEstadoEps").prop("required", "required");
            $("#SlsOportunidadEps").prop("required", "required");

            divSustentacionMedico.style.display = 'block';
            $("#TxtSustentacionMedico").prop("required", "required");

            DivFechaIngresoPruebas.style.display = 'block';
            DivCanalEntradaPruebas.style.display = 'block';
            DivNumeroRadicadoSalida.style.display = 'block';
            DivRadicadoSalida.style.display = 'block';
            $("#TxtRadicadoSalida").prop("required", "required");
            $("#TxtCanalEntradaPruebas").prop("required", "required");
            $("#TxtRadicadoEntradaPruebas").prop("required", "required");
            $("#TxtFechaIngresoPruebas").prop("required", "required");
            $("#TxtNumeroRadicadoSalida").prop("required", "required");
            EstadoSolo.style.display = 'none';
            $("#SlsEstadoSolo").removeAttr("required");
            $("#SlsEstadoSolo").prop("disabled", "disabled");
            $("#SlsEstadoArl").prop("disabled", "disabled");


        } else if (solicitud === 'DETERMINACION DE ORIGEN PRIMERA OPORTUNIDAD') {
            oportunidadEps.style.display = 'none';
            estadoEps.style.display = 'none';
            $("#SlsEstadoEps").removeAttr("required");
            $("#SlsOportunidadEps").removeAttr("required");

            oportunidadPositiva.style.display = 'block';
            estadoArl.style.display = 'block';
            $("#SlsEstadoArl").prop("required", "required");
            $("#SlsOportunidadPositiva").prop("required", "required");

            divSustentacionMedico.style.display = 'none';
            $("#TxtSustentacionMedico").removeAttr("required");

            DivFechaIngresoPruebas.style.display = 'none';
            DivCanalEntradaPruebas.style.display = 'none';
            DivNumeroRadicadoSalida.style.display = 'none';
            DivRadicadoSalida.style.display = 'none';
            $("#TxtRadicadoSalida").removeAttr("required");
            $("#TxtCanalEntradaPruebas").removeAttr("required");
            $("#TxtRadicadoEntradaPruebas").removeAttr("required");
            $("#TxtFechaIngresoPruebas").removeAttr("required");
            $("#SlsOportunidadEps").removeAttr("required");
            EstadoSolo.style.display = 'none';
            $("#SlsEstadoSolo").removeAttr("required");
            $("#SlsEstadoSolo").prop("disabled", "disabled");
            $("#SlsEstadoEps").prop("disabled", "disabled");


        } else {
            oportunidadEps.style.display = 'none';
            estadoEps.style.display = 'none';
            $("#SlsEstadoEps").removeAttr("required");
            $("#SlsOportunidadEps").removeAttr("required");

            oportunidadPositiva.style.display = 'none';
            estadoArl.style.display = 'none';
            $("#SlsEstadoArl").removeAttr("required");
            $("#SlsOportunidadPositiva").removeAttr("required");

            divSustentacionMedico.style.display = 'none';
            $("#TxtSustentacionMedico").removeAttr("required");

            DivFechaIngresoPruebas.style.display = 'none';
            DivCanalEntradaPruebas.style.display = 'none';
            DivNumeroRadicadoSalida.style.display = 'none';
            DivRadicadoSalida.style.display = 'none';
            $("#TxtRadicadoSalida").removeAttr("required");
            $("#TxtCanalEntradaPruebas").removeAttr("required");
            $("#TxtRadicadoEntradaPruebas").removeAttr("required");
            $("#TxtFechaIngresoPruebas").removeAttr("required");
            $("#SlsOportunidadEps").removeAttr("required");

            EstadoSolo.style.display = 'block';
            $("#SlsEstadoSolo").prop("required", "required");
            $("#SlsEstadoArl").prop("disabled", "disabled");
            $("#SlsEstadoEps").prop("disabled", "disabled");


        }
    });
});



/**==========================Tipo de solicituis habilita estado y definicion==============================================*/
$(document).ready(function () {
    $("#SlsEstadoArl").change(function () {
        var combo = document.getElementById("SlsEstadoArl");//seleccionamos el texto del origen
        var selected = combo.options[combo.selectedIndex].text;//asignamos a la variable  el texto del origen
        const DivfechaSolicitudPruebas = document.getElementById("DivfechaSolicitudPruebas");
        const DivNumeroRadicadoSalida = document.getElementById("DivNumeroRadicadoSalida");
        const DivBotonCargue = document.getElementById("DivBotonCargue");
        const solicitud = $("#Txtsolicitud").val();
        const DivfechaEnvioComiteCodess = document.getElementById("DivfechaEnvioComiteCodess");

        if (selected === 'SOLICITUD DE PRUEBAS') {
            DivfechaEnvioComiteCodess.style.display = 'none';
            $("#TxtfechaEnvioComiteCodess").removeAttr("required");
            DivfechaSolicitudPruebas.style.display = 'block';
            DivNumeroRadicadoSalida.style.display = 'block';
            DivBotonCargue.style.display = 'block';
            $("#TxtfechaSolicitudPruebas").prop("required", "required");
            $("#TxtNumeroRadicadoSalida").prop("required", "required");
            $("#TxtBotonCargue").prop("required", "required");

        } else if (selected === 'ASIGNADO A COMITE') {
            DivfechaEnvioComiteCodess.style.display = 'block';
            $("#TxtfechaEnvioComiteCodess").prop("required", "required");
            DivfechaSolicitudPruebas.style.display = 'none';
            DivNumeroRadicadoSalida.style.display = 'none';
            DivBotonCargue.style.display = 'none';
            $("#TxtfechaSolicitudPruebas").removeAttr("required");
            $("#TxtNumeroRadicadoSalida").removeAttr("required");
            $("#TxtBotonCargue").removeAttr("required");
        } else {

            DivfechaSolicitudPruebas.style.display = 'none';
            DivNumeroRadicadoSalida.style.display = 'none';
            DivBotonCargue.style.display = 'none';
            $("#TxtfechaSolicitudPruebas").removeAttr("required");
            $("#TxtNumeroRadicadoSalida").removeAttr("required");
            $("#TxtBotonCargue").removeAttr("required");
        }

        if (solicitud === 'DETERMINACION DE ORIGEN POR EPS') {
            DivNumeroRadicadoSalida.style.display = 'block';
            $("#TxtNumeroRadicadoSalida").prop("required", "required");
            DivfechaSolicitudPruebas.style.display = 'none';
            DivBotonCargue.style.display = 'none';

            $("#TxtfechaSolicitudPruebas").removeAttr("required");
            $("#TxtBotonCargue").removeAttr("required");
            $("#TxtfechaEnvioComiteCodess").removeAttr("required");

        }

    });
});



/**==========================Tipo de solicituis habilita estado y definicion==============================================*/
$(document).ready(function () {
    $("#SlsEstadoArl").change(function () {
        var combo = document.getElementById("SlsEstadoArl");//seleccionamos el texto del origen
        var selected = combo.options[combo.selectedIndex].text;//asignamos a la variable  el texto del origen
        const DivfechaSolicitudPruebas = document.getElementById("DivfechaSolicitudPruebas");
        const DivNumeroRadicadoSalida = document.getElementById("DivNumeroRadicadoSalida");
        const DivBotonCargue = document.getElementById("DivBotonCargue");
        const solicitud = $("#Txtsolicitud").val();
        const DivfechaEnvioComiteCodess = document.getElementById("DivfechaEnvioComiteCodess");

        if (selected === 'SOLICITUD DE PRUEBAS') {
            DivfechaEnvioComiteCodess.style.display = 'none';
            $("#TxtfechaEnvioComiteCodess").removeAttr("required");
            DivfechaSolicitudPruebas.style.display = 'block';
            DivNumeroRadicadoSalida.style.display = 'block';
            DivBotonCargue.style.display = 'block';
            $("#TxtfechaSolicitudPruebas").prop("required", "required");
            $("#TxtNumeroRadicadoSalida").prop("required", "required");
            $("#TxtBotonCargue").prop("required", "required");

        } else if (selected === 'ASIGNADO A COMITE') {
            DivfechaEnvioComiteCodess.style.display = 'block';
            $("#TxtfechaEnvioComiteCodess").prop("required", "required");
            DivfechaSolicitudPruebas.style.display = 'none';
            DivNumeroRadicadoSalida.style.display = 'none';
            DivBotonCargue.style.display = 'none';
            $("#TxtfechaSolicitudPruebas").removeAttr("required");
            $("#TxtNumeroRadicadoSalida").removeAttr("required");
            $("#TxtBotonCargue").removeAttr("required");
        } else {

            DivfechaSolicitudPruebas.style.display = 'none';
            DivNumeroRadicadoSalida.style.display = 'none';
            DivBotonCargue.style.display = 'none';
            $("#TxtfechaSolicitudPruebas").removeAttr("required");
            $("#TxtNumeroRadicadoSalida").removeAttr("required");
            $("#TxtBotonCargue").removeAttr("required");
        }

        if (solicitud === 'DETERMINACION DE ORIGEN POR EPS') {
            DivNumeroRadicadoSalida.style.display = 'block';
            $("#TxtNumeroRadicadoSalida").prop("required", "required");
            DivfechaSolicitudPruebas.style.display = 'none';
            DivBotonCargue.style.display = 'none';

            $("#TxtfechaSolicitudPruebas").removeAttr("required");
            $("#TxtBotonCargue").removeAttr("required");
            $("#TxtfechaEnvioComiteCodess").removeAttr("required");

        }

    });
});


/**==========================Tipo de solicituis habilita estado y definicion==============================================*/
$(document).ready(function () {
    $("#SlsEstadoEps").ready(function () {
        var combo = document.getElementById("SlsEstadoEps");//seleccionamos el texto del origen
        var selected = combo.options[combo.selectedIndex].text;//asignamos a la variable  el texto del origen
        const DivfechaSolicitudPruebas = document.getElementById("DivfechaSolicitudPruebas");
        const DivNumeroRadicadoSalida = document.getElementById("DivNumeroRadicadoSalida");
        const DivBotonCargue = document.getElementById("DivBotonCargue");
        const solicitud = $("#Txtsolicitud").val();
        const DivfechaEnvioComiteCodess = document.getElementById("DivfechaEnvioComiteCodess");

        if (selected === 'ASIGNADO A COMITE') {
            DivfechaEnvioComiteCodess.style.display = 'block';
            $("#TxtfechaEnvioComiteCodess").prop("required", "required");
        } else {

            DivfechaSolicitudPruebas.style.display = 'none';
            DivNumeroRadicadoSalida.style.display = 'none';
            DivBotonCargue.style.display = 'none';

            $("#TxtfechaSolicitudPruebas").removeAttr("required");
            $("#TxtNumeroRadicadoSalida").removeAttr("required");
            $("#TxtBotonCargue").removeAttr("required");

        }


        if (solicitud === 'DETERMINACION DE ORIGEN POR EPS') {
            DivNumeroRadicadoSalida.style.display = 'block';
            $("#TxtNumeroRadicadoSalida").prop("required", "required");
            DivfechaSolicitudPruebas.style.display = 'none';
            DivBotonCargue.style.display = 'none';

            $("#TxtfechaSolicitudPruebas").removeAttr("required");
            $("#TxtBotonCargue").removeAttr("required");
            $("#TxtfechaEnvioComiteCodess").removeAttr("required");

        }

    });
});

/**==========================Tipo de solicituis habilita estado y definicion==============================================*/
$(document).ready(function () {
    $("#SlsEstadoEps").ready(function () {
        var combo = document.getElementById("SlsEstadoEps");//seleccionamos el texto del origen
        var selected = combo.options[combo.selectedIndex].text;//asignamos a la variable  el texto del origen
        const DivfechaSolicitudPruebas = document.getElementById("DivfechaSolicitudPruebas");
        const DivNumeroRadicadoSalida = document.getElementById("DivNumeroRadicadoSalida");
        const DivBotonCargue = document.getElementById("DivBotonCargue");
        const solicitud = $("#Txtsolicitud").val();
        const DivfechaEnvioComiteCodess = document.getElementById("DivfechaEnvioComiteCodess");

        if (selected === 'ASIGNADO A COMITE') {
            DivfechaEnvioComiteCodess.style.display = 'block';
            $("#TxtfechaEnvioComiteCodess").prop("required", "required");
        } else {
            DivfechaSolicitudPruebas.style.display = 'none';
            $("#TxtfechaEnvioComiteCodess").removeAttr("required");
        }


        if (solicitud === 'DETERMINACION DE ORIGEN POR EPS') {
            DivNumeroRadicadoSalida.style.display = 'block';
            $("#TxtNumeroRadicadoSalida").prop("required", "required");
            DivfechaSolicitudPruebas.style.display = 'none';
            DivBotonCargue.style.display = 'none';

            $("#TxtfechaSolicitudPruebas").removeAttr("required");
            $("#TxtBotonCargue").removeAttr("required");
            $("#TxtfechaEnvioComiteCodess").removeAttr("required");

        }

    });
});

/**==========================Tipo de solicituis habilita estado y definicion==============================================*/
$(document).ready(function () {
    $("#txtCobertura").change(function () {
        var combo = document.getElementById("txtCobertura");//seleccionamos el texto del origen
        var selected = combo.options[combo.selectedIndex].text;//asignamos a la variable  el texto del origen
        const DivraSaEnCarCobeODevoEPs = document.getElementById("DivraSaEnCarCobeODevoEPs");
        if (selected === 'NO - DEVOLUCION A EPS' || selected === 'NO - SIN COBERTURA') {
            DivraSaEnCarCobeODevoEPs.style.display = 'block';
            $("#TxtraSaEnCarCobeODevoEPs").prop("required", "required");

        } else {
            DivraSaEnCarCobeODevoEPs.style.display = 'none';
            $("#TxtraSaEnCarCobeODevoEPs").removeAttr("required");
        }
    });
});

$(document).ready(function () {
    $("#txtCobertura").ready(function () {
        var combo = document.getElementById("txtCobertura");//seleccionamos el texto del origen
        var selected = combo.options[combo.selectedIndex].text;//asignamos a la variable  el texto del origen
        const DivraSaEnCarCobeODevoEPs = document.getElementById("DivraSaEnCarCobeODevoEPs");

        if (selected === 'NO - DEVOLUCION A EPS' || selected === 'NO - SIN COBERTURA') {
            DivraSaEnCarCobeODevoEPs.style.display = 'block';
            $("#TxtraSaEnCarCobeODevoEPs").prop("required", "required");
        } else {
            DivraSaEnCarCobeODevoEPs.style.display = 'none';
            $("#TxtraSaEnCarCobeODevoEPs").removeAttr("required");
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



/*======================Show alert Cargue masivo=================================*/
$(document).ready(function () {
    $("#cargueEntrada").ready(function () {
        const cargueEnt = $("#cargueEntrada").val();
        const  ocultarEntr = document.getElementById("callout-1");
        const  botonImportar = document.getElementById("botonImportar");
        const  alertasDiv = document.getElementById("alertasDiv");

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
    $("#cargueEstado").ready(function () {
        const cargueSiniestro = $("#cargueSiniestro").val();
        const  ocultarEntr = document.getElementById("callout-2");
        const  botonImportar = document.getElementById("botonImportar");
        const  alertasDiv = document.getElementById("alertasDiv");

        if (cargueSiniestro === '1') {
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
    $("#cargueEstado").ready(function () {
        const cargueEstado = $("#cargueEstado").val();
        const  ocultarEntr = document.getElementById("callout-5");
        const  botonImportar = document.getElementById("botonImportar");
        const  alertasDiv = document.getElementById("alertasDiv");

        if (cargueEstado === '1') {
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
    $("#cargueTipoSilicitud").ready(function () {
        const cargueTipoSilicitud = $("#cargueTipoSilicitud").val();
        const  ocultarEntr = document.getElementById("callout-6");
        const  botonImportar = document.getElementById("botonImportar");
        const  alertasDiv = document.getElementById("alertasDiv");

        if (cargueTipoSilicitud === '1') {
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
    $("#cargueAsignar").ready(function () {
        const cargueAsignar = $("#cargueAsignar").val();
        const  ocultarEntr = document.getElementById("callout-4");
        const  botonImportar = document.getElementById("botonImportar");
        const  alertasDiv = document.getElementById("alertasDiv");

        if (cargueAsignar === '1') {
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
    $("#cargueTipoDoAfili").ready(function () {
        const cargueTipoDoAfili = $("#cargueTipoDoAfili").val();
        const  ocultarEntr = document.getElementById("callout-5");
        const  botonImportar = document.getElementById("botonImportar");
        const  alertasDiv = document.getElementById("alertasDiv");

        if (cargueTipoDoAfili === '1') {
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
    $("#cargueTipoDoAEmpresa").ready(function () {
        const cargueTipoDoAEmpresa = $("#cargueTipoDoAEmpresa").val();
        const  ocultarEntr = document.getElementById("callout-3");
        const  botonImportar = document.getElementById("botonImportar");
        const  alertasDiv = document.getElementById("alertasDiv");

        if (cargueTipoDoAEmpresa === '1') {
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


/**==========================Llama la lista Subestado Precalificacion==============================================*/

$(document).ready(function () {
    $("#estadoPeCalificacion").change(function () {
        var estadoCali = $("#estadoPeCalificacion option:selected").val();
        var subEstadoCali = $("#subestadoMostarPreCali").val();
        console.log("estadoCali = " + estadoCali);
        console.log("subEstadoCali = " + subEstadoCali);
        $.ajax({
            type: "GET",
            url: "../../../../../../../dist/js/listarPcl/listaEstadoPrecalificacionEl.php",
            data: {"Txtestado": estadoCali, "TxtestadoSub": subEstadoCali}
        }).done(function (data) {
            $(".subEstadoPeCalificacion select").html(data).fadeIn();
        });
    });
});
/**==========================Llama la lista Subestado Precalificacion==============================================*/

//$(document).ready(function () {
//    $("#estadoCalificacion").ready(function () {
//        var estadoCali = $("#estadoCalificacion option:selected").val();
//        var subEstadoCali = $("#subestadoMostarPreCali").val();
//        console.log("estadoCali = " + estadoCali);
//        console.log("subEstadoCali = " + subEstadoCali);
//        $.ajax({
//            type: "GET",
//            url: "../../../../../dist/js/listarPcl/listaEstadoPrecalificacionEl.php",
//            data: {"Txtestado": estadoCali, "TxtestadoSub": subEstadoCali}
//        }).done(function (data) {
//            $(".subEstadoCalificacion select").html(data).fadeIn();
//        });
//    });
//});


/*=======================Cargue Archivo masivo===============================*/
document.getElementById('fake-file-button-browse').addEventListener('click', function () {
    document.getElementById('files-input-upload').click();
});

document.getElementById('files-input-upload').addEventListener('change', function () {
    document.getElementById('fake-file-input-name').value = this.value;
    document.getElementById('fake-file-button-upload').removeAttribute('disabled');
});
/*=======================Fin Cargue Archivo masivo===============================*/
