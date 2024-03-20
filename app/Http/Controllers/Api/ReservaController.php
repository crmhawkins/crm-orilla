<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function store(Request $request)
    {

        // $validatedData = $request->validate([
        //     'nombre' => 'required|string|max:255',
        //     'fecha' => 'required|date',
        //     'hora' => 'required',
        //     'comensales' => 'required|integer',
        //     'telefono' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255',
        // ]);

        $reserva = Reserva::create($request->all());

        return response()->json($reserva, 201); // Devuelve la reserva creada con un código de estado HTTP 201
    }
}
