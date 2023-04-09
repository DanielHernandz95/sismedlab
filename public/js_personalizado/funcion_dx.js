

function validar() {
    var validado = true;
    elementos = document.getElementsByClassName("inputFormu");
    if (elementos.value === "") {
        validado === false;
    }
    if (validado) {
        document.getElementById("boton").disabled = false;
        $('#boton').attr("disabled", false);
    } else {
        document.getElementById("boton").disabled = true;
        $('#boton').attr("disabled", false);
        //Salta un alert cada vez que escribes y hay un campo vacio
        //alert("Hay campos vacios")   
    }
}





function agregarProducto() {
//------------------------------------------------------------------
    document.getElementById("boton").disabled = true;
//------------------------------------------------------------------
var sel = document.getElementById("Txtdiganos").value;//seleccionamos el valor del origen
//------------------------------------------------------------------    
var combo = document.getElementById("Txtdiganos");//seleccionamos el texto del origen
var selected = combo.options[combo.selectedIndex].text;//asignamos a la variable  el texto del origen
//-----------------------------------------------------------------
    var selid = $('.TxtIdDiagnostico').val(); //captura el ID diagnostico cie 10
    var diag = $('#prueba').val(); //Capturo el texto del diagnostico
//------------------------------------------------------------------
    // string = $('#TxtDescripcionDiagnostico').text(); //captura la descripcion del diagnosticos 
    var id = $('#Txtid').val(); //Capturo Id de siniestroPcl
//-----------------------------------------------------------------
    var text = $('#TxtSelectCie10Asdicion').find(':selected').text(); //Capturo el Nombre del Producto- Texto dentro del Select
    var sptext = text.split();
    var newtr = '<tr class="item"  data-id="' + sel + '">';
    newtr = newtr + '<td>' + selected + '</td>';
    newtr = newtr + '<td>' + diag + '</td>';
    newtr = newtr + '<td  class="iProduct" ><textarea  name="TxtDescripAdicion[]" rows="5" class="form-control c" type="text" ></textarea></td>';
    newtr = newtr + '<td><button type="button" class="btn btn-danger btn-xs remove-item"><i class="fas fa-trash-alt"></i>Eliminar</button> \n\
    <input type="hidden" class="form-control"  name="cie10[]" value=' + selid + ' required >\n\
    <input type="hidden" class="form-control"  name="Txtid[]" value=' + id + ' required >\n\
    <input type="hidden" class="form-control"  name="TxtDescrip[]" value=' + diag + ' required >\n\
    <input type="hidden" class="form-control"  name="Txtdig[]" value=' + sel + ' required >\n\
    </td></tr>';
//------------------------------------------------------------------
    $('#ProSelected').append(newtr); //Agrego el Producto al tbody de la Tabla con el id=ProSelected
//------------------------------------------------------------------
    $("#prueba").prop("disabled", true);
    document.getElementById('prueba').value = "";
    document.getElementById('Txtdiganos').value = "";
//------------------------------------------------------------------
    $('.remove-item').off().click(function (e) {
        $(this).parent('td').parent('tr').remove(); //En accion elimino el Producto de la Tabla
        if ($('#ProSelected tr.item').length === 0)
            $('#ProSelected .no-item').slideDown(300);
    });
}





/*--------------------------------------------------------------*/
(function ($) {
    $.widget("custom.combobox", {
        _create: function () {
            this.wrapper = $("<span>")
                    .addClass("custom-combobox")
                    .insertAfter(this.element);
            this.element.hide();
            this._createAutocomplete();
            this._createShowAllButton();
        },
        _createAutocomplete: function () {
            var selected = this.element.children(":selected"),
                    value = selected.text() ? selected.text() : "";
            this.input = $("<input  style='height: 32px' onchange='validar()' disabled='' id='prueba' placeholder='Seleccionar' onkeyup='mayus(this);'>")
                    .appendTo(this.wrapper)
                    .val(value)
                    .addClass("custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left tama_ci form-control form-control-sm")
                    .autocomplete({
                        delay: 0,
                        minLength: 3,
                        source: $.proxy(this, "_source")
                    })
                    .tooltip({
                        tooltipClass: "ui-state-highlight"
                    });
            this._on(this.input, {
                autocompleteselect: function (event, ui) {
                    ui.item.option.selected = true;
                    this._trigger("select ", event, {
                        item: ui.item.option
                    });
                },
                autocompletechange: "_removeIfInvalid"
            });
        },
        _source: function (request, response) {
            var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
            response(this.element.children("option ").map(function () {
                var text = $(this).text();
                if (this.value && (!request.term || matcher.test(text)))
                    return {
                        label: text,
                        value: text,
                        option: this
                    };
            }));
        },
        _removeIfInvalid: function (event, ui) {
            if (ui.item) {
                return;
            }
            var value = this.input.val(),
                    valueLowerCase = value.toLowerCase(),
                    valid = false;
            $("#boton").prop("disabled", true);
            this.element.children("option").each(function () {
                if ($(this).text().toLowerCase() === valueLowerCase) {
                    this.selected = valid = true;
                    return false;
                }
            });
            if (valid) {
                return;
            }
            this.input
                    .val("");
            Swal.fire({
                title: 'Oops...',
                type: 'error',
                text: 'Diagnostico seleccionado no existe!'
            });

            this.element.val("");
            this._delay(function () {
                this.input.tooltip("close").attr("title", "");
            }, 2500);
            this.input.data("ui-autocomplete").term = "";
        },
        _destroy: function () {
            this.wrapper.remove();
            this.element.show();
        }
    });
})(jQuery);

