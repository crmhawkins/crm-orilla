@extends('layouts.app')

@section('title', 'Dashboard')
@section('content-principal')

    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Dashboard</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-xl-4">
            <div class="card">
                <div class="card-heading p-4">
                    <div class="mini-stat-icon float-right">
                        <i class="bi bi-calendar-event-fill bg-primary text-white"></i>
                    </div>
                    <div>
                        <h5 class="font-16">Reservas hoy</h5>
                    </div>
                    <h3 class="mt-4">{{$ReservasHoy}}</h3>
                    <div class="progress mt-4" style="height: 4px;">
                        <div class="progress-bar bg-warning" role="progressbar"
                             style="width: {{ abs($porcentajeCambioReservasDia) }}%"
                             aria-valuenow="{{ abs($porcentajeCambioReservasDia) }}"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="text-muted mt-2 mb-0">
                        Respecto al mes anterior
                        <span class="float-right">
                            {{ number_format($porcentajeCambioReservasDia, 2) }}%
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-4">
            <div class="card">
                <div class="card-heading p-4">
                    <div class="mini-stat-icon float-right">
                        <i class="bi bi-calendar-week-fill bg-success text-white"></i>
                    </div>
                    <div>
                        <h5 class="font-16">Reservas semanales</h5>
                    </div>
                    <h3 class="mt-4">  {{$ReservaSemana}}</h3>
                    <div class="progress mt-4" style="height: 4px;">
                        <div class="progress-bar bg-warning" role="progressbar"
                             style="width: {{ abs($porcentajeCambioReservasSemana) }}%"
                             aria-valuenow="{{ abs($porcentajeCambioReservasSemana) }}"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="text-muted mt-2 mb-0">
                        Respecto al mes anterior
                        <span class="float-right">
                            {{ number_format($porcentajeCambioReservasSemana, 2) }}%
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-4">
            <div class="card">
                <div class="card-heading p-4">
                    <div class="mini-stat-icon float-right">
                        <i class="bi bi-calendar-fill bg-warning text-white"></i>
                    </div>
                    <div>
                        <h5 class="font-16">Reservas mensuales</h5>
                    </div>
                    <h3 class="mt-4">{{$ReservaMensual}} </h3>
                    <div class="progress mt-4" style="height: 4px;">
                        <div class="progress-bar bg-warning" role="progressbar"
                             style="width: {{ abs($porcentajeCambioReservasMensual) }}%"
                             aria-valuenow="{{ abs($porcentajeCambioReservasMensual) }}"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="text-muted mt-2 mb-0">
                        Respecto al mes anterior
                        <span class="float-right">
                            {{ number_format($porcentajeCambioReservasMensual, 2) }}%
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection
