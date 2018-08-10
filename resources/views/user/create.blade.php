@extends('adminlte::layouts.app')

@section('contentheader_title')
    Crear usuario
@endsection

@section('main-content')

    @if(session()->has('info'))
        <h3>{{ session('info') }}</h3>
    @else

        <section class="content">
            <div class="col-md-6">
                <div class="box box-info">
                    <form class="form-horizontal" method="POST" action="{{ route('user.store') }}">
                    <!-- Hace que se puedan enviar los datos del formulario
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
                        {!! csrf_field() !!}

                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="name"> Nombre </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                    {!! $errors->first('name', '<span class=error>:message</span>')  !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="email"> Correo </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"  name="email" value="{{ old('email') }}">
                                    {!! $errors->first('email', '<span class=error>:message</span>')  !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="password"> Password  </label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control"  name="password" >
                                    {!! $errors->first('password', '<span class=error>:message</span>')  !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="Rol"> Rol  </label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="rol">
                                        @foreach($roles as $rol)
                                            <option >{{$rol->name}}</option>
                                            {!! $errors->first('name', '<span class=error>:message</span>')  !!}
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                            <label class="col-sm-2 control-label" for="campaign"> Campaña </label>
                                <div class="col-sm-10">
                                    <select class="form-control" multiple="multiple" name="campaigns[]" required id="campaigns">
                                        <option value="" disabled selected>Escoge las Campañas</option>
                                        @foreach($campaigns as $campaign)
                                            <option >{{$campaign->name}}</option>
                                            {!! $errors->first('campaign', '<span class=error>:message</span>')  !!}
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                                <input class="btn btn-info pull-left" type="submit" value="Enviar">
                        </div>
                    </form>
                </div>
            </div>
        </section>
    @endif
    <hr>


@endsection

