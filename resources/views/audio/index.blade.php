@extends('adminlte::layouts.app')


@section('contentheader_title')
    Audios
@endsection

@section('main-content')

    <form method="POST" action="{{ route('audio.post') }}">
        {!! csrf_field() !!}
        <label for="campaign">
            Campaña
            <select class="form-control" name="campaigns" id="campaigns">
                <option value="0" disable="true" selected="true">=== Selecciona campaña ===</option>
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
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <table id="audio-table" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></script>
<script src="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css"></script>

<script type="text/javascript">

    //Funcion para mandar datos dependientes de dropdown campaña en dropdown mes
    $(document).ready(function(){
        $('#campaigns').on('change', function(e){
            console.log(e);
            var campaigns = e.target.value;
            $.get('audio/meses?campaigns=' + campaigns,function(data) {
                console.log(data);
                $('#mes').empty();
                $('#mes').append('<option value="0" disable="true" selected="true">=== Selecciona Mes ===</option>');
                $.each(data, function(index, regenciesObj){
                    $('#mes').append('<option value='+String(regenciesObj)+'>'+ String(regenciesObj)+'</option>');
                })
            });
        });

    });
    $.noConflict();
    jQuery( document ).ready(function( $ ) {
        $('#audio-table').DataTable();
    });

    (function ($, DataTable) {
        // Datatable global configuration
        $.extend(true, DataTable.defaults, {
            language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": " Primero ",
                    "sLast": " Último",
                    "sNext": "     Siguiente",
                    "sPrevious": "Anterior     "
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
    })(jQuery, jQuery.fn.dataTable);
</script>
