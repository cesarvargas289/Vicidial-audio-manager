@extends('adminlte::layouts.app')

@section('contentheader_title')
   Crear usuario
@endsection

@section('main-content')

    @if(session()->has('info'))
        <h3>{{ session('info') }}</h3>
    @else
        <form method="POST" action="{{ route('user.store') }}">
        <!-- Hace que se puedan enviar los datos del formulario
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
            {!! csrf_field() !!}
            <p><label for="name">
                    Nombre
                    <input type="text" name="name" value="{{ old('name') }}">
                    {!! $errors->first('name', '<span class=error>:message</span>')  !!}
                </label></p>
            <p><label for="email">
                    Correo
                    <input type="text" name="email" value="{{ old('email') }}">
                    {!! $errors->first('email', '<span class=error>:message</span>')  !!}
                </label></p>
            <p><label for="password">
                    Password
                    <input type="password" name="password" >
                    {!! $errors->first('password', '<span class=error>:message</span>')  !!}
                </label></p>

            <p><label for="Rol">
                    Rol
                    <select class="form-control" name="rol">
                        @foreach($roles as $rol)
                            <option >{{$rol->name}}</option>
                            {!! $errors->first('name', '<span class=error>:message</span>')  !!}
                        @endforeach
                    </select>

                </label>

            <p><label for="campaign">
                    Campaña
                    <select class="form-control" multiple="multiple" name="campaigns[]" id="campaigns">
                        <option value="" disabled selected>Escoge las Campañas</option>
                        @foreach($campaigns as $campaign)
                            <option >{{$campaign->name}}</option>
                            {!! $errors->first('campaign', '<span class=error>:message</span>')  !!}
                        @endforeach
                    </select>

                </label>
            <input type="submit" value="Enviar">
        </form>
    @endif
    <hr>


@endsection

