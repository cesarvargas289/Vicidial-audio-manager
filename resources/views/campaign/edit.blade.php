@extends('adminlte::layouts.app')

@section('contentheader_title')
    Editar campaña
@endsection

@section('main-content')

    <form method="POST" action="{{ route('campaign.update', $campaign->id) }}">

        <!-- Hace la conversion de put a POST en el update-->
    {!! method_field('PUT') !!}

    <!-- Hace que se puedan enviar los datos del formulario
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
        {!! csrf_field() !!}
        <p><label for="name">
                Nombre
                <input type="text" name="name" value="{{ $campaign->name}}">
                {!! $errors->first('name', '<span class=error>:message</span>')  !!}
            </label></p>

        <input type="submit" value="Enviar">
    </form>


@endsection
