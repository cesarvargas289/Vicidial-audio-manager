@extends('adminlte::layouts.app')

@section('contentheader_title')
    Editar Usuario {{ $user->name }}
@endsection

@section('main-content')

    <section class="content">
        <div class="col-md-6">
            <div class="box box-info">
                <form class="form-horizontal" method="POST" action="{{ route('user.update', $user->id) }}">
                    <!-- Hace la conversion de put a POST en el update-->
                    {!! method_field('PUT') !!}
                    {!! csrf_field() !!}

                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="name"> Nombre </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" value="{{ $user->name}}">
                                {!! $errors->first('name', '<span class=error>:message</span>')  !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="email"> Correo </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control"  name="email" value="{{ $user->email}}">
                                {!! $errors->first('email', '<span class=error>:message</span>')  !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="password"> Password </label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control"  name="password" value="{{ $user->password}}" >
                                {!! $errors->first('password', '<span class=error>:message</span>')  !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="Rol"> Rol  </label>
                            <div class="col-sm-10">
                                <select class="form-control" name="rol">
                                    @foreach($roles as $rol)
                                        @foreach($roles_user as $rol_user)
                                        @endforeach
                                        <option value="{{ $rol->id }}" @if($user->id==$rol_user->user_id) {{ $selectedvalue_rol == $rol->id ? 'selected="selected"' : '' }} @endif >{{ $rol->name}}</option>
                                        {!! $errors->first('id', '<span class=error>:message</span>')  !!}
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="campaign"> Campaña </label>
                            <div class="col-sm-10">
                                <select class="form-control" multiple name="campaigns[]" id="campaigns">
                                    @foreach($campaigns_user as $campaign_user)
                                        @foreach($selectedvalue_campaign as $campaign_selected)
                                            @foreach($campaigns as $campaign)
                                                @if($campaign_user->user_id==$user->id)
                                                    @if($campaign_selected == $campaign->id)
                                                        <option value="{{ $campaign_user->id }}" @if($user->id==$rol_user->user_id) {{ (collect(old('campaigns'))->contains($campaign_selected)) ? 'selected':'' }} @endif>{{ $campaign->name}}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <input type="submit" value="Enviar">
                    </div>
                </form>

            </div>
        </div>
    </section>

@endsection
