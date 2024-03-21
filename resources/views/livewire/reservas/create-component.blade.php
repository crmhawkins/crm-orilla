<div class="container-fluid">
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">CREAR RESERVA</span></h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Reservas</a></li>
                    <li class="breadcrumb-item active">Crear reserva</li>
                </ol>
            </div>
        </div> <!-- end row -->
    </div>
    <!-- end page-title -->

    <div class="row">
        <div class="col-md-9">
            <div class="card m-b-30">
                <div class="card-body">
                    <form wire:submit.prevent="submit">
                        <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{ csrf_token() }}">

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <h5 class="ms-3"
                                    style="border-bottom: 1px gray solid !important; padding-bottom: 10px !important;">
                                    Datos de la reserva</h5>
                            </div>
                            <div class="col-sm-6">
                                <label for="example-text-input" class="col-sm-12 col-form-label">Nombre de contacto</label>
                                <div class="col-sm-12">
                                    <input type="text" wire:model="nombre" class="form-control" name="nombre"
                                        id="nombre" aria-label="Nombre" placeholder="Nombre">
                                    @error('nombre')
                                        <span class="text-danger">{{ $message }}</span>
                                        <style>
                                            .nombre {
                                                color: red;
                                            }
                                        </style>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="example-text-input" class="col-sm-12 col-form-label">Nª de comensales</label>
                                <div class="col-sm-12">
                                    <input type="number" wire:model="comensales" class="form-control" name="comensales"
                                        id="comensales" aria-label="comensales" placeholder="Nº de comensales">
                                    @error('comensales')
                                        <span class="text-danger">{{ $message }}</span>
                                        <style>
                                            .nombre {
                                                color: red;
                                            }
                                        </style>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="example-text-input" class="col-sm-12 col-form-label">Estado</label>
                                <div class="col-sm-12">
                                    <select class="form-control" name="estado" id="estado" wire:model="estado">
                                        <option value="0">Pendiente</option>
                                        <option value="1">Aceptado</option>
                                        <option value="2">Cancelado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="example-text-input" class="col-sm-12 col-form-label">Email</label>
                                <div class="col-sm-12">
                                    <input type="email" wire:model="email" class="form-control" name="email" pattern=".+@example\.com"
                                        id="email" placeholder="Email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>

                                        <style>
                                            .nif {
                                                color: red;
                                            }
                                        </style>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="example-text-input" class="col-sm-12 col-form-label">Fecha de la reserva</label>
                                <div class="col-sm-12">
                                    <input type="date" wire:model="fecha" class="form-control" name="fecha"
                                        id="fecha" placeholder="fecha">
                                    @error('fecha')
                                        <span class="text-danger">{{ $message }}</span>
                                        <style>
                                            .apellido {
                                                color: red;
                                            }
                                        </style>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="example-text-input" class="col-sm-12 col-form-label">Hora de la reserva</label>
                                <div class="col-sm-12">
                                    <input type="time" wire:model="hora" class="form-control" name="hora"
                                        id="hora" placeholder="hora">
                                    @error('hora')
                                        <span class="text-danger">{{ $message }}</span>

                                        <style>
                                            .nif {
                                                color: red;
                                            }
                                        </style>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="example-text-input" class="col-sm-12 col-form-label">Telefono</label>
                                <div class="col-sm-12">
                                    <input type="text" wire:model="telefono" class="form-control" name="telefono"
                                        id="telefono" placeholder="Telefono">
                                    @error('telefono')
                                        <span class="text-danger">{{ $message }}</span>

                                        <style>
                                            .nif {
                                                color: red;
                                            }
                                        </style>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card m-b-30">
                <div class="card-body">
                    <h5>Acciones</h5>
                    <div class="row">
                        <div class="col-12">
                            <button class="w-100 btn btn-success mb-2" id="alertaGuardar">Guardar Reserva</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script>
        $("#alertaGuardar").on("click", () => {
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Pulsa el botón de confirmar para guardar la reserva.',
                icon: 'warning',
                showConfirmButton: true,
                showCancelButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.livewire.emit('submit');
                }
            });
        });
    </script>
@endsection


