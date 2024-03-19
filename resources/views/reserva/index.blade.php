
@extends('layouts.app')

@section('title', 'Ver Reservas')

@section('head')
    @vite(['resources/sass/productos.scss'])
    @vite(['resources/sass/alumnos.scss'])
@endsection

@section('content-principal')
<div>
    @livewire('reservas.index-component')
</div>
@endsection
