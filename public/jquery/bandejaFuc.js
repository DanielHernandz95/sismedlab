$(document).ready(function () {
    $('#example').DataTable({
        serverSide: true,
        processing: true,
        ajax: "{{Route('Bandeja.getSiniestro')}}",
        columns: [
            {data: 'idSiniestroPcl', name: 'idSiniestroPcl'},
            {data: 'idSiniestro', name: 'idSiniestro'},
            {data: 'entrada', name: 'entrada'},
            {data: 'quien_solicita', name: 'quien_solicita'},
            {data: 'solicitud', name: 'solicitud'},
            {data: 'tipo_evento', name: 'tipo_evento'},
            {data: 'estado_siniestro', name: 'estado_siniestro'},
            {data: 'sub_estados', name: 'sub_estados'},
            {data: 'name', name: 'name'}
        ]
    });
});