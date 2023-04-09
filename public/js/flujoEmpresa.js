

var campos_max_sede = 30;   //max de 10 campos
var sede = 0;
$('#add_field').click(function (e) {
    e.preventDefault();     //prevenir novos clicks
    if (sede < campos_max_sede) {
        $('#listas').append('<div class="input-group input-group-sm" style="margin-top: 8px" >\n\
          <input name="sede[]" class="form-control form-control-sm" required=""> \n\
         <a type="button" class=" quitar remover_campo " ><i class="fas fa-trash-alt"></i></a>\n\
         </div>');
        sede++;
    }
});

// Remover o div anterior
$('#listas').on("click", ".remover_campo", function (e) {
    e.preventDefault();
    $(this).parent('div').remove();
    sede--;
});


/*=============================SUB SEDE================================*/
$(function () {
    $(".add-field").click(function () {
        $("#DivAEsconder").show();
    });
});
var cam = 0;
$(document).ready(function () {
    $('.add-field').click(function () {
        $('.person_languages:last').clone().insertBefore(".aqui").find('input').val("");
        cam++;
    });
    $('.person_languages').parent().on('click', '.remove-field', function (e) {
        e.preventDefault();
        if (cam > 0) {
            $(this).parent('').remove();
            cam--;
        }
    });
});

/*=============================AREA================================*/
$(function () {
    $(".add_area").click(function () {
        $("#areamostrar").show();
    });
});
var are = 0;
$(document).ready(function () {
    $('.add_area').click(function () {
        $('.person_area:last').clone().insertBefore(".aqui_area").find('input').val("");
        are++;
    });
    $('.person_area').parent().on('click', '.remove-field', function (e) {
        e.preventDefault();
        if (are > 0) {
            $(this).parent('').remove();
            are--;
        }
    });
});



/*============================sUB AREA================================*/
$(function () {
    $(".add_subArea").click(function () {
        $("#areamostrar").show();
    });
});
var are = 0;
$(document).ready(function () {
    $('.add_subArea').click(function () {
        $('.person_Subarea:last').clone().insertBefore(".aqui_subarea").find('input').val("");
        are++;
    });
    $('.person_Subarea').parent().on('click', '.remove-field', function (e) {
        e.preventDefault();
        if (are > 0) {
            $(this).parent('').remove();
            are--;
        }
    });
});
