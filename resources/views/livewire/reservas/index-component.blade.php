<div class="container-fluid">
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">RESERVAS</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Reservas</a></li>
                    <li class="breadcrumb-item active">Todos las reservas</li>
                </ol>
            </div>
        </div> <!-- end row -->
    </div>
    <!-- end page-title -->

    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Listado de todos las reservas</h4>
                    <p class="sub-title../plugins">Listado completo de todas nuestras reservas, para editar o ver la informacion completa pulse el boton de Editar en la columna acciones.
                    </p>

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
                                        <td> <a href="reservas-edit/{{ $reserva->id }}" class="btn btn-primary">Ver/Editar</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>


@section('scripts')

<!-- Required datatable js -->
{{-- <script src="../assets/js/jquery.min.js"></script> --}}
<script src="../assets/js/jquery.slimscroll.js"></script>

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
<script src="../plugins/datatables/responsive.bootstrap4.min.js"></script>
<script src="../assets/pages/datatables.init.js"></script>


@endsection
