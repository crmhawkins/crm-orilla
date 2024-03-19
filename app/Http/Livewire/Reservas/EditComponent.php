<?php

namespace App\Http\Livewire\Reservas;

use Livewire\Component;
use App\Models\Reserva;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class EditComponent extends Component
{
    use LivewireAlert;
    public $identificador;
    public $nombre;
    public $fecha;
    public $hora;
    public $comensales;
    public $telefono;
    public $email;

    public  function mount()
    {
        $reserva = Reserva::find($this->identificador);
        $this->nombre = $reserva->nombre;
        $this->fecha = $reserva->fecha;
        $this->hora = $reserva->hora;
        $this->comensales = $reserva->comensales;
        $this->telefono = $reserva->telefono;
        $this->email = $reserva->email;
    }
    public function render()
    {
        return view('livewire.reservas.edit-component');
    }

        // Al hacer update en el formulario
        public function update()
        {
            // Validación de datos
            $validatedData = $this->validate(
                [
                    'nombre' => 'nullable',
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
            $reserva = Reserva::find($this->identificador);
            // Guardar datos validados
            $reservaSave = $reserva->update([
                'nombre' => $this->nombre,
                'fecha'=>$this->fecha,
                'hora' => $this->hora,
                'comensales' => $this->comensales,
                'telefono' => $this->telefono,
                'email' => $this->email,
                ]);


            // Alertas de guardado exitoso
            if ($reservaSave) {
                $this->alert('success', '¡Reserva actualizada correctamente!', [
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
        public function destroy(){

            $this->alert('warning', '¿Seguro que desea borrar la reserva? No hay vuelta atrás', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => 'confirmDelete',
                'confirmButtonText' => 'Sí',
                'showDenyButton' => true,
                'denyButtonText' => 'No',
                'timerProgressBar' => true,
            ]);

        }
        // Función para cuando se llama a la alerta
        public function getListeners()
        {
            return [
                'confirmed',
                'update',
                'destroy',
                'confirmDelete'
            ];
        }

        // Función para cuando se llama a la alerta
        public function confirmed()
        {
            // Do something
            return redirect()->route('reservas.index');
        }

        public function confirmDelete()
        {
            $reserva = Reserva::find($this->identificador);

            $reserva->delete();
            return redirect()->route('reservas.index');

        }
    }
