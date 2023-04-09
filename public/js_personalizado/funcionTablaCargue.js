
$(document).ready(function () {
    $('#cargueTabla').DataTable({
        processing: true,
        "searching": false,
        buttons: [
            {
                extend: 'pageLength',
                text: 'MOSTAR'
            }
        ],
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "TODOS"]],
        language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningun dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Ultimo",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortA v  scending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDesce nding": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
});

$(document).ready(function () {
    $('#usuarioTabla').DataTable({
        processing: true,
        "searching": true,
        buttons: [
            {
                extend: 'pageLength',
                text: 'MOSTAR'
            }
        ],
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "TODOS"]],
        language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningun dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Ultimo",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortA v  scending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDesce nding": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
});

