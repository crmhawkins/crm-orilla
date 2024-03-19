@extends('layouts.app')

@section('title', 'Editar Reserva')

@section('head')
    @vite(['resources/sass/productos.scss'])
    @vite(['resources/sass/alumnos.scss'])
@endsection

@section('content-principal')
<div>
    @livewire('reservas.edit-component', ['identificador'=>$id])
</div>
@endsection


