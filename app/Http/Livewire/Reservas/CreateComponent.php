<?php

namespace App\Http\Livewire\Reservas;

use Livewire\Component;
use App\Models\Reserva;
use App\Models\Mesa;
use App\Models\dia;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Redirect;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Facades\Auth;

class CreateComponent extends Component
{

    use LivewireAlert;

    public $nombre;
    public $fecha;
    public $hora;
    public $comensales;
    public $telefono;
    public $email;
    public $estado = 1;

    public function render()
    {
        return view('livewire.reservas.create-component');
    }

    // Al hacer submit en el formulario
    public function submit()
    {
        $mesasTotales = Mesa::all();

        $mesasDisponibles = $this->calcularMesasDisponibles($mesasTotales,$this->hora,$this->fecha);

        $resultadoAsignacion = $this->calcularAsignacionMesas($this->comensales, $mesasDisponibles);
        // Validación de datos
        $validatedData = $this->validate(
            [
                'nombre' => 'required',
                'fecha' => 'nullable',
                'hora' => 'nullable',
                'comensales' => 'nullable',
                'telefono' => 'nullable',
                'email' => 'nullable',
                'estado' => 'nullable',

            ],
            // Mensajes de error
            [
                'nombre.required' => 'El nombre es obligatorio.',
                'fecha.required' => 'Los protagonistas son obligatorio.',
                'hora.required' => 'La cantidad de niños es obligatoria.',
                'comensales.required' => 'El nombre de usuario es obligatorio.',
                'telefono.required' => 'La contraseña es obligatoria.',

            ]
        );

        // Guardar datos validados
        $reservaSave = Reserva::create(array_merge($validatedData, ['mesas4' => $resultadoAsignacion['mesasDeCuatroAsignadas'],'mesas6' => $resultadoAsignacion['mesasDeSeisAsignadas']]));


        // Alertas de guardado exitoso
        if ($reservaSave) {
            $this->alert('success', '¡Reserva registrada correctamente!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => 'confirmed',
                'confirmButtonText' => 'ok',
                'timerProgressBar' => true,
            ]);
        } else {
            $this->alert('error', '¡No se ha podido guardar la información de la reserva!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
            ]);
        }
    }

    // Función para cuando se llama a la alerta
    public function getListeners()
    {
        return [
            'confirmed',
            'submit'
        ];
    }

    // Función para cuando se llama a la alerta
    public function confirmed()
    {
        // Do something
        return redirect()->route('reservas.index');
    }

    private function calcularMesasDisponibles($mesasTotales,$horario,$fecha)
    {
        // Inicializar contadores de mesas disponibles
        $mesasDisponibles = [
            'cuatro' => 0,
            'seis' => 0,
        ];
        $fechaReserva = Carbon::createFromFormat('Y-m-d', $fecha);
        $diaNoDisponible = dia::where('inicio', '<=', $fechaReserva)
        ->where('fin', '>=', $fechaReserva)
        ->first();
        if ($diaNoDisponible) {
            return ['cuatro' => 0, 'seis' => 0];
        }

        // Supongamos que Mesa::all() devuelve un arreglo con la cantidad de mesas por capacidad
        foreach ($mesasTotales as $mesa) {
            if ($mesa->capacidad == 4) {
                $mesasDisponibles['cuatro'] += $mesa->cantidad;
            } elseif ($mesa->capacidad == 6) {
                $mesasDisponibles['seis'] += $mesa->cantidad;
            }
        }
        $fechaHoraInicio = Carbon::createFromFormat('Y-m-d H:i', $fecha . ' ' . $horario);
    $fechaHoraFin = $fechaHoraInicio->copy()->addHour(1)->addMinutes(15);

    // Convertir los objetos Carbon a strings para la consulta
    $horaInicio = $fechaHoraInicio->format('H:i');
    $horaFin = $fechaHoraFin->format('H:i');

    // Filtrar las reservas activas que caigan dentro del horario especificado
    $reservasActivas = Reserva::where('estado', 1)
                            ->where('fecha', $fecha)
                            ->where('hora', '>=', $horaInicio)
                            ->where('hora', '<', $horaFin)
                            ->get();

        // Restar las mesas ocupadas por estas reservas de las disponibles
        foreach ($reservasActivas as $reserva) {
                $mesasDisponibles['cuatro'] -= $reserva->mesas4;
                $mesasDisponibles['seis'] -= $reserva->mesas6;
        }

        // Asegurar que el número de mesas disponibles no sea negativo
        $mesasDisponibles['cuatro'] = max(0, $mesasDisponibles['cuatro']);
        $mesasDisponibles['seis'] = max(0, $mesasDisponibles['seis']);

        return $mesasDisponibles;
    }

    private function calcularAsignacionMesas($numComensales, $mesasDisponibles)
    {
        $mesasDeCuatroAsignadas = 0;
        $mesasDeSeisAsignadas = 0;
        $lugaresAdicionalesPorMesasDeCuatro = 0; // Lugares adicionales al unir mesas de 4

        while ($numComensales > 0) {
            if ($numComensales > 6 || ($numComensales > 4 && $mesasDisponibles['seis'] > 0)) {
                if ($mesasDisponibles['seis'] > 0) {
                    $mesasDeSeisAsignadas++;
                    $mesasDisponibles['seis']--;
                    $numComensales -= 6;
                } else if ($mesasDisponibles['cuatro'] > 0) {
                    // Al usar una mesa de 4, considerar la penalización al unir mesas
                    if ($mesasDeCuatroAsignadas == 0 &&  $mesasDeSeisAsignadas == 0) {
                        $numComensales -= 4; // La primera mesa de 4 aporta 4 lugares
                    } else {

                        $numComensales -= 2;
                    }
                    $mesasDeCuatroAsignadas++;
                    $mesasDisponibles['cuatro']--;
                } else {
                    break; // No hay mesas disponibles
                }
            } else {
                if ($mesasDisponibles['cuatro'] > 0) {
                    // Al usar una mesa de 4, considerar la penalización al unir mesas
                    if ($mesasDeCuatroAsignadas == 0 && $mesasDeSeisAsignadas == 0) {
                        $numComensales -= 4; // La primera mesa de 4 aporta 4 lugares
                    } else {

                        $numComensales -= 2;
                    }
                    $mesasDeCuatroAsignadas++;
                    $mesasDisponibles['cuatro']--;
                } else if ($mesasDisponibles['seis'] > 0) {
                    $mesasDeSeisAsignadas++;
                    $mesasDisponibles['seis']--;
                    $numComensales -= 6;
                } else {
                    break; // No hay mesas disponibles
                }
            }
        }

        return [
            'esPosible' => $numComensales <= 0, // Verificar si todos los comensales tienen mesa
            'mesasDeCuatroAsignadas' => $mesasDeCuatroAsignadas,
            'mesasDeSeisAsignadas' => $mesasDeSeisAsignadas,
        ];
    }
}
