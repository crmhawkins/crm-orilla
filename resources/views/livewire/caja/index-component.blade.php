
<div class="container-fluid">
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">TIPOS DE EVENTOS</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Tipos de Eventos</a></li>
                    <li class="breadcrumb-item active">Todos los eventos</li>
                </ol>
            </div>
        </div> <!-- end row -->
    </div>
    <!-- end page-title -->


    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Listado de todos los tipos de eventos</h4>
                        <p class="sub-title../plugins">Listado completo de todos tipos de eventos, para editar o ver la informacion completa pulse el boton de Editar en la columna acciones.
                        </p>
                    @if (count($caja) > 0)
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Tipo de movimiento</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Presupuesto</th>
                                    <th scope="col">Importe</th>
                                    <th scope="col">Método de pago</th>


                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($caja as $tipo)
                                    <tr>
                                        <td>{{ $tipo->descripcion }}</td>
                                        <td>{{ $tipo->tipo_movimiento }}</td>
                                        <td>{{ $tipo->fecha }}</td>
                                        <td>{{ $tipo->presupuesto_id }}</td>
                                        <td>{{ $tipo->importe }} €</td>
                                        <td>{{ $tipo->metodo_pago }}</td>


                                        <td> <a href="tipo-evento-edit/{{ $tipo->id }}" class="btn btn-primary">Ver/Editar</a> </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

@section('scripts')
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
