
//Guardamos el controlador del div con ID mensaje en una variable
var mensaje = $("#mensaje");
//Ocultamos el contenedor
mensaje.hide();

//Cuando el formulario con ID add se env e...
$("#guardarDiagnosticos").on("submit", function (e) {
    //Evitamos que se env e por defecto
    e.preventDefault();
    //Creamos un FormData con los datos del mismo formulario
    var formData = new FormData(document.getElementById("guardarDiagnosticos"));
    //$("#ProSelected").


    //Llamamos a la funci n AJAX de jQuery
    $.ajax({
        //Definimos la URL del archivo al cual vamos a enviar los datos

        url: "../../../dist/js/dxCie10/adicionatCie10.php",

        //Definimos el tipo de m todo de env o
        type: "POST",
        //Definimos el tipo de datos que vamos a enviar y recibir
        dataType: "HTML",
        //Definimos la informaci n que vamos a enviar
        data: formData,
        //Deshabilitamos el cach 
        cache: false,
        //No especificamos el contentType
        contentType: false,
        //No permitimos que los datos pasen como un objeto
        processData: false

    }).done(function (echo) {
        //Cuando recibamos respuesta, la mostramos
        mensaje.html(echo);
        mensaje.slideDown(500);
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
    //------------------------------------------------------------------
    $.ajax({
        success: function ()
        {
            var table = document.getElementById('ProSelected');
            table.innerHTML = '';
        }
    });
    });
});


/*--------------------------------Adicion----------------------------------------------*/


//Guardamos el controlador del div con ID mensaje en una variable
var mensaje = $("#mensaje");
//Ocultamos el contenedor
mensaje.hide();

//Cuando el formulario con ID add se env e...
$("#guardarDiagnosticosAdicion").on("submit", function (e) {
    //Evitamos que se env e por defecto
    e.preventDefault();
    //Creamos un FormData con los datos del mismo formulario
    var formData = new FormData(document.getElementById("guardarDiagnosticosAdicion"));
    //$("#ProSelected").


    //Llamamos a la funci n AJAX de jQuery
    $.ajax({
        //Definimos la URL del archivo al cual vamos a enviar los datos

        url: "../../../dist/js/dxCie10/adicionatCie10Adicion.php",

        //Definimos el tipo de m todo de env o
        type: "POST",
        //Definimos el tipo de datos que vamos a enviar y recibir
        dataType: "HTML",
        //Definimos la informaci n que vamos a enviar
        data: formData,
        //Deshabilitamos el cach 
        cache: false,
        //No especificamos el contentType
        contentType: false,
        //No permitimos que los datos pasen como un objeto
        processData: false

    }).done(function (echo) {
        //Cuando recibamos respuesta, la mostramos
        mensaje.html(echo);
        mensaje.slideDown(500);
         $(document).ready(function () {
        $(".idSiniestroDxPcl").ready(function () {
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
    //------------------------------------------------------------------
    $.ajax({
        success: function ()
        {
            var table = document.getElementById('ProSelected');
            table.innerHTML = '';
        }
    });
    });
});


/*--------------------------------Dx El----------------------------------------------*/



//Guardamos el controlador del div con ID mensaje en una variable
var mensaje = $("#mensaje");
//Ocultamos el contenedor
mensaje.hide();

//Cuando el formulario con ID add se env e...
$("#guardarDiagnosticosEl").on("submit", function (e) {
    //Evitamos que se env e por defecto
    e.preventDefault();
    //Creamos un FormData con los datos del mismo formulario
    var formData = new FormData(document.getElementById("guardarDiagnosticosEl"));
    //$("#ProSelected").


    //Llamamos a la funci n AJAX de jQuery
    $.ajax({
        //Definimos la URL del archivo al cual vamos a enviar los datos

        url: "../../../dist/js/dxCie10/adicionatCie10El.php",

        //Definimos el tipo de m todo de env o
        type: "POST",
        //Definimos el tipo de datos que vamos a enviar y recibir
        dataType: "HTML",
        //Definimos la informaci n que vamos a enviar
        data: formData,
        //Deshabilitamos el cach 
        cache: false,
        //No especificamos el contentType
        contentType: false,
        //No permitimos que los datos pasen como un objeto
        processData: false

    }).done(function (echo) {
        //Cuando recibamos respuesta, la mostramos
        mensaje.html(echo);
        mensaje.slideDown(500);
         $(document).ready(function () {
        $("idSiniestroDxEL").ready(function () {
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
    //------------------------------------------------------------------
    $.ajax({
        success: function ()
        {
            var table = document.getElementById('ProSelected');
            table.innerHTML = '';
        }
    });
    });
});
