
<div class="container-fluid">
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">RESERVAS DIARIAS</span></h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Reservas Diarias</a></li>
                </ol>
            </div>
        </div> <!-- end row -->
    </div>
    <div class="row">
        <div class="col-9">
            <div class="card m-b-30">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Listado de todos las Reservas por dia</h4>
                    <p class="sub-title">Listado completo de todas nuestras Reservas por dia</p>
                    @if (count($reservas) > 0)
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Hora</th>
                                    <th scope="col">Nº de comensales</th>
                                    <th scope="col">Telefono</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservas as $reserva)
                                <tr>
                                    <td>{{ $reserva->nombre }}</td>
                                    <td>{{ $reserva->fecha }}</td>
                                    <td>{{ $reserva->hora }}</td>
                                    <td>{{ $reserva->comensales }}</td>
                                    <td>{{ $reserva->telefono }}</td>
                                    <td>{{ $reserva->email }}</td>
                                    <td>@switch($reserva->estado)
                                        @case(0)
                                            <span class="badge badge-warning">Pendiente</span>
                                            @break
                                        @case(1)
                                            <span class="badge badge-success">Aceptado</span>
                                            @break
                                        @case(2)
                                            <span class="badge badge-danger">Cancelado</span>
                                            @break
                                            <span class="badge badge-info">Estado no definido</span>
                                        @default
                                    @endswitch
                                    </td>
                                    <td> <a href="reservas-edit/{{ $reserva->id }}" class="btn btn-primary">Ver/Editar</a> </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card m-b-30 position-fixed">
                <div class="card-body">
                    <h5>Elige un día para mostrar</h5>
                    <div class="row">
                        <div class="col-12">
                            <input type="date" class="form-control" wire:model="dia">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')

<script>
    document.addEventListener('livewire:load', function() {
        window.livewire.hook('message.processed', () => {
            // Verifica si la instancia de DataTables ya existe y destrúyela
            if ($.fn.DataTable.isDataTable('#datatable-buttons')) {
                $('#datatable-buttons').DataTable().clear().destroy();
            }

            // Reinicializa DataTables aquí
            $('#datatable-buttons').DataTable({
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
        });
    });
    </script>
<!-- Required datatable js -->
{{-- <script src="../assets/js/jquery.min.js"></script> --}}
<script src="../assets/js/jquery.slimscroll.js"></script>
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/r-3.0.1/sp-2.3.0/datatables.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/r-3.0.1/sp-2.3.0/datatables.min.js"></script>
{{--
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="../plugins/datatables/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables/buttons.bootstrap4.min.js"></script>
<script src="../plugins/datatables/jszip.min.js"></script>
<script src="../plugins/datatables/pdfmake.min.js"></script>
<script src="../plugins/datatables/vfs_fonts.js"></script>
<script src="../plugins/datatables/buttons.html5.min.js"></script>
<script src="../plugins/datatables/buttons.print.min.js"></script>
<script src="../plugins/datatables/buttons.colVis.min.js"></script>
<!-- Responsive examples -->
<script src="../plugins/datatables/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables/responsive.bootstrap4.min.js"></script> --}}
<script src="../assets/pages/datatables.init.js"></script>


@endsection
