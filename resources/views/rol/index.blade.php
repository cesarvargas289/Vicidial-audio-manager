@extends('adminlte::layouts.app')

@section('contentheader_title')
    Roles
@endsection

@section('main-content')

    <table width="100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Rol</th>
            <th>Descripción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $rol)
            <tr>
                <td>{{ $rol->id }}</td>
                <td>{{ $rol->name }}</td>
                <td>{{ $rol->description }}</td>

            </tr>
        @endforeach
        </tbody>
    </table>

@endsection