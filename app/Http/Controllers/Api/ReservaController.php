<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reserva;
use App\Models\Mesa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservaCreada;


class ReservaController extends Controller
{
    public function store(Request $request)
    {
        $numComensales = $request->input('comensales');
        $fecha = $request->input('fecha');
        $horario = $request->input('hora');
        $emailDelCliente = $request->input('email');
        $mesasTotales = Mesa::all(); // Suponiendo que esto devuelve una colección con el total de mesas y capacidades

        // Calcular las mesas disponibles basándose en las reservas activas
        $mesasDisponibles = $this->calcularMesasDisponibles($mesasTotales,$horario,$fecha);

        $resultadoAsignacion = $this->calcularAsignacionMesas($numComensales, $mesasDisponibles);

        if ($resultadoAsignacion['esPosible']) {
            // Crear la reserva con el número de mesas ocupadas
            $reserva = Reserva::create(array_merge($request->all(), ['mesas4' => $resultadoAsignacion['mesasDeCuatroAsignadas'],'mesas6' => $resultadoAsignacion['mesasDeSeisAsignadas']]));
            if ($reserva->estado == 1) {
                Mail::to($emailDelCliente)->send(new ReservaCreada($reserva));
            }
            return response()->json(['reserva' => $reserva], 201);
        } else {
            return response()->json(['error' => 'No hay suficientes mesas disponibles para acomodar la reserva.'], 400);
        }
    }

    private function calcularMesasDisponibles($mesasTotales,$horario,$fecha)
    {
        // Inicializar contadores de mesas disponibles
        $mesasDisponibles = [
            'cuatro' => 0,
            'seis' => 0,
        ];

        // Supongamos que Mesa::all() devuelve un arreglo con la cantidad de mesas por capacidad
        foreach ($mesasTotales as $mesa) {
            if ($mesa->capacidad == 4) {
                $mesasDisponibles['cuatro'] += $mesa->cantidad;
            } elseif ($mesa->capacidad == 6) {
                $mesasDisponibles['seis'] += $mesa->cantidad;
            }
        }
        $fechaHoraReserva = Carbon::createFromFormat('Y-m-d H:i', $fecha . ' ' . $horario);

        // Calcular el intervalo de tiempo para restricción de reservas (1 hora y 15 minutos antes y después)
        $finReserva = $fechaHoraReserva->copy()->addHours(1)->addMinutes(15);
        $inicioBuffer = $fechaHoraReserva->copy()->subHours(1)->subMinutes(15);

        // Consultar reservas activas que choquen con el horario de la nueva reserva
        $reservasActivas = Reserva::where('estado', 1)
                            ->where('fecha', $fecha)
                            ->get()
                            ->filter(function($reserva) use ($inicioBuffer, $finReserva) {
                                // Convertir la hora de la reserva existente a objeto Carbon para comparar
                                $fechaHoraInicioReservaExistente = Carbon::createFromFormat('Y-m-d H:i', $reserva->fecha . ' ' . $reserva->hora);
                                // Estimar el fin de la reserva existente, asumiendo una duración estándar
                                $fechaHoraFinReservaExistente = $fechaHoraInicioReservaExistente->copy()->addHours(1)->addMinutes(15); // Ajustar según necesidad

                                return $fechaHoraInicioReservaExistente->between($inicioBuffer, $finReserva) ||
                                       $fechaHoraFinReservaExistente->between($inicioBuffer, $finReserva) ||
                                       ($inicioBuffer->between($fechaHoraInicioReservaExistente, $fechaHoraFinReservaExistente) &&
                                        $finReserva->between($fechaHoraInicioReservaExistente, $fechaHoraFinReservaExistente));
                            });

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
            'totalMesasAsignadas' => $mesasDeCuatroAsignadas + $mesasDeSeisAsignadas,
        ];
    }

}