$(function () {
    $("#combobox").combobox();
    $("#toggle").click(function () {
        $("#combobox").toggle();
    });
});

$(document).ready(function () {
    $("#prueba").keypress(function () {
        $("#boton").prop("disabled", false);
    });
});

function diga(sel) {
    if (sel.value !== null) {
        $("#prueba").prop("disabled", false);

    }
}

/*===========================================================================*/
(function ($) {
    $.widget("custom.comboboxRecali", {
        _create: function () {
            this.wrapper = $("<span>")
                    .addClass("custom-comboboxRecali")
                    .insertAfter(this.element);
            this.element.hide();
            this._createAutocomplete();
            this._createShowAllButton();
        },
        _createAutocomplete: function () {
            var selected = this.element.children(":selected"),
                    value = selected.text() ? selected.text() : "";
            this.input = $("<input  style='height: 32px' onchange='DxRevalidar()'  required='' id='dxRecalifi' placeholder='Seleccionar' onkeyup='mayus(this);'>")
                    .appendTo(this.wrapper)
                    .val(value)
                    .addClass("custom-comboboxRecali-input ui-widget ui-widget-content ui-state-default ui-corner-left tama_ci form-control form-control-sm permisosInputReCali")
                    .autocomplete({
                        delay: 0,
                        minLength: 3,
                        source: $.proxy(this, "_source")
                    })
                    .tooltip({
                        tooltipClass: "ui-state-highlight"
                    });
            this._on(this.input, {
                autocompleteselect: function (event, ui) {
                    ui.item.option.selected = true;
                    this._trigger("select ", event, {
                        item: ui.item.option
                    });
                },
                autocompletechange: "_removeIfInvalid"
            });
        },
        _source: function (request, response) {
            var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
            response(this.element.children("option ").map(function () {
                var text = $(this).text();
                if (this.value && (!request.term || matcher.test(text)))
                    return {
                        label: text,
                        value: text,
                        option: this
                    };
            }));
        },
        _removeIfInvalid: function (event, ui) {
            if (ui.item) {
                return;
            }
            var value = this.input.val(),
                    valueLowerCase = value.toLowerCase(),
                    valid = false;
            $("#botondxReca").prop("disabled", true);
            this.element.children("option").each(function () {
                if ($(this).text().toLowerCase() === valueLowerCase) {
                    this.selected = valid = true;
                    return false;
                }
            });
            if (valid) {
                return;
            }
            this.input
                    .val("");
            Swal.fire({
                title: 'Oops...',
                type: 'error',
                text: 'Diagnostico seleccionado no existe!'
            });

            this.element.val("");
            this._delay(function () {
                this.input.tooltip("close").attr("title", "");
            }, 2500);
            this.input.data("ui-autocomplete").term = "";
        },
        _destroy: function () {
            this.wrapper.remove();
            this.element.show();
        }
    });
})(jQuery);


$(document).ready(function () {
    $("#dxRecalifi").keypress(function () {
        $("#botondxReca").prop("disabled", false);
        $("#descripcionDiagnostico").prop("disabled", false);
    });
});

function DxRevalidar() {
    var validado = true;
    elementos = document.getElementsByClassName("inputFormu");
    if (elementos.value === "") {
        validado === false;
    }
    if (validado) {
        $("#botondxReca").removeAttr("disabled");
        $("#descripcionDiagnostico").removeAttr("disabled");
        $("#botondxRecaAdicion").removeAttr("disabled");

        $('#botondxReca').attr("disabled", false);
        $('#botondxRecaAdicion').attr("disabled", false);

    } else {
        document.getElementById("botondxRecaAdicion").disabled = true;

        document.getElementById("botondxReca").disabled = true;

        $('#botondxReca').attr("disabled", false);
        $('#botondxRecaAdicion').attr("disabled", false);
        $('#descripcionDiagnostico').attr("disabled", false);
        //Salta un alert cada vez que escribes y hay un campo vacio
        //alert("Hay campos vacios")   
    }
}

$(function () {
    $("#comboboxRecali").comboboxRecali();
    $("#toggle").click(function () {
        $("#comboboxRecali").toggle();
    });
});