<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function store(Request $request)
    {
        $reserva = Reserva::create($request->all());

        return response()->json($reserva, 201); // Devuelve la reserva creada con un código de estado HTTP 201
    }
}
