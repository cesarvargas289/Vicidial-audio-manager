@extends('adminlte::layouts.app')

@section('contentheader_title')
    Crear Rol
@endsection

@section('main-content')

    @if(session()->has('info'))
        <h3>{{ session('info') }}</h3>
    @else
        <form method="POST" action="{{ route('rol.store') }}">
        <!-- Hace que se puedan enviar los datos del formulario
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
            {!! csrf_field() !!}
            <p><label for="name">
                    Nombre del rol
                    <input type="text" name="name" value="{{ old('name') }}">
                    {!! $errors->first('name', '<span class=error>:message</span>')  !!}
                </label></p>
            <p><label for="description">
                    Descripción
                    <input type="text" name="description" value="{{ old('description') }}">
                    {!! $errors->first('description', '<span class=error>:message</span>')  !!}
                </label></p>

            <input type="submit" value="Enviar">
        </form>

    @endif
    <hr>

@endsection

