<?php

namespace App\Http\Livewire\Reservas;

use App\Models\Reserva;
use Livewire\Component;

class IndexComponent extends Component
{
    public $reservas;
    public function mount()
    {
        $this->reservas = Reserva::all();
    }
    public function render()
    {
        return view('livewire.reservas.index-component');
    }
}
