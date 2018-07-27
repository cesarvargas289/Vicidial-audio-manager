@extends('adminlte::layouts.app')

@section('contentheader_title')
    Roles
@endsection

@section('main-content')
    <a href="{{route('rol.create')}}" class="btn btn-default btn-sm">Crear</a>

    <table width="100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Rol</th>
            <th>Descripción</th>
            <th>Acciones</th>

        </tr>
        </thead>
        <tbody>
        @foreach($roles as $rol)
            <tr>
                <td>{{ $rol->id }}</td>
                <td>{{ $rol->name }}</td>
                <td>{{ $rol->description }}</td>


                <td>
                    <a href="{{ route('rol.edit', $rol->id) }}">Editar</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection