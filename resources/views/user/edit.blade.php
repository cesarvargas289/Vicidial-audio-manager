
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

@section('htmlheader')
    @include('adminlte::layouts.partials.htmlheader')
@show

<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="skin-blue sidebar-mini">

    <div class="wrapper">

    @include('adminlte::layouts.partials.mainheader')

    @include('adminlte::layouts.partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            @section('contentheader_title')
                Audios
        @endsection

        <!-- Main content -->
            <section class="content">
                <!-- Your Page Content Here -->
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
                                                    <option value="{{ $rol->id }}"
                                                    @if($id == $rol_user->user_id) {{ $selectedvalue_rol == $rol->id ? "selected":"" }}@endif >{{ $rol->name}}</option>
                                                    {!! $errors->first('id', '<span class=error>:message</span>')  !!}
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="campaigns"> Campaña </label>
                                        <div class="col-sm-10">
                                            {!! Form::select('campaigns[]',$campaigns,$selectedvalue_campaign,['class'=>'form-control', 'multiple', 'required']) !!}
                                        </div>
                                    </div>
                                    <input type="submit" value="Enviar">
                                </div>
                            </form>

                        </div>
                    </div>
                </section>
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        @include('adminlte::layouts.partials.controlsidebar')

    <!-- Main Footer -->


    </div><!-- ./wrapper -->

@section('scripts')
    <script>
        window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
    </script>

@show

</body>
</html>