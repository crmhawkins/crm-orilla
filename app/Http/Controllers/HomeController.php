<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\TipoEvento;
use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Presupuesto;
use Carbon\Carbon;



class HomeController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $fechaActual = Carbon::now()->format('Y-m-d');
        $inicioSemana = Carbon::now()->startOfWeek();  // Lunes de esta semana
        $finSemana = Carbon::now()->endOfWeek();  // Domingo de esta semana
        $inicioMes = Carbon::now()->startOfMonth()->startOfWeek();  // Lunes de esta semana
        $finMes = Carbon::now()->endOfMonth()->endOfWeek();  // Domingo de esta semana
        $diaActualMesPasado = Carbon::now()->subMonth();
        $inicioSemanaMesPasado = $inicioSemana->copy()->subMonth();
        $finSemanaMesPasado = $finSemana->copy()->subMonth();
        $inicioMesPasado = Carbon::now()->startOfMonth()->startOfWeek()->subMonth();  // Lunes de esta semana
        $finMesPasado = Carbon::now()->endofMonth()->endofWeek()->subMonth();  // Domingo de esta semana

        $user = $request->user();

        $ReservasHoy = Reserva::whereDate('fecha', '=', $fechaActual)->get()->count();
        $ReservasDiaActualMesPasado = Reserva::whereDate('fecha', '=', $diaActualMesPasado->format('Y-m-d'))->get()->count();
        $ReservaSemana = Reserva::whereBetween('fecha', [$inicioSemana, $finSemana])->get()->count();
        $ReservaSemanaPasada = Reserva::whereBetween('fecha', [$inicioSemanaMesPasado, $finSemanaMesPasado])->get()->count();
        $ReservaMensual = Reserva::whereBetween('fecha', [$inicioMes, $finMes])->get()->count();
        $ReservaMensualpasado = Reserva::whereBetween('fecha', [$inicioMesPasado, $finMesPasado])->get()->count();

        $porcentajeCambioReservasMensual = $ReservaMensualpasado > 0
            ? (($ReservaMensual - $ReservaMensualpasado) / $ReservaMensualpasado) * 100
            : 0;

        $porcentajeCambioReservasDia = $ReservasDiaActualMesPasado > 0
            ? (($ReservasHoy - $ReservasDiaActualMesPasado) / $ReservasDiaActualMesPasado) * 100
            : 0;

        $porcentajeCambioReservasSemana = $ReservaSemanaPasada > 0
            ? (($ReservaSemana - $ReservaSemanaPasada) / $ReservaSemanaPasada) * 100
            : 0;


        return view('home', compact(
            'user',
            'ReservasHoy',
            'ReservaSemana',
            'ReservaMensual',
            'ReservaMensualpasado',
            'porcentajeCambioReservasMensual',
            'porcentajeCambioReservasDia',
            'porcentajeCambioReservasSemana'
        ));
    }
}
