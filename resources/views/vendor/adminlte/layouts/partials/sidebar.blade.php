<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                </div>
            </div>
        @endif

        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- Optionally, you can add icons to the links -->
            @if(Auth::user()->hasRole('admin'))
                <li ><a href="{{ route('rol.index') }}"><i class='fa fa-users'></i> <span>Roles</span></a></li>
                <li><a href="{{ route('user.index') }}"><i class='fa fa-user'></i> <span>Usuarios</span></a></li>
                <li><a href="{{ route('campaign.index') }}"><i class='fa fa-building'></i> <span>Campañas</span></a></li>
            @endif
            <li><a href=""><i class='fa fa-volume-up'></i> <span>Audios</span></a></li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
