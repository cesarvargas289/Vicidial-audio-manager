@extends('adminlte::layouts.app')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

@section('contentheader_title')
    Audios
@endsection

@section('main-content')

    <form method="POST" action="{{ route('audio.post') }}">
        {!! csrf_field() !!}
        <label for="campaign">
            Campaña
            <select class="form-control" name="campaigns" id="campaigns">
                <option value="0" disable="true" selected="true">=== Select campaña ===</option>
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
                <option value="mes"></option>
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

    $(document).ready(function(){
        $('#campaigns').on('change', function(e){
            console.log(e);
            var campaigns = e.target.value;
            $.get('/audio/meses?campaigns=' + campaigns,function(data) {
                console.log(data);
                $('#mes').empty();
                $('#mes').append('<option value="0" disable="true" selected="true">=== Select Mes ===</option>');

                $.each(data, function(index, regenciesObj){
                    $('#mes').append('<option value='+String(regenciesObj)+'>'+ String(regenciesObj)+'</option>');
                })
            });
        });
    });

</script>