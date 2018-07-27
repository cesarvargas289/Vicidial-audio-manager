@extends('adminlte::layouts.app')

@section('contentheader_title')
    Editar Usuario {{ $user->name }}
@endsection

@section('main-content')

    <form method="POST" action="{{ route('user.update', $user->id) }}">
        <!-- Hace la conversion de put a POST en el update-->
    {!! method_field('PUT') !!}

    <!-- Hace que se puedan enviar los datos del formulario
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
        {!! csrf_field() !!}
        <p><label for="name">
                Nombre
                <input type="text" name="name" value="{{ $user->name}}">
                {!! $errors->first('name', '<span class=error>:message</span>')  !!}
            </label></p>

        <p><label for="email">
                Correo
                <input type="text" name="email" value="{{ $user->email}}">
                {!! $errors->first('email', '<span class=error>:message</span>')  !!}
            </label></p>

        <p><label for="password">
                Password
                <input type="password" name="password" value="{{ $user->password}}">
                {!! $errors->first('password', '<span class=error>:message</span>')  !!}
            </label></p>

        <label for="rol">
            Rol
            <select class="form-control" name="rol">
                @foreach($roles as $rol)
                    @foreach($roles_user as $rol_user)
                    @endforeach
                    <option value="{{ $rol->id }}" @if($user->id==$rol_user->user_id) {{ $selectedvalue_rol == $rol->id ? 'selected="selected"' : '' }} @endif >{{ $rol->name}}</option>
                    {!! $errors->first('id', '<span class=error>:message</span>')  !!}
                @endforeach

            </select>

        </label>
        <label for="campaigns">
            campañas
            <select class="form-control" multiple="multiple" name="campaigns[]">
                @foreach($campaigns as $campaign)
                    @foreach($campaigns_user as $campaign_user)
                    @endforeach
                    <option value="{{ $campaign->id }}" @if($user->id==$campaign_user->campaign_id)  @endif >{{ $campaign->name}}</option>
                    {!! $errors->first('id', '<span class=error>:message</span>')  !!}
                @endforeach

            </select>

        </label>

        <input type="submit" value="Enviar">
    </form>


@endsection
