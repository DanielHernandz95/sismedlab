$(document).ready(function () {
    $(".UpperCase").on("keypress", function () {
        $input = $(this);
        setTimeout(function () {
            $input.val($input.val().toUpperCase());
        }, 50);
    });
});

$('#nacimiento').datepicker({
    format: " yyyy",
    viewMode: "years",
    minViewMode: "years"

});
$('.date').datepicker({
    language: 'es',
    todayHighlight: true,
    todayBtn: true,
    clearBtn: true,
    format: 'yyyy-mm-dd',
    keyboardNavigation: false,
   // startDate: '0d',
    autoclose: true,
    endDate: '+0d'   

});
$('.solo_numero').on('input', function () {
    this.value = this.value.replace(/[^0-9]/g, '');
});
