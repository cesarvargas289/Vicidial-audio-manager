@extends('adminlte::layouts.app')

@section('contentheader_title')
    Usuarios
@endsection

@section('main-content')

    <a href="{{route('user.create')}}" class="btn btn-default btn-sm">Crear</a>
    <table width="100%">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>rol</th>
            <th>Campañas</th>
            <th>Acciones</th>

        </tr>
        </thead>
        <tbody>
        @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->name }}</td>
                <td>{{ $usuario->email }}</td>
                @foreach($rol_de_usuarios as $rol_de_usuario)
                    @foreach($roles as $rol)
                        @if($usuario->id == $rol_de_usuario->user_id)
                            @if($rol_de_usuario->role_id == $rol->id)
                                <td> {{ $rol->name }} </td>
                            @endif
                        @endif
                    @endforeach
                @endforeach

                @foreach($campaigns_user as $campaign_user )
                    @foreach($campaigns as $campaign)
                        @if($usuario->id == $campaign_user->user_id)
                            @if($campaign->id == $campaign_user->campaign_id)
                                @php($campanas = $campanas.$campaign->name. ', ')
                            @endif
                        @endif
                    @endforeach
                @endforeach

                <td>{{( rtrim($campanas, ', ')) }} @php($campanas = '') </td>


                <td>
                    <a class="btn btn-warning" href="{{ route('user.edit', $usuario->id) }}">Editar</a>
                    <form style="display: inline" onsubmit="return confirm('Estás seguro que quieres eliminar?');" action="{{ route('user.destroy', $usuario->id) }}" method="POST" >
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE" />
                        <button class="btn btn-danger" type="submit">Eliminar</button>
                    </form>

                </td>
            </tr>
        @endforeach


        </tbody>
    </table>

@endsection
