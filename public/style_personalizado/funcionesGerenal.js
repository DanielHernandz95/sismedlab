$(document).ready(function () {
    $("#documento").keyup(function () {
        var value = $(this).val();
        $("#cedula2").val(value);
          $("#afiliadoAgendaComprobar").val(value);
    });
});


   