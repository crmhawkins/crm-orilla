/*
 Template Name: Stexo - Responsive Bootstrap 4 Admin Dashboard
 Author: Themesdesign
 Website: www.themesdesign.in
 File: Datatable js
 */

$(document).ready(function() {
    $('#datatable').DataTable();

    //Buttons examples
    var table = $('#datatable-buttons').DataTable({
        dom: 'Bfrtip',
            pageLength: 20,
            buttons: ['copy', 'csv', 'excel', 'pdf'],
            language: {
                lengthMenu: 'Mostrando _MENU_ registros por página',
                zeroRecords: 'No se encontraron registros coincidentes',
                info: 'Mostrando página _PAGE_ de _PAGES_',
                infoEmpty: 'No hay registros disponibles',
                infoFiltered: '(filtrado de _MAX_ total registros)',
                search: 'Buscar:',
                paginate: {
                    first: 'Primero',
                    last: 'Ultimo',
                    next: '>',
                    previous: '<'
                },
            },
            order: [[0, 'asc']],
            });

    table.buttons().container()
        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
} );
