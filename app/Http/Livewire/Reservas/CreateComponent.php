<?php

namespace App\Http\Livewire\Reservas;

use Livewire\Component;
use App\Models\Reserva;
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

    public function render()
    {
        return view('livewire.reservas.create-component');
    }

    // Al hacer submit en el formulario
    public function submit()
    {
        // Validación de datos
        $validatedData = $this->validate(
            [
                'nombre' => 'required',
                'fecha' => 'nullable',
                'hora' => 'nullable',
                'comensales' => 'nullable',
                'telefono' => 'nullable',
                'email' => 'nullable',
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
        $reservaSave = Reserva::create($validatedData);


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
}
