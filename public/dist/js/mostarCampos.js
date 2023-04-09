
$(function () {
    element = document.getElementById("TxtEntrada");
    $("#TxtEntrada").change(function () {
        if ($(this).val() === "11") {
            $("#puntoAtecion").removeAttr("disabled");
        }
    });
});
