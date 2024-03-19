<?php

namespace App\Http\Livewire\Disponible;

use App\Models\Reserva;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class IndexComponent extends Component
{
    public $reservas;
    public $dia;

    public function mount()
    {
        $this->dia = Carbon::now()->format('Y-m-d');
        $this->reservas = Reserva::where('fecha',$this->dia)->get();

    }

    public function render()
    {
        return view('livewire.disponible.index-component');
    }
    protected $listeners = ['refresh' => '$refresh'];
    public function updatedDia($value)
    {
        $this->reservas = Reserva::where('fecha',$value)->get();
    }
}
