<div class="container-fluid">
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">OPCIONES DEL CRM</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Opciones</li>
                </ol>
            </div>
        </div> <!-- end row -->
    </div>
    <div class="row">
        <div class="col-md-9 col-12 order-2 order-md-1">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-4">Mesas para reservar</h4>
                    <div>
                        <button wire:click="addMesa" class="btn btn-primary mb-3">Añadir Tipo de Mesa</button>
                        <div class="row g-3">
                                <div class="col-md-6"><label for="cantidad">Cantidad de mesas</label></div>
                                <div class="col-md-6"><label for="capacidad">Comensales por mesas</label></div>
                            @foreach ($mesas as $index => $mesa)
                                <div class="col-md-12 d-flex align-items-center">
                                    <input wire:model="mesas.{{ $index }}.cantidad" type="number" class="form-control" placeholder="Número de mesas">
                                    <input wire:model="mesas.{{ $index }}.capacidad" type="number" class="form-control mx-2" placeholder="Comensales por mesa">
                                    <button wire:click="removeMesa({{ $index }})" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                 <div class="card-body">
                    <h4 class="card-title mb-4">Intervalo de días sin reservas</h4>
                    <div>
                        <button wire:click="addDias" class="btn btn-primary mb-3">Añadir Intervalo de días</button>
                        <div class="row g-3">
                                <div class="col-md-6"><label for="inicio">Inicio</label></div>
                                <div class="col-md-6"><label for="fin">Fin</label></div>
                                @foreach ($dias as $index => $dia)
                                <div class="col-12">
                                    <div class="d-flex flex-wrap align-items-center">
                                        <div class="flex-fill p-1">
                                            <input wire:model="dias.{{ $index }}.inicio" type="date" class="form-control" placeholder="Fecha de inicio">
                                        </div>
                                        <div class="flex-fill p-1">
                                            <input wire:model="dias.{{ $index }}.fin" type="date" class="form-control" placeholder="Fecha de fin">
                                        </div>
                                        <div class="p-1">
                                            <button wire:click="removeDia({{ $index }})" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-12 order-1 order-md-2">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Opciones de guardado</h5>
                    <div class="d-grid gap-2">
                        <button class="btn btn-success" id="alertaGuardar">Guardar opciones</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
    <script>
        $(document).ready(function() {
            $("#alertaGuardar").on("click", () => {
                Swal.fire({
                    title: '¿Estás seguro?',
                    icon: 'warning',
                    showConfirmButton: true,
                    showCancelButton: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.livewire.emit('saveMesas');
                    }
                });
            });
        });
    </script>
@endsection
