@extends('adminlte::layouts.app')

@section('contentheader_title')
    Campañas
@endsection

@section('main-content')

    <a href="{{route('campaign.create')}}" class="btn btn-default btn-sm">Crear</a>
    <table width="100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Campaña</th>
            <th>Acciones</th>

        </tr>
        </thead>
        <tbody>
        @foreach($campaigns as $campaign)
            <tr>
                <td>{{ $campaign->id }}</td>
                <td>{{ $campaign->name }}</td>

                <td>
                    <a class="btn btn-warning" href="{{ route('campaign.edit', $campaign->id) }}">Editar</a>
                    <form style="display: inline" onsubmit="return confirm('Estás seguro que quieres eliminar?');" action="{{ route('campaign.destroy', $campaign->id) }}" method="POST" >
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
