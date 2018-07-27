@extends('adminlte::layouts.app')

<?php use App\Http\Controllers\AudioController;?>

<link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

@section('contentheader_title')
    Audios
@endsection

@section('main-content')

    <form method="POST" action="{{ route('audio.post') }}">
        {!! csrf_field() !!}
        <label for="campaign">
            Campaña
            <select class="form-control" name="campaigns" id="campaigns">

                @foreach($campaigns_user as $campaign_user)
                    @foreach($campaigns as $campaign)
                        @if($userId == $campaign_user->user_id)
                            @if($campaign_user->campaign_id == $campaign->id)
                                <option >{{$campaign->name}}</option>
                                {!! $errors->first('campaign', '<span class=error>:message</span>')  !!}
                            @endif
                        @endif
                    @endforeach
                @endforeach
            </select>
        </label>

        <label for="mes">
            Mes
            <select id="mes" class="form-control" name="mes">
                <option value=""></option>
            </select>
        </label>
        <input type="submit" value="Buscar">

    </form>
    @if (isset($audios))
        <table id="audio-table" class="table table-bordered" width="100%">
        <thead>
        <tr>
            <th>Audio</th>
            <th>Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($audios as $audio)
            <tr>
                <td>{{$audio}}</td>
                <td><a href="{{ url('audio/download/'.$audio) }}" class="btn btn-success">Descargar</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @endif
@endsection


<script>
    $('#campaign').on('change', function(e){
        console.log(e);
        var campana = e.target.value;

        $.get('{{ url('information') }}/create/ajax-state?campana=' + campana, function(data) {
            console.log(data);
            $('#mes').empty();
            $.each(data, function(index,subCatObj){
                $('#mes').append(''+subCatObj.name+'');
            });
        });
    });
</script>