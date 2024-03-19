@extends('layouts.app')

@section('title', 'Crear Reserva')

@section('head')
    @vite(['resources/sass/productos.scss'])
    @vite(['resources/sass/alumnos.scss'])
@endsection

@section('content-principal')
<div>
    @livewire('reservas.create-component')
</div>
@endsection

