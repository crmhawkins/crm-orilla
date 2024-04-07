<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Mesa;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class SettingsComponent extends Component
{
    use LivewireAlert;
    public $mesas = [];
    public $mesasParaEliminar = [];

    public function mount()
    {
        // Carga los datos existentes de la base de datos
        $this->mesas = Mesa::all()->toArray();

        // Asegúrate de tener al menos una fila vacía si no hay datos
        if (empty($this->mesas)) {
            $this->mesas = [['cantidad' => '', 'capacidad' => '']];
        }
    }

    public function render()
    {

        return view('livewire.settings.settings-component');
    }

    public function addMesa()
    {
        $this->mesas[] = ['cantidad' => '', 'capacidad' => ''];
    }

    public function removeMesa($index)
    {
        if (isset($this->mesas[$index]['id'])) {
            // Añade el ID a la lista de mesas para eliminar
            $this->mesasParaEliminar[] = $this->mesas[$index]['id'];
        }
        // Elimina la mesa del array de mesas independientemente de si es nueva o existente
        unset($this->mesas[$index]);
        $this->mesas = array_values($this->mesas); // Reindexa el array
    }

    protected $listeners = ['saveMesas', 'confirmed'];
    public function saveMesas()
{
    $mesasActuales = array_filter($this->mesas, function ($mesa) {
        return !in_array($mesa['id'] ?? null, $this->mesasParaEliminar);
    });

    foreach ($mesasActuales as $mesa) {
        if (isset($mesa['id'])) {
            // Actualiza el registro existente
            Mesa::find($mesa['id'])->update($mesa);
        } else {
            // Crea un nuevo registro
            Mesa::create($mesa);
        }
    }
    foreach ($this->mesasParaEliminar as $mesaId) {
        Mesa::destroy($mesaId);
    }
    $this->mesasParaEliminar = []; // Limpia la lista después de la eliminación

    // Posiblemente quieras recargar los datos de las mesas aquí para reflejar los cambios en la interfaz de usuario
    $this->mount();

    $this->alert('success', '¡Mesas actualizadas correctamente!', [
        'position' => 'center',
        'timer' => 3000,
        'toast' => false,
        'showConfirmButton' => true,
        'onConfirmed' => 'confirmed',
        'confirmButtonText' => 'ok',
        'timerProgressBar' => true,
    ]);
}

    public function confirmed()
    {

        return redirect('/admin/home');
    }
}
