<?php

namespace App\Http\Livewire\Disponible;

use App\Models\Presupuesto;
use App\Models\Servicio;
use App\Models\Articulos;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class IndexComponent extends Component
{
    public $servicios;
    public $articulos;
    public $dia;



    public function mount()
    {
        $this->servicios = Servicio::all();
        $this->articulos = Articulos::all();
        $this->dia = Carbon::now()->format('Y-m-d');
    }

    public function stock($id,$date){
        $servicioId = $id;

        $fechaEvento = $date;

        $sumaTotalStockUsado = DB::table('presupuestos')
        ->join('servicio_presupuesto', 'presupuestos.id', '=', 'servicio_presupuesto.presupuesto_id')
        ->whereRaw('? BETWEEN presupuestos.diaEvento AND presupuestos.diaFinal', [$fechaEvento])
        ->where('servicio_presupuesto.servicio_id', $servicioId)
        ->selectRaw('SUM(CASE WHEN servicio_presupuesto.num_art_indef > 0 THEN servicio_presupuesto.num_art_indef ELSE COALESCE(NULLIF(servicio_articulo.stock_usado, 0), 1) END) AS total_stock_usado')
        ->value('total_stock_usado');
        dd($sumaTotalStockUsado);
            // Obtener el stock total fijo del artículo
            $stockTotal = DB::table('servicio_articulo')
                ->where('servicio_id', $servicioId)
                ->sum('servicio_articulo.stock_usado');
            // Obtener la cantidad de stock usado por el servicio que deseas agregar
            $cantidadStockUsadoNuevoServicio = $this->num_arti ;
            // Calcular la cantidad total que se usaría si se agrega el nuevo servicio
            $nuevaCantidadTotal = $sumaTotalStockUsado + $cantidadStockUsadoNuevoServicio;
            if ($nuevaCantidadTotal > $stockTotal) {
                $stockSeSupera = true;
            }
    }

    public function render()
    {
        return view('livewire.disponible.index-component');
    }

    public function cambiodia()
    {

    }
}
